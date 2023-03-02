@extends('layouts.app')
@section('title', 'Solicitudes completadas')

@section('content')
    <div class="container-fluid p-0">
        <!-- Container Slogan -->
        <div class="col-12 bg-primario rounded-top mb-3">
            <div class="col-12 py-4">
                <h1 class="text-white fw-bold text-uppercase text-center fs-4 mb-2">Solicitudes completadas</h1>
                <p class="text-white text-center fs-6 fw-light">Total alumnos con archivos completados por carrera</p>
            </div>
        </div>
        <!-- Container Slogan -->

        <!-- Contenido -->
        <div class="row w-100 h-100 m-0 p-0">

            <!-- Header Section -->

            <div class="col-12 col-md-6 text-center my-2 d-flex">
                <div class="col-6 col-md-4 text-center my-2">
                    <h6>CICLO ESCOLAR:</h6>
                </div>
                <select class="form-select" id="carreras_select" class="form-control">
                    <option value="0" selected disabled>-- Seleccione Carrera --</option>
                    @foreach ($carreras as $carrera)
                        <option value="{{ $carrera->idca }}">{{ $carrera->nombre }}</option>
                    @endforeach
                </select>
            </div> <!-- Ciclos select end</!-->
            <div class="col-12 col-md-6 text-center my-2 d-flex">
                <div class="col-6 col-md-4 text-center my-2">
                    <h6>PROCESO:</h6>
                </div>
                <select class="form-select" id="tipo_proceso_select" class="form-control" disabled>
                    <option value="0">-- Selecciona Tipo de Proceso --</option>
                    <option value="ESTANCIA I">Estancia I</option>
                    <option value="ESTANCIA II">Estancia II</option>
                    <option value="ESTADIA PROFESIONAL">Estadia Profesional</option>
                </select>
            </div>
            <!-- Header Section -->

            <div class="col-12">
                @include('layouts.partials.alerts')
            </div>

            <!-- desktop version -->
            <div id="resultado1">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-primaria d-none d-lg-table text-center align-center">
                            <thead class="table-head fw-bold">
                                <th>Matricula</th>
                                <th>Nombre</th>
                                <th>Proceso</th>
                                <th>Empresa</th>
                                <th>Estado</th>

                            </thead>
                            <tbody id="desktop-container"></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- desktop version End -->

            <!-- Mobile Version -->

            <div class="card shadow-lg my-3 py-3 mx-auto d-lg-none" id="mobile-container"></div>

            <!-- Mobile Version End -->
        </div>
        <!-- Contenido End -->

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/reportes/solicitudes-aceptadas/main.js') }}"></script>
@endsection
