<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Locomotiva;
use Illuminate\Support\Facades\DB;

class LocomotivaController extends Controller
{

     public function __construct(Locomotiva $locomotiva)
     {
        $this->trem = $locomotiva;
     }
    public function index()
    {
        return view('locomotiva');
    }

    public function getRede(Request $request){

        $sinal =  explode(',', $request->sinal);

        $qtd = sizeof($sinal);

        $param = '';

        for ($x = 0; $x < $qtd; $x++) {

              if($x == 0){
                $param .= "'".$sinal[$x]."'";

              }else{
                $param .= " or rede =  '".$sinal[$x]."'";
              }

        }

        $results = DB::select("select rede, latitude, longitude , icone , data_hora, velocidade ,
                                                 gps , gsm , sinal , operadora , rede , endereco ,
                                                 bateria , bateria_reserva
                                    from tb_locomotiva where rede = ".$param);

        return response()->json($results);


    }

    public function getData(Request $request){


        $data_inicial =  $request->data_inicial;


        if(empty($request->data_final)){

           $data_final =  date('Y-m-d H:i:s');

        }else{

            $data_final = $request->data_final;
        }

        //$return = Locomotiva::select('rede','latitude', 'longitude','icone','data_hora', 'velocidade' , 'gps', 'gsm', 'sinal', 'operadora', 'rede','endereco','bateria','bateria_reserva')->whereBetween('data_hora', [$data_inicial, $data_final])->get();
        $return =  DB::select("select rede, latitude, longitude , icone , data_hora, velocidade ,
                                                gps , gsm , sinal , operadora , rede , endereco ,
                                                bateria , bateria_reserva
                                from tb_locomotiva
                                where (data_hora BETWEEN '" .$data_inicial."' and '".$data_final."')");


        if(empty($return)){

            return response()->json(0);
        }else{

            return response()->json($return);
        }

    }
}

?>
