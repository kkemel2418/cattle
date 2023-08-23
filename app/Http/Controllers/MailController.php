<?php

namespace App\Http\Controllers;

use App\Mail\newLaravelTips;
use App\Models\User;
use App\Models\PasswordResets;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Users;
use App\Models\Log;

class MailController extends Controller
{
    public function sendMail(){

        $name ='kemel';
       // Mail::to('admin@it4d.com.br')->send(new newLaravelTips($name));
       //  return view('welcome');

    }

    public function sendMail2(Request $request){


        if(User::where('email', $request->email)->exists())
        {

             $id   = User::select('id')->where('email', $request->email)->get()->first();
             $name = User::select('name')->where('email', $request->email)->get()->first();
             $token = strtoupper(substr(bin2hex(random_bytes(8)), 1));

              $insert = PasswordResets::insert([
                    'email'        => $request->email,
                    'token'        => $token,
                    'user_id'      => $id->id,
                    'created_at'   => now()->toDateTimeString()
                ]);

                $insert_log = Log::insert([
                    'user_id'       =>  $id,
                    'acao'          => 'recuperacao de senha',
                    'pagina'        => 'email',
                    'item_acao'     =>  $id
                  ]);


             Mail::to('admin@it4d.com.br')->send(new newLaravelTips($name->name, $token, $request->email));

             //return response()->json([ "message" => "Email Enviado"], 200);
             return response()->json(1);

        }else{

            // return response()->json([  "message" => "Email nao encontrado" ], 200);
             return response()->json(0);
        };

    }

     //  public function verificaToken($email, $token, $nova_senha){
    public function verificaToken(Request $request){

        $result = PasswordResets::where('token',$request->token)->where('email', $request->email)->exists();

        if(empty($result)){
             //   Nao existe
            return response()->json(0) ;

        }else{

            // Update na tabela substituindo o valor do token para ========

            $update_password_resets = PasswordResets::where('token', $request->token)->where('email',$request->email)->update(['token' =>'============', 'updated_at' => now()]);
            $update_users = User::where('email', $request->email)->update(['password'=> sha1($request->nova_senha)]);
            return response()->json(1) ;

        }

    }
}
