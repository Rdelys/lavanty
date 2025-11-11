@extends('layouts.app')

@section('title', 'Blog - Lavanty.mg | Enchères de Luxe à Madagascar')

@section('content')
<style>
@import url("https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap");

/* === GLOBAL === */
.blog-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 3rem 1rem;
    font-family: "DM Sans", sans-serif; /* ✅ Police globale */
    color: #333;
    background: #fafafa;
    line-height: 1.7;
}

/* === TITRES === */
.blog-header h1,
.blog-content h2,
.blog-seo h3 {
    font-family: "Playfair Display", serif; /* ✅ Police des titres */
    font-weight: 700;
    color: #002f6c;
}

/* HEADER */
.blog-header {
    text-align: center;
    margin-bottom: 3rem;
}

.blog-header h1 {
    font-size: 2.8rem;
    color: #002f6c;
    font-weight: 800;
    margin-bottom: 1rem;
}

.blog-header p {
    font-size: 1.15rem;
    color: #555;
    max-width: 700px;
    margin: 0 auto;
}

/* GRID */
.blog-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

/* CARD */
.blog-card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
}

.blog-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.blog-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: transform 0.4s ease;
    background: #f0f0f0;
}

.blog-card:hover img {
    transform: scale(1.05);
}

/* CONTENT */
.blog-content {
    padding: 1.5rem;
}

.blog-meta {
    font-size: 0.85rem;
    color: #777;
    margin-bottom: 0.6rem;
    font-family: "DM Sans", sans-serif;
}

.blog-meta span {
    margin-right: 10px;
}

.blog-content h2 {
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 0.7rem;
    transition: color 0.3s ease;
}

.blog-card:hover h2 {
    color: #d4af37;
}

.blog-content p {
    font-size: 0.95rem;
    color: #555;
    line-height: 1.6;
    margin-bottom: 1rem;
}

/* BUTTON */
.blog-btn {
    display: inline-block;
    padding: 0.6rem 1.2rem;
    background: #002f6c;
    color: #fff;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    font-family: "DM Sans", sans-serif;
}

.blog-btn:hover {
    background: #d4af37;
    color: #002f6c;
}

/* SEO SECTION */
.blog-seo {
    margin-top: 4rem;
    background: #fff;
    padding: 2.5rem 1.5rem;
    border-radius: 16px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}

.blog-seo h3 {
    font-size: 1.8rem;
    margin-bottom: 1rem;
}

.blog-seo p {
    font-size: 1rem;
    color: #444;
    line-height: 1.8;
    font-family: "DM Sans", sans-serif;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .blog-header h1 {
        font-size: 2.2rem;
    }
    .blog-content h2 {
        font-size: 1.15rem;
    }
    .blog-seo h3 {
        font-size: 1.5rem;
    }
}
@media (max-width: 480px) {
    .blog-card img {
        height: 180px;
    }
    .blog-content {
        padding: 1rem;
    }
}
</style>


<section class="blog-container">
    <header class="blog-header">
        <h1>📰 Le Blog Lavanty.mg</h1>
        <p>
            Bienvenue sur le blog officiel de <strong>Lavanty.mg</strong>, la première plateforme d’<strong>enchères de luxe à Madagascar</strong>.  
            Découvrez nos actualités, conseils, et tendances exclusives autour du monde du prestige et de l’élégance.
        </p>
    </header>

    <div class="blog-grid">
        <!-- ARTICLE 1 -->
        <a href="#" class="blog-card">
            <img src="https://images.unsplash.com/photo-1670404160620-a3a86428560e?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1025" 
                 alt="Montres de luxe aux enchères" 
                 onerror="this.onerror=null;this.src='{{ asset('images/placeholder.jpg') }}';">
            <div class="blog-content">
                <div class="blog-meta">
                    <span>📅 08 Novembre 2025</span>
                    <span>✍️ Équipe Lavanty</span>
                </div>
                <h2>Les montres de luxe les plus prisées aux enchères</h2>
                <p>
                    Découvrez pourquoi certaines montres suisses atteignent des records lors des ventes. 
                    Un mélange d’histoire, de rareté et d’art horloger qui fascine les collectionneurs.
                </p>
                <span class="blog-btn">Lire la suite</span>
            </div>
        </a>

        <!-- ARTICLE 2 -->
        <a href="#" class="blog-card">
            <img src="https://images.unsplash.com/photo-1544986581-efac024faf62?auto=format&fit=crop&w=800&q=80" 
                 alt="Bijoux enchères Madagascar" 
                 onerror="this.onerror=null;this.src='{{ asset('images/placeholder.jpg') }}';">
            <div class="blog-content">
                <div class="blog-meta">
                    <span>📅 01 Novembre 2025</span>
                    <span>✍️ Lavanty Team</span>
                </div>
                <h2>Comment acheter un bijou d’exception aux enchères</h2>
                <p>
                    Participer à une vente d’objets précieux est un art. Voici nos conseils pour 
                    miser intelligemment et obtenir le meilleur prix sur Lavanty.mg.
                </p>
                <span class="blog-btn">Lire la suite</span>
            </div>
        </a>

        <!-- ARTICLE 3 -->
        <a href="#" class="blog-card">
            <img src="https://images.unsplash.com/photo-1648113137741-43e7e00c87f4?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1074" 
                 alt="Oeuvres d'art enchères Madagascar" 
                 onerror="this.onerror=null;this.src='{{ asset('images/placeholder.jpg') }}';">
            <div class="blog-content">
                <div class="blog-meta">
                    <span>📅 22 Octobre 2025</span>
                    <span>✍️ Lavanty Rédaction</span>
                </div>
                <h2>L’art contemporain s’invite sur Lavanty.mg</h2>
                <p>
                    De jeunes artistes malgaches rejoignent la plateforme. Le marché de l’art local s’ouvre 
                    à de nouveaux collectionneurs grâce aux enchères digitales.
                </p>
                <span class="blog-btn">Lire la suite</span>
            </div>
        </a>
    </div>

    <div class="blog-seo">
        <h3>Pourquoi suivre le blog Lavanty.mg ?</h3>
        <p>
            Le blog <strong>Lavanty.mg</strong> est la référence du luxe et des enchères à Madagascar. 
            Nous y partageons des analyses, des guides et des actualités pour aider nos utilisateurs 
            à comprendre le monde fascinant des ventes haut de gamme.
        </p>
        <p>
            Du choix d’un objet d’art rare à la mise en vente d’une montre d’exception, 
            chaque article est conçu pour offrir une <strong>expérience éducative et inspirante</strong>.  
            Lavanty.mg, c’est bien plus qu’une plateforme : c’est une passerelle vers l’univers du prestige, 
            de la collection et du raffinement à la malgache.
        </p>
    </div>
</section>

<script>
// ✅ Script pour remplacer automatiquement les images cassées
document.querySelectorAll('img').forEach(img => {
    img.addEventListener('error', () => {
        img.src = '{{ asset('images/placeholder.jpg') }}';
        img.alt = "Image non disponible";
    });
});
</script>
@endsection
