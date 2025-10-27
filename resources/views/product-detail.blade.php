@extends('layouts.app')

@section('title', $product->title . ' - Détails du Produit | Lavanty.mg')

@section('content')
<style>
/* 🌟 --- LAVANTY PREMIUM THEME --- */
/* Couleurs principales : Bleu #002f6c | Or #ffd700 */

body {
  background-color: #f8f9fc;
  font-family: 'Poppins', 'Inter', sans-serif;
  color: #1a1a1a;
  overflow-x: hidden;
}

section.container {
  background: #ffffff;
  border-radius: 28px;
  box-shadow: 0 10px 40px rgba(0, 47, 108, 0.08);
  padding: 4rem 2rem;
  transition: all .3s ease;
}

/* --- Titres --- */
h1, h2, h3 {
  font-family: 'Poppins', sans-serif;
  letter-spacing: -0.03em;
}
h1 {
  font-size: 2.8rem;
  font-weight: 800;
  color: #002f6c;
  position: relative;
}
h1::after {
  content: '';
  display: block;
  width: 80px;
  height: 4px;
  background: #ffd700;
  margin-top: 10px;
  border-radius: 2px;
}
h2 {
  color: #002f6c;
  font-weight: 700;
  font-size: 1.8rem;
}

/* --- Galerie d’images --- */
#zoomContainer {
  border-radius: 20px;
  overflow: hidden;
  position: relative;
  box-shadow: 0 8px 30px rgba(0, 47, 108, 0.15);
}
#zoomContainer img {
  transition: transform .4s ease, filter .4s ease;
}
#zoomContainer:hover img {
  transform: scale(1.03);
  filter: brightness(1.05);
}
.flex.gap-3 img {
  border: 2px solid transparent;
  border-radius: 14px;
  transition: all .3s ease;
}
.flex.gap-3 img:hover {
  border-color: #ffd700;
  transform: scale(1.1);
  box-shadow: 0 0 15px rgba(255, 215, 0, 0.4);
}

/* --- Texte & Description --- */
p.text-lg {
  line-height: 1.8;
  color: #555;
  font-weight: 400;
}

/* --- Prix --- */
.text-blue-700 {
  color: #002f6c !important;
}
.text-yellow-600 {
  color: #ffd700 !important;
}
.text-green-600 {
  color: #00a86b !important;
}

/* --- Compteur d’enchère (countdown) --- */
.countdown {
  background: linear-gradient(135deg, #ffffff, #f3f6fb);
  border: 1px solid rgba(0,47,108,0.1);
  border-radius: 16px;
  box-shadow: 0 6px 25px rgba(0, 47, 108, 0.08);
  padding: 1.2rem 2rem;
  display: flex;
  gap: 2rem;
}
.countdown div {
  text-align: center;
}
.countdown p {
  font-size: 1.8rem;
  font-weight: 700;
  color: #002f6c;
}
.countdown span {
  font-size: 0.75rem;
  color: #666;
}

/* --- Inputs --- */
input[type="number"] {
  border: 1.5px solid #ccc;
  border-radius: 12px;
  padding: 0.6rem 1rem;
  transition: all .3s ease;
  background: #fff;
}
input[type="number"]:focus {
  border-color: #002f6c;
  box-shadow: 0 0 0 3px rgba(0,47,108,0.1);
}

/* --- Boutons --- */
button {
  font-family: 'Poppins', sans-serif;
  font-weight: 600;
  transition: all .3s ease;
  border: none;
  cursor: pointer;
}

#placeBidBtn {
  background: linear-gradient(to right, #ffd700, #d6b400);
  color: #002f6c;
  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
}
#placeBidBtn:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(255, 215, 0, 0.5);
}

#setAutoBidBtn {
  background: linear-gradient(to right, #002f6c, #001f4d);
  color: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(0,47,108,0.3);
}
#setAutoBidBtn:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(0,47,108,0.5);
}

/* --- Tableau des enchères --- */
#bidsTable {
  width: 100%;
  border-collapse: collapse;
  font-size: 0.95rem;
}
#bidsTable th {
  background: #002f6c;
  color: #fff;
  padding: 1rem;
  text-align: left;
  text-transform: uppercase;
  letter-spacing: .04em;
}
#bidsTable td {
  padding: 0.9rem 1rem;
  border-top: 1px solid #e5e9f0;
}
#bidsTable tr:nth-child(even) {
  background: #f7f9fc;
}
#bidsTable tr:hover {
  background-color: rgba(255, 215, 0, 0.08);
  transition: all .3s ease;
}

/* --- Modale --- */
#messageModal .bg-white {
  background: #fff;
  border-radius: 18px;
  border: 1px solid #eee;
  box-shadow: 0 20px 60px rgba(0, 47, 108, 0.25);
  transition: all .3s ease;
}
#closeModal:hover {
  color: #002f6c;
}

/* --- Scrollbars (premium look) --- */
::-webkit-scrollbar {
  width: 10px;
}
::-webkit-scrollbar-thumb {
  background: #002f6c;
  border-radius: 10px;
}
::-webkit-scrollbar-thumb:hover {
  background: #001f4d;
}

/* --- Responsive Design --- */
@media (max-width: 1024px) {
  section.container {
    padding: 2.5rem 1.5rem;
  }
  h1 {
    font-size: 2.2rem;
  }
  .grid {
    gap: 2rem;
  }
}

@media (max-width: 768px) {
  h1 {
    font-size: 1.9rem;
    text-align: center;
  }
  p.text-lg {
    font-size: 1rem;
    text-align: justify;
  }
  .countdown {
    flex-wrap: wrap;
    gap: 1rem;
    justify-content: center;
  }
  .flex.gap-3 img {
    width: 60px;
    height: 60px;
  }
  #placeBidBtn, #setAutoBidBtn {
    width: 100%;
  }
  .grid.grid-cols-1 {
    gap: 2rem;
  }
}

@media (max-width: 480px) {
  section.container {
    padding: 1.5rem 1rem;
  }
  h1 {
    font-size: 1.6rem;
  }
  #bidsTable th, #bidsTable td {
    font-size: 0.8rem;
    padding: 0.6rem;
  }
}
</style>

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
                @auth
                    @php
                        $autoBid = \App\Models\AutoBid::where('user_id', auth()->id())
                                    ->where('product_id', $product->id)
                                    ->first();
                    @endphp
                    @if($autoBid)
                        <span class="ml-4 text-sm text-green-600">(Votre max : {{ number_format($autoBid->max_price, 0, ',', ' ') }} Ar)</span>
                    @endif
                @endauth
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
            @auth
            <div id="autoBidSection" class="mb-6 flex gap-3 items-center">
                <input type="number" id="autoBidAmount" placeholder="Votre prix max (Ar)"
                    class="border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                <button id="setAutoBidBtn" class="bg-green-600 hover:bg-green-500 text-white font-bold px-6 py-2 rounded-xl transition">
                    🤖 Enchère automatique
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
        <div class="border rounded-xl shadow-lg overflow-auto max-h-[500px]">
            <table id="bidsTable" class="w-full text-left border-collapse">
                <thead class="bg-blue-100 sticky top-0">
                    <tr>
                        <th class="border px-4 py-2">#</th>
                        <th class="border px-4 py-2">Enchérisseur</th>
                        <th class="border px-4 py-2">Montant (Ar)</th>
                        <th class="border px-4 py-2">Date / Heure</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
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

            // 🔴 Masquer la section enchère manuelle si le chrono est fini
            const bidSection = document.getElementById("bidSection");
            if (bidSection) {
                bidSection.classList.add("hidden");
            }

            // 🔴 Masquer la section enchère automatique aussi
            const autoBidSection = document.getElementById("autoBidSection");
            if (autoBidSection) {
                autoBidSection.classList.add("hidden");
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
                <td class="border px-4 py-2">${bid.user.pseudo}</td>
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

const autoBidInput = document.getElementById('autoBidAmount');
const setAutoBidBtn = document.getElementById('setAutoBidBtn');

if(setAutoBidBtn){
    setAutoBidBtn.addEventListener('click', async ()=>{
        const max_price = parseFloat(autoBidInput.value);
        if(!max_price || max_price<=0) return showModal('Veuillez saisir un montant valide.');

        try{
            const res = await fetch(`/products/${productId}/auto-bid`, {
                method:'POST',
                headers:{
                    'Content-Type':'application/json',
                    'X-CSRF-TOKEN':'{{ csrf_token() }}',
                    'Accept':'application/json'
                },
                body: JSON.stringify({max_price})
            });
            if(res.ok){
                autoBidInput.value='';
                showModal('✅ Enchère automatique définie avec succès !');
            } else {
                const data = await res.json();
                showModal(data.message || 'Erreur.');
            }
        } catch(err){ showModal('Erreur.'); }
    });
}

</script>
@endsection
