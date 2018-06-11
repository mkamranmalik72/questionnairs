<?php

namespace App\Http\Controllers;

use App\Choice;
use App\Question;
use App\Questionnair;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    private $per_page;
    private $types;
    public function __construct()
    {
        $this->per_page = 10;
        $question = new Question();
        $this->types = $question->types();
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Questionnair $questionnair)
    {
        $viewData['action'] = route('question.store');
        $viewData['method'] = 'POST';
        $viewData['btn'] = 'Create';
        $viewData['question'] = new Question();
        $viewData['types'] = $this->types;
        $viewData['questionnair_id'] = $questionnair->id;
        return view('questionnair.question-form',$viewData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $input = $request->all();
        $question = Question::create($input);
        if ($request->type == TEXT_TYPE_QUESTION){
            if ($question){
                $choice = new Choice();
                $choice->choice = $request->answer;
                $choice->is_correct = true;
                $question->choices()->save($choice);
            }
        }else if ($request->type == MCSO_TYPE_QUESTION){
            if ($question){
                foreach ($request->choice as $key => $inputchoice){
                    $choice = new Choice();
                    if ($key == $request->is_correct){
                        $choice->is_correct = true;
                    }else{
                        $choice->is_correct = false;
                    }
                   $choice->choice = $inputchoice;
                    $question->choices()->save($choice);
                }
            }
        }else if ($request->type == MCMO_TYPE_QUESTION){
            if ($question){
                foreach ($request->choice as $key => $inputchoice){
                    $choice = new Choice();
                    $correct = array_search($key,$request->is_correct);
                    if ($correct !== false){
                        $choice->is_correct = true;
                    }else{
                        $choice->is_correct = false;
                    }
                    $choice->choice = $inputchoice;

                    $question->choices()->save($choice);
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
