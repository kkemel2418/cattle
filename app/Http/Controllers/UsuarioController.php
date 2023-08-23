<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");

class UsuarioController extends Controller
{
    public function index()
    {
        return response()->json("USUARIO INDEX CONTROLLER");
    }

    public function getUsuario(){

        //  $raca = Raca::all();
        //  $raca = DB::table(table: 'tb_raca')->paginate(perPage:2);
       //   return response()->json($raca);
    }

    public function getUsuarioId($id){

        $usuario_id = User::where('id', $id)->get();
        return response()->json($usuario_id);

    }

    public function create(Request $request ){

        $insert = User::insert([
                       'name'        => $request->usuario['name'],
                       'email'       => $request->usuario['email'],
                       'password'    => sha1($request->usuario['password']),
                       'status'      => 1
         ]);

        if($insert){

           $lastInsert_id = User::select('id')->orderBy('id', 'DESC')->get()->first();
            $insert_log = Log::insert([
                'user_id'       => $request->user_id,
                'acao'          => 'create',
                'pagina'        => 'usuario-create.component',
                'tb_acao'       => 'users',
                'item_acao'     => $lastInsert_id['id']
            ]);

            return response()->json(true);

        } else {
            // the query failed
            return response()->json(false);
        }

    }

    public function update(Request $request, $id){
      //  echo ($request->user_id);
      //  echo("<br>");
      //  echo ($request->id);
       // echo("<br>");
     //  echo ($request->usuario['email']);

        if(User::where('id',$request->id)->exists())
        {
           $usuario = User::find($request->id);
           $usuario->name = $request->usuario['name'];
           $usuario->email = $request->usuario['email'];
           $usuario->password = $request->usuario['password'];
           $usuario->updated_at = now()->toDateTimeString();
           $usuario->save();

            $insert_log = Log::insert([
                'user_id'       =>  $request->user_id,
                'acao'          => 'update',
                'pagina'        => 'usuario-update.component',
                'item_acao'     =>  $request->id ,
                'tb_acao'       => 'users'
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

        if(User::where('id',$toInt_id)->exists())
        {
            // $usuario = User::find($id);
            // $usuario->delete();



              $usuario = User::find($toInt_id);
              $usuario->status = 0;
              $usuario->save();

            $insert_log = Log::insert([
                'user_id'       => $toInt_user_id,
                'acao'          => 'delete',
                'pagina'        => 'usuario.component',
                'item_acao'     =>  $toInt_id ,
                'tb_acao'       => 'users'
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

    public function login(Request $request){

        if(User::where([['name','=',$request->name], ['password','=',sha1($request->password)]])->exists()){

            $user_id = User::select('id')->where([['name','=',$request->name], ['password','=',sha1($request->password)]])->get()->first();

         //  Session::put('user_name', $request->name);
          //  Session::put('user_id', $user_id['id']);

          session()->put('user_id', $request->user_id);



            $insert_log = Log::insert([
                 'user_id'       =>  $user_id['id'],
                 'acao'          => 'login',
                 'pagina'        => 'login.component'

            ]);

            $return = array(1, $user_id['id'] , $request->name);
               return response()->json($return);

            }else{

                $return = array(0);
                  return response()->json($return);
            }

    }


    public function logCattle(){

        $res = Log::all();
        return response()->json($res);

    }

    public function logRead(Request $request){

        $toString_id = strval($request->id);

        $log = DB::table('tb_log')
                    ->join('users','users.id',"=",'tb_log.user_id')
                    ->select('tb_log.*','users.name','users.email')
                    ->where('tb_log.id','=',$toString_id)
                    ->get();
            return response()->json($log);

    }
}












