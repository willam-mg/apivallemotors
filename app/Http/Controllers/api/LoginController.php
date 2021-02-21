<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;

/**
 * @group  Login
 *
 * Autentifica usuarios de tipo adminitrador, paciente y medico
 */
class LoginController extends Controller{

    /**
	 * Login admin (public)
	 *
	 * Autentifica un usuario de tipo administrador.
	 *
     * @bodyParam email email required Example: waldo@waldo.com
     * @bodyParam password string required Example: waldo123123
     * 
     * @response  {
     *      "id":18,
     *      "nombre_completo":"waldo",
     *      "email":"waldo@waldo.com",
     *      "foto":null,
     *      "accessToken":"eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZGQwNjgyZWYxYWI0ZGM1YzQ4OWYzODI2OWMyM2FiOTU1ODZlMGFiNmUyYmE0NzQ4OWJmMzVkNjBmY2M5ZTMxZjAxMTExMmM2YWFjYzVmODUiLCJpYXQiOjE1OTIzNDgxNTYsIm5iZiI6MTU5MjM0ODE1NiwiZXhwIjoxNjIzODg0MTU2LCJzdWIiOiIxOCIsInNjb3BlcyI6W119.S1KBVVN7UzSxzJ0G16vr592GgiRjD8P4m8n_LLrm5jyeLJHNxvf7ImenYX2f5SzbrZk4WgSmnbVg7JsQnQ-mCDdCRCsfcpql6EjPPlxnDdDQ5JbkkoRMMd874feVAlTubiKvlhod6-z4edFkz79fzPO9sTBQzCR9MbxVz9rDQ0VXRLrjnk4I_Xqrevgmp55RZVzJRg9MSV0yCboMGMzIjMTo28p1AhgejN0aSFRlVYzUjasjLIVu7MQohwD6ya2U2hugRajvAWrMemWqB0CHfNAXwvfhxyd9_jGAjRs5SNeZjL2SpVQCNTd6lhfQ6AKVGEsDt0MOFGubhfAQzG5VyFB33yTxGLL2-JegSiuk-EKZ18J-egQMgExexfFNapJmoPRKzRzgW3Q7Y8zcME9SIM18um-Kf1UNvcqhhAz5XqG96UHcJzxETo9xnC0EPR9560ycy4Gwc171DP1zn6vrlZWGonmCFT8MSExB3spK1g9koyg74XgF-DqW4KdSdHpyUBRWmxFzKA1RLoqKWuK5d0AbHB9fbosNWgSXwwB8loN6Bd7Fhgfp3Ke9JG7Ajc3-lOvV1o3qoUZEW-83cGNIZeElu-shUWuxe428le3Ckxwi2HUjW6f-DMbSWfBZBOcqQfrJhZmsOHy4ekMcPWH60fF3OROZH5M62rksOKRi94w"
     * }
     
     * @response  {
     *      "id":18,
     *      "nombre_completo":"waldo",
     *      "email":"waldo@waldo.com",
     *      "foto":"http://pacientemedico.ds:998/uploads/user_2200608000357.jpg",
     *      "accessToken":"eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZGQwNjgyZWYxYWI0ZGM1YzQ4OWYzODI2OWMyM2FiOTU1ODZlMGFiNmUyYmE0NzQ4OWJmMzVkNjBmY2M5ZTMxZjAxMTExMmM2YWFjYzVmODUiLCJpYXQiOjE1OTIzNDgxNTYsIm5iZiI6MTU5MjM0ODE1NiwiZXhwIjoxNjIzODg0MTU2LCJzdWIiOiIxOCIsInNjb3BlcyI6W119.S1KBVVN7UzSxzJ0G16vr592GgiRjD8P4m8n_LLrm5jyeLJHNxvf7ImenYX2f5SzbrZk4WgSmnbVg7JsQnQ-mCDdCRCsfcpql6EjPPlxnDdDQ5JbkkoRMMd874feVAlTubiKvlhod6-z4edFkz79fzPO9sTBQzCR9MbxVz9rDQ0VXRLrjnk4I_Xqrevgmp55RZVzJRg9MSV0yCboMGMzIjMTo28p1AhgejN0aSFRlVYzUjasjLIVu7MQohwD6ya2U2hugRajvAWrMemWqB0CHfNAXwvfhxyd9_jGAjRs5SNeZjL2SpVQCNTd6lhfQ6AKVGEsDt0MOFGubhfAQzG5VyFB33yTxGLL2-JegSiuk-EKZ18J-egQMgExexfFNapJmoPRKzRzgW3Q7Y8zcME9SIM18um-Kf1UNvcqhhAz5XqG96UHcJzxETo9xnC0EPR9560ycy4Gwc171DP1zn6vrlZWGonmCFT8MSExB3spK1g9koyg74XgF-DqW4KdSdHpyUBRWmxFzKA1RLoqKWuK5d0AbHB9fbosNWgSXwwB8loN6Bd7Fhgfp3Ke9JG7Ajc3-lOvV1o3qoUZEW-83cGNIZeElu-shUWuxe428le3Ckxwi2HUjW6f-DMbSWfBZBOcqQfrJhZmsOHy4ekMcPWH60fF3OROZH5M62rksOKRi94w"
     * }
     * 
     * @response 403 {
            "message":"Email o contrase\u00f1a incorrectos"
     *  }
	 */
    public function admin(Request $request){
        $validator = Validator::make($request->all(), [
            'email'=>'required|string',
            'password'=>'required|string'
        ]);
        if ( $validator->fails() ){
            return response()->json([
                'message' => 'Los datos ingresados no son validos.', 
                'errors' => $validator->errors()
            ], 422);
        }
        $login = $request->validate([
            'email'=>'required|string',
            'password'=>'required|string'
        ]);

        if (!Auth::attempt($login)) {
            return response()->json([
                'message'=>'Email o contraseña incorrectos',
            ],403);
        }
        $user = Auth::user();

        $accessToken = $user->createToken('authToken')->accessToken;
        // $user = Auth::user();
        return response()->json([
            'id'=>$user->id,
            'nombre_completo'=>$user->admin?$user->admin->nombre_completo:$user->mecanico->nombre_completo,
            'email'=>$user->email,
            'foto'=>$user->foto,
            'accessToken'=>$accessToken,
            'type'=>$user->type
        ]);
    }

    /**
	 * Login paciente | medico (public)
	 *
	 * Autentifica un Paciente o Medico.
	 *
     * @bodyParam email email required Example: email@email.com
     * @bodyParam password string required Example: 123123213
     * @bodyParam player_id string required Example: playerIDfs123123213fds fds fd
     * 
     * @response {
     *   "id":12,
     *   "email":"email@mail.com",
     *   "type":2,
     *   "paciente_id":2,
     *   "nombre_completo":"nombre_completo",
     *   "ciudad":"ciudad",
     *   "direccion":"direccion blablaa",
     *   "celular":2432432,
     *   "player_id":"player_idds ds dsd sdsadas dsa",
     *   "foto":"http://pacientemedico.ds:998/uploads/user_2200608000357.jpg",
     *   "accessToken":"accessToken 34243423432"
     * }
     * 
     * @response {
     *   "id":12,
     *   "email":"email@mail.com",
     *   "type":2,
     *   "medico_id":3,
     *   "nombre_completo":"nombre_completo",
     *   "ciudad":"ciudad",
     *   "direccion":"direccion blablaa",
     *   "celular":2432432,
     *   "player_id":"player_idds ds dsd sdsadas dsa",
     *   "foto":"http://pacientemedico.ds:998/uploads/user_2200608000357.jpg",
     *   "matricula":"http://pacientemedico.ds:998/uploads/user_2200608000357.jpg",
     *   "accessToken":"accessToken 34243423432"
     * }
     * 
     * @response 403 {
            "message":"Email o contrase\u00f1a incorrectos"
     *  }
	 */
    public function pacienteMedico(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'email'=>'required|string',
                'password'=>'required|string',
                'player_id'=>'required|string',
            ]);
            if ( $validator->fails() ){
                http_response_code(422);
                throw new \Exception($validator->errors()->first());
            }
            $login = $request->validate([
                'email'=>'required|string',
                'password'=>'required|string'
            ]);
    
            if (!Auth::attempt($login)) {
                http_response_code(404);
                throw new \Exception('Email o contraseña incorrectos');
            }
    
            $user = Auth::user();
            if ($user->type == User::TYPE_ADMIN) {
                http_response_code(403);
                throw new \Exception('No tiene credenciales');
            }
            
            $accessToken = $user->createToken('authToken')->accessToken;
            if ($user->type == User::TYPE_PACIENTE) {
                $user->paciente->player_id = $request->player_id;
                $user->paciente->save();
                return response()->json([
                    'id'=>$user->id,
                    'email'=>$user->email,
                    'type'=>$user->type,
                    'paciente_id'=>$user->paciente->id,
                    'nombre_completo'=>$user->paciente->nombre_completo,
                    'ciudad'=>$user->paciente->ciudad,
                    'direccion'=>$user->paciente->direccion,
                    'celular'=>$user->paciente->celular,
                    'player_id'=>$user->paciente->player_id,
                    'foto'=>$user->paciente->foto,
                    'accessToken'=>$accessToken
                ], 200);
            }else if($user->type == User::TYPE_MEDICO){
                $user->medico->player_id = $request->player_id;
                $user->medico->save();
                return response()->json([
                    'id'=>$user->id,
                    'email'=>$user->email,
                    'type'=>$user->type,
                    'medico_id'=>$user->medico->id,
                    'nombre_completo'=>$user->medico->nombre_completo,
                    'ciudad'=>$user->medico->ciudad,
                    'direccion'=>$user->medico->direccion,
                    'celular'=>$user->medico->celular,
                    'player_id'=>$user->medico->player_id,
                    'foto'=>$user->medico->foto,
                    'matricula'=>$user->medico->matricula,
                    'accessToken'=>$accessToken
                ], 200);
            }
        } catch (\Throwable  $th) {
            if (http_response_code() !== 200){
                return response()->json([
                    'message' => $th->getMessage(),
                ],http_response_code());
            }
            http_response_code(500);
            throw $th;
        }
        
    }
}
