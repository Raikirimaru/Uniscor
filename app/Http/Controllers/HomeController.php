<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\University;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $universities =  University::with(['ratings', 'criteria'])->orderBy('created_at' , 'DESC')->paginate(8);

        if (!empty($request->keyword)) {
            $universities->where('name', 'like', '%'.$request->keyword.'%');
        }

        $universities->each(function ($university) {
            $averageRating = $university->ratings->avg('score');
            $university->averageRating = $averageRating;
        });

        return view('home', compact('universities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $university = University::findOrFail($id);
        $relatedUniversities = University::where('status', 1)->take(3)->where('id', '!=', $id)->inRandomOrder()->get();
        return view('university-detail', compact('university', 'relatedUniversities'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Home $home)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Home $home)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Home $home)
    {
        //
    }
}
