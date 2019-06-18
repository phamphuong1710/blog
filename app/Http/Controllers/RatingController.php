<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RatingRequest;
use App\Service\RatingService;
use App\Http\Resources\RatingResource as RatingResource;
use Auth;

class RatingController extends Controller
{
    public $ratingService;
    public function __construct(RatingService $ratingService)
    {

        $this->ratingService = $ratingService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prevrating = $this->ratingService->getRating(7,3);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RatingRequest $request)
    {
        $prerating = $this->ratingService->getRating((int)$request->post_id,Auth::id());


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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
