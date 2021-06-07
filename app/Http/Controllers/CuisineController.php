<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CuisineRepository;
use App\Models\Cuisine;
use App\Models\Item;
use App\Http\Controllers\CookController;

class CuisineController extends Controller
{
    protected $repository;
    protected $cook;

    public function __construct(CuisineRepository $repository, CookController $cook)
    {
        $this->repository = $repository;
        $this->cook = $cook;
    }

    public function store(Request $request)
    {
        try {
            $item = $this->repository->store($request);
            if($item){
                $this->cook->add_cuisine_to_cook($request,$item->id);
            }
            return response()->json(['response' => 'cuisine has been created successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }
    }

    public function cuisine_item(Request $request,$id){
        try{
            $item = $this->repository->cuisine_item($request,$id);
            if($item){
                $this->cook->add_item_to_cook($request,$item->id);
            }
            return response()->json(['response'=>'food item has been created successfully']);
        }
        catch(Exception $e){
            return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }
    }
}
