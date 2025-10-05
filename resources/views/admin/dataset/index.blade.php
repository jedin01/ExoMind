@extends('layouts.admin.body')

@section('titulo', 'Datasets')

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
    <!-- Datasets Table -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <div class="d-flex justify-content-between p-4 align-items-center mb-3">
                <h4 class="mb-0">Gerenciamento de Datasets</h4>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="bx bx-plus me-1"></i>
                </button>
                <a class="btn btn-primary" href="{{ route('admin.dataset.trashed') }}">
                    <i class="bx bx-trash me-1"></i>
                </a>
            </div>
            <table class="datatables-dataset table">
                <thead class="border-top">
                    <tr>
                        <th>ID</th>
                        <th>TITULO</th>
                        <th>CAMINHO</th>
                        <th>QTD_OBSERVACOES</th>
                        <th>FONTE</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->titulo }}</td>
                            <td>{{ $item->qtd_observacoes }}</td>
                            <td>
                                <a href="{{ asset($item->caminho) }}" target="_blank">
{{ $item->caminho }}                                </a>
                            </td>
                            <td>{{ $item->fk_fonte->nome_registro ?? 'N/A' }}</td>
                            <td>
                                <div class="dropdown">
                                    <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal--{{ $item->id }}">
                                                <i class="bx bx-edit me-1"></i> Editar
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.dataset.show', ['id' => $item->id]) }}" class="dropdown-item">
                                                <i class="bx bx-show me-1"></i> Ver Detalhes
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('admin.dataset.modelo', ['id' => $item->id]) }}" class="dropdown-item">
                                                <i class="bx bx-show me-1"></i> Modelos
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" data-url="{{ route('admin.dataset.destroy', ['id' => $item->id]) }}" class="removeItem dropdown-item">
                                                <i class="bx bx-trash me-1"></i> Remover
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            <!-- Edit  Modal -->
                            <div class="modal fade" id="editModal--{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered modal-simple">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                                            <div class="text-center mb-6">
                                                <h4 class="mb-2">Editar </h4>
                                            </div>
                                            <form class="row" method="post" action="{{ route('admin.dataset.update', ['id' => $item->id]) }}" class="row" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    @include('forms.dataset.index')
                                                </div>
                                                <div class="col-sm-3 mb-4">
                                                    <label class="form-label invisible d-none d-sm-inline-block">Button</label>
                                                    <button type="submit" class="btn btn-primary mt-1 mt-sm-0">Actualizar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ Edit  Modal -->
                        </tr>
                    @empty
                        <tr>
                            
                            <td colspan="6" class="text-center">Nenhum dataset encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Datasets Table -->

    <!-- Add  Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-simple">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-6">
                        <h4 class="mb-2">Adicionar Novo </h4>
                    </div>
                    <form class="row" action="{{ route('admin.dataset.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @php
                            $item = null;
                        @endphp
                        @include('forms.dataset.index')
                        <div class="col-12 text-center demo-vertical-spacing">
                            <button type="submit" class="btn btn-primary me-4">Adicionar</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Add  Modal -->
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

            @if(count($items) != 0)
                $('.datatables-dataset').DataTable({
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