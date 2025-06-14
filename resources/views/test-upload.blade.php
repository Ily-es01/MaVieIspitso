<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Upload</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #3b82f6;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        .btn {
            background-color: #3b82f6;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        .note {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 4px;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
        .alert {
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .alert-danger {
            background-color: #fee2e2;
            color: #ef4444;
            border: 1px solid #fca5a5;
        }
    </style>
</head>
<body>
    <h1>Test File Upload</h1>
    <p>Utilisez ce formulaire pour tester si les téléchargements d'images fonctionnent.</p>
    
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    
    <form action="{{ route('test.upload.action') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="test_image">Sélectionner une image:</label>
            <input type="file" id="test_image" name="test_image" accept="image/*">
        </div>
        <button type="submit" class="btn">Télécharger</button>
    </form>
    
    <div class="note">
        <p>Cette page est un outil diagnostic pour vérifier si les téléchargements fonctionnent.</p>
        <p>Si les téléchargements fonctionnent ici mais pas sur la page de profil, le problème pourrait être lié à la configuration du formulaire ou aux permissions des répertoires.</p>
    </div>
</body>
</html> 