@extends('layouts.app')
@section('title', 'Produits - Lavanty.mg | Enchères de Luxe à Madagascar')

@section('content')

<style>
    @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&family=Rubik:wght@400;600;700&display=swap");

    body {
        font-family: "Nunito", sans-serif;
        color: #001a3f;
        background: #fff;
        line-height: 1.6;
    }
    h1, h2, h3, h4, h5, h6 {
        font-family: "Rubik", sans-serif;
        font-weight: 700;
    }
</style>

{{-- 🌟 BANNIÈRE PREMIUM (sans radius) --}}
<div class="relative w-full h-64 md:h-96 mb-14 overflow-hidden shadow-xl">

    {{-- Image --}}
    <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30"
         class="absolute inset-0 w-full h-full object-cover brightness-50">

    {{-- Dégradé --}}
    <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-transparent"></div>

    {{-- Texte --}}
    <div class="absolute top-1/2 left-10 transform -translate-y-1/2">
        <h2 class="text-4xl md:text-6xl font-extrabold text-white drop-shadow-lg">
            Enchères de Luxe
        </h2>
        <p class="text-lg md:text-2xl text-gray-200 mt-3 font-light">
            Découvrez des produits rares & exclusifs
        </p>
    </div>
</div>


<section id="produits" class="container mx-auto px-6 py-10">

    <h1 class="text-4xl md:text-5xl font-extrabold text-[#002f6c] text-center mb-6 tracking-wide">
        Tous les Produits en Enchères
    </h1>

    <p class="text-center text-lg md:text-xl text-gray-600 max-w-3xl mx-auto mb-12">
        Trouvez des <strong>articles premium</strong> disponibles en enchères : montres, high-tech, voitures, objets de collection et plus.
    </p>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">

        {{-- ⭐ SIDEBAR GAUCHE --}}
        <div class="lg:col-span-1 space-y-8 sticky top-28">

            {{-- Recherche --}}
            <div class="p-5 rounded-xl shadow-lg bg-white">
                <h3 class="text-xl font-bold mb-3">Recherche</h3>

                <form method="GET" action="{{ url('/products') }}">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Rechercher un produit..."
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400">
                </form>
            </div>

            {{-- 📂 Catégories améliorées --}}
            <div class="p-5 rounded-xl shadow-lg bg-white">
                <h3 class="text-xl font-bold mb-4">Catégories</h3>

                <ul class="space-y-3">

                    @php
                        $cats = [
                            'Mobilier' => '',
                            'Voitures' => '',
                            'Equipements' => '',
                            'High tech' => '',
                        ];
                    @endphp

                    @foreach($cats as $cat => $icon)
                        <li>
                            <a href="{{ url('/products?category='.$cat) }}"
                               class="flex justify-between items-center p-3 rounded-lg border
                                     hover:bg-gray-50 transition
                                     {{ request('category') == $cat ? 'bg-yellow-100 border-yellow-400 font-bold text-[#002f6c]' : 'border-gray-200' }}">

                                <span>{{ $icon }} {{ $cat }}</span>

                                {{-- Compteur --}}
                                <span class="px-3 py-1 text-xs rounded-full
                                    {{ request('category') == $cat 
                                        ? 'bg-[#002f6c] text-yellow-300' 
                                        : 'bg-gray-200 text-gray-700' }}">
                                    {{ $categoriesCount[$cat] ?? 0 }}
                                </span>

                            </a>
                        </li>
                    @endforeach

                    <li class="pt-2">
                        <a href="{{ url('/products') }}" class="text-sm text-gray-600 hover:underline">
                            Réinitialiser les filtres
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        {{-- ⭐ ZONE DES PRODUITS --}}
        <div class="lg:col-span-3">

            {{-- Grille des cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

                @forelse($products as $product)

                    {{-- 🟦 CARD : ne pas modifier, tu veux le garder => OK --}}
                    <a href="{{ route('product.detail', ['id' => $product->id]) }}"
                       class="group block bg-white rounded-3xl shadow-2xl overflow-hidden relative transform transition duration-700 hover:scale-105 hover:-translate-y-2 hover:shadow-3xl">

                        {{-- Image --}}
                        <div class="relative overflow-hidden">
                            @php
                                $image = $product->images ? (is_array($product->images) ? $product->images[0] : json_decode($product->images, true)[0] ?? null) : null;
                            @endphp

                            <img src="{{ $image ? asset('storage/'.$image) : 'https://via.placeholder.com/400x300?text=Pas+d\'image' }}"
                                 class="w-full h-64 md:h-72 object-cover transition duration-700 group-hover:scale-110">

                            {{-- Status --}}
                            @if($product->status == 'en_cours')
                                <span class="absolute top-3 left-3 bg-[#ffd700] text-[#002f6c] text-xs font-bold px-3 py-1 rounded-full shadow-lg">🔥 En cours</span>
                            @elseif($product->status == 'a_venir')
                                <span class="absolute top-3 left-3 bg-gray-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">⏳ À venir</span>
                            @else
                                <span class="absolute top-3 left-3 bg-[#002f6c] text-[#ffd700] text-xs font-bold px-3 py-1 rounded-full shadow-lg">✔ Terminé</span>
                            @endif
                        </div>

                        {{-- Infos --}}
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-[#002f6c]">{{ $product->title }}</h3>

                            <p class="text-gray-700 mt-2">
                                Misez dès
                                <span class="font-semibold text-[#ffd700]">
                                    {{ number_format($product->starting_price, 0, ',', ' ') }} Ar
                                </span>
                            </p>

                            <p class="text-gray-500 text-sm mt-2">
                                {{ Str::limit($product->description, 100) }}
                            </p>

                            <div class="mt-6 text-center">
                                <span class="text-sm text-gray-500 mb-2 block">⏳ Temps restant :</span>

                                <div class="countdown flex justify-center gap-4 bg-gray-100 px-4 py-2 rounded-xl text-center shadow-inner"
                                     data-end="{{ $product->end_time->format('Y-m-d\TH:i:s') }}">
                                    <div class="text-center">
                                        <p class="text-xl font-bold text-[#002f6c] days">00</p>
                                        <span class="text-xs text-gray-600">Jours</span>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-xl font-bold text-[#ffd700] hours">00</p>
                                        <span class="text-xs text-gray-600">Heures</span>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-xl font-bold text-[#002f6c] minutes">00</p>
                                        <span class="text-xs text-gray-600">Minutes</span>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-xl font-bold text-[#ffd700] seconds">00</p>
                                        <span class="text-xs text-gray-600">Secondes</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                @empty
                    <div class="col-span-3 text-center py-16">
                        <p class="text-gray-600 text-lg">
                            😢 Aucun produit disponible pour le moment.<br>
                            <span class="text-[#002f6c] font-semibold">Reviens bientôt !</span>
                        </p>
                    </div>
                @endforelse

            </div>

        </div>

    </div>

</section>

{{-- Countdown JS --}}
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

            const d = Math.floor(diff / (1000 * 60 * 60 * 24));
            const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const s = Math.floor((diff % (1000 * 60)) / 1000);

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
