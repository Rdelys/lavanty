<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Lavanty.mg - Enchères en Ligne')</title>
    <script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&family=Rubik:wght@400;600;700&display=swap");

    /* === Global Premium Lavanty === */
    body {
  font-family: "Nunito", sans-serif;
      background-color: #ffffff;
      color: #1a1a1a;
    }
    h1, h2, h3, h4, h5 {
  font-family: "Rubik", sans-serif;
      color: #002f6c;
      font-weight: 700;
      letter-spacing: -0.02em;
    }

    /* Animation premium */
    .fade-in { animation: fadeIn 0.4s ease-in-out; }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Effet glass VIP */
    .glass {
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(18px);
      border: 1px solid rgba(255, 215, 0, 0.4);
      box-shadow: 0 8px 32px rgba(0, 74, 173, 0.15);
    }

    /* Boutons */
    .btn-premium {
      background: linear-gradient(135deg, #002f6c, #004aad);
      color: #ffd700;
      font-weight: 600;
  font-family: "Nunito", sans-serif;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(0,47,108,0.2);
    }
    .btn-premium:hover {
      transform: translateY(-2px);
      background: linear-gradient(135deg, #003c9e, #002f6c);
      box-shadow: 0 6px 20px rgba(0,47,108,0.3);
    }

    .btn-yellow {
      background: linear-gradient(135deg, #ffd700, #e6c300);
      color: #002f6c;
      font-weight: 700;
  font-family: "Nunito", sans-serif;
      transition: all 0.3s ease;
    }
    .btn-yellow:hover {
      transform: translateY(-2px);
      background: linear-gradient(135deg, #ffdf5e, #ffd000);
      box-shadow: 0 6px 20px rgba(255,215,0,0.4);
    }

    /* Toast enchères */
    #bidNotifications {
      position: fixed;
      bottom: 20px;
      right: 20px;
      display: flex;
      flex-direction: column;
      gap: 12px;
      z-index: 9999;
      pointer-events: none;
    }
    .bid-toast {
      background: #fff;
      border-left: 6px solid #ffd700;
      box-shadow: 0 5px 25px rgba(0,47,108,0.2);
      border-radius: 14px;
      padding: 1rem 1.2rem;
      min-width: 260px;
      max-width: 340px;
      animation: fadeInRight 0.4s ease forwards;
  font-family: "Nunito", sans-serif;
      pointer-events: auto;
    }
    .bid-toast.hide { animation: fadeOutRight 0.5s ease forwards; }
    .bid-toast h4 {
      color:#002f6c;
      font-weight:700;
      font-size:1rem;
      margin-bottom:0.25rem;
    }
    .bid-toast .amount {
      color:#ffd700;
      font-weight:700;
    }

    @keyframes fadeInRight { from {opacity:0;transform:translateX(60px);} to {opacity:1;transform:translateX(0);} }
    @keyframes fadeOutRight { from {opacity:1;transform:translateX(0);} to {opacity:0;transform:translateX(60px);} }

    /* ===============================
   HEADER STYLE TEMPLATE NILAMEX
================================= */
/* HEADER PAR DÉFAUT (transparent) */
#mainHeader {
  background: transparent;
  backdrop-filter: blur(0px);
  -webkit-backdrop-filter: blur(0px);
}

/* HEADER AU SCROLL */
#mainHeader.scrolled {
  background: rgba(255, 255, 255, 0.85);
  backdrop-filter: blur(18px);
  -webkit-backdrop-filter: blur(18px);
  box-shadow: 0 8px 30px rgba(0,0,0,0.05);
}

/* MENU SUR HEADER TRANSPARENT */
#mainHeader:not(.scrolled) nav a {
  color: #ffffff;
  font-weight: 600;
  text-shadow: 0 2px 8px rgba(0,0,0,0.6);
}

#mainHeader:not(.scrolled) nav a:hover {
  color: #ffd700;
}

/* SEARCH GLASS MODE */
#mainHeader:not(.scrolled) form {
  background: rgba(255,255,255,0.12);
  backdrop-filter: blur(12px);
  border: 1px solid rgba(255,255,255,0.35);
}

#mainHeader:not(.scrolled) form input {
  background: transparent;
  color: white;
}

#mainHeader:not(.scrolled) form input::placeholder {
  color: rgba(255,255,255,0.85);
}

#mainHeader:not(.scrolled) form button {
  background: #ffd700;
}

#mainHeader:not(.scrolled) form button i {
  color: #002f6c;
}

#mainHeader:not(.scrolled) #openLogin {
  color: white;
  font-weight: 700;
  text-shadow: 0 2px 8px rgba(0,0,0,0.6);
}

#mainHeader:not(.scrolled) #openLogin:hover {
  color: #ffd700;
}

/* Bouton Catégories en mode transparent */
#mainHeader:not(.scrolled) #dropdownButton {
  color: white;
  font-weight: 600;
  text-shadow: 0 2px 8px rgba(0,0,0,0.6);
}

#mainHeader:not(.scrolled) #dropdownButton:hover {
  color: #ffd700;
}

/* Logo */
header img {
  transition: transform 0.3s ease;
}
header img:hover {
  transform: scale(1.05);
}

/* Menu principal */
#mainHeader.scrolled nav a {
  position: relative;
  font-family: "Nunito", sans-serif;
  font-weight: 600;
  color: #1f2937;
  padding: 6px 0;
  transition: all 0.3s ease;
}

/* Effet underline animé */
header nav a::after {
  display: none;
}

header nav a:hover {
  color: #6366f1;
}



/* ===== DROPDOWN GLASS PREMIUM ===== */
#dropdownMenu {
  background: rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  border-radius: 20px;
  border: 1px solid rgba(255,255,255,0.3);
  box-shadow: 0 25px 60px rgba(0,0,0,0.25);
  padding: 12px 0;
  min-width: 220px;
}

/* Liens */
#dropdownMenu a {
  color: white;
  font-weight: 500;
  padding: 12px 22px;
  display: block;
  transition: all 0.25s ease;
  text-shadow: 0 2px 6px rgba(0,0,0,0.5);
}

/* Hover */
#dropdownMenu a:hover {
  background: rgba(255,255,255,0.12);
  color: white;
  padding-left: 28px;
}

/* Barre de recherche */
header form {
  background: rgba(255,255,255,0.9);
  backdrop-filter: blur(12px);
  border-radius: 9999px;
  border: 1px solid rgba(0,0,0,0.05);
  transition: all 0.3s ease;
}

header form:focus-within {
  box-shadow: 0 0 0 3px rgba(99,102,241,0.15);
}

header form input {
  background: transparent;
}

/* Bouton recherche */
header form button {
  background: #6366f1;
  transition: all 0.3s ease;
}

header form button:hover {
  background: #4f46e5;
}

/* Boutons compte */
header .btn-premium {
  background: linear-gradient(135deg,#6366f1,#8b5cf6);
  color: white;
  box-shadow: 0 5px 18px rgba(99,102,241,0.3);
}

header .btn-premium:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(99,102,241,0.4);
}

header .btn-yellow {
  background: #facc15;
  color: #111827;
}

header .btn-yellow:hover {
  background: #eab308;
}

/* Icônes (mobile + user) */
#mobileMenuButton {
  transition: all 0.3s ease;
}

#mobileMenuButton:hover {
  color: #6366f1;
  transform: scale(1.1);
}

/* Menu mobile */
#mobileMenu {
  background: rgba(255,255,255,0.95);
  backdrop-filter: blur(16px);
}


    /* Footer typographique */
    footer {
  font-family: "Nunito", sans-serif;
      background-color: #002f6c;
      color: #e5e5e5;
    }
    footer h3 {
  font-family: "Rubik", sans-serif;
      color: #ffd700;
    }
    footer a:hover {
      color: #ffd700;
    }

    /* SUPPRESSION TOTALE DES LIGNES JAUNES */
#dropdownMenu,
#dropdownMenu a,
#dropdownMenu hr {
  border-color: rgba(255,255,255,0.2) !important;
}

#dropdownMenu {
  border-bottom: none !important;
}
  </style>
</head>

<body class="bg-white flex flex-col min-h-screen font-[Inter] text-gray-800">

    <!-- 🔹 Barre supérieure 
    <div class="w-full bg-blue-950 text-gray-100 text-sm py-2 px-6 flex flex-wrap justify-between items-center">
        <div class="flex items-center gap-4">
            <span><i class="fa-regular fa-envelope text-yellow-400 mr-1"></i> info@lavanty.mg</span>
        </div>
        <div class="flex items-center gap-3 mt-1 sm:mt-0">
            <a href="#" class="border border-gray-400 text-xs px-3 py-1 rounded-full hover:bg-yellow-400 hover:text-blue-900 transition">COMMENT ENCHÉRIR</a>
            <a href="#" class="border border-gray-400 text-xs px-3 py-1 rounded-full hover:bg-yellow-400 hover:text-blue-900 transition">VENDRE UN ARTICLE</a>
            <a href="#" class="flex items-center gap-1 hover:text-yellow-400"><i class="fa-solid fa-language"></i> Langue</a>
        </div> 
    </div>-->

    <!-- 🔹 Header principal -->
<header id="mainHeader" class="fixed top-0 left-0 w-full z-50 transition-all duration-300">  <div class="container mx-auto flex items-center justify-between px-6 py-4">

            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <img src="{{ asset('logo.png') }}" alt="Lavanty Logo" class="h-10">
            </a>


            <!-- Menu principal -->
            <nav class="hidden lg:flex items-center gap-6 font-medium relative">
                <a href="{{ url('/') }}" class="text-blue-900 hover:text-yellow-500">Accueil</a>

                <!-- 🔽 Dropdown Produits -->
                <div class="relative" id="productDropdown">
                    <button 
                        id="dropdownButton" 
                        class="text-blue-900 hover:text-yellow-500 flex items-center gap-1 focus:outline-none"
                    >
                        Catégories
                        <i class="fa-solid fa-chevron-down text-xs mt-0.5"></i>
                    </button>

                    <!-- Sous-menu -->
<div 
    id="dropdownMenu"
    class="absolute hidden mt-2 py-2 w-56 z-50"
>
                        <a href="{{ url('/products') }}" class="block px-4 py-2 hover:bg-yellow-50 text-blue-900 font-medium">Tous les produits</a>
                        <a href="{{ url('/products') }}?category=Mobilier" class="block px-4 py-2 hover:bg-yellow-50 text-blue-900">Mobilier</a>
                        <a href="{{ url('/products') }}?category=Voitures" class="block px-4 py-2 hover:bg-yellow-50 text-blue-900">Voitures</a>
                        <a href="{{ url('/products') }}?category=Equipements" class="block px-4 py-2 hover:bg-yellow-50 text-blue-900">Équipements</a>
                        <a href="{{ url('/products') }}?category=High tech" class="block px-4 py-2 hover:bg-yellow-50 text-blue-900">High tech</a>
                    </div>
                </div>


                <a href="{{ url('/about') }}" class="text-blue-900 hover:text-yellow-500">À propos</a>
                <a href="{{ url('/contact') }}" class="text-blue-900 hover:text-yellow-500">Contact</a>
            </nav>


            <!-- Recherche + compte -->
            <div class="hidden lg:flex items-center gap-3">
                <form method="GET" action="{{ url('/products') }}" class="flex items-center border rounded-full overflow-hidden shadow-sm">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Recherchez un produit..." 
                        class="px-4 py-2 outline-none w-64 text-sm"
                    >
                    <button type="submit" class="bg-yellow-400 px-4 py-2">
                        <i class="fa-solid fa-magnifying-glass text-blue-900"></i>
                    </button>
                </form>


                @auth
                    <a href="{{ route('profile.index') }}" class="bg-blue-900 text-yellow-400 px-4 py-2 rounded-full font-semibold">
                        <i class="fa-regular fa-user mr-1"></i> Mon Compte
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="btn-yellow px-4 py-2 rounded-full text-sm">Déconnexion</button>
                    </form>
                @else
                    <button id="openLogin" class="text-blue-900 hover:text-yellow-500 font-semibold">Connexion</button>
                    <button id="openRegister" class="btn-premium px-5 py-2 rounded-full">Inscription</button>
                @endauth
            </div>

            <!-- Bouton mobile -->
            <button id="mobileMenuButton" class="lg:hidden text-blue-900 text-2xl focus:outline-none">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- 🔸 Menu mobile -->
        <div id="mobileMenu" class="hidden flex-col bg-blue-50 border-t border-gray-200 px-6 py-3 fade-in">
            <a href="{{ url('/') }}" class="block py-2 text-blue-900 hover:text-yellow-500">Accueil</a>
            <!-- Dropdown mobile Produits -->
            <div x-data="{ open: false }" class="relative">
                <button onclick="this.nextElementSibling.classList.toggle('hidden')" class="w-full text-left flex items-center justify-between py-2 text-blue-900 hover:text-yellow-500">
                    Catégories
                    <i class="fa-solid fa-chevron-down text-xs"></i>
                </button>
                <div class="hidden pl-4">
                    <a href="{{ url('/products') }}" class="block py-1 text-blue-900 hover:text-yellow-500">Tous les produits</a>
                    <a href="{{ url('/products') }}?category=Mobilier" class="block py-1 text-blue-900 hover:text-yellow-500">Mobilier</a>
                    <a href="{{ url('/products') }}?category=Voitures" class="block py-1 text-blue-900 hover:text-yellow-500">Voitures</a>
                    <a href="{{ url('/products') }}?category=Equipements" class="block py-1 text-blue-900 hover:text-yellow-500">Équipements</a>
                    <a href="{{ url('/products') }}?category=High tech" class="block py-1 text-blue-900 hover:text-yellow-500">High tech</a>
                </div>
            </div>
            <a href="{{ url('/about') }}" class="block py-2 text-blue-900 hover:text-yellow-500">À propos</a>
            <a href="{{ url('/contact') }}" class="block py-2 text-blue-900 hover:text-yellow-500">Contact</a>
            <div class="border-t border-gray-300 my-2"></div>

            @auth
                <a href="{{ route('profile.index') }}" class="block py-2 font-semibold text-blue-900">Mon profil</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="w-full text-left text-red-600 font-bold py-2">Déconnexion</button>
                </form>
            @else
                <button id="openLoginMobile" class="block py-2 text-blue-900 hover:text-yellow-500">Connexion</button>
                <button id="openRegisterMobile" class="btn-premium py-2 rounded-full mt-2 w-full">Inscription</button>
            @endauth
        </div>
    </header>

    <!-- Contenu principal -->
    <main class="flex-1 fade-in">@yield('content')</main>

    <!-- Footer -->
    <!-- 🌙 FOOTER PREMIUM LAVANTY -->
<footer class="bg-blue-950 text-gray-300 pt-14 pb-8 border-t-4 border-yellow-400">
  <div class="container mx-auto px-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">

    <!-- 🔹 Colonne 1 : Logo + présentation -->
    <div>
      <a href="{{ url('/') }}" class="block mb-4">
          <img src="{{ asset('logofooter.png') }}" alt="Lavanty Footer Logo" class="h-14">
      </a>
      <p class="text-sm leading-relaxed text-gray-400">
        Votre plateforme d’enchères en ligne à Madagascar.  
        Découvrez, enchérissez et remportez des articles rares et exclusifs en toute sécurité.
      </p>

      <!-- Réseaux sociaux -->
      <div class="flex gap-4 mt-5 text-lg">
        <a href="#" class="hover:text-yellow-400"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="hover:text-yellow-400"><i class="fab fa-instagram"></i></a>
        <a href="#" class="hover:text-yellow-400"><i class="fab fa-twitter"></i></a>
        <a href="#" class="hover:text-yellow-400"><i class="fab fa-linkedin-in"></i></a>
      </div>
    </div>

    <!-- 🔹 Colonne 2 : Catégories -->
    <div>
      <h3 class="text-yellow-400 font-semibold text-lg mb-4 uppercase">Catégories</h3>
      <ul class="space-y-2 text-sm">
        <li><a href="#" class="hover:text-yellow-400 transition">Automobile</a></li>
        <li><a href="#" class="hover:text-yellow-400 transition">Antiquités</a></li>
        <li><a href="#" class="hover:text-yellow-400 transition">Art & Design</a></li>
        <li><a href="#" class="hover:text-yellow-400 transition">High-Tech</a></li>
        <li><a href="#" class="hover:text-yellow-400 transition">Mobilier</a></li>
      </ul>
    </div>

    <!-- 🔹 Colonne 3 : Informations -->
    <div>
      <h3 class="text-yellow-400 font-semibold text-lg mb-4 uppercase">Informations</h3>
      <ul class="space-y-2 text-sm">
        <li><a href="#" class="hover:text-yellow-400 transition">À propos de nous</a></li>
        <li><a href="#" class="hover:text-yellow-400 transition">FAQ</a></li>
        <li><a href="#" class="hover:text-yellow-400 transition">Contact</a></li>
        <li><a href="#" class="hover:text-yellow-400 transition">Conditions d’utilisation</a></li>
        <li><a href="#" class="hover:text-yellow-400 transition">Politique de confidentialité</a></li>
      </ul>
    </div>

    <!-- 🔹 Colonne 4 : Newsletter + Paiement sécurisé -->
    <div>
      <h3 class="text-yellow-400 font-semibold text-lg mb-4 uppercase">Newsletter</h3>
      <p class="text-sm text-gray-400 mb-4">
        Abonnez-vous pour recevoir nos ventes exclusives et actualités en avant-première.
      </p>

      <!-- Formulaire newsletter -->
      <form class="flex flex-col sm:flex-row items-center gap-2">
        <input
          type="email"
          placeholder="Votre adresse email"
          class="w-full px-4 py-2 rounded-md text-gray-800 focus:ring-2 focus:ring-yellow-400 outline-none"
        />
        <button
          type="submit"
          class="bg-yellow-400 text-blue-950 font-semibold px-4 py-2 rounded-md hover:bg-yellow-500 transition"
        >
          <i class="fa-solid fa-paper-plane"></i>
        </button>
      </form>

      <!-- 💳 Paiement sécurisé -->
      <div class="mt-6">
        <p class="text-sm text-gray-300 mb-2 font-medium">
          <i class="fa-solid fa-lock text-yellow-400 mr-2"></i>Paiement sécurisé :
        </p>

        <div class="flex flex-wrap items-center gap-5 text-4xl">
          <!-- Cartes bancaires -->
          <div class="flex flex-col items-center gap-1">
            <i class="fab fa-cc-visa text-blue-400 hover:text-blue-500 transition"></i>
            <span class="text-xs text-gray-400">Visa</span>
          </div>
          <div class="flex flex-col items-center gap-1">
            <i class="fab fa-cc-mastercard text-red-500 hover:text-red-600 transition"></i>
            <span class="text-xs text-gray-400">Mastercard</span>
          </div>
          <div class="flex flex-col items-center gap-1">
            <i class="fab fa-cc-amex text-blue-300 hover:text-blue-400 transition"></i>
            <span class="text-xs text-gray-400">Amex</span>
          </div>
          <div class="flex flex-col items-center gap-1">
            <i class="fab fa-cc-discover text-orange-400 hover:text-orange-500 transition"></i>
            <span class="text-xs text-gray-400">Maestro</span>
          </div>

          <!-- Paiements locaux -->
          <div class="flex flex-col items-center gap-1">
            <div
              class="w-10 h-10 flex items-center justify-center rounded-full bg-yellow-400 hover:bg-yellow-500 transition"
              title="MVola"
            >
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="w-5 h-5 fill-blue-950">
                <path d="M6 22v20h8V26h4v16h8V22H6zm28 0v20h8V26h4v16h8V22H34z" />
              </svg>
            </div>
            <span class="text-xs text-gray-400">MVola</span>
          </div>

          <div class="flex flex-col items-center gap-1">
            <div
              class="w-10 h-10 flex items-center justify-center rounded-full bg-orange-500 hover:bg-orange-600 transition"
              title="Orange Money"
            >
              <i class="fa-solid fa-coins text-white text-lg"></i>
            </div>
            <span class="text-xs text-gray-400">Orange</span>
          </div>

          <div class="flex flex-col items-center gap-1">
            <div
              class="w-10 h-10 flex items-center justify-center rounded-full bg-red-600 hover:bg-red-700 transition"
              title="Airtel Money"
            >
              <i class="fa-solid fa-wave-square text-white text-lg"></i>
            </div>
            <span class="text-xs text-gray-400">Airtel</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bas du footer -->
  <div class="border-t border-gray-700 mt-10 pt-4 text-center text-sm text-gray-400">
    <p>
      &copy; {{ date('Y') }}
      <span class="text-yellow-400 font-semibold">Lavanty.mg</span> — Tous droits réservés.
    </p>
    <p class="text-xs mt-1">
      Développé avec ❤️ par
      <span class="text-yellow-400">Dev Art Agency</span>
    </p>
  </div>
</footer>

<!-- 💅 Styles & Font Awesome -->
<style>
footer i,
footer svg {
  transition: transform 0.3s ease;
}
footer i:hover,
footer svg:hover {
  transform: scale(1.12);
}
footer a {
  transition: color 0.3s ease;
}
</style>

<!-- 📦 Font Awesome CDN -->
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
/>


    <!-- ✅ Modals inchangés -->
    <div id="modalOverlay" class="fixed inset-0 bg-black bg-opacity-40 hidden z-40 backdrop-blur-sm"></div>

    <div id="registerModal" class="fixed inset-0 flex items-center justify-center z-50 hidden transform transition-all scale-95 opacity-0">
        <div class="glass rounded-2xl w-96 p-6 relative fade-in">
            <button id="closeRegister" class="absolute top-3 right-3 text-gray-500 hover:text-blue-800"><i class="fas fa-times"></i></button>
            <h2 class="text-2xl modal-title mb-4 text-center text-blue-800">Créer un compte</h2>
            <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-4">
                @csrf
                <input type="text" name="nom" placeholder="Nom" class="border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
                <input type="text" name="prenoms" placeholder="Prénoms" class="border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
                <input type="email" name="email" placeholder="Adresse email" class="border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
                <input type="tel" name="telephone" placeholder="Numéro de téléphone" class="border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
                <input type="password" name="password" placeholder="Mot de passe" class="border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
                <input type="password" name="password_confirmation" placeholder="Confirmation du mot de passe" class="border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="btn-premium py-2 rounded-full">Créer un compte</button>
            </form>
        </div>
    </div>

    <div id="loginModal" class="fixed inset-0 flex items-center justify-center z-50 hidden transform transition-all scale-95 opacity-0">
        <div class="glass rounded-2xl w-96 p-6 relative fade-in">
            <button id="closeLogin" class="absolute top-3 right-3 text-gray-500 hover:text-blue-800"><i class="fas fa-times"></i></button>
            <h2 class="text-2xl modal-title mb-4 text-center text-yellow-600">Connexion</h2>
            <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-4">
                @csrf
                <input type="email" name="email" placeholder="Email" class="border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
                <input type="password" name="password" placeholder="Mot de passe" class="border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="btn-yellow py-2 rounded-full">Se connecter</button>
            </form>
        </div>
    </div>

    <div id="bidNotifications"></div>

    <!-- Scripts d’origine -->
    <script>
        const overlay=document.getElementById('modalOverlay');
        const registerModal=document.getElementById('registerModal');
        const loginModal=document.getElementById('loginModal');
        const openRegisterButtons=[document.getElementById('openRegister'),document.getElementById('openRegisterMobile')];
        const openLoginButtons=[document.getElementById('openLogin'),document.getElementById('openLoginMobile')];
        openRegisterButtons.forEach(btn=>btn?.addEventListener('click',()=>openModal(registerModal)));
        openLoginButtons.forEach(btn=>btn?.addEventListener('click',()=>openModal(loginModal)));
        document.getElementById('closeRegister').addEventListener('click',()=>closeModal(registerModal));
        document.getElementById('closeLogin').addEventListener('click',()=>closeModal(loginModal));
        overlay.addEventListener('click',()=>{closeModal(registerModal);closeModal(loginModal);});
        function openModal(modal){overlay.classList.remove('hidden');modal.classList.remove('hidden');setTimeout(()=>modal.classList.remove('scale-95','opacity-0'),50);}
        function closeModal(modal){modal.classList.add('scale-95','opacity-0');setTimeout(()=>{modal.classList.add('hidden');overlay.classList.add('hidden');},200);}
        document.getElementById('mobileMenuButton').addEventListener('click',()=>document.getElementById('mobileMenu').classList.toggle('hidden'));
    </script>

    <script>
        let lastHighestBid=0;
        function showBidToast(data) {

    // Liste des statuts où on NE doit PAS afficher le pop-up
    const disabledStatuses = ["à_venir", "termine", "terminé", "adjugé", "expiré", "closed", "finished"];

    // Si le statut du produit est dans la liste → on stoppe
    if (disabledStatuses.includes(data.status)) {
        console.log("Pop-up désactivé car statut =", data.status);
        return;
    }

    const container = document.getElementById("bidNotifications");
    const toast = document.createElement("div");
    toast.className = "bid-toast";

    toast.innerHTML = `
        <button>&times;</button>
        <h4>💰 Nouvelle enchère placée !</h4>
        <p><strong>${data.product}</strong></p>
        <p>Montant : <span class="amount">${Number(data.amount).toLocaleString('fr-FR')} Ar</span></p>
    `;

    container.appendChild(toast);

    toast.querySelector("button").addEventListener("click", () => hideToast(toast));
    setTimeout(() => hideToast(toast), 5000);
}


        function hideToast(t){t.classList.add("hide");setTimeout(()=>t.remove(),500);}
        async function checkNewBids(){
            try{
                const r=await fetch('/api/latest-bid');
                if(!r.ok)return;
                const d=await r.json();
                if(d.amount>lastHighestBid){lastHighestBid=d.amount;showBidToast(d);}
            }catch(e){console.error("Erreur lors du check d'enchère :",e);}
        }
        checkNewBids();setInterval(checkNewBids,5000);
    </script>
    <script>
document.addEventListener('DOMContentLoaded', () => {
    const button = document.getElementById('dropdownButton');
    const menu = document.getElementById('dropdownMenu');
    const dropdown = document.getElementById('productDropdown');
    let hideTimeout;

    // Afficher quand on survole
    dropdown.addEventListener('mouseenter', () => {
        clearTimeout(hideTimeout);
        menu.classList.remove('hidden');
    });

    // Cacher quand on quitte le menu après petit délai
    dropdown.addEventListener('mouseleave', () => {
        hideTimeout = setTimeout(() => menu.classList.add('hidden'), 150);
    });

    // Permet d’ouvrir/fermer au clic sur mobile
    button.addEventListener('click', (e) => {
        e.preventDefault();
        menu.classList.toggle('hidden');
    });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {

  const header = document.getElementById("mainHeader");

  function handleScroll() {
    if (window.scrollY > 50) {
      header.classList.add("scrolled");
    } else {
      header.classList.remove("scrolled");
    }
  }

  handleScroll();
  window.addEventListener("scroll", handleScroll);

});
</script>
</body>
</html>
