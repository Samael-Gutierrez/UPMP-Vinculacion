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

            <div class="col-12 col-md-4 col-xl-3 text-center my-2 d-flex">
                <select class="form-select" id="ciclo_select">
                    <option value="0" selected disabled>-- Seleccione Ciclo Escolar --</option>
                    @foreach ($ciclos as $ciclo)
                        <option value="{{ $ciclo->idce }}">{{ $ciclo->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 col-md-4 col-xl-3 text-center my-2 d-flex">
                <select class="form-select" id="carrera_select" disabled>
                    <option value="0" selected disabled>-- Seleccione Carrera --</option>
                </select>
            </div>

            <div class="col-12 col-md-4 col-xl-3 text-center my-2 d-flex">
                <select class="form-select" id="grupo_select" disabled>
                    <option value="0" selected disabled>-- Seleccione Grupo --</option>
                </select>
            </div>

            <div class="col-12 col-md-6 col-xl-3 text-center my-2 d-flex">
                <select class="form-select" id="tipo_proceso_select" disabled>
                    <option value="0">-- Selecciona Tipo de Proceso --</option>
                    <option value="ESTANCIA I">Estancia I</option>
                    <option value="ESTANCIA II">Estancia II</option>
                    <option value="ESTADIA PROFESIONAL">Estadia Profesional</option>
                </select>
            </div>

            <div class="col-12 col-md-6 col-xl-12 text-center my-2 d-flex">
                <select class="form-select" id="estado_select" disabled>
                    <option value="0" selected disabled>-- Seleccione Estado --</option>
                    <option value="0">Pendientes</option>
                    <option value="1">Aceptadas</option>
                    <option value="2">Rechazadas</option>
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
                                <th>&nbsp;</th>
                            </thead>
                            <tbody id="desktop-container">
                            </tbody>
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
    <script src="{{ asset('js/reportes/solicitudes/main.js') }}"></script>
@endsection
