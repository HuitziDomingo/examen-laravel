var agregarform = $("#agregar");
var btnEnviar = $("#btncrear");
agregarform.bind("submit", createtrigger);

// $(document).ready(function () {

// });



function createtrigger(e) {
    e.preventDefault();
    $.ajax({
        type: $(this).attr("method"),
        url: $(this).attr("action"),
        data: $(this).serialize(),
        beforeSend: function () {
            btnEnviar.html("Enviando");
            btnEnviar.attr("disabled", "disabled");
        },
        complete: function (data) {
            btnEnviar.html("Enviar formulario");
            btnEnviar.removeAttr("disabled");
        },
        success: function (data) {

            let html = `<tr>
                            <td class="border px-4 py-2">${data.id}) ${$("#nombre").val()}</td>
                            <td class="border px-4 py-2">${$("#email").val()}</td>
                            <td class="border px-4 py-2">
                                <button class="btn-show" data-id="${data.id}">Ver</button> -
                                <button class="btnUpdate" data-id="${data.id}">Editar</button> -

                                <button class="btnDelete" data-id="${data.id}">Eliminar</button>
                            </td>
                        </tr>`

            let el = document.createElement('tr');
            el.innerHTML = html;
            $('#mostrar tbody').prepend(el);

            $('#__' + data.id + ' .btnUpdate').bind('click', updatePrepare)
            $('#__' + data.id + ' .btn-show').bind('click', showtrigger)
            $('#__' + data.id + ' .btnDelete').bind('click', deleteTrigger)


        },
        error: function (data) {
            alert("Problemas al tratar de enviar el formulario");
        }
    });
    return false;
}

//Funcion para aparcer el contenido

$('.btnUpdate').bind('click', updatePrepare)
$('.btn-show').bind('click', showtrigger)
$('.btnDelete').bind('click', deleteTrigger)

//Mostrar los elementos
function showtrigger(e) {
    e.preventDefault()
    getById($(this).attr('data-id'), (data) => {
        let table =
            `<div><h4>Nombre</h4>${data.nombre}</div>
            <div><h4>Pais</h4>${data.pais}</div>
            <div><h4>Moneda</h4>${data.tipo_moneda}</div>
            <div><h4>Estado</h4>${data.estado} </div>
            <div><h4>Ciudad</h4>${data.ciudad}</div>
            <div><h4>Coreeo</h4>${data.email}</div>`
        $('#showdiv').html(table)
    })
}
function getById(id, call) {
    console.log('funcionando......')
    $.ajax({ type: 'get', url: id, success: call });
}

//Eliminar los elementos
function deleteById(id, call) {
    $.ajax({ type: 'get', url: "delete/" + id, success: call })
}

function deleteTrigger() {
    deleteById($(this).attr('data-id'), (data) => {
        $(`#__${$(this).attr('data-id')}`).fadeOut('slow')
    })
}

//Actualiazar los elementos
function updateById(id, call) {
    $.ajax({ type: 'get', url: 'update/' + id, success: call })
}
function updatePrepare() {
    agregarform[0].reset()
    getById($(this).attr('data-id'), (data) => {

        $('#codigo').attr('value', data.codigo)
        $('#razon_social').html(data.razon_social)
        $('#nombre').attr('value', data.nombre)
        $('#pais').attr('value', data.pais)
        $('#tipo_moneda').attr('value', data.tipo_moneda)
        $('#estado').attr('value', data.estado)
        $('#ciudad').attr('value', data.ciudad)
        $('#telefono').attr('value', data.telefono)
        $('#email').attr('value', data.email)

        let input = `<input type="hidden" value=${data.id} class="hidden-id"/>`
        let cont = document.createElement('div')
        cont.innerHTML = input
        agregarform.prepend(cont)
    })
    agregarform.unbind('submit', createtrigger);
    agregarform.bind('submit', updateTrigger);
}

function updateTrigger(e) {
    e.preventDefault();
    $.ajax({
        type: $(this).attr("method"),
        url: 'update/' + $('.hidden-id').val(),
        data: $(this).serialize(),
        beforeSend: function () {
            btnEnviar.html("Enviando");
            btnEnviar.attr("disabled", "disabled");
        },
        complete: function (data) {
            btnEnviar.html("Enviar formulario");
            btnEnviar.removeAttr("disabled");
        },
        success: function (data) {
            let dataid = $(".hidden-id").val()
            let html = `
                                <td class="border px-4 py-2">
                                    ${dataid})
                                    ${$("#nombre").val()}

                                </td>
                                <td class="border px-4 py-2">${$("#email").val()}</td>
                                <td class="border px-4 py-2">
                                    <button class="btn-show" data-id="${dataid}">Ver</button> -
                                    <button class="btnUpdate" data-id="${dataid}">Editar</button> -

                                    <button class="btnDelete" data-id="${dataid}">Eliminar</button>
                                </td>
                            `
            $('#__' + dataid).html(html)
            $('#__' + dataid + ' .btnUpdate').bind('click', updatePrepare)
            $('#__' + dataid + ' .btn-show').bind('click', showtrigger)
            $('#__' + dataid + ' .btnDelete').bind('click', deleteTrigger)

        },
        error: function (data) {
            alert("Problemas al tratar de enviar el formulario");
        }
    });
    return false;
}



var currency = document.querySelector('#btnCurrency')
currency.addEventListener('click',() => {
    let currencies = $('#tipo_moneda').val()

})

