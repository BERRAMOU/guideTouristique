<?php

namespace App\Http\Controllers;

use Validator;
use App\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{


    private $form_rules = [
        'name' => 'required|max:255',
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $categories = Categorie::select('id', 'description')->get();
        return response(array(
            'error' => false,
            'categories' =>$categories,
        ),200);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), $this->form_rules);

        if ($validator->fails()) {
            return response(array(
                'error' => false,
                'messages'=>$validator->messages()
            ),200);
        }

        Categorie::create($request->all());

        return response(array(
            'error' => true,
            'message' =>'Categorie created successfully',
        ),200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categorie = Categorie::find($id);
        return response(array(
            'error' => false,
            'categorie' =>$categorie,
        ),200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {



        $category = Categorie::find($id);
        $errors=null;

        if(!$category){
            return response(array(
                'error' => true,
                'messages'=>"Undefined Categorie"
            ),200);
        }

        $validator = Validator::make($request->all(), $this->form_rules);

        if ($validator->fails()) {
            return response(array(
                'error' => true,
                'messages'=>$validator->messages()
            ),200);
        }


        $category->update($request->all());

        return response(array(
            'error' => true,
            'message' =>'Categorie updated successfully',
        ),200);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Categorie::find($id)->delete();

        if(!$category){
            return response(array(
                'error' => true,
                'messages'=>"Undefined Categorie"
            ),200);
        }

        $category->delete();

        return response(array(
            'error' => false,
            'message' =>'Categorie deleted successfully',
        ),200);
    }
}
