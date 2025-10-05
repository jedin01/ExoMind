@extends('layouts.admin.body')

@section('titulo',"Dashboard")

@section('conteudo')

<!-- Cards de Estatísticas Principais -->
<div class="row mb-4">
    <div class="col-xl-3 col-sm-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="card-info">
                        <p class="card-text">Total de Obras</p>
                        <div class="d-flex align-items-end mb-2">
                            <h4 class="card-title mb-0 me-2">{{ $totalObras }}</h4>
                            <small class="text-success">{{ $totalObrasAtivas }} ativas</small>
                        </div>
                    </div>
                    <div class="card-icon">
                        <span class="badge bg-label-primary rounded p-2">
                            <i class="bx bx-image bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-sm-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="card-info">
                        <p class="card-text">Projectos</p>
                        <div class="d-flex align-items-end mb-2">
                            <h4 class="card-title mb-0 me-2">{{ $totalProjectos }}</h4>
                            <small class="text-info">{{ count($categorias) }} categorias</small>
                        </div>
                    </div>
                    <div class="card-icon">
                        <span class="badge bg-label-info rounded p-2">
                            <i class="bx bx-briefcase bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-sm-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="card-info">
                        <p class="card-text">Assinantes Newsletter</p>
                        <div class="d-flex align-items-end mb-2">
                            <h4 class="card-title mb-0 me-2">{{ $totalAssinantes }}</h4>
                            <small class="text-success">+{{ $novosAssinantes }} este mês</small>
                        </div>
                    </div>
                    <div class="card-icon">
                        <span class="badge bg-label-success rounded p-2">
                            <i class="bx bx-envelope bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-sm-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="card-info">
                        <p class="card-text">Idiomas Ativos</p>
                        <div class="d-flex align-items-end mb-2">
                            <h4 class="card-title mb-0 me-2">{{ $totalIdiomas }}</h4>
                            <small class="text-muted">Multilíngue</small>
                        </div>
                    </div>
                    <div class="card-icon">
                        <span class="badge bg-label-warning rounded p-2">
                            <i class="bx bx-globe bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Gráfico de Obras por Categoria -->
    <div class="col-xxl-6 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title mb-0">Obras por Categoria</h5>
                <div class="dropdown">
                    <button class="btn p-0" type="button" id="obrasPorCategoria" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="obrasPorCategoria">
                        <a class="dropdown-item" href="{{ route('admin.obra.index') }}">Ver todas as obras</a>
                        <a class="dropdown-item" href="{{ route('admin.categoria_obra.index') }}">Gerir categorias</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="obrasCategoriaChart"></div>
            </div>
        </div>
    </div>

    <!-- Gráfico de Projectos por Categoria -->
    <div class="col-xxl-6 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title mb-0">Projectos por Categoria</h5>
                <div class="dropdown">
                    <button class="btn p-0" type="button" id="projectosCategoria" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="projectosCategoria">
                        <a class="dropdown-item" href="{{ route('admin.projecto.index') }}">Ver todos os projectos</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="projectosCategoriaChart"></div>
            </div>
        </div>
    </div>

    <!-- Conteúdo Multilíngue -->
    <div class="col-xxl-8 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title mb-0">Distribuição de Conteúdo por Idioma</h5>
            </div>
            <div class="card-body">
                <div id="conteudoIdiomaChart"></div>
            </div>
        </div>
    </div>

    <!-- Atividades Recentes -->
    <div class="col-xxl-4 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title mb-0">Atividades Recentes</h5>
                <a href="{{ route('admin.log.index') }}" class="btn btn-sm btn-label-primary">Ver todos</a>
            </div>
            <div class="card-body">
                <ul class="timeline mb-0">
                    @foreach($atividadesRecentes as $atividade)
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-primary"></span>
                        <div class="timeline-event">
                            <div class="timeline-header mb-1">
                                <h6 class="mb-0">{{ $atividade->user->vc_name }}</h6>
                                <small class="text-muted">{{ $atividade->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-0">{{ Str::limit($atividade->lt_description, 60) }}</p>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Banners Ativos -->
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Banners Ativos no Site</h5>
                <a href="{{ route('admin.banner.index') }}" class="btn btn-sm btn-primary">
                    <i class="bx bx-plus me-1"></i>Adicionar Banner
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse($bannersAtivos as $banner)
                    <div class="col-md-4 mb-3">
                        <div class="card border">
                            <img src="{{ asset($banner->vc_caminho) }}" class="card-img-top" alt="Banner" style="max-height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h6 class="card-title">{{ $banner->textoBanners->first()->vc_titulo ?? 'Sem título' }}</h6>
                                <span class="badge bg-success">Ativo</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-info mb-0">
                            <i class="bx bx-info-circle me-2"></i>Nenhum banner ativo no momento
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dados dinâmicos do Laravel
    const obrasPorCategoria = {!! json_encode($obrasPorCategoria) !!};
    const projectosPorCategoria = {!! json_encode($projectosPorCategoria) !!};
    const conteudoPorIdioma = {!! json_encode($conteudoPorIdioma) !!};

    // 1. Gráfico de Obras por Categoria (Donut)
    const obrasCategoriaOptions = {
        series: obrasPorCategoria.map(item => item.total),
        chart: {
            type: 'donut',
            height: 350
        },
        labels: obrasPorCategoria.map(item => item.categoria_nome),
        colors: ['#696cff', '#8592a3', '#71dd37', '#ffab00', '#ff3e1d', '#03c3ec'],
        legend: {
            position: 'bottom',
            offsetY: 0
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '70%',
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            fontSize: '18px'
                        },
                        value: {
                            show: true,
                            fontSize: '24px',
                            fontWeight: 600
                        },
                        total: {
                            show: true,
                            label: 'Total de Obras',
                            fontSize: '14px',
                            formatter: function (w) {
                                return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                            }
                        }
                    }
                }
            }
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + " obras";
                }
            }
        }
    };

    const obrasCategoriaChart = new ApexCharts(
        document.querySelector("#obrasCategoriaChart"),
        obrasCategoriaOptions
    );
    obrasCategoriaChart.render();

    // 2. Gráfico de Projectos por Categoria (Barras Horizontais)
    const projectosCategoriaOptions = {
        series: [{
            name: 'Projectos',
            data: projectosPorCategoria.map(item => item.total)
        }],
        chart: {
            type: 'bar',
            height: 350,
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                horizontal: true,
                distributed: true
            }
        },
        dataLabels: {
            enabled: false
        },
        colors: ['#696cff', '#8592a3', '#71dd37', '#ffab00', '#ff3e1d'],
        xaxis: {
            categories: projectosPorCategoria.map(item => item.categoria),
            title: {
                text: 'Número de Projectos'
            }
        },
        yaxis: {
            title: {
                text: 'Categorias'
            }
        },
        legend: {
            show: false
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + " projectos";
                }
            }
        }
    };

    const projectosCategoriaChart = new ApexCharts(
        document.querySelector("#projectosCategoriaChart"),
        projectosCategoriaOptions
    );
    projectosCategoriaChart.render();

    // 3. Gráfico de Conteúdo por Idioma (Barras Agrupadas)
    const conteudoIdiomaOptions = {
        series: [
            {
                name: 'Seções',
                data: conteudoPorIdioma.map(item => item.secoes)
            },
            {
                name: 'Textos de Obras',
                data: conteudoPorIdioma.map(item => item.textos_obras)
            },
            {
                name: 'Textos de Projectos',
                data: conteudoPorIdioma.map(item => item.textos_projectos)
            },
            {
                name: 'Textos de Banners',
                data: conteudoPorIdioma.map(item => item.textos_banners)
            }
        ],
        chart: {
            type: 'bar',
            height: 350,
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                horizontal: false,
                columnWidth: '60%',
            }
        },
        dataLabels: {
            enabled: false
        },
        colors: ['#696cff', '#71dd37', '#ffab00', '#ff3e1d'],
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: conteudoPorIdioma.map(item => item.idioma_nome),
            title: {
                text: 'Idiomas'
            }
        },
        yaxis: {
            title: {
                text: 'Quantidade de Conteúdos'
            }
        },
        fill: {
            opacity: 1
        },
        legend: {
            position: 'top',
            horizontalAlign: 'left'
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + " itens";
                }
            }
        }
    };

    const conteudoIdiomaChart = new ApexCharts(
        document.querySelector("#conteudoIdiomaChart"),
        conteudoIdiomaOptions
    );
    conteudoIdiomaChart.render();
});
</script>
@endsection