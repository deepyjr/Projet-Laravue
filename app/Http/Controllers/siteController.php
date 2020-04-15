<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\site;
use App\Http\Requests\site as siteRequest;

class siteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByCampusId($campusId)
    {
        $sites = DB::table('sites')
            ->select(DB::raw('*'))
            ->where('campusId', '=', $campusId)
            ->get();
        return response()->json($sites);
    }

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
    public function store(Request $request)
    {
        $site = new Site();
        $site->campusId = request('campusId');
        $site->name = request('name');
        $site->save();
        return response(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $site = DB::table('sites')
            ->select(DB::raw('*'))
            ->where('id', '=', $id)
            ->get();
        return response()->json($site);
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
        $site = Site::find(request('siteId'));
        $site->name = request('name');
        $site->save();
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
        DB::delete('delete from sites where id=' . $id);
        return response(200);
    }
}