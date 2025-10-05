<div class="container-fluid">
        <!-- Header da Página -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card ">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-1">Users</h4>
                                <p class="mb-0 opacity-75">Gerencie todos os registros de user</p>
                            </div>
                            
                            @if ($adicionar)
                                <button 
                                    class="btn btn-primary"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#addUserModal"
                                >
                                    <i class="bx bx-plus me-1"></i>
                                    Adicionar User
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
                            Lista de Users
                        </h5>
                    </div>
                    
                    <div class="card-datatable table-responsive">
                        <table class="datatables-user table">
                          <thead class="border-top">
                                <tr>
                                    <th class="text-center" width="80">ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Profile_photo_path</th>
                                            <th>Role</th>
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
                                                    <span class="fw-medium">{{ $item->vc_name }}</span>
                                            </td>
                                            <td>
                                                    <span class="fw-medium">{{ $item->vc_email }}</span>
                                            </td>
                                            <td>
                                                    <span class="fw-medium">{{ $item->vc_password }}</span>
                                            </td>
                                            <td>
                                                    <span class="fw-medium">{{ $item->vc_profile_photo_path }}</span>
                                            </td>
                                        
                                            <td>
                                                <span class="text-primary fw-medium">
{{ $item->fk_role->nome ?? 'N/A' }}                                                </span>
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
                                                            href="{{ route('admin.user.show', ['id' => $item->id]) }}" 
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
                                                                data-bs-target="#editUserModal--{{ $item->id }}"
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
                                                                data-url="{{ route('admin.user.destroy', ['id' => $item->id]) }}" 
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
                                        <div class="modal fade" id="editUserModal--{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Editar User</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form 
                                                            method="post" 
                                                            action="{{ route('admin.user.update', ['id' => $item->id]) }}" 
                                                            class="row g-3" 
                                                            enctype="multipart/form-data"
                                                        >
                                                            @csrf
                                                            
                                                            
                                                            @include('forms.user.index')
                                                            
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
                                                <p class="text-muted mb-0">Não há user cadastrados no momento.</p>
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
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Adicionar Novo User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <div class="modal-body">
                            <form 
                                class="row g-3" 
                                action="{{ route('admin.user.store') }}" 
                                method="post" 
                                enctype="multipart/form-data"
                            >
                                @csrf
                                
                                @php
                                    $item = null;
                                @endphp
                                
                                @include('forms.user.index')
                                
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
            $('.datatables-user').DataTable({
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