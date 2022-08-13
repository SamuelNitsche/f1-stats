<a class="block bg-white p-3 shadow rounded" href="{{ route('circuits.show', $circuit) }}">
    <div class="space-y-4">
        @if ($circuit->hasImage())
            <img class="mx-auto h-24 w-auto" src="{{ $circuit->getImageUrl() }}" alt="">
        @endif

        <p class="text-center text-sm font-semibold">{{ $circuit->name }}</p>
    </div>
</a>
