<?php

namespace App\Http\Controllers;

use App\Question;
use App\Questionnair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class QuestionnairController extends Controller
{
    private $per_page;
    private $duration_types;
    public function __construct()
    {
        $this->per_page = 10;
        $questoinnair = new Questionnair();
        $this->duration_types = $questoinnair->duration_types();
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questionnairs = Questionnair::paginate(10);
        return view('questionnair.questionnairs',compact('questionnairs'));
    }
    public function questionnairs_json(){
        $questionnairs = Questionnair::select('id','name','duration','duration_type','resumeable','published')->with('questions');
        $buttons = '';
//        <a  class="btn btn-success  questionnair-edit-'. $row->id .'">
//            <i class="fa fa-pencil"></i>
//        </a>
        return DataTables::of($questionnairs)->addColumn('action', function ($row){
            return '
        <a href="'.route('questionnair.show',['questionnair' => $row->id]).'" class="btn btn-primary  questionnair-view-'. $row->id .'">
            <i class="fa fa-eye"></i>
        </a>
      
        <a href="'.route('questionnair.remove',['questionnair' => $row->id]).'" class="btn btn-danger  questionnair-delete-'. $row->id .'">
            <i class="fa fa-trash"></i>
        </a>';
        })->addColumn('questions_count', function($row) {
            return $row->questions->count() . '   <a href="'.route('questionnair.question',['questionnair' => $row->id]).'" class="btn btn-danger btn-sm  question-add-'. $row->id .'">
            <i class="fa fa-plus"></i>
        </a>';
        })->rawColumns(['action','questions_count'])->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $viewData['action'] = route('questionnair.store');
        $viewData['method'] = 'POST';
        $viewData['btn'] = 'Create';
        $viewData['duration_types'] = $this->duration_types;
        $viewData['questionnair'] = new Questionnair();
        return view('questionnair.form',$viewData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'bail|required|max:255',
            'duration' => 'required|integer|min:0',
            'duration_type' => 'required|not_in:-1|digits_between:'. 0 .','. 1 ,
            'resumeable' => 'required|not_in:-1|digits_between:'. 0 .','. 1,
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => 400,'errors' => $validator->errors()->messages()]);
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $responce = [];
        $create = Questionnair::create($input);
        if ($request->ajax()){
            if ($create){
                $responce['status'] = 200;
                $responce['questionnair_id'] = $create->id;
            }
        }else{
            if ($create){
                return redirect('questionnair.index');
            }else{
                return redirect()->back()->withInput()->withErrors(['questionnair' => 'Oops! an Something Went Wrong Please try again.']);
            }
        }
        return $responce;
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
        $delete = Questionnair::destroy($id);
        if ($delete){
            return redirect(route('questionnair.index'));
        }
    }
}
