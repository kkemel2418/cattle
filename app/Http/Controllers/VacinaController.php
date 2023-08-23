<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Vacina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");


class VacinaController extends Controller
{
    public function index()
    {
        $vacina = DB::table('tb_vacina')
        ->select('tb_vacina.*','tb_tipo_animal.tipo_animal as nome_tipo_animal')
        ->join('tb_tipo_animal','tb_tipo_animal.tipo_animal_id',"=",'tb_vacina.tipo_animal')
        ->get();

        return response()->json($vacina);

    }


    public function getVacinaId($id){

        $vacina_id = Vacina::where('vacina_id', $id)->get();

        return response()->json($vacina_id);
    }

    public function create(Request $request ){
      //  echo   response()->json($request->vacina['recorrencia']);

        $insert = Vacina::insert([
            'nome_vacina'   => $request->vacina['nome_vacina'],
            'recorrencia'   => $request->vacina['recorrencia'],
            'tipo_animal'   => $request->vacina['tipo_animal'],
            'status'        => 1
         ]);

        if($insert){

            $lastInsert_id = Vacina::select('vacina_id')->orderBy('vacina_id', 'DESC')->get()->first();
            $insert_log = Log::insert([
                'user_id'       => $request->user_id,
                'acao'          => 'create',
                'pagina'        => 'vacina-create.component',
                'tb_acao'       => 'tb_vacina',
                'item_acao'     => $lastInsert_id['vacina_id']
            ]);

            return response()->json(true);

        } else {
            // the query failed
            return response()->json(false);
        }

    }

    public function update(Request $request, $id){


        if(Vacina::where('vacina_id',$request->id)->exists())
        {
           $vacina = Vacina::find($request->id);
           $vacina->nome_vacina = $request->vacina['nome_vacina'];
           $vacina->recorrencia = $request->vacina['recorrencia'];
           $vacina->tipo_animal = $request->vacina['tipo_animal'];
           $vacina->status      = $request->vacina['status'];
           $vacina->updated_at  = now()->toDateTimeString();
           $vacina->save();

            $insert_log = Log::insert([
                'user_id'       =>  $request->user_id,
                'acao'          => 'update',
                'pagina'        => 'vacina-update.component',
                'item_acao'     =>  $request->id ,
                'tb_acao'       => 'tb_vacina'
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

          if(Vacina::where('vacina_id',$toInt_id)->exists())
          {

                $usuario = Vacina::find($toInt_id);
                $usuario->status = 0;
                $usuario->save();

              $insert_log = Log::insert([
                  'user_id'       => $toInt_user_id,
                  'acao'          => 'delete',
                  'pagina'        => 'vacina.component',
                  'item_acao'     =>  $toInt_id ,
                  'tb_acao'       => 'tb_vacina'
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
