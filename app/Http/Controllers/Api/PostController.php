<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Request;
use Validator;

class PostController extends Controller
{
    public function getAllProfilePost() {

    }

    public function getAllPagePost($pageId) {

    }

    public function store (Request $request, $pageId = null) {
        try {
            $rules = [
                'post_content' => 'required',
                'type' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()) {
                return response()->json(['status' => false, 'errors'=> $validator->messages()]);
            }

            if ($request->type == 'Page' && $pageId != null) {

                $page = Page::where('user_id', auth('api')->id())->find($pageId);

                if (isset($page)) {
                    Post::create([
                        'user_id' => auth('api')->id(),
                        'page_id' => $pageId,
                        'content' => $request->post_content,
                        'type' => $request->type,
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => "Page not found",
                    ]);
                }
            } else {
                Post::create([
                    'user_id' => auth('api')->id(),
                    'content' => $request->post_content,
                    'type' => $request->type,
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => "Post save successfully",
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
            ]);
        }
    }


}
