import './bootstrap';
import toastr from 'toastr';
import 'toastr/build/toastr.min.css';


toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "timeOut": "5000",  // Duração da notificação
    "positionClass": "toast-top-right",
    "toastClass": "bs-toast toast fade show",
    "onShown": function() {
        // Adiciona a classe 'bg-*' para personalizar o fundo conforme o tipo da notificação
        let toastElement = document.querySelector('.toast');
        if (toastElement) {
            const type = toastElement.classList.contains('toast-success') ? 'bg-success' :
                         toastElement.classList.contains('toast-error') ? 'bg-danger' :
                         toastElement.classList.contains('toast-info') ? 'bg-info' :
                         toastElement.classList.contains('toast-warning') ? 'bg-warning' : '';
            toastElement.classList.add(type);
        }
    }
};
