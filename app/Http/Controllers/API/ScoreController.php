<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Score;

class ScoreController extends Controller
{
    public function index(){
        $scores = Score::with('student')->get();
        $responses = [];

        foreach ($scores as $score){
            $new_score = $score;
            $new_score['grade'] = $score->grade();
            $new_score['average'] = $score->average();
            array_push($responses, $new_score);
        }

        return $responses;
    }
}
