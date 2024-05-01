<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Obtener todos los usuarios
        $users = User::all();

        // Devolver una respuesta JSON con los usuarios
        return response()->json([
            'message' => 'Lista de usuarios obtenida correctamente.',
            'users' => $users,
        ], 200);
    }
    
    public function signup(Request $request)
    {
        // Validar los datos de la solicitud para el registro
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'last_name'=>'required',
            'password' => 'required|string',
        ]);

        // Crear un nuevo usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'last_name' => $request->last_name,
            'password' => bcrypt($request->password),
        ]);

        // Autenticar al usuario recién registrado
        Auth::login($user);

        // Devolver una respuesta JSON con el usuario creado y autenticado
        return response()->json([
            'message' => 'Usuario registrado y autenticado correctamente.',
            'user' => $user,
        ], 201);
    }

    public function login(Request $request)
    {
        // Validar los datos de la solicitud para el inicio de sesión
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Generar un token de autenticación para el usuario
            $token = $user->createToken('authToken')->plainTextToken;
    
            // Devolver una respuesta JSON con el usuario autenticado y el token
            return response()->json([
                'message' => 'Inicio de sesión exitoso.',
                'user' => $user,
                'token' => $token,
            ], 200);
        } else {
            // Devolver una respuesta JSON si las credenciales son incorrectas
            return response()->json([
                'message' => 'Credenciales incorrectas. Por favor, inténtalo de nuevo.',
            ], 401);
        }
    }

    public function update(Request $request, $id)
    {
        // Buscar el usuario por su ID
        $user = User::find($id);

        // Verificar si se encontró el usuario
        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado.',
                'user' => null,
            ], 404);
        }

        // Validar los datos de la solicitud
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            // Agregar más reglas de validación según sea necesario
        ]);

        // Actualizar el usuario con los nuevos datos
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            // Actualizar más atributos según sea necesario
        ]);

        // Devolver una respuesta JSON con el usuario actualizado
        return response()->json([
            'message' => 'Usuario actualizado correctamente.',
            'user' => $user,
        ], 200);
    }


    public function destroy($id)
    {
        // Buscar el usuario por su ID
        $user = User::find($id);

        // Verificar si se encontró el usuario
        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado.',
                'user' => null,
            ], 404);
        }

        // Eliminar el usuario
        $user->delete();

        // Devolver una respuesta JSON con un mensaje de éxito
        return response()->json([
            'message' => 'Usuario eliminado correctamente.',
        ], 200);
    }
}
