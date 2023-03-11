@if ($paginator->hasPages())
<div class="registration-pagination justify-content-center">
    <span class="button-group " style=" float: none;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <button type="button" class="disabled secondary icon-prev"></button>
        @else
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev"><button type="button" class="secondary icon-prev pagelink-registration"></button></a>
        @endif
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" rel="next"> <button type="button" class="secondary icon-next pagelink-registration"></button></a>
        @else
        <button type="button" class="disabled secondary icon-next"></button>
        @endif
    </span>
</div>
@endif