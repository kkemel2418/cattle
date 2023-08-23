<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Models\TipoAnimal;
use Illuminate\Support\Facades\Session;


class TipoAnimalController extends Controller
{
    public function __construct()
    {
        $this->user = Session::get('user');
        $this->user_id = Session::get('user_id');

    }


    public function getView(){

        $tipos= TipoAnimal::all()->sortBy("animal_id");
         return view('tipo', ['tipos' => $tipos]);

    }

      public function getTipoId($id){

        $tipo_animal = TipoAnimal::where('tipo_animal_id', $id)->get();
        return view('tipo_update', ['tipo' => $tipo_animal]);
    }

    public function createForm(){

        $tipos= TipoAnimal::all()->sortBy("animal_id");

        return view('tipo_animal_create', ['tipos' => $tipos]);

    }

    public function create(Request $request ){

      $insert = TipoAnimal::insert([
            'tipo_animal'     => $request->tipo_animal['tipo_animal']
        ]);


         if($insert){

           $lastInsert_id = TipoAnimal::select('tipo_animal_id')->orderBy('tipo_animal_id', 'DESC')->get()->first();
            $insert_log = Log::insert([
                'user_id'       => $request->user_id,
                'acao'          => 'create',
                'pagina'        => 'tipo-create.component',
                'tb_acao'       => 'tb_tipo_animal',
                'item_acao'     => $lastInsert_id['tipo_animal_id']
            ]);

            return response()->json(true);

        } else {
            // the query failed
            return response()->json(false);
        }

    }

    public function update(Request $request, $id){

        if(TipoAnimal::where('tipo_animal_id',$id)->exists())
        {
            $tipo_animal = TipoAnimal::find($id);
            $tipo_animal->tipo_animal = $request->tipo_animal;
            $tipo_animal->status = $request->status;
            $tipo_animal->save();

            $insert_log = Log::insert([
                'user_id'       =>  $this->user_id,
                'acao'          => 'update',
                'pagina'        => 'tipo-update.component',
                'item_acao'     =>  $id ,
                'tb_acao'       => 'tb_tipo_animal'
            ]);

            return redirect()->back()->with('message', 'Alterado com Sucesso!');

        }else{

            return redirect()->back()->with('message', 'ID Tipo não encontrado');
        }

    }

    public function destroy(Request $request, $data){

        $toString_user_id = strval($request->user_id);
        $toInt_user_id =(int)$toString_user_id;
        $toString_id = strval($request->id);

        $toInt_id =(int)$toString_id;

          if(TipoAnimal::where('tipo_animal_id',$toInt_id)->exists())
          {

                $usuario = TipoAnimal::find($toInt_id);
                $usuario->status = 0;
                $usuario->save();

              $insert_log = Log::insert([
                  'user_id'       => $toInt_user_id,
                  'acao'          => 'delete',
                  'pagina'        => 'tipo-update.component',
                  'item_acao'     =>  $toInt_id ,
                  'tb_acao'       => 'tb_tipo_animal'
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
