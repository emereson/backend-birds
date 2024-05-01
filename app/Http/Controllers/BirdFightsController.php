<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBird_FigtsRequest;
use App\Http\Requests\UpdateBird_FigtsRequest;
use App\Models\Bird_Fights;

class BirdFightsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getBirdFights($id)
    {
        try {
            // Obtener todas las peleas asociadas al ID del ave
            $birdFights = Bird_Fights::where('bird_id', $id)->get();
            
            // Devolver una respuesta JSON con las peleas encontradas
            return response()->json([
                'message' => 'Peleas encontradas para el ave con ID ' . $id,
                'birdFights' => $birdFights,
            ], 200);
        } catch (\Throwable $th) {
            // Manejar cualquier excepción que se produzca
            return response()->json([
                'message' => 'Se produjo un error al intentar obtener las peleas del ave.',
                'error' => $th->getMessage(),
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
    public function store(StoreBird_FigtsRequest $request)
    {
        try {
            $validatedData = $request->validated();
    
            $birdFigth = Bird_Fights::create([
                'number_fight' => $validatedData['number_fight'],
                'coliseum' => $validatedData['coliseum'],
                'opponent' => $validatedData['opponent'],
                'weight' => $validatedData['weight'],
                'date_fight' => $validatedData['date_fight'],
                'minutes' => $validatedData['minutes'],
                'state' => $validatedData['state'],
                'bird_id' => $validatedData['bird_id'],
            ]);
            
            // Puedes devolver una respuesta JSON indicando el éxito de la operación si es necesario
            return response()->json([
                'message' => 'Registro de pelea de ave creado exitosamente.',
                'birdFight' => $birdFigth,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Se produjo un error al intentar crear el registro de pelea de ave.',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Bird_Figts $bird_Figts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bird_Figts $bird_Figts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBird_FigtsRequest $request, Bird_Figts $bird_Figts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bird_Figts $bird_Figts)
    {
        //
    }
}
