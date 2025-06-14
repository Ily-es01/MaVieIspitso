<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portail Enseignant</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>

    </style>
</head>
>
<body>
    <x-nav-bare-ensei></x-nav-bare-ensei>
    <main>
                @auth
        <div class="teacher-welcome">
            <div class="teacher-welcome-text">
                <h1>Bonjour, M. {{Auth::user()->name}}</h1>
                <p>Bienvenue dans votre espace enseignant.</p>
            </div>

            <div class="stat-card">
                <i class="fas fa-users"></i>
                <div class="stat-value">{{ $totalEtudiants ?? 0 }}</div>
                <div class="stat-label">Élèves</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-book"></i>
                <div class="stat-value">{{ $totalClasses ?? 0 }}</div>
                <div class="stat-label">Classes</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-clock"></i>
                <div class="stat-value">{{ $totalHeures ?? 0 }}</div>
                <div class="stat-label">Heures/semaine</div>
            </div>
        </div>
        @endauth
                <!-- Section des classes -->

        <div class="classes-section">
            <div class="section-header">
                <p>Année scolaire 2024-2025</p>
            </div>
                   @foreach ($options as $option)
                        <div class="classes-grid">
                            <div class="class-card">
                                <div class="class-header">
                                    <h3>{{ $option->Nom_option }}</h3>
                                    <div class="class-icon">
                                        <i class="fas fa-book"></i>
                                    </div>
                                </div>
                                <div class="class-details">
                                    <div class="class-info">
                                        <div class="info-row">
                                            <i class="fas fa-users"></i>
                                            <span>{{ $option->nombre_etudiants }} élèves</span>
                                        </div>
                                        <div class="info-row">
                                            <i class="fas fa-clock"></i>
                                            <span>{{ $option->heures_semaine }} heures / semaine</span>
                                        </div>
                                        <div class="info-row">
                                            <i class="fas fa-calendar-check"></i>
                                            <span>{{ $option->jours ?? 'Non spécifiés' }}</span>
                                        </div>
                                    </div>
                                    <div class="class-actions">
                                        <button class="class-btn btn-primary" onclick="window.location.href='{{ route('enseignant.notes.store') }}'">
                                            <i class="fas fa-tasks"></i>
                                            <span>Massar</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
        </div>
    </main>

</body>
</html>
