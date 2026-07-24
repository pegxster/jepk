@extends('admin.layouts.app')
@section('title', 'Nouvelle Catégorie')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Créer une catégorie</h2>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Nom *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name')<div class="form-hint" style="color:#C0392B">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" accept="image/*" class="form-control">
                </div>
                <div class="form-grid form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Ordre d'affichage</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0">
                    </div>
                    <div class="form-group" style="justify-content:flex-end">
                        <div class="toggle-group">
                            <label class="toggle">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                            <span class="toggle-label">Active</span>
                        </div>
                    </div>
                </div>
                <div style="display:flex;gap:10px;margin-top:8px">
                    <button type="submit" class="topbar-btn"><i class="fa-solid fa-floppy-disk"></i> Enregistrer</button>
                    <a href="{{ route('admin.categories.index') }}" class="topbar-btn outline">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
