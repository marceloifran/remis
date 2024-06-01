<?php

namespace App\Http\Controllers;

use App\Models\extras;
use Illuminate\Http\Request;

class ExtrasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $extras = extras::all();
        return view('extras.index', compact('extras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('extras.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required',
        ]);
    
        $extra = new extras();
        $extra->nombre = $request->nombre;
        $extra->precio = $request->precio;
    
        $extra->save();
        return redirect()->route('extras.index')->with('success', 'Extra creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(extras $extras)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $extras = extras::find($id);
        return view('extras.editar', compact('extras'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required',
        ]);
    
        $extra = extras::find($id);
        $extra->nombre = $request->nombre;
        $extra->precio = $request->precio;
    
        $extra->save();
        return redirect()->route('extras.index')->with('success', 'Extra actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $extra = extras::find($id);
        $extra->delete();
        return redirect()->route('extras.index')->with('success', 'Extra eliminado exitosamente');
    }
}
