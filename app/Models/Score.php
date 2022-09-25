<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id','task','attendance','quiz','practice','final_test'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function average (){
        return ($this->task + $this->attendance + $this->quiz + $this->practice + $this->final_test) / 5;
    }

    public function grade() {
        $total_score = $this->average();
        if($total_score > 85)
        {
            return "A";
        }
        if($total_score > 75){
            return "B";
        }
        if($total_score > 65){
            return "C";
        }
        return "D";
    }
}
