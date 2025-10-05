import asyncio
import random
import string
from collections import namedtuple
import os
import json
import re
import time
import imaplib
import email
from datetime import datetime, timedelta
from typing import Optional

import httpx
from loguru import logger
from patchright.async_api import async_playwright

# Configurar rotação de logs para evitar arquivos grandes
logger.add("console_logs_{time}.txt", rotation="10 MB", level="INFO")

def generate_random_session_id(length=32):
    return ''.join(random.choices(string.ascii_lowercase + string.digits, k=length))

# ==========================================
# CONFIGURAÇÕES DO SURFSKY
# ==========================================
ONE_TIME_URL = "https://api-public.surfsky.io/profiles/one_time"
PROXIES_BASE_URL = "https://api-public.surfsky.io/proxies"
API_KEY = 'd25bf48ff749401e921ed8029556fccb'
TRIAL_EXPIRATION = "26.09.2025"

Credentials = namedtuple('Credentials', ['email', 'password', 'gmail_email', 'gmail_password'])

# ==========================================
# CONFIGURAÇÃO DE PROXY - ANGOLA/PORTUGAL
# ==========================================
USE_SURFSKY_PROXY = True
PROXY_COUNTRY = "ao"

# Criar pasta screenshots se não existir
if not os.path.exists('screenshots'):
    os.makedirs('screenshots')

class VFSOTPExtractor:
    """Extrator de códigos OTP do VFS via Gmail"""
    
    def __init__(self, email_address: str, password: str, imap_server: str = None):
        self.email_address = email_address
        self.password = password
        self.imap_server = imap_server or self._get_imap_server()
        self.connection = None
    
    def _get_imap_server(self) -> str:
        """Detecta automaticamente o servidor IMAP baseado no domínio do email"""
        domain = self.email_address.split('@')[1].lower()
        
        imap_servers = {
            'gmail.com': 'imap.gmail.com',
            'outlook.com': 'outlook.office365.com',
            'hotmail.com': 'outlook.office365.com',
            'yahoo.com': 'imap.mail.yahoo.com',
            'yahoo.com.br': 'imap.mail.yahoo.com',
            'uol.com.br': 'imap.uol.com.br',
            'bol.com.br': 'imap.uol.com.br',
            'terra.com.br': 'imap.terra.com.br'
        }
        
        return imap_servers.get(domain, 'imap.' + domain)
    
    def connect(self) -> bool:
        """Conecta ao servidor de email"""
        try:
            logger.info(f"Conectando ao servidor {self.imap_server}...")
            self.connection = imaplib.IMAP4_SSL(self.imap_server, 993)
            self.connection.login(self.email_address, self.password)
            logger.success("Conexão Gmail estabelecida com sucesso!")
            return True
        except Exception as e:
            logger.error(f"Erro ao conectar ao Gmail: {e}")
            return False
    
    def disconnect(self):
        """Desconecta do servidor de email"""
        if self.connection:
            try:
                self.connection.close()
                self.connection.logout()
                logger.info("Desconectado do Gmail.")
            except:
                pass
    
    def search_vfs_emails(self, days_back: int = 1) -> list:
        """Busca emails do VFS nos últimos dias"""
        if not self.connection:
            logger.error("Não há conexão ativa. Execute connect() primeiro.")
            return []
        
        try:
            # Seleciona a caixa de entrada
            self.connection.select('INBOX')
            
            # Calcula a data de busca
            search_date = (datetime.now() - timedelta(days=days_back)).strftime("%d-%b-%Y")
            
            # Critérios de busca para emails do VFS
            search_criteria = [
                f'(SINCE "{search_date}" FROM "vfs")',
                f'(SINCE "{search_date}" FROM "vfsglobal")',
                f'(SINCE "{search_date}" SUBJECT "OTP")',
                f'(SINCE "{search_date}" SUBJECT "verification")',
                f'(SINCE "{search_date}" SUBJECT "code")',
                f'(SINCE "{search_date}" SUBJECT "código")',
                f'(SINCE "{search_date}")',  # Fallback para buscar todos os emails recentes
            ]
            
            email_ids = []
            
            # Tenta diferentes combinações de critérios
            for criteria in search_criteria:
                try:
                    status, messages = self.connection.search(None, criteria)
                    if status == 'OK' and messages[0]:
                        ids = messages[0].split()
                        email_ids.extend([id.decode() for id in ids])
                        logger.info(f"Encontrados {len(ids)} emails com critério: {criteria}")
                except Exception as e:
                    logger.debug(f"Erro na busca com critério {criteria}: {e}")
                    continue
            
            # Remove duplicatas e mantém ordem
            unique_ids = list(dict.fromkeys(email_ids))
            logger.info(f"Total de emails únicos encontrados: {len(unique_ids)}")
            
            return unique_ids
            
        except Exception as e:
            logger.error(f"Erro ao buscar emails: {e}")
            return []
    
    def extract_otp_from_email(self, email_id: str) -> Optional[dict]:
        """Extrai o código OTP de um email específico"""
        try:
            # Busca o email
            status, msg_data = self.connection.fetch(email_id, '(RFC822)')
            if status != 'OK':
                return None
            
            # Parse do email
            email_body = msg_data[0][1]
            email_message = email.message_from_bytes(email_body)
            
            # Extrai informações básicas
            subject = email_message['Subject'] or ''
            sender = email_message['From'] or ''
            date = email_message['Date'] or ''
            
            logger.info(f"Analisando email: {subject} de {sender}")
            
            # Verifica se é email do VFS
            if not any(term in sender.lower() for term in ['vfs', 'visa']):
                # Ainda assim, verifica se tem OTP no assunto/conteúdo
                if not any(term in subject.lower() for term in ['otp', 'code', 'verification', 'código']):
                    return None
            
            # Extrai o corpo do email
            body = self._get_email_body(email_message)
            
            if not body:
                return None
            
            # Padrões para encontrar códigos OTP do VFS
            otp_patterns = [
                r'(?:verification\s+code|código\s+de\s+verificação)[:\s]*([0-9]{4,8})',
                r'(?:your\s+(?:verification\s+)?code|seu\s+código)[:\s]*([0-9]{4,8})',
                r'(?:otp|pin)[:\s]*([0-9]{4,8})',
                r'\b([0-9]{6})\b',  # 6 dígitos
                r'\b([0-9]{4})\b',  # 4 dígitos
                r'\b([0-9]{8})\b',  # 8 dígitos
            ]
            
            # Busca por padrões
            full_content = f"{subject} {body}"
            clean_content = re.sub('<[^<]+?>', ' ', full_content)
            
            for pattern in otp_patterns:
                matches = re.findall(pattern, clean_content, re.IGNORECASE)
                if matches:
                    # Filtra códigos válidos
                    valid_codes = [code for code in matches if 4 <= len(code) <= 8 and code.isdigit()]
                    if valid_codes:
                        logger.success(f"Código OTP encontrado: {valid_codes[0]}")
                        return {
                            'otp': valid_codes[0],
                            'subject': subject,
                            'sender': sender,
                            'date': date,
                            'email_id': email_id,
                            'all_codes': valid_codes
                        }
            
            logger.debug(f"Nenhum código OTP encontrado no email: {subject}")
            return None
            
        except Exception as e:
            logger.error(f"Erro ao processar email {email_id}: {e}")
            return None
    
    def _get_email_body(self, email_message) -> str:
        """Extrai o corpo do email (texto plano ou HTML)"""
        body = ""
        
        if email_message.is_multipart():
            for part in email_message.walk():
                content_type = part.get_content_type()
                content_disposition = str(part.get("Content-Disposition"))
                
                if "attachment" not in content_disposition:
                    if content_type == "text/plain":
                        charset = part.get_content_charset() or 'utf-8'
                        try:
                            body += part.get_payload(decode=True).decode(charset)
                        except:
                            body += str(part.get_payload())
                    elif content_type == "text/html":
                        charset = part.get_content_charset() or 'utf-8'
                        try:
                            html_content = part.get_payload(decode=True).decode(charset)
                            # Remove tags HTML básicas
                            body += re.sub('<[^<]+?>', ' ', html_content)
                        except:
                            pass
        else:
            content_type = email_message.get_content_type()
            if content_type in ["text/plain", "text/html"]:
                charset = email_message.get_content_charset() or 'utf-8'
                try:
                    content = email_message.get_payload(decode=True).decode(charset)
                    if content_type == "text/html":
                        body = re.sub('<[^<]+?>', ' ', content)
                    else:
                        body = content
                except:
                    body = str(email_message.get_payload())
        
        return body
    
    def wait_for_vfs_otp(self, max_wait_time: int = 120, check_interval: int = 15) -> Optional[str]:
        """
        Monitora o Gmail aguardando código OTP do VFS
        
        Args:
            max_wait_time: Tempo máximo de espera em segundos
            check_interval: Intervalo entre verificações
        
        Returns:
            Código OTP encontrado ou None
        """
        if not self.connect():
            return None
        
        try:
            start_time = time.time()
            logger.info(f"Monitorando Gmail {self.email_address} para código OTP do VFS...")
            
            while time.time() - start_time < max_wait_time:
                logger.info("Verificando novos emails...")
                
                # Busca emails recentes
                email_ids = self.search_vfs_emails(days_back=1)
                
                if email_ids:
                    # Processa emails do mais recente para o mais antigo
                    for email_id in reversed(email_ids[-10:]):  # Últimos 10 emails
                        otp_info = self.extract_otp_from_email(email_id)
                        if otp_info:
                            logger.success(f"Código OTP do VFS encontrado: {otp_info['otp']}")
                            logger.info(f"Assunto: {otp_info['subject']}")
                            logger.info(f"Remetente: {otp_info['sender']}")
                            return otp_info['otp']
                
                remaining_time = int(max_wait_time - (time.time() - start_time))
                if remaining_time > 0:
                    logger.info(f"Aguardando {check_interval}s... (restam {remaining_time}s)")
                    time.sleep(check_interval)
                else:
                    break
            
            logger.warning("Tempo limite atingido. Nenhum código OTP encontrado.")
            return None
            
        except Exception as e:
            logger.error(f"Erro durante monitoramento: {e}")
            return None
        finally:
            self.disconnect()

def get_vfs_otp_from_gmail(gmail_email: str, gmail_password: str, wait_time: int = 120) -> str:
    """Obtém código OTP do VFS via Gmail"""
    try:
        extractor = VFSOTPExtractor(gmail_email, gmail_password)
        otp_code = extractor.wait_for_vfs_otp(max_wait_time=wait_time, check_interval=15)
        return otp_code
    except Exception as e:
        logger.error(f"Erro obtendo OTP do Gmail: {e}")
        return None

async def check_trial_status():
    """Verifica status do trial e saldo"""
    logger.info("Verificando status do trial SurfSky...")
    async with httpx.AsyncClient(timeout=30, verify=False) as client:
        headers = {"X-Cloud-Api-Token": API_KEY}
        try:
            # Verifica saldo restante
            resp_data = await client.get(f"{PROXIES_BASE_URL}/remaining-data", headers=headers)
            if resp_data.status_code == 200:
                data = resp_data.json().get('data', {})
                remaining_gb = data.get('remaining_gb', 0)
                logger.info(f"Saldo restante: {remaining_gb} GB")
                
                if remaining_gb <= 0:
                    logger.error("TRIAL EXPIRADO! Saldo: 0 GB")
                    return False
                else:
                    logger.success(f"Trial ativo: {remaining_gb} GB disponíveis")
                    return True
            else:
                logger.warning(f"Erro verificando saldo: {resp_data.status_code}")
                return False
                
        except Exception as e:
            logger.error(f"Erro verificando trial: {e}")
            return False

async def create_surfsky_profile_with_fallback():
    """Cria perfil com fallback para diferentes países"""
    countries_to_try = ["pt", "es", "fr", "de"]
    
    for country in countries_to_try:
        try:
            logger.info(f"Tentando criar perfil com proxy: {country.upper()}")
            
            async with httpx.AsyncClient(timeout=60, verify=False) as client:
                payload = {
                    "fingerprint": {"os": "win"},
                    "proxy": {"country": country}
                }
                
                response = await client.post(
                    ONE_TIME_URL,
                    headers={"Content-Type": "application/json", "X-Cloud-Api-Token": API_KEY},
                    json=payload
                )
                
                if response.status_code == 200:
                    profile_data = response.json()
                    logger.success(f"Perfil criado com proxy {country.upper()}!")
                    return profile_data
                else:
                    logger.warning(f"Falha com {country}: {response.status_code}")
                    continue
                    
        except Exception as e:
            logger.warning(f"Erro com proxy {country}: {e}")
            continue
    
    # Se todos os proxies falharam, tenta sem proxy
    logger.warning("Todos os proxies falharam - tentando SEM PROXY")
    try:
        async with httpx.AsyncClient(timeout=60, verify=False) as client:
            payload = {"fingerprint": {"os": "win"}}
            
            response = await client.post(
                ONE_TIME_URL,
                headers={"Content-Type": "application/json", "X-Cloud-Api-Token": API_KEY},
                json=payload
            )
            
            if response.status_code == 200:
                profile_data = response.json()
                logger.warning("Perfil criado SEM PROXY - risco de bloqueio geográfico!")
                return profile_data
    except Exception as e:
        logger.error(f"Falha total criando perfil: {e}")
        raise

async def enhanced_page_load(page, url, max_retries=3):
    """Carregamento de página com retry e diferentes estratégias"""
    logger.info(f"Carregando página: {url}")
    
    strategies = ['domcontentloaded', 'networkidle', 'load']
    
    for attempt in range(max_retries):
        for strategy in strategies:
            try:
                logger.info(f"Tentativa {attempt + 1}/{max_retries} com estratégia '{strategy}'")
                
                await page.goto(url, wait_until=strategy, timeout=45000)
                logger.success(f"Página carregada com '{strategy}'")
                
                await asyncio.sleep(2)
                current_url = page.url
                
                if "visa.vfsglobal.com" in current_url and "error" not in current_url.lower():
                    logger.success("Página VFS carregada com sucesso!")
                    return True
                else:
                    logger.warning(f"URL suspeita após carregamento: {current_url}")
                    
            except Exception as e:
                logger.warning(f"Falha com '{strategy}': {e}")
                continue
        
        if attempt < max_retries - 1:
            wait_time = (attempt + 1) * 5
            logger.info(f"Aguardando {wait_time}s antes de tentar novamente...")
            await asyncio.sleep(wait_time)
    
    logger.error("Falha em todas as tentativas de carregamento")
    return False

async def accept_cookies(page, cdp_client):
    """Aceita cookies se necessário"""
    try:
        await page.wait_for_selector('#onetrust-accept-btn-handler', timeout=10000)
        await cdp_client.send("Human.click", {"selector": "#onetrust-accept-btn-handler"})
        logger.info('Cookies aceitos')
        await asyncio.sleep(2)
    except Exception:
        logger.debug('Consentimento de cookies não necessário')

async def handle_cloudflare_turnstile(page, cdp_client):
    """Lida com o Cloudflare Turnstile"""
    logger.info("Verificando Cloudflare Turnstile...")
    
    try:
        turnstile_frame = await page.wait_for_selector('iframe[src*="challenges.cloudflare.com"]', timeout=40000)
        if turnstile_frame:
            logger.info("Turnstile detectado! Tentando resolver...")
            
            await asyncio.sleep(3)
            
            bbox = await turnstile_frame.bounding_box()
            if bbox:
                center_x = bbox['x'] + bbox['width'] / 2
                center_y = bbox['y'] + bbox['height'] / 2
                
                logger.info(f"Clicando no Turnstile em ({center_x}, {center_y})")
                await cdp_client.send("Human.click", {"x": center_x, "y": center_y})
                
                await asyncio.sleep(2)
                
                logger.info("Aguardando resolução do Turnstile...")
                resolved = False
                
                for attempt in range(60):
                    try:
                        turnstile_response = await page.evaluate("""
                            () => {
                                const input = document.querySelector('input[name="cf-turnstile-response"]');
                                return input ? input.value : null;
                            }
                        """)
                        
                        if turnstile_response and len(turnstile_response) > 10:
                            logger.success(f"Turnstile resolvido! Response: {turnstile_response[:50]}...")
                            resolved = True
                            break
                            
                        iframe_visible = await page.evaluate("""
                            () => {
                                const iframe = document.querySelector('iframe[src*="challenges.cloudflare.com"]');
                                return iframe && iframe.style.display !== 'none';
                            }
                        """)
                        
                        if not iframe_visible:
                            logger.success("Turnstile iframe desapareceu - provavelmente resolvido!")
                            resolved = True
                            break
                            
                        await asyncio.sleep(1)
                        
                    except Exception as e:
                        logger.debug(f"Erro verificando turnstile: {e}")
                        continue
                
                return resolved
            else:
                logger.error("Não foi possível obter dimensões do turnstile")
                return False
        else:
            logger.debug("Nenhum turnstile detectado")
            return True
            
    except Exception as e:
        logger.debug(f"Turnstile não detectado ou erro: {e}")
        return True

async def add_human_behavior(page, cdp_client):
    """Adiciona comportamentos humanos para evitar detecção"""
    try:
        await cdp_client.send("Human.move", {
            "x": random.randint(100, 800), 
            "y": random.randint(100, 600)
        })
        await asyncio.sleep(random.uniform(0.5, 1.5))
        
        await page.evaluate(f"window.scrollBy(0, {random.randint(-100, 100)})")
        await asyncio.sleep(random.uniform(0.3, 0.8))
        
        await asyncio.sleep(random.uniform(2, 4))
        
    except Exception as e:
        logger.debug(f"Erro adicionando comportamento humano: {e}")
async def handle_form_transition_and_otp(page, cdp_client, credentials):
    """
    Detecta transição de formulário login -> OTP na mesma URL
    e lida com segundo Cloudflare Turnstile
    """
    logger.info("Aguardando transição do formulário login para OTP...")

    # Aguarda até 10 segundos para a página OTP carregar
    try:
        await page.wait_for_selector('input[placeholder*="one time password"]', timeout=40000)
        logger.success("Formulário OTP detectado com sucesso!")
        await page.screenshot(path='screenshots/05-otp-form-detected.png')
    except Exception as e:
        logger.error(f"Timeout ou erro ao detectar formulário OTP: {e}")
        await page.screenshot(path='screenshots/error-no-otp-form.png')
        return False

    # Verifica a presença do Turnstile (checkbox "Confirme que é humano")
    try:
        await page.wait_for_selector('input[type="checkbox"] + span:has-text("Confirme que é humano")', timeout=10000)
        logger.info("Cloudflare Turnstile detectado no formulário OTP.")
    except Exception:
        logger.warning("Turnstile não detectado ou não visível.")

    # Adiciona comportamento humano
    await add_human_behavior(page, cdp_client)

    # RESOLVE SEGUNDO CLOUDFLARE TURNSTILE
    logger.info("Resolvendo Cloudflare Turnstile no formulário OTP...")
    turnstile_resolved = await handle_cloudflare_turnstile(page, cdp_client)
    if turnstile_resolved:
        logger.success("Segundo Turnstile resolvido")
    else:
        logger.warning("Segundo Turnstile pode não ter sido resolvido completamente")

    await asyncio.sleep(2)

    # OBTER CÓDIGO OTP DO GMAIL
    logger.info(f"Obtendo código OTP do Gmail: {credentials.gmail_email}")
    otp_code = get_vfs_otp_from_gmail(credentials.gmail_email, credentials.gmail_password, wait_time=120)

    if not otp_code:
        logger.error("Não foi possível obter código OTP do Gmail")
        await page.screenshot(path='screenshots/error-no-otp-code.png')
        return False

    logger.success(f"Código OTP obtido: {otp_code}")

    # PREENCHER CAMPO OTP
    logger.info("Preenchendo campo OTP...")
    try:
        await page.wait_for_selector('input[placeholder*="one time password"]', timeout=5000)
        await cdp_client.send("Human.click", {"selector": 'input[placeholder*="one time password"]'})
        await asyncio.sleep(1)
        await page.keyboard.press('Control+a')
        await asyncio.sleep(0.5)
        await cdp_client.send("Human.type", {"text": otp_code})
        logger.success("Código OTP inserido")
    except Exception as e:
        logger.error(f"Erro ao preencher campo OTP: {e}")
        await page.screenshot(path='screenshots/error-otp-field-not-found.png')
        return False

    await page.screenshot(path='screenshots/06-otp-entered.png')
    await asyncio.sleep(2)

    # AGUARDAR TURNSTILE RESOLVER COMPLETAMENTE
    logger.info("Aguardando Turnstile resolver completamente antes de submeter...")
    for wait_count in range(15):  # Reduzido para 15 segundos
        turnstile_response = await page.evaluate("""
            () => {
                const input = document.querySelector('input[name="cf-turnstile-response"]');
                return input ? input.value : null;
            }
        """)
        if turnstile_response and len(turnstile_response) > 10:
            logger.success("Turnstile completamente resolvido!")
            break
        logger.info(f"Aguardando Turnstile... ({wait_count + 1}/15)")
        await asyncio.sleep(1)

    # SUBMETER FORMULÁRIO OTP
    logger.info("Submetendo código OTP...")
    submit_selectors = ['button:has-text("Sign In")']
    submitted = False
    for selector in submit_selectors:
        try:
            button = await page.query_selector(selector)
            if button and not await button.evaluate("el => el.disabled"):
                await cdp_client.send("Human.click", {"selector": selector})
                logger.success(f"Formulário OTP submetido via: {selector}")
                submitted = True
                break
        except Exception as e:
            logger.debug(f"Botão {selector} falhou: {e}")
            continue

    if not submitted:
        logger.error("Não foi possível submeter o formulário OTP!")
        await page.screenshot(path='screenshots/error-submit-failed.png')
        return False

    # AGUARDAR E FAZER SCREENSHOT FINAL
    logger.info("Aguardando resposta após submeter OTP...")
    await asyncio.sleep(5)  # Reduzido para 5 segundos
    await page.screenshot(path='screenshots/07-final-after-otp-submit.png')
    logger.success("Screenshot final salvo! Processo OTP concluído.")

    # VERIFICAR RESULTADO
    current_url = page.url
    page_content = await page.evaluate("() => document.body.innerText.toLowerCase()")

    logger.info(f"URL final: {current_url}")
    if "dashboard" in current_url or "dashboard" in page_content:
        logger.success("LOGIN COMPLETO - Dashboard detectado!")
        return True
    elif "error" in page_content or "invalid" in page_content:
        logger.error("Possível erro no código OTP")
        return False
    else:
        logger.info("Status incerto - verificar screenshot final")
        return True
        
async def login_account_enhanced_v2(page, cdp_client, credentials):
    """Versão melhorada do login que detecta transição de formulário"""
    
    # Verifica proxy
    try:
        await page.goto("https://httpbin.org/ip", timeout=15000)
        ip_content = await page.content()
        logger.info(f"IP atual: {ip_content[:100]}...")
    except:
        logger.warning("Não foi possível verificar IP")
    
    url = "https://visa.vfsglobal.com/ago/en/prt/login"
    
    # Carrega página de login
    page_loaded = await enhanced_page_load(page, url)
    if not page_loaded:
        logger.error("Não foi possível carregar página de login")
        return False
    
    await asyncio.sleep(3)
    await page.screenshot(path='screenshots/01-page-loaded.png')
    
    # Aceita cookies
    await accept_cookies_improved(page, cdp_client)
    
    # Preenche formulário de login
    logger.info("Preenchendo formulário de login...")
    
    try:
        # Email
        await page.wait_for_selector("#email", timeout=30000)
        await cdp_client.send("Human.click", {"selector": "#email"})
        await asyncio.sleep(1)
        await cdp_client.send("Human.type", {"text": credentials.email})
        logger.success(f"Email inserido: {credentials.email}")
        
        # Senha
        await page.wait_for_selector("#password", timeout=30000)
        await cdp_client.send("Human.click", {"selector": "#password"})
        await asyncio.sleep(1)
        await cdp_client.send("Human.type", {"text": credentials.password})
        logger.success("Senha inserida")
        
        await page.screenshot(path='screenshots/02-credentials-entered.png')
        await asyncio.sleep(2)
        
        # Resolve primeiro Turnstile
        logger.info("Resolvendo primeiro Cloudflare Turnstile...")
        turnstile_resolved = await handle_cloudflare_turnstile(page, cdp_client)
        if turnstile_resolved:
            logger.success("Primeiro Turnstile resolvido")
        
        # Aguarda botão ser habilitado
        try:
            await page.wait_for_function("""
                () => {
                    const btn = document.querySelector('button.btn-brand-orange, button[type="submit"]');
                    return btn && !btn.disabled;
                }
            """, timeout=30000)
            logger.success("Botão de login habilitado")
        except:
            logger.warning("Botão pode não estar habilitado")
        
        # Submete formulário de login
        submit_selectors = ["button.btn-brand-orange", "button[type='submit']"]
        
        for selector in submit_selectors:
            try:
                await cdp_client.send("Human.click", {"selector": selector})
                logger.success("Formulário de login submetido")
                break
            except:
                continue
        
        await page.screenshot(path='screenshots/03-login-submitted.png')
        
        # NOVA LÓGICA: Aguarda transição de formulário e lida com OTP
        otp_success = await handle_form_transition_and_otp_fixed(page, cdp_client, credentials)
        return otp_success
        
    except Exception as e:
        logger.error(f"Erro durante processo de login: {e}")
        await page.screenshot(path='screenshots/error-login-process.png')
        return False

async def main_enhanced_v2(credentials):
    """Função principal com nova lógica de detecção de formulário"""
    logger.info("=== INICIANDO VFS COM DETECÇÃO MELHORADA DE FORMULÁRIO OTP ===")
    logger.info(f"Email VFS: {credentials.email}")
    logger.info(f"Gmail OTP: {credentials.gmail_email}")
    
    # Verifica trial
    trial_ok = await check_trial_status()
    if not trial_ok:
        logger.warning("Problema com trial - continuando...")
    
    browser = None
    try:
        # Cria perfil
        profile = await create_surfsky_profile_with_fallback()
        
        async with async_playwright() as p:
            logger.info("Conectando ao browser...")
            browser = await p.chromium.connect_over_cdp(profile["ws_url"])
            context = browser.contexts[0]
            page = context.pages[0] if context.pages else await context.new_page()
            cdp_client = await context.new_cdp_session(page)
            
            # Login com nova lógica
            login_success = await login_account_enhanced_v2(page, cdp_client, credentials)
            
            if login_success:
                logger.success("=== PROCESSO DE LOGIN E OTP CONCLUÍDO ===")
                logger.info("Verificar screenshot: screenshots/07-final-after-otp-submit.png")
                logger.info("Browser permanecerá aberto por 5 minutos para verificação manual...")
                
                # Pausa para verificação manual
                await asyncio.sleep(300)  # 5 minutos
                return True
            else:
                logger.error("Falha no processo de login/OTP")
                return False
                
    except Exception as e:
        logger.error(f"Erro durante automação: {e}")
        return False
    finally:
        if browser:
            try:
                await browser.close()
                logger.info("Browser fechado")
            except:
                pass

def test_gmail_connection(gmail_email=None, gmail_password=None):
    """Testa a conexão com o Gmail"""
    if not gmail_email:
        gmail_email = "ad938323460@gmail.com"
    if not gmail_password:
        gmail_password = "whpnyvucdzvnbbsd"
    
    logger.info("=== TESTE DE CONEXÃO GMAIL ===")
    logger.info(f"Testando: {gmail_email}")
    
    try:
        extractor = VFSOTPExtractor(gmail_email, gmail_password)
        if extractor.connect():
            logger.success("Conexão Gmail bem-sucedida!")
            
            # Busca emails recentes para teste
            logger.info("Buscando emails recentes...")
            email_ids = extractor.search_vfs_emails(days_back=7)
            logger.info(f"Encontrados {len(email_ids)} emails nos últimos 7 dias")
            
            extractor.disconnect()
            return True
        else:
            logger.error("Falha na conexão Gmail")
            logger.info("DICAS:")
            logger.info("1. Verifique se a senha está correta")
            logger.info("2. Para Gmail, use uma 'Senha de app' ao invés da senha normal")
            logger.info("3. Ative a autenticação em 2 etapas no Gmail")
            logger.info("4. Gere uma senha de app em: https://myaccount.google.com/apppasswords")
            return False
            
    except Exception as e:
        logger.error(f"Erro testando Gmail: {e}")
        return False

def run_vfs_with_improved_otp_detection():
    """Executa VFS com detecção melhorada de formulário OTP"""
    
    credentials = Credentials(
        email="ad938323460@gmail.com",
        password="941Adilson@",
        gmail_email="ad938323460@gmail.com", 
        gmail_password="whpnyvucdzvnbbsd"
    )
    
    logger.info("=== VFS COM DETECÇÃO MELHORADA DE FORMULÁRIO ===")
    logger.info("Recursos:")
    logger.info("- Detecta transição login -> OTP na mesma URL")  
    logger.info("- Resolve segundo Cloudflare Turnstile")
    logger.info("- Para após submeter OTP para verificação manual")
    logger.info("- Screenshots de cada etapa")
    logger.info("================================================")
    
    try:
        loop = asyncio.get_event_loop()
        if loop.is_running():
            import nest_asyncio
            nest_asyncio.apply()
    except RuntimeError:
        pass
    
    return asyncio.run(main_enhanced_v2(credentials))

# ==============================================
# INSTRUÇÕES DE USO ATUALIZADAS
# ==============================================
print(f"""
🔧 SCRIPT VFS COM DETECÇÃO MELHORADA DE FORMULÁRIO OTP

✅ NOVA FUNCIONALIDADE PRINCIPAL:
- Detecta quando formulário muda de LOGIN para OTP na mesma URL
- Resolve segundo Cloudflare Turnstile no formulário OTP
- Para após submeter código OTP para verificação manual

📧 CONFIGURAÇÃO:
- Email VFS: ad938323460@gmail.com
- Senha VFS: 941Adilson@  
- Gmail OTP: ad938323460@gmail.com
- Senha Gmail: whpnyvucdzvnbbsd (senha de app)

🚀 FLUXO COMPLETO:
1. Login VFS → Turnstile 1 → Submit
2. Detecta transição para formulário OTP (mesma URL)
3. Resolve Turnstile 2 no formulário OTP
4. Obtém código OTP do Gmail via IMAP
5. Preenche e submete código OTP
6. Para por 5 minutos para verificação manual

⚡ COMANDOS:

1. TESTAR GMAIL:
   test_gmail_connection()

2. EXECUTAR PROCESSO COMPLETO:
   run_vfs_with_improved_otp_detection()

📸 SCREENSHOTS GERADOS:
- 01-page-loaded.png: Página inicial
- 02-credentials-entered.png: Credenciais inseridas
- 03-login-submitted.png: Login submetido
- 05-otp-form-detected.png: Formulário OTP detectado
- 06-otp-entered.png: Código OTP inserido
- 07-final-after-otp-submit.png: Estado final (VERIFICAR ESTE!)

🎯 MELHORIAS ESPECÍFICAS:
- Detecta mudança de formulário sem mudança de URL
- Não confunde campo de senha do login com campo OTP
- Aguarda Turnstile resolver completamente antes de submeter
- Para automaticamente após OTP para verificação manual
- Debug detalhado com screenshots de cada etapa

🔧 EXECUÇÃO RÁPIDA:
run_vfs_with_improved_otp_detection()
""")

# Para executar diretamente
if __name__ == "__main__":
    run_vfs_with_improved_otp_detection()