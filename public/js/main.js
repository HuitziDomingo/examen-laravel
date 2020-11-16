var agregarform = $("#agregar");
var btnEnviar = $("#btncrear");
agregarform.bind("submit", createtrigger);

//Agregar nuevo usuario
var btnNewUser = document.querySelector('#addUser')
btnNewUser.addEventListener('click', () => {
    agregarform.fadeIn()
    updateForm.fadeOut()
    show.fadeOut()

})


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
            `
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Pais</th>
                        <th scope="col">Moneda</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Ciudad</th>
                        <th scope="col">Correo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-active">
                        <th scope="row">${data.id}</th>
                        <td scope="row">${data.nombre}</td>
                        <td>${data.pais}</td>
                        <td>${data.tipo_moneda}</td>
                        <td>${data.estado}</td>
                        <td>${data.ciudad}</td>
                        <td>${data.email}</td>
                    </tr>
                </tbody>
            </table>
            `
        $('#showdiv').html(table)
    })
    agregarform.fadeOut()
    updateForm.fadeOut()
    show.fadeIn()
}
function getById(id, call) {
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

const show = $('#show')

//Actualiazar los elementos
const updateForm = $('#actualizar')
const btnupdateForm = $('#btneditar')


function updateById(id, call) {
    $.ajax({ type: 'get', url: 'edit/' + id, success: call })
}
function updatePrepare() {
    updateForm[0].reset()
    getById($(this).attr('data-id'), (data) => {
        $('#u_codigo').attr('value', data.codigo)
        $('#u_razon_social').html(data.razon_social)
        $('#u_nombre').attr('value', data.nombre)
        $('#u_pais').attr('value', data.pais)
        $('#u_tipo_moneda').attr('value', data.tipo_moneda)
        $('#u_estado').attr('value', data.estado)
        $('#u_ciudad').attr('value', data.ciudad)
        $('#u_telefono').attr('value', data.telefono)
        $('#u_email').attr('value', data.email)

        let input = `<input type="hidden" value=${data.id} class="hidden-id"/>`
        let cont = document.createElement('div')
        cont.innerHTML = input
        updateForm.prepend(cont)
    })
    updateForm.fadeIn()
    agregarform.fadeOut()
    show.fadeOut()
}

function updateTrigger(e) {
    e.preventDefault();
    $.ajax({
        type: $(this).attr("method"),
        url: 'edit/' + $('.hidden-id').val(),
        data: $(this).serialize(),
        beforeSend: function () {
            btnupdateForm.html("Enviando");
            btnupdateForm.attr("disabled", "disabled");
        },
        complete: function (data) {
            btnupdateForm.html("Enviar formulario");
            btnupdateForm.removeAttr("disabled");
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


//Validacion de las monedas
var currency = document.querySelector('#btnCurrency')
currency.addEventListener('click',() => {
    let currenciesVal = $('#tipo_moneda')

    if (currencies.includes(currenciesVal.val().toUpperCase())){
        currenciesVal.removeClass('is-invalid')
        currenciesVal.addClass('is-valid')
    }else{
        currenciesVal.removeClass('is-valid')
        currenciesVal.addClass('is-invalid')
    }
})


