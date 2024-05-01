<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests\StoreOriginRequest;
use App\Http\Requests\UpdateOriginRequest;
use App\Models\Origin;

class OriginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $origins = Origin::all();
    
            return response()->json([
                'message' => 'Se han listado todos los tipos de origen para las aves correctamente.',
                'origins' => $origins,
                'length' => $origins->count()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Se produjo un error al intentar obtener los tipos de origen para las aves.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
            ]);
    
            $origin = Origin::create([
                'name' => $validatedData['name'],
            ]);
        
            // Devolver una respuesta JSON con el objeto creado y un mensaje de éxito
            return response()->json([
                'message' => 'El origen para el ave ha sido creado exitosamente',
                'origin' => $origin
            ], 201);
        } catch (\Exception $e) {
            // Manejar cualquier excepción capturada aquí
            return response()->json([
                'message' => 'Se produjo un error al intentar crear el origen para el  ave',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Origin $origin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Origin $origin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOriginRequest $request,  $id)
    {
        try {
            // Obtener el color del ave por su ID
            $origin = Origin::findOrFail($id);
    
            // Validar los datos recibidos en la solicitud
            $validatedData = $request->validated();
    
            // Actualizar los atributos del color del ave
            $origin->update([
                'name' => $validatedData['name'],
            ]);
        
            // Devolver una respuesta JSON con el objeto actualizado y un mensaje de éxito
            return response()->json([
                'origin' => $origin
            ], 200);
        } catch (\Exception $e) {
            // Manejar cualquier excepción capturada aquí
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Origin $origin)
    {
        //
    }
}
