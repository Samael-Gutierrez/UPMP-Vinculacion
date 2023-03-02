<?php

namespace App\Http\Controllers;

use App\Models\AsesorAcademico;
use Illuminate\Http\Request;

class AsesoresAcademicosController extends Controller
{
    public function index(Request $request)
    {
       $items = AsesorAcademico::orderBy('nombre', 'asc')
                ->where('nombre', 'LIKE', "%$request->q%")
                ->where('idtu', '=', 2)
                ->paginate( ($request->paginate) ? $request->paginate : 10 );

        return view('asesores_academicos.index', compact('items'));
    }

}
