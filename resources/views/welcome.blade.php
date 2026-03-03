@extends('layouts.app')

@section('title', 'Accueil - Lavanty.mg | Enchères de Luxe à Madagascar')

@section('content')

<!-- Font Awesome -->
<style>
/* 🎨 Palette : bleu #001a3f | or #ffd700 | vert #00b853 | gris clair #f5f5f5 */
@import url("https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&family=Rubik:wght@400;600;700&display=swap");

/* 🌐 Typographie globale */
body {
  font-family: "Nunito", sans-serif;
  color: #001a3f;
  background: #fff;
  line-height: 1.6;
}

/* 📰 Titres (h1 à h6) */
h1, h2, h3, h4, h5, h6 {
  font-family: "Rubik", sans-serif;
  font-weight: 700;
  color: #001a3f;
}

/* HERO SECTION MODERNE STYLE STARTUP */
.hero-section {
  position: relative;
  min-height: 95vh;
  display: flex;
  align-items: center;
  padding: 0 8%;
  overflow: hidden;
  color: white;
}

/* 🔥 On garde ton image */
.hero-overlay {
  position: absolute;
  inset: 0;
  background:
    linear-gradient(
      110deg,
      rgba(0,15,40,0.95) 0%,
      rgba(0,26,63,0.9) 40%,
      rgba(0,26,63,0.75) 65%,
      rgba(0,0,0,0.5) 100%
    ),
    url('https://c0.wallpaperflare.com/preview/450/707/805/gavel-auction-hammer-justice.jpg') center/cover no-repeat;
  z-index: 1;
}

/* Container */
.hero-container {
  position: relative;
  z-index: 2;
  width: 100%;
  display: grid;
  grid-template-columns: 1fr 1fr;
  align-items: center;
}

/* LEFT */
.hero-left {
  max-width: 600px;
}

.hero-badge {
  display: inline-block;
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,255,255,0.25);
  padding: 8px 22px;
  border-radius: 40px;
  font-size: 12px;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: #ffffff;
  backdrop-filter: blur(10px);
  margin-bottom: 25px;
}
.hero-left h1 {
  font-size: 4rem;
  line-height: 1.05;
  font-weight: 800;
  margin-bottom: 25px;
  color: #ffffff;
  text-shadow: 0 4px 25px rgba(0,0,0,0.4);
}

.hero-left h1 span {
  background: linear-gradient(135deg, #ffd700, #ffb800);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.hero-desc {
  font-size: 1.15rem;
  color: #e6e6e6;
  margin-bottom: 40px;
  max-width: 520px;
}

/* Effet glow premium derrière la carte */
.hero-card::before {
  content: "";
  position: absolute;
  width: 180px;
  height: 80px;
  background: radial-gradient(circle, rgba(255,215,0,0.6) 0%, rgba(255,215,0,0.3) 40%, transparent 70%);
  bottom: 40px;
  left: -60px;
  filter: blur(25px);
  z-index: -1;
}

/* BUTTONS (les tiens gardés) */
.hero-buttons {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
}

/* RIGHT SIDE DECORATION */
.hero-right {
  position: relative;
  width: 100%;
  height: 450px;
  display: flex;
  justify-content: center;
  align-items: center;
}


/* Grand cercle flou */
.hero-circle.big {
  position: absolute;
  width: 450px;
  height: 450px;
  background: radial-gradient(circle, rgba(0,184,83,0.25) 0%, rgba(0,184,83,0.05) 60%, transparent 80%);
  border-radius: 50%;
  filter: blur(40px);
}

/* Cartes décoratives */
/* Carte commune */
.hero-card {
  position: absolute;
  width: 250px;
  height: 300px;
  background: rgba(255,255,255,0.08);
  backdrop-filter: blur(18px);
  border-radius: 30px;
  border: 1px solid rgba(255,255,255,0.25);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
  overflow: hidden;
  transition: all 0.4s ease;
}

/* 🟢 BAS GAUCHE */
.hero-card.bottom {
  bottom: 40px;
  left: 40px;
  animation: floatLeft 6s ease-in-out infinite;
}

/* 🔵 HAUT DROITE */
.hero-card.top {
  top: 40px;
  right: 40px;
  animation: floatRight 6s ease-in-out infinite;
}

/* Animation premium */
@keyframes floatLeft {
  0%,100% { transform: translateY(0); }
  50% { transform: translateY(-15px); }
}

@keyframes floatRight {
  0%,100% { transform: translateY(0); }
  50% { transform: translateY(15px); }
}

/* Hover premium */
.hero-card:hover {
  transform: scale(1.05);
  box-shadow: 0 25px 50px rgba(0,0,0,0.35);
}


/* Style bouton */
.hero-card-btn {
  background: linear-gradient(135deg, #ffd700, #ffcd00);
  color: #001a3f;
  padding: 12px 20px;
  border-radius: 40px;
  font-weight: 600;
  font-size: 0.9rem;
  text-decoration: none;
  transition: all .3s ease;
  box-shadow: 0 6px 20px rgba(255,215,0,0.3);
}

.hero-card-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 25px rgba(255,215,0,0.5);
}

/* Version outline */
.hero-card-btn.outline {
  background: transparent;
  border: 2px solid white;
  color: white;
  box-shadow: none;
}

.hero-card-btn.outline:hover {
  background: rgba(255,255,255,0.15);
}



.hero-card:hover {
  transform: translateY(-10px) scale(1.03);
  box-shadow: 0 20px 40px rgba(0,0,0,0.3);
}


/* Responsive */
@media (max-width: 992px) {
  .hero-container {
    grid-template-columns: 1fr;
    text-align: center;
  }

  .hero-right {
    display: none;
  }

  .hero-left h1 {
    font-size: 2.5rem;
  }
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
  font-family: "Rubik", sans-serif;
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
  font-family: "Rubik", sans-serif;
  font-size: 2.5rem;
  margin-bottom: 60px;
  text-transform: uppercase;
  text-align: left;
}
.section h2 i { color: #ffd700; margin-right: 10px; }

/* ============================= */
/* 🟨 AUCTION CARD STYLE EXACT */
/* ============================= */

#produits {
  background: #f3f4f6;
}

.product-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 28px;
  max-width: 1200px;
  margin: 0 auto;
}

@media (max-width: 1024px) {
  .product-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 640px) {
  .product-grid { grid-template-columns: 1fr; }
}

.product-card {
  background: #ffffff;
  border-radius: 22px;
  padding: 22px;
  transition: all .3s ease;
  border: 1px solid #e5e7eb;
  height: 440px; /* 🔥 hauteur premium */
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.product-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

/* IMAGE */
.product-image {
  height: 250px; /* 🔥 image plus grande */
  border-radius: 16px;
  overflow: hidden;
  margin-bottom: 16px;
}

.product-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* CATEGORY */
.product-category {
  font-size: 12px;
  color: #9ca3af;
  display: block;
  margin-bottom: 6px;
}

/* TITLE */
.product-title {
  font-size: 19px;
  font-weight: 700;
  margin-bottom: 16px;
}

.product-title a {
  text-decoration: none;
  color: #111827;
  transition: .2s;
}

.product-card:hover .product-title a {
  color: #7c3aed;
  text-decoration: underline;
}

/* META */
.product-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 13px;
  color: #6b7280;
  padding-bottom: 14px;
  border-bottom: 1px solid #e5e7eb;
}

.meta-left,
.meta-right {
  display: flex;
  align-items: center;
  gap: 6px;
}

.product-meta strong {
  color: #111;
  font-weight: 600;
}

/* BOTTOM */
.product-bottom {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 18px;
}

/* PRICE */
.price {
  font-size: 25px;
  font-weight: 800;
  color: #001a3f;
}

/* BUTTON */
.btn-bid-modern {
  display: flex;
  align-items: center;
  gap: 10px;
  background: #ffffff;
  border: 1px solid #d1d5db;
  border-radius: 40px;
  padding: 8px 16px 8px 18px;
  font-size: 13px;
  font-weight: 600;
  color: #111;
  text-decoration: none;
  transition: all .25s ease;
}

/* Petit cercle flèche */
.btn-bid-modern i {
  width: 28px;
  height: 28px;
  background: #f3f4f6;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 12px;
  transition: .25s ease;
}

/* Hover violet comme image */
.product-card:hover .btn-bid-modern {
  background: #7c3aed;
  color: white;
  border-color: #7c3aed;
}

.product-card:hover .btn-bid-modern i {
  background: white;
  color: #7c3aed;
}


/* 🟪 SECTION CATÉGORIE */
#categories {
  background: #fff;
  padding: 100px 8%;
  text-align: center;
}
#categories h2 {
  font-family: "Rubik", sans-serif;
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
  font-family: "Rubik", sans-serif;
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
  font-family: "Rubik", sans-serif;
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

/* 🟣 SECTION STATS INTÉGRÉE AU HERO */
.stats-section {
  position: relative;
  margin-top: -60px; /* 🔥 remonte dans la bannière */
  padding: 80px 8% 70px;
  background: linear-gradient(
      to bottom,
      rgba(0,26,63,0.95),
      rgba(0,26,63,1)
  );
  overflow: hidden;
}

/* 🔘 Cercle transparent élégant */
.stats-circle {
  position: absolute;
  top: -180px;
  left: 50%;
  transform: translateX(-50%);
  width: 380px;
  height: 380px;
  border-radius: 50%;
  border: 2px solid rgba(255,255,255,0.15);
  background: transparent;
  backdrop-filter: blur(3px);
}

/* Container */
.stats-container {
  position: relative;
  z-index: 2;
  display: flex;
  justify-content: center;
  gap: 35px;
  flex-wrap: wrap;
}

/* Cartes */
.stat-box {
  background: rgba(255,255,255,0.08);
  backdrop-filter: blur(15px);
  border: 1px solid rgba(255,255,255,0.15);
  padding: 20px 30px;
  border-radius: 16px;
  display: flex;
  align-items: center;
  gap: 15px;
  min-width: 220px;
  transition: all 0.4s ease;
}

.stat-box:hover {
  transform: translateY(-6px);
  background: rgba(255,255,255,0.15);
}

/* Icône */
.stat-icon {
  width: 55px;
  height: 55px;
  border-radius: 50%;
  background: rgba(255,215,0,0.15);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.4rem;
  color: #ffd700;
}

/* Texte */
.stat-number {
  margin: 0;
  font-size: 1.6rem;
  font-weight: 800;
  color: #ffffff;
}

.stat-box p {
  margin: 0;
  font-size: 0.85rem;
  color: #d1d5db;
}
</style>

<!-- 🟦 HERO SECTION -->
<section class="hero-section">
  <div class="hero-overlay"></div>

  <div class="hero-container">
    
    <!-- COLONNE GAUCHE -->
    <div class="hero-left">
      <p class="hero-badge">LAVANTY.MG — ENCHÈRES DE LUXE</p>

      <h1>
        Découvrez Votre Prochaine
        <span>Opportunité</span>
      </h1>

      <p class="hero-desc">
        Découvrez des trésors uniques et participez aux enchères
        en temps réel sur Lavanty.
      </p>

      <div class="hero-buttons">
        <a href="#produits" class="btn-primary">Commencer à Miser</a>
        <a href="{{ url('/products') }}" class="btn-secondary">Voir Toutes les Enchères</a>
      </div>
    </div>

    <!-- COLONNE DROITE (formes décoratives) -->
    <div class="hero-right">
  <div class="hero-circle big"></div>

  <div class="hero-card top">
    <a href="{{ url('/products') }}" class="hero-card-btn">
      Voir les produits
    </a>
  </div>

  <div class="hero-card bottom">
    <a href="{{ url('/products') }}" class="hero-card-btn outline">
      Explorer les enchères
    </a>
  </div>
</div>

  </div>
</section>
<!-- 🟣 SECTION STATISTIQUES -->
<section class="stats-section" id="stats">
    <div class="stats-circle"></div>

    <div class="stats-container">

        <div class="stat-box">
            <div class="stat-icon">
                <i class="fa-solid fa-users"></i>
            </div>
            <div>
                <h3 class="stat-number" data-target="5600">0</h3>
                <p>Happy Customer</p>
            </div>
        </div>

        <div class="stat-box">
            <div class="stat-icon">
                <i class="fa-solid fa-comment-dots"></i>
            </div>
            <div>
                <h3 class="stat-number" data-target="1375">0</h3>
                <p>Good Reviews</p>
            </div>
        </div>

        <div class="stat-box">
            <div class="stat-icon">
                <i class="fa-regular fa-face-smile"></i>
            </div>
            <div>
                <h3 class="stat-number" data-target="4690">0</h3>
                <p>Winner Customer</p>
            </div>
        </div>

        <div class="stat-box">
            <div class="stat-icon">
                <i class="fa-regular fa-message"></i>
            </div>
            <div>
                <h3 class="stat-number" data-target="790">0</h3>
                <p>New Comments</p>
            </div>
        </div>

    </div>
</section>

<!-- 🟨 SECTION COMMENT ÇA MARCHE (STYLE MODERNE) -->
<section id="how-it-works" class="how-modern">

  <div class="how-header">
    <span class="how-badge">
      <i class="fa-solid fa-diagram-project"></i>
      Comment ça marche
    </span>
    <h2>Comment Fonctionnent Nos Enchères</h2>
  </div>

  <div class="how-steps">

    <!-- STEP 1 -->
    <div class="how-step">
      <div class="step-dot"></div>
      <span class="step-bg">01</span>
      <h3>Inscription</h3>
      <p>
        Créez votre compte, validez votre profil et activez votre accès
        pour commencer à participer aux enchères.
      </p>
    </div>

    <!-- STEP 2 -->
    <div class="how-step">
      <div class="step-dot"></div>
      <span class="step-bg">02</span>
      <h3>Sélectionnez un produit</h3>
      <p>
        Explorez les catégories, consultez les détails
        et choisissez le lot qui vous intéresse.
      </p>
    </div>

    <!-- STEP 3 -->
    <div class="how-step">
      <div class="step-dot"></div>
      <span class="step-bg">03</span>
      <h3>Participez à l’enchère</h3>
      <p>
        Placez votre mise, suivez la progression
        et surenchérissez jusqu’à la clôture.
      </p>
    </div>

    <!-- STEP 4 -->
    <div class="how-step">
      <div class="step-dot"></div>
      <span class="step-bg">04</span>
      <h3>Effectuez le paiement</h3>
      <p>
        Si vous remportez l’enchère, finalisez le paiement
        et recevez votre bien en toute sécurité.
      </p>
    </div>

  </div>
</section>

<!-- 💅 STYLES -->
<style>

  /* ============================= */
/* 🟨 HOW IT WORKS - MODERNE */
/* ============================= */

.how-modern {
  background: #f5f7fa;
  padding: 110px 8%;
  text-align: center;
}

/* HEADER */
.how-header {
  margin-bottom: 80px;
}

.how-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 13px;
  font-weight: 600;
  color: #6b7280;
  margin-bottom: 15px;
}

.how-badge i {
  color: #00b853;
}

.how-modern h2 {
  font-size: 2.8rem;
  font-family: "Rubik", sans-serif;
  font-weight: 800;
  color: #111;
}

/* STEPS WRAPPER */
.how-steps {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 50px;
  position: relative;
}

/* STEP */
.how-step {
  position: relative;
  padding-top: 40px;
  text-align: center;
}

/* Petit point vert */
.step-dot {
  width: 14px;
  height: 14px;
  background: #00b853;
  border-radius: 50%;
  margin: 0 auto 25px;
}

/* Gros numéro en fond */
.step-bg {
  position: absolute;
  top: 10px;
  left: 50%;
  transform: translateX(-50%);
  font-size: 100px;
  font-weight: 900;
  color: rgba(0,0,0,0.04);
  z-index: 0;
  pointer-events: none;
}

/* Titre */
.how-step h3 {
  position: relative;
  z-index: 2;
  font-size: 1.2rem;
  font-weight: 700;
  margin-bottom: 15px;
  color: #111827;
}

/* Texte */
.how-step p {
  position: relative;
  z-index: 2;
  font-size: 0.95rem;
  color: #6b7280;
  line-height: 1.6;
  max-width: 250px;
  margin: 0 auto;
}

/* Responsive */
@media (max-width: 768px) {
  .how-modern h2 {
    font-size: 2rem;
  }

  .step-bg {
    font-size: 70px;
  }
}
.how-section {
  background: #fff;
  padding: 100px 8%;
  text-align: center;
}
.how-section h2 {
  font-family: "Rubik", sans-serif;
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
  font-family: "Rubik", sans-serif;
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

<!-- 🟪 CATÉGORIES D’ENCHÈRES - VERSION AVEC TITRES -->
<section id="categories" class="categories-modern">

  <!-- HEADER -->
  <div class="categories-header">
    <span class="categories-badge">
      <i class="fa-solid fa-layer-group"></i>
      Nos Catégories
    </span>

    <h2>Explorez Nos Univers d’Enchères</h2>

    <p>
      Découvrez une sélection exclusive de catégories soigneusement choisies
      pour vous offrir des opportunités uniques et prestigieuses.
    </p>
  </div>

  <!-- BLOCS CATÉGORIES -->
  <div class="categories-wrapper">

    <a href="{{ url('/products') }}?category=Mobilier" class="cat-item active">
      <i class="fa-solid fa-couch"></i>
      <span>Mobilier</span>
    </a>

    <a href="{{ url('/products') }}?category=Voitures" class="cat-item">
      <i class="fa-solid fa-car"></i>
      <span>Voitures</span>
    </a>

    <a href="{{ url('/products') }}?category=Equipements" class="cat-item">
      <i class="fa-solid fa-toolbox"></i>
      <span>Équipements</span>
    </a>

    <a href="{{ url('/products') }}?category=High tech" class="cat-item">
      <i class="fa-solid fa-microchip"></i>
      <span>High-Tech</span>
    </a>

  </div>

</section>

<style>
  /* ============================= */
/* 🟪 CATÉGORIES STYLE MODERNE */
/* ============================= */

.categories-modern {
  padding: 100px 8%;
  background: #f5f7fa;
  text-align: center;
}

/* HEADER */
.categories-header {
  max-width: 700px;
  margin: 0 auto 60px auto;
}

.categories-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 13px;
  font-weight: 600;
  color: #00b853;
  margin-bottom: 15px;
}

.categories-modern h2 {
  font-size: 2.6rem;
  font-family: "Rubik", sans-serif;
  font-weight: 800;
  color: #111827;
  margin-bottom: 15px;
}

.categories-header p {
  color: #6b7280;
  font-size: 1rem;
  line-height: 1.6;
}

/* WRAPPER */
.categories-wrapper {
  display: flex;
  max-width: 1000px;
  margin: 0 auto;
  background: #ffffff;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 6px 25px rgba(0,0,0,0.06);
}

/* ITEM */
.cat-item {
  flex: 1;
  padding: 45px 20px;
  text-align: center;
  text-decoration: none;
  font-family: "Rubik", sans-serif;
  font-weight: 600;
  color: #444;
  background: #f3f4f6;
  border-right: 1px solid #e5e7eb;
  transition: all 0.3s ease;
}

.cat-item:last-child {
  border-right: none;
}

.cat-item i {
  display: block;
  font-size: 2rem;
  margin-bottom: 15px;
  transition: 0.3s;
}

.cat-item span {
  display: block;
  font-size: 1rem;
}

/* Hover */
.cat-item:hover {
  background: #e5e7eb;
}

.cat-item:hover i {
  transform: scale(1.1);
}

/* ACTIVE */
.cat-item.active {
  background: #00b853;
  color: white;
}

.cat-item.active i {
  color: white;
}

/* Responsive */
@media (max-width: 768px) {
  .categories-wrapper {
    flex-direction: column;
  }

  .cat-item {
    border-right: none;
    border-bottom: 1px solid #e5e7eb;
  }

  .cat-item:last-child {
    border-bottom: none;
  }

  .categories-modern h2 {
    font-size: 2rem;
  }
}
</style>

<!-- 🟨 PRODUITS EN COURS -->
<section id="produits" class="section">
  <h2>Enchères en Cours</h2>

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
              </div>

              <span class="product-category">
                  {{ $product->category ?? 'Accessories, Electronics' }}
              </span>

              <h3 class="product-title">
                  <a href="{{ route('product.detail', ['id' => $product->id]) }}">
                      {{ $product->title }}
                  </a>
              </h3>

              <div class="product-meta">
                  <div class="meta-left">
                      <i class="fa-regular fa-clock"></i>
                      Closes in:
                      <strong class="countdown-inline" data-end="{{ $product->end_time }}">
                          00d 00h 00m 00s
                      </strong>
                  </div>

                  <div class="meta-right">
                      <i class="fa-solid fa-chart-line"></i>
                      Bids: <strong>{{ $product->bids()->count() }}</strong>
                  </div>
              </div>

              <div class="product-bottom">
                  <div class="price">
                      {{ number_format($product->starting_price, 0, ',', ' ') }} Ar
                  </div>

                  <a href="{{ route('product.detail', ['id' => $product->id]) }}" class="btn-bid-modern">
                      Place a bid
<i class="fa-solid fa-arrow-right"></i>                  </a>
              </div>

          </div>

      @empty
          <p class="no-product">Aucun produit en cours.</p>
      @endforelse
  </div>
</section>


<!-- 🟩 PRODUITS ADJUGÉS -->
<!-- <section id="produits-adjuge" class="section light"> -->
  <!-- <h2><i class="fa-solid fa-trophy"></i> Produits Adjugés</h2> -->
  <!-- <h2>Produits Adjugés</h2>

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
</section> -->

<!-- 🟫 SECTION À PROPOS / GET TO KNOW
<section id="about" class="about-section">
  <div class="about-container">
    
    <div class="about-image">
      <img src="https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1000&q=80" alt="Vintage Car Auction">
    </div>

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
</section> -->

<!-- 🟧 SECTION ENCHÈRES À VENIR -->
<section id="upcoming-auctions" class="popular-section">

    @php
        $upcomingProducts = $products->where('status','à_venir')->take(3);
    @endphp

    <!-- HEADER -->
    <div class="popular-header">
        <span class="mini-badge">
            <i class="fa-solid fa-cube"></i>
            Sélection Exclusive
        </span>
        <h2>Nos Produits à Venir</h2>
        <p>Participez prochainement à nos enchères exclusives et découvrez des opportunités uniques.</p>
    </div>

    @if($upcomingProducts->count() > 0)

    <div class="popular-layout">

        <!-- IMAGE GAUCHE UNSPLASH -->
        <div class="popular-big">
            <img src="https://plus.unsplash.com/premium_photo-1726718415593-ac5b610787a7?q=80&w=1120&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Enchère de luxe">
        </div>

        <!-- COLONNE DROITE -->
        <div class="popular-right">

            @foreach($upcomingProducts as $product)

            @php
                $image = $product->images 
                    ? (is_array($product->images) ? $product->images[0] : json_decode($product->images, true)[0] ?? null)
                    : null;
            @endphp

            <div class="popular-card">

                <div class="popular-thumb">
                    <img src="{{ $image ? asset('storage/'.$image) : 'https://images.unsplash.com/photo-1606813907291-d86efa9b94db?auto=format&fit=crop&w=400&q=80' }}">
                </div>

                <div class="popular-content">

                    <h4>{{ $product->title }}</h4>

                    <div class="meta">
                        <span>Référence : {{ $product->id }}</span>
                    </div>

                    <div class="meta light">
                        <span>
                            <i class="fa-regular fa-clock"></i>
                            Se termine dans :
                            <strong class="countdown-inline" data-end="{{ $product->end_time }}">
                                00j 00h 00m 00s
                            </strong>
                        </span>

                        <span>
                            <i class="fa-solid fa-chart-line"></i>
                            Offres : {{ $product->bids()->count() }}
                        </span>
                    </div>

                    <div class="bottom">
                        <div class="price">
                            {{ number_format($product->starting_price,0,',',' ') }} Ar
                        </div>

                        <a href="{{ route('product.detail',$product->id) }}" class="btn-bid">
                            Enchérir
                            <span class="circle">
                                <i class="fa-solid fa-arrow-right"></i>
                            </span>
                        </a>
                    </div>

                </div>
            </div>

            @endforeach

            <!-- BOUTON -->
            <div class="explore-wrapper">
                <a href="{{ url('/products') }}" class="btn-explore">
                    Voir toutes les enchères
                    <span class="circle">
                        <i class="fa-solid fa-arrow-right"></i>
                    </span>
                </a>
            </div>

        </div>
    </div>

    @else

    <!-- AUCUN PRODUIT -->
    <div class="no-upcoming-state">
        <div class="emoji">⏳</div>
        <h3>Aucune enchère à venir pour le moment</h3>
        <p>De nouvelles ventes exclusives seront bientôt disponibles. Restez connectés et consultez régulièrement notre plateforme.</p>
        <a href="{{ url('/products') }}" class="btn-explore">
            Découvrir les enchères en cours
            <span class="circle">
                <i class="fa-solid fa-arrow-right"></i>
            </span>
        </a>
    </div>

    @endif

</section>

<!-- 💅 STYLE -->
<style>
  /* Etat vide */
.no-upcoming-state{
  text-align:center;
  padding:80px 20px;
  background:white;
  border-radius:25px;
  max-width:700px;
  margin:0 auto;
  box-shadow:0 8px 25px rgba(0,0,0,0.05);
}

.no-upcoming-state .emoji{
  font-size:3rem;
  margin-bottom:15px;
}

.no-upcoming-state h3{
  font-size:1.5rem;
  margin-bottom:10px;
}

.no-upcoming-state p{
  color:#6b7280;
  margin-bottom:25px;
}
/* ============================= */
/* 🔥 POPULAR AUCTION FULL LAYOUT */
/* ============================= */

.popular-section{
  background:#eef0f4;
  padding:110px 8%;
}

/* HEADER */
.popular-header{
  text-align:center;
  margin-bottom:70px;
}

.mini-badge{
  font-size:13px;
  font-weight:600;
  color:#7c3aed;
  display:inline-flex;
  align-items:center;
  gap:8px;
  margin-bottom:10px;
}

.popular-header h2{
  font-size:2.5rem;
  font-family:"Rubik",sans-serif;
  margin-bottom:10px;
}

.popular-header p{
  color:#6b7280;
  font-size:0.95rem;
}

/* LAYOUT */
.popular-layout{
  display:grid;
  grid-template-columns: 1.2fr 1fr;
  gap:40px;
  align-items:start;
}

/* LEFT BIG IMAGE */
.popular-big{
  background:#dcdcdc;
  border-radius:30px;
  overflow:hidden;
  height:620px;
}

.popular-big img{
  width:100%;
  height:100%;
  object-fit:cover;
}

/* RIGHT SIDE */
.popular-right{
  display:flex;
  flex-direction:column;
  gap:20px;
}

/* CARD */
.popular-card{
  background:white;
  border-radius:20px;
  padding:18px;
  display:flex;
  gap:18px;
  align-items:center;
  box-shadow:0 6px 20px rgba(0,0,0,0.05);
  transition:.3s;
}

.popular-card:hover{
  transform:translateY(-4px);
  box-shadow:0 12px 30px rgba(0,0,0,0.08);
}

.popular-thumb{
  width:110px;
  height:110px;
  border-radius:18px;
  overflow:hidden;
  background:#dcdcdc;
}

.popular-thumb img{
  width:100%;
  height:100%;
  object-fit:cover;
}

.popular-content{
  flex:1;
}

.popular-content h4{
  font-size:1rem;
  font-weight:700;
  margin-bottom:6px;
}

.meta{
  display:flex;
  justify-content:space-between;
  font-size:12px;
  color:#6b7280;
  margin-bottom:6px;
}

.meta.light{
  color:#8b8b8b;
}

.bottom{
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-top:10px;
}

.price{
  font-size:1.2rem;
  font-weight:800;
}

/* BUTTON */
.btn-bid{
  display:flex;
  align-items:center;
  gap:10px;
  background:#ffffff;
  border:1px solid #d1d5db;
  padding:7px 15px;
  border-radius:30px;
  font-size:12px;
  font-weight:600;
  text-decoration:none;
  color:#111;
  transition:.3s;
}

.circle{
  width:26px;
  height:26px;
  border-radius:50%;
  background:#f3f4f6;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:11px;
}

.popular-card:hover .btn-bid{
  background:#7c3aed;
  color:white;
  border-color:#7c3aed;
}

.popular-card:hover .circle{
  background:white;
  color:#7c3aed;
}

/* EXPLORE BUTTON */
.explore-wrapper{
  margin-top:20px;
  text-align:center;
}

.btn-explore{
  display:inline-flex;
  align-items:center;
  gap:12px;
  background:#7c3aed;
  color:white;
  padding:12px 28px;
  border-radius:40px;
  font-weight:600;
  text-decoration:none;
  transition:.3s;
}

.btn-explore .circle{
  background:white;
  color:#7c3aed;
}

.btn-explore:hover{
  transform:translateY(-3px);
  box-shadow:0 10px 25px rgba(124,58,237,0.4);
}

/* RESPONSIVE */
@media(max-width:992px){
  .popular-layout{
    grid-template-columns:1fr;
  }
  .popular-big{
    height:350px;
  }
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
  font-family: "Rubik", sans-serif;
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

<!-- 
<section id="testimonials" class="section light">
  <div class="container">
    <div class="testimonial-header" data-aos="fade-down">
      <h2><strong>Ce que disent nos</strong> <em>clients</em></h2>
      <p>Ils partagent leur expérience après avoir participé à nos enchères sur <strong>Lavanty.mg</strong></p>
    </div>

    <div class="testimonial-grid" data-aos="fade-up">

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
 -->
<style>
.section.light {
  background: #fff;
  padding: 100px 8%;
  text-align: center;
}

.testimonial-header h2 {
  font-family: "Rubik", sans-serif;
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
document.querySelectorAll('.countdown-inline').forEach(el => {

    const endTime = new Date(el.dataset.end).getTime();

    function update() {
        const now = new Date().getTime();
        const diff = endTime - now;

        if (diff <= 0) {
            el.innerHTML = "Ended";
            return;
        }

        const d = Math.floor(diff / (1000 * 60 * 60 * 24));
        const h = Math.floor((diff / (1000 * 60 * 60)) % 24);
        const m = Math.floor((diff / (1000 * 60)) % 60);
        const s = Math.floor((diff / 1000) % 60);

        el.innerHTML = `${d}d ${h}h ${m}m ${s}s`;

        requestAnimationFrame(update);
    }

    update();
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
<script>
document.addEventListener("DOMContentLoaded", function () {

  const counters = document.querySelectorAll(".stat-number");
  const speed = 120;

  const animate = (counter) => {
    const target = +counter.getAttribute("data-target");
    let count = 0;

    const update = () => {
      const increment = target / speed;
      count += increment;

      if (count < target) {
        counter.innerText = Math.ceil(count).toLocaleString();
        requestAnimationFrame(update);
      } else {
        counter.innerText = target.toLocaleString() + "+";
      }
    };

    update();
  };

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        counters.forEach(counter => animate(counter));
        observer.disconnect();
      }
    });
  }, { threshold: 0.4 });

  observer.observe(document.querySelector("#stats"));

});
</script>
@endsection
