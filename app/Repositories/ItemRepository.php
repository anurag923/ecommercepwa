<?php
namespace App\Repositories;

use App\Models\Item;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;
use App\Models\CookItem;

class ItemRepository extends AppRepository
{
    protected $model;
    protected $cookitem;
    
    public function __construct(Item $model,CookItem $cookitem)
    {
        $this->model = $model;
        $this->cookitem = $cookitem;
    }
    
    /**
     * set payload data for posts table.
     * 
     * @param Request $request [description]
     * @return array of data for saving.
     */
    protected function setDataPayload(Request $request)
    {
        // if($request->hasFile('image')){
        //     $image = $request->file('image');
        //     $name = time().'.'.$image->getClientOriginalExtension();
        //     $destinationPath = public_path('images');
        //     $image->move($destinationPath,$name);
        //     $imagefullpath = $destinationPath.'/'.$name;
        // }
        // return [
        //     'name' => $request->input('name'),
        //     'image' => $imagefullpath,
        //     'description'=> $request->input('description')
        // ];
    }
}
