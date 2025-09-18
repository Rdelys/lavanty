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
            <a href="{{ url('/') }}" class="text-2xl font-bold text-blue-600 flex items-center gap-2">
                <i class="fas fa-gavel text-yellow-400"></i> Lavanty.mg
            </a>
            <nav class="hidden md:flex items-center gap-6">
                <a href="{{ url('/') }}" class="hover:text-blue-600 transition">Accueil</a>
                <a href="{{ url('/products') }}" class="hover:text-blue-600 transition">Produits</a>
                <a href="{{ url('/contact') }}" class="hover:text-blue-600 transition">Contact</a>
                <button id="openLogin" class="hover:text-yellow-500 transition">Connexion</button>
                <button id="openRegister" class="px-4 py-2 bg-blue-600 text-yellow-400 rounded-lg shadow hover:scale-105 transition">
                    Inscription
                </button>
            </nav>
        </div>
    </header>

    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-blue-900 text-gray-200 py-6 mt-10">
        <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center">
            <p>&copy; {{ date('Y') }} Lavanty.mg - Tous droits réservés.</p>
            <p class="text-sm mt-2 md:mt-0">Développé par <span class="text-yellow-400 font-semibold">Dev Art Agency</span></p>
        </div>
    </footer>

    <!-- Modals -->
    <div id="modalOverlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40"></div>

    <!-- Modal Inscription -->
    <div id="registerModal" class="fixed inset-0 flex items-center justify-center z-50 hidden transform transition-all scale-95 opacity-0">
        <div class="bg-white rounded-xl w-96 p-6 relative shadow-xl">
            <button id="closeRegister" class="absolute top-3 right-3 text-gray-500 hover:text-gray-800">
                <i class="fas fa-times"></i>
            </button>
            <h2 class="text-2xl font-bold mb-4 text-center">Inscription</h2>
            <form class="flex flex-col gap-4">
                <input type="text" placeholder="Nom complet" class="border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
                <input type="email" placeholder="Email" class="border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
                <input type="password" placeholder="Mot de passe" class="border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
                <button type="submit" class="bg-blue-600 text-yellow-400 font-bold py-2 rounded hover:bg-blue-700 transition">Créer un compte</button>
            </form>
        </div>
    </div>

    <!-- Modal Connexion -->
    <div id="loginModal" class="fixed inset-0 flex items-center justify-center z-50 hidden transform transition-all scale-95 opacity-0">
        <div class="bg-white rounded-xl w-96 p-6 relative shadow-xl">
            <button id="closeLogin" class="absolute top-3 right-3 text-gray-500 hover:text-gray-800">
                <i class="fas fa-times"></i>
            </button>
            <h2 class="text-2xl font-bold mb-4 text-center">Connexion</h2>
            <form class="flex flex-col gap-4">
                <input type="email" placeholder="Email" class="border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
                <input type="password" placeholder="Mot de passe" class="border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
                <button type="submit" class="bg-yellow-600 text-white font-bold py-2 rounded hover:bg-yellow-500 transition">Se connecter</button>
            </form>
        </div>
    </div>

    <!-- Script pour ouvrir/fermer les modals -->
    <script>
        const overlay = document.getElementById('modalOverlay');

        const registerModal = document.getElementById('registerModal');
        const loginModal = document.getElementById('loginModal');

        document.getElementById('openRegister').addEventListener('click', () => openModal(registerModal));
        document.getElementById('closeRegister').addEventListener('click', () => closeModal(registerModal));

        document.getElementById('openLogin').addEventListener('click', () => openModal(loginModal));
        document.getElementById('closeLogin').addEventListener('click', () => closeModal(loginModal));

        overlay.addEventListener('click', () => {
            closeModal(registerModal);
            closeModal(loginModal);
        });

        function openModal(modal) {
            overlay.classList.remove('hidden');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('scale-95', 'opacity-0');
            }, 50);
        }

        function closeModal(modal) {
            modal.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                overlay.classList.add('hidden');
            }, 200);
        }
    </script>

</body>
</html>
