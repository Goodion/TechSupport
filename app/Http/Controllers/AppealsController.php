<?php

namespace App\Http\Controllers;

use App\Appeal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppealsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Appeal $appeal)
    {
        $appeals = Appeal::latest()->get();

        if(!Auth::user()->isManager()) {
            $appeals = $appeals->where('author_id', auth()->id());
        }

        return view('index', compact('appeals'));
    }

    public function create()
    {
        return view('appeals.create');
    }

    public function store()
    {
        $data = $this->validate(request(), [
            'title' => 'required',
            'body' => 'required',
            'file' => 'file',
        ]);

        $appeal = Appeal::create(array_merge($data, [
            'author_id' => auth()->id(),
        ]));

        return redirect('/');
    }

    public function show(Appeal $appeal)
    {
        $this->authorize('view', $appeal);

        return view('appeals.show', compact('appeal'));
    }

    public function edit(Appeal $appeal)
    {
        $this->authorize('update', $appeal);

        return view('appeals.edit', compact('appeal'));
    }

    public function update(Request $request, Appeal $appeal)
    {
        $this->authorize('update', $appeal);

        $data = $this->validate(request(), [
            'title' => 'required',
            'body' => 'required',
            'file' => 'file',
        ]);

        $appeal->update(array_merge($data, [
            'author_id' => auth()->id(),
        ]));

        return back();
    }

    public function close(Appeal $appeal)
    {
        $this->authorize('close', $appeal);

        $appeal->update([
            'closed' => true,
        ]);

        return redirect('/');
    }
}
