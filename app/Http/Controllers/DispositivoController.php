<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dispositivo;
use App\Models\Log;
use Illuminate\Events\Dispatcher;

//header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");


class DispositivoController extends Controller
{
    public function index()
    {
        return Dispositivo::all();
        //return response()->json("USUARIO INDEX CONTROLLER");
    }

    public function getDispositivo(){

        $dispositivo = Dispositivo::all();
        return response()->json($dispositivo);
    }

    public function getDispositivoId($id){

        $dispositivo_id = Dispositivo::where('id', $id)->get();
        return response()->json($dispositivo_id);

    }

    public function createForm(){

        return view('dispositivo_create');

    }


    public function create(Request $request){

         $insert = Dispositivo::insert([
            'dispositivo_serie'      => $request->dispositivo['dispositivo_serie'],
            'dispositivo_modelo'     => $request->dispositivo['dispositivo_modelo'],
            'dispositivo_fabricante' => $request->dispositivo['dispositivo_fabricante'],
            'status'                 => 1,
         ]);

        if($insert){

            $lastInsert_id = Dispositivo::select('id')->orderBy('id', 'DESC')->get()->first();
            $insert_log = Log::insert([
                'user_id'       => $request->user_id,
                'acao'          => 'create',
                'pagina'        => 'dispositivo-create.component',
                'tb_acao'       => 'tb_dispositivo',
                'item_acao'     => $lastInsert_id['id']
            ]);

            return response()->json(true);

        } else {
            // the query failed
            return response()->json(false);
        }

    }

    public function update(Request $request, $id){

       if(Dispositivo::where('id',$request->dispositivo['id'])->exists())
        {
           $dispositivo = Dispositivo::find($request->dispositivo['id']);
           $dispositivo->dispositivo_serie = $request->dispositivo['dispositivo_serie'];
           $dispositivo->dispositivo_modelo = $request->dispositivo['dispositivo_modelo'];
           $dispositivo->dispositivo_fabricante = $request->dispositivo['dispositivo_fabricante'];
           $dispositivo->updated_at = now()->toDateTimeString();
           $dispositivo->save();

            $insert_log = Log::insert([
                'user_id'       =>  $request->user_id,
                'acao'          => 'update',
                'pagina'        => 'dispositivo-update.component',
                'item_acao'     =>  $request->dispositivo['id'] ,
                'tb_acao'       => 'tb_dispositivo'
            ]);

             return response()->json([
                 "message" => "Atualizado com Sucesso!"
             ], 200);

          }else{

             return response()->json([
                "message" => "Usuário não encontrado"
             ],404);
        }

    }

    public function destroy(Request $request,  $data){

        $toString_user_id = strval($request->user_id);
        $toInt_user_id =(int)$toString_user_id;
        $toString_id = strval($request->id);

        $toInt_id =(int)$toString_id;

          if(Dispositivo::where('id',$toInt_id)->exists())
          {
                $raca = Dispositivo::find($toInt_id);
                $raca->status = 0;
                $raca->save();

              $insert_log = Log::insert([
                  'user_id'       => $toInt_user_id,
                  'acao'          => 'delete',
                  'pagina'        => 'dispositivo.component',
                  'item_acao'     =>  $toInt_id ,
                  'tb_acao'       => 'tb_dispositivo'
              ]);

              return response()->json([
                  "message" => "Registro Deletado"
              ], 200);

          }else{

              return response()->json([
                  "message" => "Item não encontrado"
               ], 404);

          }

    }
}
