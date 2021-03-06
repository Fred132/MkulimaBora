<?php

namespace App\Http\Controllers\Admin;


use Session;
use App\Models\Servicecategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index()
    {
        $services=Servicecategory::all();
        return view('admin.services.index') ->with('services',$services);
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
       $category= new Servicecategory();
       $category->service_name= $request->input('service_name');
       $category->service_description= $request->input('service_description');
      
       Session::flash('statuscode','success');
       $category->save();
       return redirect('/service-category')->with('status','Category added suucessfully');
    }

    public function edit($id){
        $service_category = Servicecategory::find($id);

        return view('admin.services.edit')->with('service_category',$service_category);

    }

    //we are going to put the request tag since when we are updating we fetch data from the forms
    public function update(Request $request, $id){
            $serv_cate=Servicecategory::find($id);
            $serv_cate->service_name=$request->input('service_name');
            $serv_cate->service_description=$request->input('service_description');
            $serv_cate->update();

            Session::flash('statuscode','success');
            return redirect('service-category')->with('status','Service category updated!');
    }

    public function delete($id)
    {
        $serv_cate=Servicecategory::findOrFail($id);
        $serv_cate->delete();
        return response()->json(['status'=>'Service Category Deleted']);
    }
}
