// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    dom: 'Bfrtip',
        buttons: [
          {
            extend: 'pdfHtml5',
            exportOptions: {
              columns: "thead th:not(.)"
            }
          },
          {
            extend: 'excelHtml5',
            exportOptions: {
              columns: "thead th:not(.bjir)"
            }
          }, 
          {
            extend: 'copyHtml5',
            exportOptions: {
              columns: "thead th:not(.bjir)"
            }
          }
        ]
  });
});
