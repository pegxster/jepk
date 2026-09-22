@extends('admin.layouts.app')
@section('title', 'Tableau de bord')

@push('styles')
<style>
/* ─── Variables locales ─── */
:root {
    --rose-jepk:  #C96880;
    --rose-dk:    #A85068;
    --peach-jepk: #E8896A;
    --lav-jepk:   #9B8EC4;
    --dark-jepk:  #3D2B1F;
    --muted:      #9A8070;
    --border:     #F0E8E0;
    --bg-card:    #FFFFFF;
    --bg-light:   #FBF8F5;
}

/* ─── Bande de marque JEPK ─── */
.jepk-brand-stripe {
    background: linear-gradient(135deg, #C96880 0%, #A85068 40%, #9B8EC4 100%);
    border-radius: 20px;
    padding: 28px 32px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 24px;
    position: relative;
    overflow: hidden;
}
.jepk-brand-stripe::before {
    content: '';
    position: absolute;
    top: -30px; right: -30px;
    width: 200px; height: 200px;
    border-radius: 50%;
    background: rgba(255,255,255,.08);
}
.jepk-brand-stripe::after {
    content: '🧶';
    position: absolute;
    bottom: -10px; right: 80px;
    font-size: 80px;
    opacity: .12;
    line-height: 1;
}
.jepk-brand-left { flex: 1; }
.jepk-brand-logo {
    font-family: 'Cormorant Garamond', serif;
    font-size: 38px;
    font-weight: 700;
    color: #fff;
    letter-spacing: 4px;
    line-height: 1;
    text-shadow: 0 2px 12px rgba(0,0,0,.2);
}
.jepk-brand-tagline {
    font-size: 12px;
    color: rgba(255,255,255,.75);
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-top: 4px;
}
.jepk-brand-welcome {
    font-size: 14px;
    color: rgba(255,255,255,.9);
    margin-top: 12px;
    font-weight: 500;
}
.jepk-brand-date {
    font-size: 12px;
    color: rgba(255,255,255,.65);
    margin-top: 3px;
}
.jepk-brand-actions {
    display: flex;
    flex-direction: column;
    gap: 8px;
    flex-shrink: 0;
    position: relative;
    z-index: 1;
}
.jepk-brand-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    border-radius: 10px;
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
    transition: all .2s;
    white-space: nowrap;
}
.jepk-brand-btn.white {
    background: rgba(255,255,255,.95);
    color: var(--rose-jepk);
}
.jepk-brand-btn.white:hover { background: #fff; color: var(--rose-dk); }
.jepk-brand-btn.ghost {
    background: rgba(255,255,255,.15);
    color: #fff;
    border: 1.5px solid rgba(255,255,255,.3);
}
.jepk-brand-btn.ghost:hover { background: rgba(255,255,255,.25); }

/* ─── Alerte ─── */
.db-alert {
    display: flex;
    align-items: center;
    gap: 14px;
    background: #FFF4EF;
    border: 2px solid #E8896A;
    border-radius: 14px;
    padding: 16px 20px;
    margin-bottom: 24px;
}
.db-alert i { color: #E8896A; font-size: 20px; flex-shrink: 0; }
.db-alert-txt { font-size: 13.5px; color: #6A3A20; flex: 1; line-height: 1.5; }
.db-alert-txt strong { color: #C96880; font-weight: 800; }
/* bouton dans l'alerte — priorité haute */
.db-alert .db-alert-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 18px;
    background: var(--rose-jepk);
    color: #fff !important;
    border-radius: 10px;
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
    white-space: nowrap;
    transition: background .2s;
    flex-shrink: 0;
}
.db-alert .db-alert-btn:hover { background: var(--rose-dk); color: #fff !important; }

/* ─── Stats ─── */
.db-stats {
    display: grid;
    grid-template-columns: repeat(5,1fr);
    gap: 14px;
    margin-bottom: 24px;
}
.db-stat {
    background: var(--bg-card);
    border-radius: 16px;
    padding: 20px 18px;
    border: 1px solid var(--border);
    box-shadow: 0 1px 4px rgba(61,43,31,.04);
    transition: all .2s;
    position: relative;
    overflow: hidden;
}
.db-stat:hover { transform: translateY(-2px); box-shadow: 0 6px 24px rgba(61,43,31,.1); }
.db-stat-icon {
    width: 40px; height: 40px;
    border-radius: 11px;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px; margin-bottom: 12px;
}
.db-stat-label {
    font-size: 10.5px; color: var(--muted);
    font-weight: 700; letter-spacing: .5px;
    text-transform: uppercase; margin-bottom: 5px;
}
.db-stat-val {
    font-family: 'Cormorant Garamond', serif;
    font-size: 30px; font-weight: 700;
    color: var(--dark-jepk); line-height: 1;
}
.db-stat-tag {
    display: inline-flex; align-items: center; gap: 4px;
    font-size: 10.5px; font-weight: 700;
    padding: 3px 8px; border-radius: 50px; margin-top: 7px;
}
.db-stat-tag.red  { background: rgba(232,137,106,.15); color: #C0502A; }
.db-stat-tag.ok   { background: rgba(39,174,96,.12); color: #1A8040; }

/* ─── Section titre ─── */
.db-section-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 20px; font-weight: 600;
    color: var(--dark-jepk);
    display: flex; align-items: center; gap: 10px;
    margin-bottom: 14px; padding-bottom: 10px;
    border-bottom: 2px solid var(--border);
}
.db-section-title i { color: var(--rose-jepk); font-size: 16px; }
.db-section-title a {
    margin-left: auto;
    font-size: 12px; color: var(--rose-jepk);
    text-decoration: none; font-weight: 700;
    font-family: 'Nunito', sans-serif;
}
.db-section-title a:hover { color: var(--rose-dk); }

/* ─── Carte générique ─── */
.db-card {
    background: var(--bg-card);
    border-radius: 16px;
    border: 1px solid var(--border);
    box-shadow: 0 1px 4px rgba(61,43,31,.04);
    overflow: hidden;
    margin-bottom: 22px;
}
.db-card-head {
    padding: 18px 22px;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; justify-content: space-between;
}
.db-card-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 18px; font-weight: 600;
    color: var(--dark-jepk);
    display: flex; align-items: center; gap: 9px;
}
.db-card-link {
    font-size: 12px; color: var(--rose-jepk);
    text-decoration: none; font-weight: 700;
}
.db-card-link:hover { color: var(--rose-dk); }

/* ─── Pipeline ─── */
.pipeline-steps {
    display: flex;
    gap: 0;
    overflow-x: auto;
    padding: 20px 22px 0;
}
.p-step {
    flex: 1; min-width: 120px;
    cursor: pointer;
    background: var(--bg-card);
    border: 1px solid var(--border);
    padding: 16px 12px 14px;
    text-align: center;
    transition: all .2s;
    user-select: none;
    position: relative;
}
.p-step:first-child { border-radius: 12px 0 0 12px; }
.p-step:last-child  { border-radius: 0 12px 12px 0; }
.p-step::after {
    content: '›';
    position: absolute; right: -13px; top: 50%;
    transform: translateY(-50%);
    font-size: 20px; color: #D0C0B8; z-index: 2;
}
.p-step:last-child::after { display: none; }
.p-step:hover { background: #FDF9F6; }
.p-step-dot {
    width: 34px; height: 34px;
    border-radius: 50%;
    margin: 0 auto 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px;
}
.p-step-count {
    font-family: 'Cormorant Garamond', serif;
    font-size: 24px; font-weight: 700; line-height: 1; margin-bottom: 3px;
}
.p-step-label {
    font-size: 9.5px; font-weight: 700;
    letter-spacing: .7px; text-transform: uppercase;
    color: var(--muted); line-height: 1.3;
}

/* ─── Order cards ─── */
.orders-pipeline { display: flex; flex-direction: column; gap: 10px; padding: 18px 22px; }
.order-card {
    background: var(--bg-light);
    border: 1.5px solid var(--border);
    border-radius: 12px; padding: 15px 18px;
    display: flex; align-items: center; gap: 14px;
    transition: all .2s;
}
.order-card:hover { background: #FFF5F7; border-color: rgba(201,104,128,.25); }
.order-card-num  { font-size: 12px; font-weight: 800; color: var(--rose-jepk); min-width: 56px; }
.order-card-info { flex: 1; min-width: 0; }
.order-card-name { font-size: 14px; font-weight: 700; color: var(--dark-jepk); }
.order-card-items { font-size: 11px; color: var(--muted); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; margin-top: 2px; }
.order-card-meta  { font-size: 11px; color: #B0A098; margin-top: 2px; }
.order-card-total { text-align: right; flex-shrink: 0; }
.order-card-price   { font-size: 13px; font-weight: 700; color: var(--dark-jepk); }
.order-card-deposit { font-size: 10.5px; color: var(--muted); margin-top: 1px; }
.order-card-actions { display: flex; gap: 7px; flex-shrink: 0; }
.oc-btn {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 7px 11px; border-radius: 8px;
    font-size: 11px; font-weight: 700;
    border: none; cursor: pointer;
    text-decoration: none; transition: all .2s; white-space: nowrap;
}
.oc-btn-wa      { background: #25D366; color: #fff; }
.oc-btn-wa:hover { background: #1da851; color: #fff; }
.oc-btn-next    { background: var(--rose-jepk); color: #fff; }
.oc-btn-next:hover { background: var(--rose-dk); color: #fff; }
.oc-btn-outline { background: #fff; color: var(--dark-jepk); border: 1.5px solid #DDD5CC; }
.oc-btn-outline:hover { border-color: var(--rose-jepk); color: var(--rose-jepk); }

/* ─── Table commandes ─── */
.db-table { width: 100%; border-collapse: collapse; }
.db-table th {
    text-align: left; font-size: 10px; font-weight: 700;
    letter-spacing: 1px; text-transform: uppercase;
    color: #B0A098; padding: 12px 18px;
    background: var(--bg-light); border-bottom: 1px solid var(--border);
}
.db-table td { padding: 13px 18px; font-size: 13px; color: var(--dark-jepk); border-bottom: 1px solid #F8F3EF; }
.db-table tr:last-child td { border-bottom: none; }
.db-table tr:hover td { background: var(--bg-light); }
.db-status {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: 11px; font-weight: 700;
    padding: 4px 10px; border-radius: 50px;
}

/* ─── Charts ─── */
.db-charts-row { display: grid; grid-template-columns: 2fr 1fr; gap: 18px; margin-bottom: 22px; }
.db-chart-card {
    background: var(--bg-card);
    border-radius: 16px;
    border: 1px solid var(--border);
    box-shadow: 0 1px 4px rgba(61,43,31,.04);
    padding: 20px 22px;
}
.db-chart-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 16px; font-weight: 600;
    color: var(--dark-jepk); margin-bottom: 14px;
    display: flex; align-items: center; gap: 8px;
}
.db-chart-wrap { position: relative; height: 220px; }

/* ─── Liste items ─── */
.db-list-item {
    display: flex; align-items: center; gap: 13px;
    padding: 13px 22px;
    border-bottom: 1px solid #F8F3EF;
    transition: background .15s;
}
.db-list-item:last-child { border-bottom: none; }
.db-list-item:hover { background: var(--bg-light); }
.db-list-thumb {
    width: 42px; height: 42px;
    border-radius: 10px; object-fit: cover;
    flex-shrink: 0; background: #F5EFE8;
    display: flex; align-items: center; justify-content: center;
    color: #C0B0A8;
}
.db-list-info { flex: 1; min-width: 0; }
.db-list-name { font-size: 13px; font-weight: 600; color: var(--dark-jepk); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.db-list-sub  { font-size: 11px; color: var(--muted); margin-top: 1px; }
.db-list-right { font-size: 11.5px; color: #B0A098; white-space: nowrap; flex-shrink: 0; }
.db-list-avatar {
    width: 40px; height: 40px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 15px; color: #fff; font-weight: 700; flex-shrink: 0;
}
.db-cat-icon {
    width: 36px; height: 36px; border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    font-size: 14px; flex-shrink: 0;
}

/* ─── Accès rapide ─── */
.db-quick { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; padding: 16px 22px; }
.db-quick-btn {
    display: flex; align-items: center; gap: 9px;
    padding: 11px 14px;
    background: var(--bg-light);
    border: 1.5px solid var(--border);
    border-radius: 10px;
    text-decoration: none; color: var(--dark-jepk);
    font-size: 12px; font-weight: 600;
    transition: all .2s;
}
.db-quick-btn i { font-size: 13px; color: var(--rose-jepk); width: 16px; text-align: center; }
.db-quick-btn:hover { background: rgba(201,104,128,.07); border-color: rgba(201,104,128,.3); }

/* ─── Responsive ─── */
@media(max-width:1200px){
    .db-stats { grid-template-columns: repeat(3,1fr); }
    .db-charts-row { grid-template-columns: 1fr; }
}
@media(max-width:900px){
    .db-stats { grid-template-columns: repeat(2,1fr); }
    .jepk-brand-stripe { flex-direction: column; align-items: flex-start; }
    .jepk-brand-actions { flex-direction: row; flex-wrap: wrap; }
}
@media(max-width:600px){
    .db-stats { grid-template-columns: 1fr 1fr; }
    .db-quick { grid-template-columns: 1fr; }
    .order-card { flex-wrap: wrap; }
    .jepk-brand-logo { font-size: 28px; }
}
</style>
@endpush

@section('topbar-actions')
    <a href="{{ route('admin.orders.index') }}" class="topbar-btn" style="margin-right:8px">
        <i class="fa-solid fa-receipt"></i> Commandes
        @if($stats['pending'] > 0)
            <span style="background:#E8896A;color:#fff;font-size:10px;font-weight:700;padding:2px 7px;border-radius:50px;margin-left:4px">{{ $stats['pending'] }}</span>
        @endif
    </a>
    <a href="{{ route('admin.produits.create') }}" class="topbar-btn">
        <i class="fa-solid fa-plus"></i> Nouveau produit
    </a>
@endsection

@section('content')

{{-- ══════════════════════════════════════════════
     BANDE DE MARQUE JEPK
══════════════════════════════════════════════ --}}
<div class="jepk-brand-stripe">
    <div class="jepk-brand-left">
        <div class="jepk-brand-logo">JEPK</div>
        <div class="jepk-brand-tagline">Boutique Crochet Artisanal — Côte d'Ivoire</div>
        <div class="jepk-brand-welcome">
            Bonjour <strong style="color:#fff">{{ auth()->user()->name }}</strong> 👋
        </div>
        <div class="jepk-brand-date">
            {{ \Carbon\Carbon::now()->translatedFormat('l d F Y') }} · Espace Administration
        </div>
    </div>
    <div class="jepk-brand-actions">
        <a href="{{ route('admin.orders.index') }}" class="jepk-brand-btn white">
            <i class="fa-solid fa-receipt"></i> Commandes
            @if($stats['to_contact'] > 0)
                <span style="background:var(--rose-jepk);color:#fff;font-size:10px;padding:2px 6px;border-radius:50px">{{ $stats['to_contact'] }}</span>
            @endif
        </a>
        <a href="{{ route('admin.produits.create') }}" class="jepk-brand-btn ghost">
            <i class="fa-solid fa-plus"></i> Ajouter un produit
        </a>
    </div>
</div>

{{-- ══════════════════════════════════════════════
     ALERTE COMMANDES EN ATTENTE
══════════════════════════════════════════════ --}}
@if($stats['to_contact'] > 0)
<div class="db-alert">
    <i class="fa-solid fa-bell"></i>
    <div class="db-alert-txt">
        <strong>{{ $stats['to_contact'] }} nouvelle{{ $stats['to_contact'] > 1 ? 's' : '' }} commande{{ $stats['to_contact'] > 1 ? 's' : '' }}</strong>
        en attente de contact. Contactez les clients via WhatsApp pour confirmer et demander l'acompte de 50%.
    </div>
    <a href="{{ route('admin.orders.index') }}?status=pending" class="db-alert-btn">
        Voir les commandes <i class="fa-solid fa-arrow-right"></i>
    </a>
</div>
@endif

{{-- ══════════════════════════════════════════════
     INDICATEURS CLÉS
══════════════════════════════════════════════ --}}
<div class="db-section-title">
    <i class="fa-solid fa-chart-simple"></i> Indicateurs clés
</div>
<div class="db-stats">
    <div class="db-stat">
        <div class="db-stat-icon" style="background:rgba(201,104,128,.1)">
            <i class="fa-solid fa-shopping-bag" style="color:var(--rose-jepk)"></i>
        </div>
        <div class="db-stat-label">Total commandes</div>
        <div class="db-stat-val" style="color:var(--rose-jepk)">{{ $stats['orders'] }}</div>
    </div>
    <div class="db-stat">
        <div class="db-stat-icon" style="background:rgba(232,137,106,.1)">
            <i class="fa-solid fa-bell" style="color:#E8896A"></i>
        </div>
        <div class="db-stat-label">À contacter</div>
        <div class="db-stat-val" style="color:#E8896A">{{ $stats['to_contact'] }}</div>
        @if($stats['to_contact'] > 0)
        <div class="db-stat-tag red"><i class="fa-solid fa-triangle-exclamation" style="font-size:9px"></i> Urgent</div>
        @endif
    </div>
    <div class="db-stat">
        <div class="db-stat-icon" style="background:rgba(155,142,196,.1)">
            <i class="fa-solid fa-hand-holding-dollar" style="color:#9B8EC4"></i>
        </div>
        <div class="db-stat-label">Acomptes en attente</div>
        <div class="db-stat-val" style="color:#9B8EC4">{{ $stats['awaiting_deposit'] }}</div>
    </div>
    <div class="db-stat">
        <div class="db-stat-icon" style="background:rgba(243,156,18,.1)">
            <i class="fa-solid fa-scissors" style="color:#F39C12"></i>
        </div>
        <div class="db-stat-label">En fabrication</div>
        <div class="db-stat-val" style="color:#F39C12">{{ $stats['in_production'] }}</div>
    </div>
    <div class="db-stat">
        <div class="db-stat-icon" style="background:rgba(39,174,96,.1)">
            <i class="fa-solid fa-coins" style="color:#27AE60"></i>
        </div>
        <div class="db-stat-label">Revenus livrés</div>
        <div class="db-stat-val" style="color:#27AE60;font-size:22px">
            {{ $stats['revenue'] > 0 ? number_format($stats['revenue']/1000,0).'k' : '0' }}
            <span style="font-size:13px;font-weight:400;color:var(--muted)">FCFA</span>
        </div>
        @if($stats['revenue'] > 0)
        <div class="db-stat-tag ok"><i class="fa-solid fa-check" style="font-size:9px"></i> Livrées</div>
        @endif
    </div>
</div>

{{-- ══════════════════════════════════════════════
     PIPELINE WORKFLOW JEPK
══════════════════════════════════════════════ --}}
<div class="db-section-title">
    <i class="fa-solid fa-route"></i> Suivi des commandes — Pipeline
    <a href="{{ route('admin.orders.index') }}">Tout gérer <i class="fa-solid fa-arrow-right" style="font-size:10px"></i></a>
</div>

@php
$pipelineConfig = [
    'pending'          => ['label'=>'Nouvelle commande','icon'=>'fa-inbox',               'color'=>'#E8896A'],
    'contacted'        => ['label'=>'Client contacté',  'icon'=>'fa-comments',            'color'=>'#9B8EC4'],
    'deposit_received' => ['label'=>'Acompte reçu',     'icon'=>'fa-hand-holding-dollar', 'color'=>'#4A90D9'],
    'processing'       => ['label'=>'En fabrication',   'icon'=>'fa-scissors',            'color'=>'#F39C12'],
    'ready'            => ['label'=>'Pièce prête',        'icon'=>'fa-check-circle',        'color'=>'#16A085'],
    'delivered'        => ['label'=>'Livrée',             'icon'=>'fa-truck',               'color'=>'#27AE60'],
];
$activeStep = request('pipeline_step', 'pending');
@endphp

<div class="db-card" style="margin-bottom:22px">
    {{-- Étapes --}}
    <div class="pipeline-steps">
        @foreach($pipelineConfig as $status => $cfg)
        @php $cnt = $pipeline[$status]->count(); @endphp
        <div class="p-step"
             style="{{ $activeStep === $status ? 'background:'.$cfg['color'].';border-color:'.$cfg['color'] : '' }}"
             onclick="showPipelineStep('{{ $status }}')">
            <div class="p-step-dot" style="background:{{ $activeStep === $status ? 'rgba(255,255,255,.22)' : $cfg['color'].'22' }}">
                <i class="fa-solid {{ $cfg['icon'] }}" style="color:{{ $activeStep === $status ? '#fff' : $cfg['color'] }}"></i>
            </div>
            <div class="p-step-count" style="color:{{ $activeStep === $status ? '#fff' : $cfg['color'] }}">{{ $cnt }}</div>
            <div class="p-step-label" style="{{ $activeStep === $status ? 'color:rgba(255,255,255,.8)' : '' }}">{{ $cfg['label'] }}</div>
        </div>
        @endforeach
    </div>

    {{-- Commandes de l'étape --}}
    @foreach($pipelineConfig as $status => $cfg)
    <div id="pipeline-{{ $status }}" style="{{ $activeStep !== $status ? 'display:none' : '' }}">
        @if($pipeline[$status]->count() > 0)
        <div class="orders-pipeline">
            @foreach($pipeline[$status] as $ord)
            @php
                $items     = collect($ord->items ?? []);
                $itemsLbl  = $items->map(fn($it)=>($it['name']??$it['product_name']??'?').' x'.($it['quantity']??1))->implode(' · ');
                $deposit   = round(($ord->total ?? 0) * 0.5);
                $phone     = preg_replace('/\D/','',$ord->customer_phone ?? '');
                $nextSt    = \App\Models\Order::nextStatus($status);
                $nextLabel = $nextSt ? \App\Models\Order::statusLabel($nextSt) : null;
                $waMsg = match($status) {
                    'pending'          => "Bonjour {$ord->customer_name} 👋\nVotre commande JEPK #{$ord->order_number} a bien été reçue !\nPour démarrer la fabrication, un acompte de 50% est requis : *".number_format($deposit,0,',',' ')." FCFA*.\nMerci de confirmer. 🧶",
                    'contacted'        => "Bonjour {$ord->customer_name},\nOn attend votre acompte de *".number_format($deposit,0,',',' ')." FCFA* pour la commande #{$ord->order_number}. Dès réception nous commençons la fabrication !",
                    'deposit_received' => "Bonjour {$ord->customer_name} 🎉\nVotre acompte est reçu ! Fabrication de la commande #{$ord->order_number} en cours. Délai : 5 à 7 jours. On vous tient informé(e). 🧶",
                    'processing'       => "Bonjour {$ord->customer_name},\nCommande #{$ord->order_number} en cours de fabrication. On vous contacte dès que c'est prêt !",
                    'ready'            => "Bonjour {$ord->customer_name} ✨\nVotre commande #{$ord->order_number} est PRÊTE ! Contactez-nous pour la livraison. Solde : *".number_format(($ord->total??0)-$deposit,0,',',' ')." FCFA*.",
                    default            => "Bonjour {$ord->customer_name}, un message concernant votre commande #{$ord->order_number}.",
                };
            @endphp
            <div class="order-card">
                <div class="order-card-num">#{{ $ord->order_number ?? 'N/A' }}</div>
                <div class="order-card-info">
                    <div class="order-card-name">{{ $ord->customer_name ?? '—' }}</div>
                    @if($itemsLbl)
                    <div class="order-card-items">{{ Str::limit($itemsLbl, 65) }}</div>
                    @endif
                    <div class="order-card-meta">
                        <i class="fa-solid fa-phone" style="font-size:9px;margin-right:2px"></i>
                        {{ $ord->customer_phone ?? '—' }} · {{ $ord->created_at?->format('d/m/Y') ?? '—' }}
                    </div>
                </div>
                <div class="order-card-total">
                    <div class="order-card-price">{{ number_format($ord->total ?? 0, 0, ',', ' ') }} F</div>
                    <div class="order-card-deposit">Acompte : {{ number_format($deposit, 0, ',', ' ') }} F</div>
                </div>
                <div class="order-card-actions">
                    @if($phone)
                    <a href="https://wa.me/{{ $phone }}?text={{ urlencode($waMsg) }}" target="_blank"
                       class="oc-btn oc-btn-wa" title="WhatsApp">
                        <i class="fab fa-whatsapp"></i> WA
                    </a>
                    @endif
                    @if($nextSt)
                    <form method="POST" action="{{ route('admin.orders.status', $ord) }}" style="display:inline">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="{{ $nextSt }}">
                        <button type="submit" class="oc-btn oc-btn-next" title="{{ $nextLabel }}">
                            <i class="fa-solid fa-arrow-right"></i> {{ Str::limit($nextLabel, 12) }}
                        </button>
                    </form>
                    @endif
                    <a href="{{ route('admin.orders.show', $ord) }}" class="oc-btn oc-btn-outline" title="Détail">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div style="text-align:center;padding:40px 20px;color:#C0B0A8">
            <i class="fa-solid fa-inbox" style="font-size:26px;display:block;margin-bottom:8px;opacity:.4"></i>
            <span style="font-size:13px">Aucune commande dans cette étape</span>
        </div>
        @endif
    </div>
    @endforeach
</div>

{{-- ══════════════════════════════════════════════
     COMMANDES RÉCENTES
══════════════════════════════════════════════ --}}
<div class="db-section-title">
    <i class="fa-solid fa-receipt"></i> Commandes récentes
    <a href="{{ route('admin.orders.index') }}">Tout voir <i class="fa-solid fa-arrow-right" style="font-size:10px"></i></a>
</div>

<div class="db-card" style="margin-bottom:22px">
    <table class="db-table">
        <thead>
            <tr>
                <th>N° commande</th>
                <th>Client</th>
                <th>Total</th>
                <th>Acompte (50%)</th>
                <th>Statut</th>
                <th>Date</th>
                <th>WhatsApp</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recent_orders as $ro)
            @php
                $rc  = \App\Models\Order::statusColor($ro->status ?? 'pending');
                $rl  = \App\Models\Order::statusLabel($ro->status ?? 'pending');
                $rph = preg_replace('/\D/','',$ro->customer_phone ?? '');
                $rwm = urlencode("Bonjour {$ro->customer_name}, votre commande JEPK #{$ro->order_number} : ");
                $rdp = round(($ro->total ?? 0) * 0.5);
            @endphp
            <tr>
                <td><strong style="color:var(--rose-jepk)">#{{ $ro->order_number ?? 'N/A' }}</strong></td>
                <td>
                    <div style="font-weight:600">{{ Str::limit($ro->customer_name ?? '—', 20) }}</div>
                    <div style="font-size:11px;color:var(--muted)">{{ $ro->customer_email ?? '' }}</div>
                </td>
                <td><strong>{{ number_format($ro->total ?? 0, 0, ',', ' ') }} F</strong></td>
                <td style="color:#9B8EC4;font-weight:600">{{ number_format($rdp, 0, ',', ' ') }} F</td>
                <td>
                    <span class="db-status" style="background:{{ $rc }}22;color:{{ $rc }}">
                        <span style="width:6px;height:6px;border-radius:50%;background:{{ $rc }};display:inline-block"></span>
                        {{ $rl }}
                    </span>
                </td>
                <td style="font-size:12px;color:var(--muted)">{{ $ro->created_at?->format('d/m/Y') ?? '—' }}</td>
                <td>
                    @if($rph)
                    <a href="https://wa.me/{{ $rph }}?text={{ $rwm }}" target="_blank"
                       style="color:#25D366;font-size:18px;text-decoration:none">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    @else
                    <span style="color:#D0C8C0">—</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center;padding:48px;color:#C0B0A8">
                    <i class="fa-solid fa-inbox" style="font-size:30px;display:block;margin-bottom:10px;opacity:.4"></i>
                    Aucune commande pour l'instant
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- ══════════════════════════════════════════════
     GRAPHIQUES
══════════════════════════════════════════════ --}}
<div class="db-section-title">
    <i class="fa-solid fa-chart-line"></i> Statistiques & Revenus
</div>

{{-- Revenus 6 mois (pleine largeur) --}}
<div class="db-chart-card" style="margin-bottom:18px">
    <div class="db-chart-title">
        <i class="fa-solid fa-chart-bar" style="color:var(--rose-jepk)"></i>
        Revenus — 6 derniers mois (commandes livrées)
    </div>
    <div class="db-chart-wrap"><canvas id="revenueChart"></canvas></div>
</div>

{{-- Par statut + 7 jours côte à côte --}}
<div class="db-charts-row">
    <div class="db-chart-card">
        <div class="db-chart-title">
            <i class="fa-solid fa-calendar-days" style="color:#E8896A"></i>
            Commandes — 7 derniers jours
        </div>
        <div class="db-chart-wrap"><canvas id="dailyChart"></canvas></div>
    </div>
    <div class="db-chart-card">
        <div class="db-chart-title">
            <i class="fa-solid fa-chart-pie" style="color:#9B8EC4"></i>
            Répartition par statut
        </div>
        <div class="db-chart-wrap"><canvas id="statusChart"></canvas></div>
    </div>
</div>

{{-- ══════════════════════════════════════════════
     CATALOGUE · CLIENTS · CATÉGORIES
══════════════════════════════════════════════ --}}
<div class="db-section-title" style="margin-top:6px">
    <i class="fa-solid fa-layer-group"></i> Catalogue &amp; Gestion
</div>

{{-- Catalogue --}}
<div class="db-card" style="margin-bottom:18px">
    <div class="db-card-head">
        <div class="db-card-title"><i class="fa-solid fa-box-open" style="color:var(--rose-jepk)"></i> Derniers produits</div>
        <a href="{{ route('admin.produits.index') }}" class="db-card-link">Gérer le catalogue</a>
    </div>
    @forelse($recent_prods as $rp)
    @php $rpImg = !empty($rp->images[0]) ? product_image_url($rp->images[0]) : null; @endphp
    <div class="db-list-item">
        @if($rpImg)
            <img src="{{ $rpImg }}" class="db-list-thumb" alt="" style="width:42px;height:42px;border-radius:10px;object-fit:cover;flex-shrink:0">
        @else
            <div class="db-list-thumb"><i class="fa-solid fa-image" style="font-size:14px"></i></div>
        @endif
        <div class="db-list-info">
            <div class="db-list-name">{{ Str::limit($rp->name, 30) }}</div>
            <div class="db-list-sub">{{ $rp->category_name ?? '—' }}</div>
        </div>
        <div class="db-list-right" style="font-weight:600;color:var(--dark-jepk)">{{ number_format($rp->price ?? 0, 0, ',', ' ') }} F</div>
    </div>
    @empty
    <div style="text-align:center;padding:32px;color:#C0B0A8;font-size:13px">Aucun produit dans le catalogue</div>
    @endforelse
    <div style="padding:14px 22px;border-top:1px solid var(--border)">
        <a href="{{ route('admin.produits.create') }}" class="db-quick-btn" style="justify-content:center">
            <i class="fa-solid fa-plus"></i> Ajouter un produit au catalogue
        </a>
    </div>
</div>

{{-- Clients récents --}}
<div class="db-card" style="margin-bottom:18px">
    <div class="db-card-head">
        <div class="db-card-title"><i class="fa-solid fa-users" style="color:#4A90D9"></i> Clients récents</div>
        <a href="{{ route('admin.users.index') }}" class="db-card-link">Tous les clients</a>
    </div>
    @forelse($recent_users as $u)
    <div class="db-list-item">
        <div class="db-list-avatar" style="background:linear-gradient(135deg,var(--rose-jepk),var(--lav-jepk))">
            {{ strtoupper(substr($u->prenom ?? $u->name ?? 'C', 0, 1)) }}
        </div>
        <div class="db-list-info">
            <div class="db-list-name">{{ Str::limit(trim(($u->prenom ?? '').' '.($u->nom ?? $u->name ?? '')), 26) }}</div>
            <div class="db-list-sub">{{ Str::limit($u->email ?? '—', 30) }}</div>
        </div>
        <div class="db-list-right">{{ $u->created_at?->diffForHumans() ?? '—' }}</div>
    </div>
    @empty
    <div style="text-align:center;padding:32px;color:#C0B0A8;font-size:13px">Aucun client inscrit</div>
    @endforelse
</div>

{{-- Catégories + accès rapide --}}
<div class="db-card" style="margin-bottom:22px">
    <div class="db-card-head">
        <div class="db-card-title"><i class="fa-solid fa-tags" style="color:#9B8EC4"></i> Catégories du catalogue</div>
        <a href="{{ route('admin.categories.index') }}" class="db-card-link">Gérer</a>
    </div>
    @php
    $catIcons=['robes'=>'fa-person-dress','tops'=>'fa-shirt','boleros'=>'fa-vest','tenues-plage'=>'fa-umbrella-beach','ensemble-hommes'=>'fa-person','tenues-couple'=>'fa-heart','chapeaux'=>'fa-hat-cowboy','sacs-a-main'=>'fa-bag-shopping','enfants'=>'fa-child','sacs-trafoil'=>'fa-briefcase','sacs-customises'=>'fa-pen-ruler','sacs-dordinateur'=>'fa-laptop','bouquets-de-fleurs'=>'fa-leaf','miroirs-crochetes'=>'fa-circle-dot','chouchous'=>'fa-circle','porte-cles'=>'fa-key','barrettes'=>'fa-star'];
    $catColors=['#C96880','#E8896A','#9B8EC4','#27AE60','#4A90D9','#E74C3C','#F39C12','#2ECC71','#8E44AD','#16A085','#D35400','#2980B9','#27AE60','#E8896A','#C96880','#9B8EC4','#E74C3C'];
    @endphp
    @forelse($categories->take(8) as $ci => $cat)
    <div class="db-list-item">
        @php
            $s  = $cat->slug ?? '';
            $ic = $catIcons[$s] ?? 'fa-tag';
            $cl = $catColors[$ci % count($catColors)];
            $bg = 'rgba('.implode(',', sscanf($cl, '#%02x%02x%02x')).',.12)';
        @endphp
        <div class="db-cat-icon" style="background:{{ $bg }}">
            <i class="fa-solid {{ $ic }}" style="color:{{ $cl }}"></i>
        </div>
        <div class="db-list-info">
            <div class="db-list-name">{{ $cat->name }}</div>
            @php $pc = $prodCountByCategory[$cat->name] ?? 0; @endphp
            <div class="db-list-sub">{{ $pc }} article{{ $pc > 1 ? 's' : '' }}</div>
        </div>
        <div class="db-list-right" style="font-size:18px;color:{{ $cl }}">
            <i class="fa-solid {{ $ic }}"></i>
        </div>
    </div>
    @empty
    <div style="text-align:center;padding:32px;color:#C0B0A8;font-size:13px">Aucune catégorie</div>
    @endforelse
    @if($categories->count() > 8)
    <div style="text-align:center;padding:10px;border-top:1px solid var(--border)">
        <a href="{{ route('admin.categories.index') }}" style="font-size:12px;color:var(--rose-jepk);text-decoration:none;font-weight:600">
            + {{ $categories->count() - 8 }} autres catégories
        </a>
    </div>
    @endif
    <div style="border-top:1px solid var(--border);padding:16px 22px">
        <div style="font-size:11px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:10px">Accès rapide</div>
        <div class="db-quick" style="padding:0">
            <a href="{{ route('admin.produits.create') }}"   class="db-quick-btn"><i class="fa-solid fa-plus"></i> Produit</a>
            <a href="{{ route('admin.blog.create') }}"        class="db-quick-btn"><i class="fa-solid fa-pen-to-square"></i> Article blog</a>
            <a href="{{ route('admin.categories.index') }}"   class="db-quick-btn"><i class="fa-solid fa-tags"></i> Catégories</a>
            <a href="{{ route('admin.media.index') }}"        class="db-quick-btn"><i class="fa-solid fa-upload"></i> Images</a>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script>
/* ── Pipeline tabs ── */
function showPipelineStep(status) {
    document.querySelectorAll('[id^="pipeline-"]').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.p-step').forEach(el => {
        el.style.background = '';
        el.style.borderColor = '';
        el.querySelectorAll('.p-step-count,.p-step-label,.p-step-dot i').forEach(t => t.style.color = '');
        el.querySelectorAll('.p-step-dot').forEach(d => d.style.background = '');
    });
    const target = document.getElementById('pipeline-' + status);
    const step   = document.querySelector(`.p-step[onclick*="'${status}'"]`);
    if (target) target.style.display = '';
    if (step) {
        const clr = step.dataset.color || '#C96880';
        step.style.background  = clr;
        step.style.borderColor = clr;
        step.querySelectorAll('.p-step-count').forEach(t => t.style.color = '#fff');
        step.querySelectorAll('.p-step-label').forEach(t => t.style.color = 'rgba(255,255,255,.8)');
        step.querySelectorAll('.p-step-dot i').forEach(i => i.style.color = '#fff');
        step.querySelectorAll('.p-step-dot').forEach(d => d.style.background = 'rgba(255,255,255,.22)');
    }
}

// Store colors on elements for JS access
document.querySelectorAll('.p-step').forEach(el => {
    const onclick = el.getAttribute('onclick') ?? '';
    const m = onclick.match(/'([^']+)'/);
    if (!m) return;
    const colors = { pending:'#E8896A', contacted:'#9B8EC4', deposit_received:'#4A90D9', processing:'#F39C12', ready:'#16A085', delivered:'#27AE60' };
    el.dataset.color = colors[m[1]] || '#C96880';
});

Chart.defaults.font = { family: "'Nunito', sans-serif", size: 12, weight: '500' };
Chart.defaults.color = '#9A8070';
const grid = '#F0E8E0';
const rose = '#C96880', peach = '#E8896A', lav = '#9B8EC4';

/* Revenus 6 mois */
new Chart(document.getElementById('revenueChart'), {
    type: 'bar',
    data: {
        labels: {!! json_encode($revenueChart->pluck('label')) !!},
        datasets: [{
            label: 'Revenus FCFA',
            data: {!! json_encode($revenueChart->pluck('value')) !!},
            backgroundColor: 'rgba(201,104,128,.15)',
            borderColor: rose, borderWidth: 2,
            borderRadius: 8, borderSkipped: false,
            hoverBackgroundColor: rose
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { display: false }, border: { display: false } },
            y: { grid: { color: grid }, border: { display: false },
                 ticks: { callback: v => v >= 1000 ? (v/1000) + 'k' : v } }
        }
    }
});

/* 7 jours */
new Chart(document.getElementById('dailyChart'), {
    type: 'line',
    data: {
        labels: {!! json_encode($dailyOrders->pluck('label')) !!},
        datasets: [{
            label: 'Commandes',
            data: {!! json_encode($dailyOrders->pluck('value')) !!},
            borderColor: peach, backgroundColor: 'rgba(232,137,106,.12)',
            fill: true, tension: 0.4,
            pointBackgroundColor: '#fff', pointBorderColor: peach,
            pointBorderWidth: 2, pointRadius: 4, pointHoverRadius: 6
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { display: false }, border: { display: false } },
            y: { grid: { color: grid }, border: { display: false }, beginAtZero: true, ticks: { stepSize: 1 } }
        }
    }
});

/* Par statut */
const statusData = {!! json_encode($ordersByStatus) !!};
const statusColors = {
    'Nouvelle commande':'#E8896A','Client contacté':'#9B8EC4','Acompte reçu':'#4A90D9',
    'En fabrication':'#F39C12','Pièce prête':'#16A085','Livrée':'#27AE60','Annulée':'#E74C3C'
};
new Chart(document.getElementById('statusChart'), {
    type: 'doughnut',
    data: {
        labels: statusData.map(d => d.label),
        datasets: [{
            data: statusData.map(d => d.value),
            backgroundColor: statusData.map(d => statusColors[d.label] || '#999'),
            borderWidth: 0, hoverOffset: 6
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false, cutout: '65%',
        plugins: { legend: { position: 'bottom', labels: { padding: 10, usePointStyle: true, pointStyleWidth: 7, font: { size: 11 } } } }
    }
});
</script>
@endpush
