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
    <link rel="stylesheet" href="{{ asset('css/etudiant-style/notes-sectio-style/index-style.css') }}">
    <title>Notes - Semestre {{ $semestreCourant->Semestre_numero }}</title>
    <script>
        function submitForm() {
            document.getElementById('semesterForm').submit(); // Soumettre le formulaire automatiquement
        }
    </script>
    <style>
        /* Style pour les notes de rattrapage */
        .rattrapage-note {
            position: relative;
        }
        
        .rattrapage-note::after {
            content: "R";
            position: absolute;
            font-size: 9px;
            background-color: #f59e0b;
            color: white;
            padding: 1px 3px;
            border-radius: 3px;
            top: -8px;
            right: -8px;
        }
    </style>
</head>
<body>
    <x-nav-barre></x-nav-barre>
    <main style="margin-top: 20px; margin-bottom: 40px;">

        <div class="search-div">
            <h2><i class="fas fa-graduation-cap"></i> Information du semestre {{ $semestreCourant->Semestre_numero }}</h2>
           <form id="semesterForm" action="{{ route('etudiant.notes') }}" method="get" onchange="submitForm()">
            @csrf
            <select name="semester" id="semester">
                @foreach($semestres as $semestre)
                    <option value="{{ $semestre->ID_semestre }}" {{ $semestreCourant->ID_semestre == $semestre->ID_semestre ? 'selected' : '' }}>
                        Semestre {{ $semestre->Semestre_numero }}
                    </option>
                @endforeach
            </select>
          </form>
        </div>
        <div class="main-content">
            <table>
                <thead>
                    <tr>
                        <th>Module</th>
                        <th>Coefficient</th>
                        <th>Controle continue</th>
                        <th>Examen finale</th>
                        <th>Rattrapage</th>
                        <th>Note finale</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($notesParModules) > 0)
                        @foreach ($notesParModules as $note)
                            <tr>
                                <td>{{ $note['module'] }}</td>
                                <td>{{ $note['coefficient'] ?? 'N/A' }}</td>
                                
                                <!-- Affichage de la note DS -->
                                @if (isset($note['ds']))
                                    @if ($note['ds'] > 15)
                                        <td class="high-score">{{ $note['ds'] }}</td>
                                    @elseif (($note['ds'] >=10) && ($note['ds'] < 15))
                                        <td class="medium-score">{{ $note['ds'] }}</td>
                                    @else
                                        <td style="color: red;">{{ $note['ds'] }}</td>
                                    @endif
                                @else
                                    <td>N/A</td>
                                @endif

                                <!-- Affichage de la note Exam -->
                                @if (isset($note['exam']))
                                    @if ($note['exam'] > 15)
                                        <td class="high-score">{{ $note['exam'] }}</td>
                                    @elseif (($note['exam'] >= 10) && ($note['exam'] < 15))
                                        <td class="medium-score">{{ $note['exam'] }}</td>
                                    @else
                                        <td style="color: red;">{{ $note['exam'] }}</td>
                                    @endif
                                @else
                                    <td>N/A</td>
                                @endif
                                
                                <!-- Affichage de la note de Rattrapage -->
                                @if (isset($note['ratt']))
                                    @if ($note['ratt'] > 15)
                                        <td class="high-score">{{ $note['ratt'] }}</td>
                                    @elseif (($note['ratt'] >= 10) && ($note['ratt'] < 15))
                                        <td class="medium-score">{{ $note['ratt'] }}</td>
                                    @else
                                        <td style="color: red;">{{ $note['ratt'] }}</td>
                                    @endif
                                @else
                                    <td>N/A</td>
                                @endif

                                <!-- Affichage de la note finale -->
                                @if (isset($note['final']))
                                    @php
                                        $hasRatt = isset($note['ratt']) && isset($note['ds']) && isset($note['exam']) && 
                                                 (($note['ds'] + $note['exam']) / 2) < 10;
                                        $finalClass = "";
                                        
                                        if ($note['final'] > 15) {
                                            $finalClass = "high-score";
                                        } elseif ($note['final'] >= 10 && $note['final'] < 15) {
                                            $finalClass = "medium-score";
                                        } else {
                                            $finalClass = "style=\"color: red;\"";
                                        }
                                    @endphp
                                    
                                    @if ($hasRatt)
                                        <td class="rattrapage-note {{ $finalClass }}">{{ $note['final'] }}</td>
                                    @else
                                        <td class="{{ $finalClass }}">{{ $note['final'] }}</td>
                                    @endif
                                @else
                                    <td>N/A</td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center">Aucun module disponible pour ce semestre</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="semester-summary">
            <h3 class="summary-title">Résumé du semestre</h3>
            <div class="summary-stats">
                <div class="stat-card">
                    <h3>Moyenne générale</h3>
                    <p>{{ $moyenneGenerale ?: 'N/A' }}</p>
                </div>
                <div class="stat-card">
                    <h3>Meilleure note</h3>
                    <p>{{ $meilleureNote ?: 'N/A' }}</p>
                </div>
                <div class="stat-card">
                    <h3>Modules validés</h3>
                    <p>{{ $modulesValides }}/{{ $nombreModules }}</p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
