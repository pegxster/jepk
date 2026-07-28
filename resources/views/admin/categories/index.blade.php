@extends('admin.layouts.app')
@section('title', 'Catégories')

@push('styles')
<style>
.modal-overlay {
    display:none;position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:200;
    align-items:center;justify-content:center;
}
.modal-overlay.show { display:flex; }
.modal {
    background:#fff;border-radius:16px;width:100%;max-width:480px;
    box-shadow:0 20px 60px rgba(0,0,0,.2);overflow:hidden;
}
.modal-head {
    padding:20px 24px;border-bottom:1px solid #F0E8E0;
    display:flex;justify-content:space-between;align-items:center;
}
.modal-head h3 { font-family:'Cormorant Garamond',serif;font-size:20px;font-weight:600; }
.modal-body { padding:24px;display:flex;flex-direction:column;gap:16px; }
.modal-foot { padding:16px 24px;border-top:1px solid #F0E8E0;display:flex;gap:10px;justify-content:flex-end; }
</style>
@endpush

@section('topbar-actions')
    <button onclick="openModal()" class="topbar-btn">
        <i class="fa-solid fa-plus"></i> Nouvelle catégorie
    </button>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">{{ $categories->count() }} catégorie(s)</h2>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width:60px"></th>
                    <th>Nom</th>
                    <th>Slug</th>
                    <th>Produits</th>
                    <th>Statut</th>
                    <th>Ordre</th>
                    <th style="width:120px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $cat)
                <tr>
                    <td>
                        @if($cat->image)
                            <img src="{{ product_image_url($cat->image ?? null) }}" class="prod-thumb" alt="">
                        @else
                            <div class="prod-thumb" style="display:flex;align-items:center;justify-content:center;color:#C0B0A8">
                                <i class="fa-solid fa-tag"></i>
                            </div>
                        @endif
                    </td>
                    <td><strong>{{ $cat->name }}</strong></td>
                    <td style="font-size:12px;color:#9A8070;font-family:monospace">{{ $cat->slug }}</td>
                    <td>{{ \App\Models\Product::where('category_id', (string)$cat->_id)->count() }}</td>
                    <td>
                        <span class="badge {{ $cat->is_active ? 'badge-active' : 'badge-inactive' }}">
                            {{ $cat->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>{{ $cat->sort_order ?? 0 }}</td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <button onclick="editModal({{ $cat->toJson() }}, {!! json_encode($cat->image ? product_image_url($cat->image) : '') !!})" class="btn-act edit" title="Modifier">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}"
                                  onsubmit="return confirm('Supprimer cette catégorie ?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-act del" title="Supprimer">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:40px;color:#B0A098">
                        <i class="fa-solid fa-tags" style="font-size:32px;display:block;margin-bottom:10px"></i>
                        Aucune catégorie. <button onclick="openModal()" style="color:var(--rose);background:none;border:none;cursor:pointer;font-weight:600">Créer la première</button>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Créer / Éditer --}}
<div class="modal-overlay" id="modalOverlay">
    <div class="modal">
        <div class="modal-head">
            <h3 id="modalTitle">Nouvelle catégorie</h3>
            <button onclick="closeModal()" style="background:none;border:none;font-size:18px;cursor:pointer;color:#9A8070">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <form id="categoryForm" method="POST" enctype="multipart/form-data">
            @csrf
            <span id="methodField"></span>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nom *</label>
                    <input type="text" name="name" id="catName" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" id="catDesc" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Image</label>
                    <div class="upload-zone" style="padding:16px" onclick="document.getElementById('catImage').click()">
                        <i class="fa-solid fa-image" style="color:#C0B0A8"></i>
                        <span style="font-size:13px;color:#9A8070;margin-left:8px">Cliquer pour choisir une image</span>
                        <input type="file" id="catImage" name="image" accept="image/*" onchange="previewCatImage(this)">
                    </div>
                    <img id="catImagePreview" src="" style="display:none;width:100%;border-radius:8px;margin-top:8px;object-fit:cover;max-height:120px">
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
                    <div class="form-group">
                        <label class="form-label">Ordre d'affichage</label>
                        <input type="number" name="sort_order" id="catOrder" value="0" class="form-control" min="0">
                    </div>
                    <div class="form-group" style="justify-content:flex-end">
                        <label class="form-label">&nbsp;</label>
                        <div class="toggle-group">
                            <label class="toggle">
                                <input type="checkbox" name="is_active" id="catActive" value="1" checked>
                                <span class="toggle-slider"></span>
                            </label>
                            <span class="toggle-label">Active</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-foot">
                <button type="button" onclick="closeModal()" class="topbar-btn outline">Annuler</button>
                <button type="submit" class="topbar-btn"><i class="fa-solid fa-floppy-disk"></i> Enregistrer</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
const createUrl = "{{ route('admin.categories.store') }}";
function openModal() {
    document.getElementById('categoryForm').action = createUrl;
    document.getElementById('methodField').innerHTML = '';
    document.getElementById('modalTitle').textContent = 'Nouvelle catégorie';
    document.getElementById('catName').value = '';
    document.getElementById('catDesc').value = '';
    document.getElementById('catOrder').value = 0;
    document.getElementById('catActive').checked = true;
    document.getElementById('catImagePreview').style.display = 'none';
    document.getElementById('modalOverlay').classList.add('show');
}
function editModal(cat, imageUrl) {
    document.getElementById('categoryForm').action = `/admin/categories/${cat._id}`;
    document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
    document.getElementById('modalTitle').textContent = 'Modifier : ' + cat.name;
    document.getElementById('catName').value = cat.name;
    document.getElementById('catDesc').value = cat.description || '';
    document.getElementById('catOrder').value = cat.sort_order || 0;
    document.getElementById('catActive').checked = cat.is_active;
    if (imageUrl) {
        const img = document.getElementById('catImagePreview');
        img.src = imageUrl;
        img.style.display = 'block';
    }
    document.getElementById('modalOverlay').classList.add('show');
}
function closeModal() { document.getElementById('modalOverlay').classList.remove('show'); }
function previewCatImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById('catImagePreview');
            img.src = e.target.result;
            img.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
document.getElementById('modalOverlay').addEventListener('click', e => {
    if (e.target === document.getElementById('modalOverlay')) closeModal();
});
</script>
@endpush
