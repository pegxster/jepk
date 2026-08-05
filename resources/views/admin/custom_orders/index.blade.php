@extends('admin.layouts.app')
@section('title', 'Demandes sur mesure')

@push('styles')
<style>
@media(max-width: 600px) {
    .search-bar { width: 100%; flex-direction: column; align-items: stretch; gap: 8px; }
    .search-input-wrap { min-width: 100%; width: 100%; }
    .search-bar select, .search-bar button, .search-bar a { width: 100%; justify-content: center; text-align: center; }
    .table-wrap table { min-width: 650px; }
}
</style>
@endpush

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">{{ $customOrders->total() }} demande(s)</h2>
        <form method="GET" class="search-bar" style="flex:1;justify-content:flex-end">
            <div class="search-input-wrap">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Nom, téléphone..." class="form-control" style="padding-left:36px">
            </div>
            <select name="status" class="form-control" style="width:auto">
                <option value="">Tous statuts</option>
                @foreach($statuses as $s)
                    <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>
                        {{ \App\Models\CustomOrder::statusLabel($s) }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="topbar-btn outline">Filtrer</button>
            @if(request()->hasAny(['search','status']))
                <a href="{{ route('admin.custom-orders.index') }}" class="topbar-btn outline" style="color:#9A8070;border-color:#D0C8C0">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            @endif
        </form>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Type de création</th>
                    <th>Budget</th>
                    <th>Délai souhaité</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th style="width:80px">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customOrders as $req)
                <tr>
                    <td>
                        <div style="font-weight:600">{{ $req->customer_name ?? '—' }}</div>
                        <div style="font-size:12px;color:#9A8070">{{ $req->customer_phone ?? '' }}</div>
                    </td>
                    <td>{{ $req->type_creation ?? '—' }}</td>
                    <td>{{ $req->budget ?? '—' }}</td>
                    <td>{{ $req->delai ?? '—' }}</td>
                    <td>
                        @php $c = \App\Models\CustomOrder::statusColor($req->status ?? 'nouveau'); @endphp
                        <span class="status-dot" style="color:{{ $c }}">
                            {{ \App\Models\CustomOrder::statusLabel($req->status ?? 'nouveau') }}
                        </span>
                    </td>
                    <td style="font-size:12px;color:#9A8070">
                        {{ $req->created_at?->format('d/m/Y H:i') ?? '—' }}
                    </td>
                    <td>
                        <a href="{{ route('admin.custom-orders.show', $req) }}" class="btn-act view" title="Voir">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:40px;color:#B0A098">
                        <i class="fa-solid fa-wand-magic-sparkles" style="font-size:32px;display:block;margin-bottom:10px"></i>
                        Aucune demande sur mesure pour l'instant
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($customOrders->hasPages())
    <div style="padding:16px 24px;border-top:1px solid #F0E8E0">
        {{ $customOrders->appends(request()->query())->links('admin.partials.pagination') }}
    </div>
    @endif
</div>
@endsection
