<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Option;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/etudiants/{optionId}', function ($optionId) {
    try {
        $students = User::where('ID_option', $optionId)
                       ->where('role', 'etudiant')
                       ->select('id', 'name', 'Prenom')
                       ->get();
        
        return response()->json($students);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}); 