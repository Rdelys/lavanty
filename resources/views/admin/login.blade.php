<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion Administrateur | Lavanty.mg</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: "DM Sans", sans-serif;
      background: radial-gradient(circle at top left, #002f6c, #3b0a91, #120036);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      color: #fff;
    }

    h2 {
      font-family: "Playfair Display", serif;
      color: #ffd700;
      letter-spacing: -0.02em;
    }

    /* Carte en verre */
    .glass-card {
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.15);
      box-shadow: 0 15px 45px rgba(0, 0, 0, 0.3);
      border-radius: 24px;
      transition: all 0.4s ease;
    }

    .glass-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.45);
    }

    /* Inputs */
    input {
      font-family: "DM Sans", sans-serif;
      transition: all 0.3s ease;
    }

    input:focus {
      border-color: #ffd700 !important;
      box-shadow: 0 0 10px rgba(255, 215, 0, 0.25);
      background-color: rgba(255, 255, 255, 0.15);
    }

    /* Bouton principal */
    .btn-admin {
      background: linear-gradient(135deg, #ffd700, #e6c300);
      color: #002f6c;
      font-weight: 700;
      font-family: "DM Sans", sans-serif;
      transition: all 0.3s ease;
    }

    .btn-admin:hover {
      transform: translateY(-2px);
      background: linear-gradient(135deg, #ffde5f, #f0c800);
      box-shadow: 0 6px 20px rgba(255, 215, 0, 0.35);
    }

    /* Effet décoratif en halo */
    .halo::before {
      content: "";
      position: absolute;
      width: 220px;
      height: 220px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(255,215,0,0.2), transparent 70%);
      top: -60px;
      left: -60px;
      z-index: 0;
      animation: pulse 5s infinite ease-in-out;
    }

    @keyframes pulse {
      0%, 100% { opacity: 0.5; transform: scale(1); }
      50% { opacity: 1; transform: scale(1.2); }
    }
  </style>
</head>

<body>
  <div class="relative w-full max-w-md halo">
    <!-- Carte -->
    <div class="relative glass-card p-8">
      <!-- Logo / Icône -->
      <div class="flex justify-center mb-6">
        <div class="bg-white/20 p-4 rounded-full shadow-lg border border-white/30">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 11c0-1.1-.9-2-2-2H6v6h4c1.1 0 2-.9 2-2zM18 7h-6v10h6c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2z"/>
          </svg>
        </div>
      </div>

      <h2 class="text-3xl font-bold text-center mb-6">Connexion Admin</h2>

      @if($errors->any())
        <div class="bg-red-500/80 text-white p-2 rounded mb-4 text-center text-sm shadow-md">
          {{ $errors->first() }}
        </div>
      @endif

      <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5 relative z-10">
        @csrf

        <div>
          <label for="email" class="block text-sm font-medium text-yellow-100 mb-1">Email</label>
          <input type="email" name="email"
            class="w-full p-3 rounded-xl bg-white/10 text-white placeholder-gray-300 border border-white/30 focus:outline-none focus:ring-2 focus:ring-yellow-400"
            placeholder="admin@lavanty.mg" required>
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-yellow-100 mb-1">Mot de passe</label>
          <input type="password" name="password"
            class="w-full p-3 rounded-xl bg-white/10 text-white placeholder-gray-300 border border-white/30 focus:outline-none focus:ring-2 focus:ring-yellow-400"
            placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn-admin w-full py-3 rounded-xl shadow-md text-base">
          🚀 Se connecter
        </button>
      </form>

      <p class="mt-6 text-center text-gray-300 text-sm italic">
        Accès réservé exclusivement à <span class="text-yellow-400 font-semibold">Lavanty.mg</span>
      </p>
    </div>
  </div>
</body>
</html>
