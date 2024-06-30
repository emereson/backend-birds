<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests\StoreLineRequest;
use App\Http\Requests\UpdateLineRequest;
use App\Models\Line;

class LineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $lines = Line::all();
    
            return response()->json([
                'message' => 'Se han listado todos los tipos de linea para las aves correctamente.',
                'lines' => $lines,
                'length' => $lines->count()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Se produjo un error al intentar obtener los tipos de linea para las aves.',
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
    
            $line = Line::create([
                'name' => $validatedData['name'],
            ]);
        
            // Devolver una respuesta JSON con el objeto creado y un mensaje de éxito
            return response()->json([
                'message' => 'La linea para el ave ha sido creado exitosamente',
                'line' => $line
            ], 201);
        } catch (\Exception $e) {
            // Manejar cualquier excepción capturada aquí
            return response()->json([
                'message' => 'Se produjo un error al intentar crear la linea para el  ave',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Line $line)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Line $line)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLineRequest $request,  $id)
    {
        try {
            // Obtener el color del ave por su ID
            $line = Line::findOrFail($id);
    
            // Validar los datos recibidos en la solicitud
            $validatedData = $request->validated();
    
            // Actualizar los atributos del color del ave
            $line->update([
                'name' => $validatedData['name'],
            ]);
        
            // Devolver una respuesta JSON con el objeto actualizado y un mensaje de éxito
            return response()->json([
                'line' => $line
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
    public function destroy($id)
    {
        try {
            // Obtener el color del ave por su ID
            $line = Line::findOrFail($id);

            // Eliminar el color del ave
            $line->delete();

            return response()->json([
                'message' => 'El line para el ave ha sido eliminado exitosamente',
            ], 200);
        } catch (\Exception $e) {
            // Manejar cualquier excepción capturada aquí
            return response()->json([
                'message' => 'Se produjo un error al intentar eliminar el line del ave',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
