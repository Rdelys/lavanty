@extends('layouts.app')

@section('title', 'Accueil - Lavanty.mg | Enchères de Luxe à Madagascar')

@section('content')

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
/* 🎨 Palette : bleu #001a3f | or #ffd700 | vert #00b853 | gris clair #f5f5f5 */

body {
  font-family: 'Poppins', sans-serif;
  color: #001a3f;
  background: #fff;
}

/* HERO SECTION */
.hero-section {
  position: relative;
  height: 95vh;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  background: linear-gradient(to bottom, #000, #001a3f, #002f6c);
  color: white;
  overflow: hidden;
}
.hero-overlay {
  position: absolute;
  inset: 0;
  background: url('https://c0.wallpaperflare.com/preview/450/707/805/gavel-auction-hammer-justice.jpg') center/cover;
  opacity: 0.25;
}
.hero-content { position: relative; z-index: 10; max-width: 800px; padding: 20px; }
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
  background: #f0f6ff;
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
    <div class="category-card">
      <div class="category-icon">
        <i class="fa-solid fa-couch"></i>
      </div>
      <h3>Mobilier</h3>
      <p>Enchères de meubles et décorations d’intérieur</p>
    </div>

    <div class="category-card">
      <div class="category-icon">
        <i class="fa-solid fa-car"></i>
      </div>
      <h3>Voitures</h3>
      <p>Véhicules de prestige et collection</p>
    </div>

    <div class="category-card">
      <div class="category-icon">
        <i class="fa-solid fa-toolbox"></i>
      </div>
      <h3>Équipements</h3>
      <p>Matériels professionnels et industriels</p>
    </div>

    <div class="category-card">
      <div class="category-icon">
        <i class="fa-solid fa-microchip"></i>
      </div>
      <h3>High-Tech</h3>
      <p>Technologie, multimédia et gadgets</p>
    </div>
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

    <!-- Catégories (affichées sans actions pour le moment) -->
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
      <div class="banner">
        <img src="https://images.unsplash.com/photo-1502877338535-766e1452684a?auto=format&fit=crop&w=900&q=80" alt="Vintage car">
        <div class="banner-text">
          <h3>Véhicules <span>de Collection</span></h3>
          <p>Découvrez les voitures classiques et iconiques qui ont marqué l’histoire.</p>
        </div>
      </div>

      <!-- Grille des enchères -->
      <div class="upcoming-grid">
        @foreach($products as $product)
          @if($product->status === 'à_venir')
            @php
              $image = $product->images 
                  ? (is_array($product->images) ? $product->images[0] : json_decode($product->images, true)[0] ?? null)
                  : null;
            @endphp

            <div class="auction-card" data-aos="fade-up">
              <div class="auction-image">
                <img src="{{ $image ? asset('storage/'.$image) : 'https://via.placeholder.com/648x463?text=Produit+à+venir' }}" alt="{{ $product->title }}">
                <span class="status upcoming">À venir</span>
              </div>
              <div class="auction-info">
                <h4>{{ $product->title }}</h4>
                <p class="price"><i class="fa-solid fa-coins"></i> Prix de départ : {{ number_format($product->starting_price, 0, ',', ' ') }} Ar</p>
                <p class="lot">Lot #{{ $product->id }}</p>
                <div class="actions">
                  <button class="notify-btn" disabled>Notifier-moi</button>
                </div>
              </div>
            </div>
          @endif
        @endforeach
      </div>
    </div>
  </div>
</section>

<!-- 💅 STYLES -->
<style>
.section.light {
  background: #fdfcf9;
  padding: 100px 8%;
}

.header {
  text-align: center;
  margin-bottom: 40px;
}
.header h2 {
  font-family: 'Playfair Display', serif;
  font-size: 2.5rem;
  color: #001a3f;
}
.header h2 i { color: #ffd700; margin-right: 10px; }
.header h2 em { font-style: italic; color: #666; }
.header p { color: #777; margin-top: 10px; }

/* Catégories */
.categories {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 12px;
  margin-bottom: 50px;
}
.cat-btn {
  border: 1px solid #ddd;
  padding: 10px 20px;
  border-radius: 25px;
  background: #fff;
  cursor: not-allowed;
  color: #888;
  font-weight: 500;
  transition: all .3s;
}
.cat-btn.active {
  background: #ffd700;
  color: #001a3f;
  cursor: default;
}

/* Layout principal */
.upcoming-layout {
  display: grid;
  grid-template-columns: 300px 1fr;
  gap: 40px;
}

/* Bannière */
.banner {
  position: relative;
  overflow: hidden;
  border-radius: 20px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
.banner img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  filter: brightness(0.75);
  transition: transform .5s;
}
.banner:hover img { transform: scale(1.05); }
.banner-text {
  position: absolute;
  bottom: 20px;
  left: 20px;
  color: white;
  max-width: 80%;
}
.banner-text h3 {
  font-family: 'Playfair Display', serif;
  font-size: 1.8rem;
  margin-bottom: 10px;
}
.banner-text span {
  color: #ffd700;
}
.banner-text p {
  font-size: 0.95rem;
  line-height: 1.5;
}

/* Grille produits */
.upcoming-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 25px;
}
.auction-card {
  background: white;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 3px 15px rgba(0,0,0,0.08);
  transition: transform .3s ease, box-shadow .3s ease;
}
.auction-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 20px rgba(0,0,0,0.12);
}
.auction-image {
  position: relative;
  height: 180px;
  overflow: hidden;
}
.auction-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.status.upcoming {
  position: absolute;
  top: 10px;
  left: 10px;
  background: #3b82f6;
  color: white;
  padding: 5px 12px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 600;
}
.auction-info {
  padding: 20px;
  text-align: left;
}
.auction-info h4 {
  font-size: 1.1rem;
  color: #001a3f;
  margin-bottom: 10px;
  font-weight: 600;
}
.auction-info .price {
  color: #00b853;
  font-weight: bold;
  margin-bottom: 5px;
}
.auction-info .lot {
  color: #777;
  font-size: 0.85rem;
  margin-bottom: 15px;
}
.notify-btn {
  background: #001a3f;
  color: white;
  padding: 8px 18px;
  border-radius: 8px;
  border: none;
  cursor: not-allowed;
  opacity: 0.7;
  font-size: 0.9rem;
}

/* Responsive */
@media (max-width: 992px) {
  .upcoming-layout {
    grid-template-columns: 1fr;
  }
  .banner {
    height: 260px;
  }
}
</style>
<script>
document.addEventListener("DOMContentLoaded", () => {
  AOS.init({
    duration: 800,
    once: true,
    offset: 100
  });
});
</script>


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
