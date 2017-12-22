<?php

namespace App\Http\Controllers;

use App\Episode;
use App\Services\PodcastFeedService;
use App\Show;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EpisodesController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Route for the homepage list of podcast episodes
     *
     * TODO: Can be improved to add pagination for when there are more episodes
     * than makes sense to show on one page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function episodeList(Request $request)
    {
        $pageNumber = $request->get('page', 1);
        $pageSize = 10;

        $show = Show::first();

        $episodes = Episode::query()->orderBy('number', 'desc')
            ->take($pageSize)
            ->skip($pageSize * ($pageNumber - 1))
            ->get();

        return view('welcome', [
            'episodes' => $episodes,
            'show' => $show
        ]);
    }

    /**
     * Route for the podcast RSS feed
     *
     * @param Request $request
     * @return Response
     */
    public function feed(Request $request)
    {
        // TODO: App assumes that there is only one show for holding show information but
        // could be expanded to support multiple shows
        $show = Show::first();

        $episodes = Episode::query()->orderBy('date', 'asc')->get();

        $xmlString = PodcastFeedService::createFeedXml($request, $show, $episodes);

        $response = new Response($xmlString, Response::HTTP_OK, ['Content-type' => 'text/xml']);

        return $response;
    }
}
