<?php

namespace App\Http\Controllers;

use App\Models\StudyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $data = Validator::make($request->all(), [
            'study_type_name' => 'required|string',
            'study_type_short_name' => 'required|string'
        ]);
        $division_id=auth()->user()->division->id;

        if ($data->fails())
        {
            return response()->json(['error'=>'Поля обов\'язкові для заповнення!']);
        }

        try{
            StudyType::create(array_merge($request->all(), [
                'division_id'=>$division_id
            ]));
        }
        catch (\Exception $exception){
            return response()->json(['error'=>'Такий запис вже існує!']);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
