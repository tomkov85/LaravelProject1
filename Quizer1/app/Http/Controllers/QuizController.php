<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

	public function home() {
		return view('home');
	}
	 
	public function start() {
		session()->put('username', substr(url()->full(),41));
		session()->put('points', 0);
		session()->put('timeSum', 0);
		session()->put('qid', 0);
		session()->put('questionMax', count(DB::table('questions')->get()));
		return redirect()->action('QuizController@show');
	}
	
	public function setDatas() {
		session()->put('points', (session()->get('points') + $_GET['answer']));
		$time = $_GET['timer'];
		if ($time == "") {
			$time = 0;
		}
		session()->put('timeSum', (session()->get('timeSum') + $time));
		return redirect()->action('QuizController@show');
	}
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show() {
		$id = session()->get('qid') + 1;
		$name = session()->get('username');
		$points = session()->get('points');
		$timeSum = session()->get('timeSum');
		if($id > session()->get('questionMax')) {
			$toplist = DB::table('toplist')->orderBy('points', 'desc')->get();
			return view('final', ['name' => $name,'points' => $points,'timeSum' => $timeSum, 'toplist' => $toplist]);
		}
		session()->put('qid', $id);
		$question = DB::table('questions')->where('id','=', $id)->get()->first();
        return view('questions', ['name' => $name,'points' => $points,'timeSum' => $timeSum,'question' => $question]);
    }

	//public function preLoad()
	
	 
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
