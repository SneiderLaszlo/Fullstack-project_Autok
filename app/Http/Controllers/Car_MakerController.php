<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car_Maker;


class Car_MakerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $car_makers = Car_Maker::withCount('car_models')->with('car_models')
        ->orderBy('name')
        ->when($request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%');
        })
        ->get();

    return view('car_makers.index', compact('car_makers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('car_makers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $car_maker = Car_Maker::create($validated);
        $car_makers = Car_Maker::all();

        return redirect()
            ->route('car_makers.index')
            ->with('success', 'Autógyártó létrehozva!');
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
    public function edit(Car_Maker $car_maker)
    {
        return view('car_makers.edit', compact('car_maker'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        
        $car_maker = Car_Maker::findOrFail($id);
        $car_maker->update($validated);

        $car_makers = Car_Maker::all();

        return redirect()
            ->route('car_makers.index')
            ->with('success', 'Autógyártó frissítve!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car_maker = Car_Maker::findOrFail($id);
        $car_maker->delete();

        return redirect()
            ->route('car_makers.index')
            ->with('status', 'Autógyártó törölve!');
    }
}
