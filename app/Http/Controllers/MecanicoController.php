<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mecanico;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MecanicoController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {   
    }

    private function getModel($id){
        $model = Mecanico::find($id);
        if ( !$model ){
            http_response_code(404);
            throw new \Exception('El registro no existe');
        }
        return $model;
    }

    private function format($model, $accessToken = null){
        return [
            'id'=>$model->id,
            'nombre_completo'=>$model->nombre_completo,
            'telefono'=>$model->telefono,
            'direccion'=>$model->direccion,
            'ci'=>$model->ci,
            'email'=>$model->email,
            'especialidad'=>$model->especialidad,
            'fecha_ingreso'=>$model->fecha_ingreso,
            'fecha_salida'=>$model->fecha_salida,
            'foto'=>$model->foto,
            'accessToken'=>$accessToken,
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
     * create
     * 
     * registra un mecanico
     * 
     * @bodyParam paciente_id integer required Example: 2
     * @bodyParam fecha date required Example: "2020-05-23"
     * @bodyParam hora time required Example: "12:00"
     * @bodyParam respuesta string Example: null
     * 
     * @response {
     *     "id":12,
     *     "medico_id":1,
     *     "medico": {
     *         "id": 1,
     *         "nombre_completo": "katara caballero otsank",
     *         "direccion": "avensaida los angeles de charly",
     *         "ciudad": "parags222asuay",
     *         "celular": "4344436",
     *         "src_foto": "medico_1200610162742.jpg",
     *         "src_matricula": "medico_matricula_1200607141802.jpg",
     *         "player_id": "123123123",
     *         "user_id": 1,
     *         "created_at": "2020-06-04T21:21:16.000000Z",
     *         "updated_at": "2020-06-10T16:27:43.000000Z",
     *         "deleted_at": null,
     *         "foto": "http://pacientemedico.ds:998/uploads/medico_1200610162742.jpg",
     *         "matricula": "http://pacientemedico.ds:998/uploads/medico_matricula_1200607141802.jpg"
     *     },
     *     "paciente_id": 1,
     *     "paciente": {
     *         "id": 1,
     *         "nombre_completo": "Maria lorena chavez arce",
     *         "direccion": "avenida los angeles numero 23",
     *         "ciudad": "cochabamba",
     *         "celular": "789898988",
     *         "src_foto": "user_3200608171905.jpg",
     *         "player_id": "123123123",
     *         "user_id": 3,
     *         "created_at": "2020-06-05T21:08:09.000000Z",
     *         "updated_at": "2020-06-08T17:19:05.000000Z",
     *         "deleted_at": null,
     *         "foto": "http://pacientemedico.ds:998/uploads/user_3200608171905.jpg"
     *     },
     *     "fecha":"2020-06-05",
     *     "hora":"06:00",
     *     "aprovada":true,
     *     "pendiente":true,
     *     "mensaje":null
     * }
     */
    public function store(Request $request){
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'nombre_completo' => ['required'],
                'ci' => ['required'],
                'telefono' => ['required'],
                'email' => ['required'],
                'password' => ['required'],
            ]);
            
            if ( $validator->fails() ){
                http_response_code(422);
                throw new \Exception($validator->errors()->first());
            }

            $user = User::create([
                'type' => User::TYPE_MECANICO,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // return $user;

            $imageName = null;
            $model = Mecanico::create([
                'nombre_completo' => $request->nombre_completo,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'ci' => $request->ci,
                'email' => $request->email,
                'especialidad' => $request->especialidad,
                'fecha_ingreso' => $request->fecha_ingreso,
                'fecha_salida' => $request->fecha_salida,
                'src_foto' => $imageName,
                'user_id' => $user->id,
            ]);

            if ($request->has('foto') && $request->foto !== null){
                $image = $request->foto;
                $imageName = 'mecanico_'.$model->id.date('ymdHis').'.jpg';
                $path = public_path().'/uploads/' . $imageName;
                Image::make(file_get_contents($image))->save($path);   
            }
            $model->src_foto = $imageName;
            $model->save();

            // DB::commit();
            // return response()->json($this->format($model), 201);
            $accessToken = $user->createToken('authToken')->accessToken;
            DB::commit();

            return response()->json($this->format($user, $accessToken), 201);

        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->formatError($th);
        }        
    }
    
    public function update($id, Request $request){
        DB::beginTransaction();
        try {
            $model = $this->getModel($id);

            $validator = Validator::make($request->all(), [
                'nombre_completo' => ['required'],
                'ci' => ['required'],
                'telefono' => ['required'],
            ]);
            
            if ( $validator->fails() ){
                http_response_code(422);
                throw new \Exception($validator->errors()->first());
            }

            $imageName = $model->foto;
            if ($request->has('foto') && $request->foto !== null){
                $imageExist = 'uploads/'.$model->foto;
                if ( $model->foto && file_exists($imageExist) ){
                    unlink($imageExist);
                }
                $image = $request->foto;
                $imageName = 'mecanico_'.$model->id.date('ymdHis').'.jpg';
                $path = public_path().'/uploads/' . $imageName;
                Image::make(file_get_contents($image))->save($path);   
            }

            $model->nombre_completo = $request->nombre_completo;
            $model->telefono = $request->telefono;
            $model->direccion = $request->direccion;
            $model->ci = $request->ci;
            $model->email = $request->email;
            $model->especialidad = $request->especialidad;
            $model->fecha_ingreso = $request->fecha_ingreso;
            $model->fecha_salida = $request->fecha_salida;
            $model->src_foto = $imageName;
            $model->save();

            DB::commit();

            return response()->json($this->format($model), 200);

        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->formatError($th);
        }        
    }

    public function show($id){
        try {
            $model = $this->getModel($id);
            return response()->json($this->format($model), 200);
        } catch (\Throwable $th) {
            return $this->formatError($th);
        } 
    }

    public function delete(Request $request, $id){
        DB::beginTransaction();
        try {
            $model = $this->getModel($id);
            $model->delete();
            DB::commit();
            return response()->json([
                'message'=>'Eliminado correctamente',
                'id'=>$id
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->formatError($th);
        }
    }

    public function restore(Request $request, $id){
        DB::beginTransaction();
        try {
            $model = $this->getModel($id);
            $model->restore();
            DB::commit();
            return response()->json([
                'message'=>'Restaurado correctamente',
                'id'=>$id
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->formatError($th);
        }
    }

    public function index(Request $request){
            if ($request->has('filter') && $request->filter != 'null' && $request->filter != null){
            $filter = json_decode($request->filter, true);
            $page = $request->page;
            if($filter['nombre_completo'] != "" || $filter['ci'] != ""){
                $page = 1;
            }
            $rows = Mecanico::where('nombre_completo', 'like', '%'.$filter['nombre_completo'].'%')
                ->where('ci', 'like', '%'.$filter['ci'].'%')
                ->orderBy('id', 'desc')
                ->paginate($request->per_page?:5, ['*'], 'page', $page);
        }else{
            $rows = Mecanico::orderBy('id', 'desc')->paginate($request->per_page?:5);
        }
        return $rows;
    }
}
