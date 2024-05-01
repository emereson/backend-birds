<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests\StoreStatusRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Models\Status;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $status = Status::all();
    
            return response()->json([
                'message' => 'Se han listado todos los tipos de estado para las aves correctamente.',
                'status' => $status,
                'length' => $status->count()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Se produjo un error al intentar obtener los tipos de estado para las aves.',
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
    
            $status = Status::create([
                'name' => $validatedData['name'],
            ]);
        
            // Devolver una respuesta JSON con el objeto creado y un mensaje de éxito
            return response()->json([
                'message' => 'El estado para el ave ha sido creado exitosamente',
                'status' => $status
            ], 201);
        } catch (\Exception $e) {
            // Manejar cualquier excepción capturada aquí
            return response()->json([
                'message' => 'Se produjo un error al intentar crear el color del ave',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Status $status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStatusRequest $request, $id)
    {
        try {
            // Obtener el color del ave por su ID
            $status = Status::findOrFail($id);
    
            // Validar los datos recibidos en la solicitud
            $validatedData = $request->validated();
    
            // Actualizar los atributos del color del ave
            $status->update([
                'name' => $validatedData['name'],
            ]);
        
            // Devolver una respuesta JSON con el objeto actualizado y un mensaje de éxito
            return response()->json([
                'status' => $status
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
    public function destroy(Status $status)
    {
        //
    }
}
