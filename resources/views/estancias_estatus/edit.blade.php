@extends('layouts.app')
@section('title', 'Estancias Estatus')

@section('content')
    <!-- General Container -->
    <div class="container-fluid p-0">
        <!-- Form Container -->
        <div class="container-fluid">
            <div class="row justify-content-center">

                <!-- Container Slogan -->
                <div class="col-12 bg-primario rounded-top mb-3">
                    <div class="col-12 py-4">
                        <h1 class="text-white fw-bold text-uppercase text-center fs-4 mb-2">Solicitud Detalle</h1>
                        <p class="text-white text-center fs-6 fw-light"></p>
                    </div>
                </div>
                <div class="col-12">
                    @include('layouts.partials.alerts')
                </div>
                <!-- Container Slogan -->
                <div class="form-floating my-2 row col-lg-10">
                    <input type="text"
                        value="{{ ucfirst(strtolower(Auth::user()->titulo)) . ' ' . Auth::user()->nombre . ' ' . Auth::user()->apellido_paterno . ' ' . Auth::user()->apellido_materno }}"
                        placeholder="input-text" class="form-control" readonly>
                    <label class="ms-2">Usuario que modificará el estatus de la estancia </label>
                </div>

                <!-- Form -->
                <form action="{{ route('solicitudes.update', $solicitud) }}" class="form" method="POST">
                    @csrf
                    @method('PUT')


                    <!-- Hide Section Button -->
                    <div class="row justify-content-center">
                        <button id="btn-student-information"
                            class="col-12 col-lg-10 border-0 text-white btn btn-primary mt-3 mb-1">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-8 text-start">
                                    <span class="w-100">Información del alumno</span>
                                </div>
                                <div class="col-2 text-end">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </div>
                            </div>
                        </button>
                    </div>
                    <!-- Hide Section Button End -->
                    <!-- Section student information  -->
                    <section id="student-information" class="col-12 col-lg-12">
                        <div class="row  justify-content-center">
                            <div class="col-12 col-lg-10">
                                <div class="row">
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->estudiante->matricula }}"
                                            name="matricula" class="form-control" readonly>
                                        <label class="ms-2">Matricula</label>
                                    </div>
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->estudiante->get_fullname }}"
                                            name="nombre" class="form-control" readonly>
                                        <label class="ms-2">Nombre completo</label>
                                    </div>
                                </div><!-- row -->
                                <div class="row">
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->tipo_estancia }}" name="tipo_estancia"
                                            class="form-control" readonly>
                                        <label class="ms-2">Proceso</label>
                                    </div>
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->cuatrimestre }}" name="cuatrimestre"
                                            class="form-control" readonly>
                                        <label class="ms-2">Cuatrimestre</label>
                                    </div>
                                </div><!-- row -->
                                <div class="row">
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->num_horas }}" name="num_horas"
                                            class="form-control" readonly>
                                        <label class="ms-2">Horas por acreditar</label>
                                    </div>
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->created_at }}" name="fecha_solicitud"
                                            class="form-control" readonly>
                                        <label class="ms-2">Fecha solicitud</label>
                                    </div>
                                </div><!-- row -->
                                <div class="row">
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->fecha_de_inicio }}"
                                            name="fecha_de_inicio" class="form-control" readonly>
                                        <label class="ms-2">Fecha de inicio</label>
                                    </div>
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->fecha_de_termino }}"
                                            name="fecha_de_termino" class="form-control" readonly>
                                        <label class="ms-2">Fecha termino</label>
                                    </div>
                                </div><!-- row -->
                                <div class="row">
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->estudiante->grupo->carrera->nombre }}"
                                            name="carrera" class="form-control" readonly>
                                        <label class="ms-2">Carrera</label>
                                    </div>
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->estudiante->grupo->nombre }}"
                                            name="grupo" class="form-control" readonly>
                                        <label class="ms-2">Grupo</label>
                                    </div>
                                </div><!-- row -->
                                <div class="row">
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->estudiante->email }}" name="correo"
                                            class="form-control" readonly>
                                        <label class="ms-2">Correo electronico</label>
                                    </div>
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->estudiante->telefono }}"
                                            name="telefono" class="form-control" readonly>
                                        <label class="ms-2">Teléfono</label>
                                    </div>
                                </div><!-- row -->
                                <div class="row">
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->nss }}" name="n_social"
                                            class="form-control" readonly>
                                        <label class="ms-2">Número de seguridad social</label>
                                    </div>
                                </div><!-- row -->
                            </div>
                        </div>
                    </section>
                    <!-- Section student information end -->
                    <!-- Hide Section Button -->
                    <div class="row justify-content-center">
                        <button id="btn-company-information"
                            class="col-12 col-lg-10 border-0 text-white btn btn-primary mt-3 mb-1">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-8 text-start">
                                    <span class="w-100">Información de la empresa</span>
                                </div>
                                <div class="col-2 text-end">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </div>
                            </div>
                        </button>
                    </div>
                    <!-- Hide Section Button End -->
                    <!-- Company information section -->
                    <section id="company-information" class="col-12 col-lg-12">
                        <div class="row  justify-content-center">
                            <div class="col-12 col-lg-10">
                                <div class="row">
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->empresa->nombre }}" name="empresa"
                                            class="form-control" readonly>
                                        <label class="ms-2">Nombre registrado ante el SAT</label>
                                    </div>
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->empresa->rfc }}" name="rfc_empresa"
                                            class="form-control" readonly>
                                        <label class="ms-2">RFC</label>
                                    </div>
                                </div><!-- row -->
                                <div class="row">
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->empresa->tipo }}" name="tipo"
                                            class="form-control" readonly>
                                        <label class="ms-2">Tipo</label>
                                    </div>
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->empresa->tamaño }}" name="tamaño"
                                            class="form-control" readonly>
                                        <label class="ms-2">Tamaño</label>
                                    </div>
                                </div><!-- row -->
                                <div class="row">
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->empresa->ciudad }}" name="ciudad"
                                            class="form-control" readonly>
                                        <label class="ms-2">Ciudad</label>
                                    </div>
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->empresa->direccion }}"
                                            name="direccion" class="form-control" readonly>
                                        <label class="ms-2">Dirección</label>
                                    </div>
                                </div><!-- row -->
                                <div class="row">
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->empresa->pagina_web }}"
                                            name="pagina_web" class="form-control" readonly>
                                        <label class="ms-2">Página web</label>
                                    </div>
                                </div><!-- row -->
                            </div>
                        </div>
                    </section>
                    <!-- Company information section end -->
                    <!-- Hide Section Button -->
                    <div class="row justify-content-center">
                        <button id="btn-company-contact-information"
                            class="col-12 col-lg-10 border-0 text-white btn btn-primary mt-3 mb-1">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-8 text-start">
                                    <span class="w-100">Información del destinatario de carta presentación</span>
                                </div>
                                <div class="col-2 text-end">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </div>
                            </div>
                        </button>
                    </div>
                    <!-- Hide Section Button End -->
                    <!-- Company contact information section -->
                    <section id="company-contact-information" class="col-12 col-lg-12">
                        <div class="row  justify-content-center">
                            <div class="col-12 col-lg-10">
                                <div class="row">
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->nombre_contacto }}"
                                            name="nombre_contacto" class="form-control" readonly>
                                        <label class="ms-2">Nombre completo</label>
                                    </div>
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->cargo_contacto }}"
                                            name="cargo_contacto" class="form-control" readonly>
                                        <label class="ms-2">Puesto</label>
                                    </div>
                                </div><!-- row -->
                                <div class="row">
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->correo_contacto }}" name="correo_d"
                                            class="form-control" readonly>
                                        <label class="ms-2">Correo electronico</label>
                                    </div>
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->telefono_contacto }}"
                                            name="telefono_d" class="form-control" readonly>
                                        <label class="ms-2">Telefono</label>
                                    </div>
                                </div><!-- row -->
                            </div>
                        </div>
                    </section>
                    <!-- Company contact information section end -->
                    <!-- Personal Information Section -->
                    <!-- Hide Section Button -->
                    <div class="row justify-content-center">
                        <button id="btn-industrial-adviser-information"
                            class="col-12 col-lg-10 border-0 text-white btn btn-primary mt-3 mb-1">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-8 text-start">
                                    <span class="w-100">Información asesor industrial</span>
                                </div>
                                <div class="col-2 text-end">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </div>
                            </div>
                        </button>
                    </div>
                    <!-- Hide Section Button End -->
                    <!-- Industrial adviser information section -->
                    <section id="industrial-adviser-information" class="col-12 col-lg-12">
                        <div class="row  justify-content-center">
                            <div class="col-12 col-lg-10">
                                <div class="row">
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->asesorIndustrial->get_fullname }} "
                                            name="nombre_ai" class="form-control" readonly>
                                        <label class="ms-2">Nombre completo</label>
                                    </div>
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->asesorIndustrial->rfc }}"
                                            name="rfc_ai" class="form-control" readonly>
                                        <label class="ms-2">RFC</label>
                                    </div>
                                </div><!-- row -->
                                <div class="row">
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->asesorIndustrial->cargo }}"
                                            name="cargo_ai" class="form-control" readonly>
                                        <label class="ms-2">Puesto</label>
                                    </div>
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->asesorIndustrial->telefono }}"
                                            name="telefono_ai" class="form-control" readonly>
                                        <label class="ms-2">Telefono</label>
                                    </div>
                                </div><!-- row -->
                                <div class="row">
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->asesorIndustrial->correo }}"
                                            name="correo_ai" class="form-control" readonly>
                                        <label class="ms-2">Correo electornico</label>
                                    </div>
                                </div><!-- row -->
                            </div>
                        </div>
                    </section>
                    <!-- Industrial adviser information section end -->

                    <!-- Hide Section Button -->
                    <div class="row justify-content-center">
                        <button id="btn-academic-adviser-information"
                            class="col-12 col-lg-10 border-0 text-white btn btn-primary mt-3 mb-1">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-8 text-start">
                                    <span class="w-100">Información asesor academico</span>
                                </div>
                                <div class="col-2 text-end">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </div>
                            </div>
                        </button>
                    </div>
                    <!-- Hide Section Button End -->
                    <!-- Industrial adviser information section -->
                    <section id="academic-adviser-information" class="col-12 col-lg-12">
                        <div class="row  justify-content-center">
                            <div class="col-12 col-lg-10">
                                <div class="row">
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->asesorAcademico->get_fullname }} "
                                            name="nombre_aa" class="form-control" readonly>
                                        <label class="ms-2">Nombre completo</label>
                                    </div>
                                </div><!-- row -->
                                <div class="row">
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->asesorAcademico->email }}"
                                            name="correo_aa" class="form-control" readonly>
                                        <label class="ms-2">Correo electronico</label>
                                    </div>
                                    <div class="form-floating my-2 col-12 col-md col-sm">
                                        <input type="text" value="{{ $solicitud->asesorAcademico->telefono }}"
                                            name="telefono_aa" class="form-control" readonly>
                                        <label class="ms-2">Telefono</label>
                                    </div>
                                </div><!-- row -->
                            </div>
                        </div>
                    </section>
                    <!-- Industrial adviser information section end -->




                    <!-- Hide Section Button -->
                    <div class="row justify-content-center">
                        <button id="btn-autorization-information"
                            class="col-12 col-lg-10 border-0 text-white btn btn-primary mt-3 mb-1">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-8 text-start">
                                    <span class="w-100">Aceptar o Denegar Solicitud</span>
                                </div>
                                <div class="col-2 text-end">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </div>
                            </div>
                        </button>
                    </div>

                    <section id="autorization-information" class="col-12 col-lg-12">
                        <div class="row  justify-content-center">
                            <div class="col-12 col-lg-10">
                                <div class="row">
                                    <div class="col col-md col-sm ms-0 ms-md-4 ms-sm-4">
                                        <label>Aceptar solicitud</label>
                                    </div>
                                    <div class="form-check form-check-inline col col-md col-sm ps-5 ps-md-0 ps-sm-0">
                                        <input class="form-check-input" type="radio" name="estatus"
                                            id="solicitud_aceptada" value="1">
                                        <label class="form-check-label fw-bold" for="inlineRadio1">Aceptar
                                            Solicitud</label>
                                    </div>
                                    <div class="form-check form-check-inline col col-md col-sm ps-5 ps-md-0 ps-sm-0">
                                        <input class="form-check-input" type="radio" name="estatus"
                                            id="solicitud_aceptada" value="2">
                                        <label class="form-check-label fw-bold" for="inlineRadio2">Denegar
                                            Solicitud</label>
                                    </div>
                                    @if ($errors->first('solicitud_estatus'))
                                        <div class="text-danger">
                                            <i>{{ $errors->first('solicitud_estatus') }}</i>
                                        </div>
                                    @endif


                                    <!-- Input Radio End -->
                                </div>
                                <div class="row">
                                    <div class="form-floating my-2 p-1">
                                        <textarea @class([
                                            'form-control' => !$errors->first('observaciones'),
                                            'form-control is-invalid' => $errors->first('observaciones'),
                                        ]) autocomplete="off" name="observaciones" id="observaciones-textarea" cols="30"
                                            rows="10" value="{{ old('observaciones') }}"
                                            placeholder="Escriba aqui las observaciones que tiene que declarar para la solicitud..." class="form-control"></textarea>
                                        <label>Observaciones</label>
                                        @if ($errors->first('observaciones'))
                                            <div class="invalid-feedback">
                                                <i>{{ $errors->first('observaciones') }}</i>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!--row input-->
                            </div>
                        </div>
                    </section>


                    <!-- Personal Information Section End -->
                    <div class="row justify-content-center p-2">
                        <div class="col-12 col-lg-3">
                            <button type="submit"
                                class="btn btn-md d-block w-100 text-white btn-primario">Guardar</button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-5 p-1">
                        <a title="Regresar" href="{{ route('solicitudes.index') }}"
                            class="text-end fs-6 text-secundario"><img src="{{ asset('img/regresa.jpg') }}"
                                width="30" height="30"></a>
                    </div>
                </form>
                <!-- Form End -->
            </div>
        </div>
        <!-- Form Container End -->
    </div>
    <!-- General container End -->
@endsection

@section('scripts')
    <script>
        $('#btn-student-information').click((e) => {
            e.preventDefault();
            $('#student-information').toggle(500);
        });
        $('#btn-company-information').click((e) => {
            e.preventDefault();
            $('#company-information').toggle(500);
        });
        $('#btn-company-contact-information').click((e) => {
            e.preventDefault();
            $('#company-contact-information').toggle(500);
        });
        $('#btn-industrial-adviser-information').click((e) => {
            e.preventDefault();
            $('#industrial-adviser-information').toggle(500);
        });
        $('#btn-academic-adviser-information').click((e) => {
            e.preventDefault();
            $('#academic-adviser-information').toggle(500);
        });
        $('#btn-autorization-information').click((e) => {
            e.preventDefault();
            $('#autorization-information').toggle(500);
        });
    </script>
@endsection
