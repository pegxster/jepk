@extends('admin.layouts.app')
@section('title', 'Clients')

@section('content')

@if(session('success'))
<div class="alert-ok" style="background:#f0faf5;border:1px solid #a8d5be;color:#2d6a4f;padding:14px 18px;border-radius:10px;margin-bottom:20px;font-size:13px">
    <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
</div>
@endif
@if(session('error'))
<div style="background:#fff0f0;border:1px solid #f5baba;color:#c0392b;padding:14px 18px;border-radius:10px;margin-bottom:20px;font-size:13px">
    <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
</div>
@endif

<div class="card">
    <div class="card-header">
        <h2 class="card-title">
            <i class="fa-solid fa-users" style="color:var(--lav)"></i>
            {{ $clients->total() }} client(s) inscrit(s)
        </h2>
        <form method="GET" style="display:flex;gap:8px;align-items:center">
            <div style="position:relative">
                <i class="fa-solid fa-magnifying-glass" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#9A8070;font-size:13px"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Nom, email, prénom..."
                       class="form-control" style="padding-left:36px;width:260px">
            </div>
            <button type="submit" class="topbar-btn outline">Chercher</button>
            @if(request('search'))
                <a href="{{ route('admin.users.index') }}" class="topbar-btn outline">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            @endif
        </form>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width:44px"></th>
                    <th>Client</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Inscription</th>
                    <th>Points</th>
                    <th style="width:80px"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                <tr>
                    <td>
                        <div style="width:38px;height:38px;border-radius:50%;background:linear-gradient(135deg,#9B8EC4,#D4547A);display:flex;align-items:center;justify-content:center;color:#fff;font-family:'Cormorant Garamond',serif;font-size:18px;font-weight:600">
                            {{ strtoupper(substr($client->prenom ?? $client->name ?? 'C', 0, 1)) }}
                        </div>
                    </td>
                    <td>
                        <strong>{{ $client->prenom ?? '' }} {{ $client->nom ?? $client->name ?? '—' }}</strong>
                    </td>
                    <td style="color:#9A8070;font-size:13px">{{ $client->email }}</td>
                    <td style="color:#9A8070;font-size:13px">{{ $client->telephone ?? '—' }}</td>
                    <td style="font-size:12px;color:#9A8070">
                        {{ $client->created_at?->format('d/m/Y') ?? '—' }}
                    </td>
                    <td style="font-size:13px;text-align:center">
                        <span style="background:rgba(212,84,122,.1);color:var(--rose);padding:3px 10px;border-radius:20px;font-size:12px;font-weight:600">
                            {{ $client->loyalty_points ?? 0 }} pts
                        </span>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.users.destroy', $client) }}"
                              onsubmit="return confirm('Supprimer le compte de {{ addslashes($client->prenom ?? $client->name) }} ?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-act del" title="Supprimer">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:50px;color:#B0A098">
                        <i class="fa-solid fa-user-group" style="font-size:36px;display:block;margin-bottom:12px;color:#DDD0C8"></i>
                        @if(request('search'))
                            Aucun client ne correspond à « {{ request('search') }} »
                        @else
                            Aucun client inscrit pour le moment
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($clients->hasPages())
    <div style="padding:16px 24px;border-top:1px solid #F0E8E0">
        {{ $clients->appends(request()->query())->links('admin.partials.pagination') }}
    </div>
    @endif
</div>
@endsection
