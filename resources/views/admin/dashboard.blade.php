<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="flex bg-gray-100 min-h-screen">

  <!-- Sidebar -->
  <aside class="w-64 bg-gradient-to-b from-indigo-700 to-purple-800 text-white flex flex-col p-5 shadow-xl">
    <div class="text-2xl font-bold mb-10 flex items-center gap-2">
      <i class="fas fa-gem text-white text-2xl"></i>
      Admin Panel
    </div>
    <nav class="flex-1 space-y-2">
      <a href="#dashboard" class="flex items-center gap-3 p-3 rounded-lg hover:bg-indigo-600 transition duration-300">
        <i class="fas fa-tachometer-alt w-5"></i>
        <span>Dashboard</span>
      </a>
      <div>
        <button onclick="toggleSubmenu('produits')" class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-indigo-600 transition duration-300">
          <span class="flex items-center gap-3"><i class="fas fa-box-open w-5"></i>Produits</span>
          <i id="icon-produits" class="fas fa-chevron-down transition-transform duration-300"></i>
        </button>
        <div id="submenu-produits" class="ml-6 mt-1 space-y-1 hidden">
          <a href="#ajouter-produit" class="block p-2 text-sm rounded hover:bg-indigo-500 transition">➕ Ajouter</a>
          <a href="#lister-produits" class="block p-2 text-sm rounded hover:bg-indigo-500 transition">📋 Lister</a>
        </div>
      </div>
      <div>
        <button onclick="toggleSubmenu('enchere')" class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-indigo-600 transition duration-300">
          <span class="flex items-center gap-3"><i class="fas fa-gavel w-5"></i>Enchères</span>
          <i id="icon-enchere" class="fas fa-chevron-down transition-transform duration-300"></i>
        </button>
        <div id="submenu-enchere" class="ml-6 mt-1 space-y-1 hidden">
          <a href="#prises" class="block p-2 text-sm rounded hover:bg-indigo-500 transition">✅ Produits pris</a>
          <a href="#non-prises" class="block p-2 text-sm rounded hover:bg-indigo-500 transition">❌ Produits non pris</a>
        </div>
      </div>
      <form action="{{ route('admin.logout') }}" method="POST" class="mt-5">
        @csrf
        <button type="submit" class="flex items-center gap-3 w-full p-3 rounded-lg hover:bg-red-600 transition duration-300">
          <i class="fas fa-sign-out-alt w-5"></i>Déconnexion
        </button>
      </form>
    </nav>
  </aside>

  <!-- Contenu -->
  <main class="flex-1 p-6 md:p-10">
    <!-- Dashboard -->
    <section id="dashboard">
      <h1 class="text-3xl font-bold mb-4 text-gray-800 flex items-center gap-2">
        <i class="fas fa-chart-line text-indigo-600"></i>Dashboard
      </h1>
      <p class="text-gray-600">Bienvenue sur votre tableau de bord admin.</p>
    </section>

    <!-- Formulaire -->
    <section id="ajouter-produit" class="hidden">
      <h1 class="text-3xl font-bold mb-6 text-gray-800 flex items-center gap-2">
        <i class="fas fa-plus text-indigo-600"></i>Ajouter un produit
      </h1>
      <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" 
            class="space-y-6 bg-white p-6 rounded-2xl shadow-lg border border-gray-200 transition hover:shadow-2xl">
        @csrf
        <div>
          <label class="block font-semibold text-gray-700 mb-1">Titre</label>
          <input type="text" name="title" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-500" required>
        </div>
        <div>
          <label class="block font-semibold text-gray-700 mb-1">Description</label>
          <textarea name="description" rows="4" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-500" required></textarea>
        </div>
        <div>
          <label class="block font-semibold text-gray-700 mb-1">Images</label>
          <input type="file" name="images[]" multiple class="w-full border rounded-lg p-3">
        </div>
        <div>
          <label class="block font-semibold text-gray-700 mb-1">Prix de départ (€)</label>
          <input type="number" step="0.01" name="starting_price" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-500" required>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block font-semibold text-gray-700 mb-1">Début</label>
            <input type="datetime-local" name="start_time" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-500" required>
          </div>
          <div>
            <label class="block font-semibold text-gray-700 mb-1">Fin</label>
            <input type="datetime-local" name="end_time" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-500" required>
          </div>
        </div>
        <button type="submit" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-xl shadow hover:scale-105 transition">➕ Ajouter</button>
      </form>
    </section>

    <!-- Tableau -->
    <section id="lister-produits" class="hidden">
      <h1 class="text-3xl font-bold mb-6 text-gray-800 flex items-center gap-2">
        <i class="fas fa-list text-indigo-600"></i>Liste des produits
      </h1>
      <div class="overflow-x-auto rounded-xl shadow-lg">
        <table class="w-full text-left border-collapse">
          <thead class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
            <tr>
              <th class="p-3">ID</th>
              <th class="p-3">Titre</th>
              <th class="p-3">Photos</th>
              <th class="p-3">Prix départ</th>
              <th class="p-3">Début</th>
              <th class="p-3">Fin</th>
              <th class="p-3">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @foreach($products as $product)
            <tr class="hover:bg-gray-50 transition">
              <td class="p-3">{{ $product->id }}</td>
              <td class="p-3 font-medium text-gray-700">{{ $product->title }}</td>
              <td class="p-3 flex gap-2 flex-wrap">
                @if($product->images)
                  @foreach($product->images as $img)
                    <img src="{{ asset('storage/'.$img) }}" class="w-14 h-14 object-cover rounded-lg border">
                  @endforeach
                @else
                  <span class="text-gray-400">Aucune</span>
                @endif
              </td>
              <td class="p-3">{{ $product->starting_price }} €</td>
              <td class="p-3">{{ $product->start_time->format('d/m/Y H:i') }}</td>
              <td class="p-3">{{ $product->end_time->format('d/m/Y H:i') }}</td>
              <td class="p-3 flex gap-2">
                <button onclick="openEditModal({{ $product->id }})" 
                        class="px-4 py-2 bg-yellow-500 text-white rounded-lg shadow hover:scale-105 transition">✏ Modifier</button>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Supprimer ce produit ?');">
                  @csrf @method('DELETE')
                  <button class="px-4 py-2 bg-red-600 text-white rounded-lg shadow hover:scale-105 transition">🗑 Supprimer</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <!-- Modal -->
  <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-2xl w-11/12 md:w-2/3 lg:w-1/2 p-8 relative animate-fadeIn">
      <h2 class="text-2xl font-bold mb-6 text-gray-800">Modifier le produit</h2>
      <form id="editForm" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf @method('PUT')
        <input type="hidden" id="editProductId">
        <div>
          <label class="block font-semibold text-gray-700 mb-1">Titre</label>
          <input type="text" id="editTitle" name="title" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-500">
        </div>
        <div>
          <label class="block font-semibold text-gray-700 mb-1">Description</label>
          <textarea id="editDescription" name="description" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-500"></textarea>
        </div>
        <div>
          <label class="block font-semibold text-gray-700 mb-1">Prix de départ (€)</label>
          <input type="number" id="editPrice" name="starting_price" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-500">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block font-semibold text-gray-700 mb-1">Début</label>
            <input type="datetime-local" id="editStart" name="start_time" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-500">
          </div>
          <div>
            <label class="block font-semibold text-gray-700 mb-1">Fin</label>
            <input type="datetime-local" id="editEnd" name="end_time" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-500">
          </div>
        </div>
        <div>
          <label class="block font-semibold text-gray-700 mb-1">Nouvelles images</label>
          <input type="file" name="images[]" multiple class="w-full border rounded-lg p-3">
        </div>
        <div class="flex justify-end gap-3 pt-4">
          <button type="button" onclick="closeEditModal()" class="px-6 py-3 bg-gray-400 text-white rounded-lg hover:scale-105 transition">Annuler</button>
          <button type="submit" class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg shadow hover:scale-105 transition">💾 Enregistrer</button>
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
    function openEditModal(id) {
      fetch(`/products/${id}/edit`)
        .then(res => res.json())
        .then(data => {
          document.getElementById('editProductId').value = data.id;
          document.getElementById('editTitle').value = data.title;
          document.getElementById('editDescription').value = data.description;
          document.getElementById('editPrice').value = data.starting_price;
          document.getElementById('editStart').value = data.start_time.replace(' ', 'T');
          document.getElementById('editEnd').value = data.end_time.replace(' ', 'T');
          const form = document.getElementById('editForm');
          form.action = `/products/${id}`;
          document.getElementById('editModal').classList.remove('hidden');
        });
    }
    function closeEditModal() {
      document.getElementById('editModal').classList.add('hidden');
    }
  </script>
</body>
</html>
