<?php

namespace App\Http\Controllers;


use App\Models\Animal;
use App\Models\Dispositivo;
use App\Models\Log;
use App\Models\Raca;
use App\Models\TipoAnimal;
use App\Models\Vacina;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");

class AnimalController extends Controller
{
    public function index()
    {

       //$animal = Animal::all();
       $animal = DB::table('tb_animal')
               ->select('tb_animal.*','tb_tipo_animal.tipo_animal as nome_tipo_animal')
               ->join('tb_tipo_animal','tb_tipo_animal.tipo_animal_id',"=",'tb_animal.tipo_animal')
               ->get();

       return response()->json($animal);

    }

    public function createForm(){

        $raca        = Raca::all();
        $tipo        = TipoAnimal::all();
        $vacina      = Vacina::all();
        $evento      = Evento::all();
        $dispositivo = Dispositivo::all();

        return view('animal_create', ['raca' => $raca, 'tipo' => $tipo,'vacina'=> $vacina,'evento' => $evento, 'dispositivo'=> $dispositivo]);

    }

    public function getView(){

      //  return view("animal");
      $animal = Animal::all();
     // print_r($animal);

       return view('animal', ['animais' => $animal]);

    }

    public function getAnimal(){

        $animal = Animal::all();
        return response()->json($animal);

    }

    public function getAnimalId($id){

        $animal_id   = Animal::where('animal_id', $id)->get()->first();
        $raca        = Raca::all();
        $tipo        = TipoAnimal::all();
        $vacina      = Vacina::all();
        $evento      = Evento::all();
        $dispositivo = Dispositivo::all();


        return view('animal_update', ['animal' => $animal_id, 'raca' => $raca, 'tipo' => $tipo,'vacina'=> $vacina,'evento' => $evento, 'dispositivo'=> $dispositivo]);


    }

    public function create(Request $request ){

        $insert = Animal::insert([
                                'tipo_animal'       => $request->animal['tipo_animal'],
                                'animal_raca'       => $request->animal['animal_raca'],
                                'vacina'            => $request->animal['vacina'],
                                'nascimento_data'   => $request->animal['nascimento_data'],
                                'evento_historico'  => $request->animal['evento_historico'],
                                'dispositivo_serie' => $request->animal['dispositivo_serie'],
                                'peso'              => $request->animal['peso'],
                                'status'            => 'Ativo'
                            ]);

        if($insert){

            $lastInsert_id = Animal::select('animal_id')->orderBy('animal_id', 'DESC')->get()->first();
                 $insert_log = Log::insert([
                                'user_id'       => $request->user_id,
                                'acao'          => 'create',
                                'pagina'        => 'animal-create.component',
                                'tb_acao'       => 'tb_animal',
                                'item_acao'     => $lastInsert_id['animal_id']
                               ]);

                return response()->json(true);

        } else {
                  // the query failed
                 return response()->json(false);
        }

    }

    public function update(Request $request, $id){

      //  dd($request->all());
   // die();

       $user =  Session::get('user');
       $user_id =  Session::get('user_id');


      if(Animal::where('animal_id',$id)->exists())
        {

           $animal = Animal::find($id);
           $animal->tipo_animal       = $request->id_tipo;
           $animal->animal_raca       = $request->animal_raca;
           $animal->vacina            = $request->vacina;
           $animal->nascimento_data   = $request->data_nascimento;
           $animal->evento_id         = $request->evento_id;
           $animal->dispositivo_id    = $request->dispositivo_id;
           $animal->peso              = $request->peso;
           $animal->status            = $request->status;
           $animal->updated_at        = now()->toDateTimeString();
           $animal->save();

           $insert_log = Log::insert([
            'user_id'       =>  $user_id,
            'acao'          => 'update',
            'pagina'        => 'animal-update.component',
            'item_acao'     =>  $id ,
            'tb_acao'       => 'tb_animal'
          ]);

         /*  return response()->json([
               "message" => "Atualizado com Sucesso!"
           ], 200);  Padrão retorno API  */

           return response()->json("Alterado com Sucesso!");

          }else{

           return response()->json("Id Animal não encontrado!");
          //  return view('animal_update')->with('returnMsg','Id Animal não encontrado');
        }

    }

    public function destroy(Request $request, $data){

        $toString_user_id = strval($request->user_id);
        $toInt_user_id =(int)$toString_user_id;
        $toString_id = strval($request->id);

        $toInt_id =(int)$toString_id;

        if(Animal::where('animal_id',$toInt_id)->exists())
        {
          //  $dispositivo = Animal::find($id);
          //  $dispositivo->delete();

            $usuario = Animal::find($toInt_id);
            $usuario->status = 0;
            $usuario->save();

            $insert_log = Log::insert([
                'user_id'       => $toInt_user_id,
                'acao'          => 'delete',
                'pagina'        => 'animal.component',
                'item_acao'     =>  $toInt_id ,
                'tb_acao'       => 'tb_animal'
            ]);

            return response()->json([
                "message" => "Registro Deletado"
            ], 200);

        }else{

            return response()->json([
                "message" => "Id Animal não encontrado"
             ], 404);

        }

    }

}
