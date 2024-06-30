<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBirdColorRequest;
use App\Http\Requests\UpdateBirdColorRequest;
use App\Models\BirdColor;

class BirdColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $birdColors = BirdColor::all();
    
            return response()->json([
                'message' => 'Se han listado todos los colores para las aves correctamente.',
                'birdColors' => $birdColors,
                'length' => $birdColors->count()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Se produjo un error al intentar obtener los colores para las aves.',
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
                'code_color' => 'required',
            ]);
    
            $birdColor = BirdColor::create([
                'name' => $validatedData['name'],
                'code_color' => $validatedData['code_color'],
            ]);
        
            // Devolver una respuesta JSON con el objeto creado y un mensaje de éxito
            return response()->json([
                'message' => 'El color para el ave ha sido creado exitosamente',
                'birdColor' => $birdColor
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
    public function show(BirdColor $birdColor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BirdColor $birdColor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBirdColorRequest $request, $id)
    {
        try {
            // Obtener el color del ave por su ID
            $birdColor = BirdColor::findOrFail($id);
    
            // Validar los datos recibidos en la solicitud
            $validatedData = $request->validated();
    
            // Actualizar los atributos del color del ave
            $birdColor->update([
                'name' => $validatedData['name'],
                'code_color' => $validatedData['code_color'],
            ]);
        
            // Devolver una respuesta JSON con el objeto actualizado y un mensaje de éxito
            return response()->json([
                'message' => 'El color para el ave ha sido actualizado exitosamente',
                'birdColor' => $birdColor
            ], 200);
        } catch (\Exception $e) {
            // Manejar cualquier excepción capturada aquí
            return response()->json([
                'message' => 'Se produjo un error al intentar actualizar el color del ave',
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
            $birdColor = BirdColor::findOrFail($id);

            // Eliminar el color del ave
            $birdColor->delete();

            return response()->json([
                'message' => 'El color para el ave ha sido eliminado exitosamente',
            ], 200);
        } catch (\Exception $e) {
            // Manejar cualquier excepción capturada aquí
            return response()->json([
                'message' => 'Se produjo un error al intentar eliminar el color del ave',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
