@extends('layouts.app')

@section('title', 'Accueil - Lavanty.mg | Enchères de Luxe à Madagascar')

@section('content')

<!-- HERO SECTION -->
<section id="top" class="relative bg-cover bg-center h-[90vh]" 
    style="background-image: url('https://c0.wallpaperflare.com/preview/450/707/805/gavel-auction-hammer-justice.jpg');">
    <div class="absolute inset-0 bg-[#002f6c]/80 backdrop-blur-sm"></div>
    <div class="relative z-10 flex flex-col items-center justify-center text-center text-white h-full px-6">
        <h1 class="text-5xl md:text-7xl font-extrabold leading-tight mb-6 tracking-wider drop-shadow-lg">
            Enchères de <span class="text-[#ffd700]">Prestige</span> à Madagascar
        </h1>
        <p class="text-lg md:text-2xl mb-8 max-w-3xl text-gray-200 font-light">
            Participez à des ventes exclusives de biens rares et d’exception.  
            <span class="text-[#ffd700] font-semibold">Lavanty.mg</span> — l’élégance et la confiance dans chaque mise.
        </p>
        <a href="#produits" 
           class="bg-[#ffd700] text-[#002f6c] font-semibold px-10 py-4 rounded-full shadow-2xl hover:bg-yellow-500 hover:scale-110 transition-all duration-300">
            🔥 Découvrir les enchères
        </a>
    </div>
</section>

<!-- PRODUITS EN VEDETTE -->
<section id="produits" class="container mx-auto px-6 py-24">
    <h2 class="text-4xl md:text-5xl font-extrabold text-center text-[#002f6c] mb-16 tracking-wide uppercase">
        Nouveaux Produits en Enchère
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">
        @forelse($products as $product)
            <a href="{{ route('product.detail', ['id' => $product->id]) }}" 
               class="group block relative bg-white/80 backdrop-blur-lg rounded-3xl overflow-hidden shadow-[0_10px_30px_rgba(0,0,0,0.15)] 
                      border border-[#ffd700]/20 transition-all duration-500 hover:-translate-y-3 hover:shadow-[0_15px_40px_rgba(0,0,0,0.3)]">

                <!-- Image produit -->
                <div class="relative overflow-hidden">
                    @php
                        $image = $product->images 
                            ? (is_array($product->images) ? $product->images[0] : json_decode($product->images, true)[0] ?? null)
                            : null;
                    @endphp
                    <img src="{{ $image ? asset('storage/'.$image) : 'https://via.placeholder.com/400x300?text=Image+non+disponible' }}" 
                         alt="{{ $product->title }}" 
                         class="w-full h-72 object-cover transition-transform duration-700 group-hover:scale-110">

                    <div class="absolute inset-0 bg-gradient-to-t from-[#002f6c]/70 via-transparent opacity-0 group-hover:opacity-100 transition-all duration-500"></div>

                    <!-- Statut -->
                    @if($product->status == 'en_cours')
                        <span class="absolute top-4 left-4 bg-[#ffd700] text-[#002f6c] text-xs font-semibold px-3 py-1 rounded-full shadow">
                            🔥 Enchère en cours
                        </span>
                    @elseif($product->status == 'a_venir')
                        <span class="absolute top-4 left-4 bg-gray-600 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
                            ⏳ À venir
                        </span>
                    @else
                        <span class="absolute top-4 left-4 bg-[#002f6c] text-[#ffd700] text-xs font-semibold px-3 py-1 rounded-full shadow">
                            ✅ Terminé
                        </span>
                    @endif
                </div>

                <!-- Infos produit -->
                <div class="p-8 text-center">
                    <h3 class="text-2xl font-bold text-[#002f6c] mb-3">{{ $product->title }}</h3>
                    <p class="text-gray-600 mb-3 text-sm leading-relaxed">
                        {{ Str::limit($product->description, 90) }}
                    </p>
                    <p class="text-lg font-semibold text-[#ffd700] mb-6">
                        Misez dès {{ number_format($product->starting_price, 0, ',', ' ') }} Ar
                    </p>

                    <!-- Countdown -->
                    <div class="countdown flex justify-center gap-5 bg-[#002f6c]/5 backdrop-blur-sm px-4 py-3 rounded-2xl" 
                         data-end="{{ $product->end_time->format('Y-m-d\TH:i:s') }}">
                        <div>
                            <p class="text-xl font-bold text-[#002f6c] days">00</p>
                            <span class="text-xs text-gray-500">Jours</span>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-[#ffd700] hours">00</p>
                            <span class="text-xs text-gray-500">Heures</span>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-[#002f6c] minutes">00</p>
                            <span class="text-xs text-gray-500">Minutes</span>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-[#ffd700] seconds">00</p>
                            <span class="text-xs text-gray-500">Secondes</span>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-3 text-center py-16">
                <p class="text-gray-600 text-lg">
                    😢 Aucun produit disponible pour le moment.  
                    <br>
                    <span class="text-[#002f6c] font-semibold">Revenez bientôt pour découvrir de nouvelles enchères d’exception.</span>
                </p>
            </div>
        @endforelse
    </div>
</section>

<!-- PRODUITS ADJUGÉS -->
<section id="produits-adjuge" class="bg-[#f9fafb] py-24">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl md:text-5xl font-extrabold text-center text-[#002f6c] mb-16 uppercase tracking-wide">
            Produits Adjugés
        </h2>

        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @php $hasAdjuges = false; @endphp
                @foreach($productsAdjug as $product)
                    @if($product->status === 'adjugé')
                        @php $hasAdjuges = true; @endphp
                        <div class="swiper-slide">
                            <div class="bg-white/90 backdrop-blur-md rounded-3xl overflow-hidden border border-[#ffd700]/30 shadow-lg 
                                        hover:-translate-y-2 hover:shadow-2xl transition-all duration-500">
                                <div class="relative">
                                    @php
                                        $images = $product->images 
                                            ? (is_array($product->images) ? $product->images : json_decode($product->images, true)) 
                                            : [];
                                    @endphp

                                    <img src="{{ count($images) > 0 ? asset('storage/'.$images[0]) : 'https://via.placeholder.com/400x300' }}" 
                                         alt="{{ $product->title }}" 
                                         class="w-full h-64 object-cover group-hover:scale-110 transition duration-700">
                                    <span class="absolute top-4 left-4 bg-[#002f6c] text-[#ffd700] text-xs font-bold px-3 py-1 rounded-full shadow">
                                        ✅ Adjugé
                                    </span>
                                </div>

                                <div class="p-6 text-center">
                                    <h3 class="text-xl font-bold text-[#002f6c] mb-2">{{ $product->title }}</h3>
                                    @php $lastBid = $product->bids()->orderByDesc('amount')->first(); @endphp
                                    <p class="text-gray-600">
                                        Adjugé à <span class="font-semibold text-[#ffd700]">
                                            {{ $lastBid ? number_format($lastBid->amount, 0, ',', ' ') : number_format($product->starting_price, 0, ',', ' ') }} Ar
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                @if(!$hasAdjuges)
                    <div class="text-center py-16 w-full">
                        <p class="text-gray-600 text-lg">
                            😢 Aucun produit adjugé pour le moment.  
                            <br>
                            <span class="text-[#002f6c] font-semibold">Revenez bientôt pour voir les ventes prestigieuses.</span>
                        </p>
                    </div>
                @endif
            </div>

            <div class="swiper-pagination mt-6"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="bg-gradient-to-r from-[#002f6c] to-[#001b3f] py-24 text-center text-white">
    <h2 class="text-3xl md:text-4xl font-extrabold mb-6">🚀 Rejoignez Lavanty.mg</h2>
    <p class="text-lg mb-8 max-w-2xl mx-auto text-gray-200">
        Devenez membre de la plateforme d’enchères la plus <span class="text-[#ffd700] font-semibold">prestigieuse</span> de Madagascar.  
        Une expérience de <span class="text-[#ffd700] font-semibold">confiance</span> et d’<span class="text-[#ffd700] font-semibold">excellence</span>.
    </p>
    <a href="#top" 
       class="bg-[#ffd700] text-[#002f6c] font-bold px-10 py-4 rounded-full shadow-2xl hover:bg-yellow-500 hover:scale-110 transition">
       Créez un compte gratuit
    </a>
</section>

<!-- SwiperJS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script>
  var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    autoplay: { delay: 4000, disableOnInteraction: false },
    pagination: { el: ".swiper-pagination", clickable: true },
    navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
    breakpoints: { 640: { slidesPerView: 1 }, 768: { slidesPerView: 2 }, 1024: { slidesPerView: 3 } },
  });

  // Countdown
    // ✅ Countdown avec couleur dynamique (rouge si <24h, noir sinon)
  document.querySelectorAll('.countdown').forEach(card => {
    const endTime = new Date(card.dataset.end).getTime();
    const daysEl = card.querySelector(".days");
    const hoursEl = card.querySelector(".hours");
    const minutesEl = card.querySelector(".minutes");
    const secondsEl = card.querySelector(".seconds");

    // fonction utilitaire pour appliquer la couleur à tous les <p>
    function setCountdownColor(color) {
      card.querySelectorAll("p").forEach(el => {
        el.style.setProperty("color", color, "important");
      });
    }

    function updateCountdown() {
      const now = new Date().getTime();
      const diff = endTime - now;
      if (diff <= 0) {
        daysEl.textContent = "0";
        hoursEl.textContent = "0";
        minutesEl.textContent = "0";
        secondsEl.textContent = "0";
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

      // 🔥 Couleur dynamique :
      // moins de 24 heures → rouge
      // plus de 24 heures → noir
      if (diff < 24 * 60 * 60 * 1000) {
        setCountdownColor("red");
      } else {
        setCountdownColor("black");
      }

      requestAnimationFrame(updateCountdown);
    }

    updateCountdown();
  });

</script>
@endsection
