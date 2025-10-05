<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Controller para gerenciar o Dashboard administrativo.
 * 
 * Fornece estatísticas, gráficos e informações resumidas sobre o sistema.
 */
class DashboardController extends Controller
{
    /**
     * Exibe o dashboard principal com estatísticas e gráficos.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // Obras por Categoria (dados estáticos)
        $obrasPorCategoria = [
            ['categoria_nome' => 'Arquitectura Residencial', 'total' => 45],
            ['categoria_nome' => 'Arquitectura Comercial', 'total' => 38],
            ['categoria_nome' => 'Interiores', 'total' => 32],
            ['categoria_nome' => 'Urbanismo', 'total' => 28],
            ['categoria_nome' => 'Reabilitação', 'total' => 22],
            ['categoria_nome' => 'Design Industrial', 'total' => 18]
        ];

        // Projectos por Categoria (dados estáticos)
        $projectosPorCategoria = [
            ['categoria' => 'Em Desenvolvimento', 'total' => 15],
            ['categoria' => 'Concluído', 'total' => 42],
            ['categoria' => 'Em Planeamento', 'total' => 8],
            ['categoria' => 'Em Construção', 'total' => 12],
            ['categoria' => 'Premiado', 'total' => 6]
        ];

        // Conteúdo por Idioma (dados estáticos)
        $conteudoPorIdioma = [
            [
                'idioma_nome' => 'Português',
                'idioma_abreviatura' => 'PT',
                'secoes' => 24,
                'textos_obras' => 183,
                'textos_projectos' => 77,
                'textos_banners' => 8
            ],
            [
                'idioma_nome' => 'Inglês',
                'idioma_abreviatura' => 'EN',
                'secoes' => 24,
                'textos_obras' => 183,
                'textos_projectos' => 77,
                'textos_banners' => 8
            ],
            [
                'idioma_nome' => 'Espanhol',
                'idioma_abreviatura' => 'ES',
                'secoes' => 18,
                'textos_obras' => 145,
                'textos_projectos' => 54,
                'textos_banners' => 6
            ],
            [
                'idioma_nome' => 'Francês',
                'idioma_abreviatura' => 'FR',
                'secoes' => 12,
                'textos_obras' => 98,
                'textos_projectos' => 32,
                'textos_banners' => 4
            ]
        ];

        // Atividades Recentes (dados estáticos)
        $atividadesRecentes = [
            (object)[
                'user' => (object)['vc_name' => 'João Silva'],
                'lt_description' => 'Criou uma nova obra na categoria Arquitectura Residencial',
                'created_at' => now()->subMinutes(15)
            ],
            (object)[
                'user' => (object)['vc_name' => 'Maria Santos'],
                'lt_description' => 'Atualizou o projecto "Edifício Central"',
                'created_at' => now()->subHours(2)
            ],
            (object)[
                'user' => (object)['vc_name' => 'Pedro Costa'],
                'lt_description' => 'Adicionou tradução em Espanhol para Banner Principal',
                'created_at' => now()->subHours(5)
            ],
            (object)[
                'user' => (object)['vc_name' => 'Ana Ferreira'],
                'lt_description' => 'Publicou novo banner na página inicial',
                'created_at' => now()->subDay()
            ],
            (object)[
                'user' => (object)['vc_name' => 'Carlos Mendes'],
                'lt_description' => 'Removeu obra antiga da categoria Interiores',
                'created_at' => now()->subDays(2)
            ]
        ];

        // Banners Ativos (dados estáticos)
        $bannersAtivos = [
            (object)[
                'vc_caminho' => '/storage/banners/banner1.jpg',
                'textoBanners' => collect([
                    (object)['vc_titulo' => 'Novos Projectos 2025']
                ])
            ],
            (object)[
                'vc_caminho' => '/storage/banners/banner2.jpg',
                'textoBanners' => collect([
                    (object)['vc_titulo' => 'Arquitectura Sustentável']
                ])
            ],
            (object)[
                'vc_caminho' => '/storage/banners/banner3.jpg',
                'textoBanners' => collect([
                    (object)['vc_titulo' => 'Prémios e Reconhecimentos']
                ])
            ]
        ];

        // Estatísticas gerais
        $totalObras = collect($obrasPorCategoria)->sum('total');
        $totalObrasAtivas = round($totalObras * 0.85); // 85% das obras estão ativas
        $totalProjectos = collect($projectosPorCategoria)->sum('total');
        $totalAssinantes = 1247;
        $novosAssinantes = 34;
        $totalIdiomas = count($conteudoPorIdioma);
        $categorias = collect($projectosPorCategoria)->pluck('categoria')->toArray();

        return view('admin.index', compact(
            'obrasPorCategoria',
            'projectosPorCategoria',
            'conteudoPorIdioma',
            'atividadesRecentes',
            'bannersAtivos',
            'totalObras',
            'totalObrasAtivas',
            'totalProjectos',
            'totalAssinantes',
            'novosAssinantes',
            'totalIdiomas',
            'categorias'
        ));
    }

    /**
     * Obtém estatísticas de crescimento mensal.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCrescimentoMensal()
    {
        try {
            $crescimento = [
                'obras' => [
                    ['periodo' => 'Abr/25', 'total' => 12],
                    ['periodo' => 'Mai/25', 'total' => 18],
                    ['periodo' => 'Jun/25', 'total' => 15],
                    ['periodo' => 'Jul/25', 'total' => 22],
                    ['periodo' => 'Ago/25', 'total' => 19],
                    ['periodo' => 'Set/25', 'total' => 25]
                ],
                'projectos' => [
                    ['periodo' => 'Abr/25', 'total' => 5],
                    ['periodo' => 'Mai/25', 'total' => 8],
                    ['periodo' => 'Jun/25', 'total' => 6],
                    ['periodo' => 'Jul/25', 'total' => 10],
                    ['periodo' => 'Ago/25', 'total' => 7],
                    ['periodo' => 'Set/25', 'total' => 12]
                ],
                'assinantes' => [
                    ['periodo' => 'Abr/25', 'total' => 45],
                    ['periodo' => 'Mai/25', 'total' => 62],
                    ['periodo' => 'Jun/25', 'total' => 78],
                    ['periodo' => 'Jul/25', 'total' => 89],
                    ['periodo' => 'Ago/25', 'total' => 103],
                    ['periodo' => 'Set/25', 'total' => 124]
                ]
            ];

            return response()->json($crescimento, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Erro ao obter dados de crescimento',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Obtém um resumo executivo do sistema.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getResumoExecutivo()
    {
        try {
            $resumo = [
                'conteudo' => [
                    'obras' => 183,
                    'projectos' => 83,
                    'banners_ativos' => 3,
                    'categorias_obra' => 6
                ],
                'multilinguismo' => [
                    'idiomas_disponiveis' => 4,
                    'conteudos_traduzidos' => 1468,
                    'cobertura_traducao' => '92%'
                ],
                'engajamento' => [
                    'assinantes_newsletter' => 1247,
                    'novos_mes_atual' => 34,
                    'taxa_crescimento' => '+2.8%'
                ],
                'redes_sociais' => [
                    'total_redes' => 5,
                    'ultima_atualizacao' => now()->subDays(3)->format('d/m/Y')
                ]
            ];

            return response()->json($resumo, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Erro ao obter resumo executivo',
                'message' => $th->getMessage()
            ], 500);
        }
    }
}