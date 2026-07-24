@extends('admin.layouts.app')
@section('title', 'Produits')

@section('topbar-actions')
    <a href="{{ route('admin.produits.create') }}" class="topbar-btn">
        <i class="fa-solid fa-plus"></i> Nouveau produit
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">{{ $products->total() }} produit(s)</h2>
        <form method="GET" class="search-bar" style="flex:1;justify-content:flex-end">
            <div class="search-input-wrap">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher..." class="form-control" style="padding-left:36px">
            </div>
            <select name="category" class="form-control" style="width:auto">
                <option value="">Toutes catégories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->_id }}" {{ request('category') == $cat->_id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            <select name="status" class="form-control" style="width:auto">
                <option value="">Tous statuts</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Actif</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactif</option>
            </select>
            <button type="submit" class="topbar-btn outline">Filtrer</button>
            @if(request()->hasAny(['search','category','status']))
                <a href="{{ route('admin.produits.index') }}" class="topbar-btn outline" style="color:#9A8070;border-color:#D0C8C0">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            @endif
        </form>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width:50px"></th>
                    <th>Nom</th>
                    <th>Catégorie</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th>Statut</th>
                    <th style="width:100px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>
                        @if(!empty($product->images[0]))
                            <img src="{{ asset('storage/'.$product->images[0]) }}" class="prod-thumb" alt="{{ $product->name }}">
                        @else
                            <div class="prod-thumb" style="display:flex;align-items:center;justify-content:center;color:#C0B0A8">
                                <i class="fa-solid fa-image"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $product->name }}</strong>
                        @if($product->is_featured)
                            <span class="badge badge-featured" style="margin-left:6px">Vedette</span>
                        @endif
                        @if($product->sku)
                            <div style="font-size:11px;color:#9A8070;margin-top:2px">SKU: {{ $product->sku }}</div>
                        @endif
                    </td>
                    <td style="color:#9A8070;font-size:13px">{{ $product->category_name ?? '—' }}</td>
                    <td>
                        <strong>{{ number_format($product->price, 0, ',', ' ') }} FCFA</strong>
                        @if($product->sale_price)
                            <div style="font-size:11px;color:var(--rose)">
                                Promo: {{ number_format($product->sale_price, 0, ',', ' ') }} FCFA
                            </div>
                        @endif
                    </td>
                    <td>
                        @if($product->stock <= 0)
                            <span style="color:#E74C3C;font-weight:700">Rupture</span>
                        @elseif($product->stock <= 5)
                            <span style="color:#E8896A;font-weight:700">{{ $product->stock }}</span>
                        @else
                            <span style="font-weight:600">{{ $product->stock }}</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $product->is_active ? 'badge-active' : 'badge-inactive' }}">
                            {{ $product->is_active ? 'Actif' : 'Inactif' }}
                        </span>
                    </td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.produits.edit', $product) }}" class="btn-act edit" title="Modifier">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.produits.destroy', $product) }}"
                                  onsubmit="return confirm('Supprimer ce produit ?')">
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
                        <i class="fa-solid fa-box-open" style="font-size:32px;display:block;margin-bottom:10px"></i>
                        Aucun produit trouvé.<br>
                        <a href="{{ route('admin.produits.create') }}" style="color:var(--rose)">Créer le premier produit</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
    <div style="padding:16px 24px;border-top:1px solid #F0E8E0">
        {{ $products->links('admin.partials.pagination') }}
    </div>
    @endif
</div>
@endsection
