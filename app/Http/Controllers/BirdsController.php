<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBirdsRequest;
use App\Http\Requests\UpdateBirdsRequest;
use App\Models\Bird;
use App\Models\BirdImage;
use App\Models\BirdVideos;
use Illuminate\Support\Facades\DB; // Agrega esta línea




class BirdsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexBirdInCare(Request $request)
    {
        $search = $request->query('search');
        $inCare = $request->query('inCare');
    
        // Filtrar las aves según el estado de cuidado si se proporciona un valor de búsqueda
        if ($inCare === 'all') {
            $birds = Bird::where('plate_number', 'LIKE', '%' . $search . '%')->with('plateColor')->get();
        } else {
            $birds = Bird::where('plate_number', 'LIKE', '%' . $search . '%')->where('in_care', $inCare)->with('plateColor')->get();
        }
    
        return response()->json([
            'message' => 'Se han listado todas las aves correctamente.',
            'birds' => $birds,
            'length' => count($birds)
        ], 200);
    }
    


    public function indexMother(Request $request)
    {
        // Obtener el parámetro de búsqueda del número de placa
        $search = $request->query('search');
    
        // Filtrar las aves según el número de placa si se proporciona un valor de búsqueda
        if ($search) {
            $birds = Bird::where('plate_number', 'LIKE', '%' . $search . '%')
            ->where('sex', 'hembra')
            ->with('plateColor')
            ->get();
            } 
    
        return response()->json([
            'message' => 'Se han listado todas las aves correctamente.',
            'birds' => $birds,
            'length' => count($birds)
        ], 200);
    }

    public function indexFather(Request $request)
    {
        // Obtener el parámetro de búsqueda del número de placa
        $search = $request->query('search');
    
        // Filtrar las aves según el número de placa si se proporciona un valor de búsqueda
        if ($search) {
            $birds = Bird::where('plate_number', 'LIKE', '%' . $search . '%')
            ->where('sex', 'macho')
            ->with('plateColor')
            ->get();
            } 
    
        return response()->json([
            'message' => 'Se han listado todas las aves correctamente.',
            'birds' => $birds,
            'length' => count($birds)
        ], 200);
    }

    public function index(Request $request)
    {
        // Obtener el parámetro de búsqueda del número de placa
        $search = $request->query('search');
    
        // Filtrar las aves según el número de placa si se proporciona un valor de búsqueda
        if ($search !== '') {
            $birds = Bird::where('plate_number', 'LIKE', '%' . $search . '%')
            ->with('plateColor')
            ->get();
            } else{
                $birds = Bird::all();
            }
    
        return response()->json([
            'message' => 'Se han listado todas las aves correctamente.',
            'birds' => $birds,
            'length' => count($birds)
        ], 200);
    }

    public function index_one(Request $request,$id)
    {
        // Obtener el parámetro de búsqueda del número de placa
        $bird = Bird::with('birdImage','plateColor','birdVideos')->find($id);
        if ($bird) {
            
            $father_bird = Bird::with([ 'plateColor'])
            ->where('id', $bird->father_bird_id)
            ->first();

            $mother_bird = Bird::with([ 'plateColor'])
            ->where('id', $bird->mother_bird_id)
            ->first();
    }


        return response()->json([
            'message' => 'Se han listado el ave correctamente.',
            'bird' => $bird,
            'father_bird' => $father_bird,
            'mother_bird' => $mother_bird

        ], 200);
    }

    public function index_family_tree(Request $request, $id)
    {
        try {
            // Buscar el ave por su ID
            $bird = Bird::with('birdImage','plateColor')->find($id);
            
            // Verificar si se encontró el ave
            if ($bird) {
                // Inicializar un array para cada generación de ancestros
                $ancestorsByGeneration = [];
    
                // Función para obtener los ancestros de una generación
                $getAncestors = function($birdId, $generation) use (&$getAncestors, &$ancestorsByGeneration) {
                    // Buscar el ave por su ID
                    $bird = Bird::with('birdImage','plateColor')->find($birdId);
                    
                    if ($bird && $generation <= 4) { // Verificar que no se exceda de 4 generaciones
                        // Obtener el padre y la madre del ave
                        $father = Bird::with('birdImage','plateColor')->find($bird->father_bird_id);
                        $mother = Bird::with('birdImage','plateColor')->find($bird->mother_bird_id);
                        
                        // Agregar el padre y la madre al array de la generación correspondiente
                      // Agregar el padre y la madre al array de la generación correspondiente
                        if ($father) {
                            if (!isset($ancestorsByGeneration[$generation])) {
                                $ancestorsByGeneration[$generation] = [];
                            }
                            $father->type = 'Padre'; // Etiqueta al padre
                            $ancestorsByGeneration[$generation][] = $father;
                            $getAncestors($father->id, $generation + 1); // Llamada recursiva para obtener los ancestros del padre
                        }
                        if ($mother) {
                            if (!isset($ancestorsByGeneration[$generation])) {
                                $ancestorsByGeneration[$generation] = [];
                            }
                            $mother->type = 'Madre'; // Etiqueta a la madre
                            $ancestorsByGeneration[$generation][] = $mother;
                            $getAncestors($mother->id, $generation + 1); // Llamada recursiva para obtener los ancestros de la madre
                        }

                    }
                };
    
                // Obtener los ancestros del ave
                $getAncestors($bird->id, 1); // Comenzar desde la primera generación
    
                // Devolver la respuesta con la información del ave y sus ancestros agrupados por generación
                return response()->json([
                    'message' => 'Se ha listado el ave correctamente.',
                    'bird' => $bird,
                    'ancestors_by_generation' => $ancestorsByGeneration,
                ], 200);
            } else {
                // Devolver null si no se encontró el ave
                return response()->json([
                    'message' => 'El ave con el ID proporcionado no fue encontrada.',
                    'bird' => null,
                    'ancestors_by_generation' => [],
                ], 200);
            }
        } catch (\Exception $e) {
            // Manejar cualquier excepción capturada aquí
            return response()->json([
                'message' => 'Se produjo un error al intentar recuperar la información del ave.',
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
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'plate_color_id' => 'required',
            'plate_number' => 'required',
            'sex' => 'required',
            'father_bird_id' => 'nullable',
            'mother_bird_id' => 'nullable',
            'birthdate' => 'required|date',
            'bird_color' => 'required',
            'crest_type' => 'required',
            'line' => 'required',
            'weight' => 'required',
            'status' => 'required',
            'origin' => 'required',
            'observations' => 'required',
            'link_image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'link_video.*' => 'nullable', // Max 20MB para videos
        ]);
    
        $birdColor = json_decode($request->input('bird_color'));
        $validatedData['bird_color'] = $birdColor;
        
        $bird = Bird::create($validatedData);

     
        $images = $request-> link_image;
     
        
        foreach ($images as $image) {
            // Generar un nombre único para la imagen
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);

            BirdImage::create([
                'bird_id' => $bird->id,
                'link_image' => 'images/' . $imageName,
            ]);
        }

        $videos = $request-> link_video;

        if ($videos) {
            foreach ($videos as $video) {
                // Generar un nombre único para la imagen
                $videoName = time() . '_' . $video->getClientOriginalName();
                $video->move(public_path('videos'), $videoName);
    
                BirdVideos::create([
                    'bird_id' => $bird->id,
                    'link_video' => 'videos/' . $videoName,
                ]);
            }
        }
    
  

        // Retorna una respuesta adecuada
        return response()->json([
            'message' => 'El ave ha sido creada correctamente',
            'bird' => $bird,
        ], 201);
    } catch (\Exception $e) {
        // Manejar cualquier excepción capturada aquí
        return response()->json([
            'message' => 'Se produjo un error al intentar crear el ave',
            'error' => $e->getMessage(),
        ], 500);
    }
}

    
    
    /**
     * Display the specified resource.
     */
    public function show(Birds $birds)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Birds $birds)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBirdsRequest $request, $id)
    {
        // Buscar el ave por su ID
        $bird = Bird::findOrFail($id);
        
        // Validar los datos del formulario
        $validatedData = $request->validated();
        
        // Actualizar el ave con los datos validados
        $bird->update($validatedData);

        // Devolver una respuesta JSON con el ave actualizada y un mensaje de éxito
        return response()->json([
            'message' => '¡El ave ha sido actualizada exitosamente!',
            'bird' => $bird
        ], 200);
    }
    
    
    

    public function updateInCare(Request $request, $id)
    {
        try {
            // Obtener el ave por su ID
            $bird = Bird::findOrFail($id);
    
            $validatedData = $request->validate([
                'in_care' => 'required',
            ]);
            
    
            // Actualizar el estado de cuidado del ave
            $bird->update([
                'in_care' => $validatedData['in_care'],
            ]);
        
            // Devolver una respuesta JSON con el ave actualizada y un mensaje de éxito
            return response()->json([
                'message' => 'El estado de cuidado del ave se actualizó correctamente.',
                'bird' => $bird
            ], 200);
  
        } catch (\Exception $e) {
            // Manejar cualquier otra excepción inesperada aquí
            return response()->json([
                'error' => $e->getMessage(),

            ], 500);
        }   
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        try {
            // Desactivar las restricciones de clave externa
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
    
            // Eliminar todas las imágenes relacionadas con las aves que se van a eliminar
            BirdImage::where('bird_id', $id)->delete();
    
            // Eliminar el ave
            Bird::findOrFail($id)->delete();
    
            // Volver a activar las restricciones de clave externa
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
    
            return response()->json([
                'message' => 'Se han eliminado todas las aves y sus imágenes relacionadas correctamente.'
            ], 200);
        } catch (\Exception $e) {
            // Manejar cualquier excepción capturada aquí
            return response()->json([
                'message' => 'Se produjo un error al intentar eliminar todas las aves y sus imágenes relacionadas.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    
    
}
