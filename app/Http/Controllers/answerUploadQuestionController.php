<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Question;
use App\Question_pictures;
use App\Quiz;
use App\Answer;
use App\Question_type;

class answerUploadQuestionController extends Controller
{
    public function index($questions_id)
    {
        $question = DB::table('Questions')
        // ->join('Question_types','Question_types.questions_types_id','=','Questions.questions_types_id')
        
        ->join('Question_pictures','Question_pictures.questions_id','=','Questions.questions_id')
        ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
        ->where('Questions.questions_id','=',$questions_id)
        ->get();
            
               
    }

        public function store(request $request){
        
                        //create new Answer
                        $Answer = new Answer;
                        $Answer->answer_number =$request->input('1');
                        $Answer_file = $request->file('fileName');
                            $input['fileName'] = time().'.'.$Answer_file->getClientOriginalExtension();
                            $filePath = public_path('/images/Photo');
                            $Answer_file->move($filePath,$input['fileName']);
                            $fileName = $input['fileName'];
                        $Answer->answer = '/images/Photo/'.$fileName;
                       // $Answer->answer =$request->input('Answer');
                        $Answer->answer_date=$request->input('AnswerDate');
                        $Answer->questions_id =$request->input('questions_id');
                        //save message
                        $Answer->save();
        
                       
            
           
           return redirect()->route('/Student/question/', [$quiz_id]);
            //return'yes';
            }
}