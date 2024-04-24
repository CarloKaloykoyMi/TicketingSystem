$(document).ready(function () {
  $("#example").DataTable({
    // Enable sorting in both ascending and descending order
    "order": [[0, 'desc']],
    "searching": false ,
  });
});