<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Athlete;
use App\Models\Injury;
use App\Models\Treatment;
use App\Models\Rating;

class RatingController extends Controller
{
    // List all ratings for a given resource
    public function index($type, $id)
    {
        $model = $this->getModel($type);

        if (!$model) {
            return response()->json(['message' => 'Invalid type'], 400);
        }

        $resource = $model::find($id);

        if (!$resource) {
            return response()->json(['message' => ucfirst($type) . ' not found'], 404);
        }

        return response()->json($resource->ratings, 200);
    }

    // Add a new rating for a given resource
    public function store(Request $request, $type, $id)
    {
        $model = $this->getModel($type);

        if (!$model) {
            return response()->json(['message' => 'Invalid type'], 400);
        }

        $resource = $model::find($id);

        if (!$resource) {
            return response()->json(['message' => ucfirst($type) . ' not found'], 404);
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $rating = $resource->ratings()->create($validated);

        return response()->json([
            'message' => 'Rating added successfully!',
            'data' => $rating,
        ], 201);
    }

    // Helper function to resolve the model type
    private function getModel($type)
    {
        $models = [
            'athletes' => Athlete::class,
            'injuries' => Injury::class,
            'treatments' => Treatment::class,
        ];

        return $models[$type] ?? null;
    }
}
