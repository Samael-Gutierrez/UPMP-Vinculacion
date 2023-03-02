let catalogos = [
    '/catalogos'
];

let reportes = [
    '/reportes'
];

checkUrlSidebar(catalogos);
checkUrlSidebar(reportes);

$(document).ready(() => {
    window.scrollTo(0, 0);

    Alerts();
});

function Alerts() {
    const alertError = $(".alert-error");
    const alertMessage = $(".alert-message");

    setTimeout(() => {
        alertError.hide("slide", { direction: "left" }, 400);
    }, 3500);
    setTimeout(() => {
        alertMessage.hide("slide", { direction: "left" }, 400);
    }, 3500);
}

function checkUrlSidebar(secciones){
    secciones.forEach( seccion =>{
        if (window.location.href.indexOf(seccion) > -1) {
            $('.reportes-link').attr('aria-expanded', true);
            $('.collapse-reportes').addClass('show');
            $('#inactive-icon').hide();
            $('#active-icon').removeClass('d-none');
            $('#active-icon').show();
        }
    })
}
