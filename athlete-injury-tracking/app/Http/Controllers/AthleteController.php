<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use Illuminate\Http\Request;

class AthleteController extends Controller
{
    public function index()
    {
        return response()->json(Athlete::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sport' => 'required|string|max:255',
            'email' => 'required|email|unique:athletes,email',
        ]);

        $athlete = Athlete::create($validated);

        return response()->json(['message' => 'Athlete created successfully!', 'data' => $athlete], 201);
    }

    public function show($id)
    {
        $athlete = Athlete::find($id);

        if (!$athlete) {
            return response()->json(['message' => 'Athlete not found'], 404);
        }

        return response()->json($athlete, 200);
    }

    public function update(Request $request, $id)
    {
        $athlete = Athlete::find($id);

        if (!$athlete) {
            return response()->json(['message' => 'Athlete not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'sport' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:athletes,email,' . $id,
        ]);

        $athlete->update($validated);

        return response()->json(['message' => 'Athlete updated successfully!', 'data' => $athlete], 200);
    }

    public function destroy($id)
    {
        $athlete = Athlete::find($id);

        if (!$athlete) {
            return response()->json(['message' => 'Athlete not found'], 404);
        }

        $athlete->delete();

        return response()->json(['message' => 'Athlete deleted successfully!'], 200);
    }
}

