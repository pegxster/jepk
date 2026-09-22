@extends('layouts.app')
@section('title','Commande — JEKP Store')
@push('styles')
<style>
.page-hero{background:linear-gradient(135deg,var(--creme2),var(--peche));padding:48px 50px;text-align:center;border-bottom:1px solid var(--peche)}
.steps{display:flex;justify-content:center;gap:0;margin:30px auto;max-width:500px}
.step{display:flex;align-items:center;gap:8px;font-size:11px;letter-spacing:1px;color:var(--texte2);position:relative;flex:1;justify-content:center}
.step-num{width:28px;height:28px;border-radius:50%;background:var(--peche);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:500;color:var(--brun-d);flex-shrink:0;transition:var(--trans)}
.step.on .step-num{background:var(--rose-v);color:var(--blanc)}
.step.done .step-num{background:var(--rose-f);color:var(--blanc)}
.step-label{font-size:10px;letter-spacing:1px;text-transform:uppercase}
.step-line{flex:1;height:1.5px;background:var(--peche);margin:0 8px;max-width:40px}
.step.done .step-line{background:var(--rose-v)}
.checkout-layout{max-width:1100px;margin:0 auto;padding:50px 50px;display:grid;grid-template-columns:1fr 340px;gap:40px;align-items:start}
.checkout-bloc{background:var(--blanc);border-radius:14px;padding:28px;box-shadow:var(--ombre-sm);margin-bottom:22px}
.bloc-titre{font-family:var(--f-titre);font-size:20px;font-weight:300;color:var(--texte);margin-bottom:20px;display:flex;align-items:center;gap:10px}
.bloc-titre i{color:var(--rose-v)}
.f-row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.f-g{margin-bottom:14px}
.f-g label{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--texte2);display:block;margin-bottom:6px;font-weight:500}
.f-g input,.f-g select,.f-g textarea{width:100%;padding:12px 15px;border:1.5px solid var(--peche);border-radius:10px;font-family:var(--f-corps);font-size:13.5px;color:var(--texte);outline:none;background:var(--creme2);transition:border-color .3s}
.f-g input:focus,.f-g select:focus,.f-g textarea:focus{border-color:var(--rose-v);background:var(--blanc)}
/* Quartier search */
.quartier-wrap{position:relative}
.quartier-search{width:100%;padding:12px 15px;border:1.5px solid var(--peche);border-radius:10px;font-family:var(--f-corps);font-size:13.5px;color:var(--texte);outline:none;background:var(--creme2);transition:border-color .3s;box-sizing:border-box}
.quartier-search:focus{border-color:var(--rose-v);background:var(--blanc)}
.quartier-list{position:absolute;top:100%;left:0;right:0;max-height:220px;overflow-y:auto;background:var(--blanc);border:1.5px solid var(--peche);border-radius:10px;box-shadow:0 8px 24px rgba(90,48,64,.12);z-index:50;display:none;margin-top:4px}
.quartier-list.aff{display:block}
.quartier-list div{padding:10px 15px;font-size:13px;color:var(--texte);cursor:pointer;transition:background .2s;border-bottom:1px solid var(--peche)}
.quartier-list div:last-child{border-bottom:none}
.quartier-list div:hover,.quartier-list div.hl{background:var(--peche);color:var(--rose-v)}
.quartier-list div .q-commune{font-size:10px;color:var(--texte2);margin-left:4px}
/* Méthodes livraison */
.livraison-opts{display:flex;flex-direction:column;gap:10px}
.livr-opt{display:flex;align-items:center;gap:14px;padding:14px 18px;border:1.5px solid var(--peche);border-radius:10px;cursor:pointer;transition:var(--trans)}
.livr-opt:hover{border-color:var(--rose-p)}
.livr-opt.on{border-color:var(--rose-v);background:var(--creme2)}
.livr-opt input{accent-color:var(--rose-v)}
.livr-nom{font-size:13px;font-weight:500;color:var(--texte);margin-bottom:2px}
.livr-desc{font-size:11px;color:var(--texte2)}
.livr-prix{margin-left:auto;font-size:14px;font-weight:500;color:var(--rose-v)}
/* Paiement */
.paiement-opts{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:18px}
.pay-opt{padding:14px;border:1.5px solid var(--peche);border-radius:10px;cursor:pointer;text-align:center;transition:var(--trans)}
.pay-opt:hover,.pay-opt.on{border-color:var(--rose-v);background:var(--creme2)}
.pay-opt i{font-size:22px;color:var(--texte2);display:block;margin-bottom:4px}
.pay-opt span{font-size:11px;color:var(--texte2)}
/* Récap */
.recap-card{background:var(--blanc);border-radius:14px;padding:28px;box-shadow:var(--ombre-sm);position:sticky;top:100px}
.recap-titre{font-family:var(--f-titre);font-size:18px;font-weight:300;margin-bottom:18px;padding-bottom:14px;border-bottom:1px solid var(--peche)}
.recap-item{display:flex;gap:12px;align-items:center;margin-bottom:12px;padding-bottom:12px;border-bottom:1px solid var(--creme2)}
.recap-item img{width:50px;height:64px;object-fit:cover;border-radius:6px;flex-shrink:0}
.ri-nom{font-size:13px;color:var(--texte);font-weight:400;margin-bottom:2px}
.ri-prix{font-size:12px;color:var(--texte2)}
.recap-ligne{display:flex;justify-content:space-between;font-size:13px;color:var(--texte2);margin-bottom:8px}
.recap-total{display:flex;justify-content:space-between;font-size:16px;font-weight:500;color:var(--texte);padding-top:12px;border-top:1px solid var(--peche);margin-top:8px}
.recap-total span:last-child{color:var(--rose-v)}
@media(max-width:900px){
    .checkout-layout{grid-template-columns:1fr;padding:24px 16px}
    .f-row{grid-template-columns:1fr}
    .paiement-opts{grid-template-columns:1fr 1fr}
    .page-hero{padding:30px 20px}
    .steps{margin:20px auto}
    .step-label{font-size:9px}
    .checkout-bloc{padding:20px;border-radius:12px}
    .recap-card{position:static;padding:20px}
    .recap-item img{width:42px;height:54px}
    .livr-opt{padding:12px 14px;flex-wrap:wrap}
    .livr-prix{margin-left:auto}
}
@media(max-width:500px){
    .steps{flex-direction:column;align-items:center;gap:0}
    .step-line{width:1.5px;height:20px;max-width:unset;margin:4px 0}
}
</style>
@endpush
@section('content')
<div class="page-hero">
    <span class="s-label">Réserver votre création</span>
    <h1 class="s-titre">Votre <em>commande</em></h1>
    <div class="steps">
        <div class="step done"><span class="step-num"><i class="fas fa-check" style="font-size:11px"></i></span><span class="step-label">Panier</span></div>
        <div class="step-line done"></div>
        <div class="step on"><span class="step-num">2</span><span class="step-label">Vos infos</span></div>
        <div class="step-line"></div>
        <div class="step"><span class="step-num">3</span><span class="step-label">Confirmation</span></div>
        <div class="step-line"></div>
        <div class="step"><span class="step-num">4</span><span class="step-label">Acompte &amp; Fabrication</span></div>
    </div>
</div>

<div class="checkout-layout">
    <div>
        <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
            @csrf
            {{-- Adresse de livraison --}}
            <div class="checkout-bloc">
                <h3 class="bloc-titre"><i class="fas fa-map-marker-alt"></i> Adresse de livraison</h3>
                <div class="f-row">
                    <div class="f-g"><label>Prénom</label><input type="text" name="prenom" value="{{ auth()->user()->prenom ?? '' }}" placeholder="Ex: Aminata" required></div>
                    <div class="f-g"><label>Nom</label><input type="text" name="nom" value="{{ auth()->user()->nom ?? '' }}" placeholder="Ex: Kouassi" required></div>
                </div>
                <div class="f-g"><label>Adresse de livraison</label><input type="text" name="adresse" placeholder="Ex: Rue L12, près du..." required></div>
                <div class="f-row">
                    <div class="f-g quartier-wrap">
                        <label>Quartier / Commune</label>
                        <input type="text" name="quartier" id="quartierInput" placeholder="Rechercher votre quartier..." autocomplete="off" required>
                        <div class="quartier-list" id="quartierList"></div>
                    </div>
                    <div class="f-g"><label>Ville</label><input type="text" name="ville" value="Abidjan" placeholder="Abidjan"></div>
                </div>
                <div class="f-row">
                    <div class="f-g">
                        <label>Pays</label>
                        <select name="pays">
                            <option selected>Côte d'Ivoire (+225)</option>
                            <option>Sénégal (+221)</option>
                            <option>Mali (+223)</option>
                            <option>Burkina Faso (+226)</option>
                            <option>Autre (Zone UEMOA)</option>
                        </select>
                    </div>
                    <div class="f-g"><label>Téléphone (+225)</label><input type="tel" name="telephone" value="{{ auth()->user()->telephone ?? '' }}" placeholder="+225 07 00 00 00 00" required></div>
                </div>
                <div class="f-g"><label>Note pour le livreur (optionnel)</label><input type="text" name="note" placeholder="Précisions de repère, heure de passage…"></div>
            </div>

            {{-- Méthode de livraison --}}
            <div class="checkout-bloc">
                <h3 class="bloc-titre"><i class="fas fa-truck"></i> Méthode de livraison</h3>
                <div class="livraison-opts">
                    <label class="livr-opt on">
                        <input type="radio" name="livraison" value="standard" checked>
                        <div><div class="livr-nom">Livraison à domicile</div><div class="livr-desc">Abidjan — 24h à 48h ouvrés après fabrication</div></div>
                        <span class="livr-prix">2 000 F CFA</span>
                    </label>
                    <label class="livr-opt">
                        <input type="radio" name="livraison" value="retrait">
                        <div><div class="livr-nom">Retrait en boutique</div><div class="livr-desc">Venez récupérer votre commande directement</div></div>
                        <span class="livr-prix">Gratuit</span>
                    </label>
                </div>
            </div>

            {{-- Processus JEPK — Acompte & Fabrication --}}
            <div class="checkout-bloc">
                <h3 class="bloc-titre"><i class="fas fa-scissors"></i> Comment fonctionne votre commande ?</h3>

                {{-- Timeline processus --}}
                <div style="display:flex;flex-direction:column;gap:0;margin-bottom:22px">
                    @php
                    $steps = [
                        ['icon'=>'fa-check-circle','color'=>'#27AE60','title'=>'Vous passez commande','desc'=>'Remplissez le formulaire ci-dessus et confirmez votre réservation.','done'=>true],
                        ['icon'=>'fa-comments','color'=>'#9B8EC4','title'=>'On vous contacte sous 24h','desc'=>'Notre équipe vous appelle ou vous écrit sur WhatsApp pour confirmer les détails (couleur, taille, personnalisation).','done'=>false],
                        ['icon'=>'fa-hand-holding-dollar','color'=>'#4A90D9','title'=>'Versement de l\'acompte (50%)','desc'=>'Pour lancer la fabrication, un acompte de 50% du total est requis. Paiement via Wave, Orange Money ou virement.','done'=>false],
                        ['icon'=>'fa-scissors','color'=>'#F39C12','title'=>'Fabrication de votre pièce','desc'=>'Votre création est faite entièrement à la main avec soin. Délai : 5 à 10 jours selon la complexité.','done'=>false],
                        ['icon'=>'fa-truck','color'=>'#16A085','title'=>'Livraison + solde (50% restant)','desc'=>'À la livraison, vous réglez le solde restant. Votre pièce unique est entre vos mains !','done'=>false],
                    ];
                    @endphp
                    @foreach($steps as $i => $st)
                    <div style="display:flex;gap:14px;align-items:flex-start;padding-bottom:{{ $i < count($steps)-1 ? '16px' : '0' }};position:relative">
                        <div style="display:flex;flex-direction:column;align-items:center;flex-shrink:0">
                            <div style="width:36px;height:36px;border-radius:50%;background:{{ $st['done'] ? $st['color'] : 'rgba('.implode(',',sscanf($st['color'],'#%02x%02x%02x')).',.1)' }};display:flex;align-items:center;justify-content:center;flex-shrink:0">
                                <i class="fas {{ $st['icon'] }}" style="color:{{ $st['done'] ? '#fff' : $st['color'] }};font-size:14px"></i>
                            </div>
                            @if($i < count($steps)-1)
                            <div style="width:2px;height:100%;min-height:20px;background:var(--peche);flex:1;margin-top:6px"></div>
                            @endif
                        </div>
                        <div style="padding-top:6px;flex:1">
                            <div style="font-size:14px;font-weight:600;color:{{ $st['done'] ? $st['color'] : 'var(--texte)' }};margin-bottom:3px">{{ $st['title'] }}</div>
                            <div style="font-size:12px;color:var(--texte2);line-height:1.6">{{ $st['desc'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Modes de paiement de l'acompte --}}
                <div style="background:linear-gradient(135deg,var(--creme2),var(--peche));border-radius:12px;padding:16px 20px;margin-bottom:18px">
                    <div style="font-size:11px;letter-spacing:1.5px;text-transform:uppercase;color:var(--texte2);font-weight:600;margin-bottom:12px">Moyens de paiement acceptés pour l'acompte</div>
                    <div style="display:flex;flex-wrap:wrap;gap:10px">
                        <div style="background:#fff;padding:8px 14px;border-radius:10px;border:1.5px solid #E8F6FC;display:flex;align-items:center">
                            <img src="{{ asset('assets/images/wave-logo.webp') }}" alt="Wave" style="height:40px;width:auto;display:block">
                        </div>
                        <div style="background:#fff;padding:8px 14px;border-radius:10px;border:1.5px solid #FFE8D6;display:flex;align-items:center">
                            <img src="{{ asset('assets/images/orange-money-logo.png') }}" alt="Orange Money" style="height:40px;width:auto;display:block">
                        </div>
                        <div style="display:flex;align-items:center;gap:8px;background:#fff;padding:10px 14px;border-radius:10px;border:1.5px solid #E8F5E9;font-size:12px;font-weight:600;color:var(--texte)">
                            <i class="fas fa-money-bills" style="color:#27AE60;font-size:18px"></i> Espèces (en main propre)
                        </div>
                    </div>
                </div>

                {{-- Préférence de contact --}}
                <div>
                    <label style="font-size:11px;letter-spacing:1.5px;text-transform:uppercase;color:var(--texte2);font-weight:600;display:block;margin-bottom:10px">Comment souhaitez-vous être contacté(e) ?</label>
                    <div style="display:flex;gap:10px;flex-wrap:wrap">
                        <label style="display:flex;align-items:center;gap:8px;padding:12px 16px;border:1.5px solid var(--peche);border-radius:10px;cursor:pointer;font-size:13px;transition:all .2s" id="lbl-wa">
                            <input type="radio" name="contact_pref" value="whatsapp" checked onchange="toggleContactPref()" style="accent-color:var(--rose-v)">
                            <i class="fab fa-whatsapp" style="color:#25D366;font-size:17px"></i> WhatsApp
                        </label>
                        <label style="display:flex;align-items:center;gap:8px;padding:12px 16px;border:1.5px solid var(--peche);border-radius:10px;cursor:pointer;font-size:13px;transition:all .2s" id="lbl-tel">
                            <input type="radio" name="contact_pref" value="telephone" onchange="toggleContactPref()" style="accent-color:var(--rose-v)">
                            <i class="fas fa-phone" style="color:var(--rose-v);font-size:15px"></i> Appel téléphonique
                        </label>
                    </div>
                </div>

                <input type="hidden" name="payment_method" value="acompte_50">
            </div>
        </form>
    </div>

    {{-- Récapitulatif --}}
    <div class="recap-card">
        <div class="recap-titre">Votre commande</div>
        @php $items=session('cart',[]);$total=0; @endphp
        @if(count($items))
            @foreach($items as $id=>$item)
            @php
                $iNom  = $item['name'] ?? $item['nom'] ?? 'Création JEKP';
                $iPrix = $item['price'] ?? $item['prix'] ?? 0;
                $iQte  = $item['quantity'] ?? $item['qte'] ?? 1;
                $iImg  = $item['image'] ?? $item['img'] ?? null;
                $iImg  = product_image_url($iImg, asset('assets/images/jepk1.jpg'));
                $sous  = $iPrix * $iQte;
                $total += $sous;
            @endphp
            <div class="recap-item">
                <img src="{{ $iImg }}" alt="{{ $iNom }}">
                <div><div class="ri-nom">{{ $iNom }} x{{ $iQte }}</div><div class="ri-prix">{{ number_format($sous,0,',',' ') }} F CFA</div></div>
            </div>
            @endforeach
        @else
            <div class="recap-item"><img src="{{ asset('assets/images/jepk1.jpg') }}" alt=""><div><div class="ri-nom">Kit Pull Couture N°1 x1</div><div class="ri-prix">45 000 F CFA</div></div></div>
            @php $total=45000; @endphp
        @endif
        @php $acompte = round($total * 0.5); $solde = $total - $acompte; @endphp
        <div class="recap-ligne"><span>Sous-total</span><span>{{ number_format($total,0,',',' ') }} F CFA</span></div>
        <div class="recap-ligne"><span>Livraison</span><span id="recap-livr">2 000 F CFA</span></div>
        <div class="recap-total"><span>Total estimé</span><span>{{ number_format($total,0,',',' ') }} F CFA</span></div>

        {{-- Acompte ── --}}
        <div style="background:linear-gradient(135deg,rgba(201,104,128,.08),rgba(155,142,196,.08));border:1.5px dashed var(--rose-p);border-radius:12px;padding:16px;margin-top:16px">
            <div style="font-size:10px;letter-spacing:1.5px;text-transform:uppercase;color:var(--texte2);margin-bottom:10px;font-weight:600">Acompte requis pour démarrer</div>
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px">
                <span style="font-size:13px;color:var(--texte2)">Acompte (50%)</span>
                <span style="font-size:18px;font-weight:700;color:var(--rose-v)">{{ number_format($acompte,0,',',' ') }} F</span>
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center">
                <span style="font-size:12px;color:var(--texte2)">Solde à la livraison (50%)</span>
                <span style="font-size:13px;color:var(--texte2)">{{ number_format($solde,0,',',' ') }} F</span>
            </div>
        </div>

        <button type="submit" form="checkout-form" class="btn btn-rose" style="width:100%;justify-content:center;margin-top:18px;border-radius:50px;font-size:13px;padding:14px">
            <i class="fas fa-heart" style="font-size:14px"></i> Réserver ma création
        </button>
        <div style="text-align:center;margin-top:12px;font-size:11px;color:var(--texte2);line-height:1.6">
            <i class="fas fa-info-circle" style="color:var(--rose-p)"></i>
            Aucun paiement maintenant — notre équipe vous contacte sous 24h pour confirmer et vous donner les instructions d'acompte.
        </div>
    </div>
</div>

@push('scripts')
<script>
document.querySelectorAll('.livr-opt').forEach(o => o.addEventListener('click', () => {
    document.querySelectorAll('.livr-opt').forEach(x => x.classList.remove('on'));
    o.classList.add('on');
}));

function selectCheckoutPayment(method) {
    document.getElementById('checkout_payment_method').value = method;

    const optWave = document.getElementById('opt-wave');
    const optLivr = document.getElementById('opt-livraison');
    const checkWave = document.getElementById('check-wave');
    const checkLivr = document.getElementById('check-livraison');
    const boxWave = document.getElementById('wave-input-box');
    const boxLivr = document.getElementById('livraison-info-box');

    if (method === 'wave') {
        optWave.style.border = '2px solid var(--rose-v)';
        optWave.style.background = 'var(--creme2)';
        checkWave.className = 'fas fa-check-circle';
        checkWave.style.color = 'var(--rose-v)';

        optLivr.style.border = '1.5px solid var(--peche)';
        optLivr.style.background = 'var(--blanc)';
        checkLivr.className = 'far fa-circle';
        checkLivr.style.color = 'var(--texte2)';

        boxWave.style.display = 'block';
        boxLivr.style.display = 'none';
    } else {
        optLivr.style.border = '2px solid var(--rose-v)';
        optLivr.style.background = 'var(--creme2)';
        checkLivr.className = 'fas fa-check-circle';
        checkLivr.style.color = 'var(--rose-v)';

        optWave.style.border = '1.5px solid var(--peche)';
        optWave.style.background = 'var(--blanc)';
        checkWave.className = 'far fa-circle';
        checkWave.style.color = 'var(--texte2)';

        boxWave.style.display = 'none';
        boxLivr.style.display = 'block';
    }
}

// ── Quartiers d'Abidjan — recherche live depuis notre liste (base OpenStreetMap,
//    enrichie automatiquement à chaque nouveau quartier saisi par une cliente) ──
const qInput = document.getElementById('quartierInput');
const qList = document.getElementById('quartierList');
let qIndex = -1;
let qFetchAbort = null;
let qDebounce = null;

function renderQuartiers(matches) {
    qList.innerHTML = '';
    qIndex = -1;
    if (!matches.length) { qList.classList.remove('aff'); return; }
    matches.forEach((q, i) => {
        const div = document.createElement('div');
        div.innerHTML = q.nom + '<span class="q-commune">' + q.commune + '</span>';
        div.addEventListener('mousedown', function(e) {
            e.preventDefault();
            qInput.value = q.nom + ', ' + q.commune;
            qList.classList.remove('aff');
        });
        div.addEventListener('mouseenter', function() {
            document.querySelectorAll('#quartierList div').forEach(d => d.classList.remove('hl'));
            div.classList.add('hl');
            qIndex = i;
        });
        qList.appendChild(div);
    });
    qList.classList.add('aff');
}

function fetchQuartiers(term) {
    if (qFetchAbort) qFetchAbort.abort();
    qFetchAbort = new AbortController();

    fetch("{{ route('quartiers.search') }}?q=" + encodeURIComponent(term), { signal: qFetchAbort.signal })
        .then(r => r.ok ? r.json() : [])
        .then(renderQuartiers)
        .catch(() => {});
}

if (qInput) {
    qInput.addEventListener('input', function() {
        const term = this.value;
        clearTimeout(qDebounce);
        qDebounce = setTimeout(() => fetchQuartiers(term), 200);
    });
    qInput.addEventListener('focus', function() { fetchQuartiers(this.value); });
    qInput.addEventListener('blur', function() { setTimeout(() => qList.classList.remove('aff'), 200); });
    qInput.addEventListener('keydown', function(e) {
        const items = qList.querySelectorAll('div');
        if (!items.length) return;
        if (e.key === 'ArrowDown') { e.preventDefault(); qIndex = Math.min(qIndex + 1, items.length - 1); }
        else if (e.key === 'ArrowUp') { e.preventDefault(); qIndex = Math.max(qIndex - 1, 0); }
        else if (e.key === 'Enter' && qIndex >= 0) { e.preventDefault(); items[qIndex].click(); return; }
        items.forEach((d, i) => d.classList.toggle('hl', i === qIndex));
    });
}
</script>
@endpush
@endsection