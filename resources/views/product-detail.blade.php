@extends('layouts.app')

@section('title', $product->title . ' - Détails du Produit | Lavanty.mg')

@section('content')
<section class="container mx-auto px-6 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

        <!-- Galerie d'images -->
        <div>
            <div class="rounded-2xl overflow-hidden shadow-lg mb-4">
                <div id="zoomContainer" class="overflow-hidden cursor-grab">
                    <img id="mainImage"
                         src="{{ asset('storage/' . ($images[0] ?? 'placeholder.png')) }}"
                         alt="{{ $product->title }}"
                         class="w-full h-[400px] object-cover transition duration-300">
                </div>
            </div>

            <!-- Miniatures -->
            <div class="flex gap-3">
                @foreach($images as $img)
                    <img src="{{ asset('storage/'.$img) }}"
                         class="w-20 h-20 object-cover rounded cursor-pointer border hover:scale-110 transition"
                         onclick="document.getElementById('mainImage').src=this.src">
                @endforeach
            </div>
        </div>

        <!-- Infos produit -->
        <div class="flex flex-col justify-center">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4">{{ $product->title }}</h1>
            <p class="text-lg text-gray-600 mb-6">{{ $product->description }}</p>
            <p class="text-2xl font-bold text-blue-700 mb-4">
                Prix de départ : {{ number_format($product->starting_price, 0, ',', ' ') }} Ar
            </p>

            <!-- Countdown -->
            <div class="mb-6">
                <span class="block text-sm text-gray-500 mb-2">⏳ Temps restant :</span>
                <div class="countdown flex gap-6 bg-gray-100 px-6 py-3 rounded-xl text-center w-fit shadow-md" 
                     data-end="{{ $product->end_time->format('Y-m-d\TH:i:s') }}">
                    <div><p class="text-2xl font-bold text-yellow-600 days">00</p><span class="text-xs text-gray-600">Jours</span></div>
                    <div><p class="text-2xl font-bold text-blue-700 hours">00</p><span class="text-xs text-gray-600">Heures</span></div>
                    <div><p class="text-2xl font-bold text-yellow-600 minutes">00</p><span class="text-xs text-gray-600">Minutes</span></div>
                    <div><p class="text-2xl font-bold text-blue-700 seconds">00</p><span class="text-xs text-gray-600">Secondes</span></div>
                </div>
            </div>

            <button class="bg-yellow-600 hover:bg-yellow-500 text-white font-bold px-8 py-4 rounded-xl 
                           shadow-lg hover:shadow-xl hover:scale-105 transition w-fit">
                💰 Placer une enchère
            </button>
        </div>
    </div>

    <!-- Tableau d'enchères statique -->
    <div class="mt-16">
        <h2 class="text-2xl font-bold mb-4">Historique des enchères</h2>
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">#</th>
                    <th class="border px-4 py-2">Nom du participant</th>
                    <th class="border px-4 py-2">Montant (Ar)</th>
                    <th class="border px-4 py-2">Date / Heure</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border px-4 py-2">1</td>
                    <td class="border px-4 py-2">Hervé</td>
                    <td class="border px-4 py-2">500 000</td>
                    <td class="border px-4 py-2">21/09/2025 15:30</td>
                </tr>
                <tr class="bg-gray-50">
                    <td class="border px-4 py-2">2</td>
                    <td class="border px-4 py-2">Aina</td>
                    <td class="border px-4 py-2">550 000</td>
                    <td class="border px-4 py-2">21/09/2025 16:10</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2">3</td>
                    <td class="border px-4 py-2">Rado</td>
                    <td class="border px-4 py-2">600 000</td>
                    <td class="border px-4 py-2">21/09/2025 16:45</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<!-- Scripts -->
<script src="https://unpkg.com/@panzoom/panzoom/dist/panzoom.min.js"></script>
<script>
    // Panzoom pour image interactive
    const element = document.getElementById('zoomContainer');
    const panzoom = Panzoom(element, {
        maxScale: 3,
        contain: 'outside'
    });
    element.parentElement.addEventListener('wheel', panzoom.zoomWithWheel);

    // Countdown
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
