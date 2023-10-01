<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;
use App\Models\like;
use App\Models\comments;
use App\Models\User;
class FrontendController extends Controller
{
    public function GetPost()
    { 
        $getPost = post::with('comment')->get();
        $GetLike = post::with('Like')->get();
        
       // return $comment = comments::find('1')->count();
       
    //    dd($getPost->first()->comment->count());
       
        return view('welcome',['GetPost'=>$getPost,'GetLike'=>$GetLike]);
    }

}
