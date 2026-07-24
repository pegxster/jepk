@extends('admin.layouts.app')
@section('title', 'Nouveau slide')

@section('topbar-actions')
    <a href="{{ route('admin.carrousel.index') }}" class="topbar-btn outline">
        <i class="fa-solid fa-arrow-left"></i> Retour
    </a>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.carrousel.store') }}" enctype="multipart/form-data">
@csrf

<div style="display:grid;grid-template-columns:1fr 340px;gap:24px;align-items:start">

    <div style="display:flex;flex-direction:column;gap:20px">

        <div class="card">
            <div class="card-header"><h2 class="card-title">Image du slide *</h2></div>
            <div class="card-body">
                <div class="upload-zone" id="uploadZone" onclick="document.getElementById('slideImg').click()">
                    <div class="icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                    <p>Glissez votre image ici ou <strong>cliquez pour parcourir</strong></p>
                    <p style="margin-top:6px;font-size:11px">PNG, JPG, WEBP — recommandé 1920×1080 — max 5 Mo</p>
                    <input type="file" id="slideImg" name="image" accept="image/*" required onchange="previewSlide(this)">
                </div>
                <div id="previewWrap" style="display:none;margin-top:16px;position:relative;border-radius:12px;overflow:hidden;aspect-ratio:16/7;background:#2A1D14">
                    <img id="previewImg" src="" style="width:100%;height:100%;object-fit:cover;opacity:.7">
                    <div style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:20px;pointer-events:none" id="previewOverlay">
                        <div id="pvBadge" style="font-size:9px;letter-spacing:3px;text-transform:uppercase;color:rgba(232,137,106,.9);margin-bottom:8px"></div>
                        <div id="pvScript" style="font-family:'Cormorant Garamond',serif;font-size:18px;color:rgba(232,137,106,.9);margin-bottom:6px;font-style:italic"></div>
                        <div id="pvTitle" style="font-family:'Cormorant Garamond',serif;font-size:26px;font-weight:300;color:#fff;line-height:1.1;text-transform:uppercase;letter-spacing:2px"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h2 class="card-title">Textes du slide</h2></div>
            <div class="card-body form-grid">
                <div class="form-group">
                    <label class="form-label">Badge / Accroche <span style="color:#C0B0A8">(petite ligne au-dessus du titre)</span></label>
                    <input type="text" name="badge" value="{{ old('badge') }}" class="form-control"
                           placeholder="Ex: Nouvelle Collection" oninput="updatePreview()">
                </div>
                <div class="form-group">
                    <label class="form-label">Texte script <span style="color:#C0B0A8">(fonte italique)</span></label>
                    <input type="text" name="script" value="{{ old('script') }}" class="form-control"
                           placeholder="Ex: L'art du fil précieux" oninput="updatePreview()">
                </div>
                <div class="form-group">
                    <label class="form-label">Titre principal * <span style="color:#C0B0A8">(saut de ligne = \n)</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" required
                           placeholder="Ex: Création\nArtisanale" oninput="updatePreview()">
                </div>
                <div class="form-group">
                    <label class="form-label">Phrase descriptive</label>
                    <textarea name="phrase" class="form-control" rows="2"
                              placeholder="Des laines d'exception...">{{ old('phrase') }}</textarea>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h2 class="card-title">Boutons d'action</h2></div>
            <div class="card-body form-grid form-grid-2">
                <div class="form-group">
                    <label class="form-label">Bouton 1 — texte</label>
                    <input type="text" name="btn1_text" value="{{ old('btn1_text') }}" class="form-control" placeholder="Découvrir la boutique">
                </div>
                <div class="form-group">
                    <label class="form-label">Bouton 1 — lien</label>
                    <input type="text" name="btn1_url" value="{{ old('btn1_url', '/boutique') }}" class="form-control" placeholder="/boutique">
                </div>
                <div class="form-group">
                    <label class="form-label">Bouton 2 — texte <span style="color:#C0B0A8">(optionnel)</span></label>
                    <input type="text" name="btn2_text" value="{{ old('btn2_text') }}" class="form-control" placeholder="Voir l'atelier">
                </div>
                <div class="form-group">
                    <label class="form-label">Bouton 2 — lien</label>
                    <input type="text" name="btn2_url" value="{{ old('btn2_url') }}" class="form-control" placeholder="/pages/atelier">
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
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                    <span class="toggle-label">Slide actif (visible sur le site)</span>
                </div>
                <div class="form-group">
                    <label class="form-label">Ordre d'affichage</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="form-control" min="0">
                    <p class="form-hint">0 = premier, 1 = deuxième, etc.</p>
                </div>
            </div>
        </div>

        <div class="card" style="background:rgba(155,142,196,.06);border:1px solid rgba(155,142,196,.2)">
            <div class="card-body" style="font-size:13px;color:#6A5A9A;line-height:1.8">
                <strong style="display:block;margin-bottom:8px"><i class="fa-solid fa-lightbulb"></i> Conseils</strong>
                <ul style="padding-left:16px;display:flex;flex-direction:column;gap:6px">
                    <li>Image idéale : <strong>1920×1080px</strong></li>
                    <li>Format paysage recommandé</li>
                    <li>Évitez les images trop claires (le texte serait illisible)</li>
                    <li>Pour un saut de ligne dans le titre, tapez <code style="background:#E8E0F0;padding:1px 5px;border-radius:3px">\n</code></li>
                </ul>
            </div>
        </div>

        <button type="submit" class="topbar-btn" style="width:100%;justify-content:center;padding:14px">
            <i class="fa-solid fa-floppy-disk"></i> Créer le slide
        </button>
    </div>
</div>
</form>
@endsection

@push('scripts')
<script>
function previewSlide(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('previewWrap').style.display = 'block';
            updatePreview();
        };
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
