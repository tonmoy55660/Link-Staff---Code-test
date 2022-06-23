<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageFollower;
use App\Models\PersonFollowers;
use App\Models\User;
use Illuminate\Http\Request;


class FollowerController extends Controller
{
    public function personFollower(Request $request, $personId)
    {
        try {
            $followCheck = PersonFollowers::where('user_id', $personId)->where('follower_id', auth('api')->id())->first();

            if ($personId == auth('api')->id()) {
                return response()->json([
                    'status' => false,
                    'message' => "You are same Person."
                ]);
            } elseif (isset($followCheck)) {
                return response()->json([
                    'status' => false,
                    'message' => "Already Followed this person"
                ]);
            }

            $checkUser = User::find($personId);
            if ($checkUser) {
                PersonFollowers::create([
                    'user_id' => $personId,
                    'follower_id' => auth('api')->id(),
                ]);

                return response()->json([
                    'status' => true,
                    'message' => "Person Followed"
                ]);

            } else {
                return response()->json([
                    'status' => false,
                    'message' => "User not found"
                ]);
            }

        }catch (\Exception $exception){
            return response()->json([
               'status' => false,
               'message' => $exception->getMessage()
            ]);
        }
    }

    public function pageFollower(Request $request, $pageId )
    {
        try {
            $page = Page::find($pageId);
            $followCheck = PageFollower::where('follower_id', auth('api')->id())->first();
            if (isset($page)) {
                if ($page->user_id == auth('api')->id()) {
                    return response()->json([
                        'status' => false,
                        'message' => "You are the page owner."
                    ]);
                } elseif (isset($followCheck)) {
                    return response()->json([
                        'status' => false,
                        'message' => "Already Followed this page"
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Page not found"
                ]);
            }


            PageFollower::create([
                'page_id' => $pageId,
                'follower_id' => auth('api')->id(),
            ]);

            return response()->json([
                'status' => true,
                'message' => "Page Followed"
            ]);
        }catch (\Exception $exception){
            return response()->json([
               'status' => false,
               'message' => $exception->getMessage()
            ]);
        }
    }
}
