<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\AsesorIndustrial;
use Illuminate\Validation\Rule;

class EmpresasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $items = Empresa::select('empresas.idem','empresas.rfc', 'empresas.nombre','empresas.direccion',
                                'empresas.activo','empresas.tipo','empresas.tamaño')
                      ->where('empresas.nombre', 'LIKE', "%$request->q%")
                      ->orWhere('empresas.rfc', 'LIKE', "%$request->q%")
                      ->orWhere('empresas.direccion', 'LIKE', "%$request->q%")
                      ->orWhere('empresas.tipo', 'LIKE', "%$request->q%")
                      ->orWhere('empresas.tamaño', 'LIKE', "%$request->q%")
                      ->paginate( ($request->paginate) ? $request->paginate : 10 );
      return view('empresas.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('empresas.create');
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
          'rfc' => 'required|unique:empresas|regex:/^[A-Z]{3}[0-9]{6}[A-Z,0-9]{3}$/',
          'nombre'=>'required|unique:empresas|regex:/^[A-Z][A-Z,a-z, ,é,É,í,Í,ó,Ó,ú,Ú,á,Á,ü,Ü,ñ,Ñ]+$/',
          'direccion'=>'required|regex:/^[A-Z,a-z, ,é,É,í,Í,ó,Ó,ú,Ú,á,Á,ü,Ü,ñ,Ñ,0-9]+$/',
          'ciudad'=>'required|regex:/^[A-Z][A-Z,a-z, ,é,É,í,Í,ó,Ó,ú,Ú,á,Á,ü,Ü,ñ,Ñ]+$/',
          'pagina_web'=>'required',
          'contacto'=>'required|regex:/^[A-Z][A-Z,a-z, ,é,É,í,Í,ó,Ó,ú,Ú,á,Á,ü,Ü,ñ,Ñ]+$/',
          'correo'=>'required|unique:empresas|email',
          'telefono'=>'required|regex:/^[0-9,(,),-]+$/',
          'tipo'=>'required',
          'tamaño'=>'required',
          'activo'=>'required',
      ]);

      $empresas = new Empresa;
      $empresas->rfc = $request->rfc;
      $empresas->nombre = $request->nombre;
      $empresas->direccion = $request->direccion;
      $empresas->ciudad = $request->ciudad;
      $empresas->pagina_web = $request->pagina_web;
      $empresas->contacto = $request->contacto;
      $empresas->correo = $request->correo;
      $empresas->telefono = $request->telefono;
      $empresas->activo = $request->activo;
      $empresas->tipo = $request->tipo;
      $empresas->tamaño = $request->tamaño;
      $empresas->save();

      return redirect()->route('empresas.index')->with('message', 'Registro creado exitosamente');

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
    public function edit(Empresa $empresa)
    {
      $consulta = Empresa::select('empresas.idem', 'empresas.rfc','empresas.nombre', 'empresas.direccion',
                              'empresas.ciudad','empresas.pagina_web','empresas.tipo','empresas.tamaño',
                              'empresas.activo','empresas.contacto',
                              'empresas.correo','empresas.telefono')
                              ->where('empresas.idem', '=', $empresa->idem)->get();

      return view('empresas.edit')
      ->with('consulta', $consulta[0]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, Empresa $empresas)
     {

         $this->validate($request,[
           'rfc' => ['required', 'regex:/^[A-Z]{3}[0-9]{6}[A-Z,0-9]{3}$/',Rule::unique('empresas')->ignore($empresas->rfc, 'rfc')],
           'nombre'=>['required', 'regex:/^[A-Z][A-Z,a-z, ,é,É,í,Í,ó,Ó,ú,Ú,á,Á,ü,Ü,ñ,Ñ]+$/', Rule::unique('empresas')->ignore($empresas->nombre, 'nombre')],
           'direccion'=>'required|regex:/^[A-Z,a-z, ,é,É,í,Í,ó,Ó,ú,Ú,á,Á,ü,Ü,ñ,Ñ,0-9]+$/',
           'ciudad'=>'required|regex:/^[A-Z][A-Z,a-z, ,é,É,í,Í,ó,Ó,ú,Ú,á,Á,ü,Ü,ñ,Ñ]+$/',
           'pagina_web'=>'required',
           'contacto'=>'required|regex:/^[A-Z][A-Z,a-z, ,é,É,í,Í,ó,Ó,ú,Ú,á,Á,ü,Ü,ñ,Ñ]+$/',
           'correo'=>['required','email',Rule::unique('empresas')->ignore($empresas->correo, 'correo')],
           'telefono'=>'required|regex:/^[0-9,(,),-]+$/',
           'tipo'=>'required',
           'tamaño'=>'required',
           'activo'=>'required',
         ]);
         $empresas = Empresa::find($empresas->idem);
         $empresas->rfc = $request->rfc;
         $empresas->nombre = $request->nombre;
         $empresas->direccion = $request->direccion;
         $empresas->ciudad = $request->ciudad;
         $empresas->pagina_web = $request->pagina_web;
         $empresas->contacto = $request->contacto;
         $empresas->correo = $request->correo;
         $empresas->telefono = $request->telefono;
         $empresas->activo = $request->activo;
         $empresas->tipo = $request->tipo;
         $empresas->tamaño = $request->tamaño;
         $empresas->save();
         return redirect()->route('empresas.index')->with('message',"Registro actualizado exitosamente.");
     }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy(Empresa $item)
     {
      $buscaasesor =AsesorIndustrial::where('idem',$item->idem)->get();
      $cuantos = count($buscaasesor);
      // dd($cuantos);
      if($cuantos==0)
      {
        $item->forceDelete();
        return redirect()->route('empresas.index')->with('message',"Registro eliminado exitosamente");
     } else {
      return redirect()->route('empresas.index')->with('message',"El registro no se puede eliminar ya que tiene registros en Asesores Industriales");
     }
    }

     public function toggleStatus(Request $request, Empresa $item)
     {
         $item->update($request->only('activo'));
         if($item->activo==1){
             return redirect()->route('empresas.index')->with('message', 'Registro activado exitosamente');
         }
         else{
             return redirect()->route('empresas.index')->with('message', 'Registro desactivado exitosamente');
         }
    }
}
