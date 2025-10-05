@extends('layouts.admin.body')

@section('titulo', 'Detalhes do Modelo')

@section('css')
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('painel/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset('painel/assets/vendor/libs/typeahead-js/typeahead.css')}}" /> 
    <link rel="stylesheet" href="{{asset('painel/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('painel/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('painel/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('painel/assets/vendor/libs/select2/select2.css')}}" />
@endsection

@section('conteudo')

<div class="row">
    <!-- User Sidebar -->
    <div class="col-xl-4 col-lg-5 order-1 order-md-0">
      <!-- User Card -->
      <div class="card mb-6 content">
        <div class="card-body pt-12">
          <div class="user-avatar-section">
            <div class="d-flex align-items-center flex-column">
              <img class="img-fluid rounded mb-4" src="{{isset($item->foto)?asset($item->foto):asset('painel/assets/img/avatars/1.png')}}" height="120" width="120" alt="User avatar" />
              <div class="user-info text-center">
                <h5>{{ $item->nome }}</h5>
                <span class="badge bg-label-secondary"></span>
              </div>
            </div>
          </div>
          <h5 class="pb-4 border-bottom mb-4">Detalhes do </h5>
          <div class="info-container">
            <ul class="list-unstyled mb-6">
              <li class="mb-2">
                <span class="h6">Data: </span>
                <span>{{ $item->data }}</span>
              </li>
              <li class="mb-2">
                <span class="h6">Dataset:</span>
                <span>{{ isset($item->fk_dataset) ? $item->fk_dataset->nome_registro : '' }}</span>
              </li>
              <li class="mb-2">
                <span class="h6">Categoriamodelo:</span>
                <span>{{ isset($item->fk_categoria_modelo) ? $item->fk_categoria_modelo->nome_registro : '' }}</span>
              </li>
              <li class="mb-2">
                <span class="h6">Treinamento:</span>
                <span>{{ isset($item->fk_treinamento) ? $item->fk_treinamento->nome_registro : '' }}</span>
              </li>
            </ul>
            <div class="d-flex justify-content-center">
              <a href="javascript:;" class="btn btn-primary me-4" data-bs-target="#editModal--{{ $item->id }}" data-bs-toggle="modal">Editar</a>
            </div>
          </div>
        </div>
      </div>
      <!-- /User Card -->
    </div>
    <!--/ User Sidebar -->

    <!-- User Content -->
    <div class="col-xl-8 col-lg-7 order-0 order-md-1">
      <!-- User Pills -->
      @php
        $modelo_detail = $item;
      @endphp
      <div class="bs-stepper wizard-numbered mt-2">
        <div class="bs-stepper-header" style="overflow-x: scroll;">
          <div class="step" data-target="#hiperparametro_modelo">
            <button type="button" class="step-trigger">
              <span class="bs-stepper-circle">4</span>
              <span class="bs-stepper-label">
                <span class="bs-stepper-title">Hiperparametromodelo</span>
              </span>
            </button>
          </div>
        </div>
        <div class="bs-stepper-content">
          <div class="card mb-6 content" id="hiperparametro_modelo">
            @include('admin.hiperparametro_modelo.data',[
              'items' => $item->fk_hiperparametro_modelo,
              'modelo_detail' => $item,
              'title' => "Gestão de Hiperparametromodelo",
              'subtitle' => "Hiperparametromodelo",
              'relation_name' => "hiperparametro_modelo",
              'adicionar' => true,
              'editar' => true,
              'remover' => true
            ])
          </div>
        </div>
      </div>
    </div>
    <!-- /Social Accounts -->
</div>

<!-- Modals -->
<!-- Edit  Modal -->
@php
  $item = $modelo_detail;
@endphp
<div class="modal fade" id="editModal--{{ $item->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-simple">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-6">
          <h4 class="mb-2">Editar </h4>
        </div>
        <form method="post" enctype="multipart/form-data" action="{{route('admin.modelo.update',['id' => $item->id])}}" class="row">
          @csrf
          @include('forms.modelo.index')
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
@endsection

@section('scripts')
  <!-- Vendors JS -->
  <script src="{{asset('painel/assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

  <!-- Page JS -->
  <script src="{{asset('painel/assets/js/charts-apex.js')}}"></script>
  <script>
    $(function () {
      $('.datatables-hiperparametro_modelo').DataTable({
          responsive: true,
          order: [[1, 'asc']], // Ordenar pela segunda coluna (ID)
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
          }
      });
    });
  </script>
@endsection