@extends('layouts.app')

@section('title', 'Produits - Lavanty.mg | Enchères de Luxe à Madagascar')

@section('content')
<section id="produits" class="container mx-auto px-6 py-16">
    <h1 class="text-4xl md:text-5xl font-extrabold text-[#002f6c] text-center mb-6 tracking-wide">
        🛒 Tous les Produits en Enchères
    </h1>
    <p class="text-center text-lg md:text-xl text-gray-600 max-w-3xl mx-auto mb-16">
        Découvrez notre sélection de <strong>produits exclusifs et haut de gamme</strong> en enchères sur 
        <span class="text-[#002f6c] font-semibold">Lavanty.mg</span>.  
        Smartphones, montres, œuvres d’art et plus encore vous attendent à des prix exceptionnels.
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
    @forelse($products as $product)
        <a href="{{ route('product.detail', ['id' => $product->id]) }}" 
           class="group block bg-white rounded-3xl shadow-2xl overflow-hidden relative transform transition duration-700 hover:scale-105 hover:-translate-y-2 hover:shadow-3xl">

            <div class="relative overflow-hidden">
                @php
                    $image = $product->images 
                        ? (is_array($product->images) ? $product->images[0] : json_decode($product->images, true)[0] ?? null) 
                        : null;
                @endphp
                <img src="{{ $image ? asset('storage/'.$image) : 'https://via.placeholder.com/400x300?text=Pas+d\'image' }}" 
                     alt="{{ $product->title }}" 
                     class="w-full h-64 md:h-72 object-cover transition duration-700 group-hover:scale-110">

                @if($product->status == 'en_cours')
                    <span class="absolute top-3 left-3 bg-[#ffd700] text-[#002f6c] text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                        🔥 Enchère en cours
                    </span>
                @elseif($product->status == 'a_venir')
                    <span class="absolute top-3 left-3 bg-gray-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                        ⏳ À venir
                    </span>
                @else
                    <span class="absolute top-3 left-3 bg-[#002f6c] text-[#ffd700] text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                        ✅ Terminé
                    </span>
                @endif
            </div>

            <div class="p-6">
                <h3 class="text-2xl font-bold text-[#002f6c]">{{ $product->title }}</h3>
                <p class="text-gray-700 mt-2">
                    Misez dès <span class="font-semibold text-[#ffd700]">
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
                😢 Aucun produit disponible pour le moment.  
                <br>
                <span class="text-[#002f6c] font-semibold">Reviens bientôt pour découvrir de nouvelles enchères exclusives !</span>
            </p>
        </div>
    @endforelse
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
            card.style.color = "black"; // neutre à la fin
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

        // ✅ Si moins de 24h restantes → rouge
        if (diff < 24 * 60 * 60 * 1000) {
            card.querySelectorAll("p").forEach(el => el.style.color = "red");
        } 
        // ✅ Sinon → noir
        else {
            card.querySelectorAll("p").forEach(el => el.style.color = "black");
        }

        requestAnimationFrame(updateCountdown);
    }

    updateCountdown();
});
</script>
@endsection
