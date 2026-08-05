@extends('admin.layouts.app')
@section('title', 'Commande #'.($order->order_number ?? 'N/A'))

@section('topbar-actions')
    <a href="{{ route('admin.orders.index') }}" class="topbar-btn outline">
        <i class="fa-solid fa-arrow-left"></i> Retour
    </a>
@endsection

@section('content')
<div class="admin-detail-layout">

    {{-- Détails --}}
    <div style="display:flex;flex-direction:column;gap:20px">

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Articles commandés</h2>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Qté</th>
                            <th>Prix unit.</th>
                            <th>Sous-total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($order->items ?? [] as $item)
                        <tr>
                            <td>
                                <strong>{{ $item['name'] ?? '—' }}</strong>
                                @if(!empty($item['variant']))
                                    <div style="font-size:12px;color:#9A8070">{{ $item['variant'] }}</div>
                                @endif
                            </td>
                            <td>{{ $item['quantity'] ?? 1 }}</td>
                            <td>{{ number_format($item['price'] ?? 0, 0, ',', ' ') }} FCFA</td>
                            <td><strong>{{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 1), 0, ',', ' ') }} FCFA</strong></td>
                        </tr>
                        @empty
                        <tr><td colspan="4" style="text-align:center;color:#9A8070;padding:20px">Aucun article</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div style="padding:16px 24px;border-top:1px solid #F0E8E0">
                <div style="display:flex;justify-content:space-between;margin-bottom:8px;font-size:14px">
                    <span>Sous-total</span><span>{{ number_format($order->subtotal ?? 0, 0, ',', ' ') }} FCFA</span>
                </div>
                <div style="display:flex;justify-content:space-between;margin-bottom:8px;font-size:14px">
                    <span>Livraison</span><span>{{ number_format($order->shipping_cost ?? 0, 0, ',', ' ') }} FCFA</span>
                </div>
                @if($order->discount)
                <div style="display:flex;justify-content:space-between;margin-bottom:8px;font-size:14px;color:var(--rose)">
                    <span>Réduction</span><span>-{{ number_format($order->discount, 0, ',', ' ') }} FCFA</span>
                </div>
                @endif
                <div style="display:flex;justify-content:space-between;padding-top:12px;border-top:1px solid #F0E8E0;font-size:18px;font-weight:700">
                    <span>Total</span><span>{{ number_format($order->total ?? 0, 0, ',', ' ') }} FCFA</span>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h2 class="card-title">Lieu de livraison</h2></div>
            <div class="card-body" style="font-size:14px;line-height:1.8">
                @php $addr = $order->formatted_shipping_address; @endphp
                @if(!empty($addr['adresse']) || !empty($addr['quartier']) || !empty($addr['ville']))
                    <div style="font-weight:600;color:#3D2030;margin-bottom:4px">
                        {{ $addr['name'] }}
                    </div>
                    @if(!empty($addr['adresse']))
                    <div>
                        <i class="fa-solid fa-location-dot" style="color:#C96880;margin-right:6px"></i>
                        {{ $addr['adresse'] }}
                    </div>
                    @endif
                    @if(!empty($addr['quartier']))
                    <div>Quartier : <strong>{{ $addr['quartier'] }}</strong>
                        @if(!empty($addr['commune']) && $addr['commune'] !== $addr['quartier'])
                            (Commune : {{ $addr['commune'] }})
                        @endif
                    </div>
                    @endif
                    <div>Ville/Pays : {{ $addr['ville'] }}
                        @if(!empty($addr['pays']))
                            ({{ $addr['pays'] }})
                        @endif
                    </div>
                    @if(!empty($addr['phone']))
                    <div style="margin-top:6px;font-size:13px">
                        <i class="fa-solid fa-phone" style="color:#C96880;margin-right:6px"></i>
                        Tel : <strong>{{ $addr['phone'] }}</strong>
                    </div>
                    @endif
                    @if(!empty($addr['note']))
                    <div style="margin-top:8px;padding:8px 12px;background:#F9F5F0;border-left:3px solid #C96880;border-radius:4px;font-size:12.5px;color:#5A4030">
                        <i class="fa-solid fa-note-sticky" style="margin-right:4px"></i>
                        Note livreur : {{ $addr['note'] }}
                    </div>
                    @elseif(!empty($order->notes))
                    <div style="margin-top:8px;padding:8px 12px;background:#F9F5F0;border-left:3px solid #C96880;border-radius:4px;font-size:12.5px;color:#5A4030">
                        <i class="fa-solid fa-note-sticky" style="margin-right:4px"></i>
                        Note : {{ $order->notes }}
                    </div>
                    @endif
                @else
                    {{-- Fallback pour les anciennes commandes sans shipping_address --}}
                    <div style="font-weight:600;color:#3D2030;margin-bottom:4px">{{ $order->customer_name ?? '—' }}</div>
                    <div style="color:#9A8070;font-size:13px;margin-top:4px">
                        <i class="fa-solid fa-circle-info" style="margin-right:6px"></i>
                        Cette commande a été passée avant l'enregistrement des adresses.
                    </div>
                    @if($order->customer_phone)
                    <div style="margin-top:6px;font-size:13px">
                        <i class="fa-solid fa-phone" style="color:#C96880;margin-right:6px"></i>
                        Tel : <strong>{{ $order->customer_phone }}</strong>
                    </div>
                    @endif
                    @if($order->notes)
                    <div style="margin-top:8px;padding:8px 12px;background:#F9F5F0;border-left:3px solid #C96880;border-radius:4px;font-size:12.5px;color:#5A4030">
                        <i class="fa-solid fa-note-sticky" style="margin-right:4px"></i>
                        {{ $order->notes }}
                    </div>
                    @endif
                @endif
            </div>
        </div>
    </div>

    {{-- Colonne latérale --}}
    <div style="display:flex;flex-direction:column;gap:20px">

        <div class="card">
            <div class="card-header"><h2 class="card-title">Statut</h2></div>
            <div class="card-body">
                @php $c = \App\Models\Order::statusColor($order->status ?? 'pending'); @endphp
                <div class="status-dot" style="color:{{ $c }};font-size:16px;font-weight:700;margin-bottom:20px">
                    {{ \App\Models\Order::statusLabel($order->status ?? 'pending') }}
                </div>

                <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                    @csrf @method('PUT')
                    <div class="form-group" style="margin-bottom:12px">
                        <label class="form-label">Changer le statut</label>
                        <select name="status" class="form-control">
                            @foreach(['pending','confirmed','processing','shipped','delivered','cancelled'] as $s)
                            <option value="{{ $s }}" {{ $order->status == $s ? 'selected' : '' }}>
                                {{ \App\Models\Order::statusLabel($s) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="topbar-btn" style="width:100%;justify-content:center">
                        <i class="fa-solid fa-check"></i> Mettre à jour
                    </button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h2 class="card-title">Client</h2></div>
            <div class="card-body" style="font-size:14px;display:flex;flex-direction:column;gap:10px">
                <div>
                    <div style="font-weight:600;font-size:16px">{{ $order->customer_name ?? '—' }}</div>
                    <div style="color:#9A8070">{{ $order->customer_email ?? '' }}</div>
                    @if($order->customer_phone)<div style="color:#9A8070">{{ $order->customer_phone }}</div>@endif
                </div>
                <div style="padding-top:10px;border-top:1px solid #F0E8E0;font-size:12px;color:#9A8070">
                    <div>Méthode : <strong>{{ $order->payment_method ?? '—' }}</strong></div>
                    <div>Paiement : <strong>{{ $order->payment_status ?? '—' }}</strong></div>
                    <div>Date : <strong>{{ $order->created_at?->format('d/m/Y H:i') ?? '—' }}</strong></div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
