<?php

namespace App\Http\Controllers;

use App\Models\Injury;
use Illuminate\Http\Request;

class InjuryController extends Controller
{
    public function index()
    {
        return response()->json(Injury::with('athlete')->get(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'date' => 'required|date',
            'athlete_id' => 'required|exists:athletes,id',
        ]);

        $injury = Injury::create($validated);

        return response()->json(['message' => 'Injury created successfully!', 'data' => $injury], 201);
    }

    public function show($id)
    {
        $injury = Injury::with('athlete')->find($id);

        if (!$injury) {
            return response()->json(['message' => 'Injury not found'], 404);
        }

        return response()->json($injury, 200);
    }



    public function destroy($id)
    {
        $injury = Injury::find($id);

        if (!$injury) {
            return response()->json(['message' => 'Injury not found'], 404);
        }

        $injury->delete();

        return response()->json(['message' => 'Injury deleted successfully!'], 200);
    }
}

