<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ItemRepository;
use App\Http\Controllers\CookController;

class ItemController extends Controller
{
    protected $repository;
    protected $cook;

    public function __construct(ItemRepository $repository,CookController $cook)
    {
        $this->repository = $repository;
        $this->cook = $cook;
    }

    public function store(Request $request)
    {
        try {
            $item = $this->repository->store($request);
            if($item){
                $this->cook->add_item_to_cook($request,$item->id);
            }
            return response()->json(['response' => 'food item has been created successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }
    }

    public function itemcooks($id){
        try{
            $item = $this->repository->itemcooks($id);
            return response()->json(['response'=>$item]);
        }
        catch(Exception $e){
            return response()->json(['message'=>$e->getMessage()],$e->getStatus());
        }
    }
}
