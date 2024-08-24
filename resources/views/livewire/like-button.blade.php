<div>
    @if (Auth::check())
        <button wire:click="like" class="btn btn-sm {{ $isLiked ? 'btn-danger' : 'btn-primary' }}">
            {{ $isLiked ? 'Unlike' : 'Like' }} ({{ $likesCount }})
        </button>
    @else
        <a href="{{ route('login') }}" class="btn btn-sm btn-primary">
            Like ({{ $likesCount }})
        </a>
    @endif

</div>
