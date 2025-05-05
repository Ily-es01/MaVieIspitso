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
    <title>Document</title>
</head>
<body>
    <x-nav-barre></x-nav-barre>
    <main style="margin-top: 20px; margin-bottom: 40px;">
        <div class="search-div">
            <h2><i class="fas fa-graduation-cap"></i> Information du semestre</h2>
            <select>
                <option value="1">Semestre 1</option>
                <option value="2">Semestre 2</option>
                <option value="3">Semestre 3</option>
                <option value="4">Semestre 4</option>
            </select>
        </div>
        <div class="main-content">
            <table>
                <thead>
                    <tr>
                        <th>Module</th>
                        <th>Controle continue</th>
                        <th>Examen finale</th>
                        <th>Note finale</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Anatomie Physiologie</td>
                        <td>15</td>
                        <td>17</td>
                        <td class="note-finale high-score">16</td>
                    </tr>
                    <tr>
                        <td>Pharmacologie Générale</td>
                        <td>10</td>
                        <td>14</td>
                        <td class="note-finale medium-score">12</td>
                    </tr>
                    <tr>
                        <td>Psycho-sociologie</td>
                        <td>16</td>
                        <td>18</td>
                        <td class="note-finale high-score">17</td>
                    </tr>
                    <tr>
                        <td>Sémiologie et terminologie médicale</td>
                        <td>10</td>
                        <td>12</td>
                        <td class="note-finale medium-score">11</td>
                    </tr>
                    <tr>
                        <td>Nutrition Et Régimes alimentaires</td>
                        <td>16</td>
                        <td>15</td>
                        <td class="note-finale high-score">15.5</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="semester-summary">
            <h3 class="summary-title">Résumé du semestre</h3>
            <div class="summary-stats">
                <div class="stat-card">
                    <h3>Moyenne générale</h3>
                    <p>14.3</p>
                </div>
                <div class="stat-card">
                    <h3>Meilleure note</h3>
                    <p>17</p>
                </div>
                <div class="stat-card">
                    <h3>Modules validés</h3>
                    <p>5/5</p>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Calculate the average score automatically
        document.addEventListener('DOMContentLoaded', function() {
            const finalScores = document.querySelectorAll('.note-finale');
            let total = 0;
            
            finalScores.forEach(score => {
                total += parseFloat(score.textContent);
            });
            
            const average = (total / finalScores.length).toFixed(1);
            document.querySelector('.stat-card p').textContent = average;
        });
    </script>
</body>
</html>