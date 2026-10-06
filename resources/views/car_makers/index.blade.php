@extends('layouts.app')

@section('title', 'Autógyártók')

@section('content')
<div class="flex flex-wrap items-end justify-between gap-4">
    <div>
        <h1 class="text-3xl font-extrabold tracking-tight">Autógyártók</h1>
        <p class="mt-1 text-asphalt/60">{{ $car_makers->count() }} találat</p>
    </div>
    <a href="{{ route('car_makers.create') }}" class="btn-primary">Új autógyártó</a>
</div>

<form method="GET" action="{{ route('car_makers.index') }}" class="mt-6 flex flex-wrap gap-3">
    <input type="search" name="search" value="{{ request('search') }}" placeholder="Keresés gyártó neve alapján" aria-label="Keresés" class="field min-w-0 flex-1 basis-56">
    <button type="submit" class="btn-primary">Keresés</button>
    @if (request('search'))
        <a href="{{ route('car_makers.index') }}" class="btn-ghost">Keresés törlése</a>
    @endif
</form>

@if ($car_makers->isEmpty())
    <p class="mt-10 rounded-xl bg-white p-8 text-center text-asphalt/60 ring-1 ring-asphalt/10">Nincs ilyen autógyártó. Próbálj másik keresőszót, vagy vegyél fel újat.</p>
@else
    <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($car_makers as $car_maker)
            <article class="flex flex-col rounded-xl bg-white p-5 shadow-sm ring-1 ring-asphalt/10">
                <div class="flex items-center gap-4">
                    @php
    $slug = \Illuminate\Support\Str::slug($car_maker->name);
    $logo = collect(glob(public_path("images/{$slug}.*")))->first();
@endphp

@if ($logo)
    <div class="flex size-14 shrink-0 items-center justify-center rounded-lg bg-white p-1.5 ring-1 ring-asphalt/10">
        <img src="{{ asset('images/' . basename($logo)) }}" alt="{{ $car_maker->name }} logó" class="max-h-full max-w-full object-contain">
    </div>
@else
    <div class="flex size-14 shrink-0 items-center justify-center rounded-lg bg-asphalt text-2xl font-extrabold text-white">{{ mb_strtoupper(mb_substr($car_maker->name, 0, 0)) }}</div>
@endif
                    <div class="min-w-0">
                        <h2 class="truncate text-xl font-bold">{{ $car_maker->name }}</h2>
                        <p class="text-sm text-asphalt/60">{{ $car_maker->car_models_count }} modell</p>
                    </div>
                </div>

                @if ($car_maker->car_models->isNotEmpty())
                    <ul class="mt-4 flex flex-wrap gap-1.5">
                        @foreach ($car_maker->car_models->take(5) as $m)
                            <li class="rounded-md bg-eu/10 px-2 py-1 text-xs font-semibold text-eu">{{ $m->name }}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="mt-auto flex flex-wrap items-center gap-1 pt-4 -ml-3">
                    <a href="{{ route('car_models.index', ['car_maker_id' => $car_maker->id]) }}" class="link-quiet text-eu!">Modellek</a>
                    <a href="{{ route('car_makers.edit', $car_maker->id) }}" class="link-quiet">Szerkesztés</a>
                    <form action="{{ route('car_makers.destroy', $car_maker->id) }}" method="POST" onsubmit="return confirm('Biztosan törlöd: {{ $car_maker->name }}? A hozzá tartozó modellek is törlődnek.')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-danger"><img src="{{ asset('images/trash-solid-full.svg') }}" alt="" class="size-5"></button>
                    </form>
                </div>
            </article>
        @endforeach
    </div>
@endif
@endsection
