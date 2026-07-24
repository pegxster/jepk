@extends('admin.layouts.app')
@section('title', 'Nouvel article')

@section('topbar-actions')
    <a href="{{ route('admin.blog.index') }}" class="topbar-btn outline">
        <i class="fa-solid fa-arrow-left"></i> Retour
    </a>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data">
@csrf

<div style="display:grid;grid-template-columns:1fr 320px;gap:24px;align-items:start">

    <div style="display:flex;flex-direction:column;gap:20px">
        <div class="card">
            <div class="card-header"><h2 class="card-title">Contenu de l'article</h2></div>
            <div class="card-body form-grid">
                <div class="form-group">
                    <label class="form-label">Titre *</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" required placeholder="Ex: Comment choisir sa laine mérinos ?">
                </div>
                <div class="form-group">
                    <label class="form-label">Extrait</label>
                    <textarea name="excerpt" class="form-control" rows="2" placeholder="Résumé affiché sur la liste d'articles...">{{ old('excerpt') }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Contenu *</label>
                    <textarea name="content" class="form-control" rows="12" required placeholder="Rédigez votre article ici...">{{ old('content') }}</textarea>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h2 class="card-title">Image principale</h2></div>
            <div class="card-body">
                <div class="upload-zone" onclick="document.getElementById('blogImage').click()">
                    <div class="icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                    <p>Glissez votre image ici ou <strong>cliquez pour parcourir</strong></p>
                    <p style="margin-top:6px;font-size:11px">PNG, JPG — max 3 Mo</p>
                    <input type="file" id="blogImage" name="image" accept="image/*" onchange="previewBlogImage(this)">
                </div>
                <img id="blogImagePreview" src="" style="display:none;width:100%;border-radius:10px;margin-top:12px;max-height:200px;object-fit:cover">
            </div>
        </div>
    </div>

    <div style="display:flex;flex-direction:column;gap:20px">

        <div class="card">
            <div class="card-header"><h2 class="card-title">Publication</h2></div>
            <div class="card-body" style="display:flex;flex-direction:column;gap:16px">
                <div class="toggle-group">
                    <label class="toggle">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                    <span class="toggle-label">Publier maintenant</span>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h2 class="card-title">Classement</h2></div>
            <div class="card-body form-grid">
                <div class="form-group">
                    <label class="form-label">Catégorie *</label>
                    <select name="category" class="form-control" required>
                        <option value="">Choisir...</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Tags (virgule)</label>
                    <input type="text" name="tags" value="{{ old('tags') }}" class="form-control" placeholder="laine, tutoriel, débutant">
                </div>
            </div>
        </div>

        <button type="submit" class="topbar-btn" style="width:100%;justify-content:center;padding:14px">
            <i class="fa-solid fa-floppy-disk"></i> Enregistrer l'article
        </button>
    </div>
</div>
</form>
@endsection

@push('scripts')
<script>
function previewBlogImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById('blogImagePreview');
            img.src = e.target.result;
            img.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
