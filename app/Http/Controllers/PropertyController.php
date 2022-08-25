<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
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
    public function store($invokeResults, $invokeOutputs, $sessionId)
    {
        foreach (json_decode($invokeResults) as $propName => $propValue) {
            foreach ($invokeOutputs as $invokeOutput) {
                if ($invokeOutput->output_name == $propName) {
                    $array = array(
                        'session_id' => $sessionId,
                        'property_name' => $invokeOutput->save_as_prop_name,
                        'property_value' => $propValue,
                        'created_at' => now(),
                        'updated_at' => now()
                    );
                    (new Property)->store($array);
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Property::where('session_id', $id)->delete();
    }

    public function getPropertyDetails($propertyName, $sessionId)
    {
        $result = (new Property)->getPropertyDetails($propertyName, $sessionId);
        return $result;
    }
}
