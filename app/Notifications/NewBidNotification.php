<?php

namespace App\Notifications;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewBidNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $product;
    protected $amount;
    protected $bidderName;

    public function __construct(Product $product, $amount, $bidderName)
    {
        $this->product = $product;
        $this->amount = $amount;
        $this->bidderName = $bidderName;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("💰 Nouvelle enchère sur « {$this->product->title} »")
            ->greeting("Bonjour {$notifiable->pseudo} 👋")
            ->line("Une nouvelle enchère vient d’être placée sur le produit :")
            ->line("📦 **{$this->product->title}**")
            ->line("💸 Montant : **" . number_format($this->amount, 0, ',', ' ') . " Ar**")
            ->line("👤 Enchérisseur : {$this->bidderName}")
            ->action('Voir le produit', url('/product/' . $this->product->id))
            ->line("Bonne chance pour la suite de l’enchère !");
    }
}
