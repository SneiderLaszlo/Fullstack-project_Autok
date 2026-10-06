<article class="flex overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-asphalt/10">
    <div class="flex w-24 shrink-0 flex-col items-center justify-center bg-eu/10 px-2 text-eu">
        <span class="text-2xl font-extrabold tabular-nums">{{ $car_model->year }}</span>
        <span class="text-xs font-semibold">évjárat</span>
    </div>
    <div class="min-w-0 flex-1 p-4">
        <a href="{{ route('car_models.index', ['car_maker_id' => $car_model->car_maker_id]) }}" class="text-sm font-semibold text-asphalt/60 hover:text-eu">{{ $car_model->car_maker->name }}</a>
        <h3 class="truncate text-xl font-bold">{{ $car_model->name }}</h3>
        @if ($actions ?? true)
            <div class="mt-3 flex items-center gap-1 -ml-3">
                <a href="{{ route('car_models.edit', $car_model->id) }}" class="link-quiet">Szerkesztés</a>
                <form action="{{ route('car_models.destroy', $car_model->id) }}" method="POST" onsubmit="return confirm('Biztosan törlöd: {{ $car_model->car_maker->name }} {{ $car_model->name }}?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-danger"><button type="submit" class="btn-danger"><img src="{{ asset('images/trash-solid-full.svg') }}" alt="" class="size-5"></button>
                   </button>
                </form>
            </div>
        @endif
    </div>
</article>
