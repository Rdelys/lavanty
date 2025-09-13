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
    <aside class="w-64 bg-gradient-to-b from-indigo-700 to-purple-800 text-white flex flex-col p-5 shadow-lg">
        <!-- Logo -->
        <div class="text-2xl font-bold mb-10 flex items-center gap-2">
            <i class="fas fa-gem text-white text-2xl"></i>
            Admin Panel
        </div>

        <!-- Menu -->
        <nav class="flex-1 space-y-2">
            <a href="#dashboard" class="flex items-center gap-3 p-3 rounded-lg hover:bg-indigo-600 transition-colors duration-300">
                <i class="fas fa-tachometer-alt w-5"></i>
                <span class="flex-1">Dashboard</span>
            </a>

            <!-- Produits aux enchères -->
            <div>
                <button onclick="toggleSubmenu('produits')" class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-indigo-600 transition-colors duration-300">
                    <span class="flex items-center gap-3">
                        <i class="fas fa-box-open w-5"></i>
                        <span>Produits</span>
                    </span>
                    <i id="icon-produits" class="fas fa-chevron-down w-4 transition-transform duration-300"></i>
                </button>
                <div id="submenu-produits" class="ml-6 mt-1 space-y-1 hidden">
                    <a href="#ajouter-produit" class="block p-2 text-sm rounded hover:bg-indigo-500 transition-colors duration-300">➕ Ajouter</a>
                    <a href="#lister-produits" class="block p-2 text-sm rounded hover:bg-indigo-500 transition-colors duration-300">📋 Lister</a>
                </div>
            </div>

            <!-- Enchères -->
            <div>
                <button onclick="toggleSubmenu('enchere')" class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-indigo-600 transition-colors duration-300">
                    <span class="flex items-center gap-3">
                        <i class="fas fa-gavel w-5"></i>
                        <span>Enchères</span>
                    </span>
                    <i id="icon-enchere" class="fas fa-chevron-down w-4 transition-transform duration-300"></i>
                </button>
                <div id="submenu-enchere" class="ml-6 mt-1 space-y-1 hidden">
                    <a href="#prises" class="block p-2 text-sm rounded hover:bg-indigo-500 transition-colors duration-300">✅ Produits pris</a>
                    <a href="#non-prises" class="block p-2 text-sm rounded hover:bg-indigo-500 transition-colors duration-300">❌ Produits non pris</a>
                </div>
            </div>

            <!-- Déconnexion -->
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-3 w-full p-3 rounded-lg hover:bg-red-600 transition-colors duration-300 mt-5">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span>Déconnexion</span>
                </button>
            </form>
        </nav>
    </aside>

    <!-- Contenu principal -->
    <main class="flex-1 p-8">
        <section id="dashboard">
            <h1 class="text-3xl font-bold mb-4"><i class="fas fa-chart-line mr-2"></i>Dashboard</h1>
            <p class="text-gray-700">Bienvenue sur votre tableau de bord admin.</p>
        </section>

        <section id="ajouter-produit" class="hidden">
            <h1 class="text-3xl font-bold mb-4"><i class="fas fa-plus mr-2"></i>Ajouter un produit</h1>
            <p class="text-gray-700">Formulaire d’ajout de produit...</p>
        </section>

        <section id="lister-produits" class="hidden">
            <h1 class="text-3xl font-bold mb-4"><i class="fas fa-list mr-2"></i>Liste des produits</h1>
            <p class="text-gray-700">Table des produits aux enchères...</p>
        </section>

        <section id="prises" class="hidden">
            <h1 class="text-3xl font-bold mb-4"><i class="fas fa-check mr-2"></i>Produits pris</h1>
            <p class="text-gray-700">Produits déjà remportés par des enchérisseurs.</p>
        </section>

        <section id="non-prises" class="hidden">
            <h1 class="text-3xl font-bold mb-4"><i class="fas fa-times mr-2"></i>Produits non pris</h1>
            <p class="text-gray-700">Produits encore disponibles.</p>
        </section>
    </main>

    <!-- Script pour sous-menus et sections -->
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
    </script>

</body>
</html>
