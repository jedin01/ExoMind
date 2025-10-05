<script type="text/javascript">
        var gk_isXlsx = false;
        var gk_xlsxFileLookup = {};
        var gk_fileData = {};
        function filledCell(cell) {
          return cell !== '' && cell != null;
        }
        function loadFileData(filename) {
        if (gk_isXlsx && gk_xlsxFileLookup[filename]) {
            try {
                var workbook = XLSX.read(gk_fileData[filename], { type: 'base64' });
                var firstSheetName = workbook.SheetNames[0];
                var worksheet = workbook.Sheets[firstSheetName];

                // Convert sheet to JSON to filter blank rows
                var jsonData = XLSX.utils.sheet_to_json(worksheet, { header: 1, blankrows: false, defval: '' });
                // Filter out blank rows (rows where all cells are empty, null, or undefined)
                var filteredData = jsonData.filter(row => row.some(filledCell));

                // Heuristic to find the header row by ignoring rows with fewer filled cells than the next row
                var headerRowIndex = filteredData.findIndex((row, index) =>
                  row.filter(filledCell).length >= filteredData[index + 1]?.filter(filledCell).length
                );
                // Fallback
                if (headerRowIndex === -1 || headerRowIndex > 25) {
                  headerRowIndex = 0;
                }

                // Convert filtered JSON back to CSV
                var csv = XLSX.utils.aoa_to_sheet(filteredData.slice(headerRowIndex)); // Create a new sheet from filtered array of arrays
                csv = XLSX.utils.sheet_to_csv(csv, { header: 1 });
                return csv;
            } catch (e) {
                console.error(e);
                return "";
            }
        }
        return gk_fileData[filename] || "";
        }
        </script>```html
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Solar 3D Interativo - Nativo com Modelos 3D</title>
    <script type="module" src="{{ asset('js/model-viewer.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/solar-system.css') }}">
</head>
<body>
    <div class="stars" id="stars"></div>
    <div class="solar-system" id="solarSystem">
        <div class="sun planet" data-name="Sol" data-info="O Sol é a estrela central do Sistema Solar. É uma bola de plasma quente alimentada por fusão nuclear no núcleo. Temperatura: ~15 milhões °C no núcleo. <br><table><tr><th>Diâmetro</th><td>1.392.000 km</td></tr><tr><th>Massa</th><td>1,989 x 10^30 kg</td></tr><tr><th>Gravidade</th><td>274 m/s²</td></tr><tr><th>Período de Rotação</th><td>25 dias</td></tr></table>" data-model="{{ asset('models/sun.gltf') }}">
            <model-viewer src="{{ asset('models/sun.gltf') }}" auto-rotate camera-controls alt="Sol"></model-viewer>
            <div class="label">Sol</div>
        </div>
        <div class="mercury-orbit orbit">
            <div class="mercury planet" data-name="Mercúrio" data-info="Mercúrio é o planeta mais próximo do Sol e o menor. Superfície craterada como a Lua, com temperaturas extremas de -173°C a 427°C. Diâmetro: 4.879 km. <br><table><tr><th>Diâmetro</th><td>4.879 km</td></tr><tr><th>Massa</th><td>3,301 x 10^23 kg</td></tr><tr><th>Gravidade</th><td>3,7 m/s²</td></tr><tr><th>Período de Rotação</th><td>58,6 dias</td></tr><tr><th>Órbita</th><td>88 dias</td></tr></table>" data-model="{{ asset('models/mercury.gltf') }}">
                <model-viewer src="{{ asset('models/mercury.gltf') }}" auto-rotate camera-controls alt="Mercúrio"></model-viewer>
                <div class="label">Mercúrio</div>
            </div>
        </div>
        <div class="venus-orbit orbit">
            <div class="venus planet" data-name="Vênus" data-info="Vênus, o planeta irmão da Terra, tem atmosfera densa de CO₂ e é o mais quente, com 465°C. Rotação retrógrada (gira ao contrário). Diâmetro: 12.104 km. <br><table><tr><th>Diâmetro</th><td>12.104 km</td></tr><tr><th>Massa</th><td>4,867 x 10^24 kg</td></tr><tr><th>Gravidade</th><td>8,87 m/s²</td></tr><tr><th>Período de Rotação</th><td>243 dias</td></tr><tr><th>Órbita</th><td>225 dias</td></tr></table>" data-model="{{ asset('models/venus.gltf') }}">
                <model-viewer src="{{ asset('models/venus.gltf') }}" auto-rotate camera-controls alt="Vênus"></model-viewer>
                <div class="label">Vênus</div>
            </div>
        </div>
        <div class="earth-orbit orbit">
            <div class="earth planet" data-name="Terra" data-info="A Terra é o único planeta com vida conhecida. 71% de oceanos, atmosfera rica em O₂, e um dia de 24 horas. Idade: ~4,5 bilhões de anos. <br><table><tr><th>Diâmetro</th><td>12.742 km</td></tr><tr><th>Massa</th><td>5,972 x 10^24 kg</td></tr><tr><th>Gravidade</th><td>9,81 m/s²</td></tr><tr><th>Período de Rotação</th><td>24 horas</td></tr><tr><th>Órbita</th><td>365 dias</td></tr></table>" data-model="{{ asset('models/earth.gltf') }}">
                <model-viewer src="{{ asset('models/earth.gltf') }}" auto-rotate camera-controls alt="Terra"></model-viewer>
                <div class="moon"></div>
                <div class="label">Terra</div>
            </div>
        </div>
        <div class="mars-orbit orbit">
            <div class="mars planet" data-name="Marte" data-info="Marte, o planeta vermelho, tem o vulcão mais alto (Olympus Mons, 22 km) e evidências de rios antigos. Diâmetro: 6.779 km. <br><table><tr><th>Diâmetro</th><td>6.779 km</td></tr><tr><th>Massa</th><td>6,39 x 10^23 kg</td></tr><tr><th>Gravidade</th><td>3,71 m/s²</td></tr><tr><th>Período de Rotação</th><td>24,6 horas</td></tr><tr><th>Órbita</th><td>687 dias</td></tr></table>" data-model="{{ asset('models/mars.gltf') }}">
                <model-viewer src="{{ asset('models/mars.gltf') }}" auto-rotate camera-controls alt="Marte"></model-viewer>
                <div class="label">Marte</div>
            </div>
        </div>
        <div class="jupiter-orbit orbit">
            <div class="jupiter planet" data-name="Júpiter" data-info="Júpiter é o maior planeta, um gigante gasoso com 95 luas. A Grande Mancha Vermelha é uma tempestade de 300 anos. Diâmetro: 142.984 km. <br><table><tr><th>Diâmetro</th><td>142.984 km</td></tr><tr><th>Massa</th><td>1,898 x 10^27 kg</td></tr><tr><th>Gravidade</th><td>24,79 m/s²</td></tr><tr><th>Período de Rotação</th><td>9,9 horas</td></tr><tr><th>Órbita</th><td>4.333 dias</td></tr></table>" data-model="{{ asset('models/jupiter.gltf') }}">
                <model-viewer src="{{ asset('models/jupiter.gltf') }}" auto-rotate camera-controls alt="Júpiter"></model-viewer>
                <div class="label">Júpiter</div>
            </div>
        </div>
        <div class="saturn-orbit orbit">
            <div class="saturn planet" data-name="Saturno" data-info="Saturno é famoso por seus anéis de gelo e rocha (largura: 282.000 km). Segundo maior, com 146 luas. Diâmetro: 120.536 km. <br><table><tr><th>Diâmetro</th><td>120.536 km</td></tr><tr><th>Massa</th><td>5,683 x 10^26 kg</td></tr><tr><th>Gravidade</th><td>10,44 m/s²</td></tr><tr><th>Período de Rotação</th><td>10,7 horas</td></tr><tr><th>Órbita</th><td>10.759 dias</td></tr></table>" data-model="{{ asset('models/saturn.gltf') }}">
                <model-viewer src="{{ asset('models/saturn.gltf') }}" auto-rotate camera-controls alt="Saturno"></model-viewer>
                <div class="rings"></div>
                <div class="label">Saturno</div>
            </div>
        </div>
        <div class="uranus-orbit orbit">
            <div class="uranus planet" data-name="Urano" data-info="Urano é um gigante de gelo com rotação lateral (deitado). Temperatura: -224°C, 28 luas e anéis fracos. Diâmetro: 51.118 km. <br><table><tr><th>Diâmetro</th><td>51.118 km</td></tr><tr><th>Massa</th><td>8,681 x 10^25 kg</td></tr><tr><th>Gravidade</th><td>8,87 m/s²</td></tr><tr><th>Período de Rotação</th><td>17,2 horas</td></tr><tr><th>Órbita</th><td>30.687 dias</td></tr></table>" data-model="{{ asset('models/uranus.gltf') }}">
                <model-viewer src="{{ asset('models/uranus.gltf') }}" auto-rotate camera-controls alt="Urano"></model-viewer>
                <div class="label">Urano</div>
            </div>
        </div>
        <div class="neptune-orbit orbit">
            <div class="neptune planet" data-name="Netuno" data-info="Netuno, o mais distante, tem ventos de 2.100 km/h e 16 luas. Descoberto em 1846. Diâmetro: 49.528 km. <br><table><tr><th>Diâmetro</th><td>49.528 km</td></tr><tr><th>Massa</th><td>1,024 x 10^26 kg</td></tr><tr><th>Gravidade</th><td>11,15 m/s²</td></tr><tr><th>Período de Rotação</th><td>16,1 horas</td></tr><tr><th>Órbita</th><td>60.190 dias</td></tr></table>" data-model="{{ asset('models/neptune.gltf') }}">
                <model-viewer src="{{ asset('models/neptune.gltf') }}" auto-rotate camera-controls alt="Netuno"></model-viewer>
                <div class="label">Netuno</div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="planetModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <model-viewer id="modalModel" class="modal-model" src="" auto-rotate camera-controls alt="Modelo 3D"></model-viewer>
            <h2 id="planetName"></h2>
            <p id="planetInfo"></p>
        </div>
    </div>

    <script>
        // Gerar estrelas dinamicamente
        const starsContainer = document.getElementById('stars');
        for (let i = 0; i < 100; i++) {
            const star = document.createElement('div');
            star.className = 'star';
            star.style.width = `${Math.random() * 3 + 1}px`;
            star.style.height = star.style.width;
            star.style.top = `${Math.random() * 100}%`;
            star.style.left = `${Math.random() * 100}%`;
            star.style.animationDelay = `${Math.random() * 3}s`;
            starsContainer.appendChild(star);
        }

        const solarSystem = document.getElementById('solarSystem');
        const planets = document.querySelectorAll('.planet');
        const modal = document.getElementById('planetModal');
        const planetName = document.getElementById('planetName');
        const planetInfo = document.getElementById('planetInfo');
        const modalModel = document.getElementById('modalModel');
        const closeBtn = document.querySelector('.close');

        let isDragging = false;
        let startX, startY;
        let rotateX = 0, rotateY = 0;
        let scale = 1;
        let startDistance;

        // Rotação com mouse drag
        document.addEventListener('mousedown', (e) => {
            isDragging = true;
            startX = e.clientX;
            startY = e.clientY;
        });

        document.addEventListener('mousemove', (e) => {
            if (isDragging) {
                const deltaX = e.clientX - startX;
                const deltaY = e.clientY - startY;
                rotateY += deltaX * 0.5;
                rotateX -= deltaY * 0.5;
                rotateX = Math.max(-90, Math.min(90, rotateX));
                updateTransform();
                startX = e.clientX;
                startY = e.clientY;
            }
        });

        document.addEventListener('mouseup', () => {
            isDragging = false;
        });

        // Zoom com roda do mouse
        document.addEventListener('wheel', (e) => {
            e.preventDefault();
            const delta = e.deltaY * -0.001;
            scale += delta;
            scale = Math.min(Math.max(0.2, scale), 5);
            updateTransform();
        });

        // Suporte a toque (mobile)
        document.addEventListener('touchstart', (e) => {
            if (e.touches.length === 1) {
                isDragging = true;
                startX = e.touches[0].clientX;
                startY = e.touches[0].clientY;
            }
        });

        document.addEventListener('touchmove', (e) => {
            if (isDragging && e.touches.length === 1) {
                const deltaX = e.touches[0].clientX - startX;
                const deltaY = e.touches[0].clientY - startY;
                rotateY += deltaX * 0.5;
                rotateX -= deltaY * 0.5;
                rotateX = Math.max(-90, Math.min(90, rotateX));
                updateTransform();
                startX = e.touches[0].clientX;
                startY = e.touches[0].clientY;
            } else if (e.touches.length === 2) {
                const dx = e.touches[0].clientX - e.touches[1].clientX;
                const dy = e.touches[0].clientY - e.touches[1].clientY;
                const distance = Math.sqrt(dx * dx + dy * dy);
                if (typeof startDistance === 'undefined') {
                    startDistance = distance;
                }
                scale = Math.min(Math.max(0.2, (distance / startDistance) * scale), 5);
                updateTransform();
            }
        });

        document.addEventListener('touchend', () => {
            isDragging = false;
            startDistance = undefined;
        });

        function updateTransform() {
            solarSystem.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(${scale})`;
        }

        // Clique em planeta para modal
        planets.forEach(planet => {
            planet.addEventListener('click', (e) => {
                e.stopPropagation();
                planetName.textContent = planet.dataset.name;
                planetInfo.innerHTML = planet.dataset.info;
                modalModel.src = planet.dataset.model;
                modal.style.display = 'flex';
            });
        });

        // Fechar modal
        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });
        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });

        // Inicialização
        updateTransform();
        console.log("Sistema Solar 3D Nativo inicializado com sucesso!");
    </script>
</body>
</html>
```