// public/js/clientes.js

function searchTableName(colum) {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("inputSearchName");
    filter = input.value.toUpperCase();
    table = document.getElementById("tablaClientes");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[colum]; // Columna 0 (Nombre)
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function searchTableCount(colum) {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("inputSearchIde");
    filter = input.value.toUpperCase();
    table = document.getElementById("tablaClientes");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[colum]; // Columna 0 (Nombre)
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
function searchTableYear(colum) {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("inputSearchYear");
    filter = input.value.toUpperCase();
    table = document.getElementById("tablaClientes");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[colum]; // Columna 0 (Nombre)
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function validaNumericos(event) {//validacion para solo tomar numeros
    if(event.charCode >= 48 && event.charCode <= 57){
        return true;
    }
    return false;
}

function validaText(event) {//validacion para solo tomar letras
    if(event.charCode >= 48 && event.charCode <= 57){
        return true;
    }
    return false;
}

function confirmDelete(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}


function showClientDetails(cliente) {
    // URL del endpoint que devolverá los datos financieros
    const financialDataUrl = `/tablaCliente/${cliente.identificacion}/financial-data`;

    // Realizar solicitud AJAX para obtener datos financieros
    fetch(financialDataUrl)
        .then(response => response.json())
        .then(data => {
            // Extraer datos para la gráfica
            const labels = data.map(record => record.fecha_movimiento);
            const abonosData = data.map(record => record.abonos);
            const retirosData = data.map(record => record.retiros);
            // Calcular el saldo acumulado
            let saldoAcumulado = 0;
            const saldoData = data.map(record => {
                saldoAcumulado += record.abonos - record.retiros;
                return saldoAcumulado;
            });

            // Mostrar SweetAlert con la gráfica
            Swal.fire({
                title: `Detalles del Cliente: ${cliente.nombre}`,
                html: `
                    <p><strong>ID:</strong> ${cliente.id}&nbsp;<strong>Nombre:</strong> ${cliente.nombre}</p>
                    <p><strong>Identificación:</strong> ${cliente.identificacion}</p>
                    <p><strong>Teléfono:</strong> ${cliente.telefono}</p>
                    <p><strong>Email:</strong> ${cliente.email}</p>
                    <p><strong>Dirección:</strong> ${cliente.direccion}</p>
                    <p><strong>Fecha nacimiento:</strong> ${cliente.fecha_nacimiento}</p>
                    <p><strong>Fecha de Apertura:</strong> ${cliente.fecha_apertura}</p>
                    <p><strong>Numero cuenta:</strong> ${cliente.numero_cuenta}</p>
                    <p><strong>Empleador:</strong> ${cliente.empleador}</p>
                    <p><strong>Ingresos:</strong> ${cliente.ingresos}</p>
                    <p><strong>Saldo:</strong> ${cliente.saldo}</p>

                    <canvas id="financialChart" width="400" height="200"></canvas>
                `,
                didOpen: () => {
                    const ctx = document.getElementById('financialChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: 'Abonos',
                                    data: abonosData,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'Retiros',
                                    data: retirosData,
                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'Saldo',
                                    data: saldoData,
                                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                                    borderColor: 'rgba(153, 102, 255, 1)',
                                    borderWidth: 1
                                }
                            ]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            });
        })
        .catch(error => {
            console.error('Error al obtener datos financieros:', error);
        });
}






// function showClientDetails(cliente) {
//
//
//     const savingsData = [100, 200, 150, 300, 250, 400, 450, 500, 550, 600, 650, 700, 720, 760, 800,]; // Datos hipotéticos
//
//     Swal.fire({
//         title: `Detalles del Cliente: ${cliente.nombre}`,
//         html: `
//             <p><strong>ID:</strong> ${cliente.id}&nbsp;<strong>Nombre:</strong> ${cliente.nombre}</p>
//             <p><strong>Identificación:</strong> ${cliente.identificacion}</p>
//             <p><strong>Teléfono:</strong> ${cliente.telefono}</p>
//             <p><strong>Email:</strong> ${cliente.email}</p>
//             <p><strong>Direccion:</strong> ${cliente.direccion}</p>
//             <p><strong>Fecha nacimiento:</strong> ${cliente.fecha_nacimiento}</p>
//             <p><strong>Fecha de Apertura:</strong> ${cliente.fecha_apertura}</p>
//             <p><strong>Numero cuenta:</strong> ${cliente.numero_cuenta}</p>
//             <p><strong>Empleador:</strong> ${cliente.empleador}</p>
//             <p><strong>Ingresos:</strong> ${cliente.ingresos}</p>
//             <p><strong>Saldo:</strong> ${cliente.saldo}</p>
//
//             <canvas id="savingsChart" width="400" height="200"></canvas>
//         `,
//         didOpen: () => {
//             const ctx = document.getElementById('savingsChart').getContext('2d');
//             new Chart(ctx, {
//                 type: 'line',
//                 data: {
//                     labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
//                     datasets: [{
//                         label: 'Historial de Ahorros',
//                         data: savingsData,
//                         backgroundColor: 'rgba(54, 162, 235, 0.2)',
//                         borderColor: 'rgba(54, 162, 235, 1)',
//                         borderWidth: 1
//                     }]
//                 },
//                 options: {
//                     scales: {
//                         y: {
//                             beginAtZero: true
//                         }
//                     }
//                 }
//             });
//         }
//     });
//
// }
