<?php 
namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\CookItem;

class AppRepository
{
    /**
     * Eloquent model instance.
     */
    protected $model;
    protected $cookitem;
    /**
     * load default class dependencies.
     * 
     * @param Model $model Illuminate\Database\Eloquent\Model
     */
    public function __construct(Model $model,CookItem $cookitem)
    {
        $this->model = $model;
        $this->cookitem = $cookitem;
    }
    /**
     * get all the items collection from database table using model.
     * 
     * @return Collection of items.
     */
    public function get()
    {
        return $this->model->get();
    }

    /**
     * get collection of items in paginate format.
     * 
     * @return Collection of items.
     */
    public function paginate(Request $request)
    {
        return $this->model->paginate($request->input('limit', 10));
    }
    /**
     * create new record in database.
     * 
     * @param Request $request Illuminate\Http\Request
     * @return saved model object with data.
     */
    public function store(Request $request)
    {
        $data = $this->setDataPayload($request);
        $item = $this->model;
        $item->fill($data);
        $item->save();
        return $item;
    }
    /**
     * update existing item.
     * 
     * @param  Integer $id integer item primary key.
     * @param Request $request Illuminate\Http\Request
     * @return send updated item object.
     */
    public function update($id, Request $reqest)
    {
        $data = $this->setDataPayload($request);
        $item = $this->model->findOrFail($id);
        $item->fill($data);
        $item->save();
        return $item;
    }
    /**
     * get requested item and send back.
     * 
     * @param  Integer $id: integer primary key value.
     * @return send requested item data.
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }
    /**
     * Delete item by primary key id.
     * 
     * @param  Integer $id integer of primary key id.
     * @return boolean
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
    /**
     * set data for saving
     * 
     * @param  Request $request Illuminate\Http\Request
     * @return array of data.
     */
    protected function setDataPayload(Request $request)
    {
        return $request->all();
    }

    public function cuisine_item(Request $request, $id)
    {
        $cuisine = $this->model->find($id);
        $item = new Item();
        $item->name = $request->name;
        $item->description = $request->description; 
        if($request->hasFile('image')){
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images');
            $image->move($destinationPath,$name);
            $imagefullpath = $destinationPath.'/'.$name;
            $item->image = $imagefullpath;
        }
        $cuisine->items()->save($item);
        return $item;
    }

    public function add_item_to_cook(Request $request,$itemid){
        $cook = $this->model->find(auth()->user()->id);
        $itemids = [$itemid];
        $cook->item()->attach($itemids);
    }

    public function add_cuisine_to_cook(Request $request,$cuisineid){
        $cook = $this->model->find(auth()->user()->id);
        $cuisineids = [$cuisineid];
        $cook->cuisine()->attach($cuisineids);
    }

    public function singlecuisine($id){
        $cuisine = $this->model->where('id',$id);
        $data = $cuisine->with('cooks')->with(['items'=>function($q){
            $q->where('famous','yes');
        }])->get();
        return $data;
    }

    public function cookitems($id){
        $cookitems = $this->cookitem->where('cook_id',$id)->with('cook')->with('item')->get();
        return $cookitems;
    }
    
    public function itemcooks($id){
        $itemcooks = $this->cookitem->where('item_id',$id)->with('cook')->with('item')->get();
        return $itemcooks;
    }
}