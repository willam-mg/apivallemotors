<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Codigo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Intervention\Image\ImageManagerStatic as Image;
use App\Mail\MailCodigo;
use Carbon\Carbon;

/**
 * @group  User
 *
 * Un usuario puede ser de tipo Admin, Paciente y Medico
 */
class UserController extends Controller
{
    private function getUser($user){
        return [
            'id'=>$user->id,
            'nombre_completo'=>$user->admin->nombre_completo,
            'player_id'=>$user->admin->player_id,
            'email'=>$user->email,
            'foto'=>$user->foto,
        ];
    }

    private function formatError(\Throwable $th){
        if (http_response_code() !== 200){
            return response()->json([
                'message' => $th->getMessage(),
            ],http_response_code());
        }
        http_response_code(500);
        throw $th;
        return null;
    }

    /**
     * panel user
     * 
     * muestra la lista de uuarios de tipo admin
     */
    public function index(){
        $usuarios = User::where([
            'type'=>User::TYPE_ADMIN,
        ])->paginate(5);
        return view('user/index', compact('usuarios'));
    }

    /**
     * panel user
     * 
     * muestra el perfil de uuarios de tipo admin
     */
    public function profile($id=null){
        $user =  Auth::user();
        if ($id){
            $user = User::find($id);
        }
        return view('user/profile', compact('user', 'id'));
    }

    /**
     * panel user
     * 
     * muestra la pagin para editar el perfil de un usuario de tipo admin
     */
    public function editProfile($id=null){
        $user =  Auth::user();
        if ($id){
            $user = User::find($id);
        }
        return view('user/update-profile', compact('user', 'id'));
    }

    /**
     * panel user
     * 
     * modifica el perfil de uuarios de tipo admin
     */
    public function updateProfile($id=null, Request $request){
        $user =  Auth::user();
        if ($id){
            $user = User::find($id);
        }

        $imageName = $user->admin->foto;
        $image = $request->file('foto');
        if ($image){
            $imageExist = 'uploads/'.$user->admin->foto;
            if ( $user->admin->foto && file_exists($imageExist) ){
                unlink($imageExist);
            }
            $imageName = 'user_'.$user->id.date('ymdHis').'.'.$image->getClientOriginalExtension();
            $image->move('uploads', $imageName);
        }

        
        $user->email = $request->email;
        $user->admin->nombre_completo = $request->nombre_completo;
        $user->admin->foto = $imageName;
        $user->admin->save();
        $user->save();

        return view('user/profile', compact('user', 'id'));
    }

    /**
     * Admin list
     * 
     * Obtiene la lista de usuarios de tipo admin.
     * filter = {
     *      "nombre_completo":"",
     *      "email":""
     * }
     * 
     * @urlParam filter Object
     * 
     * @response {
     *     "current_page": 1,
     *     "data": [
     *         {
     *             "id": 2,
     *             "email": "admin@admin.com",
     *             "nombre_completo": "admin",
     *             "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_2200608000357.jpg",
     *             "matricula": null,
     *             "admin": {
     *                 "id": 1,
     *                 "nombre_completo": "admin",
     *                 "foto": "user_2200608000357.jpg",
     *                 "created_at": "2020-06-05T18:46:17.000000Z",
     *                 "updated_at": "2020-06-08T00:03:57.000000Z",
     *                 "deleted_at": null
     *             },
     *             "medico": null
     *         },
     *         {
     *             "id": 5,
     *             "email": "gato@gmail.com",
     *             "nombre_completo": "gato con botas",
     *             "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_5200608223855.jpg",
     *             "matricula": null,
     *             "admin": {
     *                 "id": 2,
     *                 "nombre_completo": "gato con botas",
     *                 "foto": "user_5200608223855.jpg",
     *                 "created_at": "2020-06-08T00:05:34.000000Z",
     *                 "updated_at": "2020-06-08T22:38:55.000000Z",
     *                 "deleted_at": null
     *             },
     *             "medico": null
     *         },
     *         {
     *             "id": 6,
     *             "email": "melania@gmail.com",
     *             "nombre_completo": "melani tromp de lavaldes",
     *             "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_6200608001120.jpg",
     *             "matricula": null,
     *             "admin": {
     *                 "id": 3,
     *                 "nombre_completo": "melani tromp de lavaldes",
     *                 "foto": "user_6200608001120.jpg",
     *                 "created_at": "2020-06-08T00:11:20.000000Z",
     *                 "updated_at": "2020-06-08T00:11:20.000000Z",
     *                 "deleted_at": null
     *             },
     *             "medico": null
     *         },
     *         {
     *             "id": 7,
     *             "email": "drama@gmail.com",
     *             "nombre_completo": "drama",
     *             "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_7200608002049.jpg",
     *             "matricula": null,
     *             "admin": {
     *                 "id": 4,
     *                 "nombre_completo": "drama",
     *                 "foto": "user_7200608002049.jpg",
     *                 "created_at": "2020-06-08T00:13:36.000000Z",
     *                 "updated_at": "2020-06-08T00:20:49.000000Z",
     *                 "deleted_at": null
     *             },
     *             "medico": null
     *         },
     *         {
     *             "id": 8,
     *             "email": "sandra@gmail.com",
     *             "nombre_completo": "sandra mamani garcia",
     *             "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_8200608002035.jpg",
     *             "matricula": null,
     *             "admin": {
     *                 "id": 5,
     *                 "nombre_completo": "sandra mamani garcia",
     *                 "foto": "user_8200608002035.jpg",
     *                 "created_at": "2020-06-08T00:15:20.000000Z",
     *                 "updated_at": "2020-06-08T00:20:35.000000Z",
     *                 "deleted_at": null
     *             },
     *             "medico": null
     *         }
     *     ],
     *     "first_page_url": "http:\/\/pacientemedico.ds:998\/api\/admin\/list?page=1",
     *     "from": 1,
     *     "last_page": 2,
     *     "last_page_url": "http:\/\/pacientemedico.ds:998\/api\/admin\/list?page=2",
     *     "next_page_url": "http:\/\/pacientemedico.ds:998\/api\/admin\/list?page=2",
     *     "path": "http:\/\/pacientemedico.ds:998\/api\/admin\/list",
     *     "per_page": "5",
     *     "prev_page_url": null,
     *     "to": 5,
     *     "total": 9
     * }
     */
    public function apiList( Request $request){
        if ($request->has('filter') && $request->filter != 'null' && $request->filter != null){
            $filter = json_decode($request->filter, true);
            $page = $request->page;
            if($filter['nombre_completo'] != "" || $filter['email'] != ""){
                $page = 1;
            }
            $usuarios = User::where('type', User::TYPE_ADMIN)
                ->where('admins.nombre_completo', 'like', $filter['nombre_completo'].'%')
                ->where('users.email', 'like', '%'.$filter['email'].'%')
                ->select('users.id', 'users.email', 'admins.nombre_completo', 'admins.foto')
                ->join('admins', 'users.id', '=', 'admins.user_id')
                ->orderBy('id', 'desc')
                ->paginate($request->per_page?:5, ['*'], 'page', $page);
        }else{
            $usuarios = User::where([
                'type'=>User::TYPE_ADMIN,
            ])
            ->select('users.id', 'users.email', 'admins.nombre_completo', 'admins.foto')
            ->join('admins', 'users.id', '=', 'admins.user_id')
            ->orderBy('id', 'desc')
            ->paginate($request->per_page?:5);
        }
        return $usuarios;
    }
    
    /**
     * Mostrar uusario
     * 
     * Mostrar usuario de tipo admin
     * 
     * @urlParam id required id de usuario.
     * 
     * @response {
     *         "id": 2,
     *         "nombre_completo": "admin",
     *         "email": "admin@admin.com",
     *         "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_2200608000357.jpg"
     *     }
     */
    public function apiShow($id){
        $user = User::find($id);
        if ( !$user ){
            return response()->json([
                'message' => 'El usuario no se encuentra.', 
            ], 404);
        }
        return response()->json($this->getUser($user), 200);
    }
    
    /**
     * Modificar uusario
     * 
     * Modificar usuario de tipo admin
     * 
     * @urlParam id required id de usuario.
     * 
     * @bodyParam {
     *        "nombre_completo": "admin",
     *        "email": "admin@admin.com",
     *        "foto": "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEASABIAAD"
     *    }
     * 
     * @response {
     *         "id": 2,
     *         "nombre_completo": "admin",
     *         "email": "admin@admin.com",
     *         "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_2200608000357.jpg"
     *     }
     */
    public function apiUpdate($id, Request $request){
        DB::beginTransaction();
        try {
            $user = User::find($id);
            if ( !$user ){
                http_response_code(404);
                throw new \Exception('El usuario no se encuentra.');
            }

            $validator = Validator::make($request->all(), [
                'email' => ['required', 'string', 'email', 'max:255'],
                // 'foto' => ['required'],
            ]);
            if ( $validator->fails() ){
                http_response_code(422);
                throw new \Exception($validator->errors()->all());
            }

            $auxEmail = $user->email;
            if ( $auxEmail != $request->email ){
                $validator = Validator::make($request->all(), [
                    'email' => ['unique:users'],
                ]);
                if ( $validator->fails() ){
                    http_response_code(422);
                    throw new \Exception($validator->errors()->all());
                }
            }

            $imageName = $user->admin->foto;
            if ($request->has('foto') && $request->foto !== null){
                $imageExist = 'uploads/'.$user->admin->foto;
                if ( $user->admin->foto && file_exists($imageExist) ){
                    unlink($imageExist);
                }
                $image = $request->foto;
                $imageName = 'user_'.$user->id.date('ymdHis').'.jpg';
                $path = public_path().'/uploads/' . $imageName;
                Image::make(file_get_contents($image))->save($path);   
            }
            
            $user->admin->nombre_completo = $request->nombre_completo;
            $user->admin->foto = $imageName;
            $user->admin->save();
            $user->email = $request->email;
            $user->save();

            DB::commit();

            return response()->json($this->getUser($user), 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => $th->getMessage(), 
            ], http_response_code());
        }
        
    }
    
    /**
     * Modificar email
     * 
     * Modificar el mail del usuario de tipo admin
     * 
     * @urlParam id required id de usuario.
     * 
     * @bodyParam {
     *        "email": "admin@admin.com",
     *    }
     * 
     * @response {
     *         "id": 2,
     *         "nombre_completo": "admin",
     *         "email": "admin@admin.com",
     *         "foto": "http:\/\/pacientemedico.ds:998\/uploads\/user_2200608000357.jpg"
     *     }
     */
    public function apiUpdateEmail($id, Request $request){
        $user = User::find($id);
        if ( !$user ){
            return response()->json([
                'message' => 'El usuario no se encuentra.', 
            ], 404);
        }
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        if ( $validator->fails() ){
            return response()->json([
                'message' => 'Datos no validos', 
                'errors' => $validator->errors()
            ], 422);
        }
        $auxEmail = $user->email;
        if ( $auxEmail == $request->email ){
            return response()->json([
                'message' => 'El email debe ser nuevo', 
            ], 422);
        }
        $validator = Validator::make($request->all(), [
            'email' => ['unique:users'],
        ]);
        if ( $validator->fails() ){
            return response()->json([
                'message' => 'Datos no validos', 
                'errors' => $validator->errors()
            ], 422);
        }
        
        $user->email = $request->email;
        $user->save();

        return response()->json($this->getUser($user), 200);
    }
    
    /**
     * Modificar email
     * 
     * Modificar el mail del usuario de tipo admin
     * 
     * @urlParam id required id de usuario.
     * 
     * @bodyParam {
     *        "password": "123123123",
     *        "password_nuevo": "456456456",
     *        "password_nuevo_confirmation": "456456456",
     *    }
     * 
     * @response 'Password modificado correctamente'
     */
    public function updatePassword($id, Request $request){
        $user = User::find($id);
        if ( !$user ){
            return response()->json([
                'message' => 'El usuario no se encuentra.', 
            ], 404);
        }
            
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'password_nuevo' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ( $validator->fails() ){
            return response()->json([
                'message' => 'Password no valido', 
                'errors' => $validator->errors()
            ], 422);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Password actual incorrecto', 
            ], 404);
        }
        
        $user->password = Hash::make($request->password_nuevo);
        $user->save();

        return response()->json('Password modificado correctamente', 200);
    }

    /**
     * Delete usuario
     * 
     * Eliminar usuario de tipo admin, paciente o medico
     * 
     * @urlParam id required id de usuario.
     * 
     * @response "Se elimino correctamente"
     */
    public function delete($id, Request $request){
        $user = User::find($id);
        if ( !$user ){
            return response()->json([
                'message' => 'El usuario no se encuentra.', 
            ], 404);
        }
        $user->delete();
        return response()->json([
            'message'=>'Se elimino correctamente',
            'id'=>$id
        ], 200);
    }
    
    /**
     * Restaurar usuario
     * 
     * Restaurar usuario de tipo admin, paciente o medico
     * 
     * @urlParam id required id de usuario.
     * 
     * @response "Se elimino correctamente"
     */
    public function restore($id, Request $request){
        $user = User::withTrashed()->find($id);
        if ( !$user ){
            return response()->json([
                'message' => 'El usuario no se encuentra.', 
            ], 404);
        }
        $user->restore();
        return response()->json([
            'message'=>'Se restauro correctamente',
            'id'=>$id
        ], 200);
    }

    /**
     * Olvide password (public)
     * 
     * Olvide password de usuario de tipo admin, 
     * envia un email con un link para recuperar la contrasena.
     * 
     * @bodyParam email email required
     * 
     * @response {
     *      "message":"Revise su bandeja de entrada de su correo electronico"
     * }
     */
    public function forgotPassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => "required|email",
            ]);
            if ( $validator->fails() ){
                http_response_code(400);
                throw new \Exception($validator->errors()->first());
            }

            $response = Password::sendResetLink($request->only('email'), function (Message $message) {
                $message->subject('Recuperar password');
            });
            $message = "";
            switch ($response) {
                case Password::RESET_LINK_SENT:
                    $message = trans($response);
                    // $message = 'Revise su bandeja de entrada de su correo electronico';
                    // return \Response::json(array("status" => 200, "message" => trans($response), "data" => array()));
                case Password::INVALID_USER:
                    http_response_code(400);
                    throw new \Exception(trans($response));
                    // return \Response::json(array("status" => 400, "message" => trans($response), "data" => array()));
            }

            return response()->json([
                'message'=>$message,
            ], 200);
        } catch (\Swift_TransportException $ex) {
            // $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            return response()->json([
                'message' => $ex->getMessage(),
            ], 400);
        } catch (\Throwable $th) {
            return $this->formatError($th);
        }
    }

    /**
     * Olvide password Code (public)
     * 
     * Olvide password de usuario de paciente o medico,
     * envia un codigo al email para confirmar y cambiar el password posteriormente.
     * 
     * @bodyParam email email required
     * 
     * @response {
     *      "message":"Codigo enviado su email"
     * }
     */
    public function sendCodeToEmail(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'email' => "required|email",
            ]);
            if ( $validator->fails() ){
                http_response_code(400);
                throw new \Exception($validator->errors()->first());
            }

            $user = User::where('email', $request->email)->first();
            if ( !$user ){
                http_response_code(404);
                throw new \Exception('Email no pertenece a ningun usuario');
            }
            $codGenerated = mt_rand(10000,99999); 
            
            $lastCode = $user->codigos->first();
            if ($lastCode){
                $codGenerated .= $lastCode->id+1;
            }else{
                $codGenerated .= 1;
            }

            $codigo = Codigo::create([
                'user_id' => $user->id,
                'codigo' => $codGenerated,
            ]);

            Mail::to($user->email)->send(new MailCodigo($codigo->codigo));

            return response()->json([
                'message'=>'Codigo enviado a su email',
            ], 200);

        } catch (\Swift_TransportException $ex) {
            return response()->json([
                'message' => $ex->getMessage(),
            ], 400);
        } catch (\Throwable $th) {
            return $this->formatError($th);
        }
    }

    /**
     * Validate Code (public)
     * 
     * Valida el codigo recibido por email.
     * 
     * @bodyParam email email required
     * @bodyParam codigo integer required
     * 
     * @response {
     *      "user"{
     *          "id":1,
     *          "email":"admin@admin.com",
     *          "type":2,
     *      },
     *      "accessToken":"fhdks hfkjdhsjk fhjdkshfjkds",
     * }
     */
    public function validateCode(Request $request){
        try {
            
            $validator = Validator::make($request->all(), [
                'email' => "required|email",
                'codigo' => "required",
            ]);
            
            if ( $validator->fails() ){
                http_response_code(422);
                throw new \Exception($validator->errors()->first());
            }
            
            $user = User::where('email', $request->email)->first();
            if ( !$user ){
                http_response_code(404);
                throw new \Exception('Email no pertenece a ningun usuario');
            }
            
            $lastCode = $user->codigos->sortKeysDesc()->values()->first();
            if ( $request->codigo != $lastCode->codigo ){
                http_response_code(400);
                throw new \Exception('Codigo incorrecto');
            }
            $lastCode->valid = false;
            $lastCode->save();
            $accessToken = $user->createToken('authToken')->accessToken;

            return response()->json([
                'user'=>[
                    'id'=>$user->id,
                    'email'=>$user->email,
                    'type'=>$user->type,
                ],
                'accessToken'=>$accessToken,
            ], 200);

        } catch (\Throwable $th) {
            return $this->formatError($th);
        }
    }

    /**
     * cambiar password
     * 
     * Cambiar password con el codigo validado par usuarios de tipo paciente o medico.
     * 
     * @urlParam id required id del usuario
     * @bodyParam password_nuevo string required 
     * @bodyParam password_nuevo_confirmation string required 
     * 
     * @response "Password modificado correctamente"
     */
    public function changePassword(Request $request, $id){
        $user = User::find($id);
        if ( !$user ){
            return response()->json([
                'message' => 'El usuario no se encuentra.', 
            ], 404);
        }
            
        $validator = Validator::make($request->all(), [
            'password_nuevo' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ( $validator->fails() ){
            return response()->json([
                'message' => $validator->errors()->first(), 
            ], 422);
        }

        $user->password = Hash::make($request->password_nuevo);
        $user->save();

        return response()->json('Password modificado correctamente', 200);
    }


    public function updatePlayerId(Request $request){
        $user =  Auth::user();
        $user->admin->player_id = $request->player_id;
        $user->admin->save();
        return 'player id actualizado';
    }
}
