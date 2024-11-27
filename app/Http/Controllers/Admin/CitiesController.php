<?php

namespace App\Http\Controllers\Admin;
use App\Models\City;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\CityRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CitiesController extends Controller
{
    public function index(){

       $cities= City::orderBy('id','DESC')->paginate(PAGINATION_COUNT);
       $admin = Auth::user();
       return view('dashboard.cities.index',compact('cities', 'admin'));
    }


    public function create(){

        $admin = Auth::user();

        return view('dashboard.cities.create', compact('admin'));
     }



    public function store(CityRequest $request){

   try{

    DB::beginTransaction();
        //validation

        if (!$request->has('is_active'))
        $request->request->add(['is_active' => 0]);
        else
        $request->request->add(['is_active' => 1]);

        $fileName = "";
        if($request->has('photo')){
        $fileName= uploadImage('cities',$request->photo);
        }
        // dd($fileName);
        // dd($request);
       $city= City::create($request->except('_token'));
        // dd($city);
       //save translation
       $city->name=$request->name;
       $city->photo=$fileName;


       $city->save();

       DB::commit();
       return redirect()->route('admin.cities')->with(['success' => 'The Session Successfully Created']);
    }catch(\Exception $ex){

                DB::rollback();
                return redirect()->route('admin.cities')->with(['error'=>'there is Something wrong in Session']);
        }



    }


        public function edit($id){

            $admin = Auth::user();

            //get specific categories and its translations

            $city=City::find($id);
            if(!$city){
                return redirect()->route('admin.cities')->with(['error'=>'Not Exist']);
            }

            return view('dashboard.cities.edit',compact('city', 'admin'));

        }

        public function update($id,CityRequest $request){

       try{
             //validation

             //update DB
             $city=City::find($id);
             if(!$city){
                return redirect()->route('admin.cities')->with(['error'=>'Not Exist']);
            }

            DB::beginTransaction();

            if($request->has('photo'))
            {
                $fileName= uploadImage('cities',$request->photo);
                City::where('id',$id)->update(['photo'=> $fileName]);
            }


            if (!$request->has('is_active'))
            $request->request->add(['is_active' => 0]);
            else
            $request->request->add(['is_active' => 1]);

            $city->update($request->except('_token','id','photo'));

            //save translation
            $city->name=$request->name;
            $city->save();
         DB::commit();
         return redirect()->route('admin.cities')->with(['success' => 'The Session Successfully Updated']);
        }catch(\Exception $ex){

            DB::rollback();
            return redirect()->route('admin.cities')->with(['error'=>'there is Something wrong in Session']);
        }

        }


   public function delete($id){
    try{
       $city =City::orderBy('id','DESC')->find($id);

       if(!$city){
          return redirect()->route('admin.cities')->with(['error'=>'This section does not exist']);
       }

       //delete Image from folder

       $photo=Str::after($city->photo,'assets/');
       $photo = base_path('public/assets/'.$photo);
       unlink($photo);

       $city ->delete();

       return redirect()->route('admin.cities')->with(['success'=>'The section was deleted successfully']);

    }catch(\Exception $ex){
       DB::rollback();
       return redirect()->route('admin.cities')->with(['error' => 'There is Something Wrong In Session']);
    }
 }
}
