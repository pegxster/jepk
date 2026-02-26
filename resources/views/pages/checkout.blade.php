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
@media(max-width:900px){.checkout-layout{grid-template-columns:1fr;padding:30px 24px}.f-row{grid-template-columns:1fr}.paiement-opts{grid-template-columns:1fr 1fr}}
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
                    <div class="f-g"><label>Prénom</label><input type="text" name="prenom" value="{{ auth()->user()->prenom ?? '' }}" placeholder="Marie" required></div>
                    <div class="f-g"><label>Nom</label><input type="text" name="nom" value="{{ auth()->user()->nom ?? '' }}" placeholder="Dupont" required></div>
                </div>
                <div class="f-g"><label>Adresse</label><input type="text" name="adresse" placeholder="12 rue des Fleurs" required></div>
                <div class="f-row">
                    <div class="f-g"><label>Code postal</label><input type="text" name="code_postal" placeholder="75001" required></div>
                    <div class="f-g"><label>Ville</label><input type="text" name="ville" placeholder="Paris" required></div>
                </div>
                <div class="f-g"><label>Pays</label><select name="pays"><option>France</option><option>Belgique</option><option>Suisse</option><option>Canada</option><option>Autres</option></select></div>
                <div class="f-g"><label>Téléphone</label><input type="tel" name="telephone" placeholder="+33 6 00 00 00 00"></div>
                <div class="f-g"><label>Note pour la commande (optionnel)</label><input type="text" name="note" placeholder="Instructions spéciales, sonnette…"></div>
            </div>

            {{-- Méthode de livraison --}}
            <div class="checkout-bloc">
                <h3 class="bloc-titre"><i class="fas fa-truck"></i> Méthode de livraison</h3>
                <div class="livraison-opts">
                    <label class="livr-opt on">
                        <input type="radio" name="livraison" value="standard" checked>
                        <div><div class="livr-nom">Livraison Standard</div><div class="livr-desc">3 à 5 jours ouvrés</div></div>
                        <span class="livr-prix">Gratuite</span>
                    </label>
                    <label class="livr-opt">
                        <input type="radio" name="livraison" value="express">
                        <div><div class="livr-nom">Livraison Express</div><div class="livr-desc">24 à 48h</div></div>
                        <span class="livr-prix">7,90 €</span>
                    </label>
                    <label class="livr-opt">
                        <input type="radio" name="livraison" value="colissimo">
                        <div><div class="livr-nom">Colissimo</div><div class="livr-desc">2 à 3 jours ouvrés + suivi</div></div>
                        <span class="livr-prix">4,90 €</span>
                    </label>
                </div>
            </div>

            {{-- Paiement --}}
            <div class="checkout-bloc">
                <h3 class="bloc-titre"><i class="fas fa-lock"></i> Paiement</h3>
                <div class="paiement-opts">
                    <div class="pay-opt on"><i class="far fa-credit-card"></i><span>Carte bancaire</span></div>
                    <div class="pay-opt"><i class="fab fa-paypal"></i><span>PayPal</span></div>
                </div>
                <div class="f-g"><label>Numéro de carte</label><input type="text" placeholder="1234 5678 9012 3456" maxlength="19"></div>
                <div class="f-row">
                    <div class="f-g"><label>Date d'expiration</label><input type="text" placeholder="MM/AA"></div>
                    <div class="f-g"><label>CVV</label><input type="text" placeholder="123" maxlength="3"></div>
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
            @php $sous=$item['prix']*$item['qte'];$total+=$sous; @endphp
            <div class="recap-item">
                <img src="{{ $item['img'] ?? 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=200' }}" alt="">
                <div><div class="ri-nom">{{ $item['nom'] }} x{{ $item['qte'] }}</div><div class="ri-prix">{{ number_format($sous,2,',',' ') }} €</div></div>
            </div>
            @endforeach
        @else
            <div class="recap-item"><img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=200" alt=""><div><div class="ri-nom">Kit Pull Couture N°1 x1</div><div class="ri-prix">68,00 €</div></div></div>
            @php $total=68; @endphp
        @endif
        <div class="recap-ligne"><span>Sous-total</span><span>{{ number_format($total,2,',',' ') }} €</span></div>
        <div class="recap-ligne"><span>Livraison</span><span>Gratuite</span></div>
        <div class="recap-total"><span>Total</span><span>{{ number_format($total,2,',',' ') }} €</span></div>
        <button type="submit" form="checkout-form" class="btn btn-rose" style="width:100%;justify-content:center;margin-top:20px;border-radius:50px">
            <i class="fas fa-lock"></i> Confirmer la commande
        </button>
        <div style="text-align:center;margin-top:14px;font-size:11px;color:var(--texte2)"><i class="fas fa-shield-alt" style="color:var(--rose-p)"></i> Paiement 100% sécurisé</div>
    </div>
</div>

@push('scripts')
<script>
document.querySelectorAll('.livr-opt').forEach(o=>o.addEventListener('click',()=>{document.querySelectorAll('.livr-opt').forEach(x=>x.classList.remove('on'));o.classList.add('on')}));
document.querySelectorAll('.pay-opt').forEach(o=>o.addEventListener('click',()=>{document.querySelectorAll('.pay-opt').forEach(x=>x.classList.remove('on'));o.classList.add('on')}));
</script>
@endpush
@endsection