@php
    $links = [
        ['home', 'Kezdőlap', 'home'],
        ['car_makers.index', 'Autógyártók', 'car_makers.*'],
        ['car_models.index', 'Modellek', 'car_models.*'],
    ];
@endphp
<header class="sticky top-0 z-10 bg-asphalt text-white shadow-lg shadow-black/10">
    <nav class="mx-auto flex max-w-6xl flex-wrap items-center gap-x-6 gap-y-2 px-4 py-3 sm:px-6">
        {{-- Magyar rendszámtábla stílusú logó --}}
        <a href="{{ route('home') }}" class="flex items-stretch overflow-hidden rounded-[5px] bg-white ring-2 ring-white/20" aria-label="Autók – kezdőlap">
            <span class="flex items-end bg-eu px-1.5 pb-0.5 text-[9px] font-bold text-white">H</span>
            <span class="px-2.5 py-0.5 text-lg font-extrabold tracking-[0.14em] text-asphalt">AUTÓK</span>
        </a>

        <ul class="flex flex-1 items-center gap-1">
            @foreach ($links as [$route, $label, $pattern])
                <li>
                    <a href="{{ route($route) }}"
                       @if (request()->routeIs($pattern)) aria-current="page" @endif
                       class="rounded-lg px-3 py-2 text-sm font-semibold transition {{ request()->routeIs($pattern) ? 'bg-white text-asphalt' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                        {{ $label }}
                    </a>
                </li>
            @endforeach
        </ul>

        <a href="{{ route('car_models.create') }}" class="hidden rounded-lg bg-white px-4 py-2 text-sm font-semibold text-asphalt transition hover:bg-white/90 sm:inline-flex">Új modell</a>
    </nav>
</header>
