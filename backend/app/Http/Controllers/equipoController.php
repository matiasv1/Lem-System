<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\equipo;
use App\Models\equipo_coordinador;
use App\Models\equipo_estacion;
use App\Models\equipo_canal;
use App\Models\peticion;
use App\Models\equipo_pozo;
use App\Models\equipo_sonda;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\ElseIf_;

class EquipoController extends Controller
{
    public function delete_equipo($id){

        $sql = DB::connection('mariadb')
                ->table('equipo')
                ->where('id_equipo','=',$id)
                ->delete();

        return "La instalación con id: " . $id . "ha sido eliminada";
    }

    public function actualizar_equipo($id, Request $request){

        $nombre = $request->input("nombre");
        $tipo_equipo = $request->input("tipo_equipo");
        $frecuencia_de_envio = $request->input("frecuencia_de_envio");
        $observaciones = $request->input("observaciones");
        $ubicacion= $request->input("ubicacion");
        $firmware = $request->input("firmware");
        $estado =$request->input('estado');
        $mensaje = $request->input("mensaje");
        if($request->input("mensaje") != 'Aun no hay mensaje por parte de soporte'){
            
            $estado = "En revision";
        }
        

        $affected_equipo = DB::connection('mariadb')
                            ->table('equipo')
                            ->where('id_equipo',$request->input('id_equipo'))
                            ->update(['estado'=>$estado,'nombre'=>$nombre,'frecuencia_de_envio'=>$frecuencia_de_envio ,'observaciones'=>$observaciones , 'ubicacion' =>$ubicacion, 'firmware'=>$firmware ,'mensaje'=>$mensaje]);
        
        if ($tipo_equipo == "coordinador"){
            $tipo_placa = $request->input("tipo_placa");
            $affected_coordinador = DB::connection('mariadb')
                                    ->table('coordinador')
                                    ->where('id_coordinador',$request->input('id_coordinador'))
                                    ->update(['tipo_placa'=> $tipo_placa]);
            
        }
        else if($tipo_equipo =="sonda"){
            $tipo_placa = $request ->input("tipo_placa");
            $largo_sonda = $request ->input("largo_sonda");
            $tipo_sonda= $request ->input("tipo_sonda");
            $compania3G = $request ->input("compania3G");
            $affected_sonda = DB::connection('mariadb')
                                    ->table('sonda')
                                    ->where('id_sonda',$request->input('id_sonda'))
                                    ->update(['tipo_placa'=> $tipo_placa, 'largo_sonda' =>$largo_sonda,'tipo_sonda' =>$tipo_sonda,'compania3G' =>$compania3G]);
        }
        else if($tipo_equipo =="canal"){
            $tipo_placa = $request ->input("tipo_placa");
            $altura_agua = $request ->input("altura_agua");
            $altura_sensor= $request ->input("altura_sensor");
            $altura_max_canal= $request ->input("altura_max_canal");
            $affected_canal = DB::connection('mariadb')
                                    ->table('canales')
                                    ->where('id_canales',$request->input('id_canales'))
                                    ->update(['tipo_placa'=> $tipo_placa, 'altura_agua' =>$altura_agua,'altura_sensor' =>$altura_sensor,'altura_max_canal' =>$altura_max_canal]);
        }
        else if($tipo_equipo =="estacion"){
            $tipo_placa = $request ->input("tipo_placa");
            $compania3G = $request ->input("compania3G");
            $affected_estacion = DB::connection('mariadb')
                                    ->table('estacion')
                                    ->where('id_estacion',$request->input('id_estacion'))
                                    ->update(['tipo_placa'=> $tipo_placa, 'compania3G' =>$compania3G]);
        }

        else if($tipo_equipo =="pozo"){
            $profundidad_pozo= $request ->input("profundidad_pozo");
            $nivel_estatico = $request ->input("nivel_estatico");
            $nivel_dinamico = $request ->input("nivel_dinamico");
            $referencia_sh= $request ->input("referencia_sh");
            $tipo_sensor = $request ->input("tipo_sensor");
            $tipo_energia = $request ->input("tipo_energia");
            $factor_pulsos = $request ->input("factor_pulsos");
            $compania3G = $request ->input("compania3G");
            $affected_pozo = DB::connection('mariadb')
                                    ->table('pozos')
                                    ->where('id_pozos',$request->input('id_pozos'))
                                    ->update(['compania3G'=> $compania3G,'factor_pulsos'=> $factor_pulsos,'tipo_energia'=> $tipo_energia,'tipo_sensor'=> $tipo_sensor ,'referencia_sh'=> $referencia_sh ,'nivel_dinamico'=> $nivel_dinamico , 'profundidad_pozo'=> $profundidad_pozo, 'nivel_estatico' =>$nivel_estatico]);
        }

    }
    public function obtener_equipos_tecnico($id_tecnico,$id_tipo_equipo){
        if($id_tipo_equipo == '1'){
            $equipos_coordinadores = DB::connection('mariadb')
                    ->table('equipo')
                    ->join('coordinador','equipo.id_equipo','=','coordinador.id_equipo')
                    ->where('equipo.id_tecnico','=',$id_tecnico)
                    ->get();
            return $equipos_coordinadores;
        }

        else if($id_tipo_equipo == '2'){
            $equipos_sonda = DB::connection('mariadb')
                    ->table('equipo')
                    ->join('sonda','equipo.id_equipo','=','sonda.id_equipo')
                    ->where('equipo.id_tecnico','=',$id_tecnico)
                    ->get();
            return $equipos_sonda;
        }

        else if($id_tipo_equipo == '3'){
            $equipos_canales = DB::connection('mariadb')
                    ->table('equipo')
                    ->join('canales','equipo.id_equipo','=','canales.id_equipo')
                    ->where('equipo.id_tecnico','=',$id_tecnico)
                    ->get();
            return $equipos_canales;
        }

        else if($id_tipo_equipo == '4'){
            $equipos_estacion= DB::connection('mariadb')
                    ->table('equipo')
                    ->join('estacion','equipo.id_equipo','=','estacion.id_equipo')
                    ->where('equipo.id_tecnico','=',$id_tecnico)
                    ->get();
            return $equipos_estacion;
        }

        else if($id_tipo_equipo == '5'){
            $equipos_pozos= DB::connection('mariadb')
                    ->table('equipo')
                    ->join('pozos','equipo.id_equipo','=','pozos.id_equipo')
                    ->where('equipo.id_tecnico','=',$id_tecnico)
                    ->get();
            return $equipos_pozos;
        }
        
    }
    public function change_state(Request  $request){
        $affected = DB::connection('mariadb')
                    ->table('equipo')
                    ->where('id_equipo',$request->input('id_equipo'))
                    ->update(['estado'=>$request->input('estado')]);
    }
    public function obtener_equipos_soporte($id){
        #equipos coordinadores
        if ($id == '1'){
            $equipos_coordinadores = DB::connection('mariadb')
                    ->table('equipo')
                    ->join('users','equipo.id_tecnico','=','users.id')
                    ->join('coordinador','equipo.id_equipo','=','coordinador.id_equipo')
                    ->get();
            return $equipos_coordinadores;
        }
        # equipos sonda
        else if($id=='2'){
            $equipos = DB::connection('mariadb')
                    ->table('equipo')
                    ->join('users','equipo.id_tecnico','=','users.id')
                    ->join('sonda','equipo.id_equipo','=','sonda.id_equipo')
                    ->get();
            return $equipos;
        }

         # equipos canales
         else if($id=='3'){
            $equipos = DB::connection('mariadb')
            ->table('equipo')
            ->join('users','equipo.id_tecnico','=','users.id')
            ->join('canales','equipo.id_equipo','=','canales.id_equipo')
            ->get();
            return $equipos;
        }

         # equipos estaciones
         else if($id=='4'){
            $equipos = DB::connection('mariadb')
                    ->table('equipo')
                    ->join('users','equipo.id_tecnico','=','users.id')
                    ->join('estacion','equipo.id_equipo','=','estacion.id_equipo')
                    ->get();
            return $equipos;
        }
         # equipos pozos
         else if($id=='5'){
            $equipos = DB::connection('mariadb')
                    ->table('equipo')
                    ->join('users','equipo.id_tecnico','=','users.id')
                    ->join('pozos','equipo.id_equipo','=','pozos.id_equipo')
                    ->get();
            return $equipos;
        }
        
    }

    public function update_equipo(Request  $request, $id){
        $equipos = DB::connection('mariadb')
                    ->table('equipo')
                    ->join('users','equipo.id_tecnico','=','users.id')
                    ->select('users.name','equipo.nombre','equipo.estado','equipo.observaciones','equipo.time_create')
                    ->get();

        return $equipos;
    }

    public function store(Request $request){

        $url = parse_url(url()->current());
        $url['sections'] = explode('/', $url['path']);
        $tipo_equipo  = end($url['sections']);
        
        /* crear un nuevo equipo  */
        $equipo = new equipo();
        $equipo->setConnection('mariadb');
        $equipo->nombre = $request->input('nombre');
        $equipo->observaciones = $request->input('observaciones');
        $equipo->firmware= $request->input('firmware');
        $equipo->ubicacion = $request->input('ubicacion');
        $equipo->frecuencia_de_envio = $request->input('frecuencia_de_envio');
        $equipo->id_tecnico = $request->input('id_tecnico');
        #$tipo_equipo = $request->input('tipo_equipo');
        $equipo->estado = "En espera";
        $equipo->mensaje = "Aun no hay mensaje por parte de soporte";

       
        /* condiciones para ver que tipo de equipo es */
        if ($tipo_equipo  == "add_coordinador"){
            $equipo->tipo_equipo = "coordinador";
            $equipo->save();
            $coordinador = new equipo_coordinador();
            $coordinador->setConnection('mariadb');
            $coordinador->tipo_placa = $request->input('tipo_placa');
            $coordinador->id_equipo = $equipo->id;
            $coordinador->save();

            return response()->json([
                "id_equipo"=>$equipo->id,
                "nombre"=>$equipo->nombre,
                "observaciones"=>$equipo->observaciones,
                "firmware"=>$equipo->firmware,
                "frecuencia de envio"=>$equipo->frecuencia_de_envio,
                "dsfafsdsaf"=> $equipo->equipo_coordinador->tipo_placa,
                "tipo placa"=>$equipo->users->name,
                "tipo"=>"coordinador"

                
            ]);
        }
        elseif($tipo_equipo== 'add_sonda'){
            $equipo->tipo_equipo = "sonda";
            $equipo->save();
            $sonda = new equipo_sonda();
            $sonda->setConnection('mariadb');
            $sonda->tipo_placa = $request->input('tipo_placa');
            $sonda->compania3G= $request->input('compania3G');
            $sonda->tipo_sonda= $request->input('tipo_sonda');
            $sonda->largo_sonda= $request->input('largo_sonda');
            $sonda->id_equipo = $equipo->id;
            $sonda->save();

            return response()->json([
                "id_equipo"=>$equipo->id,
                "nombre"=>$equipo->nombre,
                "observaciones"=>$equipo->observaciones,
                "firmware"=>$equipo->firmware,
                "frecuencia de envio"=>$equipo->frecuencia_de_envio,
                
                "tipo placa"=>$sonda->tipo_placa,
                "compañia 3G"=>$sonda->compania3G,
                "tipo sonda"=>$sonda->tipo_sonda,
                
                "largo sonda"=>$sonda->largo_sonda,
                
    
            ]);

            
        }

        elseif($tipo_equipo == 'add_canal'){
            $equipo->tipo_equipo = "canal";
            $equipo->save();
            $canal = new equipo_canal();
            $canal->setConnection('mariadb');
            $canal->tipo_placa = $request->input('tipo_placa');
            $canal->altura_agua= $request->input('altura_agua');
            $canal->altura_sensor= $request->input('altura_sensor');
            $canal->altura_max_canal= $request->input('altura_max_canal');
            $canal->id_equipo = $equipo->id;
            $canal->save();

            return response()->json([
                "id_equipo"=>$equipo->id,
                "nombre"=>$equipo->nombre,
                "observaciones"=>$equipo->observaciones,
                "firmware"=>$equipo->firmware,
                "frecuencia de envio"=>$equipo->frecuencia_de_envio,
                
                "tipo placa"=>$canal->tipo_placa,
                "altura agua"=>$canal->altura_agua,
                "altura sensor"=>$canal->altura_sensor,
                "altura_max_canal"=>$canal->altura_max_canal,
                
    
            ]);

                 
        }
        elseif($tipo_equipo== 'add_estacion'){
            $equipo->tipo_equipo = "estacion";
            $equipo->save();
            $estacion = new equipo_estacion();
            $estacion->setConnection('mariadb');
            $estacion->tipo_placa = $request->input('tipo_placa');
            $estacion->compania3G= $request->input('compania3G');
            $estacion->id_equipo = $equipo->id;
            $estacion->save();

            return response()->json([
                "id_equipo"=>$equipo->id,
                "nombre"=>$equipo->nombre,
                "observaciones"=>$equipo->observaciones,
                "firmware"=>$equipo->firmware,
                "frecuencia de envio"=>$equipo->frecuencia_de_envio,
                
                "tipo placa"=>$estacion->tipo_placa,
                "compañia 3G"=>$estacion->compania3G,
                
    
            ]);
        }
        elseif($tipo_equipo== 'add_pozo'){
            $equipo->tipo_equipo = "pozo";
            $equipo->save();
            $pozo = new equipo_pozo();
            $pozo->setConnection('mariadb');
            $pozo->compania3G = $request->input('compania3G');
            $pozo->profundidad_pozo = $request->input('profundidad_pozo');
            $pozo->nivel_estatico = $request->input('nivel_estatico');
            $pozo->nivel_dinamico = $request->input('nivel_dinamico');
            $pozo->referencia_sh = $request->input('referencia_sh');
            $pozo->tipo_sensor = $request->input('tipo_sensor');
            $pozo->tipo_energia = $request->input('tipo_energia');
            $pozo->factor_pulsos = $request->input('factor_pulsos');
            $pozo->id_equipo = $equipo->id;
            $pozo->save();
            
        }

    }


}