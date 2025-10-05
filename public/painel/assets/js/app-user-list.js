let a = new DataTable(t, {
  ajax: {
      url: "/painel/admin/user/getUsers", // URL relativa é melhor
      dataSrc: 'data'
  },
  columns: [
      {data: null}, // Coluna de controle
      {data: 'id'}, // ID
      {data: 'nome'}, // Nome Completo
      {data: 'funcao'}, // Função
      {data: 'provincia'}, // Província
      {data: 'municipio'}, // Município
      {data: 'email'}, // Email
      {data: null, orderable: false, searchable: false} // Ações
  ],
  columnDefs: [
      {
          className: "control",
          searchable: false,
          orderable: false,
          responsivePriority: 2,
          targets: 0,
          render: function() { return ""; }
      },
      {
          targets: 1,
          orderable: false,
          searchable: false,
          responsivePriority: 4,
          checkboxes: {
              selectAllRender: '<input type="checkbox" class="form-check-input">'
          },
          render: function() {
              return '<input type="checkbox" class="dt-checkboxes form-check-input">';
          }
      },
      {
          targets: 2,
          responsivePriority: 3,
          render: function(e, t, a) {
              return `
              <div class="d-flex justify-content-start align-items-center user-name">
                  <div class="avatar-wrapper">
                      <div class="avatar avatar-sm me-4">
                          <span class="avatar-initial rounded-circle bg-label-${["success","danger","warning","info","dark","primary","secondary"][Math.floor(6*Math.random())]}">
                              ${a.nome.match(/\b\w/g).join('').toUpperCase()}
                          </span>
                      </div>
                  </div>
                  <div class="d-flex flex-column">
                      <span class="fw-medium">${a.nome}</span>
                      <small>${a.email}</small>
                  </div>
              </div>`;
          }
      },
      {
          targets: 3,
          render: function(e, t, a) {
              const icons = {
                  'Subscriber': 'bx bx-crown text-primary',
                  'Author': 'bx bx-edit text-warning',
                  'Maintainer': 'bx bx-user text-success',
                  'Editor': 'bx bx-pie-chart-alt text-info',
                  'Admin': 'bx bx-desktop text-danger'
              };
              const icon = icons[a.funcao] || 'bx bx-user';
              return `<span class="text-truncate d-flex align-items-center text-heading">
                  <i class="icon-base ${icon} me-2"></i>${a.funcao}
              </span>`;
          }
      },
      {
          targets: 4,
          render: function(e, t, a) {
              return `<span class="text-heading">${a.provincia}</span>`;
          }
      },
      {
          targets: 6,
          render: function(e, t, a) {
              const status = {
                  1: {title: "Pending", class: "bg-label-warning"},
                  2: {title: "Active", class: "bg-label-success"},
                  3: {title: "Inactive", class: "bg-label-secondary"}
              };
              return `<span class="badge ${status[a.status || 1].class} text-capitalized">
                  ${status[a.status || 1].title}
              </span>`;
          }
      },
      {
          targets: -1,
          title: "Actions",
          searchable: false,
          orderable: false,
          render: function(e, t, a) {
              return `
              <div class="d-flex align-items-center">
                  <a href="javascript:;" class="btn btn-icon delete-record">
                      <i class="icon-base bx bx-trash icon-md"></i>
                  </a>
                  <a href="${r}" class="btn btn-icon">
                      <i class="icon-base bx bx-show icon-md"></i>
                  </a>
                  <a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="icon-base bx bx-dots-vertical-rounded icon-md"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end m-0">
                      <a href="javascript:;" class="dropdown-item">Edit</a>
                      <a href="javascript:;" class="dropdown-item">Suspend</a>
                  </div>
              </div>`;
          }
      }
  ],
  // Mantenha o resto da configuração original...
});