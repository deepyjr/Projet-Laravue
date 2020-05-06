<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\notification;
use App\objet;
use App\campus;
use App\site;
use DB;

class notificationController extends Controller
{

    /**
     * 
     */
    public function indexNotificationByClientId($clientId)
    {
        $sql = "SELECT * FROM notifications WHERE vu = 0 AND clientId = $clientId ORDER BY id DESC LIMIT 3";
        $notifications = DB::select($sql);
        return response()->json($notifications);
    }

    /**
     * 
     */
    public function userSawNotification($notificationId)
    {
        $notification = Notification::find($notificationId);
        $notification->vu = true;
        $notification->save();
        return response(200);
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
    public function store($objetId, $clientId)
    {
        $objet = Objet::find($objetId);
        $site = Site::find($objet->siteId);
        $campus = Campus::find($site->campusId);
        $nom_lavage = $campus->name . '/' . $site->name . '/' . $objet->name;
        $notification = new notification();
        $notification->clientId = $clientId;
        $notification->description = "Le lavage $nom_lavage a été commandé ";
        $notification->type = "Lavage";
        $notification->vu = false;
        $notification->date = date("Y-m-d H:i:s");
        $notification->save();
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
        DB::delete('delete from notifications where id=' . $id);
        return response(200);
    }
}