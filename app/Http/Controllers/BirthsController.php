<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBirthsRequest;
use App\Http\Requests\UpdateBirthsRequest;
use App\Models\Births;

class BirthsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index(Request $request)
{
    // Obtener el parámetro de búsqueda del número de placa
    $birdId = $request->query('birdId');

    // Filtrar las aves según el número de placa si se proporciona un valor de búsqueda
    if ($birdId !== '') {
        $births = Births::where('mother_id', 'LIKE', '%' . $birdId . '%')
            ->orWhere('father_id', 'LIKE', '%' . $birdId . '%')
            ->with(['father', 'mother'])
            ->get();
    } else {
        $births = Births::with(['father', 'mother'])->get();
    }

    return response()->json([
        'message' => 'Se han listado todas las aves correctamente.',
        'births' => $births,
        'length' => $births->count()
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
    public function store(StoreBirthsRequest $request)
    {
         // Validar los datos del formulario
         $validatedData = $request->validated();
        
         // Calcular la fecha de eclosión (20 días después de la fecha de los huevos)
         $date_eggs = $validatedData['date_eggs'];
         $date_hatching = date('Y-m-d', strtotime($date_eggs . ' +20 days'));
        
         // Crear un nuevo objeto Births con los datos proporcionados
         $births = Births::create([
             'number_eggs' => $validatedData['number_eggs'],
             'number_births' => $validatedData['number_births'],
             'father_id' => $validatedData['father_id'],
             'mother_id' => $validatedData['mother_id'],
             'date_eggs' => $date_eggs,
             'date_hatching' => $date_hatching
         ]);
     
         // Devolver una respuesta JSON con el objeto creado y un mensaje de éxito
         return response()->json([
             'message' => 'Se ha creado exitosamente.',
             'births' => $births
         ], 201);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Births $births)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Births $births)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBirthsRequest $request, Births $births)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Births $births)
    {
        //
    }
}
