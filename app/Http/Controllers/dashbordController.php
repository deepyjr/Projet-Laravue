<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\commande;
use DB;

class dashbordController extends Controller
{
    public $data;
    public $clientId;

    private function initVariable($clientId)
    {
        $this->clientId = $clientId;
        $this->data = (object) [];
    }
    /**
     * 
     */
    private function getTodayNbWash()
    {
        $sqlReq = "SELECT COUNT(*) as nbWash FROM `commandes` WHERE date(date_debut) = date(now()) AND clientId = $this->clientId";
        $nbWash = DB::select($sqlReq);
        $this->data->nbWashDay = $nbWash[0]->nbWash;
    }

    /**
     * 
     */
    private function getWeekNbWash()
    {
        $moyenne = array();
        $sqlReq = "SELECT DAYOFWEEK(NOW()) AS dayNumber";
        $result = DB::select($sqlReq);
        $nbDayToSub = ($result[0]->dayNumber) * (-1) + 1;
        $sql = "SELECT DATE_ADD(NOW(), INTERVAL $nbDayToSub DAY) AS newDate";
        $result2 = DB::select($sql);
        $newDate = $result2[0]->newDate;
        for ($compteur = 1; $compteur < 8; $compteur++) {
            $sqlR = "SELECT COUNT(*) as nbOrder FROM `commandes` WHERE clientId = $this->clientId AND Date(date_debut) = DATE('$newDate')";
            $sqlResult = DB::select($sqlR);
            $result2 = DB::select("SELECT DATE_ADD('$newDate', INTERVAL 1 DAY) AS newDate");
            $newDate = $result2[0]->newDate;
            array_push($moyenne, $sqlResult[0]->nbOrder);
        }
        $this->data->nbWashWeek = $moyenne;
    }

    /**
     * 
     */
    private function getNbOrderById()
    {
        $sqlReq = "SELECT count(*) as nbOrder FROM `commandes` WHERE clientId = $this->clientId";
        $nbOrder = DB::select($sqlReq);
        $this->data->nbOrder = $nbOrder[0]->nbOrder;
    }

    /**
     * 
     */
    private function getRobotsStates()
    {
        $sqlReq = "SELECT * FROM robots WHERE objetId IN (
            SELECT id FROM objets WHERE siteId IN (
                SELECT id FROM sites WHERE campusId IN (
                    SELECT id FROM campuses WHERE clientId = $this->clientId
                )
            )
        )";
        $result = DB::select($sqlReq);
        $this->data->robotsStates = $result;
    }

    /**
     * 
     */
    private function getFuturOrdersById()
    {
        $sqlReq = "SELECT * FROM `commandes` WHERE date(date_debut) > date(now()) AND clientId = $this->clientId LIMIT 3";
        $this->data->futurCommandes = DB::select($sqlReq);
    }

    /**
     * 
     */
    private function getNbOfConnectRobotsById()
    {
        $sqlReq = "SELECT COUNT(*) AS nbRobots FROM robots WHERE objetId IN (
            SELECT id FROM objets WHERE siteId IN (
                SELECT id FROM sites WHERE campusId IN (
                    SELECT id FROM campuses WHERE clientId = $this->clientId
                )
            )
        )";

        $sqlReq2 = "SELECT COUNT(*) AS nbRobotsWithProblems FROM robots WHERE objetId IN (
            SELECT id FROM objets WHERE siteId IN (
                SELECT id FROM sites WHERE campusId IN (
                    SELECT id FROM campuses WHERE clientId = $this->clientId
                )
            )
        ) AND LENGTH(erreurs_internes) > 0";

        $result = DB::select($sqlReq);
        $result2 = DB::select($sqlReq2);
        $this->data->nbRobots = $result[0]->nbRobots;
        $this->data->nbRobotsWithProblems = $result2[0]->nbRobotsWithProblems;
    }

    /**
     * 
     */
    public function getDataForDashbord($clientId)
    {
        $this->initVariable($clientId);
        $this->getTodayNbWash();
        $this->getNbOrderById();
        $this->getFuturOrdersById();
        $this->getWeekNbWash();
        $this->getRobotsStates();
        $this->getNbOfConnectRobotsById();
        return response()->json($this->data);
    }
}
