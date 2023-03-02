<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\CicloEscolar;
use App\Models\Solicitud;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{

  public function index(){
      $ciclos = CicloEscolar::where('activo', 1)->get();

      return view('reportes.solicitudes.index', compact('ciclos'));
  }

  public function store(Request $request)
  {

  }

  public function show($id)
  {
      //
  }

  public function edit($id)
  {
      $solicitud = Solicitud::find($id);

      return view('estancias_estatus.edit', compact('solicitud'));
  }

  public function update(Request $request, Solicitud $solicitud)
  {
    $solicitud->update($request->only(['estatus', 'observaciones']));

    return redirect()->route('solicitudes.index')->with('message', 'Soliciud actualizada con exito');
  }

  public function destroy(Solicitud $item)
  {
    $item->forceDelete();
    return redirect()->route('solicitudes.index')->with('message',"Registro eliminado exitosamente");
  }

  public function toggleStatus(Request $request, Solicitud $item)
    {
        $item->update($request->only('activo'));
        if($item->activo==1){
            return redirect()->route('solicitudes.index')->with('message', 'Registro activado exitosamente');
        }
        else{
            return redirect()->route('solicitudes.index')->with('message', 'Registro desactivado exitosamente');
        }
    }
}
