<?php

namespace App\Http\Controllers;

use App\Models\extras;
use App\Models\User;
use App\Models\viaje;
use App\Models\zonas;
use Illuminate\Http\Request;

class ViajeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Verificar si el usuario tiene el rol de administrador
    if (auth()->user()->hasRole('admin')) {
        // Si es administrador, mostrar todos los viajes
        $viajes = Viaje::all();
    } else {
        // Si no es administrador, mostrar solo los viajes donde el usuario sea el chofer
        $viajes = Viaje::where('user_id', auth()->user()->id)->get();
    }

    return view('viajes.index', compact('viajes'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $zonas = zonas::all();
        $extras = extras::all();
        $usuarios = User::role('chofer')->get();
        return view('viajes.crear', compact('zonas','extras', 'usuarios'));

        
    }

    public function buscarZona($id)
    {
        try {
            $zona = zonas::findOrFail($id);
            return response()->json(['precio' => $zona->precio]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Zona no encontrada'], 404);
        }
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all()); // Agregar esta línea para imprimir todos los datos recibidos en la solicitud

        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'desde' => 'required|exists:zonas,id',
            'hasta' => 'required|exists:zonas,id',
            'user_id' => 'required|exists:users,id',
            'metodoPago' => 'required|in:transferencia,efectivo',
            'totalPagar' => 'required|numeric|min:0',
        ]);
    
        $viaje = new Viaje();
        $viaje->fecha = $request->fecha;
        $viaje->hora = $request->hora;
        $viaje->desde = $request->desde;
        $viaje->hasta = $request->hasta;
        $viaje->user_id = $request->user_id;
        $viaje->metodoPago = $request->metodoPago;
        $viaje->totalPagar = $request->totalPagar;
        $viaje->save();
    
        return redirect()->route('viajes.index')->with('success', 'Viaje creado exitosamente.');
    }
    


    /**
     * Display the specified resource.
     */
    public function show(viaje $viaje)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $viaje = Viaje::findOrFail($id);
        $usuarios = User::all();
        $zonas = zonas::all();
        return view('viajes.editar', compact('viaje', 'usuarios', 'zonas'));
    }
    /**
     * Update the specified resource in storage.
     */
    // Método para actualizar el viaje
    public function update(Request $request, $id)
    {
        // Validación de los campos (puedes usar la misma validación que en store)

        // Actualizar el viaje
        $viaje = Viaje::findOrFail($id);
        $viaje->fecha = $request->fecha;
        $viaje->hora = $request->hora;
        $viaje->desde = $request->desde;
        $viaje->hasta = $request->hasta;
        $viaje->user_id = $request->user_id;
        $viaje->metodoPago = $request->metodoPago;
        $viaje->totalPagar = $request->totalPagar;
        // Actualizar más campos según sea necesario
        $viaje->save();

        // Redireccionar a la vista de detalle del viaje o a donde lo necesites
        return redirect()->route('viajes.index', $viaje->id)->with('success', 'Viaje actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Buscar el viaje
        $viaje = Viaje::findOrFail($id);

        // Eliminar el viaje
        $viaje->delete();

        // Redireccionar a la lista de viajes o a donde lo necesites
        return redirect()->route('viajes.index')->with('success', 'Viaje eliminado exitosamente.');
    }
}
