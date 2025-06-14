<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Pédagogique</title>
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
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, var(--gray-100) 0%, #ffffff 100%);
            min-height: 100vh;
            color: var(--gray-700);
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            border-left: 5px solid var(--primary-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal {
            display: flex;
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


        .header h1 {
            color: var(--primary-color);
            font-size: 2.2em;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .header p {
            color: var(--gray-700);
            opacity: 0.8;
            font-size: 1.1em;
        }

        .nav-tabs {
            display: flex;
            background: white;
            border-radius: 12px;
            padding: 8px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            overflow-x: auto;
            gap: 4px;
        }

        .nav-tab {
            padding: 12px 20px;
            background: transparent;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 500;
            color: var(--gray-700);
            transition: all 0.3s ease;
            white-space: nowrap;
            position: relative;
        }

        .nav-tab:hover {
            background: var(--gray-100);
            transform: translateY(-1px);
        }

        .nav-tab.active {
            background: var(--primary-color);
            color: white;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.4s ease-in-out;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
            border: 1px solid var(--gray-200);
        }

        .card h2 {
            color: var(--primary-color);
            margin-bottom: 20px;
            font-size: 1.5em;
            font-weight: 600;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--gray-700);
            font-weight: 500;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--gray-200);
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            transform: translateY(-1px);
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.3);
        }

        .btn-danger {
            background: var(--danger-color);
            color: white;
        }

        .btn-danger:hover {
            background: var(--danger-hover);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: var(--gray-200);
            color: var(--gray-700);
        }

        .btn-secondary:hover {
            background: var(--gray-300);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .data-table th {
            background: var(--primary-color);
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 500;
            font-size: 14px;
        }

        .data-table td {
            padding: 15px;
            border-bottom: 1px solid var(--gray-200);
            font-size: 14px;
        }

        .data-table tr:hover {
            background: var(--gray-100);
        }

        .badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-success {
            background: rgba(34, 197, 94, 0.1);
            color: var(--success-color);
        }

        .badge-danger {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
        }

        .badge-warning {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 4px solid;
            font-size: 14px;
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            border-color: var(--success-color);
            color: var(--success-color);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border-color: var(--danger-color);
            color: var(--danger-color);
        }

        .alert-warning {
            background: rgba(245, 158, 11, 0.1);
            border-color: #f59e0b;
            color: #f59e0b;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            backdrop-filter: blur(5px);
        }

        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
        }

        .modal-header {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--gray-200);
        }

        .modal-header h3 {
            color: var(--primary-color);
            font-size: 1.3em;
            font-weight: 600;
        }

        .close {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 28px;
            cursor: pointer;
            color: var(--gray-700);
        }

        .close:hover {
            color: var(--danger-color);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(79, 70, 229, 0.2);
        }

        .stat-number {
            font-size: 2.5em;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 14px;
            opacity: 0.9;
        }

        .search-bar {
            position: relative;
            margin-bottom: 20px;
        }

        .search-bar input {
            width: 100%;
            padding: 12px 16px 12px 45px;
            border: 2px solid var(--gray-200);
            border-radius: 25px;
            font-size: 15px;
            background: white;
        }

        .monselect{
            width: 100%;
            padding: 12px 16px 12px 45px;
            border: 2px solid var(--gray-200);
            border-radius: 25px;
            font-size: 15px;
            background: white;
        }



        .search-bar::before {
            content: "🔍";
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
        }

        .conflict-warning {
            background: rgba(245, 158, 11, 0.1);
            border: 2px solid #f59e0b;
            border-radius: 10px;
            padding: 15px;
            margin: 15px 0;
            color: #f59e0b;
        }

        .conflict-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 5px 0;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .nav-tabs {
                flex-wrap: wrap;
            }

            .data-table {
                font-size: 12px;
            }

            .data-table th,
            .data-table td {
                padding: 10px 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
            <h1>🎓 Gestion Pédagogique</h1>
            <p>Interface du Responsable Pédagogique - Gestion complète des ressources éducatives</p>
            </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                border: none;
                padding: 12px 24px;
                border-radius: 8px;
                font-size: 14px;
                font-weight: 600;
                cursor: pointer;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
                text-decoration: none;
                font-family: inherit;
            " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(102, 126, 234, 0.4)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(102, 126, 234, 0.3)';">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Se déconnecter</span>
            </button>
        </form>
    </div>


        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number" id="totalSessions">{{$stats['total_seances'] }}</div>
                <div class="stat-label">Séances Programmées</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="totalTeachers">{{$stats['total_enseignants']}}</div>
                <div class="stat-label">Enseignants</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="totalStudents">{{$stats['total_etudiants']}}</div>
                <div class="stat-label">Étudiants</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="totalRooms">{{$stats['total_salles']}}</div>
                <div class="stat-label">Salles</div>
            </div>
        </div>

        <div class="nav-tabs">
            <button class="nav-tab active" data-tab="sessions">📅 Séances</button>
            <button class="nav-tab" data-tab="rooms">🏫 Salles</button>
            <button class="nav-tab" data-tab="teachers">👨‍🏫 Enseignants</button>
            <button class="nav-tab" data-tab="students">👥 Étudiants</button>
            <button class="nav-tab" data-tab="fields">🎯 Filières</button>
            <button class="nav-tab" data-tab="options">⚙️ Options</button>
            <button class="nav-tab" data-tab="modules">📚 Ajouter modules</button>

        </div>

        <!-- Gestion des Séances -->
        <div class="tab-content active" id="sessions">
            <div class="card">
                <h2>Créer une Séance</h2>
                <div id="sessionAlert"></div>
                <form id="sessionForm" action="{{ route('responsable.sessions.store') }}" method="POST">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Matière *</label>
                            <select class="form-control" name="ID_module">
                                @foreach ($allmodules as $module )
                                     <option value="{{ $module->ID_module }}">{{$module->Nom_module}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Enseignant *</label>
                            <select class="form-control" name="ID_utilisateur" required>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }} {{ $teacher->Prenom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Salle *</label>
                            <select class="form-control" name="ID_salle" required>
                                <option value="">Sélectionner une salle</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->ID_salle }}">{{ $room->Nom_salle }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Filière *</label>
                            <select class="form-control" name="ID_filiere" required>
                                     <option value="">Sélectionner une Filiere</option>
                                @foreach($fields as $field)
                                    <option value="{{ $field->ID_filiere }}">{{ $field->Nom_filiere }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jour *</label>
                            <select class="form-control" name="jour" required>
                                <option value="Lundi">Lundi</option>
                                <option value="Mardi">Mardi</option>
                                <option value="Mercredi">Mercredi</option>
                                <option value="Jeudi">Jeudi</option>
                                <option value="Vendredi">Vendredi</option>
                                <option value="Samedi">Samedi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Heure de début *</label>
                            <input type="time" class="form-control" name="HeureDebut_seance" step="1" required>
                        </div>
                        <div class="form-group">
                            <label>Heure de fin *</label>
                            <input type="time" class="form-control" name="HeureFin_seance" step="1" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        ✅ Créer la Séance
                    </button>

                </form>

            </div>

            <div class="card">
                <h2>📋 Liste des Séances</h2>
                <div class="search-bar">
                    <input type="text" placeholder="Rechercher une séance..." id="sessionSearch">
                </div>
                <table class="data-table" id="sessionsTable">
                    <thead>
                        <tr>
                            <th>Matière</th>
                            <th>Enseignant</th>
                            <th>Salle</th>
                            <th>Jour</th>
                            <th>Heure début</th>
                            <th>Heure fin</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($seances as $session)
                        <tr>
                            <td>{{ $session->module->Nom_module }}</td>
                            <td>{{ $session->user->name }} {{ $session->user->Prenom }}</td>
                            <td>{{ $session->salle->Nom_salle }}</td>
                            <td>{{ $session->jour }}</td>
                            <td>{{ $session->HeureDebut_seance }}</td>
                            <td>{{ $session->HeureFin_seance }}</td>
                            <td>
                                 <form action="{{ route('responsable.sessions.delete', $session->ID_seance) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette séance ?')">🗑️</button>

                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Gestion des Salles -->
        <div class="tab-content" id="rooms">
            <div class="card">
                <h2>Ajouter une Salle</h2>
                <form id="roomForm" action="{{ route('responsable.rooms.store') }}" method="POST">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nom de la salle *</label>
                            <input type="text" class="form-control" name="Nom_salle" required>
                        </div>
                        <div class="form-group">
                            <label>Capacité *</label>
                            <input type="number" class="form-control" name="Capacite_salle" min="1" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        🏫 Ajouter la Salle
                    </button>
                </form>
            </div>

            <div class="card">
                <h2>🏫 Liste des Salles</h2>
                <div class="search-bar">
                    <input type="text" placeholder="Rechercher une salle..." id="roomSearch">
                </div>
                <table class="data-table" id="roomsTable">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Capacité</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rooms as $room)
                        <tr>
                            <td>{{ $room->Nom_salle }}</td>
                            <td>{{ $room->Capacite_salle }}</td>
                            <td>
                                {{-- <button class="btn btn-secondary" onclick="editRoom({{ $room->id }})">✏️</button> --}}
                                <form action="{{ route('responsable.rooms.delete', $room) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette salle ?')">🗑️</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Gestion des Enseignants -->
        <div class="tab-content" id="teachers">
            <div class="card">
                <h2>Ajouter un Enseignant</h2>
                <form id="teacherForm" action="{{ route('responsable.teachers.store') }}" method="POST">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nom *</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Prénom *</label>
                            <input type="text" class="form-control" name="Prenom" required>
                        </div>
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Téléphone</label>
                            <input type="tel" class="form-control" name="Telephone">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        👨‍🏫 Ajouter l'Enseignant
                    </button>


                </form>
            </div>

            <div class="card">
                <h2>👨‍🏫 Liste des Enseignants</h2>
                <div class="search-bar">
                    <input type="text" placeholder="Rechercher un enseignant..." id="teacherSearch">
                </div>
                <table class="data-table" id="teachersTable">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teachers as $teacher)
                        <tr>
                            <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->Prenom }}</td>
                            <td>{{ $teacher->email }}</td>
                            <td>{{ $teacher->Telephone }}</td>
                            <td>
                                {{-- <button class="btn btn-secondary" onclick="editTeacher({{ $teacher->id }})">✏️</button> --}}
                                <form action="{{ route('responsable.teachers.delete', $teacher) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet enseignant ?')">🗑️</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Gestion des Étudiants -->
        <div class="tab-content" id="students">
            <div class="card">
                <h2>Ajouter un Étudiant</h2>
                <form id="studentForm" action="{{ route('responsable.students.store') }}" method="POST">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nom *</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Prénom *</label>
                            <input type="text" class="form-control" name="Prenom" required>
                        </div>
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Filière *</label>
                            <select class="form-control" name="ID_filiere" required>
                                <option value="">Sélectionner une filière</option>
                                @foreach($fields as $field)
                                    <option value="{{ $field->ID_filiere }}">{{ $field->Nom_filiere }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Option</label>
                            <select class="form-control" name="ID_option">
                                <option value="">Sélectionner une option</option>
                                @foreach($options as $option)
                                    <option value="{{ $option->ID_option }}">{{ $option->Nom_option }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Semestre</label>
                            <select class="form-control" name="ID_semestre">
                                <option value="2">S1</option>
                                <option value="1">S2</option>
                                <option value="3">S3</option>
                                <option value="4">S4</option>
                                <option value="5">S5</option>
                                <option value="6">S6</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        👥 Ajouter l'Étudiant
                    </button>
                </form>
            </div>

            <div class="card">
                <h2>👥 Liste des Étudiants</h2>
                <div class="search-bar">
                    <input type="text" placeholder="Rechercher un étudiant..." id="studentSearch">
                </div>
                <table class="data-table" id="studentsTable">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Filière</th>
                            <th>Option</th>
                            <th>Semestre</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->Prenom }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->filiere->Nom_filiere }}</td>
                            <td>{{ $student->option ? $student->option->Nom_option : '-' }}</td>
                            <td>{{ $student->semestre->Semestre_numero }}</td>
                            <td>
                                {{-- <button class="btn btn-secondary" onclick="editStudent({{ $student->id }})">✏️</button> --}}
                                <form action="{{ route('responsable.students.delete', $student) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')">🗑️</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Gestion des Filières -->
        <div class="tab-content" id="fields">
            <div class="card">
                <h2>Ajouter une Filière</h2>
                <form id="fieldForm" action="{{ route('responsable.fields.store') }}" method="POST">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nom de la filière *</label>
                            <input type="text" class="form-control" name="Nom_filiere" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        🎯 Ajouter la Filière
                    </button>
                </form>
            </div>

            <div class="card">
                <h2>🎯 Liste des Filières</h2>
                <div class="search-bar">
                    <input type="text" placeholder="Rechercher une filière..." id="fieldSearch">
                </div>
                <table class="data-table" id="fieldsTable">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fields as $field)
                        <tr>
                            <td>{{ $field->Nom_filiere }}</td>
                            <td>
                                {{-- <button class="btn btn-secondary" onclick="editField({{ $field->id }})">✏️</button> --}}
                                <form action="{{ route('responsable.fields.delete', $field) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette filière ?')">🗑️</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Gestion des Options -->
        <div class="tab-content" id="options">
            <div class="card">
                <h2>Ajouter une Option</h2>
                <form id="optionForm" action="{{ route('responsable.options.store') }}" method="POST">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nom de l'option *</label>
                            <input type="text" class="form-control" name="Nom_option" required>
                        </div>
                        <div class="form-group">
                            <label>Filière parente </label>
                            <select class="form-control" name="ID_filiere" required>
                                <option value="">Sélectionner une filière</option>
                                @foreach($fields as $field)
                                    <option value="{{ $field->ID_filiere }}">{{ $field->Nom_filiere }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        ⚙️ Ajouter l'Option
                    </button>
                </form>
            </div>

            <div class="card">
                <h2>⚙️ Liste des Options</h2>
                <div class="search-bar">
                    <input type="text" placeholder="Rechercher une option..." id="optionSearch">
                </div>
                <table class="data-table" id="optionsTable">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Filière</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($options as $option)
                        <tr>
                            <td>{{ $option->Nom_option }}</td>
                            <td>{{ $option->filiere->Nom_filiere }}</td>
                            <td>
                                {{-- <button class="btn btn-secondary" onclick="editOption({{ $option->id }})">✏️</button> --}}
                                <form action="{{ route('responsable.options.delete', $option) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette option ?')">🗑️</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Gestion des modules -->
        <div class="tab-content" id="modules">
            <div class="card">
                <h2>Ajouter un Module</h2>
                <form method="POST" action="{{ route('responsable.modules.store') }}">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nom du module *</label>
                            <input type="text" class="form-control" name="Nom_module" required>
                        </div>
                        <div class="form-group">
                            <label>Enseignant *</label>
                            <select class="form-control" name="ID_utilisateur" required>
                                <option value="">Sélectionner un enseignant</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }} {{ $teacher->Prenom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Semestre *</label>
                            <select class="form-control" name="ID_semestre" required>
                                <option value="2">S1</option>
                                <option value="1">S2</option>
                                <option value="3">S3</option>
                                <option value="4">S4</option>
                                <option value="5">S5</option>
                                <option value="6">S6</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Type *</label>
                            <select class="form-control" name="Type" required>
                                <option value="Cours">Cours</option>
                                <option value="TD">TD</option>
                                <option value="TP">TP</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Volume horaire</label>
                            <input type="number" class="form-control" name="Volume_module" min="1">
                        </div>
                        <div class="form-group">
                            <label>Coefficient</label>
                            <input type="number" class="form-control" name="Coefficient_module" step="0.1" min="0.1">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">➕ Ajouter le Module</button>
                </form>
            </div>

            <div class="card">
                <h2>📚 Liste des Modules</h2>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Filière</th>
                            <th>Semestre</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($modules as $module)
                        <tr>
                            <td>{{ $module->Nom_module }}</td>
                            <td>{{ $module->options->first() ? $module->options->first()->filiere->Nom_filiere : 'Non assignée' }}</td>
                            <td>{{ $module->semestre->Nom_semestre ?? $module->ID_semestre }}</td>
                            <td>
                                <form method="POST" action="{{ route('responsable.modules.delete', $module->ID_module) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Supprimer ce module ?')">🗑️</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        // Gestion des onglets
        document.querySelectorAll('.nav-tab').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelectorAll('.nav-tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

                tab.classList.add('active');
                document.getElementById(tab.dataset.tab).classList.add('active');
            });
        });

        // Fonction pour afficher les alertes
        function showAlert(message, type = 'success') {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type}`;
            alertDiv.textContent = message;

            const container = document.querySelector('.container');
            container.insertBefore(alertDiv, container.firstChild);

            setTimeout(() => alertDiv.remove(), 5000);
        }

        // Fonctions de recherche
        document.querySelectorAll('.search-bar input').forEach(input => {
            input.addEventListener('input', (e) => {
                const searchTerm = e.target.value.toLowerCase();
                const tableId = e.target.id.replace('Search', 'Table');
                const table = document.getElementById(tableId);

                Array.from(table.querySelectorAll('tbody tr')).forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });
        });

        // Fonctions d'édition
        function editSession(id) {
            // Implémenter la logique d'édition
            showAlert('Fonctionnalité d\'édition à implémenter', 'warning');
        }

        function editRoom(id) {
            showAlert('Fonctionnalité d\'édition à implémenter', 'warning');
        }

        function editTeacher(id) {
            showAlert('Fonctionnalité d\'édition à implémenter', 'warning');
        }

        function editStudent(id) {
            showAlert('Fonctionnalité d\'édition à implémenter', 'warning');
        }

        function editField(id) {
            showAlert('Fonctionnalité d\'édition à implémenter', 'warning');
        }

        function editOption(id) {
            showAlert('Fonctionnalité d\'édition à implémenter', 'warning');
        }

        // Afficher les messages de succès/erreur
        @if(session('success'))
            showAlert('{{ session('success') }}', 'success');
        @endif

        @if(session('error'))
            showAlert('{{ session('error') }}', 'danger');
        @endif
    </script>
</body>
</html>
