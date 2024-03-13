$(document).ready(function() {
   $('#example').DataTable({
    "lengthMenu":[5,10,20,100],
    searching: false,
       "order": [[0, 'desc']], // Sorting by the first column (Dates) in descending order
       "columnDefs": [
           { "type": "date", "targets": 0 } // Setting the column type to 'date' for proper sorting
           
       ],
       "dom": '<"top"i>rt<"bottom"flp><"clear">',
       
   });
});

  
