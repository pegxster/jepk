@extends('admin.layouts.app')
@section('title', 'Blog')

@section('topbar-actions')
    <a href="{{ route('admin.blog.create') }}" class="topbar-btn">
        <i class="fa-solid fa-plus"></i> Nouvel article
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">{{ $posts->total() }} article(s)</h2>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width:70px"></th>
                    <th>Titre</th>
                    <th>Catégorie</th>
                    <th>Auteur</th>
                    <th>Lecture</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th style="width:90px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                <tr>
                    <td>
                        @if($post->image)
                            <img src="{{ asset('storage/'.$post->image) }}" class="prod-thumb" style="border-radius:6px" alt="">
                        @else
                            <div class="prod-thumb" style="border-radius:6px;display:flex;align-items:center;justify-content:center;color:#C0B0A8">
                                <i class="fa-solid fa-newspaper"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <strong>{{ Str::limit($post->title, 50) }}</strong>
                        @if($post->excerpt)
                        <div style="font-size:12px;color:#9A8070;margin-top:2px">{{ Str::limit($post->excerpt, 60) }}</div>
                        @endif
                    </td>
                    <td>
                        <span class="badge" style="background:rgba(155,142,196,.12);color:var(--lav)">{{ $post->category }}</span>
                    </td>
                    <td style="font-size:13px;color:#9A8070">{{ $post->author_name ?? '—' }}</td>
                    <td style="font-size:13px;color:#9A8070">{{ $post->reading_time ?? 1 }} min</td>
                    <td>
                        <span class="badge {{ $post->is_published ? 'badge-pub' : 'badge-draft' }}">
                            {{ $post->is_published ? 'Publié' : 'Brouillon' }}
                        </span>
                    </td>
                    <td style="font-size:12px;color:#9A8070">
                        {{ $post->published_at?->format('d/m/Y') ?? $post->created_at?->format('d/m/Y') ?? '—' }}
                    </td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.blog.edit', $post) }}" class="btn-act edit" title="Modifier">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.blog.destroy', $post) }}"
                                  onsubmit="return confirm('Supprimer cet article ?')">
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
                    <td colspan="8" style="text-align:center;padding:40px;color:#B0A098">
                        <i class="fa-solid fa-newspaper" style="font-size:32px;display:block;margin-bottom:10px"></i>
                        Aucun article. <a href="{{ route('admin.blog.create') }}" style="color:var(--rose)">Rédiger le premier</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($posts->hasPages())
    <div style="padding:16px 24px;border-top:1px solid #F0E8E0">
        {{ $posts->links('admin.partials.pagination') }}
    </div>
    @endif
</div>
@endsection
