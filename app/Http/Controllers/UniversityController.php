<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Criteria;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;

class UniversityController extends Controller
{
    public function index(Request $request)
    {

        $universities = University::orderBy('created_at', 'DESC');

        if (!empty($request->keyword)) {
            $universities->where('name', 'like', '%'.$request->keyword.'%');
        }

        $universities = $universities->paginate(5);

        return view('universities.list', compact('universities'));
    }

    public function listUniversities(Request $request)
    {
        $universities =  University::with(['ratings', 'criteria'])->orderBy('created_at' , 'DESC')->paginate(8);

        if (!empty($request->keyword)) {
            $universities->where('name', 'like', '%'.$request->keyword.'%');
        }

        $universities->each(function ($university) {
            $averageRating = $university->ratings->avg('score');
            $university->averageRating = $averageRating;
        });
        return view('universities.index', compact('universities'));
    }

    public function create()
    {
        return view('universities.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|min:3',
            'address' => 'required|string|min:3',
            'city' => 'required|string|min:3',
            'status' => 'required|string',
            'website' => 'required|string'
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg,jfif|max:8192';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('universities.create')->withErrors($validator)->withInput()->with('error', 'Unable to create a new identity');
        }

        $universityData = [
            'name' => $request->name,
            'address' => $request->address,
            'description' => $request->description,
            'city' => $request->city,
            'status' => $request->status,
            'website' => $request->website
        ];

        $university = University::create($universityData);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('uploads/universities', $name, 'public');

            // Créer une miniature
            $manager = new ImageManager(Driver::class);
            $img = $manager->read($request->file('image')->getRealPath());
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path('storage/uploads/universities/thumb/'.$name));

            $university->image = $name;
        }

        $university->save();

        return redirect()->route('universities.index')->with('success', 'University created successfully');
    }

    public function edit(string $id)
    {
        $university = University::findOrFail($id);
        return view('universities.edit', compact('university'));
    }

    public function show(string $id)
    {
        $university = University::with(['ratings', 'criteria'])->findOrFail($id);
        $relatedUniversities = University::where('status', 1)
            ->take(3)
            ->where('id', '!=', $id)
            ->inRandomOrder()
            ->get();
        $criteria = Criteria::all();
        $averageRating = $university->ratings->avg('score');
        $relatedUniversities->each(function ($relatedUniversity) {
            $relatedUniversity->averageRating = $relatedUniversity->ratings->avg('score');
        });
        return view('universities.show', compact('university', 'relatedUniversities', 'criteria', 'averageRating'));
    }

    public function update(string $id, Request $request)
    {
        $rules = [
            'name' => 'required|string|min:3',
            'address' => 'required|string|min:3',
            'city' => 'required|string|min:3',
            'status' => 'required|string',
            'website' => 'required|string'
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg,jfif|max:8192';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('universities.edit', ['university' => $id])->withErrors($validator)->withInput();
        }

        $university = University::findOrFail($id);

        $university->name = $request->name;
        $university->address = $request->address;
        $university->description = $request->description;
        $university->city = $request->city;
        $university->status = $request->status;
        $university->website = $request->website;

        // Handle image upload
        if ($request->hasFile('image')) {
            if (!empty($university->image)) {
                File::delete([
                    public_path('storage/uploads/universities/thumb/' . $university->image),
                    public_path('storage/uploads/universities/' . $university->image)
                ]);
            }

            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('uploads/universities', $name, 'public');

            // Créer une miniature
            $manager = new ImageManager(Driver::class);
            $img = $manager->read($request->file('image')->getRealPath());
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path('storage/uploads/universities/thumb/'.$name));

            $university->image = $name;
        }

        $university->save();

        return redirect()->route('universities.index')->with('success', 'University updated successfully');
    }

    public function destroy(Request $request)
    {
        $university = University::findOrFail($request->id);

        if ($university->delete() === false) {
            return response(
                "Couldn't delete the university with id {$request->id}",
                Response::HTTP_BAD_REQUEST
            );
        }

        return redirect()->route('universities.index')->with('success', 'University deleted successfully');
    }

    public function rankings(Request $request)
    {
        $criteria = Criteria::all();
        $selectedCriterion = $request->input('criteria', null);

        $universities = University::with(['ratings', 'criteria'])->get()->map(function ($university) use ($criteria, $selectedCriterion) {
            $university->averageRatings = $criteria->mapWithKeys(function ($criterion) use ($university, $selectedCriterion) {
                $average = $university->ratings->where('criteria_id', $criterion->id)->avg('score');
                if (!$selectedCriterion || $selectedCriterion == $criterion->id) {
                    return [$criterion->name => $average];
                }
                return [];
            })->filter();
            return $university;
        });

        if ($selectedCriterion) {
            $universities = $universities->sortByDesc(function ($university) use ($selectedCriterion) {
                return $university->averageRatings->first();
            });
        }

        return view('universities.ranking', [
            'universities' => $universities,
            'criteria' => $criteria,
            'selectedCriterion' => $selectedCriterion
        ]);
    }
}
