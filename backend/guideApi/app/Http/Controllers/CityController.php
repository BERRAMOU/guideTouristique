<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;
use Validator;

class CityController extends Controller
{

    private $form_rules = [
        'name' => 'required|max:255',
        'latitude'=> 'required|numeric',
        'longitude'=> 'required|numeric',
        'uf'=> 'required'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();
        return response(array(
            'error' => false,
            'cities' =>$cities,
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

        City::create($request->all());

        return response(array(
            'error' => true,
            'message' =>'City created successfully',
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
        $city = City::find($id);
        return response(array(
            'error' => false,
            'city' =>$city,
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
        $city = City::find($id);
        $errors=null;

        if(!$city){
            return response(array(
                'error' => true,
                'messages'=>"Undefined City"
            ),200);
        }

        $validator = Validator::make($request->all(), $this->form_rules);

        if ($validator->fails()) {
            return response(array(
                'error' => true,
                'messages'=>$validator->messages()
            ),200);
        }


        $city->update($request->all());

        return response(array(
            'error' => true,
            'message' =>'City updated successfully',
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
        $city=City::find($id)->delete();

        if(!$city){
            return response(array(
                'error' => true,
                'messages'=>"Undefined City"
            ),200);
        }

        $city->delete();

        return response(array(
            'error' => false,
            'message' =>'City deleted successfully',
        ),200);
    }
}
