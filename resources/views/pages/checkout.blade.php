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
    <span class="s-label">Commander</span>
    <h1 class="s-titre">Votre <em>commande</em></h1>
    <div class="steps">
        <div class="step done"><span class="step-num"><i class="fas fa-check" style="font-size:11px"></i></span><span class="step-label">Panier</span></div>
        <div class="step-line"></div>
        <div class="step on"><span class="step-num">2</span><span class="step-label">Livraison</span></div>
        <div class="step-line"></div>
        <div class="step"><span class="step-num">3</span><span class="step-label">Paiement</span></div>
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
                    <div class="f-g">
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
                    <div class="f-g"><label>Téléphone (+225)</label><input type="tel" name="telephone" placeholder="+225 07 00 00 00 00" required></div>
                </div>
                <div class="f-g"><label>Note pour le livreur (optionnel)</label><input type="text" name="note" placeholder="Précisions de repère, heure de passage…"></div>
            </div>

            {{-- Méthode de livraison --}}
            <div class="checkout-bloc">
                <h3 class="bloc-titre"><i class="fas fa-truck"></i> Méthode de livraison</h3>
                <div class="livraison-opts">
                    <label class="livr-opt on">
                        <input type="radio" name="livraison" value="standard" checked>
                        <div><div class="livr-nom">Livraison Standard</div><div class="livr-desc">24h à 48h ouvrés</div></div>
                        <span class="livr-prix">Gratuite</span>
                    </label>
                    <label class="livr-opt">
                        <input type="radio" name="livraison" value="coursier">
                        <div><div class="livr-nom">Livraison Express par coursier</div><div class="livr-desc">Même jour (Abidjan & environs)</div></div>
                        <span class="livr-prix">3 000 F CFA</span>
                    </label>
                </div>
            </div>

            {{-- Paiement --}}
            <div class="checkout-bloc">
                <h3 class="bloc-titre"><i class="fas fa-lock"></i> Moyen de paiement</h3>
                <input type="hidden" name="payment_method" id="checkout_payment_method" value="wave">

                <div style="display:flex;flex-direction:column;gap:12px">
                    {{-- Option 1 : Wave --}}
                    <div class="pay-opt-card on" id="opt-wave" onclick="selectCheckoutPayment('wave')" style="display:flex;align-items:center;gap:14px;padding:16px;border:2px solid var(--rose-v);border-radius:12px;background:var(--creme2);cursor:pointer;transition:all .3s">
                        <div style="width:42px;height:42px;background:#1dc8f0;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                            <svg viewBox="0 0 100 100" width="34" height="34" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="50" cy="50" r="50" fill="#1dc8f0"/>
                                <ellipse cx="50" cy="60" rx="22" ry="26" fill="#0b1b28"/>
                                <ellipse cx="50" cy="64" rx="14" ry="18" fill="#ffffff"/>
                                <circle cx="43" cy="46" r="4.5" fill="#ffffff"/>
                                <circle cx="57" cy="46" r="4.5" fill="#ffffff"/>
                                <circle cx="44" cy="46" r="2.2" fill="#0b1b28"/>
                                <circle cx="58" cy="46" r="2.2" fill="#0b1b28"/>
                                <polygon points="45,53 50,60 55,53" fill="#f39c12"/>
                            </svg>
                        </div>
                        <div style="flex:1">
                            <div style="font-size:14px;font-weight:600;color:var(--texte)">Paiement Wave (+225)</div>
                            <div style="font-size:11px;color:var(--texte2);margin-top:2px">Mobile Money rapide & sans frais</div>
                        </div>
                        <i class="fas fa-check-circle" id="check-wave" style="color:var(--rose-v);font-size:18px"></i>
                    </div>

                    {{-- Option 2 : À la livraison --}}
                    <div class="pay-opt-card" id="opt-livraison" onclick="selectCheckoutPayment('livraison')" style="display:flex;align-items:center;gap:14px;padding:16px;border:1.5px solid var(--peche);border-radius:12px;background:var(--blanc);cursor:pointer;transition:all .3s">
                        <div style="width:42px;height:42px;background:var(--brun-d);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                            <i class="fas fa-money-bill-wave" style="color:#fff;font-size:18px"></i>
                        </div>
                        <div style="flex:1">
                            <div style="font-size:14px;font-weight:600;color:var(--texte)">Paiement à la livraison</div>
                            <div style="font-size:11px;color:var(--texte2);margin-top:2px">Payez en espèces directement au livreur</div>
                        </div>
                        <i class="far fa-circle" id="check-livraison" style="color:var(--texte2);font-size:18px"></i>
                    </div>
                </div>

                {{-- Indication Wave --}}
                <div id="wave-input-box" style="margin-top:16px;background:var(--creme2);padding:14px 18px;border-radius:10px;border:1px solid var(--peche2)">
                    <label style="font-size:11px;letter-spacing:1px;text-transform:uppercase;color:var(--texte2);display:block;margin-bottom:6px;font-weight:500">
                        <i class="fas fa-phone" style="color:var(--rose-v);margin-right:4px"></i> Numéro pour le paiement Wave (+225)
                    </label>
                    <input type="tel" name="num_wave" placeholder="+225 07 00 00 00 00" style="width:100%;padding:10px 14px;border:1.5px solid var(--peche);border-radius:8px;font-family:var(--f-corps);font-size:13.5px;outline:none;background:var(--blanc)">
                    <small style="display:block;font-size:11px;color:var(--texte2);margin-top:6px">
                        Un lien de paiement ou une demande Wave vous sera envoyée sur ce numéro.
                    </small>
                </div>

                {{-- Indication Livraison --}}
                <div id="livraison-info-box" style="display:none;margin-top:16px;background:#f0faf5;padding:14px 18px;border-radius:10px;border:1px solid #a8d5be;color:#2d6a4f;font-size:12.5px;line-height:1.6">
                    <i class="fas fa-info-circle" style="margin-right:6px"></i>
                    Vous réglerez le montant exact en espèces auprès de notre livreur à la réception de votre colis.
                </div>
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
        <div class="recap-ligne"><span>Sous-total</span><span>{{ number_format($total,0,',',' ') }} F CFA</span></div>
        <div class="recap-ligne"><span>Livraison</span><span>Gratuite</span></div>
        <div class="recap-total"><span>Total</span><span>{{ number_format($total,0,',',' ') }} F CFA</span></div>
        <button type="submit" form="checkout-form" class="btn btn-rose" style="width:100%;justify-content:center;margin-top:20px;border-radius:50px">
            <i class="fas fa-lock"></i> Confirmer la commande
        </button>
        <div style="text-align:center;margin-top:14px;font-size:11px;color:var(--texte2)"><i class="fas fa-shield-alt" style="color:var(--rose-p)"></i> Paiement 100% sécurisé</div>
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