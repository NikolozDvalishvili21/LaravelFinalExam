<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TreatmentReminder;


class TreatmentController extends Controller
{
    // List all treatments
    public function index()
    {
        $treatments = Treatment::with('injury')->get(); // Eager load injury relationship
        return response()->json($treatments, 200);
    }

    // Store a new treatment
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'injury_id' => 'required|exists:injuries,id', // Ensure injury exists
        ]);

        $treatment = Treatment::create($validated);

        return response()->json([
            'message' => 'Treatment created successfully!',
            'data' => $treatment,
        ], 201);
    }

    // Show details of a single treatment
    public function show($id)
    {
        $treatment = Treatment::with('injury')->find($id);

        if (!$treatment) {
            return response()->json(['message' => 'Treatment not found'], 404);
        }

        return response()->json($treatment, 200);
    }

    // Update an existing treatment
    public function update(Request $request, $id)
    {
        $treatment = Treatment::find($id);

        if (!$treatment) {
            return response()->json(['message' => 'Treatment not found'], 404);
        }

        $validated = $request->validate([
            'description' => 'sometimes|string|max:255',
            'start_date' => 'sometimes|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'injury_id' => 'sometimes|exists:injuries,id',
        ]);

        $treatment->update($validated);

        return response()->json([
            'message' => 'Treatment updated successfully!',
            'data' => $treatment,
        ], 200);
    }

    // Delete a treatment
    public function destroy($id)
    {
        $treatment = Treatment::find($id);

        if (!$treatment) {
            return response()->json(['message' => 'Treatment not found'], 404);
        }

        $treatment->delete();

        return response()->json(['message' => 'Treatment deleted successfully!'], 200);
    }

    public function sendReminder($athleteId, $treatmentId)
    {
        // Find the athlete and treatment
        $athlete = Athlete::find($athleteId);  // Assuming you have the Athlete model
        $treatment = Treatment::find($treatmentId);

        // Check if both athlete and treatment exist
        if ($athlete && $treatment) {
            // Send the email to the athlete
            Mail::to($athlete->email)->send(new TreatmentReminder($athlete, $treatment));

            return response()->json(['message' => 'Treatment reminder sent!']);
        }

        return response()->json(['message' => 'Athlete or treatment not found.'], 404);
    }
}
