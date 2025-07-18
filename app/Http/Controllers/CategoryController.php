<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categorys = Category::all();

        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Categorys fetched successfully!',
            ],
            'data' => [
                'cat' => $categorys,
                'isAdmin' => true, // ou tout autre champ
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
        ]);


        $category = Category::create([
            'name' => $validated['name'],
            'color' => $validated['color'],
            'slug' => $validated['slug'],
        ]);

        return response()->json([
            'meta' => [
                'code' => 201,
                'status' => 'success',
                'message' => 'Category created successfully!',
            ],
            'data' => $category,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Int $id)
    {
        $category = Category::find($id);

        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Places fetched successfully!',
            ],
            'data' => [
                'cat' => $category,
                'isAdmin' => true, // ou tout autre champ
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Int $id)
    {

        $category = Category::find($id);
        
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'color' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255',
        ]);

        $category->update($validated);

        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Category updated successfully!',
            ],
            'data' => $category,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
