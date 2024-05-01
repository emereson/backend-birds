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
    public function store(StoreVaccineRequest $request)
    {
        try {

        $validatedData = $request->validated();
    
        $vaccine = Vaccine::create([
            'bird_id' => $validatedData['bird_id'],
            'blister' => $validatedData['blister'],
            'pill' => $validatedData['pill'],
            'drops' => $validatedData['drops'],
            'internal_deworming' => $validatedData['internal_deworming'],
            'external_deworming' => $validatedData['external_deworming'],
            'date' => $validatedData['date'],
        ]);

        return response()->json([
            'message' => 'La vacuna para el ave se creo exitosamente',
            'vaccine' => $vaccine
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
    public function update(UpdateVaccineRequest $request, Vaccine $vaccine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vaccine $vaccine)
    {
        //
    }
}
