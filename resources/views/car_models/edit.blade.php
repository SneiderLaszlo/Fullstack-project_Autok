@extends('layouts.app')

@section('title', 'Modell módosítása')

@section('content')
<div class="mx-auto max-w-lg">
    <h1 class="text-3xl font-extrabold tracking-tight">Modell módosítása</h1>

    <form action="{{ route('car_models.update', $car_model->id) }}" method="POST" class="mt-6 space-y-5 rounded-xl bg-white p-6 shadow-sm ring-1 ring-asphalt/10">
        @csrf
        @method('PATCH')
        <div>
            <label for="car_maker_id" class="label">Autógyártó</label>
            <select name="car_maker_id" id="car_maker_id" required class="field">
                <option value="">Válassz autógyártót</option>
                @foreach ($car_makers as $car_maker)
                    <option value="{{ $car_maker->id }}" @selected(old('car_maker_id', $car_model->car_maker_id) == $car_maker->id)>{{ $car_maker->name }}</option>
                @endforeach
            </select>
            @error('car_maker_id') <p class="err">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="name" class="label">Modell neve</label>
            <input type="text" name="name" id="name" value="{{ old('name', $car_model->name) }}" required class="field" placeholder="pl. Octavia">
            @error('name') <p class="err">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="year" class="label">Évjárat</label>
            <input type="text" name="year" id="year" value="{{ old('year', $car_model->year) }}" required class="field" placeholder="pl. 2020">
            @error('year') <p class="err">{{ $message }}</p> @enderror
        </div>
        <div class="flex gap-3 pt-1">
            <button type="submit" class="btn-primary">Mentés</button>
            <a href="{{ route('car_models.index') }}" class="btn-ghost">Mégse</a>
        </div>
    </form>
</div>
@endsection
