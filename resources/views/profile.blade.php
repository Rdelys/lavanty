@extends('layouts.app')

@section('title', 'Mon Profil - Lavanty.mg')

@section('content')
<style>
/* 🌟 Style Luxe Premium Profil */
.profile-card {
    background: linear-gradient(145deg, #ffffff, #f4f6fb);
    border-radius: 28px;
    box-shadow: 0 15px 50px rgba(0, 47, 108, 0.15);
    transition: all .3s ease;
    border-top: 4px solid #ffd700;
}
.profile-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 60px rgba(0, 47, 108, 0.25);
}
.info-section, .bids-section {
    background: rgba(255,255,255,0.95);
    border-radius: 20px;
    box-shadow: inset 0 4px 20px rgba(0, 47, 108, 0.05);
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
}
.info-section:hover, .bids-section:hover {
    transform: scale(1.01);
}
.luxury-title {
    background: linear-gradient(90deg, #002f6c, #004aad);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.gold-line {
    width: 80px;
    height: 4px;
    border-radius: 2px;
    background: linear-gradient(90deg, #ffd700, #ffdf50);
    margin: 0 auto;
}
input, select {
    border-radius: 12px;
    border: 1.5px solid #ccc;
    transition: all .3s ease;
}
input:focus {
    border-color: #002f6c;
    box-shadow: 0 0 0 3px rgba(0,47,108,0.1);
}
.table-premium {
    border-collapse: collapse;
    width: 100%;
}
.table-premium th {
    background: linear-gradient(90deg, #002f6c, #004aad);
    color: #fff;
    font-weight: 700;
    padding: 1rem;
    text-align: left;
    font-size: 0.9rem;
}
.table-premium td {
    padding: 0.9rem 1rem;
    border-bottom: 1px solid #e5e9f0;
}
.table-premium tr {
    transition: all .3s ease;
}
.table-premium tr:hover {
    transform: scale(1.01);
    background: rgba(255, 215, 0, 0.07);
}
.status-good {
    background: linear-gradient(90deg, #d9fcd9, #b6f7b6);
}
.status-bad {
    background: linear-gradient(90deg, #ffe2e2, #ffcccc);
}
.status-good span {
    color: #087a08;
}
.status-bad span {
    color: #c92020;
}
@media (max-width: 768px) {
    .profile-card { padding: 2rem 1.5rem; }
    .table-premium th, .table-premium td { font-size: 0.85rem; }
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
