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
</script>
@endsection
