@extends('layouts.app')

@section('title', 'Détails du Produit - Lavanty.mg')

@section('content')
<section class="container mx-auto px-6 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

        <!-- Image du produit -->
        <div class="rounded-2xl overflow-hidden shadow-lg">
            <img src="https://picsum.photos/600/400?random=20" alt="Produit" class="w-full h-full object-cover">
        </div>

        <!-- Infos du produit -->
        <div class="flex flex-col justify-center">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Ordinateur Portable Gaming</h1>
            <p class="text-lg text-gray-600 mb-6">
                Profitez d’un PC portable dernière génération conçu pour le gaming haute performance, avec processeur ultra rapide et carte graphique dédiée.
            </p>

            <p class="text-2xl font-bold text-indigo-600 mb-4">Prix de départ : 1 200 000 Ar</p>

            <!-- Countdown -->
            <div class="mb-6">
                <span class="block text-sm text-gray-500 mb-2">⏳ Temps restant :</span>
                <div class="countdown flex gap-6 bg-white shadow px-6 py-3 rounded-xl text-center w-fit" data-end="2025-09-20T23:59:59">
                    <div>
                        <p class="text-2xl font-bold text-red-600 days">00</p>
                        <span class="text-xs text-gray-600">Jours</span>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-green-600 hours">00</p>
                        <span class="text-xs text-gray-600">Heures</span>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-red-600 minutes">00</p>
                        <span class="text-xs text-gray-600">Minutes</span>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-green-600 seconds">00</p>
                        <span class="text-xs text-gray-600">Secondes</span>
                    </div>
                </div>
            </div>

            <!-- Bouton enchère -->
            <button class="bg-gradient-to-r from-red-500 via-yellow-400 to-red-600 text-black font-bold px-8 py-4 rounded-xl shadow-lg hover:scale-105 transition w-fit">
                💰 Placer une enchère
            </button>
        </div>
    </div>
</section>

<!-- Section enchères déjà placées -->
<section class="container mx-auto px-6 py-12">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">💸 Enchères déjà placées</h2>
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-6 py-3">Utilisateur</th>
                    <th class="px-6 py-3">Montant</th>
                    <th class="px-6 py-3">Date</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-t">
                    <td class="px-6 py-3">Jean Dupont</td>
                    <td class="px-6 py-3 text-green-600 font-bold">1 250 000 Ar</td>
                    <td class="px-6 py-3">14 Sept 2025 - 10h23</td>
                </tr>
                <tr class="border-t">
                    <td class="px-6 py-3">Aina Rakoto</td>
                    <td class="px-6 py-3 text-green-600 font-bold">1 300 000 Ar</td>
                    <td class="px-6 py-3">14 Sept 2025 - 11h05</td>
                </tr>
                <tr class="border-t">
                    <td class="px-6 py-3">Sitraka Andry</td>
                    <td class="px-6 py-3 text-green-600 font-bold">1 350 000 Ar</td>
                    <td class="px-6 py-3">14 Sept 2025 - 12h10</td>
                </tr>
            </tbody>
        </table>
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
