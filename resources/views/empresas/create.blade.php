@extends('layouts.app')
@section('title', 'Empresas')

@section('content')
<!-- General Container -->
<div class="container-fluid p-0">
    <!-- Form Container -->
    <div class="container-fluid">
        <div class="row justify-content-center">

            <!-- Container Slogan -->
            <div class="col-12 bg-primario rounded-top mb-3">
                <div class="col-12 py-4">
                    <h1 class="text-white fw-bold text-uppercase text-center fs-4 mb-2">Crear Nueva Empresa</h1>
                    <p class="text-white text-center fs-6 fw-light"></p>
                </div>
            </div>
            <!-- Container Slogan -->

            <!-- Form -->
            <form action="{{ route('empresas.store') }}" class="form" method="POST">
                @csrf
                @method('POST')

                <!-- Hide Section Button -->
                <div class="row justify-content-center">
                    <button id="btn-general-information"
                        class="col-12 col-lg-10 border-0 text-white btn btn-primary mt-3 mb-1">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-8 text-start">
                                <span class="w-100">Información General</span>
                            </div>
                            <div class="col-2 text-end">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-chevron-down" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </div>
                        </div>
                    </button>
                </div>
                <!-- Hide Section Button End -->

                <!-- Personal Information Section -->
                <br>
                <section id="general-information" class="col-12 col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-10">

                            <div class="form-floating my-2">
                                <input @class([ 'form-control'=> !$errors->first('nombrecompletouser'),
                                'form-control is-invalid' => $errors->first('nombrecompletouser'),
                                ]) autocomplete="off" type="text"
                                value="{{ ucfirst(strtolower(Auth::user()->titulo)) . ' ' . Auth::user()->nombre . ' ' . Auth::user()->apellido_paterno . ' ' . Auth::user()->apellido_materno }}"
                                name="nombrecompletouser" placeholder="input-text"
                                id="input-text" readonly>
                                <label for="input-text">Usuario que registrara una nueva empresa </label>
                            </div>

                            <!-- Input Text -->
                            <div class="form-floating my-2">
                                <input onkeyup="mayus(this);" maxlength="12" @class([ 'form-control'=>
                                !$errors->first('rfc'),
                                'form-control is-invalid' => $errors->first('rfc'),
                                ]) autocomplete="off" type="text"
                                value="{{ old('rfc') }}" name="rfc"
                                placeholder="input-text" id="input-text" >
                                <label for="input-text">RFC de la Empresa. (EJM951103H34)</label>

                                @if ($errors->first('rfc'))
                                <div class="invalid-feedback">
                                    <i>{{ $errors->first('rfc') }}</i>
                                </div>
                                @endif

                            </div>
                            <div class="form-floating my-2">
                                <input @class([ 'form-control'=> !$errors->first('nombre'),
                                'form-control is-invalid' => $errors->first('nombre'),
                                ]) autocomplete="off" type="text"
                                value="{{ old('nombre') }}" name="nombre"
                                placeholder="input-text" id="input-text" >
                                <label for="input-text">Nombre de la empresa como esta registrada ante el SAT</label>

                                @if ($errors->first('nombre'))
                                <div class="invalid-feedback">
                                    <i>{{ $errors->first('nombre') }}</i>
                                </div>
                                @endif

                            </div>

                            <div class="form-floating my-2">
                                <input @class([ 'form-control'=> !$errors->first('direccion'),
                                'form-control is-invalid' => $errors->first('direccion'),
                                ]) autocomplete="off" type="text"
                                value="{{ old('direccion') }}" name="direccion"
                                placeholder="input-text" id="input-text" >
                                <label for="input-text">Dirección (calle y número, colonia)</label>

                                @if ($errors->first('direccion'))
                                <div class="invalid-feedback">
                                    <i>{{ $errors->first('direccion') }}</i>
                                </div>
                                @endif

                            </div>

                            <div class="form-floating my-2">
                                <input @class([ 'form-control'=> !$errors->first('ciudad'),
                                'form-control is-invalid' => $errors->first('ciudad'),
                                ]) autocomplete="off" type="text"
                                value="{{ old('ciudad') }}" name="ciudad"
                                placeholder="input-text" id="input-text" >
                                <label for="input-text">Ciudad</label>

                                @if ($errors->first('ciudad'))
                                <div class="invalid-feedback">
                                    <i>{{ $errors->first('ciudad') }}</i>
                                </div>
                                @endif

                            </div>

                            <div class="form-floating my-2">
                                <input @class([ 'form-control'=> !$errors->first('pagina_web'),
                                'form-control is-invalid' => $errors->first('pagina_web'),
                                ]) autocomplete="off" type="text"
                                value="{{ old('pagina_web') }}" name="pagina_web"
                                placeholder="input-text" id="input-text" >
                                <label for="input-text">Página web</label>

                                @if ($errors->first('pagina_web'))
                                <div class="invalid-feedback">
                                    <i>{{ $errors->first('pagina_web') }}</i>
                                </div>
                                @endif

                            </div>

                            <!-- Input Select -->
                            <div class="form-floating my-2">
                                <select @class(['form-control form-select'=> !$errors->first('tipo'), 'form-control
                                    is-invalid' => $errors->first('tipo')])
                                    name="tipo" class="chosen-select form-control">
                                    <option value="" selected disabled>-- Seleccione tipo --</option>
                                    <option value="Pública">Pública</option>
                                    <option value="Privada">Privada</option>
                                </select>
                                <label for="input-text">Seleccione Tipo</label>

                                @if ($errors->first('tipo'))
                                <div class="invalid-feedback">
                                    <i>El campo Tipo es Obligatorio</i>
                                </div>
                                @endif
                            </div>

                            <div class="form-floating my-2">
                                <select @class(['form-control form-select'=> !$errors->first('tamaño'), 'form-control
                                    is-invalid' => $errors->first('tamaño')])
                                    name="tamaño" class="chosen-select form-control">
                                    <option value="" selected disabled>-- Seleccione tamaño --</option>
                                    <option value="Chica">Chica</option>
                                    <option value="Mediana">Mediana</option>
                                    <option value="Grande">Grande</option>
                                </select>
                                <label for="input-text">Seleccione Tamaño</label>

                                @if ($errors->first('tamaño'))
                                <div class="invalid-feedback">
                                    <i>El campo Tamaño es obligatorio</i>
                                </div>
                                @endif
                            </div>

                            <!-- Input Select End -->

                            <!-- Input Radios End -->
                            <div class="form-check my-2">
                                <div class="row items-center justify-content-center">
                                    <h3 class="text-start  fs-6">Activo</h3>
                                    <!-- Input Radio -->
                                    <div class="col-6 d-md-flex justify-content-center">
                                        <div>
                                            <input class="form-check-input mx-auto" name="activo" type="radio"
                                                id="opcion-1" value="1" checked>
                                            <label class="form-check-label ms-1" for="opcion-1"> Si</label>
                                        </div>
                                    </div>
                                    <!-- Input Radio End -->

                                    <!-- Input Radio -->
                                    <div class="col-6 d-md-flex justify-content-center">
                                        <div>
                                            <input class="form-check-input mx-auto" name="activo" type="radio"
                                                id="opcion-2" value="0">
                                            <label class="form-check-label ms-1" for="opcion-2"> No </label>
                                        </div>
                                    </div>
                                    <!-- Input Radio End -->

                                </div>
                            </div>

                            <!-- Hide Section Button -->
                            <div class="row justify-content-center">
                                <button id="btn-general-information"
                                    class="col-12 col-lg-13 border-0 text-white btn btn-primary mt-3 mb-1">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-8 text-start">
                                            <span class="w-100">Datos del contacto directo de la empresa</span>
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

                            <div class="form-floating my-2">
                                <input @class([ 'form-control'=> !$errors->first('contacto'),
                                'form-control is-invalid' => $errors->first('contacto'),
                                ]) autocomplete="off" type="text"
                                value="{{ old('contacto') }}" name="contacto"
                                placeholder="input-text" id="input-text" >
                                <label for="input-text">Nombre de contacto directo</label>

                                @if ($errors->first('contacto'))
                                <div class="invalid-feedback">
                                    <i>{{ $errors->first('contacto') }}</i>
                                </div>
                                @endif

                            </div>

                            <div class="form-floating my-2">
                                <input @class([ 'form-control'=> !$errors->first('correo'),
                                'form-control is-invalid' => $errors->first('correo'),
                                ]) autocomplete="off" type="text"
                                value="{{ old('correo') }}" name="correo"
                                placeholder="input-text" id="input-text" >
                                <label for="input-text">Correo Electrónico</label>

                                @if ($errors->first('correo'))
                                <div class="invalid-feedback">
                                    <i>{{ $errors->first('correo') }}</i>
                                </div>
                                @endif

                            </div>

                            <div class="form-floating my-2">
                                <input maxlength="10" @class([ 'form-control'=> !$errors->first('telefono'),
                                'form-control is-invalid' => $errors->first('telefono'),
                                ]) autocomplete="off" type="text"
                                value="{{ old('telefono') }}" name="telefono"
                                placeholder="input-text" id="ff_elem1178" >
                                <label for="input-text">Teléfono</label>

                                @if ($errors->first('telefono'))
                                <div class="invalid-feedback">
                                    <i>{{ $errors->first('telefono') }}</i>
                                </div>
                                @endif

                            </div>
                            <!-- Input Text End -->



                            <!-- Input Radios -->


                            {{-- Input TextArea --}}

                            {{-- Input TextArea End --}}
                        </div>
                    </div>
                </section>
                <!-- Personal Information Section End -->
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-3">
                        <button type="submit" class="btn btn-md d-block w-100 text-white btn-primario">Guardar</button>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-5">
                    <a title="Regresar" href="{{ route('empresas.index') }}" class="text-end fs-6 text-secundario"><img
                            src="{{ asset('img/regresa.jpg') }}" width="30" height="30"></a>
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
$('#btn-general-information').click((e) => {
    e.preventDefault();
    $('#general-information').toggle(500);
});
</script>

<script>
function mayus(e) {
    e.value = e.value.toUpperCase();
}
</script>


<script>
jQuery(function($) {
    $("#ff_elem1178").mask("(999)-9999-999");
});
</script>';
@endsection