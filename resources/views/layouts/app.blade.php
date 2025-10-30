<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Lavanty.mg - Enchères en Ligne')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
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

        /* Couleurs royales */
        .royal-blue { color: #003c9e; }
        .gold { color: #ffd700; }

        /* Navbar de luxe */
        .navbar-premium {
            background: linear-gradient(90deg, #002f6c, #004aad);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-bottom: 2px solid #ffd700;
        }

        /* Boutons premium */
        .btn-premium {
            background: linear-gradient(135deg, #004aad, #0077ff);
            color: #ffd700;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(0, 74, 173, 0.3);
        }
        .btn-premium:hover {
            transform: scale(1.07);
            background: linear-gradient(135deg, #0058d4, #003c9e);
            box-shadow: 0 4px 15px rgba(0, 74, 173, 0.5);
        }

        /* Bouton jaune royal */
        .btn-yellow {
            background: linear-gradient(135deg, #ffd700, #ffcc00);
            color: #003c9e;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-yellow:hover {
            transform: scale(1.07);
            background: linear-gradient(135deg, #ffde59, #ffcb00);
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
        }

        /* Menu droit arrondi */
        .nav-right {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 30px;
            padding: 8px 16px;
        }

        /* Modal titre */
        .modal-title {
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        
/* --- Animation entrée/sortie --- */
@keyframes fadeInRight {
  from { opacity: 0; transform: translateX(60px); }
  to { opacity: 1; transform: translateX(0); }
}
@keyframes fadeOutRight {
  from { opacity: 1; transform: translateX(0); }
  to { opacity: 0; transform: translateX(60px); }
}

/* --- Container notifications (en bas à droite) --- */
#bidNotifications {
  position: fixed;
  bottom: 20px;
  right: 20px;
  display: flex;
  flex-direction: column;
  gap: 12px;
  z-index: 9999;
  pointer-events: none; /* ne bloque pas les clics sur le site */
}

/* --- Carte notification --- */
.bid-toast {
  background: #ffffff;
  border-left: 6px solid #ffd700;
  box-shadow: 0 5px 25px rgba(0, 47, 108, 0.2);
  border-radius: 14px;
  padding: 1rem 1.2rem;
  min-width: 260px;
  max-width: 340px;
  animation: fadeInRight 0.4s ease forwards;
  transition: all 0.3s ease;
  pointer-events: auto; /* clics autorisés sur la notif */
  position: relative;
}
.bid-toast.hide {
  animation: fadeOutRight 0.5s ease forwards;
}
.bid-toast h4 {
  color: #002f6c;
  font-weight: 700;
  font-size: 1rem;
  margin-bottom: 0.25rem;
}
.bid-toast p {
  color: #333;
  font-size: 0.9rem;
}
.bid-toast .amount {
  color: #ffd700;
  font-weight: 700;
}
.bid-toast button {
  background: none;
  border: none;
  color: #888;
  font-size: 1.2rem;
  font-weight: bold;
  position: absolute;
  top: 6px;
  right: 10px;
  cursor: pointer;
  transition: color 0.2s;
}
.bid-toast button:hover { color: #002f6c; }
    </style>
</head>
<body class="bg-white flex flex-col min-h-screen font-[Inter] text-gray-800">

    <!-- Header -->
    <header class="navbar-premium sticky top-0 z-50 fade-in">
        <div class="container mx-auto flex items-center justify-between px-6 py-4 text-white">
            <a href="{{ url('/') }}" class="text-2xl font-bold flex items-center gap-2 hover:scale-105 transition">
                <i class="fas fa-gavel gold"></i> <span class="text-yellow-400">Lavanty</span>.mg
            </a>

            <!-- Desktop Nav -->
            <nav class="hidden md:flex items-center gap-6 nav-right">
                <a href="{{ url('/') }}" class="hover:text-yellow-400 transition font-medium">Accueil</a>
                <a href="{{ url('/products') }}" class="hover:text-yellow-400 transition font-medium">Produits</a>
                <a href="{{ url('/contact') }}" class="hover:text-yellow-400 transition font-medium">Contact</a>

                @auth
                    <a href="{{ route('profile.index') }}" 
                    class="text-yellow-200 font-semibold hover:text-yellow-400 transition">
                        {{ auth()->user()->pseudo }}
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="btn-yellow px-4 py-2 rounded-full shadow">
                            Déconnexion
                        </button>
                    </form>
                @else
                    <button id="openLogin" class="hover:text-yellow-400 font-medium transition">Connexion</button>
                    <button id="openRegister" class="btn-premium px-5 py-2 rounded-full shadow">
                        Inscription
                    </button>
                @endauth
            </nav>

            <!-- Mobile Nav Toggle -->
            <div class="md:hidden">
                <button id="mobileMenuButton" class="text-yellow-400 text-2xl focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Dropdown Menu -->
        <div id="mobileMenu" class="md:hidden hidden flex-col gap-2 px-6 pb-4 bg-blue-50 rounded-b-2xl border-t border-blue-100 fade-in">
            <a href="{{ url('/') }}" class="block py-2 text-gray-800 hover:text-blue-700">Accueil</a>
            <a href="{{ url('/products') }}" class="block py-2 text-gray-800 hover:text-blue-700">Produits</a>
            <a href="{{ url('/contact') }}" class="block py-2 text-gray-800 hover:text-blue-700">Contact</a>

            @auth
                <a href="{{ route('profile.index') }}" 
                class="block py-2 text-blue-900 font-semibold hover:text-yellow-500 transition">
                    {{ auth()->user()->pseudo }}
                </a>
                <form action="{{ route('logout') }}" method="POST" class="block">
                    @csrf
                    <button type="submit" class="w-full text-left py-2 text-red-600 font-bold">Déconnexion</button>
                </form>
            @else
                <button id="openLoginMobile" class="block w-full text-left py-2 text-blue-800 hover:text-yellow-500">Connexion</button>
                <button id="openRegisterMobile" class="w-full btn-premium py-2 rounded-full shadow mt-2">
                    Inscription
                </button>
            @endauth
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 fade-in">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-blue-950 text-gray-200 py-6 mt-10 border-t-4 border-yellow-400">
        <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center text-sm">
            <p>&copy; {{ date('Y') }} Lavanty.mg - Tous droits réservés.</p>
            <p class="mt-2 md:mt-0">Développé par <span class="text-yellow-400 font-semibold">Dev Art Agency</span></p>
        </div>
    </footer>

    <!-- Overlay -->
    <div id="modalOverlay" class="fixed inset-0 bg-black bg-opacity-40 hidden z-40 backdrop-blur-sm"></div>

    <!-- Modal Inscription -->
    <div id="registerModal" class="fixed inset-0 flex items-center justify-center z-50 hidden transform transition-all scale-95 opacity-0">
        <div class="glass rounded-2xl w-96 p-6 relative fade-in">
            <button id="closeRegister" class="absolute top-3 right-3 text-gray-500 hover:text-blue-800">
                <i class="fas fa-times"></i>
            </button>
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

    <!-- Modal Connexion -->
    <div id="loginModal" class="fixed inset-0 flex items-center justify-center z-50 hidden transform transition-all scale-95 opacity-0">
        <div class="glass rounded-2xl w-96 p-6 relative fade-in">
            <button id="closeLogin" class="absolute top-3 right-3 text-gray-500 hover:text-blue-800">
                <i class="fas fa-times"></i>
            </button>
            <h2 class="text-2xl modal-title mb-4 text-center text-yellow-600">Connexion</h2>
            <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-4">
                @csrf
                <input type="email" name="email" placeholder="Email" class="border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
                <input type="password" name="password" placeholder="Mot de passe" class="border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="btn-yellow py-2 rounded-full">Se connecter</button>
            </form>
        </div>
    </div>
    <!-- Popup Résumé des enchères (non bloquant en bas à gauche) -->
<div id="auctionSummaryPopup" 
     class="fixed bottom-5 left-5 z-50 hidden glass border border-yellow-400 rounded-2xl p-5 shadow-2xl w-80 fade-in pointer-events-auto">
    <button id="closeSummaryPopup" 
        class="absolute top-2 right-3 text-gray-500 hover:text-blue-900 font-bold text-lg">
        ✕
    </button>
    <div class="text-center">
        <h3 class="text-xl font-extrabold text-blue-900 mb-2">📊 Vos Enchères</h3>
        <div id="auctionSummaryContent" class="text-center space-y-2">
            <p class="text-yellow-600 font-semibold">Chargement...</p>
        </div>
        <button id="goProfilePopup" 
            class="mt-4 btn-yellow px-5 py-2 rounded-full text-sm font-semibold shadow-md hover:scale-105 transition">
            Voir mon profil
        </button>
    </div>
</div>

<div id="bidNotifications"></div>

    <!-- Script -->
    <script>
        const overlay = document.getElementById('modalOverlay');
        const registerModal = document.getElementById('registerModal');
        const loginModal = document.getElementById('loginModal');

        const openRegisterButtons = [document.getElementById('openRegister'), document.getElementById('openRegisterMobile')];
        const openLoginButtons = [document.getElementById('openLogin'), document.getElementById('openLoginMobile')];

        openRegisterButtons.forEach(btn => btn?.addEventListener('click', () => openModal(registerModal)));
        openLoginButtons.forEach(btn => btn?.addEventListener('click', () => openModal(loginModal)));

        document.getElementById('closeRegister').addEventListener('click', () => closeModal(registerModal));
        document.getElementById('closeLogin').addEventListener('click', () => closeModal(loginModal));
        overlay.addEventListener('click', () => { closeModal(registerModal); closeModal(loginModal); });

        function openModal(modal) {
            overlay.classList.remove('hidden');
            modal.classList.remove('hidden');
            setTimeout(() => modal.classList.remove('scale-95', 'opacity-0'), 50);
        }
        function closeModal(modal) {
            modal.classList.add('scale-95', 'opacity-0');
            setTimeout(() => { modal.classList.add('hidden'); overlay.classList.add('hidden'); }, 200);
        }

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenuBtn.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));

        
    </script>
    <script>
let lastHighestBid = 0;

/* --- Crée et affiche la notification --- */
function showBidToast(data) {
  const container = document.getElementById("bidNotifications");
  const toast = document.createElement("div");
  toast.className = "bid-toast";
  toast.innerHTML = `
      <button title="Fermer">&times;</button>
      <h4>💰 Nouvelle enchère placée !</h4>
      <p><strong>${data.product}</strong></p>
      <p>Montant : <span class="amount">${Number(data.amount).toLocaleString('fr-FR')} Ar</span></p>
  `;
  container.appendChild(toast);

  // Fermeture manuelle
  toast.querySelector("button").addEventListener("click", () => hideToast(toast));

  // Disparaît automatiquement après 5 secondes
  setTimeout(() => hideToast(toast), 5000);
}

/* --- Animation de disparition --- */
function hideToast(toast) {
  toast.classList.add("hide");
  setTimeout(() => toast.remove(), 500);
}

/* --- Vérifie toutes les 5 secondes --- */
async function checkNewBids() {
  try {
    const res = await fetch('/api/latest-bid');
    if (!res.ok) return;
    const data = await res.json();

    // Si une nouvelle enchère plus haute est détectée
    if (data.amount > lastHighestBid) {
      lastHighestBid = data.amount;
      showBidToast(data);
    }
  } catch (err) {
    console.error("Erreur lors du check d'enchère :", err);
  }
}

// 🕐 Démarrage immédiat puis vérification toutes les 5s
checkNewBids();
setInterval(checkNewBids, 5000);


</script>
<script>
const auctionPopup = document.getElementById('auctionSummaryPopup');
const closePopupBtn = document.getElementById('closeSummaryPopup');
const goProfilePopup = document.getElementById('goProfilePopup');
const contentBox = document.getElementById('auctionSummaryContent');
let popupTimeout; // pour gérer la fermeture automatique

function showAuctionSummaryPopup() {
    // Appel API (si connecté)
    fetch('/api/auction-summary')
        .then(res => res.json())
        .then(data => {
            // contenu dynamique
            contentBox.innerHTML = `
                <p class="text-green-700 font-semibold text-sm">
                    🟢 Vous êtes leader sur <span class="text-yellow-500 text-lg">${data.leading}</span> produit(s)
                </p>
                <p class="text-red-700 font-semibold text-sm">
                    🔴 Vous avez perdu sur <span class="text-yellow-500 text-lg">${data.lost}</span> produit(s)
                </p>
            `;
            // Afficher popup
            auctionPopup.classList.remove('hidden');
            
            // ⏳ Le fermer automatiquement après 20 secondes
            popupTimeout = setTimeout(() => {
                auctionPopup.classList.add('hidden');
            }, 20000);
        })
        .catch(() => {
            contentBox.innerHTML = `<p class="text-red-600 font-semibold">Erreur de chargement</p>`;
        });
}

// 🔹 Fermer manuellement
closePopupBtn.addEventListener('click', () => {
    auctionPopup.classList.add('hidden');
    clearTimeout(popupTimeout);
});

// 🔹 Rediriger vers la page profil
goProfilePopup.addEventListener('click', () => {
    window.location.href = "{{ route('profile.index') }}";
});

// 🕐 Afficher automatiquement 3 secondes après le premier chargement
document.addEventListener('DOMContentLoaded', () => {
    @auth
        setTimeout(showAuctionSummaryPopup, 3000);
    @endauth
});
</script>

</body>
</html>
