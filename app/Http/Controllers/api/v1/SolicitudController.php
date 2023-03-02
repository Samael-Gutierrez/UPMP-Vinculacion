<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Estudiante;
use App\Models\Grupo;
use App\Models\Solicitud;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $colecciones = [];
        $solicitudes = [];

        $grupo = Grupo::find($request->idg);

        $estudiantes = $grupo->alumnos;

        foreach($estudiantes as $estudiante){
            $colecciones[] = Solicitud::latest()
                ->where('idu', $estudiante->idu)
                ->where('tipo_estancia', $request->tipo_estancia)
                ->where('activo', 1)
                ->where('estatus', $request->estatus)
                ->with('estudiante')
                ->with('asesorIndustrial')
                ->with('empresa')
                ->with('asesorAcademico')
                ->get();
        }

        foreach($colecciones as $coleccionSolicitudes){
            foreach($coleccionSolicitudes as $solicitud){
                array_push($solicitudes, $solicitud);
            }
        }


        return response()->json($solicitudes, 200);
    }
}
