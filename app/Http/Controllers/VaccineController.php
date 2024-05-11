<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreVaccineRequest;
use App\Http\Requests\UpdateVaccineRequest;
use App\Models\Vaccine;
use App\Models\Bird;
use App\Models\PlateColor;



class VaccineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id)
    {
    
        if ($id) {
            $vaccines = Bird::with('vaccine','plateColor')->find($id);
        } 
    
        return response()->json([
            'message' => 'Se han listado todas las vacunas correctamente.',
            'vaccines' => $vaccines ?? [],
        ], 200);
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
                'bird_id' => 'required',
                'blister' => 'nullable',
                'pill' => 'nullable',
                'drops' => 'nullable',
                'internal_deworming' => 'nullable',
                'external_deworming' => 'nullable',
                'date' => 'nullable|date',
                'observations' => 'nullable',
            ]);
    
            // Establecer valores predeterminados para campos nulos
            $validatedData['blister'] = $validatedData['blister'] ?? 'no hay ampolla';
            $validatedData['pill'] = $validatedData['pill'] ?? 'sin datos';
            $validatedData['drops'] = $validatedData['drops'] ?? 'sin datos';
            $validatedData['internal_deworming'] = $validatedData['internal_deworming'] ?? 'sin datos';
            $validatedData['external_deworming'] = $validatedData['external_deworming'] ?? 'sin datos';
            $validatedData['date'] = $validatedData['date'] ?? 'sin datos';
            $validatedData['observations'] = $validatedData['observations'] ?? 'sin observaciones';
    
            $vaccine = Vaccine::create($validatedData);
    
            return response()->json([
                'message' => 'La vacuna para el ave se creó exitosamente',
                'vaccine' => $vaccine
            ], 201);
        } catch (\Exception $e) {
            // Manejar cualquier excepción capturada aquí
            return response()->json([
                'message' => 'Se produjo un error al intentar crear la vacuna para el ave',
                'error' => $e->getMessage(),
                'request' => $request
            ], 500);
        }
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(Vaccine $vaccine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vaccine $vaccine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVaccineRequest $request, Vaccine $vaccine)
    {
        try {
            // Validar los datos del formulario
            $validatedData = $request->validated();
            
            // Actualizar la vacuna con los datos validados
            $vaccine->update($validatedData);
            
            // Devolver una respuesta JSON indicando el éxito de la operación
            return response()->json([
                'message' => 'Vacuna actualizada exitosamente.',
                'vaccine' => $vaccine,
            ], 200);
        } catch (\Throwable $th) {
            // Manejar cualquier excepción que se produzca
            return response()->json([
                'message' => 'Se produjo un error al intentar actualizar la vacuna.',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vaccine $vaccine)
    {
        try {
            // Eliminar la vacuna
            $vaccine->delete();
            
            // Devolver una respuesta JSON indicando el éxito de la operación
            return response()->json([
                'message' => 'Vacuna eliminada exitosamente.',
            ], 200);
        } catch (\Throwable $th) {
            // Manejar cualquier excepción que se produzca
            return response()->json([
                'message' => 'Se produjo un error al intentar eliminar la vacuna.',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

}
