<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $comments = Comment::with(['user', 'university'])->get();

        if (!empty($request->keyword)) {
            $comments->where('name', 'like', '%' . $request->keyword . '%');
        }

        $comments = Comment::orderBy('Created_at', 'DESC')->paginate(5);
        return view('comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('comments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'university_id' => 'required|exists:universities,id',
            'comment' => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', 'Some validation failed ');
        }

        try {
            Comment::with('user', 'university')->updateOrCreate(
                [
                    'user_id' => $request->user_id,
                    'university_id' => $request->university_id,
                ],
                ['content' => $request->comment]
            );

            return redirect()->route('universities.show')->with('success', 'Comment created successfully');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'An unexpected error occurred');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:500',
        ]);

        // Vérification de la validation
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', 'Validation failed');
        }

        // Mise à jour ou création du commentaire
        $comment->updateOrCreate(
            ['id' => $comment->id],
            ['content' => $request->content]
        );

        // Redirection avec un message de succès
        return redirect()->route('comments.index')->with('success', 'Comment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Comment deleted successfully.');
    }
}
