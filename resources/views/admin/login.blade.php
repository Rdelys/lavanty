<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-600 via-indigo-700 to-purple-800">

    <div class="relative w-full max-w-md">
        <!-- Effet halo derrière la carte -->
        <div class="absolute inset-0 bg-white/20 backdrop-blur-3xl rounded-3xl"></div>

        <!-- Carte login -->
        <div class="relative bg-white/10 backdrop-blur-xl shadow-2xl rounded-3xl p-8 border border-white/20">
            
            <!-- Logo / icône admin -->
            <div class="flex justify-center mb-6">
                <div class="bg-white/20 p-4 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.1-.9-2-2-2H6v6h4c1.1 0 2-.9 2-2zM18 7h-6v10h6c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2z"/>
                    </svg>
                </div>
            </div>

            <h2 class="text-3xl font-bold text-center text-white mb-6">Connexion Admin</h2>

            @if($errors->any())
                <div class="bg-red-500/80 text-white p-2 rounded mb-4 text-center">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-200">Email</label>
                    <input type="email" name="email" class="w-full mt-1 p-3 rounded-xl bg-white/20 text-white placeholder-gray-300 border border-white/30 focus:outline-none focus:ring-2 focus:ring-purple-400" placeholder="admin@test.com" required>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-200">Mot de passe</label>
                    <input type="password" name="password" class="w-full mt-1 p-3 rounded-xl bg-white/20 text-white placeholder-gray-300 border border-white/30 focus:outline-none focus:ring-2 focus:ring-purple-400" placeholder="********" required>
                </div>

                <button type="submit" class="w-full py-3 rounded-xl font-semibold bg-gradient-to-r from-purple-500 to-indigo-600 text-white hover:opacity-90 transition">
                    🚀 Se connecter
                </button>
            </form>

            <p class="mt-6 text-center text-gray-300 text-sm">
                Accès réservé uniquement aux administrateurs
            </p>
        </div>
    </div>

</body>
</html>
