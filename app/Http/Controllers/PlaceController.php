<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $places = Place::with("category")->get();

        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Places fetched successfully!',
            ],
            'data' => [
                'places' => $places,
                'isAdmin' => true, // ou tout autre champ
            ],
        ]);
    }

    public function img(String $img)
    {
        $path = storage_path('app/public/places/' . $img);

        if (!file_exists($path)) {
            return response()->json(['error' => 'Image not found.'], 404);
        }

        return response()->file($path);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'img_preview' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'slug' => 'required|string|max:255|unique:places,slug',
            'id_category' => 'required|integer|exists:categories,id',
            'id_user' => 'required|integer|exists:users,id',
        ]);

        if ($request->hasFile('img_preview')) {
            $image = $request->file('img_preview');
            $originalName = $image->getClientOriginalName();
            // Remplace les espaces et caractères spéciaux par des tirets du bas
            $sanitizedName = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $originalName);
            $imageName = time() . '_' . $sanitizedName;
            $imagePath = $image->storeAs('places', $imageName, 'public');
            $validated['img_preview'] = $imagePath;
        }

        $place = Place::create($validated);

        return response()->json($place, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Int $place)
    {
        $place = Place::find($place);

        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Places fetched successfully!',
            ],
            'data' => [
                'place' => $place,
                'isAdmin' => true, // ou tout autre champ
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Int $id)
    {

        try{
            $place = Place::find($id);
            $validated = $request->validate([
                'title' => 'sometimes|required|string|max:255',
                'content' => 'sometimes|required|string',
                'img_preview' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'latitude' => 'sometimes|required|numeric',
                'longitude' => 'sometimes|required|numeric',
                'slug' => 'sometimes|required|string|max:255|unique:places,slug,' . $place->id,
                'id_category' => 'sometimes|required|integer|exists:categories,id',
                'id_user' => 'sometimes|required|integer|exists:users,id',
            ]);

            // Vérifie si une nouvelle image a été uploadée
            if ($request->hasFile('img_preview')) {
                $image = $request->file('img_preview');
                $originalName = $image->getClientOriginalName();
                $sanitizedName = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $originalName);
                $imageName = time() . '_' . $sanitizedName;
                $imagePath = $image->storeAs('places', $imageName, 'public');
                $validated['img_preview'] = $imagePath;
            } else {
                // Si le nom de l'image n'a pas changé, on ne modifie pas le champ img_preview
                unset($validated['img_preview']);
            }

            $place->update($validated);

            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Place updated successfully!',
                ],
                'data' => [
                    'place' => $place,
                ],
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                'meta' => [
                    'code' => 500,
                    'status' => 'error',
                    'message' => 'An error occurred while updating the place.',
                ],
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {
        //
    }
}
