@extends('admin.layouts.app')
@section('title', 'Modifier : '.$product->name)

@section('topbar-actions')
    <a href="{{ route('admin.produits.index') }}" class="topbar-btn outline">
        <i class="fa-solid fa-arrow-left"></i> Retour
    </a>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.produits.update', $product) }}" enctype="multipart/form-data">
@csrf @method('PUT')

<div style="display:grid;grid-template-columns:1fr 340px;gap:24px;align-items:start">

    <div style="display:flex;flex-direction:column;gap:20px">

        <div class="card">
            <div class="card-header"><h2 class="card-title">Informations générales</h2></div>
            <div class="card-body form-grid">
                <div class="form-group">
                    <label class="form-label">Nom du produit *</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Description courte</label>
                    <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $product->short_description) }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Description complète *</label>
                    <textarea name="description" class="form-control" rows="6" required>{{ old('description', $product->description) }}</textarea>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h2 class="card-title">Images</h2></div>
            <div class="card-body">

                {{-- Images existantes --}}
                @if(!empty($product->images) && count($product->images))
                <p class="form-hint" style="margin-bottom:12px">Images actuelles (cochez pour supprimer)</p>
                <div class="image-preview-grid" style="margin-bottom:20px">
                    @foreach($product->images as $img)
                    <div class="image-preview-item" id="img-{{ $loop->index }}">
                        <img src="{{ product_image_url($img) }}" alt="">
                        <label style="position:absolute;bottom:0;left:0;right:0;background:rgba(0,0,0,.5);display:flex;align-items:center;justify-content:center;padding:4px;cursor:pointer">
                            <input type="checkbox" name="remove_images[]" value="{{ $img }}"
                                onchange="this.closest('.image-preview-item').style.opacity=this.checked?'.4':'1'">
                            <span style="color:#fff;font-size:10px;margin-left:4px">Supprimer</span>
                        </label>
                    </div>
                    @endforeach
                </div>
                @endif

                <div class="upload-zone" onclick="document.getElementById('imageInput').click()">
                    <div class="icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                    <p>Ajouter de nouvelles images</p>
                    <input type="file" id="imageInput" name="images[]" multiple accept="image/*" onchange="previewImages(this)">
                </div>
                <div class="image-preview-grid" id="previewGrid"></div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h2 class="card-title">Caractéristiques</h2></div>
            <div class="card-body form-grid form-grid-3">
                <div class="form-group">
                    <label class="form-label">Matières</label>
                    <input type="text" name="materials" value="{{ old('materials', implode(', ', $product->materials ?? [])) }}" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Couleurs</label>
                    <input type="text" name="colors" value="{{ old('colors', implode(', ', $product->colors ?? [])) }}" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Tags</label>
                    <input type="text" name="tags" value="{{ old('tags', implode(', ', $product->tags ?? [])) }}" class="form-control">
                </div>
            </div>
        </div>
    </div>

    <div style="display:flex;flex-direction:column;gap:20px">

        <div class="card">
            <div class="card-header"><h2 class="card-title">Publication</h2></div>
            <div class="card-body" style="display:flex;flex-direction:column;gap:16px">
                <div class="toggle-group">
                    <label class="toggle">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                    <span class="toggle-label">Produit actif</span>
                </div>
                <div class="toggle-group">
                    <label class="toggle">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                    <span class="toggle-label">Produit vedette</span>
                </div>
                <div class="form-group">
                    <label class="form-label">Badge</label>
                    <select name="badge" class="form-control">
                        <option value="">Aucun</option>
                        @foreach(['Nouveau', 'Promo', 'Exclusif', 'Derniers'] as $b)
                        <option value="{{ $b }}" {{ old('badge', $product->badge) == $b ? 'selected' : '' }}>{{ $b }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h2 class="card-title">Prix & Stock</h2></div>
            <div class="card-body form-grid">
                <div class="form-group">
                    <label class="form-label">Prix (FCFA) *</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" class="form-control" required min="0" step="0.01">
                </div>
                <div class="form-group">
                    <label class="form-label">Prix promo (FCFA)</label>
                    <input type="number" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" class="form-control" min="0" step="0.01">
                </div>
                <div class="form-group">
                    <label class="form-label">Stock *</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="form-control" required min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">SKU</label>
                    <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="form-control">
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h2 class="card-title">Catégorie</h2></div>
            <div class="card-body">
                <div class="form-group">
                    <select name="category_id" class="form-control">
                        <option value="">Sans catégorie</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->_id }}" {{ old('category_id', $product->category_id) == $cat->_id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div style="display:flex;gap:10px">
            <button type="submit" class="topbar-btn" style="flex:1;justify-content:center;padding:14px">
                <i class="fa-solid fa-floppy-disk"></i> Enregistrer
            </button>
            <form method="POST" action="{{ route('admin.produits.destroy', $product) }}"
                  onsubmit="return confirm('Supprimer ce produit définitivement ?')">
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
function previewImages(input) {
    const grid = document.getElementById('previewGrid');
    Array.from(input.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const div = document.createElement('div');
            div.className = 'image-preview-item';
            div.innerHTML = `<img src="${e.target.result}">
                <button type="button" class="remove-img" onclick="this.parentElement.remove()">
                    <i class="fa-solid fa-xmark"></i>
                </button>`;
            grid.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
}
</script>
@endpush
