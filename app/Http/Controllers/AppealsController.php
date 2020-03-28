<?php

namespace App\Http\Controllers;

use App\Appeal;
use App\Feedback;
use App\Service\AppealFilterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppealsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Appeal $appeal, AppealFilterService $appealFilterService)
    {
        $appeals = Appeal::with('feedbacks')->latest()->get();

        if (!Auth::user()->isManager()) {
            $appeals = $appeals->where('author_id', auth()->id());
        }

        $appeals = $appealFilterService->setFilters(\request())->apply($appeals);

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

    public function storeFeedback(Appeal $appeal, Feedback $feedback)
    {
        $data = $this->validate(request(), [
            'title' => 'required',
            'body' => 'required',
            'file' => 'file',
        ]);

        $feedback->fill(array_merge($data, [
            'author_id' => auth()->id(),
        ]));

        $appeal->feedbacks()->save($feedback);

        return back();
    }

    public function show(Appeal $appeal)
    {
        $this->authorize('view', $appeal);

        if (Auth::user()->isManager()) {
            $appeal->update(['viewed' => true]);
        }

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

    public function accept(Appeal $appeal)
    {
        $this->authorize('view', $appeal);

        if (Auth::user()->isManager()) {
            Auth::user()->acceptedAppeals()->attach($appeal);
        }

        return back();
    }
}
