<?php

namespace App\Http\Controllers\Enseignant;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('enseignant.profile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'Nom_AR' => 'nullable|string',
            'Prenom' => 'nullable|string',
            'Prenom_AR' => 'nullable|string',
            'NaissanceDate' => 'nullable|date',
            'LieuNaissance' => 'nullable|string',
            'email' => 'required|email',
            'Profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Gérer l'upload de l'image
        if ($request->hasFile('Profile_image')) {
            // Créer le dossier s'il n'existe pas
            $path = public_path('images/enseignant-images');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true);
            }

            // Supprimer l'ancienne image si elle existe
            if ($user->Profile_image && file_exists(public_path('images/enseignant-images/' . $user->Profile_image))) {
                unlink(public_path('images/enseignant-images/' . $user->Profile_image));
            }

            // Sauvegarder la nouvelle image
            $image = $request->file('Profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/enseignant-images'), $imageName);
            $validatedData['Profile_image'] = $imageName;
        }

        $user->update($validatedData);

        return redirect()->back()->with('success', 'Profil mis à jour avec succès');
    }
} 