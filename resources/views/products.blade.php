@extends('layouts.app')

@section('title', 'Produits - Lavanty.mg | Enchères en ligne à Madagascar')

@section('content')
<section id="produits" class="container mx-auto px-6 py-16">
    <h1 class="text-4xl font-extrabold text-gray-900 text-center mb-6">
        🛒 Tous les Produits en Enchères
    </h1>
    <p class="text-center text-lg text-gray-600 max-w-2xl mx-auto mb-16">
        Découvrez notre sélection de <strong>produits high-tech et tendance</strong> en enchères exclusives sur 
        <span class="text-blue-700 font-semibold">Lavanty.mg</span>, la première plateforme d’enchères en ligne à Madagascar.  
        Smartphones, consoles, ordinateurs portables et plus encore vous attendent à des prix exceptionnels.
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

        <!-- Produit 1 -->
        <a href="{{ route('product.detail') }}" 
           class="group block bg-white rounded-2xl shadow-md overflow-hidden relative 
                  transform transition duration-700 ease-out hover:scale-105 hover:-translate-y-2 hover:shadow-2xl">
            <div class="relative overflow-hidden">
                <img src="https://picsum.photos/400/300?random=4" 
                     alt="PlayStation 5 en enchère à Madagascar" 
                     class="w-full h-64 object-cover transition duration-700 group-hover:scale-110">
                <span class="absolute top-3 left-3 bg-yellow-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow">
                    🔥 Enchère en cours
                </span>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800">PlayStation 5</h3>
                <p class="text-gray-600 mt-2">Misez dès <span class="font-semibold text-blue-700">1 800 000 Ar</span></p>
                <p class="text-sm text-gray-500 mt-2">
                    Console nouvelle génération avec graphismes 4K, idéale pour les gamers passionnés à Madagascar.
                </p>
                <div class="mt-4 flex flex-col items-center">
                    <span class="text-sm text-gray-500 mb-2">⏳ Temps restant :</span>
                    <div class="countdown flex gap-4 bg-gray-100 px-4 py-2 rounded-xl text-center" data-end="2025-09-20T23:59:59">
                        <div>
                            <p class="text-xl font-bold text-yellow-600 days">00</p>
                            <span class="text-xs text-gray-600">Jours</span>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-blue-700 hours">00</p>
                            <span class="text-xs text-gray-600">Heures</span>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-yellow-600 minutes">00</p>
                            <span class="text-xs text-gray-600">Minutes</span>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-blue-700 seconds">00</p>
                            <span class="text-xs text-gray-600">Secondes</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Produit 2 -->
        <a href="{{ route('product.detail') }}" 
           class="group block bg-white rounded-2xl shadow-md overflow-hidden relative 
                  transform transition duration-700 ease-out hover:scale-105 hover:-translate-y-2 hover:shadow-2xl">
            <div class="relative overflow-hidden">
                <img src="https://picsum.photos/400/300?random=5" 
                     alt="MacBook Pro M2 en enchère à Madagascar" 
                     class="w-full h-64 object-cover transition duration-700 group-hover:scale-110">
                <span class="absolute top-3 left-3 bg-blue-700 text-white text-xs font-bold px-3 py-1 rounded-full shadow">
                    ⭐ Populaire
                </span>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800">MacBook Pro M2</h3>
                <p class="text-gray-600 mt-2">Misez dès <span class="font-semibold text-blue-700">5 000 000 Ar</span></p>
                <p class="text-sm text-gray-500 mt-2">
                    Le MacBook Pro M2 offre puissance et élégance, parfait pour les professionnels et étudiants.
                </p>
                <div class="mt-4 flex flex-col items-center">
                    <span class="text-sm text-gray-500 mb-2">⏳ Temps restant :</span>
                    <div class="countdown flex gap-4 bg-gray-100 px-4 py-2 rounded-xl text-center" data-end="2025-09-21T12:00:00">
                        <div>
                            <p class="text-xl font-bold text-yellow-600 days">00</p>
                            <span class="text-xs text-gray-600">Jours</span>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-blue-700 hours">00</p>
                            <span class="text-xs text-gray-600">Heures</span>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-yellow-600 minutes">00</p>
                            <span class="text-xs text-gray-600">Minutes</span>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-blue-700 seconds">00</p>
                            <span class="text-xs text-gray-600">Secondes</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Produit 3 -->
        <a href="{{ route('product.detail') }}" 
           class="group block bg-white rounded-2xl shadow-md overflow-hidden relative 
                  transform transition duration-700 ease-out hover:scale-105 hover:-translate-y-2 hover:shadow-2xl">
            <div class="relative overflow-hidden">
                <img src="https://picsum.photos/400/300?random=6" 
                     alt="Samsung Galaxy S23 en enchère à Madagascar" 
                     class="w-full h-64 object-cover transition duration-700 group-hover:scale-110">
                <span class="absolute top-3 left-3 bg-yellow-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow">
                    ⚡ Nouveauté
                </span>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800">Samsung Galaxy S23</h3>
                <p class="text-gray-600 mt-2">Misez dès <span class="font-semibold text-blue-700">3 200 000 Ar</span></p>
                <p class="text-sm text-gray-500 mt-2">
                    Un smartphone haut de gamme avec appareil photo avancé, parfait pour les passionnés de technologie.
                </p>
                <div class="mt-4 flex flex-col items-center">
                    <span class="text-sm text-gray-500 mb-2">⏳ Temps restant :</span>
                    <div class="countdown flex gap-4 bg-gray-100 px-4 py-2 rounded-xl text-center" data-end="2025-09-22T15:00:00">
                        <div>
                            <p class="text-xl font-bold text-yellow-600 days">00</p>
                            <span class="text-xs text-gray-600">Jours</span>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-blue-700 hours">00</p>
                            <span class="text-xs text-gray-600">Heures</span>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-yellow-600 minutes">00</p>
                            <span class="text-xs text-gray-600">Minutes</span>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-blue-700 seconds">00</p>
                            <span class="text-xs text-gray-600">Secondes</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>

    </div>
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
