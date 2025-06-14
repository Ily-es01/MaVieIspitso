<?php

namespace App\Http\Controllers\Etudiant;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Option;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function edit($id){
        $user = User::with(['filiere', 'option'])->findOrFail($id);
        return view("etudiant.profile", compact("user"));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'Nom_AR' => 'nullable|string',
            'Prenom' => 'nullable|string',
            'Prenom_AR' => 'nullable|string',
            'Sexe' => 'nullable|string|in:Homme,Femme',
            'NaissanceDate' => 'nullable|date',
            'LieuNaissance' => 'nullable|string',
            'Nationalite' => 'nullable|string',
            'IdentiteType' => 'nullable|string|in:CIN,PSP',
            'IdentiteNumero' => 'nullable|string',
            'Adresse' => 'nullable|string',
            'email' => 'nullable|email',
            'Telephone' => 'nullable|string',
            'Bourse_status' => 'nullable|string|in:Oui,Non',
            'Assurance_status' => 'nullable|string|in:Oui,Non',
            'BacSerie_etudiant' => 'nullable|string',
            'Code_massar' => 'nullable|string',
            'Annne_bac' => 'nullable|string',
            'Academie' => 'nullable|string',
            'Moyenne_bac' => 'nullable|numeric',
            'Profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload - Simplified approach
        if ($request->hasFile('Profile_image')) {
            try {
                Log::info('Image upload started');
                $file = $request->file('Profile_image');
                
                if (!$file->isValid()) {
                    Log::error('File upload invalid: ' . $file->getErrorMessage());
                    return redirect()->back()->with('error', 'Fichier invalide: ' . $file->getErrorMessage());
                }
                
                // Create directory if it doesn't exist
                $uploadDir = 'images/etudiant-images';
                $fullPath = public_path($uploadDir);
                
                if (!is_dir($fullPath)) {
                    if (!mkdir($fullPath, 0755, true)) {
                        Log::error('Failed to create directory: ' . $fullPath);
                        return redirect()->back()->with('error', "Impossible de créer le dossier d'upload");
                    }
                    Log::info('Directory created: ' . $fullPath);
                }
                
                // Delete old image if exists
                if ($user->Profile_image && file_exists($fullPath . '/' . $user->Profile_image)) {
                    unlink($fullPath . '/' . $user->Profile_image);
                    Log::info('Old image deleted');
                }
                
                // Generate unique filename
                $filename = $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                Log::info('New filename: ' . $filename);
                
                // Save file using basic PHP (most reliable method)
                if ($file->move($fullPath, $filename)) {
                    Log::info('File moved successfully');
                    $validatedData['Profile_image'] = $filename;
                } else {
                    Log::error('Failed to move uploaded file');
                    return redirect()->back()->with('error', "Échec lors du téléchargement de l'image");
                }
                
            } catch (\Exception $e) {
                Log::error('Image upload exception: ' . $e->getMessage());
                return redirect()->back()->with('error', "Erreur lors de l'upload: " . $e->getMessage());
            }
        }

        // Update all data in one go
        $user->update($validatedData);

        return redirect()->back()->with('success', 'Profil mis à jour avec succès!');
    }
}
