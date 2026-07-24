@extends('admin.layouts.app')
@section('title', 'Équipe admin')

@section('topbar-actions')
    <button onclick="document.getElementById('modalAjout').style.display='flex'" class="topbar-btn">
        <i class="fa-solid fa-user-plus"></i> Ajouter un accès
    </button>
@endsection

@section('content')

@if(session('success'))
<div style="background:#f0faf5;border:1px solid #a8d5be;color:#2d6a4f;padding:14px 18px;border-radius:10px;margin-bottom:20px;font-size:13px">
    <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
</div>
@endif
@if(session('error'))
<div style="background:#fff0f0;border:1px solid #f5baba;color:#c0392b;padding:14px 18px;border-radius:10px;margin-bottom:20px;font-size:13px">
    <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
</div>
@endif
@if($errors->any())
<div style="background:#fff0f0;border:1px solid #f5baba;color:#c0392b;padding:14px 18px;border-radius:10px;margin-bottom:20px;font-size:13px">
    <i class="fa-solid fa-triangle-exclamation"></i>
    @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
</div>
@endif

{{-- Grille membres --}}
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:20px;margin-bottom:32px">
    @forelse($team as $member)
    <div style="background:#fff;border-radius:16px;padding:24px;border:1px solid #EDE5DC;box-shadow:0 2px 8px rgba(0,0,0,.04);display:flex;flex-direction:column;align-items:center;text-align:center;gap:12px;position:relative">

        {{-- Initiales --}}
        <div style="width:64px;height:64px;border-radius:50%;background:linear-gradient(135deg,#D4547A,#9B8EC4);display:flex;align-items:center;justify-content:center;font-family:'Cormorant Garamond',serif;font-size:28px;color:#fff">
            {{ strtoupper(substr($member->prenom ?? $member->name ?? 'A', 0, 1)) }}
        </div>

        <div>
            <div style="font-weight:700;font-size:15px;color:#3D2B1F">
                {{ $member->prenom ?? '' }} {{ $member->nom ?? $member->name ?? '' }}
            </div>
            <div style="font-size:12px;color:#9A8070;margin-top:2px">{{ $member->email }}</div>
        </div>

        <span style="background:rgba(212,84,122,.1);color:#D4547A;font-size:11px;font-weight:700;letter-spacing:1px;padding:4px 12px;border-radius:20px;text-transform:uppercase">
            Administrateur
        </span>

        <div style="font-size:11px;color:#B0A098">
            Depuis le {{ $member->created_at?->format('d/m/Y') ?? '—' }}
        </div>

        {{-- Supprimer (sauf soi-même) --}}
        @if((string) $member->_id !== (string) auth()->id())
        <form method="POST" action="{{ route('admin.team.destroy', $member) }}"
              onsubmit="return confirm('Révoquer l\'accès admin de {{ addslashes($member->prenom ?? $member->name) }} ?')"
              style="position:absolute;top:14px;right:14px">
            @csrf @method('DELETE')
            <button type="submit" class="btn-act del" title="Révoquer l'accès" style="width:32px;height:32px">
                <i class="fa-solid fa-user-minus"></i>
            </button>
        </form>
        @else
        <span style="position:absolute;top:18px;right:14px;font-size:11px;color:#9A8070;background:#F5F0EA;padding:3px 9px;border-radius:20px">Vous</span>
        @endif
    </div>
    @empty
    <div style="grid-column:1/-1;text-align:center;padding:50px;color:#B0A098">
        <i class="fa-solid fa-user-shield" style="font-size:36px;display:block;margin-bottom:12px;color:#DDD0C8"></i>
        Aucun administrateur trouvé
    </div>
    @endforelse
</div>

{{-- Info --}}
<div style="background:#FFF8F0;border:1px solid #EDE5DC;border-radius:12px;padding:18px 22px;font-size:13px;color:#7A6050">
    <i class="fa-solid fa-circle-info" style="color:#9B8EC4;margin-right:8px"></i>
    Les membres de l'équipe ont un accès complet au tableau de bord. Créez leurs comptes ici — ils ne peuvent pas s'inscrire via le site public.
</div>


{{-- Modal ajout --}}
<div id="modalAjout" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:999;align-items:center;justify-content:center">
    <div style="background:#fff;border-radius:18px;padding:36px;width:100%;max-width:480px;position:relative;box-shadow:0 20px 60px rgba(0,0,0,.2)">
        <h2 style="font-family:'Cormorant Garamond',serif;font-size:24px;font-weight:300;color:#3D2B1F;margin-bottom:24px">
            <i class="fa-solid fa-user-plus" style="color:#D4547A;font-size:18px"></i> Nouvel accès administrateur
        </h2>

        <form method="POST" action="{{ route('admin.team.store') }}">
            @csrf
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px">
                <div class="form-group">
                    <label class="form-label">Prénom *</label>
                    <input type="text" name="prenom" value="{{ old('prenom') }}" class="form-control" placeholder="Marie" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Nom *</label>
                    <input type="text" name="nom" value="{{ old('nom') }}" class="form-control" placeholder="Dupont" required>
                </div>
            </div>
            <div class="form-group" style="margin-bottom:14px">
                <label class="form-label">Email *</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="marie@jepk.com" required>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:24px">
                <div class="form-group">
                    <label class="form-label">Mot de passe *</label>
                    <input type="password" name="password" class="form-control" placeholder="8 caractères min." required>
                </div>
                <div class="form-group">
                    <label class="form-label">Confirmer *</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmer…" required>
                </div>
            </div>

            <div style="display:flex;gap:10px;justify-content:flex-end">
                <button type="button" onclick="document.getElementById('modalAjout').style.display='none'"
                        class="topbar-btn outline">Annuler</button>
                <button type="submit" class="topbar-btn">
                    <i class="fa-solid fa-user-plus"></i> Créer l'accès
                </button>
            </div>
        </form>

        <button onclick="document.getElementById('modalAjout').style.display='none'"
                style="position:absolute;top:16px;right:16px;background:none;border:none;font-size:18px;color:#9A8070;cursor:pointer">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Rouvrir le modal si validation échouée
@if($errors->any())
document.getElementById('modalAjout').style.display = 'flex';
@endif

// Fermer en cliquant en dehors
document.getElementById('modalAjout').addEventListener('click', function(e) {
    if (e.target === this) this.style.display = 'none';
});
</script>
@endpush
