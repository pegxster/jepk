@if ($paginator->hasPages())
<div class="pagination">
    {{-- Précédent --}}
    @if ($paginator->onFirstPage())
        <span class="page-btn dis"><i class="fas fa-chevron-left" style="font-size:11px"></i></span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="page-btn"><i class="fas fa-chevron-left" style="font-size:11px"></i></a>
    @endif

    {{-- Pages --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="page-btn dis">{{ $element }}</span>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="page-btn on">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Suivant --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="page-btn"><i class="fas fa-chevron-right" style="font-size:11px"></i></a>
    @else
        <span class="page-btn dis"><i class="fas fa-chevron-right" style="font-size:11px"></i></span>
    @endif
</div>
@endif
