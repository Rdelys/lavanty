@extends('layouts.app')

@section('title', 'Mon Profil - Lavanty.mg')

@section('content')
<style>
@import url("https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap");

/* 🌟 STYLE PREMIUM LAVANTY.MG */
body {
    font-family: "DM Sans", sans-serif;
    background: #f8f9fc;
    color: #1a1a1a;
}

/* --- Carte principale --- */
.profile-card {
    background: linear-gradient(135deg, #ffffff, #f4f7fb);
    border-radius: 28px;
    box-shadow: 0 8px 40px rgba(0, 0, 0, 0.06);
    transition: all .4s ease;
}

/* --- Sections --- */
.info-section, .bids-section {
    background: rgba(255,255,255,0.9);
    border-radius: 22px;
    border: 1px solid rgba(230, 233, 240, 0.6);
    backdrop-filter: blur(14px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    transition: all 0.4s ease;
}
.info-section:hover, .bids-section:hover {
    transform: translateY(-4px);
}

/* --- Titres --- */
h1, h2 {
    font-family: "Playfair Display", serif;
    font-weight: 700;
    color: #002f6c;
}

.luxury-title {
    background: linear-gradient(90deg, #001b44, #004aad);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.gold-line {
    width: 90px;
    height: 4px;
    border-radius: 3px;
    background: linear-gradient(90deg, #ffda44, #ffd700);
    margin: 0 auto;
}

/* --- Inputs --- */
input, select {
    border-radius: 14px;
    border: 1.5px solid #d8dee9;
    transition: all .3s ease;
    background: #fff;
    font-family: "DM Sans", sans-serif;
}
input:focus {
    border-color: #002f6c;
    box-shadow: 0 0 0 4px rgba(0,47,108,0.1);
}

/* --- Bouton principal --- */
.btn-yellow {
    background: linear-gradient(90deg, #ffd700, #e6c300);
    color: #002f6c;
    transition: all .3s ease;
    font-family: "DM Sans", sans-serif;
}
.btn-yellow:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
}

/* --- Tableau Premium --- */
.table-premium {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    font-family: "DM Sans", sans-serif;
    overflow: hidden;
    border-radius: 16px;
}

.table-premium thead {
    background: linear-gradient(90deg, #001b44, #004aad);
    color: #fff;
}
.table-premium th {
    text-transform: uppercase;
    font-size: 0.85rem;
    font-weight: 700;
    padding: 1rem;
    letter-spacing: 0.6px;
    border-bottom: 2px solid rgba(255,255,255,0.2);
}
.table-premium tbody {
    background: rgba(255, 255, 255, 0.8);
}
.table-premium td {
    padding: 0.9rem 1rem;
    border-bottom: 1px solid #edf0f6;
    font-size: 0.95rem;
    color: #1e293b;
    transition: all 0.3s ease;
}
.table-premium tr:last-child td {
    border-bottom: none;
}
.table-premium tr:hover {
    background: linear-gradient(90deg, rgba(255, 215, 0, 0.08), rgba(255, 255, 255, 0.9));
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 215, 0, 0.15);
}

/* --- Statuts --- */
.status-good {
    background: linear-gradient(90deg, #f2fff5, #e3ffe9);
}
.status-bad {
    background: linear-gradient(90deg, #fff4f4, #ffeaea);
}
.status-good span {
    color: #0f9d58;
    font-weight: 600;
}
.status-bad span {
    color: #d93025;
    font-weight: 600;
}
.status-good span::before, .status-bad span::before {
    content: '';
    display: inline-block;
    width: 8px;
    height: 8px;
    margin-right: 6px;
    border-radius: 50%;
    vertical-align: middle;
}
.status-good span::before { background-color: #0f9d58; }
.status-bad span::before { background-color: #d93025; }

/* --- Focus actif --- */
.table-premium tr:active {
    background: linear-gradient(90deg, #ffd7001a, #ffffff);
    transform: scale(0.99);
}

/* --- Responsive --- */
@media (max-width: 768px) {
    .profile-card { padding: 2rem 1.5rem; }
    .table-premium th, .table-premium td { font-size: 0.85rem; padding: 0.7rem; }
}
</style>



<section class="container mx-auto px-6 py-16 fade-in">
    <div class="profile-card p-8 md:p-10">
        <!-- 🔹 En-tête -->
        <div class="text-center mb-10">
            <h1 class="text-5xl font-extrabold luxury-title mb-2">👑 Mon Profil</h1>
            <div class="gold-line mb-3"></div>
            <p class="text-gray-500 text-sm italic">Bienvenue, <span class="font-semibold text-blue-900">{{ auth()->user()->pseudo }}</span> — gérez vos informations et suivez vos enchères.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-10">
            <!-- 🔸 Informations utilisateur -->
            <div class="info-section p-6 border border-blue-100">
                <h2 class="text-2xl font-bold text-blue-900 mb-4 border-b-2 border-yellow-400 pb-2">
                    🧾 Informations personnelles
                </h2>

                <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-semibold text-blue-900 mb-1">Pseudo</label>
                        <input type="text" value="{{ auth()->user()->pseudo }}" readonly 
                            class="w-full border bg-gray-100 text-gray-700 px-3 py-2 rounded-xl">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-blue-900 mb-1">Nom</label>
                        <input type="text" name="nom" value="{{ auth()->user()->nom }}" 
                            class="w-full border px-3 py-2 rounded-xl focus:ring-2 focus:ring-blue-600">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-blue-900 mb-1">Prénoms</label>
                        <input type="text" name="prenoms" value="{{ auth()->user()->prenoms }}" 
                            class="w-full border px-3 py-2 rounded-xl focus:ring-2 focus:ring-blue-600">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-blue-900 mb-1">Email</label>
                        <input type="email" name="email" value="{{ auth()->user()->email }}" 
                            class="w-full border px-3 py-2 rounded-xl focus:ring-2 focus:ring-blue-600">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-blue-900 mb-1">Téléphone</label>
                        <input type="text" name="telephone" value="{{ auth()->user()->telephone }}" 
                            class="w-full border px-3 py-2 rounded-xl focus:ring-2 focus:ring-blue-600">
                    </div>

                    <button type="submit" class="btn-yellow px-8 py-2.5 rounded-full shadow-lg mt-4 font-semibold w-full md:w-auto">
                        💾 Mettre à jour le profil
                    </button>
                </form>
            </div>

            <!-- 🔸 Liste des enchères -->
            <div class="bids-section p-6 border border-yellow-100">
                <h2 class="text-2xl font-bold text-blue-900 mb-4 border-b-2 border-blue-500 pb-2">
                    💰 Mes Enchères
                </h2>

                @if($bids->count())
                    <div class="overflow-x-auto max-h-[500px] rounded-xl shadow-inner border border-gray-200">
                        <table class="table-premium w-full">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Dernière Enchère (Ar)</th>
                                    <th>Statut</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bids->groupBy('product_id') as $productBids)
                                    @php
                                        $latestUserBid = $productBids->sortByDesc('created_at')->first();
                                        $highestBid = $latestUserBid->product->bids()->orderByDesc('amount')->first();
                                        $isHighest = $highestBid && $highestBid->user_id === auth()->id();
                                    @endphp
                                    <tr class="{{ $isHighest ? 'status-good' : 'status-bad' }}">
                                        <td class="font-semibold text-blue-800">{{ $latestUserBid->product->title }}</td>
                                        <td class="font-bold text-yellow-700">{{ number_format($latestUserBid->amount, 0, ',', ' ') }}</td>
                                        <td>
                                            @if($isHighest)
                                                <span class="font-semibold">🟢 En tête pour ce produit</span>
                                            @else
                                                <span class="font-semibold">🔴 Plus en tête</span>
                                            @endif
                                        </td>
                                        <td class="text-gray-600 text-sm">{{ $latestUserBid->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 italic text-center py-10">Vous n’avez encore placé aucune enchère.</p>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
