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
    <title>portail etudiant</title>
    <style>
        .info-section {
            display: flex;
            flex-direction: row;
            gap: 24px;
        }
        .note-section, .schedule-section {
            flex: 1;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            padding: 20px;
        }
        .annonce-section {
            margin-top: 32px;
            width: 100%;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            padding: 20px;
        }
        @media (max-width: 900px) {
            .info-section {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <x-nav-barre></x-nav-barre>
    <main style="margin-top: 0px; margin-bottom: 40px;">

        <div class="info-section">
            <div class="note-section">
                <div class="section-header">
                    <h2>Dernières Notes<p>5</p></h2>
                    <a href="{{ url('/notes') }}" style="text-decoration: none; color: var(--primary-color); font-weight: 500; font-size: 0.9rem;">Voir tout</a>
                </div>

                <table class="data-table">
                    @foreach ($notes as $note )
                       <tr>
                           <th>{{$note->module->Nom_module}}</th>

                       @if ($note->Valeur_note > 15)
                           <td class="note-good">{{$note->Valeur_note}}</td>
                        @elseif (($note->Valeur_note < 15) && ($note->Valeur_note >=10))
                           <td style="color: orange;">{{$note->Valeur_note}}</td>
                        @else()
                           <td class="note-bad">{{$note->Valeur_note}}</td>
                       @endif
                       </tr>
                    @endforeach
                </table>
            </div>

            <div class="schedule-section">
                <div class="section-header">
                    <h2>Aujourd'hui</h2>
                    <a href="{{ url('/emploiDuTemps') }}" style="text-decoration: none; color: var(--primary-color); font-weight: 500; font-size: 0.9rem;">Semaine</a>
                </div>
                <!-- Continuation de la div schedule-items -->
                @if ($seances->isEmpty())
                     <p style="display:flex;align-items: center; justify-content: center;">Aucune séance</p>
                @endif
                @foreach ($seances as $seance)
                  <div class="schedule-item">
                    <div class="schedule-time">{{ \Carbon\Carbon::parse($seance->HeureDebut_seance)->format('H:i') }}</div>
                    <div class="schedule-details">
                        <div class="schedule-course">{{$seance->module->Nom_module}}</div>
                        <div class="schedule-location"><i class="fa-solid fa-location-dot"></i>{{$seance->salle->Nom_salle}}</div>
                    </div>
                  </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="annonce-section">
        <div class="annonce">
            <div class="annonce-header">
                <img src="{{ asset('images/enseignant-images/'.$annonce->user->Profile_image) }}">
                <div class="user-info">
                    <span>{{$annonce->user->name .' '. $annonce->user->Prenom}}</span>
                    <span>{{ \Carbon\Carbon::parse($annonce->Date_annonce)->translatedFormat('d F Y') .' à '.\Carbon\Carbon::parse($annonce->Date_annonce)->translatedFormat('H:m')  }}
                    </span>
                </div>

            </div>
            <div class="annonce-content">
                {{ $annonce->Contenu_annonce }}
            </div>
        </div>
        <button onclick="window.location.href='{{ url('/annonces') }}'" >Voir tous les annonces</button>
    </div>
    </main>
</body>
</html>
