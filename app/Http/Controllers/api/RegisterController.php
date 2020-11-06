<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\Paciente;
use App\Admin;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @group  Admin
 *
 * APIs for managing users
 */
class RegisterController extends Controller
{
    /**
	 * Nuevo usuario (public)
	 *
	 * Registra un usuario de tipo admin.
	 *
     * @bodyParam nombre_completo string required para el admin. Example: waldo
     * @bodyParam email email required para el user.Example: waldo@waldo.com
     * @bodyParam password string required para el password minimo 8 caracteres.Example: waldo123123
     * @bodyParam password_confirmation string required para el password minimo 8 caracteres.Example: waldo123123
     * @bodyParam foto string string base 64 Example: null
     * 
     * @response 201 {
     *     "email": "waldo@waldo.com",
     *     "foto": null,
     *     "id": 18,
     *     "nombre_completo": "waldo"
     * }
	 */
    public function admin(Request $request){
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'nombre_completo' => ['required', 'string', 'max:50'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            if ( $validator->fails() ){
                throw new \Exception($validator->errors()->first());
            }

            $user = User::create([
                'type' => User::TYPE_ADMIN,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $imageName = null;
            if ($request->has('foto') && $request->foto !== null){
                $image = $request->foto;
                $imageName = 'user_'.$user->id.date('ymdHis').'.jpg';
                $path = public_path().'/uploads/' . $imageName;
                Image::make(file_get_contents($image))->save($path);   
            }

            $admin = Admin::create([
                'nombre_completo' => Str::lower($request->nombre_completo),
                'user_id' => $user->id,
                'foto' => $imageName,
            ]);
            
            DB::commit();
            
            return response()->json([
                'id'=>$user->id,
                'nombre_completo'=>$user->admin->nombre_completo,
                'email'=>$user->email,
                'foto'=>$user->foto,
            ], 201);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => $th->getMessage(), 
            ], 403);
        }
    }
}
