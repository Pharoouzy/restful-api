<?php

namespace App\Http\Controllers\Country;

use Validator;
use Illuminate\Http\Request;
use App\Models\CountryModel;
use App\Http\Controllers\Controller;

class Country extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $countries = CountryModel::get();

        return response()->json($countries, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $rules = [
            'name' => 'required|min:3',
            'iso' => 'required|min:2|max:2'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $country = CountryModel::create($request->all());

        return response()->json($country, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $country = CountryModel::find($id);

        if(is_null($country)){
            return response()->json([
                'status' => false,
                'message' => 'Record not found'
            ], 404);
        }

        return response()->json($country, 200);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $country = CountryModel::find($id);

        if(is_null($country)){
            return response()->json([
                'status' => false,
                'message' => 'Unable to update record'
            ], 404);
        }
        $country->update($request->all());

        return response()->json($country, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $country = CountryModel::find($id);

        if(is_null($country)){
            return response()->json([
                'status' => false,
                'message' => 'Unable to delete record'
            ], 404);
        }

        $country->delete();

        return response()->json(null, 204);
    }
}
