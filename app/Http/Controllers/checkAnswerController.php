<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Question;
use App\Question_pictures;
use App\Quiz;
use App\Answer;
use App\Question_type;

class checkAnswerController extends Controller
{
    public function index($questions_id)
    {
        $question = DB::table('Questions')
        ->join('Question_pictures','Question_pictures.questions_id','=','Questions.questions_id')
        ->join('Answer','Answer.questions_id','=','Questions.questions_id')
        ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
        ->where('Questions.questions_id','=',$questions_id)
        ->get();
       
     
        $quizStatus = $question[0]->quizs_status_id;
        switch ( $quizStatus) {
            case 'Reviewing':
            return view('/Admin/checkAnswer/indexAnswer',compact('question','questions_id','question2','quiz_id'));
                break;
            
            case 'Close':
            return 'no';
                break;
        }
        
                
                
               
        
       $data = Question::where('questions_id',$questions_id)->get();
        //dd($question);
    }

       
}
