<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\campus;
use App\Http\Requests\campus as CampusRequest;
use DB;

class campusController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByClientId($clientId)
    {
        $campus = DB::table('campuses')
            ->select(DB::raw('*'))
            ->where('clientId', '=', $clientId)
            ->get();
        return response()->json($campus);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campus = Campus::all();
        return response()->json($campus);
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
        $campus = new Campus();
        $campus->clientId = request('clientId');
        $campus->name = request('name');
        $campus->adress = request('adress');
        $campus->save();
        return response(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id id du campus
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campus = DB::table('campuses')
            ->select(DB::raw('*'))
            ->where('id', '=', $id)
            ->get();
        return response()->json($campus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $campus = Campus::find(request('campusId'));
        $campus->name = request('name');
        $campus->adress = request('adress');
        $campus->save();
        return response(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('delete from campuses where id=' . $id);
        return response(200);
    }
}