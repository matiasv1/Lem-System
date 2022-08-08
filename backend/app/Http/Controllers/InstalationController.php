<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstalationController extends Controller
{
    //

    public function get_all(){

        $instalation = DB::connection('mariadb')->select('SELECT * FROM tblinstalations');

        return $instalation;
    }

    public function get_id($id){
        
        $sql = DB::connection('mariadb')
                ->table('tblinstalations')
                ->select(['id','position','date','status','tecnicoid','clientid'])
                ->where('tblinstalations.id','=',$id)
                ->get();

        return $sql;
    }

    public function delete_id($id){

        $sql = DB::connection('mariadb')
                ->table('tblinstalations')
                ->where('tblinstalations.id','=',$id)
                ->delete();

        return "La instalación con id: " . $id . "ha sido eliminada";
    }

    public function store(Request $request){

        $position = $request->input('position');
        $date = $request->input('date');
        $status = $request->input('status');
        $tecnicoid = $request->input('tecnicoid');
        $clientid = $request->input('clientid');

        $sql = DB::connection('mariadb')
                ->table('tblinstalations')
                ->insertGetId([
                    'position'    => $position,
                    'date'  => $date,
                    'status'   => $status,
                    'tecnicoid' => $tecnicoid,
                    'clientid'    => $clientid 
                ]);

        return "Se ha ejecutado la llamada a store ";
    }
}
