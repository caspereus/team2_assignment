<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Student;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('score.index',[
            'scores' => Score::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('score.create',[
            'students'=>Student::latest()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'student_id' => 'required',
            'quiz' => 'required|numeric|min:1|max:100',
            'attendance' => 'required|numeric|min:1|max:100',
            'task' => 'required|numeric|min:1|max:100',
            'practice' => 'required|numeric|min:1|max:100',
            'final_test' => 'required|numeric|min:1|max:100',
        ]);
        Score::create($request->all());
        return redirect()->back()->with('message','Success Input Score');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function show(Score $score)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function edit(Score $score)
    {
        return view('score.edit',[
            'score' => $score
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Score $score)
    {
        $this->validate($request, [
            'quiz' => 'required|numeric|min:1|max:100',
            'attendance' => 'required|numeric|min:1|max:100',
            'task' => 'required|numeric|min:1|max:100',
            'practice' => 'required|numeric|min:1|max:100',
            'final_test' => 'required|numeric|min:1|max:100',
        ]);
        $score->update($request->except('_token','_method'));
        return redirect()->route('score.index')->with('message','Success Update Score');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function destroy(Score $score)
    {
        $score->delete();
        return redirect()->back()->with('message','Success Delete Score');
    }
}
