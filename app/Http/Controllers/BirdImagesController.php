<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreBirdImagesRequest;
use App\Http\Requests\UpdateBirdImagesRequest;
use App\Models\BirdImage;

class BirdImagesController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $birdImages = BirdImage::all();

        return response()->json([
            'message' => 'Se han listado todas las aves correctamente.',
            'birdImages' => $birdImages,
            'length' => count($birdImages)
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
            // Validar la solicitud utilizando las reglas definidas en StoreBirdImagesRequest
            $validated = $request->validate([
                'bird_id' => 'required', // Aquí debes definir las reglas de validación según tus necesidades
                'link_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp', // También asegúrate de que el campo 'link_image' sea requerido y sea una imagen
            ]);
    
            // Obtener el ID del ave del formulario
            $birdId = $validated['bird_id'];
    
            // Obtener el archivo de imagen del formulario
            $image = $request->file('link_image');
    
            // Generar un nombre único para la imagen
            $imageName = time() . '_' . $image->getClientOriginalName();
    
            // Mover el archivo a la carpeta public/images
            $image->move(public_path('images'), $imageName);
    
            // Crear una nueva instancia de BirdImage con los datos validados
            $birdImage = BirdImage::create([
                'bird_id' => $birdId, // Asignar el ID del ave al campo bird_id
                'link_image' => 'images/' . $imageName, // Almacenar la ruta de la imagen en la base de datos
            ]);
    
            // Devolver una respuesta de éxito
            return response()->json([
                'message' => 'Image uploaded successfully',
                'data' => $birdImage
            ], 201);
        } catch (\Exception $e) {
            // Manejar cualquier excepción capturada
            return response()->json([
                'message' => 'Error uploading image: ' . $e->getMessage()
            ], 500);
        }
    }
    
    
    

    /**
     * Display the specified resource.
     */
    public function show(BirdImage $birdImage) // Corregir aquí
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BirdImage $birdImage) // Corregir aquí
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBirdImagesRequest $request, BirdImage $birdImage) // Corregir aquí
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BirdImage $birdImage, $id)
    {
        // Buscar la imagen del ave por su ID
        $birdImage = BirdImage::findOrFail($id);
    
        // Obtener la ruta completa de la imagen
        $imagePath = public_path($birdImage->link_image);
    
        // Verificar si el archivo de imagen existe
        if (file_exists($imagePath)) {
            // Eliminar el archivo de imagen del sistema de archivos
            unlink($imagePath);
        }
    
        // Eliminar la imagen del ave de la base de datos
        $birdImage->delete();
    
        // Devolver una respuesta de éxito
        return response()->json([
            'message' => '¡La imagen del ave ha sido eliminada correctamente!',
        ], 200);
    }
}
