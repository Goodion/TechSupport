<?php

namespace App\Http\Controllers;

use App\Appeal;
use App\Feedback;
use App\Notifications\AppealCreated;
use App\Notifications\AppealFeedbacked;
use App\Notifications\AppealClosed;
use App\Providers\TelegramMessageServiceProvider;
use App\Service\AppealFilterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MagicLink\Actions\LoginAction;
use MagicLink\MagicLink;


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
        $this->authorize('store', Appeal::class);

        $data = $this->validate(request(), [
            'title' => 'required',
            'body' => 'required',
            'file' => 'file',
        ]);

        $appeal = Appeal::create(array_merge($data, [
            'author_id' => auth()->id(),
        ]));

        $manager = \App\User::where('email', config('config.manager_email'))->first();
        $urlToCreatedAppeal = MagicLink::create(
            new LoginAction($manager, redirect('/appeals/' . $appeal->id))
            )->url;
        $manager->notify(new AppealCreated($appeal, $urlToCreatedAppeal));

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

        if (Auth::user()->isManager()) {
            $user = \App\User::where('id', $appeal->author->id)->first();
            $user->notify(new AppealFeedbacked($appeal, $feedback));
        } else {
            $appeal->manager()->first()->notify(new AppealFeedbacked($appeal, $feedback));
        }

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

        if (Auth::user()->isManager()) {
            Auth::user()->acceptedAppeals()->syncWithoutDetaching($appeal);
        }

        $appeal->update([
            'closed' => true,
        ]);

        $user = \App\User::where('id', $appeal->author->id)->first();
        $user->notify(new AppealClosed($appeal));

        if (! $appeal->isNotAccepted()) {
            $appeal->manager()->first()->notify(new AppealClosed($appeal));
        }

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
