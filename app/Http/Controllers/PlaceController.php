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
        //
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
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('places', $imageName, 'public');
            $validated['img_preview'] = $imagePath;
        }

        $place = Place::create($validated);

        return response()->json($place, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Place $place)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Place $place)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {
        //
    }
}
