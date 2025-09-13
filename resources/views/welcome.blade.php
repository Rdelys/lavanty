@extends('layouts.app')

@section('title', 'Accueil - Lavanty.mg')

@section('content')
<!-- Section Héro -->
<section class="relative bg-cover bg-center h-[90vh]" style="background-image: url('https://images.unsplash.com/photo-1607082349566-187342f87b2d?auto=format&fit=crop&w=1600&q=80');">
    <div class="absolute inset-0 bg-black bg-opacity-60"></div>
    <div class="relative z-10 flex flex-col items-center justify-center text-center text-white h-full px-6">
        <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-6">
            Transformez vos envies en <span class="text-yellow-400">victoires</span>
        </h1>
        <p class="text-xl md:text-2xl mb-8 max-w-3xl">
            Participez à des enchères exclusives et remportez vos produits préférés à prix incroyable. 
            <span class="font-semibold text-yellow-400">Chaque seconde compte.</span>
        </p>
        <a href="#produits" class="bg-gradient-to-r from-yellow-400 to-red-500 text-black font-bold px-8 py-4 rounded-2xl shadow-xl hover:scale-110 transition transform duration-300">
            🔥 Découvrir les enchères
        </a>
    </div>
</section>

<!-- Produits en vedette -->
<section id="produits" class="container mx-auto px-6 py-16">
    <h2 class="text-4xl font-extrabold text-gray-900 text-center mb-12">🔥 Produits en Vedette</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

        <!-- Produit 1 -->
        <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-lg hover:shadow-2xl transition-transform hover:-translate-y-2 overflow-hidden relative">
            <div class="relative">
                <img src="https://picsum.photos/400/300?random=1" class="w-full h-64 object-cover">
                <span class="absolute top-3 left-3 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow">🔥 Enchère en cours</span>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800">Ordinateur Portable Gaming</h3>
                <p class="text-gray-600 mt-2">À partir de <span class="font-semibold text-indigo-600">1 200 000 Ar</span></p>
                <div class="mt-4 flex flex-col items-center">
                    <span class="text-sm text-gray-500 mb-2">⏳ Temps restant :</span>
                    <div class="countdown flex gap-4 bg-white shadow px-4 py-2 rounded-xl text-center" data-end="2025-09-15T23:59:59">
                        <div>
                            <p class="text-xl font-bold text-red-600 days">00</p>
                            <span class="text-xs text-gray-600">Jours</span>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-green-600 hours">00</p>
                            <span class="text-xs text-gray-600">Heures</span>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-red-600 minutes">00</p>
                            <span class="text-xs text-gray-600">Minutes</span>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-green-600 seconds">00</p>
                            <span class="text-xs text-gray-600">Secondes</span>
                        </div>
                    </div>
                </div>
                <a href="{{ route('product.detail') }}" 
   class="mt-6 w-full bg-gradient-to-r from-red-500 via-yellow-400 to-red-600 text-black font-bold py-3 rounded-xl shadow-lg hover:scale-105 transition block text-center">
    💰 Placer une enchère
</a>

            </div>
        </div>

        <!-- Produit 2 -->
        <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-lg hover:shadow-2xl transition-transform hover:-translate-y-2 overflow-hidden relative">
            <div class="relative">
                <img src="https://picsum.photos/400/300?random=2" class="w-full h-64 object-cover">
                <span class="absolute top-3 left-3 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow">⭐ Populaire</span>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800">iPhone 14 Pro Max</h3>
                <p class="text-gray-600 mt-2">À partir de <span class="font-semibold text-indigo-600">800 000 Ar</span></p>
                <div class="mt-4 flex flex-col items-center">
                    <span class="text-sm text-gray-500 mb-2">⏳ Temps restant :</span>
                    <div class="countdown flex gap-4 bg-white shadow px-4 py-2 rounded-xl text-center" data-end="2025-09-15T18:00:00">
                        <div>
                            <p class="text-xl font-bold text-red-600 days">00</p>
                            <span class="text-xs text-gray-600">Jours</span>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-green-600 hours">00</p>
                            <span class="text-xs text-gray-600">Heures</span>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-red-600 minutes">00</p>
                            <span class="text-xs text-gray-600">Minutes</span>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-green-600 seconds">00</p>
                            <span class="text-xs text-gray-600">Secondes</span>
                        </div>
                    </div>
                </div>
                <a href="{{ route('product.detail') }}" 
   class="mt-6 w-full bg-gradient-to-r from-red-500 via-yellow-400 to-red-600 text-black font-bold py-3 rounded-xl shadow-lg hover:scale-105 transition block text-center">
    💰 Placer une enchère
</a>

            </div>
        </div>

        <!-- Produit 3 -->
        <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-lg hover:shadow-2xl transition-transform hover:-translate-y-2 overflow-hidden relative">
            <div class="relative">
                <img src="https://picsum.photos/400/300?random=3" class="w-full h-64 object-cover">
                <span class="absolute top-3 left-3 bg-blue-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow">⚡ Nouveauté</span>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800">Téléviseur 4K 55"</h3>
                <p class="text-gray-600 mt-2">À partir de <span class="font-semibold text-indigo-600">1 500 000 Ar</span></p>
                <div class="mt-4 flex flex-col items-center">
                    <span class="text-sm text-gray-500 mb-2">⏳ Temps restant :</span>
                    <div class="countdown flex gap-4 bg-white shadow px-4 py-2 rounded-xl text-center" data-end="2025-09-16T12:00:00">
                        <div>
                            <p class="text-xl font-bold text-red-600 days">00</p>
                            <span class="text-xs text-gray-600">Jours</span>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-green-600 hours">00</p>
                            <span class="text-xs text-gray-600">Heures</span>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-red-600 minutes">00</p>
                            <span class="text-xs text-gray-600">Minutes</span>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-green-600 seconds">00</p>
                            <span class="text-xs text-gray-600">Secondes</span>
                        </div>
                    </div>
                </div>
                <a href="{{ route('product.detail') }}" 
   class="mt-6 w-full bg-gradient-to-r from-red-500 via-yellow-400 to-red-600 text-black font-bold py-3 rounded-xl shadow-lg hover:scale-105 transition block text-center">
    💰 Placer une enchère
</a>

            </div>
        </div>

    </div>
</section>

<!-- Call to action -->
<section class="bg-indigo-50 py-20 text-center">
    <h2 class="text-3xl font-extrabold text-gray-900 mb-6">
        🚀 Êtes-vous prêt à décrocher vos rêves ?
    </h2>
    <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
        Rejoignez une communauté de passionnés et transformez chaque clic en opportunité. 
        <span class="text-indigo-600 font-semibold">Votre prochaine victoire commence ici.</span>
    </p>
    <a href="#inscription" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-4 rounded-2xl shadow-lg hover:scale-110 transition">
        Créez un compte gratuit
    </a>
</section>

<script>
document.querySelectorAll('.countdown').forEach(card => {
    const endTime = new Date(card.dataset.end).getTime();
    const daysEl = card.querySelector(".days");
    const hoursEl = card.querySelector(".hours");
    const minutesEl = card.querySelector(".minutes");
    const secondsEl = card.querySelector(".seconds");

    function updateCountdown() {
        const now = new Date().getTime();
        const diff = endTime - now;
        if (diff <= 0) {
            daysEl.textContent = "0";
            hoursEl.textContent = "0";
            minutesEl.textContent = "0";
            secondsEl.textContent = "0";
            return;
        }
        const d = Math.floor(diff / (1000*60*60*24));
        const h = Math.floor((diff % (1000*60*60*24)) / (1000*60*60));
        const m = Math.floor((diff % (1000*60*60)) / (1000*60));
        const s = Math.floor((diff % (1000*60)) / 1000);
        daysEl.textContent = d;
        hoursEl.textContent = h;
        minutesEl.textContent = m;
        secondsEl.textContent = s;
        requestAnimationFrame(updateCountdown);
    }
    updateCountdown();
});
</script>
@endsection
