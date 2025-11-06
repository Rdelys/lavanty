@component('mail::message')
# Félicitations {{ $product->lastBidUser->nom }} 🎉

Vous avez remporté l'enchère pour le produit **{{ $product->title }}**.

- **Prix final :** {{ number_format($product->final_price, 0, ',', ' ') }} Ar  
- **Date de fin :** {{ $product->end_time->format('d/m/Y H:i') }}

Veuillez nous contacter rapidement pour finaliser le paiement et récupérer votre produit.

Merci,  
L’équipe {{ config('app.name') }}
@endcomponent
