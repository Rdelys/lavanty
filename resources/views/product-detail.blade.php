@extends('layouts.app')

@section('title', $product->title . ' - Détails du Produit | Lavanty.mg')

@section('content')
<style>
@import url("https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&family=Rubik:wght@400;600;700&display=swap");
/* 🌟 --- LAVANTY PREMIUM THEME --- */
/* Couleurs principales : Bleu #002f6c | Or #ffd700 */

body {
  background-color: #f8f9fc;
  font-family: "Nunito", sans-serif;
  color: #1a1a1a;
  overflow-x: hidden;
}

section.container {
  background: #ffffff;
  border-radius: 28px;
  padding: 4rem 2rem;
  transition: all .3s ease;
}

/* --- Titres --- */
h1, h2, h3 {
  font-family: "Rubik", sans-serif;
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
p, span, td, th, input, button {
  font-family: "DM Sans", sans-serif;
}
p.text-lg {
  line-height: 1.8;
  color: #555;
  font-weight: 400;
}

/* --- Prix --- */
.text-blue-700 { color: #002f6c !important; }
.text-yellow-600 { color: #ffd700 !important; }
.text-green-600 { color: #00a86b !important; }

/* --- Compteur d’enchère --- */
.countdown {
  background: linear-gradient(135deg, #ffffff, #f3f6fb);
  border: 1px solid rgba(0,47,108,0.1);
  border-radius: 16px;
  box-shadow: 0 6px 25px rgba(0, 47, 108, 0.08);
  padding: 1.2rem 2rem;
  display: flex;
  gap: 2rem;
}
.countdown div { text-align: center; }
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
  font-family: "Nunito", sans-serif;
  font-weight: 600;
  transition: all .3s ease;
  border: none;
  cursor: pointer;
}

/* --- Boutons principaux harmonisés --- */
#placeBidBtn,
#setAutoBidBtn {
  flex-shrink: 0;
  min-width: 170px;
  padding: 0.9rem 1.5rem;
  font-weight: 700;
  border-radius: 14px;
  text-align: center;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
  transition: all 0.3s ease;
}

#placeBidBtn {
  background: linear-gradient(90deg, #ffd700, #e6c300);
  color: #002f6c;
}
#placeBidBtn:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(255, 215, 0, 0.45);
}
#setAutoBidBtn {
  background: linear-gradient(90deg, #002f6c, #001f4d);
  color: #ffffff;
}
#setAutoBidBtn:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(0, 47, 108, 0.45);
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
#bidsTable tr:nth-child(even) { background: #f7f9fc; }
#bidsTable tr:hover { background-color: rgba(255, 215, 0, 0.08); transition: all .3s ease; }

/* --- Modales --- */
#messageModal .bg-white {
  background: #fff;
  border-radius: 18px;
  border: 1px solid #eee;
  box-shadow: 0 20px 60px rgba(0, 47, 108, 0.25);
  transition: all .3s ease;
}
#closeModal:hover { color: #002f6c; }

/* --- Scrollbar --- */
::-webkit-scrollbar { width: 10px; }
::-webkit-scrollbar-thumb {
  background: #002f6c;
  border-radius: 10px;
}
::-webkit-scrollbar-thumb:hover { background: #001f4d; }

/* --- Messages d’état --- */
.bid-status {
  font-family: "Nunito", sans-serif;
  font-weight: 600;
  font-size: 1.05rem;
  display: flex;
  align-items: center;
  gap: 0.4rem;
  letter-spacing: -0.01em;
  animation: fadeIn 0.4s ease forwards;
}
.bid-status.success { color: #16a34a; }
.bid-status.danger { color: #dc2626; }

/* --- Animations --- */
@keyframes fadeIn {
  0% { opacity: 0; transform: scale(0.95) translateY(20px); }
  100% { opacity: 1; transform: scale(1) translateY(0); }
}
@keyframes pulsePrice {
  0% { transform: scale(1); color: #ffd700; }
  50% { transform: scale(1.1); color: #ffea80; }
  100% { transform: scale(1); color: #ffd700; }
}
.pulse { animation: pulsePrice 0.6s ease; }

/* --- Responsive --- */
@media (max-width: 1024px) {
  section.container { padding: 2.5rem 1.5rem; }
  h1 { font-size: 2.2rem; }
}
@media (max-width: 768px) {
  h1 { font-size: 1.9rem; text-align: center; }
  p.text-lg { font-size: 1rem; text-align: justify; }
  .countdown { flex-wrap: wrap; justify-content: center; }
  #bidSection, #autoBidSection { flex-direction: column; align-items: stretch; gap: 0.8rem; }
  #placeBidBtn, #setAutoBidBtn { width: 100%; font-size: 1rem; }
}
@media (max-width: 480px) {
  section.container { padding: 1.5rem 1rem; }
  h1 { font-size: 1.6rem; }
  #bidsTable th, #bidsTable td { font-size: 0.8rem; padding: 0.6rem; }
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
            <!-- 🔥 Section Prix -->
<div class="mb-6">
    @php
        $latestBid = \App\Models\Bid::where('product_id', $product->id)
                    ->orderByDesc('amount')
                    ->first();
    @endphp

    @if($latestBid)
        <p class="text-4xl font-extrabold text-yellow-600 mb-1">
            {{ number_format($latestBid->amount, 0, ',', ' ') }} Ar
        </p>
        <p class="text-sm text-gray-500 mb-4">💰 Dernier prix proposé</p>
    @else
        <p class="text-4xl font-extrabold text-blue-700 mb-1">
            {{ number_format($product->starting_price, 0, ',', ' ') }} Ar
        </p>
        <p class="text-sm text-gray-500 mb-4">💰 Prix de départ</p>
    @endif

    <p class="text-sm text-gray-500">
        Prix de départ : <span class="font-semibold text-blue-700">{{ number_format($product->starting_price, 0, ',', ' ') }} Ar</span>
    </p>

    @auth
        @php
            $autoBid = \App\Models\AutoBid::where('user_id', auth()->id())
                        ->where('product_id', $product->id)
                        ->first();
        @endphp
        @if($autoBid)
            <p class="text-sm text-green-600 mt-1">(Votre enchère auto max : {{ number_format($autoBid->max_price, 0, ',', ' ') }} Ar)</p>
        @endif
    @endauth
</div>
<!-- 🟢🔴 Message d’état d’enchère -->
@auth
    @php
        $latestBid = \App\Models\Bid::where('product_id', $product->id)
                    ->orderByDesc('amount')
                    ->first();
    @endphp

    @if($latestBid && $latestBid->user_id === auth()->id())
        <div id="bidStatus" class="bid-status success mt-3">
            🏆 <span>Vous êtes le meilleur enchérisseur !</span>
        </div>
    @elseif($latestBid)
        <div id="bidStatus" class="bid-status danger mt-3">
            ⚠️ <span>Vous avez été surenchéri.</span>
        </div>
    @endif
@endauth



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
<!-- Modale de confirmation d'enchère -->
<!-- 🔥 MODALE PREMIUM RESPONSIVE -->
<div id="confirmModal"
     class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex items-center justify-center hidden z-50 transition-all duration-300">

    <div class="relative w-[90%] max-w-md bg-white/90 backdrop-blur-xl border border-gray-200 
                shadow-[0_20px_60px_rgba(0,47,108,0.25)] rounded-3xl p-8 animate-fadeIn scale-95 sm:scale-100">

        <!-- ✖ Bouton de fermeture -->
        <button id="closeConfirmModal"
                class="absolute top-3 right-4 text-gray-400 hover:text-[#002f6c] text-3xl font-bold transition">
            &times;
        </button>

        <!-- 💬 En-tête -->
        <div class="mb-6 text-center">
            <div class="mx-auto mb-4 w-16 h-16 flex items-center justify-center rounded-full 
                        bg-gradient-to-r from-[#002f6c] to-[#0047a3] shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#ffd700]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8v4l3 3m6 1a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-2xl font-extrabold text-[#002f6c]">Confirmation de votre enchère</h3>
            <p class="text-gray-600 mt-1 text-sm">
                Une commission de <span class="text-[#ffd700] font-semibold">10%</span> et une TVA de 
                <span class="text-[#ffd700] font-semibold">20%</span> (sur la commission) seront appliquées.
            </p>
        </div>

        <!-- 💰 Détails du calcul -->
        <div class="bg-white rounded-2xl shadow-inner border border-gray-100 px-5 py-4 mb-6 text-left space-y-1.5">
            <p class="text-gray-800">Montant de votre enchère :
                <span id="confirmBaseAmount" class="font-bold text-[#002f6c]"></span> Ar
            </p>
            <p class="text-gray-800">+ Commission (10 %) :
                <span id="confirmCommission" class="font-bold text-[#ffd700]"></span> Ar
            </p>
            <p class="text-gray-800">+ TVA (20 % de la commission) :
                <span id="confirmTVA" class="font-bold text-[#ffd700]"></span> Ar
            </p>

            <div class="border-t border-gray-200 my-3"></div>

            <p class="text-lg font-extrabold text-[#002f6c] flex justify-between items-center">
                Total à payer :
                <span id="confirmTotal" class="text-[#ffd700] text-xl"></span> Ar
            </p>
        </div>

        <!-- 🔘 Boutons d’action -->
        <div class="flex flex-col sm:flex-row justify-center gap-3">
            <button id="cancelConfirm"
                    class="w-full sm:w-auto px-6 py-2.5 rounded-xl font-semibold bg-gray-200 hover:bg-gray-300 
                           text-gray-700 transition-all">
                Annuler
            </button>
            <button id="confirmBidBtn"
                    class="w-full sm:w-auto px-6 py-2.5 rounded-xl font-semibold 
                           bg-gradient-to-r from-[#ffd700] to-[#e0c200] text-[#002f6c] 
                           hover:scale-105 shadow-lg transition-all">
                ✅ Confirmer
            </button>
        </div>
    </div>
</div>
<!-- 🔁 Modale de confirmation pour enchère automatique -->
<div id="autoConfirmModal"
     class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex items-center justify-center hidden z-50 transition-all duration-300">

    <div class="relative w-[90%] max-w-md bg-white/90 backdrop-blur-xl border border-gray-200 
                shadow-[0_20px_60px_rgba(0,47,108,0.25)] rounded-3xl p-8 animate-fadeIn scale-95 sm:scale-100">

        <!-- ✖ Bouton de fermeture -->
        <button id="closeAutoConfirmModal"
                class="absolute top-3 right-4 text-gray-400 hover:text-[#002f6c] text-3xl font-bold transition">
            &times;
        </button>

        <!-- 💬 En-tête -->
        <div class="mb-6 text-center">
            <div class="mx-auto mb-4 w-16 h-16 flex items-center justify-center rounded-full 
                        bg-gradient-to-r from-green-600 to-green-800 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#ffd700]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8v4l3 3m6 1a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-2xl font-extrabold text-[#002f6c]">Activer l’enchère automatique</h3>
            <p class="text-gray-600 mt-1 text-sm">
                Une enchère automatique placera <span class="text-[#ffd700] font-semibold">+50 000 Ar</span> à chaque surenchère,
                jusqu’à atteindre votre montant maximum.
            </p>
            <p class="text-gray-600 mt-1 text-sm">
                💰 Une commission de <span class="text-[#ffd700] font-semibold">10 %</span> et une TVA de 
                <span class="text-[#ffd700] font-semibold">20 %</span> (sur la commission) seront appliquées sur chaque enchère automatique placée.
            </p>
        </div>

        <!-- 💰 Détails du calcul simplifié -->
        <div class="bg-white rounded-2xl shadow-inner border border-gray-100 px-5 py-4 mb-6 text-left space-y-1.5">
            <p class="text-gray-800">Montant maximum :
                <span id="autoConfirmMax" class="font-bold text-[#002f6c]"></span> Ar
            </p>
            <p class="text-gray-800">Incrément automatique :
                <span class="font-bold text-[#ffd700]">50 000</span> Ar
            </p>

            <div class="border-t border-gray-200 my-3"></div>

            <p class="text-sm text-gray-600 italic">
                ⚙️ Le système enchérira automatiquement pour vous jusqu’à ce plafond.
            </p>
        </div>

        <!-- 🔘 Boutons -->
        <div class="flex flex-col sm:flex-row justify-center gap-3">
            <button id="cancelAutoConfirm"
                    class="w-full sm:w-auto px-6 py-2.5 rounded-xl font-semibold bg-gray-200 hover:bg-gray-300 
                           text-gray-700 transition-all">
                Annuler
            </button>
            <button id="confirmAutoBidBtn"
                    class="w-full sm:w-auto px-6 py-2.5 rounded-xl font-semibold 
                           bg-gradient-to-r from-green-600 to-green-800 text-white 
                           hover:scale-105 shadow-lg transition-all">
                🤖 Confirmer
            </button>
        </div>
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

    // Appliquer le style directement avec !important via setProperty
    function setCountdownColor(color) {
        card.querySelectorAll("p").forEach(el => {
            el.style.setProperty("color", color, "important");
        });
    }

   function updateCountdown() {

    // 🔥 Toujours relire la valeur actuelle dans data-end !
    const endTime = new Date(card.dataset.end).getTime();
    const now = Date.now();

    const diff = endTime - now;

        if (diff <= 0) {
    // ⏱️ Mettre le chrono à 0
    daysEl.textContent = "0";
    hoursEl.textContent = "0";
    minutesEl.textContent = "0";
    secondsEl.textContent = "0";

    // 🔹 Masquer complètement le chrono
    card.style.display = "none";

    // 🔹 Masquer les sections d’enchère
    document.getElementById("bidSection")?.classList.add("hidden");
    document.getElementById("autoBidSection")?.classList.add("hidden");

    // 🔹 Créer le message "Lot attribué"
    const adjElement = document.createElement('div');
    adjElement.id = "adjResult";
    adjElement.className = "text-center mt-4 text-3xl font-extrabold text-green-700 animate-fadeIn";
    adjElement.innerHTML = "🏁 <span class='text-yellow-600'>Lot attribué</span>";

    // Vérifie qu'on ne l’ajoute qu’une seule fois
    if (!document.getElementById("adjResult")) {
        card.parentElement.appendChild(adjElement);
    }

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

        // 🔥 Condition de couleur :
        // Moins de 24h => rouge ; sinon => noir
        if (diff < 24 * 60 * 60 * 1000) {
            setCountdownColor("red");
        } else {
            setCountdownColor("black");
        }

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

async function loadBids() {
    try {
        const res = await fetch(`/products/${productId}/bids`, { headers: { 'Accept': 'application/json' } });
        if (!res.ok) return;

        const bids = await res.json();
        const highestAmount = bids.length ? Math.max(...bids.map(b => b.amount)) : 0;
        if (highestAmount <= lastDisplayedAmount) return;
        lastDisplayedAmount = highestAmount;

        // 🧾 Rafraîchir le tableau des enchères
        bidsTableBody.innerHTML = '';
        bids.forEach((bid, index) => {
            const tr = document.createElement('tr');
            if (index % 2 === 1) tr.classList.add('bg-gray-50');
            if (index === 0) tr.classList.add('bg-yellow-100');
            tr.innerHTML = `
                <td class="border px-4 py-2">${index + 1}</td>
                <td class="border px-4 py-2">${bid.user.pseudo}</td>
                <td class="border px-4 py-2 font-bold text-blue-700">${Number(bid.amount).toLocaleString('fr-FR')}</td>
                <td class="border px-4 py-2">${new Date(bid.created_at).toLocaleString('fr-FR')}</td>
            `;
            bidsTableBody.appendChild(tr);
        });

        // 🟡 Met à jour automatiquement le prix affiché
        const latestPriceElement = document.querySelector('.text-4xl.font-extrabold.text-yellow-600');
        const priceLabel = document.querySelector('.text-sm.text-gray-500.mb-4');

        if (latestPriceElement && bids.length > 0) {
            const lastBid = bids[0];
            const newPrice = `${Number(lastBid.amount).toLocaleString('fr-FR')} Ar`;

            if (latestPriceElement.textContent.trim() !== newPrice) {
                latestPriceElement.textContent = newPrice;
                latestPriceElement.classList.add('pulse');
                setTimeout(() => latestPriceElement.classList.remove('pulse'), 600);
            }

            priceLabel.textContent = '💰 Dernier prix proposé';
        } else if (latestPriceElement && bids.length === 0) {
            latestPriceElement.textContent = `${Number({{ $product->starting_price }}).toLocaleString('fr-FR')} Ar`;
            priceLabel.textContent = '💰 Prix de départ';
        }

        // ✅ 🟢🔴 Mise à jour du message d’état (en dehors de la boucle)
        @auth
        const bidStatus = document.getElementById('bidStatus');
        if (bidStatus && bids.length > 0) {
            const topBid = bids[0];
            if (topBid.user.id === {{ auth()->id() }}) {
                bidStatus.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>🏆 Vous êtes le meilleur enchérisseur !</span>
                `;
                bidStatus.className = "bid-status bg-green-50 border border-green-400 text-green-700 font-semibold mt-4 p-3 rounded-xl flex items-center gap-2 animate-status";
            } else {
                bidStatus.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span>⚠️ Vous avez été surenchéri.</span>
                `;
                bidStatus.className = "bid-status bg-red-50 border border-red-400 text-red-700 font-semibold mt-4 p-3 rounded-xl flex items-center gap-2 animate-status";
            }
        }
        @endauth

    } catch (err) {
        console.error(err);
    }
}


loadBids();
async function refreshEndTime() {
    try {
        const res = await fetch(`/products/${productId}/end-time`);
        if (!res.ok) return;

        const data = await res.json();

        // mise à jour de la date dans le DOM
        const countdown = document.querySelector(".countdown");
        if (countdown) {
            countdown.dataset.end = data.end_time;
        }

    } catch (e) {
        console.error("Erreur end_time:", e);
    }
}
setInterval(refreshEndTime, 2000);

setInterval(loadBids, 2000);

@auth
const confirmModal = document.getElementById('confirmModal');
const confirmBaseAmount = document.getElementById('confirmBaseAmount');
const confirmCommission = document.getElementById('confirmCommission');
const confirmTVA = document.getElementById('confirmTVA');
const confirmTotal = document.getElementById('confirmTotal');
const confirmBidBtn = document.getElementById('confirmBidBtn');
const cancelConfirm = document.getElementById('cancelConfirm');
const closeConfirmModal = document.getElementById('closeConfirmModal');

let pendingBidAmount = 0;

// 🔸 Quand on clique sur "Placer"
document.getElementById('placeBidBtn').addEventListener('click', () => {
    const amount = parseFloat(bidInput.value);
    if (!amount || amount <= 0) return showModal('Veuillez saisir un montant valide.');

    // Calcul des frais
    // Calcul des frais
    const commission = amount * 0.10;
    const tva = commission * 0.20; // TVA sur la commission uniquement
    const total = amount + commission + tva;


    // Affiche dans la modale
    confirmBaseAmount.textContent = amount.toLocaleString('fr-FR');
    confirmCommission.textContent = commission.toLocaleString('fr-FR');
    confirmTVA.textContent = tva.toLocaleString('fr-FR');
    confirmTotal.textContent = total.toLocaleString('fr-FR');

    pendingBidAmount = amount;
    confirmModal.classList.remove('hidden');
});

// 🔸 Annuler ou fermer
cancelConfirm.addEventListener('click', () => confirmModal.classList.add('hidden'));
closeConfirmModal.addEventListener('click', () => confirmModal.classList.add('hidden'));
confirmModal.addEventListener('click', e => {
    if (e.target.id === 'confirmModal') confirmModal.classList.add('hidden');
});

// 🔸 Confirmer l’enchère
confirmBidBtn.addEventListener('click', async () => {
    confirmModal.classList.add('hidden');

    try {
        const res = await fetch(`/products/${productId}/bid`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ amount: pendingBidAmount })
        });

        if (res.ok) {
            bidInput.value = '';
            loadBids();
            showModal('✅ Enchère placée avec succès !');
        } else {
            const data = await res.json();
            showModal(data.message || "Erreur lors de l'enchère.");
        }
    } catch (err) {
        showModal("Erreur lors de l'enchère.");
    }
});
@endauth


const autoBidInput = document.getElementById('autoBidAmount');
const setAutoBidBtn = document.getElementById('setAutoBidBtn');

if (setAutoBidBtn) {
    const autoConfirmModal = document.getElementById('autoConfirmModal');
    const closeAutoConfirmModal = document.getElementById('closeAutoConfirmModal');
    const cancelAutoConfirm = document.getElementById('cancelAutoConfirm');
    const confirmAutoBidBtn = document.getElementById('confirmAutoBidBtn');
    const autoConfirmMax = document.getElementById('autoConfirmMax');

    let pendingAutoMax = 0;

    // 🔸 Quand on clique sur "Enchère automatique"
    setAutoBidBtn.addEventListener('click', () => {
        const max_price = parseFloat(autoBidInput.value);
        if (!max_price || max_price <= 0)
            return showModal('Veuillez saisir un montant valide.');

        // Affichage des données
        pendingAutoMax = max_price;
        autoConfirmMax.textContent = max_price.toLocaleString('fr-FR');

        // Ouvre la modale
        autoConfirmModal.classList.remove('hidden');
    });

    // 🔸 Fermer / annuler la modale
    cancelAutoConfirm.addEventListener('click', () => autoConfirmModal.classList.add('hidden'));
    closeAutoConfirmModal.addEventListener('click', () => autoConfirmModal.classList.add('hidden'));
    autoConfirmModal.addEventListener('click', e => {
        if (e.target.id === 'autoConfirmModal') autoConfirmModal.classList.add('hidden');
    });

    // 🔸 Confirmer l’enchère automatique
    confirmAutoBidBtn.addEventListener('click', async () => {
        autoConfirmModal.classList.add('hidden');

        try {
            const res = await fetch(`/products/${productId}/auto-bid`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ max_price: pendingAutoMax })
            });

            if (res.ok) {
                autoBidInput.value = '';
                showModal('✅ Enchère automatique activée avec succès !');
            } else {
                const data = await res.json();
                showModal(data.message || 'Erreur.');
            }
        } catch (err) {
            showModal('Erreur.');
        }
    });
}


</script>
@endsection
