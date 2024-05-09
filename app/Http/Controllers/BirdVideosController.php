<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests\StoreBirdVideosRequest;
use App\Http\Requests\UpdateBirdVideosRequest;
use App\Models\BirdVideos;

class BirdVideosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // Validar la solicitud utilizando las reglas definidas en StoreBirdVideosRequest
        $request->validate([
            'bird_id' => 'required', // Debes definir las reglas de validación según tus necesidades
            'link_video' => 'required|file|mimes:mp4,mov,avi,wmv', // Asegúrate de que el campo 'link_video' sea requerido y sea un video
        ]);
        
        // Obtener el ID del ave del formulario
        $birdId = $request->bird_id;
        
        // Obtener el archivo de vídeo del formulario
        $video = $request->file('link_video');
        
        // Generar un nombre único para el vídeo
        $videoName = time() . '_' . $video->getClientOriginalName();
        
        // Mover el archivo a la carpeta public/videos
        $video->move(public_path('videos'), $videoName);
        
        // Crear una nueva instancia de BirdVideos con los datos validados
        $birdVideo = BirdVideos::create([
            'bird_id' => $birdId, // Asignar el ID del ave al campo bird_id
            'link_video' => 'videos/' . $videoName, // Almacenar la ruta del vídeo en la base de datos
        ]);
        
        // Devolver una respuesta de éxito
        return response()->json([
            'message' => 'Video uploaded successfully',
            'data' => $birdVideo
        ], 201);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(BirdVideos $birdVideos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BirdVideos $birdVideos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBirdVideosRequest $request, BirdVideos $birdVideos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BirdVideos $birdVideos, $id)
    {
        // Buscar el vídeo del ave por su ID
        $birdVideo = BirdVideos::findOrFail($id);
        
        // Obtener la ruta completa del vídeo
        $videoPath = public_path($birdVideo->link_video);
        
        // Verificar si el archivo de vídeo existe
        if (file_exists($videoPath)) {
            // Eliminar el archivo de vídeo del sistema de archivos
            unlink($videoPath);
        }
        
        // Eliminar el vídeo del ave de la base de datos
        $birdVideo->delete();
        
        // Devolver una respuesta de éxito
        return response()->json([
            'message' => '¡El vídeo del ave ha sido eliminado correctamente!',
        ], 200);
    }
}
