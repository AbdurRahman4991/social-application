<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;
use App\Models\like;
use App\Models\comments;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content'   => 'required',
            'userId'    =>'required',
        ]);
        $CreatePost = new post();
        $CreatePost->content = $request->content;
        $CreatePost->user_id = $request->userId; 
        $imagesName          = date('Y.m.d').$request->image->extension();
        $request->image->move(public_path('images'),$imagesName);
        $CreatePost->image   = $imagesName;
        $CreatePost->save();
        if($CreatePost==true){
            return back()->with('success','success create your post');
        }else{
            return back()->with('error','Faile create your psot');
        }
    }

    public function Like(Request $request)
    {
        $useId = $request->userId;        
        $postId = $request->postId;
        if($useId==0){
            return redirect()->route('login');
        }else{
            $CheckLike = like::where('user_id',$useId)->where('post_id',$postId)->count();
            if($CheckLike==true){
                $deleteLike = like::where('user_id',$useId)->where('post_id',$postId)->delete(); 
                if($deleteLike == true)          
                return back();
            }else{
                $PostLike = new like();
                $PostLike->user_id = $request->userId;
                $PostLike->post_id = $request->postId;
                $PostLike->save();
                if($PostLike==true){
                    return back();
                }else{
                    return back()->with('error','Network error');
                }
            }
        }
        

    }

    public function comments(Request $request)
    {
        $request->validate([            
            'comments'   => 'required',            
        ]);
        $useId = $request->userId;  
        if($useId==true){
            $PostComment = new comments();
            $PostComment->comments = $request->comments;
            $PostComment->user_id = $request->userId;
            $PostComment->post_id = $request->postId;
            $PostComment->save();
            if($PostComment==true)
            {
                return back();
            }else{
                return back()->with('error','network error');
            }

        }    
    }

    public function DeleteComments($id)
    {
        $RemoveComent = comments::where('id',$id)->delete();
        if($RemoveComent){
            return back();
        }
    }
}
