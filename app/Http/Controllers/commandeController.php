<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\commande;
use App\objet;
use App\campus;
use App\site;
use App\Http\Requests\commande as commandeRequest;
use App\Http\Controllers\notificationController as notificationController;

class commandeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexCommandesByClientId($clientId)
    {
        $commandes = DB::table('commandes')
            ->select(DB::raw('*'))
            ->where('clientId', '=', $clientId)
            ->get();
        foreach ($commandes as $commande) {
            $objet = Objet::find($commande->objetId);
            $site = Site::find($objet->siteId);
            $campus = Campus::find($site->campusId);
            $commande->description = $campus->name . '/' . $site->name . '/' . $objet->name;
        }
        return response()->json($commandes);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //use for the history
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
        $commande = new Commande();
        $commande->clientId = request('clientId');
        $commande->objetId = request('objetId');
        $commande->status = request('status');
        $commande->date_commande = date("Y-m-d H:i:s");
        $commande->date_debut = request('date_debut');
        $commande->save();

        $nofificationController = new notificationController();
        $nofificationController->store(request('objetId'), request('clientId'));
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
        $commande = Commande::find($id);
        $objet = Objet::find($commande->objetId);
        $site = Site::find($objet->siteId);
        $campus = Campus::find($site->campusId);
        $commande->description = $campus->name . '/' . $site->name . '/' . $objet->name;
        return response()->json($commande);
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
        DB::delete('delete from commandes where id=' . $id);
        return response(200);
    }
}