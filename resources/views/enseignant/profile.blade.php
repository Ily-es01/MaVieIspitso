<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Profil Enseignant</title>
    <style>
        :root {
            --primary-color: #60a5fa;
            --primary-dark: #3b82f6;
            --primary-light: #93c5fd;
            --primary-gradient: linear-gradient(135deg, #60a5fa, #3b82f6);
            --secondary-color: #fcfcfc;
            --accent-color: #f87171;
            --text-primary: #334155;
            --text-secondary: #64748b;
            --text-light: #ffffff;
            --bg-light: #f1f5f9;
            --bg-card: #ffffff;
            --bg-hover: rgba(96, 165, 250, 0.1);
            --border-radius-sm: 12px;
            --border-radius-md: 16px;
            --border-radius-lg: 24px;
            --border-radius-xl: 30px;
            --shadow-sm: 0 4px 12px rgba(148, 163, 184, 0.1);
            --shadow-md: 0 8px 24px rgba(148, 163, 184, 0.15);
            --transition-fast: all 0.2s ease;
            --transition-standard: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-primary);
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            background: var(--bg-card);
            border-radius: var(--border-radius-md);
            padding: 24px;
            box-shadow: var(--shadow-sm);
            transition: var(--transition-standard);
        }

        .image-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 24px;
        }

        .image-box {
            border-radius: var(--border-radius-sm);
            overflow: hidden;
            background: var(--bg-light);
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition-fast);
            border: 1px solid rgba(0,0,0,0.05);
            position: relative;
        }

        .image-box img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .preview-active {
            border: 2px solid var(--primary-color);
            box-shadow: 0 0 10px rgba(59, 130, 246, 0.3);
        }

        .preview-badge {
            position: absolute;
            top: 8px;
            right: 8px;
            background-color: var(--primary-color);
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
            display: none;
        }

        .upload-btn {
            background: var(--primary-gradient);
            color: var(--text-light);
            border: none;
            padding: 10px 16px;
            border-radius: var(--border-radius-sm);
            cursor: pointer;
            font-size: 14px;
            margin-top: 8px;
            transition: var(--transition-fast);
            display: inline-block;
            text-align: center;
            box-shadow: var(--shadow-sm);
        }

        .upload-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .form-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            color: var(--text-secondary);
        }

        input[type="text"],
        input[type="date"],
        input[type="email"],
        textarea,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: var(--border-radius-sm);
            box-sizing: border-box;
            font-family: inherit;
            font-size: 14px;
            color: var(--text-primary);
            background-color: var(--secondary-color);
            transition: var(--transition-fast);
        }

        input[type="text"]:focus,
        input[type="date"]:focus,
        input[type="email"]:focus,
        textarea:focus,
        select:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px var(--primary-light);
        }

        input[type="file"] {
            display: none;
        }

        .submit-btn {
            background: var(--primary-gradient);
            color: var(--text-light);
            border: none;
            padding: 12px 18px;
            border-radius: var(--border-radius-md);
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: var(--transition-fast);
            box-shadow: var(--shadow-sm);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .file-name {
            font-size: 14px;
            color: var(--text-secondary);
            margin-top: 8px;
        }

        .placeholder-text {
            color: var(--text-secondary);
            font-size: 14px;
        }

        .section-label {
            font-size: 14px;
            color: var(--text-secondary);
            margin-bottom: 8px;
        }

        .alert {
            position: fixed;
            top: 20px;
            right: 20px;
            width: auto;
            padding: 15px 25px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            justify-content: space-between;
            transform: translateX(120%);
            transition: transform 0.3s ease;
        }

        .alert.show {
            transform: translateX(0);
        }

        .alert-success {
            background-color: #10b981;
        }

        .alert-error {
            background-color: #ef4444;
        }

        .alert i {
            margin-right: 10px;
            font-size: 18px;
        }

        .alert .close-btn {
            background: transparent;
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
            margin-left: 15px;
            opacity: 0.7;
        }

        .alert .close-btn:hover {
            opacity: 1;
        }

        .loading-spinner {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            z-index: 10;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .loading-spinner i {
            font-size: 24px;
            color: var(--primary-color);
            animation: spin 1s linear infinite;
        }

        .loading-text {
            margin-top: 10px;
            font-size: 14px;
            color: var(--text-secondary);
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .image-size-error {
            color: #ef4444;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }
    </style>
</head>
<body>
    <x-nav-bare-ensei></x-nav-bare-ensei>
    <main style="margin-top: 20px; margin-bottom: 40px;">
        @if(session('success'))
            <div class="alert alert-success" id="alertSuccess">
                <div>
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button class="close-btn" onclick="closeAlert('alertSuccess')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error" id="alertError">
                <div>
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ session('error') }}</span>
                </div>
                <button class="close-btn" onclick="closeAlert('alertError')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        <div class="container">
            <form id="profileForm" action="{{ route('enseignant.profile.update', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $user->id }}">
                <div class="image-grid">
                    <div>
                        <div class="image-box">
                            @if($user->Profile_image)
                                <img src="{{ asset('images/enseignant-images/' . $user->Profile_image) }}" alt="Current image" id="currentImage">
                            @else
                                <img src="{{ asset('images/default-avatar.jpg') }}" alt="Default image" id="currentImage">
                            @endif
                        </div>
                        <div class="section-label">Image actuelle</div>
                    </div>

                    <div>
                        <div class="image-box" id="newImageContainer">
                            <span class="placeholder-text" id="previewPlaceholder">Aucune image sélectionnée</span>
                            <span class="preview-badge" id="previewBadge">Prévisualisation</span>
                            <div class="loading-spinner" id="loadingSpinner">
                                <i class="fas fa-spinner"></i>
                                <span class="loading-text">Téléchargement en cours...</span>
                            </div>
                        </div>
                        <div class="section-label">Nouvelle image (prévisualisée avant envoi)</div>
                        <label for="imageUpload" class="upload-btn">Télécharger une image</label>
                        <input type="file" id="imageUpload" name="Profile_image" accept="image/*">
                        <div class="file-name" id="fileName"></div>
                        <div class="image-size-error" id="imageSizeError">Image trop grande. Taille maximum: 2MB.</div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="nom_ar">النسب</label>
                    <input type="text" id="nom_ar" name="Nom_AR" style="text-align: right" value="{{ $user->Nom_AR }}">
                </div>

                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="Prenom" value="{{ $user->Prenom }}">
                </div>

                <div class="form-group">
                    <label for="prenom_ar">الإسم</label>
                    <input type="text" id="prenom_ar" name="Prenom_AR" style="text-align: right" value="{{ $user->Prenom_AR }}">
                </div>

                <div class="form-group">
                    <label for="naissance">Date de naissance</label>
                    <input type="date" id="naissance" name="NaissanceDate" value="{{ \Carbon\Carbon::parse($user->NaissanceDate)->format('Y-m-d') }}">
                </div>

                <div class="form-group">
                    <label for="lieu_naissance">Lieu de naissance</label>
                    <input type="text" id="lieu_naissance" name="LieuNaissance" value="{{ $user->LieuNaissance }}">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ $user->email }}">
                </div>

                <button type="submit" class="submit-btn" id="submitBtn">Enregistrer les modifications</button>
            </form>
        </div>
    </main>

    <script>
        function closeAlert(elementId) {
            document.getElementById(elementId).style.display = 'none';
        }

        document.addEventListener("DOMContentLoaded", function() {
            // Afficher les notifications avec animation
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    alert.classList.add('show');
                }, 100);

                setTimeout(function() {
                    alert.classList.remove('show');
                }, 5000);
            });

            // Prévisualisation et validation de l'image
            const imageUpload = document.getElementById('imageUpload');
            const newImageContainer = document.getElementById('newImageContainer');
            const previewPlaceholder = document.getElementById('previewPlaceholder');
            const previewBadge = document.getElementById('previewBadge');
            const fileName = document.getElementById('fileName');
            const imageSizeError = document.getElementById('imageSizeError');
            const submitBtn = document.getElementById('submitBtn');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const profileForm = document.getElementById('profileForm');

            let imageValid = true;

            if (imageUpload) {
                imageUpload.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        const file = this.files[0];

                        // Vérifier la taille du fichier (max 2MB)
                        if (file.size > 2 * 1024 * 1024) {
                            imageSizeError.style.display = 'block';
                            imageValid = false;
                            submitBtn.disabled = true;
                            return;
                        } else {
                            imageSizeError.style.display = 'none';
                            imageValid = true;
                            submitBtn.disabled = false;
                        }

                        // Vider le conteneur
                        previewPlaceholder.style.display = 'none';
                        while (newImageContainer.querySelector('img')) {
                            newImageContainer.removeChild(newImageContainer.querySelector('img'));
                        }

                        // Ajouter le badge
                        previewBadge.style.display = 'block';

                        // Ajouter la classe de prévisualisation
                        newImageContainer.classList.add('preview-active');

                        // Créer et ajouter l'image
                        const img = document.createElement('img');
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            img.src = e.target.result;
                            img.style.maxWidth = '100%';
                            img.style.maxHeight = '100%';
                            newImageContainer.appendChild(img);

                            // Afficher le nom du fichier
                            fileName.textContent = file.name;
                        };

                        reader.readAsDataURL(file);
                    }
                });
            }

            // Gérer le formulaire soumis
            if (profileForm) {
                profileForm.addEventListener('submit', function(e) {
                    if (!imageValid) {
                        e.preventDefault();
                        return;
                    }

                    // Si une nouvelle image est sélectionnée, afficher le spinner
                    if (imageUpload.files.length > 0) {
                        loadingSpinner.style.display = 'flex';
                        submitBtn.disabled = true;
                    }
                });
            }
        });
    </script>
</body>
</html>
