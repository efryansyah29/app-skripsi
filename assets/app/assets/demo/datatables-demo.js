// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable();
});

var table = $('#data').DataTable();
 
$('#next').on( 'click', function () {
    table.page( 'next' ).draw( 'page' );
} );
 
$('#previous').on( 'click', function () {
    table.page( 'previous' ).draw( 'page' );
} );
