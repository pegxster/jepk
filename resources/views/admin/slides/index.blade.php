@extends('admin.layouts.app')
@section('title', 'Carrousel')

@section('topbar-actions')
    <a href="{{ route('admin.carrousel.create') }}" class="topbar-btn">
        <i class="fa-solid fa-plus"></i> Nouveau slide
    </a>
@endsection

@section('content')

<div style="margin-bottom:16px" class="alert" style="background:rgba(155,142,196,.1);border:1px solid rgba(155,142,196,.3);color:#6A5A9A">
    <i class="fa-solid fa-circle-info" style="color:var(--lav)"></i>
    <span style="font-size:13px">Les slides s'affichent dans l'ordre défini. Si aucun slide n'est actif, le carrousel statique par défaut est utilisé.</span>
</div>

@if($slides->isEmpty())
<div class="card">
    <div class="card-body" style="text-align:center;padding:60px">
        <i class="fa-solid fa-images" style="font-size:48px;color:#D0C8C0;display:block;margin-bottom:16px"></i>
        <h3 style="font-family:'Cormorant Garamond',serif;font-size:22px;margin-bottom:8px">Aucun slide configuré</h3>
        <p style="color:#9A8070;margin-bottom:24px">Le site affiche actuellement le carrousel par défaut.</p>
        <a href="{{ route('admin.carrousel.create') }}" class="topbar-btn" style="display:inline-flex">
            <i class="fa-solid fa-plus"></i> Créer le premier slide
        </a>
    </div>
</div>
@else
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:20px">
    @foreach($slides as $i => $slide)
    <div class="card" style="overflow:visible">
        {{-- Aperçu image --}}
        <div style="position:relative;aspect-ratio:16/7;overflow:hidden;border-radius:14px 14px 0 0;background:#2A1D14">
            @if($slide->image)
                <img src="{{ asset('storage/'.$slide->image) }}"
                     style="width:100%;height:100%;object-fit:cover;opacity:.7" alt="">
            @else
                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.2)">
                    <i class="fa-solid fa-image" style="font-size:40px"></i>
                </div>
            @endif

            {{-- Overlay texte preview --}}
            <div style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:16px;pointer-events:none">
                @if($slide->badge)
                    <div style="font-size:9px;letter-spacing:3px;text-transform:uppercase;color:rgba(232,137,106,.9);margin-bottom:6px">
                        {{ $slide->badge }}
                    </div>
                @endif
                @if($slide->script)
                    <div style="font-family:'Cormorant Garamond',serif;font-size:16px;color:rgba(232,137,106,.9);margin-bottom:4px">
                        {{ $slide->script }}
                    </div>
                @endif
                <div style="font-family:'Cormorant Garamond',serif;font-size:22px;font-weight:300;color:#fff;line-height:1.1;text-transform:uppercase;letter-spacing:2px">
                    {!! nl2br(e($slide->title)) !!}
                </div>
            </div>

            {{-- Badges état --}}
            <div style="position:absolute;top:10px;left:10px;display:flex;gap:6px">
                <span style="background:rgba(0,0,0,.5);color:#fff;font-size:10px;font-weight:700;padding:3px 8px;border-radius:4px">
                    #{{ $i + 1 }}
                </span>
                <span style="background:{{ $slide->is_active ? 'rgba(39,174,96,.8)' : 'rgba(200,100,100,.8)' }};color:#fff;font-size:10px;font-weight:700;padding:3px 8px;border-radius:4px">
                    {{ $slide->is_active ? 'Actif' : 'Inactif' }}
                </span>
            </div>
        </div>

        {{-- Infos et actions --}}
        <div style="padding:16px 18px">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px">
                <div style="font-size:13px;font-weight:600;color:var(--dark)">
                    Ordre : {{ $slide->sort_order ?? $i }}
                </div>
                <div style="font-size:12px;color:#9A8070">
                    @if($slide->btn1_text)
                        <i class="fa-solid fa-link"></i> {{ $slide->btn1_text }}
                        @if($slide->btn2_text) · {{ $slide->btn2_text }}@endif
                    @endif
                </div>
            </div>
            <div style="display:flex;gap:8px">
                <a href="{{ route('admin.carrousel.edit', $slide) }}" class="topbar-btn outline" style="flex:1;justify-content:center;padding:9px;font-size:13px">
                    <i class="fa-solid fa-pen"></i> Modifier
                </a>
                <form method="POST" action="{{ route('admin.carrousel.destroy', $slide) }}"
                      onsubmit="return confirm('Supprimer ce slide ?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="topbar-btn" style="background:linear-gradient(135deg,#e74c3c,#c0392b);padding:9px 14px">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

@endsection
