@extends('layouts.app')
@section('title', $post->title . ' — JEKP Store')
@push('styles')
<style>
.page-hero{background:linear-gradient(135deg,var(--creme2) 0%,var(--blanc) 50%,var(--peche) 100%);padding:60px 50px;text-align:center;border-bottom:1px solid var(--peche);position:relative;overflow:hidden}
.page-hero::before{content:'';position:absolute;right:-100px;top:-100px;width:320px;height:320px;border-radius:50%;background:linear-gradient(135deg,var(--peche),var(--rose-p));opacity:.1;pointer-events:none}
.breadcrumb{display:flex;gap:8px;align-items:center;font-size:11px;color:var(--texte2);justify-content:center;margin-top:14px}
.breadcrumb a{color:var(--texte2);text-decoration:none;transition:color .3s}.breadcrumb a:hover{color:var(--rose-v)}
.breadcrumb span{color:var(--rose-p)}
.blog-detail{max-width:760px;margin:0 auto;padding:50px 50px 80px}
.blog-detail-meta{display:flex;align-items:center;gap:16px;font-size:12px;color:var(--texte2);margin-bottom:24px;flex-wrap:wrap}
.blog-detail-meta span{display:flex;align-items:center;gap:5px}
.blog-detail h1{font-family:var(--f-titre);font-size:clamp(28px,4vw,42px);font-weight:300;color:var(--texte);line-height:1.25;margin-bottom:20px}
.blog-detail h1 em{color:var(--rose-v);font-style:italic}
.blog-detail-img{width:100%;border-radius:16px;object-fit:cover;max-height:420px;margin-bottom:30px;box-shadow:var(--ombre)}
.blog-detail-body{font-size:15px;color:var(--texte);line-height:2.1}
.blog-detail-body p{margin-bottom:18px}
.blog-detail-body h2,.blog-detail-body h3{font-family:var(--f-titre);font-weight:300;color:var(--texte);margin:24px 0 12px}
.blog-detail-body h2{font-size:24px}
.blog-detail-body h3{font-size:19px}
.blog-detail-body ul{list-style:none;margin:12px 0}
.blog-detail-body li{padding:6px 0 6px 18px;position:relative}
.blog-detail-body li::before{content:'·';position:absolute;left:0;color:var(--rose-v);font-weight:bold}
.blog-detail-body a{color:var(--rose-v);text-decoration:underline}
.blog-tags{display:flex;gap:8px;margin-top:30px;flex-wrap:wrap}
.blog-tags span{background:var(--peche);color:var(--rose-f);padding:5px 14px;border-radius:50px;font-size:11px;letter-spacing:0.5px}
.back-link{color:var(--rose-v);text-decoration:none;font-size:13px;display:inline-flex;align-items:center;gap:6px;transition:color .3s;margin-top:30px}
.back-link:hover{color:var(--rose-f)}
@media(max-width:700px){.blog-detail{padding:30px 24px 60px}}
</style>
@endpush
@section('content')
<div class="page-hero">
    <span class="s-label">Blog</span>
    <h1 class="s-titre">{{ $post->title }}</h1>
    <div class="breadcrumb"><a href="{{ route('home') }}">Accueil</a> <i class="fas fa-chevron-right" style="font-size:9px"></i> <a href="{{ route('pages.blog') }}">Blog</a> <i class="fas fa-chevron-right" style="font-size:9px"></i> <span>{{ Str::limit($post->title, 30) }}</span></div>
</div>
<div class="blog-detail">
    @if($post->image)
        <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}" class="blog-detail-img">
    @endif
    <div class="blog-detail-meta">
        <span><i class="far fa-calendar"></i> {{ $post->published_at?->format('d M. Y') ?? $post->created_at?->format('d M. Y') }}</span>
        <span><i class="far fa-clock"></i> {{ $post->reading_time ?? 5 }} min de lecture</span>
        @if($post->category)<span><i class="far fa-folder"></i> {{ $post->category }}</span>@endif
        @if($post->author_name)<span><i class="far fa-user"></i> {{ $post->author_name }}</span>@endif
    </div>

    <div class="blog-detail-body">
        {!! $post->content !!}
    </div>

    @if($post->tags && count($post->tags))
    <div class="blog-tags">
        @foreach($post->tags as $tag)
            <span>#{{ $tag }}</span>
        @endforeach
    </div>
    @endif

    <a href="{{ route('pages.blog') }}" class="back-link"><i class="fas fa-arrow-left"></i> Retour au blog</a>
</div>
@endsection
