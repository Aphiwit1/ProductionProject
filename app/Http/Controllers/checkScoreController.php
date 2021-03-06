<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Question;
use App\Question_pictures;
use App\Quiz;
use App\Answer;
use App\Comment;
use App\Question_type;
use Auth;


class checkScoreController extends Controller
{
   
    public function index($questions_id)
    {
        $question = DB::table('Questions')
        ->join('Question_pictures','Question_pictures.questions_id','=','Questions.questions_id')
        ->join('Answer','Answer.questions_id','=','Questions.questions_id')
        ->join('Comment','Comment.answer_id','=','Answer.answer_id')
        ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
        ->where('Questions.questions_id','=',$questions_id)
        ->get();
       //dd($question);
        //dd('test');
        $permission = $request->get('permission');
        if($permission == 'ADMIN'){
            return view('/Admin/checkAnswer/commentAnswer/',compact('question','questions_id','question2','quiz_id')); 
            }elseif($permission == 'STUDENT'){
            return view('/Student/checkScore/checkScore/',compact('question','questions_id','question2','quiz_id'));       
            }elseif($permission == 'LECTURER'){
                return view('/lecturer/checkAnswer/commentAnswer/',compact('question','questions_id','question2','quiz_id'));          
            }
       // $data = Question::where('questions_id',$questions_id)->get();
        //dd($question);
        // dd($question);
    }

        public function store(request $request){
                        $questions_id= $request->input ('questions_id');
                       
                        $currentAnswerId = DB::table('Answer')
                         ->select('answer_id')
                         ->join('Questions','Questions.questions_id','=','Answer.questions_id')
                         ->where('Answer.questions_id','=',$questions_id)
                         ->get();
                        $lastestAnswerID = $currentAnswerId[0]->answer_id;
                        $Comment = new Comment;
                        $Comment->answer_id =  $lastestAnswerID;
                        $Comment->comment =$request->input('Remark');
                        
                        $username = Auth::user()->username;
                        $Comment->usernames = $username;
                        $Comment->save();
                        
                      
                        
                        

                        
                        
                    // $permission = $request->get('permission');
                       // return view('/Student/question/StudentQuestion',compact($questions_id,'question'));  
                        return redirect()->back()  ;        
                     

           
            //return'yes';
            }




}
