<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $criteria = Criteria::orderBy('created_at', 'DESC');

        if (!empty($request->keyword)) {
            $criteria->where('name', 'like', '%'.$request->keyword.'%');
        }

        $criteria = $criteria->paginate(5);
        return view('criteria.index')->with('criteria', $criteria);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('criteria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Criteria::create($request->all());

        return redirect()->route('criterias.index')->with('success', 'Criteria created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Criteria $criteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Criteria $criteria)
    {
        return view('criteria.edit', ['criteria' => $criteria]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Criteria $criteria)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $criteria->update($request->all());

        return redirect()->route('criterias.index')->with('success', 'Criteria updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $criteria = Criteria::findOrFail($id);
        $criteria->delete();
        return redirect()->route('criterias.index')->with('success', 'Criteria deleted successfully');
    }
}
