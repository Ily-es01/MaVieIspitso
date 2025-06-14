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
    <title>Emploi du Temps - Enseignant</title>
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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary-dark);
        }

        .calendar {
            background-color: var(--bg-card);
            border-radius: var(--border-radius-md);
            padding: 20px;
            box-shadow: var(--shadow-sm);
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .calendar-header h2 {
            color: var(--text-primary);
            font-size: 22px;
        }

        .calendar-nav {
            display: flex;
            gap: 10px;
        }

        .calendar-nav button {
            background-color: var(--secondary-color);
            border: none;
            border-radius: var(--border-radius-sm);
            padding: 8px 15px;
            cursor: pointer;
            font-weight: bold;
            color: var(--text-primary);
            transition: var(--transition-fast);
        }

        .calendar-nav button:hover {
            background-color: var(--primary-color);
            color: var(--text-light);
        }

        .week-view {
            display: grid;
            grid-template-columns: 80px repeat(6, 1fr);
            gap: 1px;
            background-color: var(--bg-light);
            border-radius: var(--border-radius-sm);
            overflow: hidden;
            min-width: 700px;
        }

        .time-slot {
            background-color: var(--bg-card);
            padding: 10px;
            min-height: 60px;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .day-header {
            background: var(--primary-gradient);
            color: var(--text-light);
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }

        .time-label {
            background-color: var(--text-primary);
            color: var(--text-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .event {
            background-color: var(--bg-hover);
            border-left: 3px solid var(--primary-color);
            padding: 8px;
            border-radius: var(--border-radius-sm);
            font-size: 12px;
            cursor: pointer;
            transition: var(--transition-fast);
             background-color: rgba(96, 165, 250, 0.1);
            border-left-color: var(--primary-color);
        }



       

        .event:hover {
            transform: scale(1.02);
            box-shadow: var(--shadow-sm);
        }

        .event .title {
            font-weight: bold;
            margin-bottom: 3px;
        }

        .event .time, .event .location, .event .option {
            font-size: 11px;
            color: var(--text-secondary);
        }

        @media (max-width: 768px) {
            .calendar {
                overflow-x: scroll;
            }
            .container {
                width: 100%;
                margin: 0 auto;
                overflow-x: auto;
            }


            .week-view {
                grid-template-columns: 60px repeat(6, 1fr);
                font-size: 12px;
            }

            .day-header, .time-label {
                padding: 5px;
                font-size: 12px;
            }

            .time-slot {
                min-height: 50px;
                padding: 5px;
            }

            .event {
                padding: 5px;
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
<x-nav-bare-ensei></x-nav-bare-ensei>
<main style="margin-top: 20px">
    <div class="container">
        <div class="calendar">
            <div class="week-view">
                <!-- Day Headers -->
                <div class="time-label"></div>
                @foreach($jours as $jour)
                    <div class="day-header">{{ $jour }}</div>
                @endforeach

                <!-- Time Slots -->
                @foreach($timeSlots as $slotIndex => $timeSlot)
                    <div class="time-label">{{ \Carbon\Carbon::createFromFormat('H:i:s', $timeSlot)->format('g:i A') }}</div>

                    @foreach($jours as $jour)
                        @php
                            $hasSeance = false;
                            $skipRender = false;

                            foreach($seancesByDay[$jour] as $seance) {
                                $seanceId = $seance->ID_seance;
                                $span = $seanceSpans[$seanceId];

                                if ($span['startSlot'] === $slotIndex) {
                                    $hasSeance = true;
                                    $currentSeance = $seance;
                                    break;
                                }

                                if ($slotIndex > $span['startSlot'] && $slotIndex <= $span['endSlot']) {
                                    $skipRender = true;
                                    break;
                                }
                            }
                        @endphp

                        @if($skipRender)
                        @else
                            @if($hasSeance)
                                @php
                                    $rowspan = $seanceSpans[$currentSeance->ID_seance]['rowspan'];


                                    $optionName = $currentSeance->module->options->first()->Nom_option ?? 'N/A';
                                @endphp
                                <div class="time-slot" style="grid-row: span {{ $rowspan }};">
                                    <div class="event">
                                        <div class="title">{{ $currentSeance->module->Nom_module }}</div>
                                        <div class="time">
                                            {{ \Carbon\Carbon::createFromFormat('H:i:s', $currentSeance->HeureDebut_seance)->format('g:i') }} -
                                            {{ \Carbon\Carbon::createFromFormat('H:i:s', $currentSeance->HeureFin_seance)->format('g:i') }}
                                        </div>
                                        <div class="location">{{ $currentSeance->salle->Nom_salle }}</div>
                                        <div class="option">Option: {{ $optionName }}</div>
                                    </div>
                                </div>
                            @else
                                <div class="time-slot"></div>
                            @endif
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</main>
    <script src="{{ asset('js/enseignant-js/menus-script.js') }}"></script>
</body>
</html>
