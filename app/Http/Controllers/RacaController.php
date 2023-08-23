<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Raca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");

class RacaController extends Controller
{
    public function __construct()
    {
        $this->user = Session::get('user');
        $this->user_id = Session::get('user_id');

    }

    public function getView(){

        $raca= Raca::all()->sortBy("raca_id");
         return view('raca', ['raca' => $raca]);

    }
    public function getRacaId($id){

        $raca  = Raca::where('raca_id', $id)->get()->first();
        return view('raca_update', ['raca' => $raca]);

    }

    public function create(Request $request ){

           $insert = Raca::insert([
            'raca_nome'     => $request->raca['raca_nome'],
            'descricao'     => $request->raca['descricao'],
            'quantidade'    => sha1($request->raca['quantidade']),
            'status'        => 1
            ]);

            if($insert){

            $lastInsert_id = Raca::select('raca_id')->orderBy('raca_id', 'DESC')->get()->first();
            $insert_log = Log::insert([
                'user_id'       => $request->user_id,
                'acao'          => 'create',
                'pagina'        => 'raca-create.component',
                'tb_acao'       => 'tb_raca',
                'item_acao'     => $lastInsert_id['raca_id']
            ]);

            return response()->json(true);

            } else {
            // the query failed
            return response()->json(false);
            }

     }


    public function update(Request $request, $id){

      //  echo   response()->json($request->raca);
       // echo   response()->json($request->user_id);

        if(Raca::where('raca_id',$request->raca['raca_id'])->exists())
        {
           $raca = Raca::find($request->raca['raca_id']);
           $raca->raca_nome = $request->raca['raca_nome'];
           $raca->descricao = $request->raca['descricao'];
           $raca->quantidade = $request->raca['quantidade'];
           $raca->updated_at = now()->toDateTimeString();
           $raca->save();

            $insert_log = Log::insert([
                'user_id'       =>  $request->user_id,
                'acao'          => 'update',
                'pagina'        => 'raca-update.component',
                'item_acao'     =>  $request->raca['raca_id'] ,
                'tb_acao'       => 'tb_raca'
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

          if(Raca::where('raca_id',$toInt_id)->exists())
          {
                $raca = Raca::find($toInt_id);
                $raca->status = 0;
                $raca->save();

              $insert_log = Log::insert([
                  'user_id'       => $toInt_user_id,
                  'acao'          => 'delete',
                  'pagina'        => 'raca.component',
                  'item_acao'     =>  $toInt_id ,
                  'tb_acao'       => 'tb_raca'
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


