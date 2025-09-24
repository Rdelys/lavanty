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

            <!-- Placer enchère -->
            @auth
                <div id="bidSection" class="mb-6 flex gap-3 items-center">
                    <input type="number" id="bidAmount" placeholder="Votre enchère (Ar)"
                        class="border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <button id="placeBidBtn" class="bg-yellow-600 hover:bg-yellow-500 text-white font-bold px-6 py-2 rounded-xl transition">
                        💰 Placer
                    </button>
                </div>
            @endauth
            @guest
                <p class="text-sm text-gray-500 mb-4">Veuillez vous connecter pour placer une enchère.</p>
            @endguest
        </div>
    </div>

    <!-- Tableau enchères -->
    <div class="mt-16">
        <h2 class="text-2xl font-bold mb-4">Historique des enchères</h2>
        <table id="bidsTable" class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">#</th>
                    <th class="border px-4 py-2">Nom du participant</th>
                    <th class="border px-4 py-2">Montant (Ar)</th>
                    <th class="border px-4 py-2">Date / Heure</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</section>

<!-- Modale pour messages -->
<div id="messageModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-xl shadow-lg max-w-sm w-full p-6 text-center relative">
        <button id="closeModal" class="absolute top-2 right-3 text-gray-500 hover:text-gray-700 text-xl font-bold">&times;</button>
        <p id="modalMessage" class="text-gray-800 text-lg"></p>
    </div>
</div>

<script src="https://unpkg.com/@panzoom/panzoom/dist/panzoom.min.js"></script>
<script>
const element = document.getElementById('zoomContainer');
const panzoom = Panzoom(element, { maxScale: 3, contain: 'outside' });
element.parentElement.addEventListener('wheel', panzoom.zoomWithWheel);

// Countdown
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

            // 🔴 Masquer la section enchère si le chrono est fini
            const bidSection = document.getElementById("bidSection");
            if (bidSection) {
                bidSection.classList.add("hidden");
            }
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


// Modale
function showModal(message){
    const modal = document.getElementById('messageModal');
    modal.querySelector('#modalMessage').textContent = message;
    modal.classList.remove('hidden');
}
document.getElementById('closeModal').addEventListener('click', () => {
    document.getElementById('messageModal').classList.add('hidden');
});
document.getElementById('messageModal').addEventListener('click', e => {
    if(e.target.id === 'messageModal') e.target.classList.add('hidden');
});

const productId = {{ $product->id }};
const bidsTableBody = document.querySelector('#bidsTable tbody');
const bidInput = document.getElementById('bidAmount');
let lastDisplayedAmount = 0;

async function loadBids(){
    try{
        const res = await fetch(`/products/${productId}/bids`, { headers:{'Accept':'application/json'} });
        if(!res.ok) return;
        const bids = await res.json();
        const highestAmount = bids.length ? Math.max(...bids.map(b=>b.amount)) : 0;
        if(highestAmount <= lastDisplayedAmount) return;
        lastDisplayedAmount = highestAmount;

        bidsTableBody.innerHTML = '';
        bids.forEach((bid, index)=>{
            const tr = document.createElement('tr');
            if(index%2===1) tr.classList.add('bg-gray-50');
            if(index===0) tr.classList.add('bg-yellow-100');
            tr.innerHTML = `
                <td class="border px-4 py-2">${index+1}</td>
                <td class="border px-4 py-2">${bid.user.nom} ${bid.user.prenoms}</td>
                <td class="border px-4 py-2 font-bold text-blue-700">${Number(bid.amount).toLocaleString('fr-FR')}</td>
                <td class="border px-4 py-2">${new Date(bid.created_at).toLocaleString('fr-FR')}</td>
            `;
            bidsTableBody.appendChild(tr);
        });

        @auth
        const lastUserBid = bids.find(b=>b.user.id=== {{ auth()->id() }});
        if(lastUserBid) bidInput.value = lastUserBid.amount;
        @endauth

    } catch(err){ console.error(err); }
}

loadBids();
setInterval(loadBids, 2000);

@auth
document.getElementById('placeBidBtn').addEventListener('click', async ()=>{
    const amount = parseFloat(bidInput.value);
    if(!amount || amount<=0) return showModal('Veuillez saisir un montant valide.');
    try{
        const res = await fetch(`/products/${productId}/bid`, {
            method:'POST',
            headers:{
                'Content-Type':'application/json',
                'X-CSRF-TOKEN':'{{ csrf_token() }}',
                'Accept':'application/json'
            },
            body: JSON.stringify({amount})
        });
        if(res.ok){
            bidInput.value='';
            loadBids();
            showModal('✅ Enchère placée avec succès !');
        } else {
            const data = await res.json();
            showModal(data.message || 'Erreur lors de l\'enchère.');
        }
    } catch(err){ showModal('Erreur lors de l\'enchère.'); }
});
@endauth
</script>
@endsection
