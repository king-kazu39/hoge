<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Target;

use App\User;

use App\Models\Category;

class UsersController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
     }
    
    public function show() {
        $user = Auth::user();

        // $targets = Target::orderBy('created_at', 'desc')->where('user_id', $user->id)->get();

        $targets = Target::select('targets.*', 'categories.name')
                    ->join('categories','targets.category_id','=','categories.id')
                    ->orderBy('created_at', 'desc')
                    ->where('user_id', $user->id)
                    ->get();

        return view('sns.account', compact('user', 'targets'));
    }

    public function show_other($id) {
        // $login_user = Auth::user();

        // $user = User::where('id', $id)->get();
        $user = User::findOrFail($id);

        // $targets = Target::orderBy('created_at', 'desc')->where('user_id', $id)->get();

        $targets = Target::select('targets.*', 'categories.name')
                    ->join('categories','targets.category_id','=','categories.id')
                    ->orderBy('created_at', 'desc')
                    ->where('user_id', $user->id)
                    ->get();

        return view('sns.account', compact('user', 'targets'));
    }

    // public function show2($id){
    //     return view('sns.other_account', compact('id'));
    // }


}
