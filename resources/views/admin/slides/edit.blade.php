@extends('admin.layouts.app')
@section('title', 'Modifier le slide')

@section('topbar-actions')
    <a href="{{ route('admin.carrousel.index') }}" class="topbar-btn outline">
        <i class="fa-solid fa-arrow-left"></i> Retour
    </a>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.carrousel.update', $slide) }}" enctype="multipart/form-data">
@csrf @method('PUT')

<div style="display:grid;grid-template-columns:1fr 340px;gap:24px;align-items:start">

    <div style="display:flex;flex-direction:column;gap:20px">

        <div class="card">
            <div class="card-header"><h2 class="card-title">Image du slide</h2></div>
            <div class="card-body">
                {{-- Aperçu actuel --}}
                <div id="previewWrap" style="position:relative;border-radius:12px;overflow:hidden;aspect-ratio:16/7;background:#2A1D14;margin-bottom:16px">
                    <img id="previewImg" src="{{ asset('storage/'.$slide->image) }}"
                         style="width:100%;height:100%;object-fit:cover;opacity:.7">
                    <div style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:20px;pointer-events:none" id="previewOverlay">
                        <div id="pvBadge" style="font-size:9px;letter-spacing:3px;text-transform:uppercase;color:rgba(232,137,106,.9);margin-bottom:8px">{{ $slide->badge }}</div>
                        <div id="pvScript" style="font-family:'Cormorant Garamond',serif;font-size:18px;color:rgba(232,137,106,.9);margin-bottom:6px;font-style:italic">{{ $slide->script }}</div>
                        <div id="pvTitle" style="font-family:'Cormorant Garamond',serif;font-size:26px;font-weight:300;color:#fff;line-height:1.1;text-transform:uppercase;letter-spacing:2px">
                            {!! collect(explode('\n', $slide->title))->map(fn($l)=>"<span style='display:block'>".e($l)."</span>")->implode('') !!}
                        </div>
                    </div>
                </div>

                <div class="upload-zone" onclick="document.getElementById('slideImg').click()" style="padding:16px">
                    <i class="fa-solid fa-arrows-rotate" style="color:#C0B0A8;font-size:22px"></i>
                    <span style="font-size:13px;color:#9A8070;margin-left:10px">Cliquer pour remplacer l'image</span>
                    <input type="file" id="slideImg" name="image" accept="image/*" onchange="previewSlide(this)">
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h2 class="card-title">Textes</h2></div>
            <div class="card-body form-grid">
                <div class="form-group">
                    <label class="form-label">Badge / Accroche</label>
                    <input type="text" name="badge" value="{{ old('badge', $slide->badge) }}" class="form-control" oninput="updatePreview()">
                </div>
                <div class="form-group">
                    <label class="form-label">Texte script (italique)</label>
                    <input type="text" name="script" value="{{ old('script', $slide->script) }}" class="form-control" oninput="updatePreview()">
                </div>
                <div class="form-group">
                    <label class="form-label">Titre principal *</label>
                    <input type="text" name="title" value="{{ old('title', $slide->title) }}" class="form-control" required oninput="updatePreview()">
                </div>
                <div class="form-group">
                    <label class="form-label">Phrase descriptive</label>
                    <textarea name="phrase" class="form-control" rows="2">{{ old('phrase', $slide->phrase) }}</textarea>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h2 class="card-title">Boutons</h2></div>
            <div class="card-body form-grid form-grid-2">
                <div class="form-group">
                    <label class="form-label">Bouton 1 — texte</label>
                    <input type="text" name="btn1_text" value="{{ old('btn1_text', $slide->btn1_text) }}" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Bouton 1 — lien</label>
                    <input type="text" name="btn1_url" value="{{ old('btn1_url', $slide->btn1_url) }}" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Bouton 2 — texte</label>
                    <input type="text" name="btn2_text" value="{{ old('btn2_text', $slide->btn2_text) }}" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Bouton 2 — lien</label>
                    <input type="text" name="btn2_url" value="{{ old('btn2_url', $slide->btn2_url) }}" class="form-control">
                </div>
            </div>
        </div>
    </div>

    <div style="display:flex;flex-direction:column;gap:20px">
        <div class="card">
            <div class="card-header"><h2 class="card-title">Options</h2></div>
            <div class="card-body" style="display:flex;flex-direction:column;gap:16px">
                <div class="toggle-group">
                    <label class="toggle">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $slide->is_active) ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                    <span class="toggle-label">Slide actif</span>
                </div>
                <div class="form-group">
                    <label class="form-label">Ordre</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $slide->sort_order) }}" class="form-control" min="0">
                </div>
            </div>
        </div>

        <div style="display:flex;gap:10px">
            <button type="submit" class="topbar-btn" style="flex:1;justify-content:center;padding:14px">
                <i class="fa-solid fa-floppy-disk"></i> Enregistrer
            </button>
            <form method="POST" action="{{ route('admin.carrousel.destroy', $slide) }}"
                  onsubmit="return confirm('Supprimer ce slide ?')">
                @csrf @method('DELETE')
                <button type="submit" class="topbar-btn" style="background:linear-gradient(135deg,#e74c3c,#c0392b)">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </form>
        </div>
    </div>
</div>
</form>
@endsection

@push('scripts')
<script>
function previewSlide(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { document.getElementById('previewImg').src = e.target.result; };
        reader.readAsDataURL(input.files[0]);
    }
}
function updatePreview() {
    document.getElementById('pvBadge').textContent  = document.querySelector('[name=badge]').value;
    document.getElementById('pvScript').textContent = document.querySelector('[name=script]').value;
    const title = document.querySelector('[name=title]').value.replace(/\\n/g, '\n');
    document.getElementById('pvTitle').innerHTML = title.split('\n').map(l => `<span style="display:block">${l}</span>`).join('');
}
</script>
@endpush
