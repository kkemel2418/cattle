<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Models\Regiao;

header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");


class RegiaoController extends Controller
{

    public function index()
    {
        return response()->json("USUARIO INDEX CONTROLLER");
    }

    public function getRegiao(){

        $regiao = Regiao::all();
        return response()->json($regiao);
    }

    public function getRegiaoId($id){

        $regiao_id = Regiao::where('regiao_id', $id)->get();
        return response()->json($regiao_id);
    }

    public function create(Request $request ){

            $insert = Regiao::insert([
                'zona_circulacao'   => $request->zona_circulacao,
                'status'            => 1
             ]);

            if($insert){

                $lastInsert_id = Regiao::select('regiao_id')->orderBy('regiao_id', 'DESC')->get()->first();
                $insert_log = Log::insert([
                    'user_id'       => $request->user_id,
                    'acao'          => 'create',
                    'pagina'        => 'regiao-create.component',
                    'tb_acao'       => 'tb_regiao',
                    'item_acao'     => $lastInsert_id['regiao_id']
                ]);

                return response()->json(true);

            } else {
                // the query failed
                return response()->json(false);
            }

    }

    public function update(Request $request, $id){

        if(Regiao::where('regiao_id',$request->id)->exists())
        {
           $regiao = Regiao::find($request->id);
           $regiao->zona_circulacao = $request->zona_circulacao;
           $regiao->updated_at = now()->toDateTimeString();
           $regiao->save();

            $insert_log = Log::insert([
                'user_id'       =>  $request->user_id,
                'acao'          => 'update',
                'pagina'        => 'regiao-update.component',
                'item_acao'     =>  $request->id ,
                'tb_acao'       => 'tb_regiao'
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

          if(Regiao::where('regiao_id',$toInt_id)->exists())
          {
              // $usuario = User::find($id);
              // $usuario->delete();

                $usuario = Regiao::find($toInt_id);
                $usuario->status = 0;
                $usuario->save();

              $insert_log = Log::insert([
                  'user_id'       => $toInt_user_id,
                  'acao'          => 'delete',
                  'pagina'        => 'regiao.component',
                  'item_acao'     =>  $toInt_id ,
                  'tb_acao'       => 'tb_regiao'
              ]);

              return response()->json([
                  "message" => "Registro Deletado"
              ], 200);

          }else{

              return response()->json([
                  "message" => "Usuário não encontrado"
               ], 404);

          }
    }
}


