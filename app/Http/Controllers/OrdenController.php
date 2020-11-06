<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orden;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OrdenController extends Controller
{
    private function getModel($id){
        $model = Orden::find($id);
        if ( !$model ){
            http_response_code(404);
            throw new \Exception('El registro no existe');
        }
        return $model;
    }

    private function format($model){
        return [
            'id'=>$model->id,
            'propietario'=>$model->propietario,
            'telefono'=>$model->telefono,
            'fecha'=>$model->fecha,
            'vehiculo'=>$model->vehiculo,
            'placa'=>$model->placa,
            'modelo'=>$model->modelo,
            'color'=>$model->color,
            'ano'=>$model->ano,
            'tanque'=>$model->tanque,
            'solicitud'=>$model->solicitud,
            'tapa_ruedas'=>$model->tapa_ruedas,
            'llanta_auxilio'=>$model->llanta_auxilio,
            'gata_hidraulica'=>$model->gata_hidraulica,
            'llave_cruz'=>$model->llave_cruz,
            'pisos'=>$model->pisos,
            'limpia_parabrisas'=>$model->limpia_parabrisas,
            'tapa_tanque'=>$model->tapa_tanque,
            'herramientas'=>$model->herramientas,
            'mangueras'=>$model->mangueras,
            'espejos'=>$model->espejos,
            'tapa_cubos'=>$model->tapa_cubos,
            'antena'=>$model->antena,
            'radio'=>$model->radio,
            'focos'=>$model->focos,
            'otros'=>$model->otros,
            'responsable'=>$model->responsable,
            'fecha_ingreso'=>$model->fecha_ingreso,
            'fecha_salida'=>$model->fecha_salida,
            'km_actual'=>$model->km_actual,
            'proximo_cambio'=>$model->proximo_cambio,
            'pago'=>$model->pago,
            'detalle_pago'=>$model->detalle_pago,
            'estado'=>$model->estado,
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
     */
    public function store(Request $request){
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'propietario' => ['required'],
                'vehiculo' => ['required'],
                'placa' => ['required'],
            ]);
            
            if ( $validator->fails() ){
                http_response_code(422);
                throw new \Exception($validator->errors()->first());
            }

            $imageName = null;
            $model = Orden::create([
                'propietario'=>$request->propietario,
                'telefono'=>$request->telefono,
                'fecha'=>$request->fecha,
                'vehiculo'=>$request->vehiculo,
                'placa'=>$request->placa,
                'modelo'=>$request->modelo,
                'color'=>$request->color,
                'ano'=>$request->ano,
                'tanque'=>$request->tanque,
                'solicitud'=>$request->solicitud,
                'tapa_ruedas'=>$request->tapa_ruedas,
                'llanta_auxilio'=>$request->llanta_auxilio,
                'gata_hidraulica'=>$request->gata_hidraulica,
                'llave_cruz'=>$request->llave_cruz,
                'pisos'=>$request->pisos,
                'limpia_parabrisas'=>$request->limpia_parabrisas,
                'tapa_tanque'=>$request->tapa_tanque,
                'herramientas'=>$request->herramientas,
                'mangueras'=>$request->mangueras,
                'espejos'=>$request->espejos,
                'tapa_cubos'=>$request->tapa_cubos,
                'antena'=>$request->antena,
                'radio'=>$request->radio,
                'focos'=>$request->focos,
                'otros'=>$request->otros,
                'responsable'=>$request->responsable,
                'fecha_ingreso'=>$request->fecha_ingreso,
                'fecha_salida'=>$request->fecha_salida,
                'km_actual'=>null,
                'proximo_cambio'=>null,
                'pago'=>null,
                'detalle_pago'=>null,
                'estado'=>0,
            ]);

            DB::commit();

            return response()->json($this->format($model), 201);

        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->formatError($th);
        }        
    }
    
    // public function update(Request $request){
    //     DB::beginTransaction();
    //     try {
    //         $model = $this->getModel($id);

    //         $validator = Validator::make($request->all(), [
    //             'nombre_completo' => ['required'],
    //             'ci' => ['required'],
    //             'telefono' => ['required'],
    //         ]);
            
    //         if ( $validator->fails() ){
    //             http_response_code(422);
    //             throw new \Exception($validator->errors()->first());
    //         }

    //         if ($image){
    //             $imageExist = 'uploads/'.$model->foto;
    //             if ( $model->foto && file_exists($imageExist) ){
    //                 unlink($imageExist);
    //             }
    //             $imageName = 'user_'.$model->id.date('ymdHis').'.'.$image->getClientOriginalExtension();
    //             $image->move('uploads', $imageName);
    //         }

    //         $model->nombre_completo = $request->nombre_completo;
    //         $model->telefono = $request->telefono;
    //         $model->direccion = $request->direccion;
    //         $model->ci = $request->ci;
    //         $model->email = $request->email;
    //         $model->especialidad = $request->especialidad;
    //         $model->fecha_ingreso = $request->fecha_ingreso;
    //         $model->fecha_salida = $request->fecha_salida;
    //         $model->src_foto = $imageName;

    //         DB::commit();

    //         return response()->json($this->format($model), 200);

    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         return $this->formatError($th);
    //     }        
    // }

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
            if($filter['propietario'] != "" || $filter['placa'] != ""){
                $page = 1;
            }
            $rows = Orden::where('propietario', 'like', '%'.$filter['propietario'].'%')
                ->where('placa', 'like', '%'.$filter['placa'].'%')
                ->orderBy('id', 'desc')
                ->paginate($request->per_page?:5, ['*'], 'page', $page);
        }else{
            $rows = Orden::orderBy('id', 'desc')->paginate($request->per_page?:5);
        }
        return $rows;
    }
}