@extends('layouts.app')

@section('title', 'À propos - Lavanty.mg | Enchères de Luxe à Madagascar')

@section('content')
<style>
@import url("https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap");

/* === GLOBAL === */
.about-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 5rem 1rem;
    font-family: "DM Sans", sans-serif; /* ✅ Police globale */
    color: #333;
    background: #fff; /* fond blanc premium */
    line-height: 1.7;
}

/* === TITRES === */
.about-header h1,
.about-intro-text h2,
.about-values h2,
.value-card h3,
.about-team h2,
.team-member h4,
.about-cta h3 {
    font-family: "Playfair Display", serif; /* ✅ Police élégante */
    font-weight: 700;
    color: #002f6c;
}

/* HEADER */
.about-header {
    text-align: center;
    margin-bottom: 4rem;
}

.about-header h1 {
    font-size: 3rem;
    margin-bottom: 1rem;
    letter-spacing: 1px;
}

.about-header p {
    font-size: 1.15rem;
    color: #555;
    max-width: 750px;
    margin: 0 auto;
    line-height: 1.7;
}

/* SEPARATOR STYLE */
.divider {
    width: 80px;
    height: 4px;
    background: #d4af37;
    border-radius: 5px;
    margin: 1.5rem auto 3rem;
}

/* SECTION INTRO */
.about-intro {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 3rem;
    margin-bottom: 6rem;
}

.about-intro img {
    width: 100%;
    max-width: 500px;
    border-radius: 20px;
    box-shadow: 0 10px 35px rgba(0,0,0,0.08);
    transition: transform 0.5s ease;
}

.about-intro img:hover {
    transform: scale(1.03);
}

.about-intro-text {
    flex: 1;
    min-width: 300px;
}

.about-intro-text p {
    font-size: 1.05rem;
    color: #444;
    line-height: 1.8;
    margin-bottom: 1.2rem;
}

/* VALEURS */
.about-values {
    text-align: center;
    padding: 4rem 0;
    background: #f9f9f9;
    border-radius: 20px;
}

.about-values h2 {
    font-size: 2.2rem;
    margin-bottom: 2rem;
}

.values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
}

.value-card {
    background: #fff;
    border-radius: 18px;
    padding: 2.5rem 1.5rem;
    box-shadow: 0 8px 25px rgba(0,0,0,0.06);
    transition: all 0.3s ease;
}

.value-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.value-card h3 {
    color: #d4af37; /* accent doré */
    margin-bottom: 0.8rem;
}

.value-card p {
    color: #555;
    font-size: 1rem;
    line-height: 1.6;
}

/* ÉQUIPE */
.about-team {
    margin-top: 6rem;
    text-align: center;
}

.about-team h2 {
    font-size: 2.2rem;
    margin-bottom: 2.5rem;
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.team-member {
    background: #fff;
    border-radius: 18px;
    padding: 1.5rem;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.team-member:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.12);
}

.team-member img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    border-radius: 14px;
    margin-bottom: 1rem;
}

.team-member p {
    color: #666;
    font-size: 0.95rem;
    font-family: "DM Sans", sans-serif;
}

/* CTA */
.about-cta {
    text-align: center;
    margin-top: 5rem;
}

.about-cta h3 {
    font-size: 1.7rem;
    margin-bottom: 1rem;
}

.about-btn {
    display: inline-block;
    padding: 0.8rem 1.8rem;
    background: #002f6c;
    color: #fff;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.3s ease;
    font-family: "DM Sans", sans-serif;
}

.about-btn:hover {
    background: #d4af37;
    color: #002f6c;
}

/* RESPONSIVE */
@media (max-width: 992px) {
    .about-intro {
        flex-direction: column-reverse;
        text-align: center;
    }
    .about-intro img {
        max-width: 100%;
    }
}
@media (max-width: 480px) {
    .about-header h1 {
        font-size: 2.2rem;
    }
    .about-intro-text h2 {
        font-size: 1.5rem;
    }
}
</style>


<section class="about-container">

    <header class="about-header">
        <h1>À propos de Lavanty.mg</h1>
        <div class="divider"></div>
        <p>
            Lavanty.mg est la première plateforme d’<strong>enchères de luxe à Madagascar</strong>.  
            Notre mission est de rapprocher les passionnés, collectionneurs et marques d’exception à travers une expérience d’enchères digitale moderne et transparente.
        </p>
    </header>

    <div class="about-intro">
        <div class="about-intro-text">
            <h2>Notre vision du luxe connecté</h2>
            <p>
                Chez <strong>Lavanty.mg</strong>, le luxe est avant tout une émotion, un héritage et une promesse de qualité.  
                Nous croyons en un marché où authenticité, innovation et passion se rencontrent pour sublimer les objets rares.
            </p>
            <p>
                Nous souhaitons devenir la <strong>référence des ventes aux enchères haut de gamme à Madagascar</strong>, 
                tout en soutenant les artisans et créateurs locaux qui incarnent l’excellence malgache.
            </p>
        </div>

        <img src="https://plus.unsplash.com/premium_photo-1681487977919-306ef7194d98?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1170" 
             alt="Présentation Lavanty.mg">
    </div>

    <div class="about-values">
        <h2>Nos valeurs</h2>
        <div class="values-grid">
            <div class="value-card">
                <h3>✨ Excellence</h3>
                <p>Chaque produit proposé sur Lavanty.mg est sélectionné avec rigueur et répond aux plus hauts standards de qualité.</p>
            </div>
            <div class="value-card">
                <h3>🤝 Confiance</h3>
                <p>Nous plaçons la transparence et la fiabilité au cœur de chaque enchère, pour un climat de confiance durable.</p>
            </div>
            <div class="value-card">
                <h3>🚀 Innovation</h3>
                <p>Grâce à la technologie, nous réinventons la façon de vendre et d’acquérir des biens d’exception à Madagascar.</p>
            </div>
        </div>
    </div>

    <div class="about-team">
        <h2>Notre équipe</h2>
        <div class="team-grid">
            <div class="team-member">
                <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=600&q=80" alt="Fondateur Lavanty">
                <h4>Jean Rakoto</h4>
                <p>Fondateur & PDG</p>
            </div>
            <div class="team-member">
                <img src="https://images.unsplash.com/photo-1607746882042-944635dfe10e?auto=format&fit=crop&w=600&q=80" alt="Directrice Marketing">
                <h4>Sarah Ando</h4>
                <p>Directrice Marketing</p>
            </div>
            <div class="team-member">
                <img src="https://images.unsplash.com/photo-1552058544-f2b08422138a?auto=format&fit=crop&w=600&q=80" alt="Responsable Technique">
                <h4>Michel Ranaivo</h4>
                <p>Responsable Technique</p>
            </div>
        </div>
    </div>

    <div class="about-cta">
        <h3>Envie d’en savoir plus ?</h3>
        <a href="{{ route('blog') }}" class="about-btn">Découvrir notre blog</a>
    </div>

</section>
@endsection
