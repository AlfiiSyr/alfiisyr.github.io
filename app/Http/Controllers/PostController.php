<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

class PostController extends Controller
{
  public function posting(){
      $reqData = request()->only('iduser','image','caption');
      $post = Post::create($reqData);
      $data['post'] = $post;
      return response()->json([
        $data,
        'followsuccess' => 'Anda berhasil membuat postingan'
      ],200);
    }
  }
