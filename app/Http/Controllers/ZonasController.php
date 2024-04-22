<?php

namespace App\Http\Controllers;

use App\Models\zonas;
use Illuminate\Http\Request;
use MatanYadaev\EloquentSpatial\Objects\Point;

class ZonasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $zonas = zonas::all();
        return view('zonas.index', compact('zonas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('zonas.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'zona' => 'required',
            'precio' => 'required',
        ]);
    
        $zona = new zonas();
        $zona->nombre = $request->nombre;
        $zona->zona = $request->zona;
        $zona->precio = $request->precio;
    
        $zona->save();
        return redirect()->route('zonas.index')->with('success', 'Zona creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(zonas $zonas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $zonas = zonas::find($id);
        return view('zonas.editar', compact('zonas'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $zona = zonas::find($id);
        $zona->nombre = $request->nombre;
        $zona->zona = $request->zona;
        $zona->precio = $request->precio;
        $zona->save();
        return redirect()->route('zonas.index')->with('success', 'Zona actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $zona = zonas::find($id);
        $zona->delete();
        return redirect()->route('zonas.index')->with('success', 'Zona eliminada exitosamente');
    }
}
