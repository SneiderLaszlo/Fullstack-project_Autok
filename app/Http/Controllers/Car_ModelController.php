<?php

namespace App\Http\Controllers;

use App\Models\Car_Model;
use App\Models\Car_Maker;
use Illuminate\Http\Request;

class Car_ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $car_models = Car_Model::with('car_maker')
        ->when($request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%');
        })
        ->when($request->filled('car_maker_id'), function ($query) use ($request) {
            $query->where('car_maker_id', $request->car_maker_id);
        })
        ->orderBy('name')
        ->get();

    $car_makers = Car_Maker::orderBy('name')->get();

    return view('car_models.index', compact('car_models', 'car_makers'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $car_makers = Car_Maker::all();

        return view('car_models.create', compact('car_makers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'year' => ['required', 'string', 'max:20'],
            'car_maker_id' => ['required', 'exists:car_makers,id'],
        ]);

        $car_model= Car_Model::create($validated);
        $car_models=Car_Model::all();


         return redirect()
            ->route('car_models.index')
            ->with('status', 'Modell létrehozva!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car_Model $car_model)
    {
        $car_makers=Car_Maker::all();
        return view('car_models.edit', compact('car_model', 'car_makers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'year' => ['required', 'string', 'max:20'],
            'car_maker_id' => ['required', 'exists:car_makers,id'],
        ]);

        $car_model = Car_Model::findOrFail($id);
        $car_model->update($validated);

        return redirect()
            ->route('car_models.index')
            ->with('status', 'Modell frissítve!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car_model = Car_Model::findOrFail($id);
        $car_model->delete();

        return redirect()
            ->route('car_models.index')
            ->with('status', 'Modell törölve!');
    }
}
