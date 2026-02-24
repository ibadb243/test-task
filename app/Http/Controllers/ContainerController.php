<?php

namespace App\Http\Controllers;

use App\Models\Container;
use App\Models\Country;
use Illuminate\Http\Request;

class ContainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Container::with('country');

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('country_id')) {
            $query->where('country_id', $request->country_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $containers = $query->latest()->paginate(10)->withQueryString();
        $countries = Country::all();

        return view('containers.index', compact('containers', 'countries'));
    }

    public function create()
    {
        $countries = Country::all();
        return view('containers.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('containers', 'public');
        }

        Container::create($validated);

        return redirect()->route('containers.index')->with('success', 'Container created successfully.');
    }

    public function edit(Container $container)
    {
        $countries = Country::all();
        return view('containers.edit', compact('container', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Container $container)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($container->image) Storage::disk('public')->delete($container->image);
            $validated['image'] = $request->file('image')->store('containers', 'public');
        }

        $container->update($validated);

        return redirect()->route('containers.index')->with('success', 'Container updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($container->image) {
            Storage::disk('public')->delete($container->image);
        }
        $container->delete();

        return redirect()->route('containers.index')->with('success', 'Container deleted.');
    }
}
