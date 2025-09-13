<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Lavanty.mg - Enchères en Ligne')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto flex items-center justify-between px-6 py-4">
            <a href="{{ url('/') }}" class="text-2xl font-bold text-green-600 flex items-center gap-2">
                <i class="fas fa-gavel"></i> Lavanty.mg
            </a>
            <nav class="hidden md:flex items-center gap-6">
                <a href="{{ url('/') }}" class="hover:text-red-600 transition">Accueil</a>
                <a href="{{ url('/products') }}" class="hover:text-red-600 transition">Produits</a>
                <a href="{{ url('/contact') }}" class="hover:text-red-600 transition">Contact</a>
                <a href="#" class="hover:text-green-600 transition">Connexion</a>
                <a href="#" class="px-4 py-2 bg-gradient-to-r from-green-600 to-red-600 text-white rounded-lg shadow hover:scale-105 transition">
                    Inscription
                </a>
            </nav>
        </div>
    </header>

    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-6 mt-10">
        <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center">
            <p>&copy; {{ date('Y') }} Lavanty.mg - Tous droits réservés.</p>
            <p class="text-sm mt-2 md:mt-0">Développé par <span class="text-green-400 font-semibold">Dev Art Agency</span></p>
        </div>
    </footer>

</body>
</html>
