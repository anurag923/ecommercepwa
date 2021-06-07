<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CookRepository;

class CookController extends Controller
{
    protected $repository;

    public function __construct(CookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        try {
            $item = $this->repository->store($request);
            if($item){
                $token = $item->createToken('cook_token')->accessToken;
            }
            return response()->json(['token' => $token]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }
    }

    public function add_item_to_cook(Request $request,$id){
        try{
            $item = $this->repository->add_item_to_cook($request,$id);
            return response()->json(['response'=>'you have successfully added this food item.']);
        }
        catch(Exception $e){
            return response()->json(['message'=> $e->getMessage()],$e->getStatus());
        }
    }

    public function add_cuisine_to_cook(Request $request,$id){
        try{
            $item = $this->repository->add_cuisine_to_cook($request,$id);
            return response()->json(['response'=>'you have successfully added this cuisine.']);
        }
        catch(Exception $e){
            return response()->json(['message'=> $e->getMessage()],$e->getStatus());
        }
    }
}
