@extends('layouts.app')

@section('title', 'Accueil - Lavanty.mg | Enchères de Luxe à Madagascar')

@section('content')

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
/* 🎨 Palette : bleu #001a3f | or #ffd700 | vert #00b853 | gris clair #f5f5f5 */
@import url("https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap");

/* 🌐 Typographie globale */
body {
  font-family: "DM Sans", sans-serif;
  color: #001a3f;
  background: #fff;
  line-height: 1.6;
}

/* 📰 Titres (h1 à h6) */
h1, h2, h3, h4, h5, h6 {
  font-family: "Playfair Display", sans-serif;
  font-weight: 700;
  color: #001a3f;
}

/* HERO SECTION */
.hero-section {
  position: relative;
  height: 95vh;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  background: linear-gradient(to bottom, rgba(0, 0, 0, 0.4), rgba(0, 26, 63, 0.6)); /* 💡 plus de transparence */
  color: white;
  overflow: hidden;
}

.hero-overlay {
  position: absolute;
  inset: 0;
  background: url('https://c0.wallpaperflare.com/preview/450/707/805/gavel-auction-hammer-justice.jpg') center/cover;
  opacity: 0.8; /* 🔥 image bien visible */
  z-index: 1;
}



.hero-content { position: relative; z-index: 10; max-width: 800px; padding: 20px;z-index: 2; }
.hero-badge {
  display: inline-block;
  background: rgba(255,255,255,0.1);
  border: 1px solid rgba(255,255,255,0.2);
  padding: 8px 20px;
  border-radius: 30px;
  text-transform: uppercase;
  font-size: 12px;
  letter-spacing: 2px;
  margin-bottom: 20px;
}
.hero-badge i { color: #ffd700; margin-right: 6px; }
.hero-content h1 {
  font-size: 3.5rem;
  font-family: 'Playfair Display', serif;
  margin-bottom: 15px;
}
.gold-text { color: #ffd700; }
.hero-desc { color: #eaeaea; font-size: 1.1rem; margin-bottom: 30px; }

.hero-buttons a {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 15px 35px;
  border-radius: 50px;
  font-weight: bold;
  transition: all .3s ease;
  text-decoration: none;
}
.btn-primary { background: #ffd700; color: #001a3f; }
.btn-primary:hover { background: #ffcd00; transform: scale(1.05); }
.btn-secondary { border: 2px solid white; color: white; }
.btn-secondary:hover { background: rgba(255,255,255,0.1); }

/* SECTION */
.section { padding: 100px 8%; text-align: left; background: white; }
.section.light { background: #f9fafb; }
.section h2 {
  font-family: 'Playfair Display', serif;
  font-size: 2.5rem;
  margin-bottom: 60px;
  text-transform: uppercase;
  text-align: left;
}
.section h2 i { color: #ffd700; margin-right: 10px; }

/* PRODUITS */
.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
  gap: 25px;
  justify-items: start;
}
.product-card {
  background: white;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0,0,0,0.08);
  transition: transform .3s, box-shadow .3s;
  max-width: 300px;
  margin: 0; /* ❌ supprime le centrage auto */
}
.product-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}
.product-image {
  position: relative;
  height: 160px;
  overflow: hidden;
}
.product-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform .5s;
}
.product-card:hover img { transform: scale(1.08); }

.product-status {
  position: absolute;
  top: 10px;
  left: 10px;
  background: linear-gradient(to right, #e11d48, #b91c1c);
  color: white;
  padding: 5px 12px;
  border-radius: 20px;
  font-size: 12px;
}
.product-status.sold { background: linear-gradient(to right, #001a3f, #00397a); color: #ffd700; }

.countdown {
  display: flex;
  justify-content: space-around;
  padding: 8px 0;
  background: #fafafa;
  border-top: 1px solid #eee;
  font-size: 13px;
}
.countdown p { font-weight: bold; font-size: 16px; margin: 0; }
.countdown span { color: #666; font-size: 10px; }

.product-info { padding: 15px; text-align: left; }
.product-info h3 { font-size: 1rem; margin-bottom: 5px; color: #001a3f; }
.product-info .desc { color: #666; font-size: 0.85rem; margin-bottom: 8px; }
.product-info .price {
  color: #00b853;
  font-weight: bold;
  margin-bottom: 10px;
}
.product-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.lot {
  background: #e8f5e9;
  color: #00b853;
  padding: 4px 10px;
  border-radius: 15px;
  font-size: 11px;
}
.btn-bid {
  background: linear-gradient(to right, #001a3f, #00397a);
  color: white;
  padding: 6px 12px;
  border-radius: 8px;
  text-decoration: none;
  transition: 0.3s;
  font-size: 13px;
}
.btn-bid:hover { transform: scale(1.05); }

.no-product {
  text-align: center;
  color: #666;
  padding: 50px 0;
}

/* RESPONSIVE */
@media (max-width: 768px) {
  .hero-content h1 { font-size: 2.2rem; }
  .section { padding: 70px 5%; }
}

/* 🟪 SECTION CATÉGORIE */
#categories {
  background: #fff;
  padding: 100px 8%;
  text-align: center;
}
#categories h2 {
  font-family: 'Playfair Display', serif;
  font-size: 2.4rem;
  color: #001a3f;
  margin-bottom: 15px;
}
#categories h2 i {
  color: #ffd700;
  margin-right: 10px;
}
.category-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
  gap: 30px;
  margin-top: 50px;
}
.category-card {
  background: white;
  border-radius: 18px;
  padding: 40px 25px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  transition: all 0.3s ease;
  cursor: pointer;
  border: 1px solid #eee;
}
.category-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.12);
  border-color: #ffd700;
}
.category-icon {
  background: linear-gradient(to bottom right, #ffd700, #ffcd00);
  color: #001a3f;
  width: 80px;
  height: 80px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 20px auto;
  font-size: 2rem;
}
.category-card h3 {
  font-family: 'Playfair Display', serif;
  font-size: 1.3rem;
  margin-bottom: 8px;
  color: #001a3f;
}
.category-card p {
  color: #555;
  font-size: 0.95rem;
}

/* Responsive */
@media (max-width: 768px) {
  #categories {
    padding: 70px 5%;
  }
  .category-card {
    padding: 30px 20px;
  }
}

/* 🟫 SECTION ABOUT */
.about-section {
  background: #fff;
  padding: 100px 8%;
}
.about-container {
  display: grid;
  grid-template-columns: 1fr 1fr;
  align-items: center;
  gap: 50px;
}
.about-image img {
  width: 100%;
  border-radius: 16px;
  box-shadow: 0 6px 25px rgba(0,0,0,0.15);
}
.about-content h2 {
  font-size: 2.6rem;
  font-family: 'Playfair Display', serif;
  color: #001a3f;
  margin-bottom: 20px;
}
.about-content h2 .bold {
  font-weight: 800;
  color: #001a3f;
}
.about-content h2 em {
  font-style: italic;
  color: #666;
}
.about-desc {
  color: #444;
  font-size: 1rem;
  margin-bottom: 25px;
  line-height: 1.7;
}

.about-list {
  list-style: none;
  padding: 0;
  margin: 0 0 40px 0;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 10px 25px;
}
.about-list li {
  color: #333;
  font-size: 0.95rem;
  display: flex;
  align-items: center;
  gap: 10px;
}
.about-list i {
  color: #00b853;
  font-size: 1rem;
}

/* STATS */
.about-stats {
  display: flex;
  gap: 40px;
  flex-wrap: wrap;
  border-top: 1px solid #eee;
  padding-top: 30px;
}
.about-stats .stat {
  flex: 1;
  min-width: 120px;
  text-align: center;
}
.about-stats i {
  font-size: 1.8rem;
  color: #ffd700;
  margin-bottom: 8px;
}
.about-stats h3 {
  font-size: 1.6rem;
  font-weight: 700;
  margin: 0;
  color: #001a3f;
}
.about-stats p {
  color: #555;
  font-size: 0.9rem;
  margin-top: 4px;
}

/* RESPONSIVE */
@media (max-width: 992px) {
  .about-container {
    grid-template-columns: 1fr;
    text-align: center;
  }
  .about-list {
    grid-template-columns: 1fr;
  }
  .about-stats {
    justify-content: center;
  }
}
</style>

<!-- 🟦 HERO SECTION -->
<section class="hero-section">
  <div class="hero-overlay"></div>
  <div class="hero-content">
      <p class="hero-badge">
          <i class="fa-solid fa-crown"></i> LAVANTY.MG — L’EXCELLENCE DES ENCHÈRES DE LUXE
      </p>
      <h1><span class="gold-text">L’Art</span> de l’Enchère d’Exception</h1>
      <p class="hero-desc">Découvrez des trésors uniques, mis en valeur par l’élégance et la précision du luxe.</p>

      <div class="hero-buttons">
          <a href="#produits" class="btn-primary"><i class="fa-solid fa-gavel"></i> Commencer à Miser</a>
          <a href="{{ url('/products') }}" class="btn-secondary"><i class="fa-solid fa-box-open"></i> Voir Toutes les Enchères</a>
      </div>
  </div>
</section>

<!-- 🟨 PRODUITS EN COURS -->
<section id="produits" class="section">
  <h2><i class="fa-solid fa-hourglass-half"></i> Enchères en Cours</h2>
  <div class="product-grid">
      @forelse($products as $product)
          @php
              $image = $product->images 
                  ? (is_array($product->images) ? $product->images[0] : json_decode($product->images, true)[0] ?? null)
                  : null;
          @endphp

          <div class="product-card">
              <div class="product-image">
                  <img src="{{ $image ? asset('storage/'.$image) : 'https://via.placeholder.com/400x300?text=Produit' }}" alt="{{ $product->title }}">
                  <span class="product-status"><i class="fa-solid fa-fire"></i> En cours</span>
              </div>

              <div class="countdown" data-end="{{ $product->end_time }}">
                  <div><p class="days">00</p><span>Jours</span></div>
                  <div><p class="hours">00</p><span>Heures</span></div>
                  <div><p class="minutes">00</p><span>Minutes</span></div>
                  <div><p class="seconds">00</p><span>Secondes</span></div>
              </div>

              <div class="product-info">
                  <h3>{{ $product->title }}</h3>
                  <p class="desc">{{ Str::limit($product->description, 80) }}</p>
<p class="price"><i class="fa-solid fa-coins"></i> Prix de départ : {{ number_format($product->starting_price, 0, ',', ' ') }} Ar</p>
                  <div class="product-footer">
                      <span class="lot">Lot #{{ $product->id }}</span>
                      <a href="{{ route('product.detail', ['id' => $product->id]) }}" class="btn-bid"><i class="fa-solid fa-hammer"></i> Miser</a>
                  </div>
              </div>
          </div>
      @empty
          <p class="no-product">Aucun produit en cours.</p>
      @endforelse
  </div>
</section>

<!-- 🟪 CATÉGORIES D’ENCHÈRES -->
<section class="section light" id="categories">
  <h2><i class="fa-solid fa-layer-group"></i> Catégories d’Enchères</h2>
  <p class="mb-12 text-gray-600 text-center">
    Découvrez nos catégories phares et trouvez l’objet de vos envies.
  </p>

  <div class="category-grid">
    <!-- 🛋️ Mobilier -->
    <a href="{{ url('/products') }}?category=Mobilier" class="category-card">
      <div class="category-icon">
        <i class="fa-solid fa-couch"></i>
      </div>
      <h3>Mobilier</h3>
      <p>Enchères de meubles et décorations d’intérieur</p>
    </a>

    <!-- 🚗 Voitures -->
    <a href="{{ url('/products') }}?category=Voitures" class="category-card">
      <div class="category-icon">
        <i class="fa-solid fa-car"></i>
      </div>
      <h3>Voitures</h3>
      <p>Véhicules de prestige et collection</p>
    </a>

    <!-- 🧰 Équipements -->
    <a href="{{ url('/products') }}?category=Equipements" class="category-card">
      <div class="category-icon">
        <i class="fa-solid fa-toolbox"></i>
      </div>
      <h3>Équipements</h3>
      <p>Matériels professionnels et industriels</p>
    </a>

    <!-- 💻 High-Tech -->
    <a href="{{ url('/products') }}?category=High tech" class="category-card">
      <div class="category-icon">
        <i class="fa-solid fa-microchip"></i>
      </div>
      <h3>High-Tech</h3>
      <p>Technologie, multimédia et gadgets</p>
    </a>
  </div>
</section>


<!-- 🟩 PRODUITS ADJUGÉS -->
<section id="produits-adjuge" class="section light">
  <h2><i class="fa-solid fa-trophy"></i> Produits Adjugés</h2>

  @php $countAdjuges = $productsAdjug->where('status', 'adjugé')->count(); @endphp

  <div class="{{ $countAdjuges > 5 ? 'swiper mySwiper' : '' }}">
      <div class="{{ $countAdjuges > 5 ? 'swiper-wrapper' : 'flex flex-wrap gap-6 justify-start' }}">
          @php $hasAdjuges = false; @endphp
          @foreach($productsAdjug as $product)
              @if($product->status === 'adjugé')
                  @php $hasAdjuges = true; @endphp
                  <div class="{{ $countAdjuges > 5 ? 'swiper-slide' : '' }}">
                      <div class="product-card sold">
                          <div class="product-image">
                              @php
                                  $images = $product->images 
                                      ? (is_array($product->images) ? $product->images : json_decode($product->images, true)) 
                                      : [];
                              @endphp
                              <img src="{{ count($images) > 0 ? asset('storage/'.$images[0]) : 'https://via.placeholder.com/400x300' }}" alt="{{ $product->title }}">
                              <span class="product-status sold"><i class="fa-solid fa-medal"></i> Adjugé</span>
                          </div>

                          <div class="product-info center">
                              <h3>{{ $product->title }}</h3>
                              @php $lastBid = $product->bids()->orderByDesc('amount')->first(); @endphp
                              <p>Adjugé à <span class="price">{{ $lastBid ? number_format($lastBid->amount, 0, ',', ' ') : number_format($product->starting_price, 0, ',', ' ') }} Ar</span></p>
                          </div>
                      </div>
                  </div>
              @endif
          @endforeach

          @if(!$hasAdjuges)
              <div class="no-product">
                  <i class="fa-regular fa-face-frown"></i> Aucun produit adjugé pour le moment.
              </div>
          @endif
      </div>

      @if($countAdjuges > 5)
          <div class="swiper-pagination mt-6"></div>
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
      @endif
  </div>
</section>

<!-- 🟫 SECTION À PROPOS / GET TO KNOW -->
<section id="about" class="about-section">
  <div class="about-container">
    
    <!-- Image -->
    <div class="about-image">
      <img src="https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1000&q=80" alt="Vintage Car Auction">
    </div>

    <!-- Texte -->
    <div class="about-content">
      <h2><span class="bold">Get In</span> <em>Know</em></h2>
      <p class="about-desc">
        Bienvenue sur <strong>Lavanty.mg</strong>, où l’innovation et le luxe se rencontrent dans le monde des enchères d’exception.
        Découvrez un univers raffiné où chaque mise reflète le prestige, l’audace et la passion du beau.
      </p>

      <ul class="about-list">
        <li><i class="fa-solid fa-circle-check"></i> Enchérissez sur des objets rares et authentiques</li>
        <li><i class="fa-solid fa-circle-check"></i> Découvrez des ventes exclusives chaque semaine</li>
        <li><i class="fa-solid fa-circle-check"></i> Rejoignez une communauté d’acheteurs d’élite</li>
        <li><i class="fa-solid fa-circle-check"></i> Transformez vos acquisitions en investissements précieux</li>
        <li><i class="fa-solid fa-circle-check"></i> Explorez un service client sur mesure</li>
      </ul>

      <div class="about-stats">
        <div class="stat">
          <i class="fa-regular fa-face-smile"></i>
          <h3 class="counter" data-target="3500">0</h3>
          <p>Clients</p>
        </div>
        <div class="stat">
          <i class="fa-solid fa-gavel"></i>
          <h3 class="counter" data-target="700">0</h3>
          <p>Enchères</p>
        </div>
        <div class="stat">
          <i class="fa-solid fa-users"></i>
          <h3 class="counter" data-target="5600">0</h3>
          <p>Enchérisseurs</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- 🟨 SECTION COMMENT ÇA MARCHE -->
<section id="how-it-works" class="how-section">
  <h2><i class="fa-solid fa-diagram-project"></i> Comment <em>ça marche</em></h2>
  <p class="subtitle">Suivez ces étapes simples pour participer à nos enchères d’exception.</p>

  <div class="steps-wrapper">

    <!-- ÉTAPE 1 -->
    <div class="step-group" data-aos="fade-up" data-aos-delay="100">
      <div class="step-card step1">
        <div class="step-icon"><i class="fa-solid fa-id-card"></i></div>
        <p class="step-num">ÉTAPE 01</p>
        <h3>Inscription</h3>
        <ul>
          <li><strong>01.</strong> Renseignez vos informations</li>
          <li><strong>02.</strong> Validez votre profil</li>
          <li><strong>03.</strong> Activez votre compte</li>
        </ul>
      </div>
      <div class="arrow">
        <svg xmlns="http://www.w3.org/2000/svg" width="90" height="30" fill="none" viewBox="0 0 90 30">
          <path d="M0 15 C30 5, 60 25, 90 15" stroke="#0d9488" stroke-width="3" stroke-linecap="round" stroke-dasharray="6 6"/>
          <path d="M85 10 L90 15 L85 20" fill="#0d9488"/>
        </svg>
      </div>
    </div>

    <!-- ÉTAPE 2 -->
    <div class="step-group" data-aos="fade-up" data-aos-delay="200">
      <div class="step-card step2">
        <div class="step-icon"><i class="fa-solid fa-box-open"></i></div>
        <p class="step-num">ÉTAPE 02</p>
        <h3>Sélectionnez un produit</h3>
        <ul>
          <li><strong>01.</strong> Explorez les catégories</li>
          <li><strong>02.</strong> Consultez les détails</li>
          <li><strong>03.</strong> Choisissez votre lot</li>
        </ul>
      </div>
      <div class="arrow">
        <svg xmlns="http://www.w3.org/2000/svg" width="90" height="30" fill="none" viewBox="0 0 90 30">
          <path d="M0 15 C30 25, 60 5, 90 15" stroke="#e11d48" stroke-width="3" stroke-linecap="round" stroke-dasharray="6 6"/>
          <path d="M85 10 L90 15 L85 20" fill="#e11d48"/>
        </svg>
      </div>
    </div>

    <!-- ÉTAPE 3 -->
    <div class="step-group" data-aos="fade-up" data-aos-delay="300">
      <div class="step-card step3">
        <div class="step-icon"><i class="fa-solid fa-gavel"></i></div>
        <p class="step-num">ÉTAPE 03</p>
        <h3>Participez à l’enchère</h3>
        <ul>
          <li><strong>01.</strong> Placez votre mise</li>
          <li><strong>02.</strong> Surveillez la progression</li>
          <li><strong>03.</strong> Surenchérissez si nécessaire</li>
        </ul>
      </div>
      <div class="arrow">
        <svg xmlns="http://www.w3.org/2000/svg" width="90" height="30" fill="none" viewBox="0 0 90 30">
          <path d="M0 15 C30 5, 60 25, 90 15" stroke="#f59e0b" stroke-width="3" stroke-linecap="round" stroke-dasharray="6 6"/>
          <path d="M85 10 L90 15 L85 20" fill="#f59e0b"/>
        </svg>
      </div>
    </div>

    <!-- ÉTAPE 4 -->
    <div class="step-group" data-aos="fade-up" data-aos-delay="400">
      <div class="step-card step4">
        <div class="step-icon"><i class="fa-solid fa-wallet"></i></div>
        <p class="step-num">ÉTAPE 04</p>
        <h3>Effectuez le paiement</h3>
        <ul>
          <li><strong>01.</strong> Payez en toute sécurité</li>
          <li><strong>02.</strong> Recevez votre confirmation</li>
          <li><strong>03.</strong> Obtenez votre bien</li>
        </ul>
      </div>
    </div>

  </div>
</section>

<!-- 💅 STYLES -->
<style>
.how-section {
  background: #fff;
  padding: 100px 8%;
  text-align: center;
}
.how-section h2 {
  font-family: 'Playfair Display', serif;
  font-size: 2.5rem;
  margin-bottom: 15px;
  color: #001a3f;
}
.how-section h2 i { color: #ffd700; margin-right: 10px; }
.how-section h2 em { font-style: italic; color: #666; }
.how-section .subtitle {
  color: #555;
  font-size: 1rem;
  margin-bottom: 60px;
}

/* 🧭 Container aligné */
.steps-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 25px;
  flex-wrap: nowrap;
  overflow-x: auto;
  padding-bottom: 20px;
}
.step-group {
  display: flex;
  align-items: center;
  gap: 15px;
  flex: 1;
  min-width: 260px;
}
.step-card {
  flex: none;
  background: #fff;
  border-radius: 16px;
  padding: 40px 25px;
  text-align: left;
  box-shadow: 0 4px 20px rgba(0,0,0,0.05);
  border: 1px solid #eee;
  transition: all 0.3s ease;
  width: 260px;
}
.step-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}
.step-icon {
  width: 70px;
  height: 70px;
  border-radius: 15px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 2rem;
  margin-bottom: 20px;
}
.step1 { background: #fff7ed; }
.step1 .step-icon { background: #fef3c7; color: #f59e0b; }
.step2 { background: #ecfdf5; }
.step2 .step-icon { background: #d1fae5; color: #10b981; }
.step3 { background: #fff1f2; }
.step3 .step-icon { background: #ffe4e6; color: #e11d48; }
.step4 { background: #eff6ff; }
.step4 .step-icon { background: #dbeafe; color: #2563eb; }

.step-num {
  color: #94a3b8;
  font-weight: 700;
  font-size: 0.9rem;
  margin-bottom: 10px;
}
.step-card h3 {
  font-size: 1.3rem;
  color: #001a3f;
  font-family: 'Playfair Display', serif;
  margin-bottom: 15px;
}
.step-card ul {
  list-style: none;
  padding: 0;
  margin: 0;
}
.step-card ul li {
  font-size: 0.95rem;
  color: #444;
  padding: 6px 0;
  border-bottom: 1px solid rgba(0,0,0,0.05);
}

/* Flèches */
.arrow {
  flex-shrink: 0;
  width: 80px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.arrow svg path {
  stroke-dashoffset: 1000;
  animation: drawLine 2s ease forwards;
}
@keyframes drawLine {
  to { stroke-dashoffset: 0; }
}

/* Responsive */
@media (max-width: 992px) {
  .steps-wrapper {
    flex-direction: column;
    align-items: center;
  }
  .step-group {
    flex-direction: column;
  }
  .arrow {
    transform: rotate(90deg);
    margin: 10px 0;
  }
}
</style>

<!-- 🎬 ANIMATION LIBRARY -->
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css"/>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
  AOS.init({
    duration: 1000,
    once: true,
    offset: 100
  });
});
</script>
<!-- 🟧 SECTION ENCHÈRES À VENIR -->
<section id="upcoming-auctions" class="section light">
  <div class="container">
    <div class="header">
      <h2><i class="fa-solid fa-hourglass-start"></i> Enchères <em>à venir</em></h2>
      <p>Découvrez les ventes exclusives à venir sur Lavanty.mg</p>
    </div>

    <!-- Catégories -->
    <div class="categories">
      <button class="cat-btn active">Tout</button>
      <button class="cat-btn">Automobile</button>
      <button class="cat-btn">Antiquités</button>
      <button class="cat-btn">Art & Design</button>
      <button class="cat-btn">High-Tech</button>
      <button class="cat-btn">Mobilier</button>
    </div>

    <div class="upcoming-layout">
      <!-- Bannière gauche -->
      <aside class="banner">
        <img src="https://images.unsplash.com/photo-1502877338535-766e1452684a?auto=format&fit=crop&w=900&q=80" alt="Vintage car">
        <div class="banner-overlay"></div>
        <div class="banner-text">
          <h3><span>Véhicules</span> de Collection</h3>
          <p>Des voitures classiques et iconiques à découvrir bientôt.</p>
        </div>
      </aside>

      <!-- Grille des enchères -->
      <div class="upcoming-grid">
        @php $count = 0; @endphp
        @foreach($products as $product)
          @if($product->status === 'à_venir')
            @php
              $count++;
              $image = $product->images 
                  ? (is_array($product->images) ? $product->images[0] : json_decode($product->images, true)[0] ?? null)
                  : null;
            @endphp

            <div class="auction-card" data-aos="fade-up">
              <div class="auction-image">
                <img src="{{ $image ? asset('storage/'.$image) : 'https://via.placeholder.com/400x300?text=Produit+à+venir' }}" alt="{{ $product->title }}">
                <span class="status upcoming">À venir</span>
              </div>
              <div class="auction-info">
                <h4>{{ Str::limit($product->title, 30) }}</h4>
                <p class="price"><i class="fa-solid fa-coins"></i> {{ number_format($product->starting_price, 0, ',', ' ') }} Ar</p>
                <p class="lot">Lot #{{ $product->id }}</p>
                <button class="notify-btn" disabled>Notifier-moi</button>
              </div>
            </div>
          @endif
        @endforeach

        <!-- ✅ Aucun produit à venir -->
        @if($count === 0)
          <div class="no-upcoming" data-aos="zoom-in">
            <div class="emoji">😴</div>
            <h4>Aucune enchère à venir pour le moment</h4>
            <p>De nouvelles ventes exclusives seront bientôt disponibles. Restez connectés !</p>
          </div>
        @endif
      </div>
    </div>
  </div>
</section>

<!-- 💅 STYLE -->
<style>
.section.light {
  background: #f9f9f6;
  padding: 80px 7%;
}

/* Header */
.header { text-align: center; margin-bottom: 35px; }
.header h2 {
  font-family: 'Playfair Display', serif;
  font-size: 2.2rem;
  color: #001a3f;
}
.header h2 i { color: #ffd700; margin-right: 10px; }
.header em { font-style: italic; color: #777; }
.header p { color: #666; margin-top: 8px; }

/* Catégories */
.categories {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 10px;
  margin-bottom: 35px;
}
.cat-btn {
  border: 1px solid #ddd;
  background: #fff;
  color: #555;
  font-size: 0.85rem;
  padding: 6px 14px;
  border-radius: 20px;
  cursor: not-allowed;
  transition: .3s;
}
.cat-btn.active {
  background: #ffd700;
  color: #001a3f;
}

/* Layout */
.upcoming-layout {
  display: grid;
  grid-template-columns: 250px 1fr;
  gap: 30px;
  align-items: start;
}

/* Bannière */
.banner {
  position: relative;
  border-radius: 15px;
  overflow: hidden;
  height: 100%;
  min-height: 380px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}
.banner img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform .5s;
}
.banner:hover img { transform: scale(1.05); }
.banner-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(0,0,0,0.6), rgba(0,0,0,0.1));
}
.banner-text {
  position: absolute;
  bottom: 20px;
  left: 20px;
  color: white;
}
.banner-text h3 {
  font-family: 'Playfair Display', serif;
  font-size: 1.4rem;
  line-height: 1.3;
}
.banner-text span { color: #ffd700; }
.banner-text p {
  font-size: 0.9rem;
  color: #f3f3f3;
}

/* Grille produits */
.upcoming-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
  gap: 18px;
  justify-items: center;
}
.auction-card {
  background: #fff;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0,0,0,0.06);
  transition: all .3s;
  width: 180px;
  height: 240px;
  display: flex;
  flex-direction: column;
}
.auction-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 6px 14px rgba(0,0,0,0.1);
}
.auction-image {
  position: relative;
  height: 120px;
  overflow: hidden;
}
.auction-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.status.upcoming {
  position: absolute;
  top: 8px;
  left: 8px;
  background: #2563eb;
  color: white;
  padding: 3px 8px;
  border-radius: 8px;
  font-size: 10px;
  font-weight: 600;
}
.auction-info {
  padding: 8px 10px;
  text-align: left;
  flex-grow: 1;
}
.auction-info h4 {
  font-size: 0.85rem;
  color: #001a3f;
  font-weight: 600;
  margin-bottom: 4px;
}
.auction-info .price {
  color: #00b853;
  font-weight: 600;
  font-size: 0.8rem;
  margin-bottom: 3px;
}
.auction-info .lot {
  color: #888;
  font-size: 0.75rem;
  margin-bottom: 8px;
}
.notify-btn {
  background: #001a3f;
  color: #fff;
  padding: 4px 8px;
  border-radius: 6px;
  font-size: 0.75rem;
  border: none;
  opacity: 0.8;
  cursor: not-allowed;
}

/* 💤 Aucune enchère à venir */
.no-upcoming {
  grid-column: 1 / -1;
  text-align: center;
  color: #333;
  margin-top: 40px;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
}
.no-upcoming .emoji {
  font-size: 3rem;
  animation: float 2s ease-in-out infinite;
}
@keyframes float {
  0%,100% { transform: translateY(0); }
  50% { transform: translateY(-6px); }
}
.no-upcoming h4 {
  font-size: 1.1rem;
  font-weight: 600;
  color: #001a3f;
}
.no-upcoming p {
  font-size: 0.9rem;
  color: #666;
}

/* Responsive */
@media (max-width: 992px) {
  .upcoming-layout { grid-template-columns: 1fr; }
  .banner { height: 220px; min-height: unset; }
  .upcoming-grid { justify-content: center; }
}
</style>

<!-- 🎬 Animation -->
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css"/>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
  AOS.init({ duration: 700, once: true });
});
</script>


<!-- 🟦 SECTION FAQ (EN FRANÇAIS) -->
<section id="faq" class="section light">
  <div class="container">
    <div class="faq-header" data-aos="fade-down">
      <h2><strong>Foire aux</strong> <em>Questions</em></h2>
      <p>Trouvez ici les réponses aux questions les plus fréquentes concernant nos enchères sur Lavanty.mg</p>
    </div>

    <div class="faq-layout">
      <!-- Bloc gauche - Formulaire d'aide -->
      <aside class="faq-contact" data-aos="fade-right">
        <h3>Besoin d’aide ?<br><span>Écrivez-nous !</span></h3>
        <div class="icon">
          <i class="fa-solid fa-envelope-circle-check"></i>
        </div>
        <p class="mail-text">Pour nous contacter :</p>
        <a href="mailto:info@lavanty.mg" class="email">info@lavanty.mg</a>

        <form class="faq-form">
          <label>Une question ?</label>
          <input type="email" placeholder="Entrez votre adresse e-mail" required>
          <textarea placeholder="Rédigez votre question..." required></textarea>
          <button type="submit">Envoyer</button>
        </form>
      </aside>

      <!-- Bloc droit - Liste FAQ -->
      <div class="faq-list" data-aos="fade-left">
        <div class="faq-item">
          <button class="faq-question">Qu’est-ce qu’une enchère ? <span class="icon">+</span></button>
          <div class="faq-answer">Une enchère est une vente dans laquelle les acheteurs proposent des offres successives pour acquérir un bien. L’objet est attribué à la personne ayant fait la plus haute offre à la fin de la vente.</div>
        </div>

        <div class="faq-item">
          <button class="faq-question">Comment fonctionnent les enchères ? <span class="icon">+</span></button>
          <div class="faq-answer">Chaque produit mis en vente possède un prix de départ et une durée déterminée. Les utilisateurs peuvent placer des offres supérieures à la précédente jusqu’à la fin du compte à rebours.</div>
        </div>

        <div class="faq-item">
          <button class="faq-question">Quels types d’enchères propose Lavanty ? <span class="icon">+</span></button>
          <div class="faq-answer">Lavanty propose divers types d’enchères : automobiles, antiquités, œuvres d’art, objets de collection, produits high-tech et bien d’autres encore.</div>
        </div>

        <div class="faq-item">
          <button class="faq-question">Qui peut participer à une enchère ? <span class="icon">+</span></button>
          <div class="faq-answer">Toute personne inscrite sur Lavanty.mg peut participer, à condition d’avoir un compte vérifié et d’accepter nos conditions d’utilisation.</div>
        </div>

        <div class="faq-item">
          <button class="faq-question">Que se passe-t-il si je remporte une enchère ? <span class="icon">+</span></button>
          <div class="faq-answer">Si vous remportez une enchère, vous serez notifié immédiatement et invité à finaliser votre paiement. Une fois le règlement effectué, la livraison ou le retrait du bien sera organisé selon les conditions précisées.</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 💅 STYLE ÉLÉGANT -->
<style>
.section.light {
  background: #fdfcf9;
  padding: 90px 6%;
}

/* HEADER */
.faq-header {
  text-align: center;
  margin-bottom: 50px;
}
.faq-header h2 {
  font-size: 2.3rem;
  font-family: 'Playfair Display', serif;
  color: #001a3f;
}
.faq-header h2 strong { font-weight: 800; }
.faq-header h2 em {
  font-style: italic;
  color: #6b7280;
  font-weight: 400;
}
.faq-header p {
  color: #666;
  font-size: 0.95rem;
  margin-top: 10px;
}

/* LAYOUT PRINCIPAL */
.faq-layout {
  display: grid;
  grid-template-columns: 300px 1fr;
  gap: 40px;
  align-items: start;
}

/* BLOC GAUCHE */
.faq-contact {
  background: #fff5ed;
  padding: 25px;
  border-radius: 15px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.06);
  text-align: center;
}
.faq-contact h3 {
  font-size: 1.3rem;
  color: #001a3f;
  line-height: 1.4;
}
.faq-contact span { color: #2563eb; }
.faq-contact .icon {
  font-size: 2.5rem;
  color: #2563eb;
  margin: 15px 0;
}
.mail-text {
  color: #888;
  font-size: 0.9rem;
}
.email {
  display: block;
  color: #001a3f;
  font-weight: 600;
  text-decoration: none;
  margin-bottom: 20px;
}
.email:hover { text-decoration: underline; }
.faq-form {
  background: #f0f6ff;
  padding: 15px;
  border-radius: 12px;
}
.faq-form label {
  display: block;
  font-size: 0.85rem;
  color: #001a3f;
  text-align: left;
  margin-bottom: 8px;
  font-weight: 600;
}
.faq-form input,
.faq-form textarea {
  width: 100%;
  border: none;
  border-radius: 8px;
  padding: 8px 10px;
  font-size: 0.85rem;
  margin-bottom: 10px;
  outline: none;
}
.faq-form input { height: 35px; }
.faq-form textarea { resize: none; height: 70px; }
.faq-form button {
  width: 100%;
  background: #001a3f;
  color: white;
  border: none;
  border-radius: 6px;
  padding: 8px 0;
  font-size: 0.85rem;
  cursor: pointer;
  transition: background .3s;
}
.faq-form button:hover { background: #2563eb; }

/* FAQ LIST */
.faq-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
}
.faq-item {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  overflow: hidden;
  transition: .3s;
}
.faq-item.open { box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
.faq-question {
  background: transparent;
  border: none;
  width: 100%;
  text-align: left;
  font-size: 0.95rem;
  font-weight: 600;
  color: #001a3f;
  padding: 16px 20px;
  cursor: pointer;
  display: flex;
  justify-content: space-between;
  align-items: center;
  transition: .3s;
}
.faq-question:hover { background: #f7f8fa; }
.faq-answer {
  display: none;
  padding: 0 20px 15px;
  color: #555;
  font-size: 0.9rem;
  line-height: 1.5;
}
.faq-item.open .faq-answer { display: block; }
.faq-item.open .faq-question .icon { transform: rotate(45deg); }
.icon {
  transition: transform .3s;
  color: #2563eb;
  font-weight: bold;
}

/* RESPONSIVE */
@media (max-width: 992px) {
  .faq-layout {
    grid-template-columns: 1fr;
  }
  .faq-contact { max-width: 400px; margin: 0 auto; }
}
</style>

<!-- ⚙️ SCRIPT ACCORDÉON -->
<script>
document.querySelectorAll(".faq-question").forEach(btn => {
  btn.addEventListener("click", () => {
    const item = btn.parentElement;
    item.classList.toggle("open");
  });
});
</script>

<!-- 🎬 Animation (AOS) -->
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css"/>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({ duration: 700, once: true });
</script>

<!-- 💬 SECTION AVIS CLIENTS (3 EN HAUT + 2 EN BAS CENTRÉS) -->
<section id="testimonials" class="section light">
  <div class="container">
    <div class="testimonial-header" data-aos="fade-down">
      <h2><strong>Ce que disent nos</strong> <em>clients</em></h2>
      <p>Ils partagent leur expérience après avoir participé à nos enchères sur <strong>Lavanty.mg</strong></p>
    </div>

    <!-- Grille -->
    <div class="testimonial-grid" data-aos="fade-up">
      <!-- AVIS 1 -->
      <div class="testimonial-card">
        <div class="quote">“</div>
        <h4>Expérience exceptionnelle !</h4>
        <p>« Lavanty m’a permis de remporter une voiture rare à un prix imbattable. Les enchères sont passionnantes et bien encadrées. »</p>
        <div class="client">
          <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="client 1">
          <div>
            <h5>Jean Dupont</h5>
            <span>Collectionneur Automobile</span>
          </div>
        </div>
      </div>

      <!-- AVIS 2 -->
      <div class="testimonial-card">
        <div class="quote">“</div>
        <h4>Service impeccable</h4>
        <p>« L’équipe Lavanty m’a accompagné du début à la fin. Interface fluide, résultats rapides et transparence totale. »</p>
        <div class="client">
          <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="client 2">
          <div>
            <h5>Sarah Rakoto</h5>
            <span>Designer d’intérieur</span>
          </div>
        </div>
      </div>

      <!-- AVIS 3 -->
      <div class="testimonial-card">
        <div class="quote">“</div>
        <h4>Simple et efficace</h4>
        <p>« Le site est intuitif et les enchères bien organisées. J’ai adoré l’expérience, à refaire sans hésiter ! »</p>
        <div class="client">
          <img src="https://randomuser.me/api/portraits/men/68.jpg" alt="client 3">
          <div>
            <h5>Michel Andrianina</h5>
            <span>Antiquaire</span>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</section>

<!-- 💅 STYLE PREMIUM CENTRÉ -->
<style>
.section.light {
  background: #fff;
  padding: 100px 8%;
  text-align: center;
}

.testimonial-header h2 {
  font-family: 'Playfair Display', serif;
  font-size: 2.3rem;
  color: #001a3f;
  margin-bottom: 10px;
}
.testimonial-header strong { font-weight: 800; }
.testimonial-header em { color: #6b7280; font-style: italic; }
.testimonial-header p {
  color: #666;
  font-size: 1rem;
  margin-top: 10px;
  max-width: 650px;
  margin-inline: auto;
}

/* --- GRILLE --- */
.testimonial-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 30px;
  justify-items: center;
  max-width: 1200px;
  margin: 60px auto 0;
}

/* Ligne du bas centrée */
.testimonial-card.bottom {
  grid-column: span 1;
}
@media (min-width: 992px) {
  .testimonial-card.bottom:first-of-type {
    grid-column: 2 / 3; /* Centrer le 4e */
  }
  .testimonial-card.bottom:last-of-type {
    grid-column: 3 / 4; /* Centrer le 5e juste à côté */
  }
}

/* --- STYLE CARTE --- */
.testimonial-card {
  background: white;
  border-radius: 18px;
  padding: 30px 25px 25px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.08);
  text-align: left;
  transition: all 0.3s ease;
  position: relative;
  max-width: 360px;
}
.testimonial-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.12);
}

/* Citation */
.quote {
  font-size: 3.5rem;
  color: #2563eb;
  line-height: 0;
  position: absolute;
  top: 5px;
  right: 20px;
  opacity: 0.2;
}

/* Contenu */
.testimonial-card h4 {
  color: #2563eb;
  font-size: 1.05rem;
  font-weight: 700;
  margin-bottom: 10px;
}
.testimonial-card p {
  color: #444;
  font-size: 0.95rem;
  line-height: 1.6;
  margin-bottom: 20px;
  font-style: italic;
}

/* Client */
.client {
  display: flex;
  align-items: center;
  gap: 12px;
}
.client img {
  width: 55px;
  height: 55px;
  border-radius: 50%;
  object-fit: cover;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.client h5 {
  font-size: 1rem;
  color: #001a3f;
  margin: 0;
}
.client span {
  font-size: 0.85rem;
  color: #777;
}

/* Responsive */
@media (max-width: 992px) {
  .testimonial-grid {
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  }
  .testimonial-card { text-align: center; }
  .client { justify-content: center; }
}
</style>

<!-- 🎬 Animation -->
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css"/>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({ duration: 700, once: true });</script>



<!-- SwiperJS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

@if($countAdjuges > 5)
<script>
  new Swiper(".mySwiper", {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    autoplay: { delay: 4000, disableOnInteraction: false },
    pagination: { el: ".swiper-pagination", clickable: true },
    navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
    breakpoints: { 640: { slidesPerView: 1 }, 768: { slidesPerView: 2 }, 1024: { slidesPerView: 3 } },
  });
</script>
@endif

<script>
document.querySelectorAll('.countdown').forEach(card => {
  const endTime = new Date(card.dataset.end).getTime();
  function updateCountdown() {
    const now = new Date().getTime();
    const diff = endTime - now;
    if (diff <= 0) {
      card.querySelectorAll("p").forEach(p => p.textContent = "00");
      return;
    }
    const d = Math.floor(diff / (1000 * 60 * 60 * 24));
    const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
    const s = Math.floor((diff % (1000 * 60)) / 1000);
    card.querySelector(".days").textContent = d;
    card.querySelector(".hours").textContent = h;
    card.querySelector(".minutes").textContent = m;
    card.querySelector(".seconds").textContent = s;
    requestAnimationFrame(updateCountdown);
  }
  updateCountdown();
});

// 🔢 Animation des compteurs (count-up)
document.addEventListener("DOMContentLoaded", () => {
  const counters = document.querySelectorAll(".counter");
  const speed = 150; // vitesse d'animation (plus grand = plus lent)

  const animateCounters = () => {
    counters.forEach(counter => {
      const updateCount = () => {
        const target = +counter.getAttribute("data-target");
        const count = +counter.innerText;
        const increment = target / speed;

        if (count < target) {
          counter.innerText = Math.ceil(count + increment);
          setTimeout(updateCount, 20);
        } else {
          counter.innerText = target.toLocaleString() + "+";
        }
      };
      updateCount();
    });
  };

  // Déclenche l’animation uniquement quand la section est visible à l’écran
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCounters();
        observer.disconnect();
      }
    });
  }, { threshold: 0.3 });

  observer.observe(document.querySelector("#about"));
});
</script>
@endsection
