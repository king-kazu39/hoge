<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Target;

class TargetsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $user = Auth::user();

        // $targets = Target::orderBy('created_at', 'desc')->get();

        $targets = Target::select('targets.*', 'users.name', 'users.img_name')
                    ->join('users','users.id','=','targets.user_id')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('sns.search', compact('user', 'targets'));
    }

    public function search(Request $request) {
        $user = Auth::user();

        $inputs = $request->all();
        $targets = Target::select('targets.*', 'users.name', 'users.img_name')
                    ->join('users','users.id','=','targets.user_id')
                    ->orderBy('created_at', 'desc')
                    ->where('target', 'LIKE', '%' .$inputs['search'] . '%')
                    ->get();
        return view('sns.search', compact('user', 'inputs', 'targets'));

    }

    public function create() {
        $user = Auth::user();

        $user_targets = Target::orderBy('created_at' , 'desc')->where('user_id', $user->id)->get();

        return view('sns.plan', compact('user', 'user_targets'));
    }

    public function store(Request $request) {
        Target::create($request->all());

        return redirect('/home');
    }

}
