// require('./bootstrap');
import '@fortawesome/fontawesome-free/js/all.js';
console.log('iniciando modulo js ')
// window.Chart = require('chart.js');
window.iziToast = require('izitoast');

var error_tag = document.getElementById('error_message')
// var previewModal = document.getElementById('modal-preview')

// console.log(previewModal)
// previewModal.addEventListener('stalled',function(event){

//     console.log('disparando evento hdp')
// })
    // preveiwModal.addEventListener('onchange', function (event) {
    //   // Button that triggered the modal
    //   console.log('disparando evento')
    //   console.log(preveiwModal)
    // //   var button = event.relatedTarget
    // //   // Extract info from data-bs-* attributes
    // //   var recipient = button.getAttribute('data-url')
    //   // If necessary, you could initiate an AJAX request here
    //   // and then do the updating in a callback.
    //   //
    //   // Update the modal's content.
    //   //console.log(recipient)
      
    // })

// console.log(error_tag)
// if(error_tag )
// {
//     var error_messages = JSON.parse(error_tag.getAttribute('data'))
//     iziToast.error({
//         title: 'Error',
//         message: 'Illegal operation',
//     });
// }

// function alerta(){
//     console.log('lanzando evento')
// }



// console.log('cargando chart');
// var ctx = document.getElementById('myChart');
// var estadistica = JSON.parse(ctx.getAttribute('data'));
// let estadisticaValues=[];
// let estadisticaLabels=[];
//  estadistica.forEach(element => {
//     estadisticaValues.push(element.total)
//     estadisticaLabels.push(element.genero)
// });


// console.log("value data",JSON.parse(ctx.getAttribute('data')))
// var myChart = new Chart(ctx, {
//     type: 'doughnut',
//     data: {
//         labels: estadisticaLabels,
//         datasets: [{
//             label: 'Genero',
//             data: estadisticaValues,
//             backgroundColor: [
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(255, 159, 64, 0.2)'
//             ],
//             borderColor: [
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(255, 159, 64, 1)'
//             ],
            
//             hoverOffset: 4

//         }]
//     },
   
// });
// var ctxEdad = document.getElementById('chartEdad')
// let edadValues =[];
// let edadLabels =[];

// var edad = JSON.parse(ctxEdad.getAttribute('data'))
// edad.forEach(element => {
//     edadLabels.push(element.edad)
//     edadValues.push(element.total)
// });

// var chartEdad = new Chart(ctxEdad, {
//     type: 'line',
//     data: {
//         labels: edadLabels,
//         datasets: [{
//             label: 'Rango de edad ',
//             data: edadValues,
//             borderColor: 'rgb(75, 192, 192)',
//             fill: false,
//             tension: 0.1
//         }]
//     },
   
// });
// var ctxCivil = document.getElementById('chartCivil')
// let civilValues =[];
// let civilLabels =[];

// var civil = JSON.parse(ctxCivil.getAttribute('data'))
// console.log(civil)
// civil.forEach(element => {
//     civilLabels.push(element.estado_civil)
//     civilValues.push(element.total)
// });

// var chartEdad = new Chart(ctxCivil, {
//     type: 'bar',
//     data: {
//         labels: civilLabels,
//         datasets: [{
//             label: 'Estado Civil',
//             data: civilValues,
//             backgroundColor: [
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(255, 159, 64, 0.2)',
//                 'rgba(255, 205, 86, 0.2)',
//                 'rgba(75, 192, 192, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(153, 102, 255, 0.2)',
//                 'rgba(201, 203, 207, 0.2)'
//               ],
//               borderColor: [
//                 'rgb(255, 99, 132)',
//                 'rgb(255, 159, 64)',
//                 'rgb(255, 205, 86)',
//                 'rgb(75, 192, 192)',
//                 'rgb(54, 162, 235)',
//                 'rgb(153, 102, 255)',
//                 'rgb(201, 203, 207)'
//               ],
//               borderWidth: 1
//         }]
//     },
//     options: {
//         scales: {
//           y: {
//             beginAtZero: true
//           }
//         }
//       },
   
// });