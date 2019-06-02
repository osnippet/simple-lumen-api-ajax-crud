<?php

namespace App\Http\Controllers;

use App\Data;
use Illuminate\Http\Request;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Data::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->validate($request, [
                        'title' => 'required',
                        'description' => 'required'
                    ]);

        if(!$validate){
            $response = array('response' => 'Data entry is stored', 'success' => false);
            return $response;

        } else {
            $data = new Data;
            $data->title = $request->input('title');
            $data->description = $request->input('description');
            $data->save();

            return response()->json($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Data::find($id);
        return response()->json($data);
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
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if($validate->fails()){
            $response = array('response' => $validate->messages(), 'success' => false);
            return $response;

        } else {
            // Find an item
            $data = Data::find($id);
            $data->title = $request->input('title');
            $data->description = $request->input('description');
            $data->save();

            return response()->json($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find an item
        $data = Data::find($id);
        $data->delete();
        $response = array('response' => 'Data entry is deleted', 'success' => true);
        return $response;
    }
}