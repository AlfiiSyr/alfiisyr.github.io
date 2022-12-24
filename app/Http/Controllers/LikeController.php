<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    public function like(Request $request){
      $idL01 = $request->input('idpost');
      $idL02 = $request->input('iduser');

      if (DB::table('posts')->where('id', $idL01)->doesntExist()){
        return response()->json([
          'likefailed' => 'Postingan tidak ada'
        ]);
      }

      if ((DB::table('likes')->where('idpost', $idL01)->exists()) && (DB::table('likes')->where('iduser', $idL02)->exists())){
        return response()->json([
          'likefailed' => 'Anda telah memberi like'
        ],200);
      }else{
        $reqData = request()->only('idpost','iduser');
        $like = Like::create($reqData);
        $data['like'] = $like;
        return response()->json([
          $data,
          'likesuccess' => 'Anda berhasil memberi like'
        ],200);
      }
    }
}
