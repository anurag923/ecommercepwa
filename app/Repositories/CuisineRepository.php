<?php
namespace App\Repositories;

use App\Models\Cuisine;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class CuisineRepository extends AppRepository
{
    protected $model;
    
    public function __construct(Cuisine $model)
    {
        $this->model = $model;
    }
    
    /**
     * set payload data for posts table.
     * 
     * @param Request $request [description]
     * @return array of data for saving.
     */
    protected function setDataPayload(Request $request)
    {
        if($request->hasFile('image')){
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images');
            $image->move($destinationPath,$name);
            $imagefullpath = $destinationPath.'/'.$name;
        }
        return [
            'name' => $request->input('name'),
            'image' => $imagefullpath,
            'place'=> $request->input('place')
        ];
    }
}
