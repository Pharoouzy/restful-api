<?php

namespace App\Http\Controllers\Country;

use Validator;
use Illuminate\Http\Request;
use App\Models\CountryModel;
use App\Http\Controllers\Controller;

class CountryController extends Controller {
    //
    public function country() {
        
        return response()->json(CountryModel::get(), 200);

    }

    public function countryById($id) {
        $country = CountryModel::find($id);

        if(is_null($country)){
            return response()->json([
                'status' => false,
                'message' => 'Record not found'
            ], 404);
        }

        return response()->json($country, 200);
        
    }

    public function addCountry(Request $request) {
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

    public function updateCountry(Request $request, $id) {
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

    public function deleteCountry(Request $request, $id){
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
