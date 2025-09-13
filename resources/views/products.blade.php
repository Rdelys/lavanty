@extends('layouts.app')

@section('title', 'Produits - Lavanty.mg')

@section('content')
<section id="produits" class="container mx-auto px-6 py-16">
    <h2 class="text-4xl font-extrabold text-gray-900 text-center mb-12">🛒 Tous les Produits</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

        <!-- Produit 1 -->
        <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-lg hover:shadow-2xl transition-transform hover:-translate-y-2 overflow-hidden relative">
            <div class="relative">
                <img src="https://picsum.photos/400/300?random=4" class="w-full h-64 object-cover">
                <span class="absolute top-3 left-3 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow">🔥 Enchère en cours</span>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800">PlayStation 5</h3>
                <p class="text-gray-600 mt-2">À partir de <span class="font-semibold text-indigo-600">1 800 000 Ar</span></p>
                <div class="mt-4 flex flex-col items-center">
                    <span class="text-sm text-gray-500 mb-2">⏳ Temps restant :</span>
                    <div class="countdown flex gap-4 bg-white shadow px-4 py-2 rounded-xl text-center" data-end="2025-09-20T23:59:59">
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
                <button class="mt-6 w-full bg-gradient-to-r from-red-500 via-yellow-400 to-red-600 text-black font-bold py-3 rounded-xl shadow-lg hover:scale-105 transition">
                    💰 Placer une enchère
                </button>
            </div>
        </div>

        <!-- Produit 2 -->
        <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-lg hover:shadow-2xl transition-transform hover:-translate-y-2 overflow-hidden relative">
            <div class="relative">
                <img src="https://picsum.photos/400/300?random=5" class="w-full h-64 object-cover">
                <span class="absolute top-3 left-3 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow">⭐ Populaire</span>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800">MacBook Pro M2</h3>
                <p class="text-gray-600 mt-2">À partir de <span class="font-semibold text-indigo-600">5 000 000 Ar</span></p>
                <div class="mt-4 flex flex-col items-center">
                    <span class="text-sm text-gray-500 mb-2">⏳ Temps restant :</span>
                    <div class="countdown flex gap-4 bg-white shadow px-4 py-2 rounded-xl text-center" data-end="2025-09-21T12:00:00">
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
                <button class="mt-6 w-full bg-gradient-to-r from-red-500 via-yellow-400 to-red-600 text-black font-bold py-3 rounded-xl shadow-lg hover:scale-105 transition">
                    💰 Placer une enchère
                </button>
            </div>
        </div>

        <!-- Produit 3 -->
        <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-lg hover:shadow-2xl transition-transform hover:-translate-y-2 overflow-hidden relative">
            <div class="relative">
                <img src="https://picsum.photos/400/300?random=6" class="w-full h-64 object-cover">
                <span class="absolute top-3 left-3 bg-blue-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow">⚡ Nouveauté</span>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800">Samsung Galaxy S23</h3>
                <p class="text-gray-600 mt-2">À partir de <span class="font-semibold text-indigo-600">3 200 000 Ar</span></p>
                <div class="mt-4 flex flex-col items-center">
                    <span class="text-sm text-gray-500 mb-2">⏳ Temps restant :</span>
                    <div class="countdown flex gap-4 bg-white shadow px-4 py-2 rounded-xl text-center" data-end="2025-09-22T15:00:00">
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
                <button class="mt-6 w-full bg-gradient-to-r from-red-500 via-yellow-400 to-red-600 text-black font-bold py-3 rounded-xl shadow-lg hover:scale-105 transition">
                    💰 Placer une enchère
                </button>
            </div>
        </div>

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
