<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display the home view
     *
     * @return home.blade.php
     */
	public function home() {
		return view('home');
	}
	
	/**
     * Display the new game view
     *
     * @return newgame.blade.php
     */
	public function newGame() {
		return view('newGame');
	}
	
	
	/**
     * Incialize the username, points, timesum, questionNumber variables
     * Get the number of questions from the database 
     * @return redirect to showQuestion function
     */
	public function startNewGame() {
		session()->put('username', $_GET['name']);
		session()->put('points', 0);
		session()->put('timeSum', 0);
		session()->put('questionNumber', 0);
		session()->put('questionNumberMax', count(DB::table('questions')->get()));
		return redirect()->action('QuizController@showQuestions');
	}
	
     /**
     * Display the actual question.
     *
     * @return question view with $name, $points, $timesum
	 * @return˝if questionNumber bigger than questionMax returns the final view
     */
    public function showQuestions() {
		$questionNumber = session()->get('questionNumber') + 1;
		$name = session()->get('username');
		$points = session()->get('points');
		$timeSum = session()->get('timeSum');
		if($questionNumber > session()->get('questionNumberMax')) {
			$toplist = $this->setNewToplist($name,$points,$timeSum);
			return view('final', ['name' => $name,'points' => $points,'timeSum' => $timeSum, 'toplist' => $toplist]);
		} 
		session()->put('questionNumber', $questionNumber);
		$question = DB::table('questions')->where('id','=', $questionNumber)->get()->first();
        return view('questions', ['name' => $name,'points' => $points,'timeSum' => $timeSum,'question' => $question]);
    }

	/**
     * Insert the result to the toplist, if the points are better then the last players
     * 
     * @return new toplist from database
     */
	public function setNewToplist($name,$points,$timeSum) {
		if($toplist = DB::table('toplist')->orderBy('points', 'desc', 'timesSum')->orderBy('timeSum','asc')->get()->last()->points <= $points) {
				DB::table('toplist')->insert(
					['username'	=> $name, 'points' => $points, 'timeSum' => $timeSum, 'created_at' => now(), 'updated_at' => now()
				]);
				$lastId = DB::table('toplist')->orderBy('points', 'desc', 'timesSum')->orderBy('timeSum','asc')->get()->last()->id;
				DB::table('toplist')->where('id', '=', $lastId)->delete();
			}
		return DB::table('toplist')->orderBy('points', 'desc')->orderBy('timeSum','asc')->get();											
	}
	
	/**
     * Add the point and time for the aggregated datas
     * 
     * @return redirect to showQuestion function
     */
	public function setDatas() {
		session()->put('points', (session()->get('points') + $_GET['answer']));
		$time = $_GET['timer'];
		if ($time == "") {
			$time = 0;
		}
		session()->put('timeSum', (session()->get('timeSum') + $time));
		return redirect()->action('QuizController@showQuestions');
	}
	
	/**
     * Incialize the username, points, timesum, questionNumber variables
     * Get the number of questions from the database 
     * @return redirect to showQuestion function
     */
	public function restart() {
		session()->put('points', 0);
		session()->put('timeSum', 0);
		session()->put('questionNumber', 0);
		session()->put('questionNumberMax', count(DB::table('questions')->get()));
		return redirect()->action('QuizController@showQuestions');
	}
	
	/**
     * Incialize the username, points, timesum, questionNumber variables
     * Get the number of questions from the database 
     * @return redirect to showQuestion function
     */
	public function showToplist() {
		$toplist = DB::table('toplist')->orderBy('points', 'desc')->orderBy('timeSum','asc')->get();
		return view('toplist',['toplist' => $toplist]);
	}
	
	/**
     * Display the contact view
     *
     * @return contact.blade.php
     */
	public function contact() {
		return view('contact');
	}
}