<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Grupo;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function index(Request $request){

        if(isset($request->idca) || isset($request->idce)){

            $grupos = Grupo::latest()->where('activo', 1)->where('idca', $request->idca)->where('idce', $request->idce)->get();

            return response()->json($grupos, 200);
        }

        $grupos = Grupo::latest()->where('activo', 1)->get();

        return response()->json($grupos, 200);
    }
}
