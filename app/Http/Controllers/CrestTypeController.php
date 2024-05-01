<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests\StoreCrestTypeRequest;
use App\Http\Requests\UpdateCrestTypeRequest;
use App\Models\CrestType;

class CrestTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $crestTypes = CrestType::all();
    
            return response()->json([
                'message' => 'Se han listado todos los tipos de crestas para las aves correctamente.',
                'crestTypes' => $crestTypes,
                'length' => $crestTypes->count()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Se produjo un error al intentar obtener los tipos de cresta para las aves.',
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
    
            $crestType = CrestType::create([
                'name' => $validatedData['name'],
            ]);
        
            // Devolver una respuesta JSON con el objeto creado y un mensaje de éxito
            return response()->json([
                'message' => 'El tipo de cresta para el ave ha sido creado exitosamente',
                'crestType' => $crestType
            ], 201);
        } catch (\Exception $e) {
            // Manejar cualquier excepción capturada aquí
            return response()->json([
                'message' => 'Se produjo un error al intentar crear el tipo de cresta para el  ave',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CrestType $crestType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CrestType $crestType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCrestTypeRequest $request, $id)
    {
        try {
            // Obtener el color del ave por su ID
            $crestType = CrestType::findOrFail($id);
    
            // Validar los datos recibidos en la solicitud
            $validatedData = $request->validated();
    
            // Actualizar los atributos del color del ave
            $crestType->update([
                'name' => $validatedData['name'],
            ]);
        
            // Devolver una respuesta JSON con el objeto actualizado y un mensaje de éxito
            return response()->json([
                'message' => 'El tipo de cresta para el ave ha sido actualizado exitosamente',
                'crestType' => $crestType
            ], 200);
        } catch (\Exception $e) {
            // Manejar cualquier excepción capturada aquí
            return response()->json([
                'message' => 'Se produjo un error al intentar actualizar el tipo de cresta del ave',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CrestType $crestType)
    {
        //
    }
}
