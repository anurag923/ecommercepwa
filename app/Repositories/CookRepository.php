<?php
namespace App\Repositories;

use App\Models\Cook;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class CookRepository extends AppRepository
{
    protected $model;
    
    public function __construct(Cook $model)
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
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => bcrypt($request->input('password')),
            'image' => $imagefullpath
        ];
    }
}
