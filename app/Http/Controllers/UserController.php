<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = User::with('rol')->get();
        return view('users.index', compact('users'));
        /* $users = $user->with('rol')->get();
        return $users; */
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->only('password', 'password_confirmation'));

        // 1. Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'rol_id' => 'required|exists:roles,id',
            'estado' => 'boolean'
        ]);

        // 2. Crear el usuario encriptando la contraseña
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encriptación vital
            'rol_id' => $request->rol_id,
            'estado' => $request->boolean('estado'),
        ]);

        // 3. Redireccionar con mensaje de éxito
        return redirect()->route('users.index')
                         ->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // 1. Validar (excluyendo el usuario actual de la regla unique)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'rol_id' => 'required|exists:roles,id',
            'estado' => 'boolean'
        ]);

        // 2. Preparar los datos a actualizar
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'rol_id' => $request->rol_id,
            'estado' => $request->boolean('estado'),
        ];

        // 3. Solo actualizar la contraseña si el usuario escribió una nueva
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // 4. Guardar cambios y redireccionar
        $user->update($data);

        return redirect()->route('users.index')
                         ->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
                         ->with('success', 'Usuario eliminado correctamente.');
    }
}
