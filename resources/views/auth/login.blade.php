<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MavieIspitso</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #60a5fa; /* Bleu ciel */
            --primary-dark: #3b82f6; /* Bleu moyen */
            --primary-light: #93c5fd; /* Bleu très clair */
            --primary-gradient: linear-gradient(135deg, #60a5fa, #3b82f6);
            --secondary-color: #fcfcfc;
            --accent-color: #f87171; /* Rouge-corail clair */
            --text-primary: #334155; /* Gris foncé pour le texte principal */
            --text-secondary: #64748b; /* Gris moyen pour le texte secondaire */
            --text-light: #ffffff;
            --bg-light: #f1f5f9; /* Fond gris très clair */
            --bg-card: #ffffff;
            --bg-hover: rgba(96, 165, 250, 0.1); /* Surbrillance légère en bleu */
            --border-radius-sm: 12px;
            --border-radius-md: 16px;
            --border-radius-lg: 24px;
            --border-radius-xl: 30px;
            --shadow-sm: 0 4px 12px rgba(148, 163, 184, 0.1);
            --shadow-md: 0 8px 24px rgba(148, 163, 184, 0.15);
            --transition-fast: all 0.2s ease;
            --transition-standard: all 0.3s ease;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-light);
        }

        .login-container {
            min-height: 100vh;
        }

        .image-section {
            position: relative;
            overflow: hidden;
        }

        .image-section::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: var(--primary-gradient);
            z-index: 1;
        }

        .image-overlay {
            position: relative;
            z-index: 2;
        }

        .bg-ispt-gradient {
            background: var(--primary-gradient);
        }

        .text-ispt {
            color: var(--primary-color);
        }

        .btn-ispt {
            background: var(--primary-gradient);
            transition: var(--transition-standard);
            position: relative;
            overflow: hidden;
        }

        .btn-ispt:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(96, 165, 250, 0.4);
        }

        .form-input {
            transition: var(--transition-standard);
            border-left: 3px solid transparent;
        }

        .form-input:focus {
            border-color: var(--primary-color);
            border-left: 3px solid var(--primary-color);
            box-shadow: 0 0 0 2px rgba(96, 165, 250, 0.1);
            outline: none;
        }

        .btn-google {
            transition: var(--transition-standard);
            position: relative;
            overflow: hidden;
        }

        .btn-google:hover {
            background-color: var(--bg-hover);
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        .divider-text {
            position: relative;
            text-align: center;
            margin: 30px 0;
        }

        .divider-text:before,
        .divider-text:after {
            content: "";
            position: absolute;
            top: 50%;
            width: 45%;
            height: 1px;
            background-color: #e5e7eb;
        }

        .divider-text:before {
            left: 0;
        }

        .divider-text:after {
            right: 0;
        }

        .shape-top {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 50px;
            background-color: var(--primary-color);
            clip-path: polygon(0 0, 100% 0, 100% 100%, 0 0);
            z-index: 0;
        }

        .shape-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 50px;
            background-color: var(--primary-dark);
            clip-path: polygon(0 100%, 100% 0, 100% 100%, 0 100%);
            z-index: 0;
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-15px);
            }
            100% {
                transform: translateY(0px);
            }
        }

        .pulse-slow {
            animation: pulse 3s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        .shine-effect {
            position: relative;
            overflow: hidden;
        }

        .shine-effect::after {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to right,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.3) 50%,
                rgba(255, 255, 255, 0) 100%
            );
            transform: rotate(30deg);
            animation: shine 8s infinite;
        }

        @keyframes shine {
            0% {
                transform: scale(0.5) rotate(30deg) translateX(-200%);
            }
            100% {
                transform: scale(0.5) rotate(30deg) translateX(200%);
            }
        }

        .form-section {
            background-color: var(--bg-card);
            position: relative;
            z-index: 10;
        }

        .dot-pattern {
            background-image: radial-gradient(var(--primary-light) 1px, transparent 1px);
            background-size: 20px 20px;
        }

        .bg-blue-50 {
            background-color: rgba(96, 165, 250, 0.1);
        }

        .text-gray-900 {
            color: var(--text-primary);
        }

        .text-gray-600, .text-gray-500, .text-gray-700 {
            color: var(--text-secondary);
        }

        .text-green-500, .text-green-700, .border-green-500 {
            color: #10b981;
        }

        .bg-green-100 {
            background-color: rgba(16, 185, 129, 0.1);
        }

        .border-gray-300 {
            border-color: #e5e7eb;
        }
    </style>
</head>

<body>
    <div class="login-container flex flex-col md:flex-row">
        <!-- Image Section -->
        <div class="hidden md:block md:w-1/2 image-section relative">
            <img src="/api/placeholder/800/1200" alt="Étudiants ISPT" class="h-full w-full object-cover scale-110">

            <!-- Blue Overlay with Graphics -->
            <div class="absolute inset-0 z-10">
                <!-- Decorative Elements -->
                <div class="absolute top-10 left-10 w-20 h-20 rounded-full bg-white opacity-10"></div>
                <div class="absolute bottom-20 right-10 w-32 h-32 rounded-full bg-white opacity-10"></div>
                <div class="absolute top-1/3 right-20 w-16 h-16 rounded-full bg-white opacity-10"></div>

                <!-- Content Container -->
                <div class="absolute inset-0 image-overlay flex flex-col justify-between p-8 z-20">
                    <!-- Logo Area -->
                    <div class="mt-8 flex justify-center">
                        <div class="bg-white p-4 rounded-2xl shadow-lg pulse-slow" style="border-radius: var(--border-radius-md)">
                            <i class="fa-solid fa-graduation-cap"></i> <span>MaVieISPITSO</span>
                        </div>
                    </div>

                    <!-- Main Content Area -->
                    <div class="text-center px-8 py-12 bg-white bg-opacity-10 backdrop-blur-sm rounded-3xl shadow-lg mb-10 shine-effect" style="border-radius: var(--border-radius-xl)">
                        <h1 class="text-white text-5xl font-bold mb-6">MavieIspitso</h1>
                        <div class="w-24 h-1 bg-white mx-auto mb-6 rounded-full"></div>
                        <p class="text-white text-xl mb-8">Portail académique de l’Institut Supérieur des Professions Infirmières et Techniques de Santé d’Oujda</p>

                        <!-- Features Icons -->
                        <div class="flex justify-center space-x-8 mb-8">
                            <div class="text-center">
                                <div class="w-14 h-14 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center mb-2 mx-auto floating" style="border-radius: var(--border-radius-md)">
                                    <i class="fas fa-graduation-cap text-white text-2xl"></i>
                                </div>
                                <p class="text-white text-sm">Cours</p>
                            </div>
                            <div class="text-center">
                                <div class="w-14 h-14 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center mb-2 mx-auto floating" style="animation-delay: 1s; border-radius: var(--border-radius-md)">
                                    <i class="fas fa-clipboard-list text-white text-2xl"></i>
                                </div>
                                <p class="text-white text-sm">Notes</p>
                            </div>
                            <div class="text-center">
                                <div class="w-14 h-14 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center mb-2 mx-auto floating" style="animation-delay: 2s; border-radius: var(--border-radius-md)">
                                    <i class="fas fa-calendar-alt text-white text-2xl"></i>
                                </div>
                                <p class="text-white text-sm">Calendrier</p>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Area -->
                    <div class="text-white text-center py-3 bg-black bg-opacity-20 backdrop-blur-sm rounded-xl" style="border-radius: var(--border-radius-sm)">
                        <p>© 2025 ISPITSO - Institut Supérieur des Professions Infirmières et Techniques de Santé Oujda</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="w-full md:w-1/2 form-section dot-pattern flex items-center justify-center px-6 py-12 relative">
            <div class="shape-top"></div>
            <div class="shape-bottom"></div>

            <div class="w-full max-w-md bg-white p-8 rounded-3xl shadow-lg z-10" style="border-radius: var(--border-radius-xl); box-shadow: var(--shadow-md)">
                <div class="text-center mb-10">
                    <div class="inline-block p-3 bg-blue-50 rounded-2xl mb-4" style="border-radius: var(--border-radius-md)">
                        <i class="fas fa-user-graduate text-4xl text-ispt"></i>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Bienvenue sur <span class="text-ispt">MavieIspitso</span></h1>
                    <p class="text-gray-600">Connectez-vous pour accéder à votre espace</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6" style="border-radius: var(--border-radius-sm)">
                        <div class="flex">
                            <div class="py-1"><i class="fas fa-check-circle text-green-500 mr-3"></i></div>
                            <div>{{ session('status') }}</div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-6">
                        <label for="email" class="block text-gray-700 text-sm font-medium mb-2">Adresse email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="far fa-envelope text-gray-400"></i>
                            </div>
                            <input id="email"
                                   type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   autofocus
                                   autocomplete="username"
                                   class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 text-gray-900"
                                   style="border-radius: var(--border-radius-md)">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <div class="flex justify-between">
                            <label for="password" class="block text-gray-700 text-sm font-medium mb-2">Mot de passe</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                   class="text-sm text-ispt hover:underline">
                                    Mot de passe oublié?
                                </a>
                            @endif
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input id="password"
                                   type="password"
                                   name="password"
                                   required
                                   autocomplete="current-password"
                                   class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 text-gray-900"
                                   style="border-radius: var(--border-radius-md)">
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox"
                                   name="remember"
                                   id="remember_me"
                                   class="rounded-md border-gray-300 text-ispt shadow-sm focus:border-ispt focus:ring focus:ring-ispt focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
                        </label>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="btn-ispt w-full py-3 text-white font-medium shadow-lg" style="border-radius: var(--border-radius-md)">
                        Se connecter <i class="fas fa-arrow-right ml-2"></i>
                    </button>


                </form>
            </div>

            <!-- Mobile Only - ISPT Logo at bottom -->

        </div>
    </div>
</body>
</html>
