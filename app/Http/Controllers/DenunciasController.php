<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;

class DenunciasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('denuncias.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('denuncias.action', [
            'denuncia' => null,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Denuncia $denuncia)
    {
        return view('denuncias.action', [
            'denuncia' => $denuncia,
        ]);
    }
}
