<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TreatmentReminder;
use App\Http\Requests\StoreTreatmentRequest;


class TreatmentController extends Controller
{
    public function index()
    {
        $treatments = Treatment::with('injury')->get(); // Eager load 
        return response()->json($treatments, 200);
    }

    public function store(StoreTreatmentRequest $request)
    {
        $validated = $request->validated();
    
        $treatment = Treatment::create($validated);
    
        return response()->json([
            'message' => 'Treatment created successfully!',
            'data' => $treatment,
        ], 201);
    }

    public function show($id)
    {
        $treatment = Treatment::with('injury')->find($id);

        if (!$treatment) {
            return response()->json(['message' => 'Treatment not found'], 404);
        }

        return response()->json($treatment, 200);
    }


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
        $athlete = Athlete::find($athleteId);  
        $treatment = Treatment::find($treatmentId);

        if ($athlete && $treatment) {
            Mail::to($athlete->email)->send(new TreatmentReminder($athlete, $treatment));

            return response()->json(['message' => 'Treatment reminder sent!']);
        }

        return response()->json(['message' => 'Athlete or treatment not found.'], 404);
    }
}
