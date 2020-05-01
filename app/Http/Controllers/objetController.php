<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\objet;
use App\commande;
use DB;
use App\robot;
use App\Http\Requests\objet as objetRequest;

class objetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexBySiteId($siteId)
    {
        $objets = DB::table('objets')
            ->select(DB::raw('*'))
            ->where('siteId', '=', $siteId)
            ->get();

        foreach ($objets as $objet) {
            $objet->commande = Commande::where([
                ['objetId', '=', $objet->id],
                ['status', '!=', 'Termine'],
                ['status', '!=', 'Commande'],
            ])
                ->count();
        }
        return response()->json($objets);
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
        $objet = new Objet();
        $objet->siteId = request('siteId');
        $objet->name = request('name');
        $objet->dernier_lavage = date("Y-m-d H:i:s"); //equivalent de now() en sql
        $objet->save();
        //On récupère l'objet qui vient d'etre crée
        $newObjet = Objet::WHERE([
            ['name', '=', request('name')],
            ['siteId', '=', request('siteId')]
        ])->first();
        //On créer le robot correspondant a objet
        $robot = new Robot();
        $robot->objetId = $newObjet->id;
        $robot->name = "robot" . $newObjet->name;
        $robot->produit_menager = 1;
        $robot->outil_menager = 1;
        $robot->erreurs_internes = "";
        $robot->quantite_produit_restant = 10;
        $robot->quantite_outil_restant = 10;
        $robot->dernier_lavage = date("Y-m-d H:i:s");
        $robot->save();

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
        $objet = DB::table('objets')
            ->select(DB::raw('*'))
            ->where('id', '=', $id)
            ->get();
        return response()->json($objet);
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
        $objet = Objet::find(request('objetId'));
        $objet->name = request('name');
        $objet->save();
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
        DB::delete('delete from objets where id=' . $id);
        return response(200);
    }
}