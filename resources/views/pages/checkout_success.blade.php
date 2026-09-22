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
        {{-- Icône & titre --}}
        <div class="success-icon" style="background:linear-gradient(135deg,var(--peche),var(--lavande))">
            <i class="fas fa-heart" style="color:var(--rose-v)"></i>
        </div>
        <span class="s-label">Merci pour votre confiance</span>
        <h1>Commande <em>Reçue !</em></h1>

        @if(isset($order) && $order)
            @php $acompte = round(($order->total ?? 0) * 0.5); @endphp
            <div class="order-badge">N° {{ $order->order_number }}</div>
        @else
            @php $acompte = 0; @endphp
            <div class="order-badge">N° JEPK-{{ strtoupper(Str::random(6)) }}</div>
        @endif

        {{-- Processus —  étapes visuelles --}}
        <div style="background:linear-gradient(135deg,var(--creme2),var(--peche));border-radius:16px;padding:24px 28px;margin:24px 0;text-align:left">
            <div style="font-size:12px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:var(--texte2);margin-bottom:18px">Votre commande étape par étape</div>
            @php
            $nextSteps = [
                ['icon'=>'fa-check-circle','color'=>'#27AE60','done'=>true,
                 'title'=>'Commande enregistrée','desc'=>'Votre réservation a bien été reçue.'],
                ['icon'=>'fa-comments','color'=>'#9B8EC4','done'=>false,
                 'title'=>'On vous contacte sous 24h','desc'=>'Notre équipe vous contacte par WhatsApp ou téléphone pour confirmer les détails.'],
                ['icon'=>'fa-hand-holding-dollar','color'=>'#4A90D9','done'=>false,
                 'title'=>isset($order) ? 'Acompte : '.number_format($acompte,0,',',' ').' F CFA (50%)' : 'Versement de l\'acompte (50%)',
                 'desc'=>'Dès réception de l\'acompte, la fabrication commence immédiatement.'],
                ['icon'=>'fa-scissors','color'=>'#F39C12','done'=>false,
                 'title'=>'Fabrication de votre pièce','desc'=>'Création artisanale faite main avec soin. Délai : 5 à 10 jours.'],
                ['icon'=>'fa-truck','color'=>'#16A085','done'=>false,
                 'title'=>'Livraison + solde restant','desc'=>'Votre pièce vous est livrée. Vous réglez le solde (50%) à la réception.'],
            ];
            @endphp
            @foreach($nextSteps as $i => $st)
            <div style="display:flex;gap:12px;align-items:flex-start;{{ $i < count($nextSteps)-1 ? 'padding-bottom:14px' : '' }}">
                <div style="display:flex;flex-direction:column;align-items:center;flex-shrink:0">
                    <div style="width:32px;height:32px;border-radius:50%;background:{{ $st['done'] ? $st['color'] : 'rgba(255,255,255,.8)' }};display:flex;align-items:center;justify-content:center;flex-shrink:0;border:2px solid {{ $st['color'] }}">
                        <i class="fas {{ $st['icon'] }}" style="color:{{ $st['done'] ? '#fff' : $st['color'] }};font-size:12px"></i>
                    </div>
                    @if($i < count($nextSteps)-1)
                    <div style="width:2px;flex:1;min-height:14px;background:rgba(0,0,0,.1);margin-top:4px"></div>
                    @endif
                </div>
                <div style="padding-top:5px;flex:1">
                    <div style="font-size:13px;font-weight:{{ $st['done'] ? '700' : '600' }};color:{{ $st['done'] ? $st['color'] : 'var(--texte)' }}">{{ $st['title'] }}</div>
                    <div style="font-size:11px;color:var(--texte2);margin-top:2px;line-height:1.5">{{ $st['desc'] }}</div>
                </div>
            </div>
            @endforeach
        </div>

        @if(isset($order) && $order && count($order->items ?? []))
        <table class="recap-table">
            <thead>
                <tr>
                    <th>Article</th>
                    <th style="text-align:center">Qté</th>
                    <th style="text-align:right">Prix</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items ?? [] as $it)
                <tr>
                    <td>{{ $it['name'] ?? $it['nom'] ?? 'Création JEPK' }}</td>
                    <td style="text-align:center">{{ $it['quantity'] ?? $it['qte'] ?? 1 }}</td>
                    <td style="text-align:right;font-weight:500">{{ number_format(($it['price'] ?? 0) * ($it['quantity'] ?? 1), 0, ',', ' ') }} F</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Résumé financier --}}
        <div style="border:1.5px dashed var(--rose-p);border-radius:12px;padding:16px 20px;margin-top:16px;display:grid;grid-template-columns:1fr 1fr;gap:8px;text-align:center">
            <div style="border-right:1px solid var(--peche);padding-right:10px">
                <div style="font-size:10px;letter-spacing:1px;text-transform:uppercase;color:var(--texte2);margin-bottom:4px">Acompte (50%)</div>
                <div style="font-size:22px;font-weight:700;color:var(--rose-v)">{{ number_format($acompte, 0, ',', ' ') }} F</div>
                <div style="font-size:10px;color:var(--texte2);margin-top:2px">À verser pour démarrer</div>
            </div>
            <div style="padding-left:10px">
                <div style="font-size:10px;letter-spacing:1px;text-transform:uppercase;color:var(--texte2);margin-bottom:4px">Solde (50%)</div>
                <div style="font-size:22px;font-weight:700;color:var(--brun-d)">{{ number_format(($order->total ?? 0) - $acompte, 0, ',', ' ') }} F</div>
                <div style="font-size:10px;color:var(--texte2);margin-top:2px">À la livraison</div>
            </div>
        </div>
        @endif

        {{-- Bouton WhatsApp direct --}}
        @php
        $waMsgSuccess = urlencode("Bonjour JEPK 👋\nJe viens de passer une commande sur votre site et j'attends votre confirmation.\nN° commande : " . (isset($order) ? $order->order_number : 'JEPK-?'));
        @endphp
        <div class="success-actions" style="margin-top:28px">
            <a href="https://wa.me/2250153928572?text={{ $waMsgSuccess }}" target="_blank" rel="noopener"
               class="btn" style="background:#25D366;color:#fff;border:none">
                <i class="fab fa-whatsapp" style="font-size:16px"></i> Contacter JEPK sur WhatsApp
            </a>
            <a href="{{ route('account.orders') }}" class="btn btn-rose">
                <i class="fas fa-box-open"></i> Mes commandes
            </a>
            <a href="{{ route('shop.index') }}" class="btn btn-outline-rose">
                <i class="fas fa-shopping-bag"></i> Continuer
            </a>
        </div>
    </div>
</div>
@endsection
