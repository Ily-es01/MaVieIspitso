<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Notes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-dark: #4338ca;
            --primary-light: #818cf8;
            --accent-color: #f43f5e;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --text-light: #f9fafb;
            --bg-light: #f3f4f6;
            --bg-card: #ffffff;
            --border-color: #e5e7eb;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --error-color: #ef4444;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            --border-radius: 8px;
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-primary);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            background-color: var(--bg-card);
            padding: 20px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
        }

        .page-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0;
        }

        .search-filters {
            display: flex;
            gap: 16px;
            margin-bottom: 24px;
            flex-wrap: wrap;
            background-color: var(--bg-card);
            padding: 20px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
        }

        .search-group {
            flex: 1;
            min-width: 200px;
        }

        .search-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-secondary);
        }

        .search-input {
            width: 100%;
            padding: 10px 16px;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            font-size: 14px;
            transition: var(--transition);
            background-color: var(--bg-light);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            background-color: var(--bg-card);
        }

        .table-container {
            background-color: var(--bg-card);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            margin-bottom: 24px;
        }

        .grades-table {
            width: 100%;
            border-collapse: collapse;
        }

        .grades-table th {
            background-color: var(--bg-light);
            padding: 16px;
            text-align: left;
            font-weight: 600;
            color: var(--text-secondary);
            border-bottom: 1px solid var(--border-color);
        }

        .grades-table td {
            padding: 16px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .grades-table tr:last-child td {
            border-bottom: none;
        }

        .grades-table tr:hover {
            background-color: var(--bg-light);
        }

        .grade-input {
            width: 80px;
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            text-align: center;
            transition: var(--transition);
            font-size: 14px;
            font-weight: 500;
        }

        .grade-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.1);
        }

        .grade-type {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .grade-type.normal {
            background-color: rgba(79, 70, 229, 0.1);
            color: var(--primary-color);
        }

        .grade-type.rattrapage {
            background-color: rgba(244, 63, 94, 0.1);
            color: var(--accent-color);
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: var(--border-radius);
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .btn-success {
            background-color: var(--success-color);
            color: white;
        }

        .btn-success:hover {
            background-color: #059669;
        }

        .btn-warning {
            background-color: var(--warning-color);
            color: white;
        }

        .btn-warning:hover {
            background-color: #d97706;
        }

        .btn-danger {
            background-color: var(--error-color);
            color: white;
        }

        .btn-danger:hover {
            background-color: #d32f2f;
        }

        .btn i {
            font-size: 14px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 24px;
        }

        .pagination button {
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            background-color: var(--bg-card);
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
        }

        .pagination button:hover {
            background-color: var(--bg-light);
        }

        .pagination button.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: scroll;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            backdrop-filter: blur(4px);
        }

        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 30px;
            border-radius: var(--border-radius);
            width: 90%;
            max-width: 500px;
            box-shadow: var(--shadow-md);
        }

        .modal-content h2 {
            margin-top: 0;
            margin-bottom: 24px;
            color: var(--text-primary);
            font-size: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-secondary);
        }

        .form-group select,
        .form-group input {
            width: 100%;
            padding: 10px 16px;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            font-size: 14px;
            transition: var(--transition);
            background-color: var(--bg-light);
        }

        .form-group select:focus,
        .form-group input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            background-color: var(--bg-card);
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
        }

        /* Notification styles */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            border-radius: var(--border-radius);
            color: white;
            z-index: 1000;
            animation: slideIn 0.3s ease-out;
            box-shadow: var(--shadow-md);
        }

        .notification.success {
            background-color: var(--success-color);
        }

        .notification.error {
            background-color: var(--error-color);
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .search-filters {
                flex-direction: column;
            }

            .search-group {
                width: 100%;
            }

            .table-container {
                overflow-x: auto;
            }

            .grades-table {
                min-width: 800px;
            }

            .page-header {
                flex-direction: column;
                gap: 16px;
                text-align: center;
            }

            .modal-content {
                margin: 5% auto;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <x-nav-bare-ensei></x-nav-bare-ensei>
    <main>
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Gestion des Notes</h1>
            <button class="btn btn-primary" onclick="openAddNoteModal()">
                <i class="fas fa-plus"></i>
                Ajouter une note
            </button>
        </div>

        <div class="search-filters">
            <div class="search-group">
                <label for="student-search">Rechercher un étudiant</label>
                <input type="text" id="student-search" class="search-input" placeholder="Nom de l'étudiant...">
            </div>
            <div class="search-group">
                <label for="option-filter">Option</label>
                <select id="option-filter" class="search-input">
                    <option value="">Toutes les options</option>
                    @foreach($options as $option)
                        <option value="{{ $option->ID_option }}">{{ $option->Nom_option }}</option>
                    @endforeach
                </select>
            </div>
            <div class="search-group">
                <label for="module-filter">Module</label>
                <select id="module-filter" class="search-input">
                    <option value="">Tous les modules</option>
                    @foreach($modules as $module)
                        <option value="{{ $module->ID_module }}">{{ $module->Nom_module }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="table-container">
            <table class="grades-table">
                <thead>
                    <tr>
                        <th>Étudiant</th>
                        <th>Module</th>
                        <th>Type</th>
                        <th>Session</th>
                        <th>Note</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notes as $note)
                    <tr data-note-id="{{ $note->ID_note }}"
                        data-note-type="{{ strtolower($note->Type_note) }}"
                        data-note-session="{{ strtolower($note->Session_note) }}"
                        data-option="{{ $note->user->option->ID_option ?? '' }}">
                        <td>{{$note->user->name}} {{$note->user->Prenom}}</td>
                        <td>{{ $note->module->Nom_module }}</td>
                        <td>{{ ucfirst($note->Type_note) }}</td>
                        <td>{{ ucfirst($note->Session_note) }}</td>
                        <td>
                            <input type="number" class="grade-input" value="{{ $note->Valeur_note }}" min="0" max="20" step="0.01">
                        </td>
                        <td>{{ $note->Date_note ? $note->Date_note->format('d/m/Y') : 'N/A' }}</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-success" onclick="saveNote({{ $note->ID_note }})">
                                    <i class="fas fa-save"></i>
                                </button>
                                <button class="btn btn-danger" onclick="deleteNote({{ $note->ID_note }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $notes->links() }}
        </div>
    </div>

    <!-- Modal pour ajouter une note -->
    <div id="addNoteModal" class="modal" style="display: none;">
        <div class="modal-content">
            <h2>Ajouter une note</h2>
            <form id="addNoteForm">
                <div class="form-group">
                    <label for="option">Option</label>
                    <select id="option" name="option_id" required onchange="updateStudentsList()">
                        <option value="">Sélectionner une option</option>
                        @foreach($options as $option)
                            <option value="{{ $option->ID_option }}">{{ $option->Nom_option }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="etudiant">Étudiant</label>
                    <select id="etudiant" name="etudiant_id" required disabled>
                        <option value="">Sélectionner un étudiant</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="module">Module</label>
                    <select id="module" name="module_id" required>
                        <option value="">Sélectionner un module</option>
                        @foreach($modules as $module)
                            <option value="{{ $module->ID_module }}">{{ $module->Nom_module }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="type_note">Type de note</label>
                    <select id="type_note" name="type_note" required>
                        <option value="ds">Devoir Surveillé</option>
                        <option value="exam">Examen</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="session_note">Session</label>
                    <select id="session_note" name="session_note" required>
                        <option value="normale">Session Normale</option>
                        <option value="rattrapage">Session de Rattrapage</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="valeur_note">Note</label>
                    <input type="number" id="valeur_note" name="valeur_note" min="0" max="20" step="0.01" required>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-warning" onclick="closeAddNoteModal()">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de confirmation de suppression -->
    <div id="deleteConfirmModal" class="modal" style="display: none;">
        <div class="modal-content">
            <h2>Confirmer la suppression</h2>
            <p>Êtes-vous sûr de vouloir supprimer cette note ?</p>
            <div class="form-actions">
                <button type="button" class="btn btn-warning" onclick="closeDeleteConfirmModal()">Annuler</button>
                <button type="button" class="btn btn-danger" onclick="confirmDelete()">Supprimer</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Configuration CSRF pour Axios
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let noteToDelete = null;

        // Fonction pour ouvrir la modale de confirmation de suppression
        function deleteNote(noteId) {
            noteToDelete = noteId;
            document.getElementById('deleteConfirmModal').style.display = 'block';
        }

        // Fonction pour fermer la modale de confirmation
        function closeDeleteConfirmModal() {
            document.getElementById('deleteConfirmModal').style.display = 'none';
            noteToDelete = null;
        }

        // Fonction pour confirmer la suppression
        async function confirmDelete() {
            if (!noteToDelete) return;

            try {
                await axios.delete(`/gestion/notes/${noteToDelete}`);
                const row = document.querySelector(`tr[data-note-id="${noteToDelete}"]`);
                row.remove();
                closeDeleteConfirmModal();
                showNotification('Note supprimée avec succès', 'success');
            } catch {
                showNotification('Erreur lors de la suppression de la note', 'error');
            }
        }

        // Fonction de filtrage
        function filterTable() {
            const searchText = document.getElementById('student-search').value.toLowerCase();
            const optionValue = document.getElementById('option-filter').value;
            const moduleValue = document.getElementById('module-filter').value;
            const rows = document.querySelectorAll('.grades-table tbody tr');

            rows.forEach(row => {
                const studentName = row.querySelector('td:first-child').textContent.toLowerCase();
                const moduleName = row.querySelector('td:nth-child(2)').textContent;
                const optionId = row.getAttribute('data-option');

                const matchesSearch = studentName.includes(searchText);
                const matchesOption = !optionValue || optionId === optionValue;
                const matchesModule = !moduleValue || moduleName === document.querySelector(`#module-filter option[value="${moduleValue}"]`).textContent;

                row.style.display = (matchesSearch && matchesOption && matchesModule) ? '' : 'none';
            });
        }

        // Recherche en temps réel
        document.getElementById('student-search').addEventListener('keyup', filterTable);
        document.getElementById('option-filter').addEventListener('change', filterTable);
        document.getElementById('module-filter').addEventListener('change', filterTable);

        // Fonction pour sauvegarder une note
        async function saveNote(noteId) {
            const row = document.querySelector(`tr[data-note-id="${noteId}"]`);
            const valeurNote = row.querySelector('.grade-input').value;
            const typeNote = row.getAttribute('data-note-type');
            const sessionNote = row.getAttribute('data-note-session');

            if (!valeurNote || valeurNote < 0 || valeurNote > 20) {
                showNotification('La note doit être comprise entre 0 et 20', 'error');
                return;
            }

            try {
                await axios.put(`/gestion/notes/${noteId}`, {
                    valeur_note: valeurNote,
                    type_note: typeNote,
                    session_note: sessionNote
                });
                showNotification('Note mise à jour avec succès', 'success');
            } catch {
                showNotification('Erreur lors de la mise à jour de la note', 'error');
            }
        }

        // Fonctions pour le modal d'ajout de note
        function openAddNoteModal() {
            document.getElementById('addNoteModal').style.display = 'block';
            document.getElementById('option').value = '';
            document.getElementById('etudiant').value = '';
            document.getElementById('etudiant').disabled = true;
        }

        function closeAddNoteModal() {
            document.getElementById('addNoteModal').style.display = 'none';
        }

        // Gestion du formulaire d'ajout de note
        document.getElementById('addNoteForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = {
                etudiant_id: formData.get('etudiant_id'),
                module_id: formData.get('module_id'),
                type_note: formData.get('type_note'),
                session_note: formData.get('session_note'),
                valeur_note: formData.get('valeur_note')
            };

            try {
                const response = await axios.post('/gestion/notes', data);
                if (response.data.success) {
                    showNotification('Note ajoutée avec succès', 'success');
                    closeAddNoteModal();
                    window.location.reload();
                }
            } catch (error) {
                showNotification('Erreur lors de l\'ajout de la note', 'error');
            }
        });

        // Fonction pour afficher les notifications
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Fonction pour mettre à jour la liste des étudiants en fonction de l'option sélectionnée
        async function updateStudentsList() {
            const optionId = document.getElementById('option').value;
            const studentSelect = document.getElementById('etudiant');

            // Réinitialiser le select si aucune option n'est sélectionnée
            if (!optionId) {
                studentSelect.disabled = true;
                studentSelect.innerHTML = '<option value="">Sélectionner un étudiant</option>';
                return;
            }

            try {
                const response = await axios.get(`/api/etudiants/${optionId}`);
                const students = response.data;

                // Mettre à jour la liste des étudiants
                studentSelect.innerHTML = '<option value="">Sélectionner un étudiant</option>';

                if (students.length === 0) {
                    studentSelect.innerHTML += '<option value="" disabled>Aucun étudiant dans cette option</option>';
                } else {
                    students.forEach(student => {
                        studentSelect.innerHTML += `<option value="${student.id}">${student.name} ${student.Prenom}</option>`;
                    });
                }

                studentSelect.disabled = false;
            } catch (error) {
                showNotification('Erreur lors du chargement des étudiants', 'error');
                studentSelect.innerHTML = '<option value="">Erreur de chargement</option>';
                studentSelect.disabled = true;
            }
        }
    </script>
    </main>
</body>
</html>
