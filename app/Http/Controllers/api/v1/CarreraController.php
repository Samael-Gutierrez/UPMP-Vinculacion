<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    public function index(Request $request)
    {
        if($request->idce){
            $carreras = Carrera::latest()->where('activo', 1)->where('idce', $request->idce)->get();

            return response()->json($carreras, 200);
        }

        $carreras = Carrera::latest()->where('activo', 1)->get();
        return response()->json($carreras, 200);
    }
}
