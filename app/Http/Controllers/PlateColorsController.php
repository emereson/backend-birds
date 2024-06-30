<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlateColorsRequest;
use App\Http\Requests\UpdatePlateColorsRequest;
use App\Models\PlateColor;
use App\Models\Bird;

class PlateColorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $plateColors = PlateColor::all();
    
            return response()->json([
                'message' => 'Se han listado todos los tipos de colores de placa para las aves correctamente.',
                'plateColors' => $plateColors,
                'length' => $plateColors->count()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Se produjo un error al intentar obtener los tipos de colores de placa para las aves.',
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
    public function store(StorePlateColorsRequest $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validated();
        
        // Crear un nuevo objeto PlateColor con los datos proporcionados
        $plateColor = PlateColor::create([
            'color' => $validatedData['color'],
            'code_color' => $validatedData['code_color'],
        ]);
    
        // Devolver una respuesta JSON con el objeto creado y un mensaje de éxito
        return response()->json([
            'message' => 'El color de placa ha sido creado exitosamente',
            'plateColor' => $plateColor
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PlateColors $plateColors)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlateColors $plateColors)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlateColorsRequest $request, $id)
    {
        try {
            // Obtener el color del ave por su ID
            $plateColor = PlateColor::findOrFail($id);
    
            // Validar los datos recibidos en la solicitud
            $validatedData = $request->validated();
    
            // Actualizar los atributos del color del ave
            $plateColor->update([
                'color' => $validatedData['color'],
                'code_color' => $validatedData['code_color'],

            ]);
        
            // Devolver una respuesta JSON con el objeto actualizado y un mensaje de éxito
            return response()->json([
                'plateColor' => $plateColor
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
            // Verificar si hay aves que usan este color de placa
            $birdsUsingPlateColor = Bird::where('plate_color_id', $id)->exists();

            if ($birdsUsingPlateColor) {
                return response()->json([
                    'message' => 'No se puede eliminar este color de placa porque hay aves que lo están usando.'
                ], 422); // Código 422 para indicar una solicitud inválida
            }

            // Si no hay aves usando este color de placa, eliminarlo
            $plateColor = PlateColor::findOrFail($id);
            $plateColor->delete();

            return response()->json([
                'message' => 'El color de placa ha sido eliminado exitosamente.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Se produjo un error al intentar eliminar el color de placa.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
