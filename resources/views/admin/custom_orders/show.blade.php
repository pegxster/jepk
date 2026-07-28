@extends('admin.layouts.app')
@section('title', 'Demande sur mesure — '.($customOrder->customer_name ?? 'N/A'))

@section('topbar-actions')
    <a href="{{ route('admin.custom-orders.index') }}" class="topbar-btn outline">
        <i class="fa-solid fa-arrow-left"></i> Retour
    </a>
@endsection

@section('content')
<div style="display:grid;grid-template-columns:1fr 320px;gap:24px;align-items:start">

    {{-- Détails --}}
    <div style="display:flex;flex-direction:column;gap:20px">

        <div class="card">
            <div class="card-header"><h2 class="card-title">Le projet</h2></div>
            <div class="card-body" style="font-size:14px;line-height:1.8">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
                    <div>
                        <div style="font-size:11px;letter-spacing:1px;text-transform:uppercase;color:#9A8070;margin-bottom:4px">Type de création</div>
                        <div style="font-weight:600">{{ $customOrder->type_creation ?? '—' }}</div>
                    </div>
                    <div>
                        <div style="font-size:11px;letter-spacing:1px;text-transform:uppercase;color:#9A8070;margin-bottom:4px">Taille</div>
                        <div style="font-weight:600">{{ $customOrder->taille ?? '—' }}</div>
                    </div>
                    <div>
                        <div style="font-size:11px;letter-spacing:1px;text-transform:uppercase;color:#9A8070;margin-bottom:4px">Coloris souhaités</div>
                        <div style="font-weight:600">{{ $customOrder->coloris ?? '—' }}</div>
                    </div>
                    <div>
                        <div style="font-size:11px;letter-spacing:1px;text-transform:uppercase;color:#9A8070;margin-bottom:4px">Budget approximatif</div>
                        <div style="font-weight:600">{{ $customOrder->budget ?? '—' }}</div>
                    </div>
                    <div>
                        <div style="font-size:11px;letter-spacing:1px;text-transform:uppercase;color:#9A8070;margin-bottom:4px">Délai souhaité</div>
                        <div style="font-weight:600">{{ $customOrder->delai ?? '—' }}</div>
                    </div>
                </div>
                <div>
                    <div style="font-size:11px;letter-spacing:1px;text-transform:uppercase;color:#9A8070;margin-bottom:6px">Description du projet</div>
                    <div style="background:#FBF5F0;padding:16px;border-radius:10px;white-space:pre-wrap">{{ $customOrder->description ?? '—' }}</div>
                </div>
            </div>
        </div>

        @if($customOrder->photo)
        <div class="card">
            <div class="card-header"><h2 class="card-title">Photo d'inspiration</h2></div>
            <div class="card-body">
                <img src="{{ product_image_url($customOrder->photo) }}" alt="Inspiration" style="max-width:100%;border-radius:10px;display:block">
            </div>
        </div>
        @endif
    </div>

    {{-- Colonne latérale --}}
    <div style="display:flex;flex-direction:column;gap:20px">

        <div class="card">
            <div class="card-header"><h2 class="card-title">Statut</h2></div>
            <div class="card-body">
                @php $c = \App\Models\CustomOrder::statusColor($customOrder->status ?? 'nouveau'); @endphp
                <div class="status-dot" style="color:{{ $c }};font-size:16px;font-weight:700;margin-bottom:20px">
                    {{ \App\Models\CustomOrder::statusLabel($customOrder->status ?? 'nouveau') }}
                </div>

                <form method="POST" action="{{ route('admin.custom-orders.status', $customOrder) }}">
                    @csrf @method('PUT')
                    <div class="form-group" style="margin-bottom:12px">
                        <label class="form-label">Changer le statut</label>
                        <select name="status" class="form-control">
                            @foreach(['nouveau','contacte','termine','annule'] as $s)
                            <option value="{{ $s }}" {{ $customOrder->status == $s ? 'selected' : '' }}>
                                {{ \App\Models\CustomOrder::statusLabel($s) }}
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
            <div class="card-header"><h2 class="card-title">Cliente</h2></div>
            <div class="card-body" style="font-size:14px;display:flex;flex-direction:column;gap:10px">
                <div>
                    <div style="font-weight:600;font-size:16px">{{ $customOrder->customer_name ?? '—' }}</div>
                    @if($customOrder->customer_phone)
                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $customOrder->customer_phone) }}" target="_blank" style="color:#25D366;text-decoration:none;display:inline-flex;align-items:center;gap:6px;margin-top:6px">
                            <i class="fab fa-whatsapp"></i> {{ $customOrder->customer_phone }}
                        </a>
                    @endif
                </div>
                <div style="padding-top:10px;border-top:1px solid #F0E8E0;font-size:12px;color:#9A8070">
                    <div>Demande envoyée le : <strong>{{ $customOrder->created_at?->format('d/m/Y H:i') ?? '—' }}</strong></div>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.custom-orders.destroy', $customOrder) }}" onsubmit="return confirm('Supprimer cette demande ?')">
            @csrf @method('DELETE')
            <button type="submit" class="topbar-btn outline" style="width:100%;justify-content:center;color:#E74C3C;border-color:#F5C6C6">
                <i class="fa-solid fa-trash"></i> Supprimer
            </button>
        </form>

    </div>
</div>
@endsection
