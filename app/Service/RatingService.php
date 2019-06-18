<?php
namespace App\Service;

use App\InterfaceService\RatingInterface;
use App\Rating; // model
/**
 *
 */
class RatingService implements RatingInterface
{

    public function addRating($data)
    {
        $rating = new Rating($data);
        $rating->save();
    }

    public function getRating($post,$user)
    {
        $number = 0;
        $number =  Rating::where('post_id',$post)->where('user_id',$user)->first();
        return $number;
    }

}

