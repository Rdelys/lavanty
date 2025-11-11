@component('mail::message')
{{-- Import des polices et styles Lavanty Premium --}}
<style>
@import url("https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap");

body, table, td, p {
  font-family: "DM Sans", sans-serif !important;
  color: #001a3f !important;
  background-color: #ffffff !important;
}

h1, h2, h3 {
  font-family: "Playfair Display", serif !important;
  color: #002f6c !important;
  font-weight: 700 !important;
}

a {
  color: #004aad !important;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}

/* Encadré principal */
.wrapper {
  background-color: #ffffff !important;
  border: 1px solid rgba(0, 47, 108, 0.15);
  border-radius: 16px;
  box-shadow: 0 6px 25px rgba(0, 47, 108, 0.08);
  padding: 30px;
  margin-top: 10px;
}

/* Accent or */
.highlight {
  color: #ffd700 !important;
  font-weight: 700;
}

/* Bouton principal */
.button {
  background: linear-gradient(135deg, #004aad, #002f6c);
  border-radius: 9999px;
  color: #ffd700 !important;
  padding: 12px 28px;
  font-weight: 600;
  display: inline-block;
  text-decoration: none;
  transition: all 0.3s ease;
}
.button:hover {
  background: linear-gradient(135deg, #0058d4, #001a3f);
  transform: translateY(-1px);
}

/* Pied de mail */
.footer {
  font-size: 12px;
  color: #6b7280 !important;
  border-top: 1px solid rgba(0,0,0,0.05);
  margin-top: 24px;
  padding-top: 16px;
  text-align: center;
}
</style>

<div class="wrapper">
<h1>🎉 Félicitations {{ $product->lastBidUser->nom }} !</h1>

<p>
Vous avez remporté l’enchère pour le produit  
<strong class="highlight">{{ $product->title }}</strong> 🏆
</p>

<hr style="border: none; border-top: 1px solid #eee; margin: 20px 0;">

<ul style="list-style: none; padding: 0; margin: 0 0 20px 0;">
  <li><strong>💰 Prix final :</strong> <span class="highlight">{{ number_format($product->final_price, 0, ',', ' ') }} Ar</span></li>
  <li><strong>🕓 Date de fin :</strong> {{ $product->end_time->format('d/m/Y H:i') }}</li>
</ul>

<p>
Veuillez nous contacter rapidement pour finaliser le paiement et récupérer votre produit.
</p>

@component('mail::button', ['url' => url('/')])
Accéder à mon compte
@endcomponent

<p>
Merci pour votre confiance,<br>
<strong class="highlight">L’équipe Lavanty.mg</strong>
</p>

<p class="footer">
© {{ date('Y') }} Lavanty.mg — Tous droits réservés.<br>
Luxe. Enchères. Excellence.
</p>
</div>
@endcomponent
