<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mecanico;
use App\Orden;
use App\SolicitudTrabajo;
use App\DetalleRepuesto;
use App\DetalleManoObra;
use App\EstadoVehiculo;
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

            'estado_vehiculo_otros'=>$model->estado_vehiculo_otros,
            'estadoVehiculo'=>$model->estadoVehiculo,
            'responsable'=>$model->responsable,
            'mecanico_id'=>$model->mecanico_id,
            'mecanico'=>$model->mecanico,

            'fecha_salida'=>$model->fecha_salida,
            'km_actual'=>$model->km_actual,
            'proximo_cambio'=>$model->proximo_cambio,
            'pago'=>$model->pago == 1?'efectivo': 'cheque',
            'detalle_pago'=>$model->detalle_pago,
            'estado'=>$model->estado,
            'repuestos'=>$model->repuestos,
            'totalRepuesto'=>$model->getTotalRepuestos(),
            'manosobra'=>$model->detalleManoObra,
            'totalManoObra'=>$model->getTotalManoObra(),
            'foto'=>$model->foto,
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
                'telefono' => ['required'],
                'vehiculo' => ['required'],
                'placa' => ['required'],
                'modelo' => ['required'],
                'color' => ['required'],
                'solicitud' => ['required'],
            ]);
            
            if ( $validator->fails() ){
                http_response_code(422);
                throw new \Exception($validator->errors()->first());
            }

            $imageName = null;
            $model = Orden::create([
                'propietario'=>$request->propietario,
                'telefono'=>$request->telefono,
                'vehiculo'=>$request->vehiculo,
                'placa'=>$request->placa,
                'modelo'=>$request->modelo,
                'color'=>$request->color,
                'ano'=>$request->ano,
                'fecha'=>Carbon::now()->format('Y-m-d'),
                'tanque'=>$request->tanque,
                'solicitud'=>$request->solicitud,
                'estado_vehiculo_otros'=>$request->estado_vehiculo_otros,
                'estado'=>0,
                'src_foto' => $imageName,
            ]);

            if ($request->has('foto') && $request->foto !== null){
                $image = $request->foto;
                $imageName = 'orden_'.$model->id.date('ymdHis').'.jpg';
                $path = public_path().'/uploads/' . $imageName;
                Image::make(file_get_contents($image))->save($path);   
            }
            $model->src_foto = $imageName;
            $model->save();

            $arEstadoVehiculo = $request->estado_vehiculo;
            foreach ($arEstadoVehiculo as $key => $element) {
                $mdEstadoVehiculo = EstadoVehiculo::create([
                    'orden_id'=>$model->id,
                    'accesorio_id'=>$element['id'],
                    'fecha'=>Carbon::now()->format('Y-m-d'),
                ]);
            }

            DB::commit();

            return response()->json($this->format($model), 201);

        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->formatError($th);
        }        
    }

    
    function createDetalleManoObra(Request $request){
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'orden_id' => ['required'],
                'descripcion' => ['required'],
            ]);
            
            if ( $validator->fails() ){
                http_response_code(422);
                throw new \Exception($validator->errors()->first());
            }

            $model = Orden::find($request->orden_id);
            if(!$model){
                throw new \Exception('no existe el repuesto');
            }
            DetalleManoObra::create([
                'orden_id'=>$model->id,
                'descripcion'=>$request->descripcion,
                'precio'=>$request->precio?$request->precio:null,
                'fecha'=>Carbon::now()->format('Y-m-d'),
            ]);


            DB::commit();

            return response()->json($model, 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->formatError($th);
        }        
    }

    function editDetalleManoObra($id, Request $request){
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'orden_id' => ['required'],
                'descripcion' => ['required'],
            ]);
            
            if ( $validator->fails() ){
                http_response_code(422);
                throw new \Exception($validator->errors()->first());
            }

            $model = DetalleManoObra::find($id);
            if(!$model){
                throw new \Exception('no existe el repuesto');
            }
            $model->descripcion = $request->descripcion;
            $model->precio = $request->precio;
            $model->fecha = Carbon::now()->format('Y-m-d');
            $model->save();
            
            DB::commit();

            return response()->json($model, 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->formatError($th);
        }        
    }


    function editDetalleRepuesto($id, Request $request){
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'orden_id' => ['required'],
                'repuesto' => ['required'],
            ]);
            
            if ( $validator->fails() ){
                http_response_code(422);
                throw new \Exception($validator->errors()->first());
            }

            $model = DetalleRepuesto::find($id);
            if(!$model){
                throw new \Exception('no existe el repuesto');
            }
            $model->repuesto = $request->repuesto;
            $model->precio = $request->precio;
            $model->fecha = Carbon::now()->format('Y-m-d');
            $model->save();
            
            DB::commit();

            return response()->json($model, 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->formatError($th);
        }        
    }

    function deleteDetalleManoObra($id, Request $request){
        DB::beginTransaction();
        try {
            $model = DetalleManoObra::find($id);
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
    function deleteDetalleRepuesto($id, Request $request){
        DB::beginTransaction();
        try {
            $model = DetalleRepuesto::find($id);
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
    public function restoreDetalleManoObra($id, Request $request){
        DB::beginTransaction();
        try {
            $model = DetalleManoObra::find($id);
            if (!$model){
                throw new \Exception('no existe el detalle '. $id);
            }
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
    public function restoreDetalleRestore($id, Request $request){
        DB::beginTransaction();
        try {
            $model = DetalleRepuesto::find($id);
            if (!$model){
                throw new \Exception('no existe el detalle '. $id);
            }
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









    

    function createDetalleRepuesto(Request $request){
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'orden_id' => ['required'],
                'repuesto' => ['required'],
            ]);
            
            if ( $validator->fails() ){
                http_response_code(422);
                throw new \Exception($validator->errors()->first());
            }

            $model = Orden::find($request->orden_id);
            if(!$model){
                throw new \Exception('no existe el repuesto');
            }

            DetalleRepuesto::create([
                'orden_id'=>$model->id,
                'repuesto'=>$request->repuesto,
                'precio'=>$request->precio?$request->precio:null,
                'fecha'=>Carbon::now()->format('Y-m-d'),
            ]);

            DB::commit();

            return response()->json($model, 201);
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
                'propietario' => ['required'],
                'vehiculo' => ['required'],
                'placa' => ['required'],
                'modelo' => ['required'],
                'color' => ['required'],
                'ano' => ['required'],
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


            $model->propietario = $request->propietario;
            $model->telefono = $request->telefono;
            $model->vehiculo = $request->vehiculo;
            $model->placa = $request->placa;
            $model->modelo = $request->modelo;
            $model->color = $request->color;
            $model->ano = $request->ano;
            $model->fecha = $request->fecha;
            $model->fecha_salida = $request->fecha_salida;
            $model->tanque = $request->tanque;
            $model->solicitud = $request->solicitud;
            $model->estado_vehiculo_otros = $request->estado_vehiculo_otros;
            $model->estado = $request->estado;
            $model->src_foto = $imageName;
            $model->mecanico_id = $request->mecanico_id;
            $model->pago = $request->pago == 'efectivo'?1:2;
            $model->detalle_pago = $request->detalle_pago;
            $model->km_actual = $request->km_actual;
            $model->proximo_cambio = $request->proximo_cambio;
            $model->save();

            foreach ($model->estadoVehiculo as $key => $estadoVeh) {
                $estadoVeh->delete();
            }

            $arEstadoVehiculo = $request->estado_vehiculo;
            foreach ($arEstadoVehiculo as $key => $element) {
                $mdEstadoVehiculo = EstadoVehiculo::create([
                    'orden_id'=>$model->id,
                    'accesorio_id'=>$element['id'],
                    'fecha'=>Carbon::now()->format('Y-m-d'),
                ]);
            }

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
            $page = $request->page ? $request->page : 1;
            if($filter['propietario'] != "" || $filter['placa'] != "" || $filter['modelo'] != "" || $filter['color'] != "" || $filter['estado'] != ""){
                // $page = 1;
            }
            if ( $filter['estado'] == 2 ){
                $rows = Orden::where('propietario', 'like', '%'.$filter['propietario'].'%')
                    ->where('placa', 'like', '%'.$filter['placa'].'%')
                    ->where('modelo', 'like', '%'.$filter['modelo'].'%')
                    ->where('color', 'like', '%'.$filter['color'].'%')
                    ->orderBy('id', 'desc')
                    ->paginate($request->per_page?:5, ['*'], 'page', $page);
            }else{
                $rows = Orden::where('propietario', 'like', '%'.$filter['propietario'].'%')
                    ->where('placa', 'like', '%'.$filter['placa'].'%')
                    ->where('modelo', 'like', '%'.$filter['modelo'].'%')
                    ->where('color', 'like', '%'.$filter['color'].'%')
                    ->where('estado', $filter['estado'])
                    ->orderBy('id', 'desc')
                    ->paginate($request->per_page?:5, ['*'], 'page', $page);
            }
        }else{
            $rows = Orden::orderBy('id', 'desc')->paginate($request->per_page?:5);
        }
        return $rows;
    }
}
