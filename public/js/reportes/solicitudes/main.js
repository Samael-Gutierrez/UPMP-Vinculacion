window.addEventListener('load', ()=>{
    const carreraSelect = document.getElementById('carrera_select');
    const tbody = document.getElementById('desktop-container');
    const mobileContainer = document.getElementById('mobile-container');
    const tipoProcesoSelect = document.getElementById('tipo_proceso_select');
    const cicloEscolarSelect = document.getElementById('ciclo_select');
    const grupoSelect = document.getElementById('grupo_select');
    const estatusSelect = document.getElementById('estado_select');

    cicloEscolarSelect.addEventListener('change', ()=>{
        fetch(`https://www.vinculacion.upmp-intranet.com/api/carreras?idce=${cicloEscolarSelect.value}`)
            .then(response => response.json())
            .then(carreras => {

                insertStartOptionElement(carreraSelect, '-- Seleccionar Carrera --');

                estatusSelect.value = 0;

                carreras.forEach( carrera => {
                    const option = document.createElement('option');
                    option.textContent = carrera.nombre;
                    option.value = carrera.idca;
                    carreraSelect.appendChild(option);
                });
            });
    });

    carreraSelect.addEventListener('change', ()=>{
       fetch(`https://www.vinculacion.upmp-intranet.com/api/grupos?idca=${carreraSelect.value}&idce=${cicloEscolarSelect.value}`)
           .then(response => response.json())
           .then(grupos => {

               estatusSelect.value = 0;

               insertStartOptionElement(grupoSelect, '-- Seleccione un Grupo --');

               grupos.forEach(grupo =>{
                   const option = document.createElement('option');
                   option.textContent = grupo.nombre;
                   option.value = grupo.idg;
                   grupoSelect.appendChild(option);
               });
           });
    });

    grupoSelect.addEventListener('change', ()=>{
        estatusSelect.value = 0;
        tipoProcesoSelect.removeAttribute('disabled');
    });

    tipoProcesoSelect.addEventListener('change', () =>{
        estatusSelect.value = 0;
        estatusSelect.removeAttribute('disabled');
    });

    estatusSelect.addEventListener('change', ()=>{

        addLoaders();

        fetch(`https://www.vinculacion.upmp-intranet.com/api/solicitudes?idg=${grupoSelect.value}&tipo_estancia=${tipoProcesoSelect.value}&estatus=${estatusSelect.value}`)
            .then(response => response.json())
            .then(data => {
                if(data.length > 0){
                    tbody.innerHTML = '';
                    mobileContainer.innerHTML = '';
                    data.forEach( solicitud =>{

                        const { nombre, apellido_paterno, apellido_materno, matricula } = solicitud.estudiante;
                        const { tipo_estancia } = solicitud;

                        const tr = document.createElement('tr');

                        const tdMatricula = document.createElement('td');
                        tdMatricula.textContent = matricula;
                        tr.appendChild(tdMatricula);

                        const tdNombre = document.createElement('td');
                        tdNombre.textContent = `${nombre} ${apellido_paterno} ${apellido_materno}`;
                        tr.appendChild(tdNombre);

                        const tdTipoEstancia = document.createElement('td');
                        tdTipoEstancia.textContent = tipo_estancia;
                        tr.appendChild(tdTipoEstancia);

                        const tdEmpresa = document.createElement('td');
                        tdEmpresa.textContent = solicitud.empresa.nombre;
                        tr.appendChild(tdEmpresa);

                        const tdEstado = document.createElement('td');
                        const span = document.createElement('span');
                        span.classList.add('fw-bold','text-white', 'rounded', 'p-1', 'fs-6');

                        if(solicitud.estatus === 0){
                            span.classList.add('bg-warning');
                            span.textContent = "Pendiente";
                        }

                        if(solicitud.estatus === 1){
                            span.classList.add('bg-success');
                            span.textContent = "Aceptado";
                        }

                        if(solicitud.estatus === 2){
                            span.classList.add('bg-danger');
                            span.textContent = "Rechazado";
                        }

                        tdEstado.appendChild(span);

                        tr.appendChild(tdEstado);

                        console.log(tr);


                        const tdButtonEdit = document.createElement('td');
                        const buttonEdit = document.createElement('a');
                        buttonEdit.href = `/reportes/solicitudes/${solicitud.ids}`;
                        buttonEdit.textContent = "Revisar";
                        buttonEdit.classList.add('btn', 'btn-sm', 'btn-primario', 'text-white', 'w-20');

                        tdButtonEdit.appendChild(buttonEdit);
                        tr.appendChild(tdButtonEdit);

                        tbody.appendChild(tr);


                        const divTitle = document.createElement('div');
                        divTitle.classList.add('card-title', 'text-center', 'fw-bold');
                        divTitle.textContent = `${nombre} ${apellido_paterno} ${apellido_materno}`;
                        mobileContainer.appendChild(divTitle);

                        const divCardBody = document.createElement('div');
                        divCardBody.classList.add('card-body', 'text-center');

                        const pMatricula = document.createElement('p');
                        pMatricula.textContent = matricula;
                        divCardBody.appendChild(pMatricula);

                        const pTipoEstancia = document.createElement('p');
                        pTipoEstancia.textContent = tipo_estancia;
                        divCardBody.appendChild(pTipoEstancia);

                        const pEmpresa = document.createElement('p');
                        pEmpresa.textContent = solicitud.empresa.nombre;
                        divCardBody.appendChild(pEmpresa);

                        const pEstatus = document.createElement('p');
                        const spanMobile = document.createElement('span');
                        spanMobile.classList.add('fw-bold','text-white', 'rounded', 'p-1', 'fs-6');

                        if(solicitud.estatus === 0){
                            spanMobile.classList.add('bg-warning');
                            spanMobile.textContent = "Pendiente";
                        }

                        if(solicitud.estatus === 1){
                            spanMobile.classList.add('bg-success');
                            spanMobile.textContent = "Aceptado";
                        }

                        if(solicitud.estatus === 2){
                            spanMobile.classList.add('bg-danger');
                            spanMobile.textContent = "Rechazado";
                        }

                        pEstatus.appendChild(spanMobile);
                        divCardBody.appendChild(pEstatus);

                        mobileContainer.appendChild(divCardBody)

                        const divCardFooter = document.createElement('div');
                        const divRow = document.createElement('div');
                        const divCol = document.createElement('div');
                        divCardFooter.classList.add('card-footer');
                        divRow.classList.add('row');
                        divCol.classList.add('col', 'text-center');
                        const buttonEditMobile = document.createElement('a');
                        buttonEditMobile.href = `/reportes/solicitudes/${solicitud.ids}`;
                        buttonEditMobile.textContent = "Revisar";
                        buttonEditMobile.classList.add('btn', 'btn-sm', 'btn-primario', 'text-white', 'w-20');
                        divCol.appendChild(buttonEditMobile);
                        divRow.appendChild(divCol);
                        divCardFooter.appendChild(divRow);

                        mobileContainer.appendChild(divCardFooter);
                    });
                }else{
                    tbody.innerHTML = `
                            <tr>
                                <td colspan="5">
                                    <h3 class="text-primario fw-bold fs-5">No hay resultados</h3>
                                </td>
                            </tr>
                        `;

                    mobileContainer.innerHTML = `
                            <h3 class="text-primario fw-bold text-center fs-6">No Hay Resultados</h3>
                        `;
                }
            });
    });

    function insertStartOptionElement(target, text){

        target.removeAttribute('disabled');
        target.innerHTML = "";

        const option = document.createElement('option');
        option.textContent = text;
        option.setAttribute('selected', 'true');
        option.setAttribute('disabled', 'true');
        option.value = "0";

        target.appendChild(option);
    }

    function addLoaders(){
        tbody.innerHTML = `
                <tr>
                    <td colspan="5">
                        <div class="spinner-grow text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </td>
                </tr>
            `;

        mobileContainer.innerHTML = `
                <div>
                    <div class="spinner-grow text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            `;
    }
});

