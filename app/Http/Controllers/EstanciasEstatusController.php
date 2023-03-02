<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Solicitud;
use App\Models\Empresa;
use App\Models\AsesorAcademico;
use App\Models\AsesorIndustrial;

class EstanciasEstatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $empresas = Empresa::all();
        $asesorindu = AsesorIndustrial::all();
        $asesoracad = AsesorAcademico::all();
        $items = Solicitud::join('usuarios', 'usuarios.idu', '=', 'solicitudes.idu')
        ->where('usuarios.matricula', 'LIKE', "%$request->q%")
        ->where('solicitudes.estatus', '=', '0')
        ->paginate( ($request->paginate) ? $request->paginate : 10 );

        return view('estancias_estatus.index')
        ->with(['empresas' => $empresas])
        ->with(['asesorindu' => $asesorindu])
        ->with(['asesoracad' => $asesoracad])
        ->with(['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Solicitud $solicitud)
    {
       return view('estancias_estatus.edit', compact('solicitud'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solicitud $solicitud)
    {
        $solicitud->update($request->only(['observaciones', 'estatus']));

        return redirect()->route('estancias-solicitudes.index')->with('message', 'Solicitud Revisada con Exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
