<?php

namespace App\Http\Controllers;

use App\Models\AsesorIndustrial;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AsesorIndustrialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = AsesorIndustrial::select( 'asesores_industriales.idai','asesores_industriales.rfc','asesores_industriales.titulacion', 'asesores_industriales.nombre',
        'asesores_industriales.apellido_paterno','asesores_industriales.apellido_materno','asesores_industriales.cargo','asesores_industriales.telefono', 'asesores_industriales.correo', 'asesores_industriales.activo','empresas.nombre as empre')

        ->join('empresas', 'empresas.idem', '=', 'asesores_industriales.idem')
        ->where('asesores_industriales.nombre', 'LIKE', "%$request->q%")
        ->orWhere('asesores_industriales.apellido_paterno', 'LIKE', "%$request->q%")
        ->orWhere('asesores_industriales.apellido_materno', 'LIKE', "%$request->q%")
        ->orWhere('asesores_industriales.rfc', 'LIKE', "%$request->q%")
        ->orWhere('asesores_industriales.correo', 'LIKE', "%$request->q%")
        ->orWhere('asesores_industriales.cargo', 'LIKE', "%$request->q%")
        ->paginate( ($request->paginate) ? $request->paginate : 10 );


        return view('asesores_industriales.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresas = Empresa::orderBy('nombre', 'asc')
        ->where('activo', '=', 1)
        ->get();
        return view('asesores_industriales.create')
        ->with('empresas',$empresas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            //Signode + significa que la cadena se repite una o muchas veces
            'rfc' => 'required|unique:asesores_industriales|regex:/^[A-Z]{4}[0-9]{6}[A-Z,0-9]{3}$/',
            'titulacion'=>'required|regex:/^[A-Z][A-Z,a-z, ,é,É,í,Í,ó,Ó,ú,Ú,á,Á,ü,Ü,ñ,Ñ]+$/',
            'nombre'=>'required|regex:/^[A-Z][A-Z,a-z, ,é,É,í,Í,ó,Ó,ú,Ú,á,Á,ü,Ü,ñ,Ñ]+$/',
            'apellido_paterno'=>'required|regex:/^[A-Z][A-Z,a-z, ,é,É,í,Í,ó,Ó,ú,Ú,á,Á,ü,Ü,ñ,Ñ]+$/',
            'apellido_materno'=>'required|regex:/^[A-Z][A-Z,a-z, ,é,É,í,Í,ó,Ó,ú,Ú,á,Á,ü,Ü,ñ,Ñ]+$/',
            'cargo'=>'required|regex:/^[A-Z][A-Z,a-z, ,é,É,í,Í,ó,Ó,ú,Ú,á,Á,ü,Ü,ñ,Ñ]+$/',
            'telefono' => 'required|regex:/^[0-9,(,),-]+$/',
            'correo'=>'required|unique:asesores_industriales|email',
            'activo'=>'required',
            'idem'=>'required',
        ]);

        $asesorIndustrial = new AsesorIndustrial();
        $asesorIndustrial->rfc = $request->rfc;
        $asesorIndustrial->titulacion = $request->titulacion;
        $asesorIndustrial->nombre = $request->nombre;
        $asesorIndustrial->apellido_paterno = $request->apellido_paterno;
        $asesorIndustrial->apellido_materno = $request->apellido_materno;
        $asesorIndustrial->cargo = $request->cargo;
        $asesorIndustrial->telefono = $request->telefono;
        $asesorIndustrial->correo = $request->correo;
        $asesorIndustrial->activo = $request->activo;
        $asesorIndustrial->idem = $request->idem;
        $asesorIndustrial->save();

        return redirect()->route('asesores-industriales.index')->with('message', 'Registro creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(AsesorIndustrial $asesorIndustrial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(AsesorIndustrial $asesorIndustrial)
    {


        $consulta = AsesorIndustrial::select( 'asesores_industriales.idai','asesores_industriales.rfc','asesores_industriales.titulacion', 'asesores_industriales.nombre',
        'asesores_industriales.apellido_paterno','asesores_industriales.apellido_materno','asesores_industriales.cargo','asesores_industriales.telefono', 'asesores_industriales.correo', 'empresas.nombre as empre','empresas.idem','asesores_industriales.activo')

        ->join('empresas', 'empresas.idem', '=', 'asesores_industriales.idem')
        ->where('asesores_industriales.idai', '=', $asesorIndustrial->idai)->first();
        $empresas = Empresa::orderBy('nombre', 'asc')
        ->where('activo', '=', 1)
        ->get();

        return view('asesores_industriales.edit')
        ->with('consulta', $consulta)
        ->with('empresas', $empresas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AsesorIndustrial $asesorIndustrial)
    {
        $this->validate($request,[
            //Signode + significa que la cadena se repite una o muchas veces
            'rfc' => ['required', 'regex:/^[A-Z]{4}[0-9]{6}[A-Z,0-9]{3}$/',Rule::unique('asesores_industriales')->ignore($asesorIndustrial->rfc, 'rfc')],
            'titulacion'=>'required|regex:/^[A-Z][A-Z,a-z, ,é,É,í,Í,ó,Ó,ú,Ú,á,Á,ü,Ü,ñ,Ñ]+$/',
            'nombre'=>'required|regex:/^[A-Z][A-Z,a-z, ,é,É,í,Í,ó,Ó,ú,Ú,á,Á,ü,Ü,ñ,Ñ]+$/',
            'apellido_paterno'=>'required|regex:/^[A-Z][A-Z,a-z, ,é,É,í,Í,ó,Ó,ú,Ú,á,Á,ü,Ü,ñ,Ñ]+$/',
            'apellido_materno'=>'required|regex:/^[A-Z][A-Z,a-z, ,é,É,í,Í,ó,Ó,ú,Ú,á,Á,ü,Ü,ñ,Ñ]+$/',
            'cargo'=>'required|regex:/^[A-Z][A-Z,a-z, ,é,É,í,Í,ó,Ó,ú,Ú,á,Á,ü,Ü,ñ,Ñ]+$/',
            'telefono' => 'required|regex:/^[0-9,(,),-]+$/',
            'correo'=>['required','email',Rule::unique('asesores_industriales')->ignore($asesorIndustrial->correo, 'correo')],
            'activo'=>'required',
            'idem'=>'required',
        ]);

        $asesorIndustrial = AsesorIndustrial::find($asesorIndustrial->idai);
        $asesorIndustrial->rfc = $request->rfc;
        $asesorIndustrial->titulacion = $request->titulacion;
        $asesorIndustrial->nombre = $request->nombre;
        $asesorIndustrial->apellido_paterno = $request->apellido_paterno;
        $asesorIndustrial->apellido_materno = $request->apellido_materno;
        $asesorIndustrial->cargo = $request->cargo;
        $asesorIndustrial->telefono = $request->telefono;
        $asesorIndustrial->correo = $request->correo;
        $asesorIndustrial->activo = $request->activo;
        $asesorIndustrial->idem = $request->idem;
        $asesorIndustrial->save();
        return redirect()->route('asesores-industriales.index')->with('message',"Registro Actualizado exitosamente.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(AsesorIndustrial $asesorIndustrial)
    {
      $asesorIndustrial->forceDelete();
      return redirect()->route('asesores-industriales.index')->with('message',"Registro eliminado exitosamente");
    }

    public function toggleStatus(Request $request, AsesorIndustrial $asesorIndustrial)
    {
        $asesorIndustrial->update($request->only('activo'));
        if($asesorIndustrial->activo==1){
            return redirect()->route('asesores-industriales.index')->with('message', 'Registro activado exitosamente');
        }
        else{
            return redirect()->route('asesores-industriales.index')->with('message', 'Registro desactivado exitosamente');
        }
    }
}
