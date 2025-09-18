@extends('layouts.app')

@section('title', 'Accueil - Lavanty.mg | Enchères en ligne à Madagascar')

@section('content')
<!-- Section Héro -->
<section id="top" class="relative bg-cover bg-center h-[90vh]" 
    style="background-image: url('https://images.unsplash.com/photo-1607082349566-187342f87b2d?auto=format&fit=crop&w=1600&q=80');">
    <div class="absolute inset-0 bg-blue-900 bg-opacity-70"></div>
    <div class="relative z-10 flex flex-col items-center justify-center text-center text-white h-full px-6">
        <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-6">
            Enchères en ligne à <span class="text-yellow-600">Madagascar</span>
        </h1>
        <p class="text-xl md:text-2xl mb-8 max-w-3xl">
            Découvrez <strong>les meilleures enchères en ligne</strong> et remportez vos produits préférés à des prix imbattables.  
            <span class="font-semibold text-yellow-600">Chaque clic peut être votre victoire.</span>
        </p>
        <a href="#produits" 
           class="bg-blue-700 hover:bg-blue-800 text-white font-bold px-8 py-4 rounded-2xl shadow-xl hover:scale-110 transition transform duration-300">
            🔥 Découvrir les enchères
        </a>
    </div>
</section>

<!-- Produits en vedette -->
<section id="produits" class="container mx-auto px-6 py-20">
    <h2 class="text-4xl font-extrabold text-gray-900 text-center mb-12">🔥 Produits en Vedette</h2>
    <p class="text-center text-lg text-gray-600 max-w-2xl mx-auto mb-16">
        Explorez nos <strong>enchères exclusives</strong> sur des articles tendance : smartphones, ordinateurs portables, téléviseurs et bien plus encore.  
        Tous nos produits sont certifiés et garantis pour vous offrir la <span class="text-blue-700 font-semibold">meilleure expérience d’enchères en ligne à Madagascar</span>.
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

        <!-- Exemple de Card Produit -->
        <a href="{{ route('product.detail') }}" 
           class="group block bg-white rounded-2xl shadow-md overflow-hidden relative 
                  transform transition duration-700 ease-out hover:scale-105 hover:-translate-y-2 hover:shadow-2xl">
            <div class="relative overflow-hidden">
                <img src="https://picsum.photos/400/300?random=1" 
                     alt="Ordinateur portable gaming en enchère" 
                     class="w-full h-64 object-cover transition duration-700 group-hover:scale-110">
                <span class="absolute top-3 left-3 bg-yellow-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow">
                    🔥 Enchère en cours
                </span>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800">Ordinateur Portable Gaming</h3>
                <p class="text-gray-600 mt-2">Misez dès <span class="font-semibold text-blue-700">1 200 000 Ar</span></p>
                <p class="text-sm text-gray-500 mt-2">Un PC puissant pour les gamers à Madagascar, parfait pour vos sessions de jeu et le travail multitâche.</p>
                <div class="mt-4 flex flex-col items-center">
                    <span class="text-sm text-gray-500 mb-2">⏳ Temps restant :</span>
                    <div class="countdown flex gap-4 bg-gray-100 px-4 py-2 rounded-xl text-center" data-end="2025-09-15T23:59:59">
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

        <!-- Répète le même modèle pour les autres produits -->
    </div>
</section>

<!-- Call to action -->
<section class="bg-gray-100 py-20 text-center">
    <h2 class="text-3xl font-extrabold text-gray-900 mb-6">
        🚀 Rejoignez la meilleure plateforme d’enchères en ligne à Madagascar
    </h2>
    <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
        Sur <strong>Lavanty.mg</strong>, nous vous donnons une expérience unique.  
        Misez sur vos produits préférés et profitez de <span class="text-blue-700 font-semibold">prix imbattables</span>, d’une <span class="text-yellow-600 font-semibold">sécurité maximale</span> et d’une communauté en pleine croissance.
    </p>
    <a href="#top" class="bg-yellow-600 hover:bg-yellow-700 text-white px-8 py-4 rounded-2xl shadow-lg hover:scale-110 transition">
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
