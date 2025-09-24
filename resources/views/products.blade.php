@extends('layouts.app')

@section('title', 'Produits - Lavanty.mg | Enchères en ligne à Madagascar')

@section('content')
<section id="produits" class="container mx-auto px-6 py-16">
    <h1 class="text-4xl font-extrabold text-gray-900 text-center mb-6">
        🛒 Tous les Produits en Enchères
    </h1>
    <p class="text-center text-lg text-gray-600 max-w-2xl mx-auto mb-16">
        Découvrez notre sélection de <strong>produits high-tech et tendance</strong> en enchères exclusives sur 
        <span class="text-blue-700 font-semibold">Lavanty.mg</span>.  
        Smartphones, consoles, ordinateurs portables et plus encore vous attendent à des prix exceptionnels.
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
    @forelse($products as $product)
        <a href="{{ route('product.detail', ['id' => $product->id]) }}" 
           class="group block bg-white rounded-2xl shadow-md overflow-hidden relative 
                  transform transition duration-700 ease-out hover:scale-105 hover:-translate-y-2 hover:shadow-2xl">

            <div class="relative overflow-hidden">
                @php
                    $image = $product->images 
                        ? (is_array($product->images) ? $product->images[0] : json_decode($product->images, true)[0] ?? null) 
                        : null;
                @endphp
                @if($image)
                    <img src="{{ asset('storage/'.$image) }}" 
                         alt="{{ $product->title }}" 
                         class="w-full h-64 object-cover transition duration-700 group-hover:scale-110">
                @else
                    <img src="https://via.placeholder.com/400x300?text=Pas+d'image" 
                         alt="placeholder" 
                         class="w-full h-64 object-cover">
                @endif

                @if($product->status == 'en_cours')
                    <span class="absolute top-3 left-3 bg-yellow-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow">
                        🔥 Enchère en cours
                    </span>
                @elseif($product->status == 'a_venir')
                    <span class="absolute top-3 left-3 bg-gray-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow">
                        ⏳ À venir
                    </span>
                @else
                    <span class="absolute top-3 left-3 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow">
                        ✅ Terminé
                    </span>
                @endif
            </div>

            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800">{{ $product->title }}</h3>
                <p class="text-gray-600 mt-2">
                    Misez dès <span class="font-semibold text-blue-700">
                        {{ number_format($product->starting_price, 0, ',', ' ') }} Ar
                    </span>
                </p>
                <p class="text-sm text-gray-500 mt-2">
                    {{ Str::limit($product->description, 100) }}
                </p>

                <div class="mt-4 flex flex-col items-center">
                    <span class="text-sm text-gray-500 mb-2">⏳ Temps restant :</span>
                    <div class="countdown flex gap-4 bg-gray-100 px-4 py-2 rounded-xl text-center" 
                         data-end="{{ $product->end_time->format('Y-m-d\TH:i:s') }}">
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
    @empty
        <div class="col-span-3 text-center py-16">
            <p class="text-gray-600 text-lg">
                😢 Aucun produit disponible pour le moment.  
                <br>
                <span class="text-blue-700 font-semibold">Reviens bientôt pour découvrir de nouvelles enchères !</span>
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
