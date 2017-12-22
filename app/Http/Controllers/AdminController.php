<?php

namespace App\Http\Controllers;

use App\Episode;
use App\Show;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin', [
            'episodes' => Episode::all(),
            'show' => Show::first()
        ]);
    }

    /**
     * Route for creating a new episode
     *
     * TODO: Can be improved by creating REST endpoints for the episodes resources,
     * and using those from the frontend to handle creating, updating or deleting episodes.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function newEpisode(Request $request)
    {
        $show = Show::first();

        $attributes = $request->request->all();

        $episode = new Episode($attributes);
        $episode->show_id = $show->getKey();

        if ($request->hasFile('podcast_file')) {
            $path = $request->file('podcast_file')
                ->storePublicly('podcasts');
            $episode->filepath = $path;
        }

        $episode->save();

        return $this->index($request);
    }
}
