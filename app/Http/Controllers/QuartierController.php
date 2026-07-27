<?php

namespace App\Http\Controllers;

use App\Models\Quartier;
use Illuminate\Http\Request;

class QuartierController extends Controller
{
    public function search(Request $request)
    {
        $term = (string) $request->query('q', '');

        $quartiers = Quartier::search($term)->map(fn ($q) => [
            'nom'     => $q->nom,
            'commune' => $q->commune,
        ])->values();

        return response()->json($quartiers);
    }
}
