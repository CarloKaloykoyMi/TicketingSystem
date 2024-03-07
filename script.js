$(document).ready(function () {
  $("#example").DataTable({
    // Enable sorting in both ascending and descending order
    "order": [[0, 'asc']] // Set the default sorting column and order to ascending
  });
});
