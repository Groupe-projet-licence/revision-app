<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TutorialController extends Controller
{
    public function complete(){
        $user = Auth::user();
        $user->has_seen_tutorial = true;
        $user->save();

        return redirect()->back();
    }
}
