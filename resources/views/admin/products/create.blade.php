@extends('admin.layouts.app')
@section('title', 'Nouveau produit')

@section('topbar-actions')
    <a href="{{ route('admin.produits.index') }}" class="topbar-btn outline">
        <i class="fa-solid fa-arrow-left"></i> Retour
    </a>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.produits.store') }}" enctype="multipart/form-data">
@csrf

<div style="display:grid;grid-template-columns:1fr 340px;gap:24px;align-items:start">

    {{-- Colonne principale --}}
    <div style="display:flex;flex-direction:column;gap:20px">

        <div class="card">
            <div class="card-header"><h2 class="card-title">Informations générales</h2></div>
            <div class="card-body form-grid">
                <div class="form-group">
                    <label class="form-label">Nom du produit *</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" required placeholder="Ex: Pull en laine mérinos">
                </div>
                <div class="form-group">
                    <label class="form-label">Description courte</label>
                    <textarea name="short_description" class="form-control" rows="2" placeholder="Résumé affiché en boutique...">{{ old('short_description') }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Description complète *</label>
                    <textarea name="description" class="form-control" rows="6" required placeholder="Description détaillée du produit...">{{ old('description') }}</textarea>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h2 class="card-title">Images du produit</h2></div>
            <div class="card-body">
                <div class="upload-zone" id="uploadZone" onclick="document.getElementById('imageInput').click()">
                    <div class="icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                    <p>Glissez vos images ici ou <strong>cliquez pour parcourir</strong></p>
                    <p style="margin-top:6px;font-size:11px">PNG, JPG, WEBP — max 2 Mo par image</p>
                    <input type="file" id="imageInput" name="images[]" multiple accept="image/*" onchange="previewImages(this)">
                </div>
                <div class="image-preview-grid" id="previewGrid"></div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h2 class="card-title">Caractéristiques</h2></div>
            <div class="card-body form-grid form-grid-3">
                <div class="form-group">
                    <label class="form-label">Matières (virgule)</label>
                    <input type="text" name="materials" value="{{ old('materials') }}" class="form-control" placeholder="Laine, Soie, Coton">
                </div>
                <div class="form-group">
                    <label class="form-label">Couleurs (virgule)</label>
                    <input type="text" name="colors" value="{{ old('colors') }}" class="form-control" placeholder="Rose, Beige, Blanc">
                </div>
                <div class="form-group">
                    <label class="form-label">Tags (virgule)</label>
                    <input type="text" name="tags" value="{{ old('tags') }}" class="form-control" placeholder="hiver, tendance, promo">
                </div>
            </div>
        </div>
    </div>

    {{-- Colonne latérale --}}
    <div style="display:flex;flex-direction:column;gap:20px">

        <div class="card">
            <div class="card-header"><h2 class="card-title">Publication</h2></div>
            <div class="card-body" style="display:flex;flex-direction:column;gap:16px">
                <div class="toggle-group">
                    <label class="toggle">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                    <span class="toggle-label">Produit actif (visible en boutique)</span>
                </div>
                <div class="toggle-group">
                    <label class="toggle">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                    <span class="toggle-label">Produit vedette (page d'accueil)</span>
                </div>
                <div class="form-group">
                    <label class="form-label">Badge</label>
                    <select name="badge" class="form-control">
                        <option value="">Aucun</option>
                        <option value="Nouveau" {{ old('badge') == 'Nouveau' ? 'selected' : '' }}>Nouveau</option>
                        <option value="Promo" {{ old('badge') == 'Promo' ? 'selected' : '' }}>Promo</option>
                        <option value="Exclusif" {{ old('badge') == 'Exclusif' ? 'selected' : '' }}>Exclusif</option>
                        <option value="Derniers" {{ old('badge') == 'Derniers' ? 'selected' : '' }}>Derniers</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h2 class="card-title">Prix & Stock</h2></div>
            <div class="card-body form-grid">
                <div class="form-group">
                    <label class="form-label">Prix (FCFA) *</label>
                    <input type="number" name="price" value="{{ old('price') }}" class="form-control" required min="0" step="0.01" placeholder="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Prix promo (FCFA)</label>
                    <input type="number" name="sale_price" value="{{ old('sale_price') }}" class="form-control" min="0" step="0.01" placeholder="Laisser vide si pas de promo">
                </div>
                <div class="form-group">
                    <label class="form-label">Stock *</label>
                    <input type="number" name="stock" value="{{ old('stock', 0) }}" class="form-control" required min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">SKU (référence)</label>
                    <input type="text" name="sku" value="{{ old('sku') }}" class="form-control" placeholder="JEPK-001">
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h2 class="card-title">Catégorie</h2></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Catégorie</label>
                    <select name="category_id" class="form-control">
                        <option value="">Sans catégorie</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->_id }}" {{ old('category_id') == $cat->_id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <button type="submit" class="topbar-btn" style="width:100%;justify-content:center;padding:14px">
            <i class="fa-solid fa-floppy-disk"></i> Enregistrer le produit
        </button>
    </div>
</div>
</form>
@endsection

@push('scripts')
<script>
function previewImages(input) {
    const grid = document.getElementById('previewGrid');
    const files = Array.from(input.files);
    files.forEach((file, i) => {
        const reader = new FileReader();
        reader.onload = e => {
            const div = document.createElement('div');
            div.className = 'image-preview-item';
            div.innerHTML = `<img src="${e.target.result}" alt="">
                <button type="button" class="remove-img" onclick="this.parentElement.remove()">
                    <i class="fa-solid fa-xmark"></i>
                </button>`;
            grid.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
}

const zone = document.getElementById('uploadZone');
zone.addEventListener('dragover', e => { e.preventDefault(); zone.classList.add('drag-over'); });
zone.addEventListener('dragleave', () => zone.classList.remove('drag-over'));
zone.addEventListener('drop', e => {
    e.preventDefault();
    zone.classList.remove('drag-over');
    const input = document.getElementById('imageInput');
    const dt = new DataTransfer();
    Array.from(e.dataTransfer.files).forEach(f => dt.items.add(f));
    input.files = dt.files;
    previewImages(input);
});
</script>
@endpush
