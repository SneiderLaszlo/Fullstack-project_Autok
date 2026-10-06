@extends('layouts.app')

@section('title', 'Modellek')

@section('content')
<div class="flex flex-wrap items-end justify-between gap-4">
    <div>
        <h1 class="text-3xl font-extrabold tracking-tight">Modellek</h1>
        <p class="mt-1 text-asphalt/60">{{ $car_models->count() }} találat</p>
    </div>
    <a href="{{ route('car_models.create') }}" class="btn-primary">Új modell</a>
</div>

<form method="GET" action="{{ route('car_models.index') }}" class="mt-6 flex flex-wrap gap-3">
    <input type="search" name="search" value="{{ request('search') }}" placeholder="Keresés modell neve alapján" aria-label="Keresés" class="field min-w-0 flex-1 basis-56">
    <select name="car_maker_id" aria-label="Autógyártó" class="field w-auto">
        <option value="">Minden gyártó</option>
        @foreach ($car_makers as $car_maker)
            <option value="{{ $car_maker->id }}" @selected(request('car_maker_id') == $car_maker->id)>{{ $car_maker->name }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn-primary">Szűrés</button>
    @if (request()->hasAny(['search', 'car_maker_id']))
        <a href="{{ route('car_models.index') }}" class="btn-ghost">Szűrők törlése</a>
    @endif
</form>

@if ($car_models->isEmpty())
    <p class="mt-10 rounded-xl bg-white p-8 text-center text-asphalt/60 ring-1 ring-asphalt/10">Nincs a szűrésnek megfelelő modell. Próbálj másik keresőszót, vagy töröld a szűrőket.</p>
@else
    <div class="mt-6 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($car_models as $car_model)
            @include('car_models._card', ['car_model' => $car_model])
        @endforeach
    </div>
@endif
@endsection
