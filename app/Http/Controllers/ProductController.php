<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Products::all(); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //we need to make validation to get message and list of errors if sth wrong 
        $request->validate([
                'name' => 'required|min:3|max:30',
                'slug' =>  'required',
                'price' => 'required'
        ]);

          return Products::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        return Products::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //PUT Requets
        $product = Products::find($id);
        $product->update($request->all());
        return $product;   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete
        return Products::destroy($id);
    }


    // ************** Hala function ********************//
    /**
     * Search for name 
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
    
      //  return Products::where('name' , $name )->get();  //match exactly  
        //add some query 
        return Products::where('name', 'like' ,'%'.$name.'%')->get(); //anythig
    }

}
