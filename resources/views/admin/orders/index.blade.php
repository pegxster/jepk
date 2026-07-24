@extends('admin.layouts.app')
@section('title', 'Commandes')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">{{ $orders->total() }} commande(s)</h2>
        <form method="GET" class="search-bar" style="flex:1;justify-content:flex-end">
            <div class="search-input-wrap">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="N° commande, client, email..." class="form-control" style="padding-left:36px">
            </div>
            <select name="status" class="form-control" style="width:auto">
                <option value="">Tous statuts</option>
                @foreach($statuses as $s)
                    <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>
                        {{ \App\Models\Order::statusLabel($s) }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="topbar-btn outline">Filtrer</button>
            @if(request()->hasAny(['search','status']))
                <a href="{{ route('admin.orders.index') }}" class="topbar-btn outline" style="color:#9A8070;border-color:#D0C8C0">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            @endif
        </form>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>N° commande</th>
                    <th>Client</th>
                    <th>Articles</th>
                    <th>Total</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th style="width:80px">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td><strong>#{{ $order->order_number ?? 'N/A' }}</strong></td>
                    <td>
                        <div style="font-weight:600">{{ $order->customer_name ?? '—' }}</div>
                        <div style="font-size:12px;color:#9A8070">{{ $order->customer_email ?? '' }}</div>
                    </td>
                    <td>{{ count($order->items ?? []) }} article(s)</td>
                    <td><strong>{{ number_format($order->total ?? 0, 0, ',', ' ') }} FCFA</strong></td>
                    <td>
                        @php $c = \App\Models\Order::statusColor($order->status ?? 'pending'); @endphp
                        <span class="status-dot" style="color:{{ $c }}">
                            {{ \App\Models\Order::statusLabel($order->status ?? 'pending') }}
                        </span>
                    </td>
                    <td style="font-size:12px;color:#9A8070">
                        {{ $order->created_at?->format('d/m/Y H:i') ?? '—' }}
                    </td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order) }}" class="btn-act view" title="Voir">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:40px;color:#B0A098">
                        <i class="fa-solid fa-inbox" style="font-size:32px;display:block;margin-bottom:10px"></i>
                        Aucune commande pour l'instant
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($orders->hasPages())
    <div style="padding:16px 24px;border-top:1px solid #F0E8E0">
        {{ $orders->appends(request()->query())->links('admin.partials.pagination') }}
    </div>
    @endif
</div>
@endsection
