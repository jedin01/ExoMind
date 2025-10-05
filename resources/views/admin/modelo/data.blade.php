<div class="container-fluid">
        <!-- Header da Página -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card ">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-1">Modelos</h4>
                                <p class="mb-0 opacity-75">Gerencie todos os registros de modelo</p>
                            </div>
                            
                            @if ($adicionar)
                                <button 
                                    class="btn btn-primary"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#addModeloModal"
                                >
                                    <i class="bx bx-plus me-1"></i>
                                    Adicionar Modelo
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabela Principal -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header border-bottom">
                        <h5 class="card-title mb-0">
                            <i class="bx bx-table me-2"></i>
                            Lista de Modelos
                        </h5>
                    </div>
                    
                    <div class="card-datatable table-responsive">
                        <table class="datatables-modelo table">
                          <thead class="border-top">
                                <tr>
                                    <th class="text-center" width="80">ID</th>
                                        <th>Nome</th>
                                        <th>Data</th>
                                            <th>Dataset</th>
                                            <th>Categoriamodelo</th>
                                            <th>Treinamento</th>
                                    <th class="text-center" width="120">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $item)
                                    <tr>
                                        <td class="text-center">
                                            <span class="badge bg-label-primary">{{ $item->id }}</span>
                                        </td>
                                        
                                            <td>
                                                    <span class="fw-medium">{{ $item->nome }}</span>
                                            </td>
                                            <td>
                                                    <div class="dropdown">
                                                        <button 
                                                            class="btn btn-link p-0 text-start dropdown-toggle" 
                                                            type="button" 
                                                            data-bs-toggle="dropdown" 
                                                            aria-expanded="false"
                                                            style="text-decoration: none; color: inherit;"
                                                        >
{{ $item->data ? $item->data->format('d/m/Y') : 'N/A' }}                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <span class="dropdown-item-text">
                                                                    <strong>Data Completa:</strong><br>
{{ $item->data ? $item->data->format('d/m/Y') : 'N/A' }}                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                            </td>
                                        
                                            <td>
                                                <span class="text-primary fw-medium">
{{ $item->fk_dataset->nome ?? 'N/A' }}                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-primary fw-medium">
{{ $item->fk_categoria_modelo->nome ?? 'N/A' }}                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-primary fw-medium">
{{ $item->fk_treinamento->nome ?? 'N/A' }}                                                </span>
                                            </td>
                                        
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button 
                                                    class="btn btn-sm btn-outline-primary dropdown-toggle" 
                                                    type="button" 
                                                    data-bs-toggle="dropdown" 
                                                    aria-expanded="false"
                                                >
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a 
                                                            href="{{ route('admin.modelo.show', ['id' => $item->id]) }}" 
                                                            class="dropdown-item"
                                                        >
                                                            <i class="bx bx-show me-2"></i>
                                                            Ver Detalhes
                                                        </a>
                                                    </li>
                                                    @if ($editar)
                                                        <li>
                                                            <a 
                                                                href="#" 
                                                                class="dropdown-item" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#editModeloModal--{{ $item->id }}"
                                                            >
                                                                <i class="bx bx-edit me-2"></i>
                                                                Editar
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if ($remover)
                                                        <li>
                                                            <hr class="dropdown-divider">
                                                        </li>
                                                        <li>
                                                            <a 
                                                                href="#" 
                                                                data-url="{{ route('admin.modelo.destroy', ['id' => $item->id]) }}" 
                                                                class="removeItem dropdown-item text-danger"
                                                            >
                                                                <i class="bx bx-trash me-2"></i>
                                                                Remover
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal de Edição Inline -->
                                    @if ($editar)
                                        <div class="modal fade" id="editModeloModal--{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Editar Modelo</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form 
                                                            method="post" 
                                                            action="{{ route('admin.modelo.update', ['id' => $item->id]) }}" 
                                                            class="row g-3" 
                                                            enctype="multipart/form-data"
                                                        >
                                                            @csrf
                                                            
                                                            
                                                            @include('forms.modelo.index')
                                                            
                                                            <div class="col-12">
                                                                <hr>
                                                            </div>
                                                            <div class="col-12 text-end">
                                                                <button type="button" class="btn btn-label-secondary me-3" data-bs-dismiss="modal">
                                                                    Cancelar
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">
                                                                    <i class="bx bx-check me-1"></i>
                                                                    Atualizar
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="d-flex flex-column align-items-center">
                                                <div class="avatar avatar-xl mb-3">
                                                    <div class="avatar-initial bg-label-secondary rounded-circle">
                                                        <i class="bx bx-search-alt bx-lg"></i>
                                                    </div>
                                                </div>
                                                <h6 class="mb-1">Nenhum Registro Encontrado</h6>
                                                <p class="text-muted mb-0">Não há modelo cadastrados no momento.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Adição -->
        @if ($adicionar)
            <div class="modal fade" id="addModeloModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Adicionar Novo Modelo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <div class="modal-body">
                            <form 
                                class="row g-3" 
                                action="{{ route('admin.modelo.store') }}" 
                                method="post" 
                                enctype="multipart/form-data"
                            >
                                @csrf
                                
                                @php
                                    $item = null;
                                @endphp
                                
                                @include('forms.modelo.index')
                                
                                <div class="col-12">
                                    <hr>
                                </div>
                                
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary me-3">
                                        <i class="bx bx-plus me-1"></i>
                                        Adicionar
                                    </button>
                                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                        Cancelar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>


@section('scripts')
    <!-- Vendors JS -->
    <script src="{{ asset('painel/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('painel/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('painel/assets/vendor/libs/select2/select2.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('painel/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script>
        $(function() {
            // Initialize Select2
            $('.select2').each(function() {
                $(this).select2({
                    dropdownParent: $(this).parent(),
                    placeholder: $(this).data('placeholder') || 'Selecione uma opção'
                });
            });

            // Initialize DataTable
            $('.datatables-modelo').DataTable({
                responsive: {
                    details: {
                        type: 'column',
                        target: 'tr'
                    }
                },
                order: [[0, 'asc']],
                language: {
                    sEmptyTable: "Nenhum dado disponível na tabela",
                    sInfo: "Mostrando de _START_ até _END_ de _TOTAL_ registos",
                    sInfoEmpty: "Mostrando 0 até 0 de 0 registos",
                    sInfoFiltered: "(filtrado de _MAX_ registos no total)",
                    sLengthMenu: "Mostrar _MENU_ registos",
                    sLoadingRecords: "A carregar...",
                    sProcessing: "A processar...",
                    sSearch: "Pesquisar:",
                    sZeroRecords: "Nenhum registo encontrado",
                    oPaginate: {
                        sFirst: "Primeiro",
                        sLast: "Último",
                        sNext: "Seguinte",
                        sPrevious: "Anterior"
                    },
                    oAria: {
                        sSortAscending: ": ativar para ordenar a coluna de forma ascendente",
                        sSortDescending: ": ativar para ordenar a coluna de forma descendente"
                    }
                },
                drawCallback: function() {
                    // Reinitialize dropdowns after table redraw
                    $('.dropdown-toggle').dropdown();
                }
            });

            // Handle modal form reset
            $('.modal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
                $(this).find('.select2').val(null).trigger('change');
            });

            // Prevent dropdown from closing when clicking inside dropdown content for dates
            $(document).on('click', '.dropdown-item-text', function(e) {
                e.stopPropagation();
            });
        });
    </script>
    <script src="{{ asset('painel/assets/js/modal-add-permission.js') }}"></script>
    <script src="{{ asset('painel/assets/js/modal-edit-permission.js') }}"></script>
@endsection