@extends('layouts.app')

@section('title', 'Kezdőlap')

@section('content')
<section class="max-w-2xl">
    <h1 class="text-4xl font-extrabold leading-tight tracking-tight sm:text-5xl">Minden autó, gyártó és modell egy helyen</h1>
    <p class="mt-4 text-lg text-asphalt/70">Böngészd a gyártókat, keress a modellek között, és tartsd rendben a nyilvántartást.</p>
    <div class="mt-6 flex flex-wrap gap-3">
        <a href="{{ route('car_models.index') }}" class="btn-primary">Modellek böngészése</a>
        <a href="{{ route('car_makers.create') }}" class="btn-ghost">Új autógyártó</a>
    </div>
</section>

<dl class="mt-10 flex gap-10">
    <div><dt class="text-sm text-asphalt/60">Autógyártó</dt><dd class="text-4xl font-extrabold tabular-nums">{{ $makerCount }}</dd></div>
    <div><dt class="text-sm text-asphalt/60">Modell</dt><dd class="text-4xl font-extrabold tabular-nums">{{ $modelCount }}</dd></div>
</dl>

<section class="mt-12">
    <h2 class="text-xl font-bold">Legutóbb felvett modellek</h2>
    @if ($latest->isEmpty())
        <p class="mt-4 text-asphalt/60">Még nincs modell. <a href="{{ route('car_models.create') }}" class="font-semibold text-eu underline">Vedd fel az elsőt.</a></p>
    @else
        <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($latest as $car_model)
                @include('car_models._card', ['car_model' => $car_model, 'actions' => false])
            @endforeach
        </div>
    @endif
</section>
@endsection
