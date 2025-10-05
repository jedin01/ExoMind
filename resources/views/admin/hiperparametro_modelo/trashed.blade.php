@extends('layouts.admin.body')

@section('titulo', 'Hiperparametros de Modelo Eliminados')

@section('css')
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('painel/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('painel/assets/vendor/libs/typeahead-js/typeahead.css') }}">
    <link rel="stylesheet" href="{{ asset('painel/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('painel/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('painel/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('painel/assets/vendor/libs/select2/select2.css') }}">
@endsection

@section('conteudo')
    <!-- Hiperparametros de Modelo Trashed Table -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <div class="d-flex justify-content-between p-4 align-items-center mb-3">
                <h4 class="mb-0">Hiperparametros de Modelo Eliminados</h4>
                <div>
                    <a href="{{ route('admin.hiperparametro_modelo.index') }}" class="btn btn-primary me-2">
                        <i class="bx bx-arrow-back me-1"></i> 
                    </a>
                    <a href="{{ route('admin.hiperparametro_modelo.restoreAll') }}" class="btn btn-primary me-2">
                        <i class="bx bx-restore me-1"></i> 
                    </a>
                    <a href="{{ route('admin.hiperparametro_modelo.deleteAll') }}" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir permanentemente todos os hiperparametro_modelos?')">
                        <i class="bx bx-trash me-1"></i> 
                    </a>
                </div>
            </div>
            <table class="datatables-hiperparametro_modelo-trashed table">
                <thead class="border-top">
                    <tr>
                        <th>ID</th>
                        <th>VALOR</th>
                        <th>MODELO</th>
                        <th>HIPERPARAMETROCATEGORIAMODELO</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->valor }}</td>
                            <td>{{ $item->fk_modelo->nome_registro ?? 'N/A' }}</td>
                            <td>{{ $item->fk_hiperparametro_categoria_modelo->nome_registro ?? 'N/A' }}</td>
                            <td>
                                <div class="dropdown">
                                    <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="{{ route('admin.hiperparametro_modelo.restore', ['id' => $item->id]) }}" class="dropdown-item">
                                                <i class="bx bx-restore me-1"></i> Restaurar
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.hiperparametro_modelo.purge', ['id' => $item->id]) }}" class="dropdown-item" onclick="return confirm('Tem certeza que deseja excluir permanentemente este hiperparametro_modelo?')">
                                                <i class="bx bx-trash me-1"></i> Excluir Permanentemente
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Nenhum hiperparametro_modelo eliminado encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Hiperparametros de Modelo Trashed Table -->
@endsection

@section('scripts')
    <!-- Vendors JS -->
    <script src="{{ asset('painel/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('painel/assets/vendor/libs/select2/select2.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('painel/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script>
        $(function() {
            $('.select2').each(function() {
                $(this).select2({
                    dropdownParent: $(this).parent(),
                    placeholder: $(this).data('placeholder'),
                });
            });

            @if(isset($item))
                $('.datatables-hiperparametro_modelo-trashed').DataTable({
                    responsive: true,
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
                        $('.dropdown-toggle').dropdown();
                    }
                });
            @endif
        });
    </script>
    <script src="{{ asset('painel/assets/js/modal-add-permission.js') }}"></script>
    <script src="{{ asset('painel/assets/js/modal-edit-permission.js') }}"></script>
@endsection