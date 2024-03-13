$(document).ready(function() {
   $('#example').DataTable({
       "order": [[0, 'desc']], // Sorting by the first column (Dates) in descending order
       "columnDefs": [
           { "type": "date", "targets": 0 } // Setting the column type to 'date' for proper sorting
       ]
   });
});

