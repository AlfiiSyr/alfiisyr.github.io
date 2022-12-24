<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
{
    public function following(Request $request){
      $id01 = $request->input('iduser');
      $id02 = $request->input('followingid');

      if ((DB::table('follows')->where('iduser', $id01)->exists()) && (DB::table('follows')->where('followingid', $id02)->exists())){
        return response()->json([
          'followfailed' => 'Anda telah memfollownya'
        ],200);
      }else{
        $reqData = request()->only('iduser','followingid');
        $following = Follow::create($reqData);
        $data['follow'] = $following;
        return response()->json([
          $data,
          'followsuccess' => 'Anda berhasil memfollow'
        ],200);
      }

      }

    public function unfollow(Request $request){
      $id01 = $request->input('iduser');
      $id02 = $request->input('followingid');

      if ((DB::table('follows')->where('iduser', $id01)->exists()) && (DB::table('follows')->where('followingid', $id02)->exists())){
          $reqData = request()->only('iduser','followingid');
          $following = Follow::where('iduser', $reqData)->delete();
          return response()->json([
          'followfailed' => 'Anda mengunfollownya'
        ],200);
      }else{
        return response()->json([
          'followsuccess' => 'Anda belum memfollownya'
        ],200);
      }
    }
}
