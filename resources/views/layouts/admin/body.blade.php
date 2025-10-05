<!doctype html>
  
  
  
  





  
    <!-- =========================================================
* Kelly Project -  | v3.0.0
==============================================================

* Product Page: https://themeselection.com/item/Kelly Project-dashboard-pro-bootstrap/
* Created by: Dissoloquele & Olivia

      * License: You must have a valid license purchased in order to legally use the theme for your project.
    
* Copyright Dissoloquele & Olivia (https://themeselection.com)

=========================================================
 -->
    <!-- beautify ignore:start -->
  


<html
  lang="pt-br"
  class=" layout-navbar-fixed layout-menu-fixed layout-compact "
  dir="ltr"
  data-skin="default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template-semi-dark"
  data-bs-theme="light">
  @include('layouts.admin.head')

  <body>
    
<div class="layout-wrapper layout-content-navbar  ">
  <div class="layout-container">
    
    


    @include('layouts.admin.menu')

      

      <!-- Content wrapper -->
      <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
          
          @yield('conteudo')

        </div>
        <!-- / Content -->

        
        
        @include('layouts.admin.footer')

        
        <div class="content-backdrop fade"></div>
      </div>
      <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
  </div>

  
  
  <!-- Overlay -->
  <div class="layout-overlay layout-menu-toggle"></div>
  
  
  <!-- Drag Target Area To SlideIn Menu On Small Screens -->
  <div class="drag-target"></div>
  
</div>
<!-- / Layout wrapper -->

    
    
    
  <script src="{{asset('painel/assets/vendor/libs/jquery/jquery.js')}}"></script>
  <script src="{{asset('painel/assets/vendor/libs/popper/popper.js')}}"></script>
  <script src="{{asset('painel/assets/vendor/js/bootstrap.js')}}"></script>
  <script src="{{asset('painel/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

  <script src="{{asset('painel/assets/vendor/js/menu.js')}}"></script>

  <!-- endbuild -->
    
            <script src="{{asset('painel/assets/vendor/libs/bs-stepper/bs-stepper.js')}}"></script>
    <script src="{{asset('painel/assets/vendor/libs/toastr/toastr.js')}}"></script>
    <script src="{{asset('painel/assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>
    <script src="{{asset('painel/assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
    <!-- Main JS -->
      <script src=  "{{asset('painel/assets/js/main.js')}}"></script>
      

      <!-- Page JS -->

    <script src="{{asset('painel/assets/js/modal-add-new-cc.js')}}"></script>
    <script src="{{asset('painel/assets/js/pages-pricing.js')}}"></script>
    <script src="{{asset('painel/assets/js/modal-create-app.js')}}"></script>
    <script src="{{asset('painel/assets/js/modal-add-new-cc.js')}}"></script>
    <script src="{{asset('painel/assets/js/modal-add-new-address.js')}}"></script>
    <script src="{{asset('painel/assets/js/modal-add-new-cc.js')}}"></script>
    <script src="{{asset('painel/assets/js/modal-edit-user.js')}}"></script>
    <script src="{{asset('painel/assets/js/modal-enable-otp.js')}}"></script>
    <script src="{{asset('painel/assets/js/modal-share-project.js')}}"></script>
    <script src="{{asset('painel/assets/js/modal-two-factor-auth.js')}}"></script>

  <!-- Vendors JS -->
  <script src="{{asset('painel/assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

  <!-- Main JS -->
  <script src="{{asset('painel/assets/js/main.js')}}"></script>

  <!-- Page JS -->
  <script src="{{asset('painel/assets/js/dashboards-analytics.js')}}"></script>

  <script src="{{asset('painel/assets/js/extended-ui-sweetalert2.js')}}"></script>

  <script src="{{asset('painel/assets/vendor/libs/select2/select2.js')}}"></script>
  <script src="{{ asset('painel/assets/js/form-wizard-numbered.js')}}"></script>
  <script src="{{ asset('painel/assets/js/form-wizard-validation.js')}}"></script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $('.removeItem').on('click', function(e) {
              e.preventDefault(); // Evitar o comportamento padrão do link
              // Pega a URL armazenada no atributo 'data-url'
              var url = $(this).data('url');

              // Exibe o SweetAlert2
              Swal.fire({
                  title: 'Você tem certeza?',
                  text: "Esta ação não pode ser desfeita!",
                  icon: 'warning',
                  showCancelButton: true, // Mostra o botão "Cancelar"
                  showDenyButton: false, // Garante que o botão "Deny" (Negar) não apareça
                  confirmButtonText: 'Sim, continuar!', // Texto do botão "Sim"
                  cancelButtonText: 'Cancelar', // Texto do botão "Cancelar"
              }).then((result) => {
                  // Se o usuário clicar em 'Sim'
                  if (result.isConfirmed) {
                      // Redireciona para a URL de remoção
                      window.location.href = url;
                  }
              });
          });
  </script>
  @yield('scripts')
  <script>

  </script>
  <script>
    $(document).ready(function() {
      @if(session('toast_message') != null)
        var toastMessage = "{{ session('toast_message').' '.session('toast_text','') }}";
        var toastType = "{{ session('toast_type', 'success') }}";
        toastType = toastType == "error" ? "warning" : toastType;
        toastr.options = {
          "closeButton": true,
          "progressBar": true,
          "timeOut": "5000",  // Duração da notificação
          "positionClass": "toast-top-right",  // Posição da notificação
          "toastClass": "bs-toast toast fade show",  // Para aplicar o estilo Bootstrap Toast
          "iconClass": `toast-${toastType}`,  // Para o ícone, opcional
          "onShown": function() {
            var toastElement = document.querySelector('.toast');
            if (toastElement) {
              toastElement.classList.add(`bg-${toastType}`);
              toastElement.style.color = 'white';
              toastElement.style.backgroundColor = `${getToastBackgroundColor(toastType)}`;
              toastElement.style.opacity = '1';  // Garantir opacidade total
            }
          }
        };
  
        // Exibir a notificação
        toastr[toastType](toastMessage, 'Notificação');
      @endif
    });
  
    // Função para obter a cor de fundo com base no tipo
    function getToastBackgroundColor(type) {
      switch (type) {
        case 'success':
          return '#28a745';  // Verde
        case 'error':
          return '#28a745';  // Vermelho
        case 'warning':
          return '#ffc107';  // Amarelo
        case 'info':
          return '#17a2b8';  // Azul
        default:
          return '#007bff';  // Azul padrão
      }
    }
   



  </script>
  <script>
    $(document).ready(function() {
      @if(session('success') != null)
        var toastMessage = "{{ session('success') }}";
        var toastType = "success";
        
        toastr.options = {
          "closeButton": true,
          "progressBar": true,
          "timeOut": "5000",  // Duração da notificação
          "positionClass": "toast-top-right",  // Posição da notificação
          "toastClass": "bs-toast toast fade show",  // Para aplicar o estilo Bootstrap Toast
          "iconClass": `toast-${toastType}`,  // Para o ícone, opcional
          "onShown": function() {
            var toastElement = document.querySelector('.toast');
            if (toastElement) {
              toastElement.classList.add(`bg-${toastType}`);
              toastElement.style.color = 'white';
              toastElement.style.backgroundColor = `${getToastBackgroundColor(toastType)}`;
              toastElement.style.opacity = '1';  // Garantir opacidade total
            }
          }
        };
  
        // Exibir a notificação
        toastr[toastType](toastMessage, 'Notificação');
      @endif
    });
  
    // Função para obter a cor de fundo com base no tipo
    function getToastBackgroundColor(type) {
      switch (type) {
        case 'success':
          return '#28a745';  // Verde
        case 'error':
          return '#dc3545';  // Vermelho
        case 'warning':
          return '#ffc107';  // Amarelo
        case 'info':
          return '#17a2b8';  // Azul
        default:
          return '#007bff';  // Azul padrão
      }
    }

  </script>
    <script>
    $(document).ready(function() {
      @if(session('error') != null)
        alert("Foi!");
        var toastMessage = "{{ session('error') }}";
        var toastType = "success";
        
        toastr.options = {
          "closeButton": true,
          "progressBar": true,
          "timeOut": "5000",  // Duração da notificação
          "positionClass": "toast-top-right",  // Posição da notificação
          "toastClass": "bs-toast toast fade show",  // Para aplicar o estilo Bootstrap Toast
          "iconClass": `toast-${toastType}`,  // Para o ícone, opcional
          "onShown": function() {
            var toastElement = document.querySelector('.toast');
            if (toastElement) {
              toastElement.classList.add(`bg-${toastType}`);
              toastElement.style.color = 'white';
              toastElement.style.backgroundColor = `${getToastBackgroundColor(toastType)}`;
              toastElement.style.opacity = '1';  // Garantir opacidade total
            }
          }
        };
  
        // Exibir a notificação
        toastr[toastType](toastMessage, 'Notificação');
      @endif
    });
  
    // Função para obter a cor de fundo com base no tipo
    function getToastBackgroundColor(type) {
      switch (type) {
        case 'success':
          return '#28a745';  // Verde
        case 'error':
          return '#dc3545';  // Vermelho
        case 'warning':
          return '#ffc107';  // Amarelo
        case 'info':
          return '#17a2b8';  // Azul
        default:
          return '#007bff';  // Azul padrão
      }
    }

  </script>
  
  <script>
    $('.selectize').selectize();
  </script>
  <script>
  function getMunicipios() {
  let provincia = $('#provincia_select').val();
  $.ajax({
    url: "/painel/admin/provincia/municipios/" + provincia,
    method: "GET",
    success: function(data) {
      let municipios = data.municipios;
      let options = "";

      $.each(municipios, function(index, municipio){
        options += `<option value="${municipio.id}">${municipio.nome}</option>`;
      });

      // Garante que o select está vazio antes de adicionar
      $('#municipio_select').empty();
      $('#municipio_select').append(options);
      
      // Se estiver usando select2, descomente abaixo
      // $('#municipio_select').trigger('change');
    },
    error: function(error) {
      console.error("Erro ao pegar municipios: ", error);
    }
  });
}

</script>
 <script>
  function getMunicipiosUpdate(id){
    let provincia = $('#provincia_select'+id).val();
    //alert(provincia);
    $.ajax({
      url: "/painel/admin/provincia/municipios/"+provincia,
      method: "GET",
      success: function(data){
        municipios = data.municipios;
        let options = "";
        $.each(municipios, function(index, municipio){
          options += `<option value="${municipio.id}">${municipio.nome}</option>`;
        });
        $('#municipio_select'+id).html(options);
      },
      error: function(error){
        console.error("Erro ao pegar municipios"+ error);
      }
    });
  }
</script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
        $('.tags').selectize({
            create: true, // Permite adicionar novas opções digitadas
            persist: false, // Evita salvar opções duplicadas
            delimiter: ',',
            maxItems: null, // Permite selecionar múltiplos itens
            placeholder: "Digite e pressione Enter",
        });
    });
</script>

  
</body>

</html>
