<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RatingRequest;
use App\Service\RatingService;
use App\Http\Resources\RatingResource as RatingResource;
use Auth;

class RatingController extends Controller
{
    protected $ratingService;
    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RatingRequest $request)
    {
        $prerating = $this->ratingService->getRating($request->post_id,Auth::id());

        if ( ! $prerating ) {

           $data['user_id'] = Auth::id();

           $data['number'] = (int)$request->number;

           $data['post_id'] = (int)$request->post_id;

            $this->ratingService->addRating($data);

        }else{

           $data = $prerating;
           $data->number = $request->number;
           $data->save();
        }

        return response()->json(['rating' => $data->number]);
    }
}
