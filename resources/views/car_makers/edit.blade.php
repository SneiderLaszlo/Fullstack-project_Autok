@extends('layouts.app')

@section('title', 'Autógyártó módosítása')

@section('content')
<div class="mx-auto max-w-lg">
    <h1 class="text-3xl font-extrabold tracking-tight">Autógyártó módosítása</h1>

    <form action="{{ route('car_makers.update', $car_maker->id) }}" method="POST" class="mt-6 space-y-5 rounded-xl bg-white p-6 shadow-sm ring-1 ring-asphalt/10">
        @csrf
        @method('PATCH')
        <div>
            <label for="name" class="label">Az autógyártó neve</label>
            <input type="text" name="name" id="name" value="{{ old('name', $car_maker->name) }}" required class="field" placeholder="pl. Toyota">
            @error('name') <p class="err">{{ $message }}</p> @enderror
        </div>
        <div class="flex gap-3 pt-1">
            <button type="submit" class="btn-primary">Mentés</button>
            <a href="{{ route('car_makers.index') }}" class="btn-ghost">Mégse</a>
        </div>
    </form>
</div>
@endsection
