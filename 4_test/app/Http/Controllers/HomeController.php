<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Target;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            $user = Auth::user();
            // $targets = Target::orderBy('created_at', 'desc')->get();

            $user_targets = Target::orderBy('created_at', 'desc')->where('user_id', $user->id)->get();

            $targets = Target::select('targets.*', 'users.name', 'users.img_name')
                    ->join('users','users.id','=','targets.user_id')
                    ->orderBy('created_at', 'desc')
                    ->get();

            return view('home', compact('user', 'user_targets', 'targets'));
        }else{
            // $targets = Target::orderBy('created_at', 'desc')->get();
            $targets = Target::select('targets.*', 'users.name', 'users.img_name')
                    ->join('users','users.id','=','targets.user_id')
                    ->orderBy('created_at', 'desc')
                    ->get();

            return view('home', compact('targets'));
        }
    }

    public function setting()
    {
        return view('sns.setting');
    }
}
