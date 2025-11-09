<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <style>
    /* Small custom tweaks to complement Tailwind */
    .table-header-sticky thead th {
      position: sticky;
      top: 0;
      z-index: 10;
      backdrop-filter: blur(4px);
    }
    .truncate-2 {
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
    /* subtle card glow on hover */
    .card-hover:hover { box-shadow: 0 12px 30px rgba(79, 70, 229, 0.12); transform: translateY(-3px); }

    .spin-slow {
    animation: spin 3s linear infinite;
  }
  </style>
</head>
<body class="flex bg-gray-100 min-h-screen text-gray-800">

  <!-- Sidebar -->
  <aside class="w-64 bg-gradient-to-b from-indigo-700 to-purple-800 text-white flex flex-col p-6 shadow-xl">
    <div class="text-2xl font-extrabold mb-8 flex items-center gap-3">
      <i class="fas fa-gem text-white text-2xl"></i>
      <span>Admin Panel</span>
    </div>

    <nav class="flex-1 space-y-2 text-sm">
      <a href="#dashboard" class="flex items-center gap-3 p-3 rounded-lg hover:bg-indigo-600 transition duration-200">
        <i class="fas fa-tachometer-alt w-5"></i>
        <span>Dashboard</span>
      </a>

      <div>
        <button onclick="toggleSubmenu('produits')" class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-indigo-600 transition duration-200">
          <span class="flex items-center gap-3"><i class="fas fa-box-open w-5"></i>Produits</span>
          <i id="icon-produits" class="fas fa-chevron-down transition-transform duration-300"></i>
        </button>
        <div id="submenu-produits" class="ml-6 mt-1 space-y-1 hidden">
          <a href="#ajouter-produit" class="block p-2 text-sm rounded hover:bg-indigo-500 transition">➕ Ajouter</a>
        </div>
      </div>
      <div>
        <button onclick="toggleSubmenu('clients')" class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-indigo-600 transition duration-200">
          <span class="flex items-center gap-3"><i class="fas fa-users w-5"></i>Clients</span>
          <i id="icon-clients" class="fas fa-chevron-down transition-transform duration-300"></i>
        </button>
        <div id="submenu-clients" class="ml-6 mt-1 space-y-1 hidden">
          <a href="#liste-clients" class="block p-2 text-sm rounded hover:bg-indigo-500 transition">👥 Liste des clients</a>
        </div>
      </div>
      <div>
        <button onclick="toggleSubmenu('bids')" class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-indigo-600 transition duration-200">
          <span class="flex items-center gap-3"><i class="fas fa-hand-holding-usd w-5"></i>Enchères (Bids)</span>
          <i id="icon-bids" class="fas fa-chevron-down transition-transform duration-300"></i>
        </button>
        <div id="submenu-bids" class="ml-6 mt-1 space-y-1 hidden">
          <a href="#liste-bids" class="block p-2 text-sm rounded hover:bg-indigo-500 transition">📑 Liste des bids</a>
        </div>
      </div>

      <div>
        <button onclick="toggleSubmenu('enchere')" class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-indigo-600 transition duration-200">
          <span class="flex items-center gap-3"><i class="fas fa-gavel w-5"></i>Enchères</span>
          <i id="icon-enchere" class="fas fa-chevron-down transition-transform duration-300"></i>
        </button>
        <div id="submenu-enchere" class="ml-6 mt-1 space-y-1 hidden">
          <a href="#prises" class="block p-2 text-sm rounded hover:bg-indigo-500 transition">✅ Produits pris</a>
          <a href="#non-prises" class="block p-2 text-sm rounded hover:bg-indigo-500 transition">❌ Produits non pris</a>
        </div>
      </div>
      <div>
        <button onclick="toggleSubmenu('vendus')" class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-indigo-600 transition duration-200">
          <span class="flex items-center gap-3">
            <i class="fas fa-dollar-sign w-5"></i>Produits vendus
          </span>
          <i id="icon-vendus" class="fas fa-chevron-down transition-transform duration-300"></i>
        </button>
        <div id="submenu-vendus" class="ml-6 mt-1 space-y-1 hidden">
          <a href="#produits-vendus" class="block p-2 text-sm rounded hover:bg-indigo-500 transition">💰 Liste des vendus</a>
        </div>
      </div>


      <form action="{{ route('admin.logout') }}" method="POST" class="mt-6">
        @csrf
        <button type="submit" class="flex items-center gap-3 w-full p-3 rounded-lg hover:bg-red-600 transition duration-200">
          <i class="fas fa-sign-out-alt w-5"></i>Déconnexion
        </button>
      </form>
    </nav>
  </aside>

  <!-- Contenu -->
  <main class="flex-1 p-6 md:p-10">

    <!-- Dashboard header -->
    <section id="dashboard">
  <div class="flex flex-col gap-6">
    <!-- En-tête -->
    <div class="flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
          <i class="fas fa-chart-line text-indigo-600"></i>Dashboard
        </h1>
        <p class="text-sm text-gray-500 mt-1">Bienvenue sur votre tableau de bord admin.</p>
      </div>
      <div class="flex items-center gap-3">
        <div class="relative">
          <input type="text" id="globalSearch" placeholder="Rechercher un produit..." class="pl-10 pr-4 py-2 rounded-lg border border-gray-200 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-200" />
          <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
        </div>
        <a href="#ajouter-produit" class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-4 py-2 rounded-lg shadow hover:scale-105 transition">
          <i class="fas fa-plus"></i>Ajouter
        </a>
      </div>
    </div>

    <!-- Cartes de statistiques -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <!-- Total produits -->
      <div class="bg-white rounded-2xl shadow-md p-5 flex items-center gap-4 card-hover">
        <div class="p-3 rounded-xl bg-indigo-100 text-indigo-600"><i class="fas fa-box-open text-2xl"></i></div>
        <div>
          <p class="text-sm text-gray-500">Produits créés</p>
          <h3 class="text-2xl font-bold">{{ $products->count() }}</h3>
        </div>
      </div>

      <!-- Produits en cours -->
      <!-- Carte Produits en cours -->
        <div class="bg-white rounded-2xl shadow-md p-6 flex items-center gap-4 hover:shadow-lg transition-transform hover:-translate-y-1">
        <!-- Icône à gauche -->
        <div class="bg-green-100 text-green-600 p-4 rounded-xl flex items-center justify-center">
            <i class="fas fa-spinner animate-spin text-xl"></i>
        </div>

        <!-- Texte aligné à droite de l'icône -->
        <div class="flex flex-col justify-center">
            <p class="text-sm text-gray-500">Produits en cours</p>
            <h2 class="text-2xl font-bold text-gray-800">
            {{ $products->where('status', 'en_cours')->count() }}
            </h2>
        </div>
        </div>



      <!-- Produits vendus / terminés -->
      <!-- Produits vendus -->
      <div class="bg-white rounded-2xl shadow-md p-5 flex items-center gap-4 card-hover">
        <div class="p-3 rounded-xl bg-red-100 text-red-600">
          <i class="fas fa-dollar-sign text-2xl"></i>
        </div>
        <div>
          <p class="text-sm text-gray-500">Produits vendus</p>
          <h3 class="text-2xl font-bold">{{ $productsVendus->count() }}</h3>
        </div>
      </div>

      <!-- Produits adjugés -->
      <div class="bg-white rounded-2xl shadow-md p-5 flex items-center gap-4 card-hover">
        <div class="p-3 rounded-xl bg-green-100 text-green-600">
          <i class="fas fa-gavel text-2xl"></i>
        </div>
        <div>
          <p class="text-sm text-gray-500">Adjugés</p>
          <h3 class="text-2xl font-bold">{{ $productsPrises->count() }}</h3>
        </div>
      </div>

      <!-- Produits non adjugés -->
      <div class="bg-white rounded-2xl shadow-md p-5 flex items-center gap-4 card-hover">
        <div class="p-3 rounded-xl bg-yellow-100 text-yellow-600">
          <i class="fas fa-times-circle text-2xl"></i>
        </div>
        <div>
          <p class="text-sm text-gray-500">Non adjugés</p>
          <h3 class="text-2xl font-bold">{{ $productsNonPrises->count() }}</h3>
        </div>
      </div>

      <!-- Produits à venir -->
      <div class="bg-white rounded-2xl shadow-md p-5 flex items-center gap-4 card-hover">
        <div class="p-3 rounded-xl bg-yellow-100 text-yellow-600"><i class="fas fa-clock text-2xl"></i></div>
        <div>
          <p class="text-sm text-gray-500">À venir</p>
          <h3 class="text-2xl font-bold">{{ $products->where('status','a_venir')->count() }}</h3>
        </div>
      </div>
      <!-- Total clients -->
      <div class="bg-white rounded-2xl shadow-md p-5 flex items-center gap-4 card-hover">
        <div class="p-3 rounded-xl bg-blue-100 text-blue-600"><i class="fas fa-users text-2xl"></i></div>
        <div>
          <p class="text-sm text-gray-500">Clients inscrits</p>
          <h3 class="text-2xl font-bold">{{ $users->count() }}</h3>
        </div>
      </div>

    </div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2"><i class="fas fa-list text-indigo-600"></i>Liste des produits</h2>
        <div class="text-sm text-gray-500">Total : <strong>{{ $products->count() }}</strong></div>
      </div>

      <div class="overflow-x-auto rounded-xl shadow-lg bg-white border border-gray-200">
        <table class="min-w-full table-auto text-sm table-header-sticky">
          <thead class="bg-white">
            <tr class="border-b">
              <th class="p-3 text-left text-xs text-gray-500 uppercase tracking-wider">ID</th>
              <th class="p-3 text-left text-xs text-gray-500 uppercase tracking-wider">Titre</th>
              <th class="p-3 text-left text-xs text-gray-500 uppercase tracking-wider">Photos</th>
              <th class="p-3 text-right text-xs text-gray-500 uppercase tracking-wider">Prix</th>
              <th class="p-3 text-left text-xs text-gray-500 uppercase tracking-wider">Début</th>
              <th class="p-3 text-left text-xs text-gray-500 uppercase tracking-wider">Fin</th>
              <th class="p-3 text-center text-xs text-gray-500 uppercase tracking-wider">Statut</th>
              <th class="p-3 text-center text-xs text-gray-500 uppercase tracking-wider">Mise en vente</th>
              <th class="p-3 text-center text-xs text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>

          <tbody class="divide-y divide-gray-100">
            @foreach($products as $product)
            <tr class="hover:bg-gray-50 transition">
              <td class="p-3 align-middle">{{ $product->id }}</td>
              <td class="p-3 align-middle max-w-xs">
                <div class="font-medium text-gray-800 truncate-2">{{ $product->title }}</div>
                <div class="text-xs text-gray-400">ID: {{ $product->id }} • {{ $product->created_at->diffForHumans() }}</div>
              </td>

              <td class="p-3 align-middle">
                <div class="flex items-center gap-2">
                  @if($product->images)
                    @foreach($product->images as $img)
                      <img src="{{ asset('storage/'.$img) }}" class="w-12 h-12 object-cover rounded-md border" alt="thumb">
                    @endforeach
                  @else
                    <span class="text-gray-400 text-xs">Aucune</span>
                  @endif
                </div>
              </td>

              <td class="p-3 text-right align-middle font-semibold">{{ number_format($product->starting_price, 0, ',', ' ') }} €</td>
              <td class="p-3 align-middle text-sm text-gray-600">{{ $product->start_time->format('d/m/Y H:i') }}</td>
              <td class="p-3 align-middle text-sm text-gray-600">{{ $product->end_time->format('d/m/Y H:i') }}</td>

              <td class="p-3 align-middle text-center">
                @if($product->status == 'a_venir')
                  <span class="px-3 py-1 text-sm rounded-full bg-gray-100 text-gray-700">À venir</span>
                @elseif($product->status == 'en_cours')
                  <span class="px-3 py-1 text-sm rounded-full bg-green-50 text-green-600">En cours</span>
                @elseif($product->status == 'adjugé')
                  <span class="px-3 py-1 text-sm rounded-full bg-red-50 text-green-600">Adjugé</span>
                @elseif($product->status == 'à_venir')
                  <span class="px-3 py-1 text-sm rounded-full bg-red-50 text-green-600">A venir</span>
                @else
                  <span class="px-3 py-1 text-sm rounded-full bg-red-50 text-red-600">Terminé</span>
                @endif
              </td>

              <td class="p-3 align-middle text-center">
                <button onclick="toggleMiseEnVente({{ $product->id }})" title="Basculer mise en vente" class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm text-white shadow-sm {{ $product->mise_en_vente ? 'bg-indigo-600 hover:bg-indigo-700' : 'bg-gray-400 hover:bg-gray-500' }}">
                  {{ $product->mise_en_vente ? 'Oui' : 'Non' }}
                </button>
              </td>

              <td class="p-3 align-middle text-center">
                <div class="inline-flex items-center gap-2">
                  <button onclick="openEditModal({{ $product->id }})" title="Modifier" class="p-2 rounded-md bg-yellow-500 hover:bg-yellow-600 text-white shadow-sm transition">
                    <i class="fas fa-edit"></i>
                  </button>

                  <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Supprimer ce produit ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" title="Supprimer" class="p-2 rounded-md bg-red-600 hover:bg-red-700 text-white shadow-sm transition">
                      <i class="fas fa-trash"></i>
                    </button>
                  </form>
                </div>
              </td>

            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
  </div>
</section>


    <!-- Formulaire - Ajouter -->
    <section id="ajouter-produit" class="hidden">
      <h2 class="text-2xl font-bold mb-4 text-gray-800 flex items-center gap-2"><i class="fas fa-plus text-indigo-600"></i>Ajouter un produit</h2>

      <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200 card-hover">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Titre</label>
            <input type="text" name="title" class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-200" placeholder="Ex: Sac vintage" required>
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Statut</label>
            <select name="status" class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-200">
              <option value="a_venir">À venir</option>
              <option value="en_cours" selected>En cours</option>
              <option value="termine">Terminé</option>
            </select>
          </div>

          <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
            <textarea name="description" rows="4" class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-200" placeholder="Courte description..."></textarea>
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Prix de départ (Ariary)</label>
            <input type="number" step="0.01" name="starting_price" class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-200" required>
          </div>

          <div class="flex items-center gap-3">
            <input type="checkbox" name="mise_en_vente" value="1" checked class="w-5 h-5 text-indigo-600 rounded focus:ring-2 focus:ring-indigo-200">
            <label class="text-sm font-semibold text-gray-700">Mise en vente</label>
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Images</label>
            <input type="file" name="images[]" multiple class="w-full border rounded-lg p-3">
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Début</label>
            <input type="datetime-local" name="start_time" class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-200" required>
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Fin</label>
            <input type="datetime-local" name="end_time" class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-200" required>
          </div>

        </div>

        <div class="flex justify-end mt-6">
          <button type="reset" class="px-5 py-2 rounded-lg bg-gray-100 border border-gray-200 mr-3">Annuler</button>
          <button type="submit" class="px-6 py-2 rounded-lg bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow hover:scale-105 transition">➕ Ajouter</button>
        </div>
      </form>
    </section>
<section id="prises" class="hidden">
  <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
    <i class="fas fa-check text-green-600"></i> Produits pris (Adjugés)
  </h2>

  <div class="overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-200">
    <table class="min-w-full table-auto text-sm">
      <thead class="bg-gray-50">
        <tr>
          <th class="p-3 text-left">ID</th>
          <th class="p-3 text-left">Titre</th>
          <th class="p-3 text-left">Gagnant</th>
          <th class="p-3 text-right">Prix de départ</th>
          <th class="p-3 text-right">Prix final</th> <!-- ✅ ajouté -->
          <th class="p-3 text-left">Fin</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        @forelse($productsPrises as $product)
          <tr class="hover:bg-gray-50">
            <td class="p-3">{{ $product->id }}</td>
            <td class="p-3 font-semibold">{{ $product->title }}</td>
            <td class="p-3">
              {{ $product->lastBidUser?->nom }} {{ $product->lastBidUser?->prenoms }}
            </td>
            <td class="p-3 text-right">{{ number_format($product->starting_price, 0, ',', ' ') }} Ar</td>
            <td class="p-3 text-right font-bold text-green-600">
              {{ number_format($product->final_price, 0, ',', ' ') }} Ar
            </td>
            <td class="p-3">{{ $product->end_time->format('d/m/Y H:i') }}</td>
          </tr>
        @empty
          <tr><td colspan="6" class="text-center py-4 text-gray-500">Aucun produit adjugé.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</section>
<section id="non-prises" class="hidden">
  <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
    <i class="fas fa-times text-red-600"></i> Produits non pris (Terminés sans enchère)
  </h2>

  <div class="overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-200">
    <table class="min-w-full table-auto text-sm">
      <thead class="bg-gray-50">
        <tr>
          <th class="p-3 text-left">ID</th>
          <th class="p-3 text-left">Titre</th>
          <th class="p-3 text-right">Prix de départ</th>
          <th class="p-3 text-left">Fin</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        @forelse($productsNonPrises as $product)
          <tr class="hover:bg-gray-50">
            <td class="p-3">{{ $product->id }}</td>
            <td class="p-3 font-semibold">{{ $product->title }}</td>
            <td class="p-3 text-right">{{ number_format($product->starting_price, 0, ',', ' ') }} Ar</td>
            <td class="p-3">{{ $product->end_time->format('d/m/Y H:i') }}</td>
          </tr>
        @empty
          <tr><td colspan="4" class="text-center py-4 text-gray-500">Aucun produit non pris.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</section>
<section id="produits-vendus" class="hidden">
  <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
    <i class="fas fa-dollar-sign text-red-600"></i> Produits vendus
  </h2>

  <div class="overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-200">
    <table class="min-w-full table-auto text-sm">
      <thead class="bg-gray-50">
        <tr>
          <th class="p-3 text-left">ID</th>
          <th class="p-3 text-left">Titre</th>
          <th class="p-3 text-left">Prix final</th>
          <th class="p-3 text-left">Date de fin</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        @forelse($productsVendus as $product)
          <tr class="hover:bg-gray-50">
            <td class="p-3">{{ $product->id }}</td>
            <td class="p-3 font-semibold">{{ $product->title }}</td>
            <td class="p-3 text-right font-bold text-green-600">
              {{ number_format($product->final_price, 0, ',', ' ') }} Ar
            </td>
            <td class="p-3">{{ $product->end_time->format('d/m/Y H:i') }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="text-center py-4 text-gray-500">Aucun produit vendu.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</section>

<section id="liste-clients" class="hidden">
  <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
    <i class="fas fa-users text-indigo-600"></i> Liste des clients
  </h2>

  <div class="overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-200">
    <table class="min-w-full table-auto text-sm">
      <thead class="bg-gray-50">
        <tr>
          <th class="p-3 text-left">ID</th>
          <th class="p-3 text-left">Nom</th>
          <th class="p-3 text-left">Prénoms</th>
          <th class="p-3 text-left">Email</th>
          <th class="p-3 text-left">Téléphone</th>
          <th class="p-3 text-left">Date d’inscription</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        @forelse($users as $user)
          <tr class="hover:bg-gray-50">
            <td class="p-3">{{ $user->id }}</td>
            <td class="p-3">{{ $user->nom }}</td>
            <td class="p-3">{{ $user->prenoms }}</td>
            <td class="p-3">{{ $user->email }}</td>
            <td class="p-3">{{ $user->telephone }}</td>
            <td class="p-3">{{ $user->created_at->format('d/m/Y') }}</td>
          </tr>
        @empty
          <tr><td colspan="6" class="text-center py-4 text-gray-500">Aucun client enregistré.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</section>
<section id="liste-bids" class="hidden">
  <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
    <i class="fas fa-hand-holding-usd text-green-600"></i> Liste des bids
  </h2>

  <!-- Filtres -->
  <form id="filterBidsForm" class="flex gap-4 mb-4">
    <select name="client" id="filterClient" class="border rounded-lg p-2">
      <option value="">-- Tous les clients --</option>
      @foreach($users as $u)
        <option value="{{ $u->id }}">{{ $u->nom }} {{ $u->prenoms }}</option>
      @endforeach
    </select>

    <select name="produit" id="filterProduit" class="border rounded-lg p-2">
      @foreach($products as $p)
        <option value="{{ $p->id }}" {{ $loop->first ? 'selected' : '' }}>
          {{ $p->title }}
        </option>
      @endforeach
    </select>

    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg">Filtrer</button>
  </form>

  <!-- Tableau scrollable -->
  <div class="overflow-y-auto max-h-96 bg-white rounded-xl shadow-lg border border-gray-200">
    <table class="min-w-full table-auto text-sm">
      <thead class="bg-gray-50 sticky top-0">
        <tr>
          <th class="p-3 text-left">Client</th>
          <th class="p-3 text-left">Produit</th>
          <th class="p-3 text-right">Montant</th>
          <th class="p-3 text-left">Date</th>
        </tr>
      </thead>
      <tbody id="bidsTable" class="divide-y divide-gray-100">
        <!-- Contenu chargé par AJAX -->
      </tbody>
    </table>
  </div>
</section>


  </main>

  <!-- Modal -->
  <div id="editModal" class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50 px-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl p-6 relative">
      <button onclick="closeEditModal()" class="absolute top-4 right-4 p-2 rounded-md bg-gray-100 hover:bg-gray-200"><i class="fas fa-times"></i></button>

      <h2 class="text-xl font-bold mb-4 text-gray-800">Modifier le produit</h2>

      <form id="editForm" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf @method('PUT')
        <input type="hidden" id="editProductId" name="id">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Titre</label>
            <input type="text" id="editTitle" name="title" class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-200">
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Statut</label>
            <select name="status" id="editStatus" class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-200">
              <option value="a_venir">À venir</option>
              <option value="en_cours">En cours</option>
              <option value="termine">Terminé</option>
            </select>
          </div>

          <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
            <textarea id="editDescription" name="description" rows="3" class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-200"></textarea>
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Prix de départ (€)</label>
            <input type="number" id="editPrice" name="starting_price" class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-200">
          </div>

          <div class="flex items-center gap-3">
            <input type="checkbox" name="mise_en_vente" id="editMiseEnVente" value="1" class="w-5 h-5 text-indigo-600 rounded focus:ring-2 focus:ring-indigo-200">
            <label class="text-sm font-semibold text-gray-700">Mise en vente</label>
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Début</label>
            <input type="datetime-local" id="editStart" name="start_time" class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-200">
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Fin</label>
            <input type="datetime-local" id="editEnd" name="end_time" class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-200">
          </div>

          <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Nouvelles images</label>
            <input type="file" name="images[]" multiple class="w-full border rounded-lg p-3">
          </div>
        </div>

        <div class="flex justify-end gap-3 pt-2">
          <button type="button" onclick="closeEditModal()" class="px-4 py-2 rounded-lg bg-gray-100">Annuler</button>
          <button type="submit" class="px-4 py-2 rounded-lg bg-gradient-to-r from-indigo-600 to-purple-600 text-white">💾 Enregistrer</button>
        </div>
      </form>

    </div>
  </div>

  <script>
    function toggleSubmenu(name) {
      const submenu = document.getElementById('submenu-' + name);
      const icon = document.getElementById('icon-' + name);
      submenu.classList.toggle('hidden');
      icon.classList.toggle('rotate-180');
    }

    document.querySelectorAll("a[href^='#']").forEach(link => {
      link.addEventListener("click", function(e) {
        e.preventDefault();
        const targetId = this.getAttribute("href").substring(1);
        document.querySelectorAll("main section").forEach(sec => sec.classList.add("hidden"));
        document.getElementById(targetId).classList.remove("hidden");
      });
    });

    function csrfToken() {
      const m = document.querySelector('meta[name="csrf-token"]');
      return m ? m.getAttribute('content') : '';
    }

    async function openEditModal(id) {
      try {
        const res = await fetch(`/admin/products/${id}/edit`, {
          headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken() }
        });
        if (!res.ok) throw new Error('HTTP ' + res.status);
        const data = await res.json();

        document.getElementById('editProductId').value = data.id;
        document.getElementById('editTitle').value = data.title || '';
        document.getElementById('editDescription').value = data.description || '';
        document.getElementById('editPrice').value = data.starting_price ?? '';
        document.getElementById('editStart').value = data.start_time || '';
        document.getElementById('editEnd').value = data.end_time || '';
        document.getElementById('editStatus').value = data.status || '';
        document.getElementById('editMiseEnVente').checked = !!data.mise_en_vente;

        const form = document.getElementById('editForm');
        form.action = `/admin/products/${id}`;
        document.getElementById('editModal').classList.remove('hidden');
      } catch (err) {
        console.error('openEditModal error', err);
        alert('Impossible de charger le produit (voir console).');
      }
    }

    // gestion de la soumission du formulaire (AJAX)
    document.getElementById('editForm').addEventListener('submit', async function(e) {
      e.preventDefault();
      const form = e.target;
      const action = form.action;
      if (!action) {
        return alert('Action du formulaire non définie.');
      }

      const fd = new FormData(form);
      fd.set('_method', 'PUT');

      try {
        const res = await fetch(action, {
          method: 'POST',
          headers: { 'X-CSRF-TOKEN': csrfToken(), 'Accept': 'application/json' },
          body: fd
        });

        const contentType = res.headers.get('content-type') || '';
        if (res.ok) {
          let json = {};
          if (contentType.includes('application/json')) json = await res.json();
          if (json.success === true || res.status === 200) {
            document.getElementById('editModal').classList.add('hidden');
            location.reload();
            return;
          }
          alert('Mis à jour terminée, rechargez la page.');
          location.reload();
          return;
        }

        if (contentType.includes('application/json')) {
          const json = await res.json();
          const errs = json.errors || json;
          console.error('Validation errors', errs);
          alert('Erreur de validation — voir console pour détails.');
          return;
        }

        const text = await res.text();
        console.error('Server error:', text);
        alert('Erreur serveur (voir console).');

      } catch (err) {
        console.error('submit editForm error', err);
        alert('Erreur réseau (voir console).');
      }
    });

    function closeEditModal() {
      document.getElementById('editModal').classList.add('hidden');
    }

    function toggleMiseEnVente(id) {
      fetch(`/admin/products/${id}/toggle`, {
        method: 'PATCH',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) location.reload();
      });
    }

    // Basic client-side search (filtre simple)
    document.getElementById('globalSearch').addEventListener('input', function(e){
      const q = e.target.value.toLowerCase().trim();
      document.querySelectorAll('tbody tr').forEach(row => {
        const txt = row.innerText.toLowerCase();
        row.style.display = txt.includes(q) ? '' : 'none';
      });
    });

    // Fonction pour afficher les bids dans le tableau
function renderBids(bids) {
  const tbody = document.getElementById('bidsTable');
  tbody.innerHTML = '';

  if (!bids.length) {
    tbody.innerHTML = `<tr><td colspan="4" class="text-center py-4 text-gray-500">Aucun bid trouvé.</td></tr>`;
    return;
  }

  bids.forEach(bid => {
    const row = `
      <tr class="hover:bg-gray-50">
        <td class="p-3">${bid.user.nom} ${bid.user.prenoms}</td>
        <td class="p-3">${bid.product.title}</td>
        <td class="p-3 text-right font-bold">${Number(bid.amount).toLocaleString()} Ar</td>
        <td class="p-3">${new Date(bid.created_at).toLocaleString()}</td>
      </tr>
    `;
    tbody.insertAdjacentHTML('beforeend', row);
  });
}

// Charger initialement les bids
async function loadBids() {
  const client = document.getElementById('filterClient').value;
  const produit = document.getElementById('filterProduit').value;

  const url = `/admin/bids/filter?client=${client}&produit=${produit}`;
  const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
  if (res.ok) {
    const bids = await res.json();
    renderBids(bids);
  }
}

// Gérer le formulaire sans rechargement
document.getElementById('filterBidsForm').addEventListener('submit', function(e) {
  e.preventDefault();
  loadBids();
});

// Charger les 30 premiers bids par défaut
document.addEventListener('DOMContentLoaded', loadBids);

  </script>
</body>
</html>