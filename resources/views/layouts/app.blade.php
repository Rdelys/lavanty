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

        /* Boutons */
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
        }

        .btn-yellow {
            background: linear-gradient(135deg, #ffd700, #ffcc00);
            color: #003c9e;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-yellow:hover {
            transform: scale(1.07);
            background: linear-gradient(135deg, #ffde59, #ffcb00);
        }

        /* Notifications enchères */
        @keyframes fadeInRight { from {opacity:0;transform:translateX(60px);} to {opacity:1;transform:translateX(0);} }
        @keyframes fadeOutRight { from {opacity:1;transform:translateX(0);} to {opacity:0;transform:translateX(60px);} }
        #bidNotifications {
            position: fixed; bottom: 20px; right: 20px; display: flex; flex-direction: column; gap: 12px;
            z-index: 9999; pointer-events: none;
        }
        .bid-toast {
            background: #ffffff; border-left: 6px solid #ffd700; box-shadow: 0 5px 25px rgba(0,47,108,0.2);
            border-radius: 14px; padding: 1rem 1.2rem; min-width: 260px; max-width: 340px;
            animation: fadeInRight 0.4s ease forwards; position: relative; pointer-events: auto;
        }
        .bid-toast.hide { animation: fadeOutRight 0.5s ease forwards; }
        .bid-toast h4 { color:#002f6c; font-weight:700; font-size:1rem; margin-bottom:0.25rem; }
        .bid-toast .amount { color:#ffd700; font-weight:700; }
        .bid-toast button {
            background:none; border:none; color:#888; font-size:1.2rem; position:absolute; top:6px; right:10px; cursor:pointer;
        }
        .bid-toast button:hover { color:#002f6c; }
    </style>
</head>

<body class="bg-white flex flex-col min-h-screen font-[Inter] text-gray-800">

    <!-- 🔹 Barre supérieure -->
    <div class="w-full bg-blue-950 text-gray-100 text-sm py-2 px-6 flex flex-wrap justify-between items-center">
        <div class="flex items-center gap-4">
            <span><i class="fa-regular fa-envelope text-yellow-400 mr-1"></i> info@lavanty.mg</span>
            <span class="hidden sm:inline-block border-l border-gray-400 h-4"></span>
            <span class="flex items-center gap-1"><i class="fa-solid fa-headset text-yellow-400"></i> Support client</span>
        </div>
        <div class="flex items-center gap-3 mt-1 sm:mt-0">
            <a href="#" class="border border-gray-400 text-xs px-3 py-1 rounded-full hover:bg-yellow-400 hover:text-blue-900 transition">COMMENT ENCHÉRIR</a>
            <a href="#" class="border border-gray-400 text-xs px-3 py-1 rounded-full hover:bg-yellow-400 hover:text-blue-900 transition">VENDRE UN ARTICLE</a>
            <a href="#" class="flex items-center gap-1 hover:text-yellow-400"><i class="fa-solid fa-language"></i> Langue</a>
        </div>
    </div>

    <!-- 🔹 Header principal -->
    <header class="bg-white shadow-md border-b border-gray-200 sticky top-0 z-50 fade-in">
        <div class="container mx-auto flex items-center justify-between px-6 py-4">

            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-2 text-2xl font-bold text-blue-900">
                <i class="fas fa-gavel text-yellow-400"></i>
                <span><span class="text-blue-900">Lavanty</span><span class="text-yellow-500">.mg</span></span>
            </a>

            <!-- Menu principal -->
            <nav class="hidden lg:flex items-center gap-6 font-medium">
                <a href="{{ url('/') }}" class="text-blue-900 hover:text-yellow-500">Accueil</a>
                <a href="{{ url('/products') }}" class="text-blue-900 hover:text-yellow-500">Produits</a>
                <a href="{{ url('/blog') }}" class="text-blue-900 hover:text-yellow-500">Blog</a>
                <a href="{{ url('/about') }}" class="text-blue-900 hover:text-yellow-500">À propos</a>
                <a href="{{ url('/contact') }}" class="text-blue-900 hover:text-yellow-500">Contact</a>
            </nav>

            <!-- Recherche + compte -->
            <div class="hidden lg:flex items-center gap-3">
                <div class="flex items-center border rounded-full overflow-hidden shadow-sm">
                    <input type="text" placeholder="Recherchez un produit..." class="px-4 py-2 outline-none w-64 text-sm">
                    <button class="bg-yellow-400 px-4 py-2"><i class="fa-solid fa-magnifying-glass text-blue-900"></i></button>
                </div>

                @auth
                    <a href="{{ route('profile.index') }}" class="bg-blue-900 text-yellow-400 px-4 py-2 rounded-full font-semibold">
                        <i class="fa-regular fa-user mr-1"></i> {{ auth()->user()->pseudo }}
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
            <a href="{{ url('/products') }}" class="block py-2 text-blue-900 hover:text-yellow-500">Produits</a>
            <a href="{{ url('/blog') }}" class="block py-2 text-blue-900 hover:text-yellow-500">Blog</a>
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
    <footer class="bg-blue-950 text-gray-200 py-6 mt-10 border-t-4 border-yellow-400">
        <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center text-sm">
            <p>&copy; {{ date('Y') }} Lavanty.mg - Tous droits réservés.</p>
            <p class="mt-2 md:mt-0">Développé par <span class="text-yellow-400 font-semibold">Dev Art Agency</span></p>
        </div>
    </footer>

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
        function showBidToast(data){
            const c=document.getElementById("bidNotifications");
            const t=document.createElement("div");
            t.className="bid-toast";
            t.innerHTML=`<button>&times;</button><h4>💰 Nouvelle enchère placée !</h4><p><strong>${data.product}</strong></p><p>Montant : <span class="amount">${Number(data.amount).toLocaleString('fr-FR')} Ar</span></p>`;
            c.appendChild(t);
            t.querySelector("button").addEventListener("click",()=>hideToast(t));
            setTimeout(()=>hideToast(t),5000);
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
</body>
</html>
