// $(document).ready(function () {
//     $('#example').DataTable({
//         footerCallback: function (row, data, start, end, display) {
//             var api = this.api();
 
//             // Remove the formatting to get integer data for summation
//             var intVal = function (i) {
//                 return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
//             };
 
//             // Total over all pages
//             total = api
//                 .column(4)
//                 .data()
//                 .reduce(function (a, b) {
//                     return intVal(a) + intVal(b);
//                 }, 0);
 
//             // Total over this page
//             pageTotal = api
//                 .column(4, { page: 'current' })
//                 .data()
//                 .reduce(function (a, b) {
//                     return intVal(a) + intVal(b);
//                 }, 0);
 
//             // Update footer
//             $(api.column(4).footer()).html('$' + pageTotal + ' ( $' + total + ' total)');
//         },
//     });
// });





// $(".inline_setup").chosen();

// jQuery('.inline_setup').chosen();

jQuery(document).ready(function(){
    jQuery(".chosen").chosen();
});


//Loader Start

var overlay = document.getElementById("overlay");
window.addEventListener('load', function(){
    overlay.style.display = 'none';
});
//Loader End