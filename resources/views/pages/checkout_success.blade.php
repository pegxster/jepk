@extends('layouts.app')
@section('title', 'Merci pour votre commande ! — JEKP Store')

@push('styles')
<style>
.success-wrap{max-width:760px;margin:80px auto;padding:0 24px;text-align:center}
.success-card{
    background:var(--blanc);border-radius:24px;padding:60px 40px;
    box-shadow:var(--ombre);border:1px solid var(--peche);position:relative;overflow:hidden;
}
.success-card::before{
    content:'';position:absolute;top:0;left:0;right:0;height:5px;
    background:linear-gradient(90deg,var(--peche),var(--rose-v),var(--lavande2));
}
.success-icon{
    width:80px;height:80px;background:linear-gradient(135deg,var(--peche),var(--lavande));
    border-radius:50%;display:flex;align-items:center;justify-content:center;
    margin:0 auto 24px;font-size:36px;color:var(--rose-v);
    box-shadow:0 8px 30px rgba(201,104,128,.2);
}
.success-card h1{font-family:var(--f-titre);font-size:38px;font-weight:300;color:var(--texte);margin-bottom:8px}
.success-card p{font-size:14px;color:var(--texte2);max-width:480px;margin:0 auto 30px;line-height:1.8}
.order-badge{
    display:inline-block;background:var(--creme2);border:1.5px dashed var(--rose-v);
    padding:8px 24px;border-radius:50px;font-size:13px;font-weight:600;color:var(--brun-d);
    letter-spacing:1px;margin-bottom:30px;
}
.recap-table{width:100%;border-collapse:collapse;margin:24px 0;text-align:left}
.recap-table th{font-size:10px;letter-spacing:1.5px;text-transform:uppercase;color:var(--texte2);padding:12px;border-bottom:1.5px solid var(--peche)}
.recap-table td{padding:14px 12px;font-size:13.5px;color:var(--texte);border-bottom:1px solid var(--peche)}
.success-actions{display:flex;gap:14px;justify-content:center;flex-wrap:wrap;margin-top:36px}
@media(max-width:600px){.success-wrap{margin:40px auto;padding:0 16px}.success-card{padding:36px 20px;border-radius:18px}.success-card h1{font-size:28px}.recap-table th,.recap-table td{padding:10px 8px;font-size:12px}.success-actions{flex-direction:column;align-items:center}}
</style>
@endpush

@section('content')
<div class="success-wrap">
    <div class="success-card">
        <div class="success-icon"><i class="fas fa-check"></i></div>
        <span class="s-label">Merci pour votre confiance</span>
        <h1>Commande <em>Confirmée !</em></h1>
        <p>Votre commande a été enregistrée avec succès. Notre équipe d'artisanes s'active déjà pour la préparer avec tout l'amour et le soin nécessaires.</p>

        @if(isset($order) && $order)
            <div class="order-badge">N° COMMANDE : {{ $order->order_number }}</div>

            <table class="recap-table">
                <thead>
                    <tr>
                        <th>Article</th>
                        <th style="text-align:center">Qté</th>
                        <th style="text-align:right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items ?? [] as $it)
                    <tr>
                        <td>{{ $it['name'] ?? $it['nom'] ?? 'Article JEKP' }}</td>
                        <td style="text-align:center">{{ $it['quantity'] ?? $it['qte'] ?? 1 }}</td>
                        <td style="text-align:right;font-weight:500">{{ number_format(($it['price'] ?? 0) * ($it['quantity'] ?? 1), 0, ',', ' ') }} F CFA</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="background:var(--creme2);padding:18px 24px;border-radius:12px;display:flex;justify-content:space-between;align-items:center;margin-top:16px">
                <span style="font-size:13px;color:var(--texte2)">Montant Total réglé :</span>
                <span style="font-size:18px;font-weight:600;color:var(--brun-d)">{{ number_format($order->total ?? 0, 0, ',', ' ') }} F CFA</span>
            </div>
        @else
            <div class="order-badge">N° COMMANDE : JKP-{{ strtoupper(Str::random(6)) }}</div>
        @endif

        <div class="success-actions">
            <a href="{{ route('account.orders') }}" class="btn btn-rose">
                <i class="fas fa-box-open"></i> Suivre mes commandes
            </a>
            <a href="{{ route('shop.index') }}" class="btn btn-outline-rose">
                <i class="fas fa-shopping-bag"></i> Continuer mes achats
            </a>
        </div>
    </div>
</div>
@endsection
