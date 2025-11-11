@extends('layouts.app')

@section('title', 'Contact - Lavanty.mg | Enchères de Luxe à Madagascar')

@section('content')
<style>
@import url("https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap");

/* === GLOBAL === */
.contact-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 5rem 1rem;
    font-family: "DM Sans", sans-serif; /* ✅ Police principale */
    background: #fff;
    color: #333;
    line-height: 1.7;
}

/* === TITRES === */
h1, h2, h3, h4, h5, h6 {
    font-family: "Playfair Display", serif; /* ✅ Police titres */
    font-weight: 700;
    color: #002f6c;
}

/* HEADER */
.contact-header {
    text-align: center;
    margin-bottom: 4rem;
}

.contact-header h1 {
    font-size: 3rem;
    font-weight: 800;
    color: #002f6c;
    margin-bottom: 1rem;
}

.contact-header p {
    font-size: 1.1rem;
    color: #555;
    max-width: 750px;
    margin: 0 auto;
    line-height: 1.6;
    font-family: "DM Sans", sans-serif;
}

.divider {
    width: 80px;
    height: 4px;
    background: #d4af37;
    border-radius: 5px;
    margin: 1.5rem auto 3rem;
}

/* CONTACT SECTION */
.contact-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    align-items: start;
}

/* FORMULAIRE */
.contact-form {
    background: #f9f9f9;
    border-radius: 16px;
    padding: 2.5rem;
    box-shadow: 0 8px 25px rgba(0,0,0,0.05);
}

.contact-form h2 {
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
}

.contact-form label {
    display: block;
    font-weight: 600;
    color: #002f6c;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
    font-family: "DM Sans", sans-serif;
}

.contact-form input,
.contact-form textarea {
    width: 100%;
    padding: 0.8rem 1rem;
    border: 1px solid #ddd;
    border-radius: 10px;
    margin-bottom: 1.2rem;
    font-family: "DM Sans", sans-serif;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.contact-form input:focus,
.contact-form textarea:focus {
    outline: none;
    border-color: #d4af37;
}

.contact-form textarea {
    min-height: 150px;
    resize: vertical;
}

.contact-btn {
    background: #002f6c;
    color: #fff;
    border: none;
    padding: 0.9rem 1.8rem;
    font-size: 1rem;
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: "DM Sans", sans-serif;
}

.contact-btn:hover {
    background: #d4af37;
    color: #002f6c;
}

/* INFO SECTION */
.contact-info {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.contact-info-box {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.05);
    padding: 2rem;
}

.contact-info-box h3 {
    font-size: 1.4rem;
    margin-bottom: 0.8rem;
}

.contact-info-box p {
    color: #555;
    font-size: 1rem;
    line-height: 1.6;
    font-family: "DM Sans", sans-serif;
}

.contact-info-box a {
    color: #d4af37;
    text-decoration: none;
    font-weight: 600;
}

.contact-info-box a:hover {
    text-decoration: underline;
}

/* MAP */
.contact-map {
    margin-top: 4rem;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

/* RESPONSIVE */
@media (max-width: 992px) {
    .contact-grid {
        grid-template-columns: 1fr;
    }
}
@media (max-width: 480px) {
    .contact-header h1 {
        font-size: 2.2rem;
    }
}
</style>

<section class="contact-container">

    <header class="contact-header">
        <h1>Contactez-nous</h1>
        <div class="divider"></div>
        <p>
            Une question, un partenariat ou une demande d’information sur nos enchères ?  
            L’équipe de <strong>Lavanty.mg</strong> est à votre écoute et vous répondra dans les plus brefs délais.
        </p>
    </header>

    <div class="contact-grid">
        <!-- FORM -->
        <div class="contact-form">
            <h2>Envoyez-nous un message</h2>
            <form action="#" method="POST">
                @csrf
                <label for="name">Nom complet</label>
                <input type="text" id="name" name="name" placeholder="Entrez votre nom" required>

                <label for="email">Adresse e-mail</label>
                <input type="email" id="email" name="email" placeholder="Votre e-mail" required>

                <label for="subject">Objet</label>
                <input type="text" id="subject" name="subject" placeholder="Sujet du message" required>

                <label for="message">Votre message</label>
                <textarea id="message" name="message" placeholder="Tapez votre message..." required></textarea>

                <button type="submit" class="contact-btn">Envoyer le message</button>
            </form>
        </div>

        <!-- INFO -->
        <div class="contact-info">
            <div class="contact-info-box">
                <h3>📍 Notre adresse</h3>
                <p>
                    Lavanty.mg<br>
                    Rue des Arts, Antananarivo 101<br>
                    Madagascar
                </p>
            </div>

            <div class="contact-info-box">
                <h3>📞 Contact direct</h3>
                <p>
                    Téléphone : <a href="tel:+261341234567">+261 34 12 345 67</a><br>
                    Email : <a href="mailto:contact@lavanty.mg">contact@lavanty.mg</a>
                </p>
            </div>

            <div class="contact-info-box">
                <h3>⏰ Horaires d’ouverture</h3>
                <p>
                    Lundi - Vendredi : 9h00 - 18h00<br>
                    Samedi : 9h00 - 12h00<br>
                    Dimanche : Fermé
                </p>
            </div>
        </div>
    </div>

    <!-- MAP -->
    <div class="contact-map">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.9027135824813!2d47.51832557499467!3d-18.87919040777254!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x21f071feecf42527%3A0x79dcd2f96f8ecf8b!2sAntananarivo%2C%20Madagascar!5e0!3m2!1sfr!2smg!4v1700000000000" 
            width="100%" 
            height="400" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>

</section>
@endsection
