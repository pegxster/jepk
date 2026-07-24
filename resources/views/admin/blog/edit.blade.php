@extends('admin.layouts.app')
@section('title', 'Modifier : '.Str::limit($post->title, 40))

@section('topbar-actions')
    <a href="{{ route('admin.blog.index') }}" class="topbar-btn outline">
        <i class="fa-solid fa-arrow-left"></i> Retour
    </a>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.blog.update', $post) }}" enctype="multipart/form-data">
@csrf @method('PUT')

<div style="display:grid;grid-template-columns:1fr 320px;gap:24px;align-items:start">

    <div style="display:flex;flex-direction:column;gap:20px">
        <div class="card">
            <div class="card-header"><h2 class="card-title">Contenu</h2></div>
            <div class="card-body form-grid">
                <div class="form-group">
                    <label class="form-label">Titre *</label>
                    <input type="text" name="title" value="{{ old('title', $post->title) }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Extrait</label>
                    <textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt', $post->excerpt) }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Contenu *</label>
                    <textarea name="content" class="form-control" rows="12" required>{{ old('content', $post->content) }}</textarea>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h2 class="card-title">Image principale</h2></div>
            <div class="card-body">
                @if($post->image)
                    <img src="{{ asset('storage/'.$post->image) }}" style="width:100%;border-radius:10px;margin-bottom:16px;max-height:200px;object-fit:cover" alt="">
                @endif
                <div class="upload-zone" onclick="document.getElementById('blogImage').click()">
                    <div class="icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                    <p>{{ $post->image ? 'Remplacer l\'image' : 'Ajouter une image' }}</p>
                    <input type="file" id="blogImage" name="image" accept="image/*" onchange="previewBlogImage(this)">
                </div>
                <img id="blogImagePreview" src="" style="display:none;width:100%;border-radius:10px;margin-top:12px;max-height:200px;object-fit:cover">
            </div>
        </div>
    </div>

    <div style="display:flex;flex-direction:column;gap:20px">

        <div class="card">
            <div class="card-header"><h2 class="card-title">Publication</h2></div>
            <div class="card-body" style="display:flex;flex-direction:column;gap:12px">
                <div class="toggle-group">
                    <label class="toggle">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                    <span class="toggle-label">{{ $post->is_published ? 'Publié' : 'Brouillon' }}</span>
                </div>
                @if($post->published_at)
                <div style="font-size:12px;color:#9A8070">
                    Publié le {{ $post->published_at->format('d/m/Y') }}
                </div>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h2 class="card-title">Classement</h2></div>
            <div class="card-body form-grid">
                <div class="form-group">
                    <label class="form-label">Catégorie *</label>
                    <select name="category" class="form-control" required>
                        @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ old('category', $post->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Tags</label>
                    <input type="text" name="tags" value="{{ old('tags', implode(', ', $post->tags ?? [])) }}" class="form-control">
                </div>
                <div style="font-size:12px;color:#9A8070">
                    <i class="fa-solid fa-eye"></i> {{ $post->views ?? 0 }} vue(s) —
                    <i class="fa-solid fa-clock"></i> {{ $post->reading_time ?? 1 }} min de lecture
                </div>
            </div>
        </div>

        <div style="display:flex;gap:10px">
            <button type="submit" class="topbar-btn" style="flex:1;justify-content:center;padding:14px">
                <i class="fa-solid fa-floppy-disk"></i> Enregistrer
            </button>
            <form method="POST" action="{{ route('admin.blog.destroy', $post) }}"
                  onsubmit="return confirm('Supprimer cet article ?')">
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
