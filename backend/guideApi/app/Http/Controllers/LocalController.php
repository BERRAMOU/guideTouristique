<?php

namespace App\Http\Controllers;

use App\Local;
use Illuminate\Http\Request;
use Validator;

class LocalController extends Controller
{



    private $form_rules = [
        'idCity' => 'required|max:255',
        'idCategory'=> 'required|numeric',
        'subCategories'=> 'required',
        'uf'=> 'required'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $idCity=$request->get('idCity');
        $idCategory=$request->get('idCategory');
        $subCategories=$request->get('subCategories');

        $locals=null;

        if($idCategory ==null){
            $locals = Local::all();

        }



        return response(array(
            'error' => false,
            'locals' =>$locals,
        ),200);



        //if(subCategories != null && subCategories.length > 0) {

       // return mLocalService.list(idCity, idCategory, subCategories);

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

        Local::create($request->all());

        return response(array(
            'error' => true,
            'message' =>'Local created successfully',
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
        $local = Local::find($id);
        return response(array(
            'error' => false,
            'local' =>$local,
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
        $local = Local::find($id);
        $errors=null;

        if(!$local){
            return response(array(
                'error' => true,
                'messages'=>"Undefined Local"
            ),200);
        }

        $validator = Validator::make($request->all(), $this->form_rules);

        if ($validator->fails()) {
            return response(array(
                'error' => true,
                'messages'=>$validator->messages()
            ),200);
        }


        $local->update($request->all());

        return response(array(
            'error' => true,
            'message' =>'local updated successfully',
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
        $local=Local::find($id)->delete();

        if(!$local){
            return response(array(
                'error' => true,
                'messages'=>"Undefined Local"
            ),200);
        }

        $local->delete();

        return response(array(
            'error' => false,
            'message' =>'Local deleted successfully',
        ),200);
    }
}
