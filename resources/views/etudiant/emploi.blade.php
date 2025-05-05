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
        }
        
        .event.lecture {
            background-color: rgba(96, 165, 250, 0.1);
            border-left-color: var(--primary-color);
        }
        
        .event.lab {
            background-color: rgba(59, 130, 246, 0.1);
            border-left-color: var(--primary-dark);
        }
        
        .event.study {
            background-color: rgba(147, 197, 253, 0.1);
            border-left-color: var(--primary-light);
        }
        
        .event.exam {
            background-color: rgba(248, 113, 113, 0.1);
            border-left-color: var(--accent-color);
        }
        
        .event:hover {
            transform: scale(1.02);
            box-shadow: var(--shadow-sm);
        }
        
        .event .title {
            font-weight: bold;
            margin-bottom: 3px;
        }
        
        .event .time, .event .location {
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
    <x-nav-barre></x-nav-barre>
    <main style="margin-top: 20px">
        <div class="container">            
            <div class="calendar">
                
                <div class="week-view">
                    <div class="time-label"></div>
                    <div class="day-header">Lundi</div>
                    <div class="day-header">Mardi</div>
                    <div class="day-header">Mercredi</div>
                    <div class="day-header">Jeudi</div>
                    <div class="day-header">Vendredi</div>
                    <div class="day-header">Samedi</div>
                    
                    <!-- 8 AM Row -->
                    <div class="time-label">8:30</div>
                    <div class="time-slot"></div>
                    <div class="time-slot">
                        <div class="event lecture">
                            <div class="title">
                                Anatomie et physiologie</div>
                            <div class="time">8:30 - 9:30</div>
                            <div class="location">Amphi A</div>
                        </div>
                    </div>
                    <div class="time-slot"></div>
                    <div class="time-slot">
                        <div class="event lecture">
                            <div class="title">
                                Anatomie et physiologie</div>
                            <div class="time">8:30 - 9:30</div>
                            <div class="location">Amphi A</div>
                        </div>
                    </div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    
                    <!-- 9 AM Row -->
                    <div class="time-label">9:30 AM</div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot">
                        <div class="event study">
                            <div class="title">Chimie analytique</div>
                            <div class="time">9:00 - 11:30</div>
                            <div class="location">Labo L2</div>
                        </div>
                    </div>
                    
                    <!-- 10 AM Row -->
                    <div class="time-label">10:30 AM</div>
                    <div class="time-slot">
                        <div class="event lecture">
                            <div class="title">Biophysique</div>
                            <div class="time">10:00 - 11:30</div>
                            <div class="location">Salle 304</div>
                        </div>
                    </div>
                    <div class="time-slot"></div>
                    <div class="time-slot">
                        <div class="event lecture">
                            <div class="title">
                                TP Microbiologie</div>
                            <div class="time">10:00 - 11:30</div>
                            <div class="location">Labo 4</div>
                        </div>
                    </div>
                    <div class="time-slot"></div>
                    <div class="time-slot">
                        <div class="event lecture">
                            <div class="title">
                                TP Microbiologie</div>
                            <div class="time">10:00 - 11:30</div>
                            <div class="location">Labo 4</div>
                        </div>
                    </div>
                    <div class="time-slot"></div>
                    
                    <!-- 11 AM Row -->
                    <div class="time-label">11:30 AM</div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    
                    <!-- 12 PM Row -->
                    <div class="time-label">12:30 PM</div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    
                    <!-- 1 PM Row -->
                    <div class="time-label">1:30 PM</div>
                    <div class="time-slot">
                        <div class="event lab">
                            <div class="title">Anatomie et physiologie</div>
                            <div class="time">1:00 - 3:30</div>
                            <div class="location">Amphi A</div>
                        </div>
                    </div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot">
                        <div class="event lab">
                            <div class="title">
                                Chimie analytique</div>
                            <div class="time">1:00 - 3:00</div>
                            <div class="location">Labo L2</div>
                        </div>
                    </div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    
                    <!-- 2 PM Row -->
                    <div class="time-label">2:30 PM</div>
                    <div class="time-slot"></div>
                    <div class="time-slot">
                        <div class="event lecture">
                            <div class="title">Microbiologie</div>
                            <div class="time">2:00 - 3:30</div>
                            <div class="location">Amphi B</div>
                        </div>
                    </div>
                    <div class="time-slot">
                        <div class="event lecture">
                            <div class="title">Microbiologie</div>
                            <div class="time">2:00 - 3:30</div>
                            <div class="location">Amphi B</div>
                        </div>
                    </div>
                    <div class="time-slot"></div>
                    <div class="time-slot">
                        <div class="event lecture">
                            <div class="title">Anglais</div>
                            <div class="time">2:00 - 3:30</div>
                            <div class="location">Salle d4</div>
                        </div>
                    </div>
                    <div class="time-slot"></div>
                    
                    <!-- 3 PM Row -->
                    <div class="time-label">3:30 PM</div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    
                    <!-- 4 PM Row -->
                    <div class="time-label">4:30 PM</div>
                    <div class="time-slot">
                        <div class="event study">
                            <div class="title">Digital skills</div>
                            <div class="time">4:00 - 6:00</div>
                            <div class="location">Salle tp 01</div>
                        </div>
                    </div>
                    <div class="time-slot"></div>
                    <div class="time-slot">
                        <div class="event study">
                            <div class="title">Digital skills</div>
                            <div class="time">4:00 - 6:00</div>
                            <div class="location">Salle tp 01</div>
                        </div>
                    </div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    
                    <!-- 5 PM Row -->
                    <div class="time-label">5:30 PM</div>
                    <div class="time-slot"></div>
                    <div class="time-slot">

                    </div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('js/etudiant-js/menus-script.js') }}"></script>
</body>
</html>