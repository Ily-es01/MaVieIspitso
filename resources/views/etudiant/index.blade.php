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
    <title>Document</title>
    <style>

    </style>
</head>
<body>
    <x-nav-barre></x-nav-barre>
    <main style="margin-top: 0px; margin-bottom: 40px;">
        <div class="info-section">
            <div class="note-section">
                <div class="section-header">
                    <h2>Dernières Notes <p>5</p></h2>
                    <a href="#" style="text-decoration: none; color: var(--primary-color); font-weight: 500; font-size: 0.9rem;">Voir tout</a>
                </div>
                <table class="data-table">
                    <tr>
                        <th>Anatomie et physiologie</th>
                        <td class="note-good">19</td>
                    </tr>
                    <tr>
                        <th>Biophysique</th>
                        <td class="note-good">15</td>
                    </tr>
                    <tr>
                        <th>Chimie analytique</th>
                        <td class="note-medium">10.75</td>
                    </tr>
                    <tr>
                        <th>Maths et Physique</th>
                        <td class="note-good">20</td>
                    </tr>
                    <tr>
                        <th>Microbiologie, Parasitologie & Mycologie</th>
                        <td class="note-bad">5</td>
                    </tr>
                </table>
            </div>
            
            <div class="schedule-section">
                <div class="section-header">
                    <h2>Aujourd'hui</h2>
                    <a href="#" style="text-decoration: none; color: var(--primary-color); font-weight: 500; font-size: 0.9rem;">Semaine</a>
                </div>
                <!-- Continuation de la div schedule-items -->
                <div class="schedule-item">
                    <div class="schedule-time">08:00</div>
                    <div class="schedule-details">
                        <div class="schedule-course">Anatomie et physiologie</div>
                        <div class="schedule-location"><i class="fa-solid fa-location-dot"></i> Amphi A</div>
                    </div>
                </div>
                <div class="schedule-item">
                    <div class="schedule-time">10:30</div>
                    <div class="schedule-details">
                        <div class="schedule-course">Chimie analytique</div>
                        <div class="schedule-location"><i class="fa-solid fa-location-dot"></i> Labo L2</div>
                    </div>
                </div>
                <div class="schedule-item">
                    <div class="schedule-time">14:00</div>
                    <div class="schedule-details">
                        <div class="schedule-course">Biophysique</div>
                        <div class="schedule-location"><i class="fa-solid fa-location-dot"></i> Salle 304</div>
                    </div>
                </div>
                <div class="schedule-item">
                    <div class="schedule-time">16:15</div>
                    <div class="schedule-details">
                        <div class="schedule-course">TP Microbiologie</div>
                        <div class="schedule-location"><i class="fa-solid fa-location-dot"></i> Labo L3</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="annonce-section">
        <div class="annonce">
            <div class="annonce-header">
                <img src="{{ asset('images/enseignant-images/elegant-young-teacher-with-brunette-hair-stylish-light-shirt-black-striped-suit-glasses-holding-writings-pen-giving-lecture.jpg') }}">
                <div class="user-info">
                    <span>Ibrahim Faraji</span>
                    <span>19 Avril 2025</span>
                </div>
                
            </div>
            <div class="annonce-content">
                Pour le DS, il aura lieu de 12h00 à 13h00, salle 72.

                Il portera sur la réunion, le rapport et le compte-rendu. Il faut donc réviser TOUS les documents qui ont été envoyés sur ces sujets.<br>
                
                Bon courage !
            </div>
        </div>
        <button>Voir tous les annonces</button>
    </div>
    </main>
</body>
</html>