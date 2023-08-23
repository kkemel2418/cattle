<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Log;
use Illuminate\Http\Request;


header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");

class EventoController extends Controller
{
    public function index()
    {

    }

    public function getEventoId($id){

        $evento_id = Evento::where('evento_id', $id)->get();
        return response()->json($evento_id);
    }

    public function create(Request $request){

        $insert = Evento::insert([
            'evento_data'     => $request->evento['evento_data'],
            'evento_nome'     => $request->evento['evento_nome'],
            'evento_tipo'     => $request->evento['evento_tipo'],
            'status'          => 1
            ]);

        if($insert){

            $lastInsert_id = Evento::select('evento_id')->orderBy('evento_id', 'DESC')->get()->first();
                  $insert_log = Log::insert([
                        'user_id'       => $request->user_id,
                        'acao'          => 'create',
                        'pagina'        => 'evento-create.component',
                        'tb_acao'       => 'tb_evento',
                        'item_acao'     => $lastInsert_id['evento_id']
                    ]);

                 return response()->json(true);

        } else {

                 return response()->json(false);
        }


    }

    public function update(Request $request, $id){

        if(Evento::where('evento_id',$request->evento['evento_id'])->exists())
        {
           $evento = Evento::find($request->evento['evento_id']);
           $evento->evento_tipo = $request->evento['evento_tipo'];
           $evento->evento_nome = $request->evento['evento_nome'];
           $evento->evento_data = $request->evento['evento_data'];
           $evento->updated_at  = now()->toDateTimeString();
           $evento->save();

            $insert_log = Log::insert([
                'user_id'       =>  $request->user_id,
                'acao'          => 'update',
                'pagina'        => 'evento-update.component',
                'item_acao'     =>  $request->evento['evento_id'] ,
                'tb_acao'       => 'tb_evento'
            ]);

             return response()->json([
                 "message" => "Atualizado com Sucesso!"
             ], 200);

          }else{

             return response()->json([
                "message" => "Evento não encontrado"
             ],404);
        }

    }

    public function destroy(Request $request,  $data){

        $toString_user_id = strval($request->user_id);
        $toInt_user_id =(int)$toString_user_id;
        $toString_id = strval($request->id);

        $toInt_id =(int)$toString_id;

          if(Evento::where('evento_id',$toInt_id)->exists())
          {
                $evento = Evento::find($toInt_id);
                $evento->status = 0;
                $evento->save();

              $insert_log = Log::insert([
                  'user_id'       => $toInt_user_id,
                  'acao'          => 'delete',
                  'pagina'        => 'evento.component',
                  'item_acao'     =>  $toInt_id ,
                  'tb_acao'       => 'tb_evento'
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
