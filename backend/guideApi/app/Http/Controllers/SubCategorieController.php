<?php

namespace App\Http\Controllers;

use App\SubCategorie;
use Illuminate\Http\Request;
use Validator;

class SubCategorieController extends Controller
{

    private $form_rules = [
        'description' => 'required|max:255',
        'category_id'=> 'required',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $subCategorie = SubCategorie::with('categorie')->get();
        return response(array(
            'error' => false,
            'subCategories' =>$subCategorie,
        ),200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        SubCategorie::create($request->all());

        return response(array(
            'error' => true,
            'message' =>'SubCategorie created successfully',
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
        $subCategorie = SubCategorie::find($id);
        return response(array(
            'error' => false,
            'subCategorie' =>$subCategorie,
        ),200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        $subCategorie = SubCategorie::find($id);
        $errors=null;

        if(!$subCategorie){
            return response(array(
                'error' => true,
                'messages'=>"Undefined subCategorie"
            ),200);
        }

        $validator = Validator::make($request->all(), $this->form_rules);

        if ($validator->fails()) {
            return response(array(
                'error' => true,
                'messages'=>$validator->messages()
            ),200);
        }


        $subCategorie->update($request->all());

        return response(array(
            'error' => true,
            'message' =>'subCategorie updated successfully',
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
        $subCtegorie=SubCategorie::find($id)->delete();

        if(!$subCtegorie){
            return response(array(
                'error' => true,
                'messages'=>"Undefined subCategorie"
            ),200);
        }

        $subCtegorie->delete();

        return response(array(
            'error' => false,
            'message' =>'subCategorie deleted successfully',
        ),200);
    }
}
