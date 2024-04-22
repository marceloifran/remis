<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function obtenerUbicacion(Request $request)
     {
         $user = auth()->user();
 
         if ($user) {
             $ubicacion = [
                 'latitude' => $user->latitude,
                 'longitude' => $user->longitude,
             ];
 
             return response()->json($ubicacion);
         }
 
         return response()->json(['message' => 'Usuario no autenticado'], 401);
     }
 
     public function compartirUbicacion(Request $request)
     {
         $user = auth()->user();
 
         if ($user) {
             // Actualizar los campos de ubicación en la instancia del modelo User
             $user->latitude = $request->input('latitude');
             $user->longitude = $request->input('longitude');
             $user->save();
 
             return response()->json(['message' => 'Ubicación compartida con éxito']);
         }
 
         return response()->json(['message' => 'Usuario no autenticado'], 401);
     }
 
    public function index()
    {
        $usuarios = User::all();
           return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('usuarios.crear', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('usuarios.editar', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));
        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente');
    }
}
