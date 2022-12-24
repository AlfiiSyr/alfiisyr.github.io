<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
  public function comment(Request $request){
      $idC01 = $request->input('idpost');
      $idC02 = $request->input('iduser');

      if (DB::table('posts')->where('id', $idC01)->doesntExist()){
        return response()->json([
          'likefailed' => 'Postingan tidak ada'
        ]);
      }

      $reqData = request()->only('iduser','idpost','comment');
      $comment = Comment::create($reqData);
      $data['comment'] = $comment;
      return response()->json([
        $data,
        'commentsuccess' => 'Anda berhasil memberi comment'
      ],200);
  }
}
