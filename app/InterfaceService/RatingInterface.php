<?php

namespace App\InterfaceService;

interface RatingInterface {
    public function addRating($data);
    public function getRating($post,$user);
}
