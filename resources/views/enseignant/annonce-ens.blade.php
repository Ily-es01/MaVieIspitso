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
    <title>Gestion des Annonces</title>
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --accent-color: #818cf8;
            --danger-color: #ef4444;
            --danger-hover: #dc2626;
            --success-color: #22c55e;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-700: #374151;
            --transition-standard: all 0.3s ease;
        }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--gray-100);
            color: var(--gray-700);
        }

        .annonce-section {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--gray-700);
        }

        .create-annonce {
            background-color: var(--primary-color);
            color: white;
            padding: 12px 24px;
            border-radius: 12px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition-standard);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.1), 0 2px 4px -1px rgba(79, 70, 229, 0.06);
        }

        .create-annonce:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.1), 0 4px 6px -2px rgba(79, 70, 229, 0.05);
        }

        .annonce {
            background-color: white;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: var(--transition-standard);
        }

        .annonce:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .annonce-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--gray-200);
        }

        .annonce-header img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary-color);
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-info span:first-of-type {
            font-weight: 600;
            font-size: 16px;
            color: var(--gray-700);
        }

        .user-info span:last-of-type {
            font-size: 14px;
            color: var(--gray-300);
        }

        .annonce h3 {
            font-size: 20px;
            font-weight: 600;
            margin: 0 0 12px 0;
            color: var(--gray-700);
        }

        .annonce-option {
            display: inline-block;
            background-color: var(--accent-color);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 16px;
        }

        .annonce-content {
            font-size: 16px;
            line-height: 1.6;
            color: var(--gray-700);
            margin-bottom: 20px;
        }

        .annonce-actions {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition-standard);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-edit {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-edit:hover {
            background-color: var(--primary-hover);
        }

        .btn-delete {
            background-color: var(--danger-color);
            color: white;
        }

        .btn-delete:hover {
            background-color: var(--danger-hover);
        }

        .pagination {
            margin-top: 40px;
            display: flex;
            justify-content: center;
        }

        .pagination nav {
            display: flex;
            justify-content: center;
        }

        .pagination ul {
            display: flex;
            list-style-type: none;
            gap: 8px;
            padding: 0;
            margin: 0;
        }

        .pagination li {
            display: flex;
        }

        .pagination .page-link {
            padding: 8px 16px;
            border-radius: 8px;
            color: var(--gray-700);
            text-decoration: none;
            transition: var(--transition-standard);
            background-color: white;
            border: 1px solid var(--gray-200);
        }

        .pagination a.page-link:hover {
            background-color: var(--gray-100);
            border-color: var(--gray-300);
        }

        .pagination .active .page-link {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .pagination .disabled .page-link {
            color: var(--gray-300);
            pointer-events: none;
            background-color: var(--gray-100);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal.show {
            display: flex;
            opacity: 1;
        }

        .modal-content {
            background-color: white;
            width: 90%;
            max-width: 600px;
            margin: auto;
            border-radius: 16px;
            padding: 32px;
            position: relative;
            transform: translateY(-20px);
            transition: transform 0.3s ease;
        }

        .modal.show .modal-content {
            transform: translateY(0);
        }

        .modal-header {
            margin-bottom: 24px;
        }

        .modal-header h2 {
            font-size: 24px;
            font-weight: 600;
            color: var(--gray-700);
            margin: 0 0 8px 0;
        }

        .modal-header p {
            color: var(--gray-300);
            margin: 0;
        }

        .close-modal {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            font-size: 24px;
            color: var(--gray-300);
            cursor: pointer;
            padding: 0;
            transition: var(--transition-standard);
        }

        .close-modal:hover {
            color: var(--gray-700);
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--gray-700);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            font-family: inherit;
            font-size: 14px;
            color: var(--gray-700);
            transition: var(--transition-standard);
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .form-group textarea {
            height: 200px;
            resize: vertical;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 32px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            padding: 12px 24px;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background-color: var(--gray-200);
            color: var(--gray-700);
            padding: 12px 24px;
        }

        .btn-secondary:hover {
            background-color: var(--gray-300);
        }

        @media (max-width: 768px) {
            .annonce-section {
                margin: 20px auto;
            }

            .section-header {
                flex-direction: column;
                gap: 16px;
                align-items: stretch;
            }

            .annonce {
                padding: 16px;
            }

            .annonce-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .modal-content {
                width: 95%;
                padding: 24px;
                margin: 20px;
            }

            .modal-actions {
                flex-direction: column;
            }

            .modal-actions .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <x-nav-bare-ensei></x-nav-bare-ensei>

    <main class="annonce-section">
        <div class="section-header">
            <h1 class="section-title">Gestion des Annonces</h1>
            <button onclick="openModal()" class="create-annonce">
                <i class="fas fa-plus"></i> Créer une nouvelle annonce
            </button>
        </div>

        @foreach ($annonces as $annonce)
            <div class="annonce">
                <div class="annonce-header">
                    <img src="{{ asset('images/enseignant-images/'.$annonce->user->Profile_image) }}" alt="Profile">
                    <div class="user-info">
                        <span>{{ $annonce->user->name }} {{ $annonce->user->Prenom }}</span>
                        <span>{{ \Carbon\Carbon::parse($annonce->Date_annonce)->locale('fr')->isoFormat('D MMMM Y') }}</span>
                    </div>
                </div>
                <h3>{{ $annonce->Objet_annonce }}</h3>
                <span class="annonce-option">{{ $annonce->Option_classe }}</span>
                <div class="annonce-content">
                    {{ $annonce->Contenu_annonce }}
                </div>
                <div class="annonce-actions">
                    <button onclick="openDeleteModal({{ $annonce->ID_annonce }})" class="btn btn-delete">
                        <i class="fas fa-trash"></i> Supprimer
                    </button>
                </div>
            </div>
        @endforeach

        <div class="pagination">
            {{ $annonces->links('vendor.pagination.bootstrap-5') }}
        </div>
    </main>

    <!-- Modal pour création -->
    <div id="annonceModal" class="modal">
        <div class="modal-content">
            <button class="close-modal" onclick="closeModal()">&times;</button>
            <div class="modal-header">
                <h2>Créer une nouvelle annonce</h2>
                <p>Remplissez le formulaire ci-dessous pour créer une nouvelle annonce</p>
            </div>

            <form id="annonceForm" action="{{ route('enseignant.annonces.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="Objet_annonce">Objet</label>
                    <input type="text" id="Objet_annonce" name="Objet_annonce" required placeholder="Entrez l'objet de l'annonce">
                </div>

                <div class="form-group">
                    <label for="Option_classe">Option</label>
                    <select id="Option_classe" name="Option_classe" required>
                        <option value="">Sélectionnez une option</option>
                        @foreach($options as $option)
                            <option value="{{ $option->Nom_option }}">{{ $option->Nom_option }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="Contenu_annonce">Contenu</label>
                    <textarea id="Contenu_annonce" name="Contenu_annonce" required placeholder="Entrez le contenu de l'annonce"></textarea>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">
                        <i class="fas fa-times"></i> Annuler
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i> Créer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de confirmation de suppression -->
    <div id="deleteModal" class="modal">
        <div class="modal-content" style="max-width: 400px;">
            <button class="close-modal" onclick="closeDeleteModal()">&times;</button>
            <div class="modal-header">
                <h2>Confirmer la suppression</h2>
                <p>Êtes-vous sûr de vouloir supprimer cette annonce ?</p>
            </div>

            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeDeleteModal()">
                        <i class="fas fa-times"></i> Annuler
                    </button>
                    <button type="submit" class="btn btn-delete">
                        <i class="fas fa-trash"></i> Supprimer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            const modal = document.getElementById('annonceModal');
            const form = document.getElementById('annonceForm');
            form.reset();
            modal.classList.add('show');
        }

        function closeModal() {
            const modal = document.getElementById('annonceModal');
            modal.classList.remove('show');
        }

        function openDeleteModal(annonceId) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            form.action = `/enseignant/annonces/${annonceId}`;
            modal.classList.add('show');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('show');
        }

        // Fermer les modals si on clique en dehors
        window.onclick = function(event) {
            const annonceModal = document.getElementById('annonceModal');
            const deleteModal = document.getElementById('deleteModal');
            if (event.target === annonceModal) {
                closeModal();
            }
            if (event.target === deleteModal) {
                closeDeleteModal();
            }
        }
    </script>
</body>
</html>
