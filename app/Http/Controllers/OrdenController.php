<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Vehiculo;
use App\Mecanico;
use App\Orden;
use App\SolicitudTrabajo;
use App\Repuesto;
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
            // estado del vehiculo
            // 'estadoVehiculo'=>$model->estadoVehiculo,

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

            'estado_vehiculo_otros'=>$model->estado_vehiculo_otros,
            'responsable'=>$model->responsable,
            'mecanico_id'=>$model->responsable,

            'fecha_ingreso'=>$model->fecha_ingreso,
            'fecha_salida'=>$model->fecha_salida,
            'km_actual'=>$model->km_actual,
            'proximo_cambio'=>$model->proximo_cambio,
            'pago'=>$model->pago,
            'detalle_pago'=>$model->detalle_pago,
            'estado'=>$model->estado,
            'repuestos'=>$model->getRepuestos(),
            'manosobra'=>$model->detalleManoObra,
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

            // // registro de cliente
            // $cliente = Cliente::where('nombre_completo', $request->nombre_completo)->first();
            // if (!$cliente){
            //     $cliente = new Cliente;
            //     $cliente->nombre_completo = $request->nombre_completo;
            //     $cliente->telefono1 = $request->telefono1;
            //     $cliente->telefono2 = $request->telefono2;
            //     $cliente->save();
            // }

            // // registro de vehiculo
            // $vehiculo = Vehiculo::where('vehiculo', $request->vehiculo)
            //     ->where('placa', $request->placa)
            //     ->where('modelo', $request->modelo)
            //     ->where('color', $request->color)
            //     ->where('ano', $request->ano)
            //     ->first();
            // if (!$vehiculo){
            //     $vehiculo = new Vehiculo;
            //     $vehiculo->cliente_id = $cliente->id;
            //     $vehiculo->vehiculo = $request->vehiculo;
            //     $vehiculo->placa = $request->placa;
            //     $vehiculo->modelo = $request->modelo;
            //     $vehiculo->color = $request->color;
            //     $vehiculo->ano = $request->ano;
            //     $vehiculo->save();
            // }

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
                'fecha_ingreso'=>Carbon::now()->format('Y-m-d'),
                'hora_ingreso'=>Carbon::now()->format('H:i:s'),
                'estado'=>0,
                // 'tapa_ruedas'=> $request->tapa_ruedas,
                // 'llanta_auxilio'=> $request->llanta_auxilio,
                // 'gata_hidraulica'=> $request->gata_hidraulica,
                // 'llave_cruz'=> $request->llave_cruz,
                // 'pisos'=> $request->pisos,
                // 'limpia_parabrisas'=> $request->limpia_parabrisas,
                // 'tapa_tanque'=> $request->tapa_tanque,
                // 'herramientas'=> $request->herramientas,
                // 'mangueras'=> $request->mangueras,
                // 'espejos'=> $request->espejos,
                // 'tapa_cubos'=> $request->tapa_cubos,
                // 'antena'=> $request->antena,
                // 'radio'=> $request->radio,
                // 'focos'=> $request->focos,
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

    function createDetalleRepuesto(Request $request){
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'solicitud_trabajo_id' => ['required'],
                'detalle' => ['required'],
            ]);
            
            if ( $validator->fails() ){
                http_response_code(422);
                throw new \Exception($validator->errors()->first());
            }

            $model = Orden::find($request->solicitud_trabajo_id);
            if(!$model){
                throw new \Exception('no existe el repuesto');
            }

            $detalle = $request->detalle;
            foreach ($detalle as $key => $det) {
                $repuesto = Repuesto::find($det['repuesto_id']);
                if(!$repuesto){
                    throw new \Exception('no existe el repuesto');
                }

                $mdDetalleRepuesto = DetalleRepuesto::create([
                    'orden_id'=>$model->id,
                    'repuesto_id'=>$repuesto->id,
                    'precio'=>$repuesto->precio,
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
                'solicitud_trabajo_id' => ['required'],
                'detalle' => ['required'],
            ]);
            
            if ( $validator->fails() ){
                http_response_code(422);
                throw new \Exception($validator->errors()->first());
            }

            $model = Orden::find($request->solicitud_trabajo_id);
            if(!$model){
                throw new \Exception('no existe el repuesto');
            }

            $detalle = $request->detalle;
            foreach ($detalle as $key => $det) {
                $mdDetalleRepuesto = DetalleManoObra::create([
                    'orden_id'=>$model->id,
                    'descripcion'=>$det['descripcion'],
                    'precio'=>$det['precio'],
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
            $model->tanque = $request->tanque;
            $model->solicitud = $request->solicitud;
            $model->estado_vehiculo_otros = $request->estado_vehiculo_otros;
            $model->fecha_ingreso = $request->fecha_ingreso;
            $model->hora_ingreso = $request->hora_ingreso;
            $model->estado = $request->estado;
            $model->tapa_ruedas = $request->tapa_ruedas;
            $model->llanta_auxilio = $request->llanta_auxilio;
            $model->gata_hidraulica = $request->gata_hidraulica;
            $model->llave_cruz = $request->llave_cruz;
            $model->pisos = $request->pisos;
            $model->limpia_parabrisas = $request->limpia_parabrisas;
            $model->tapa_tanque = $request->tapa_tanque;
            $model->herramientas = $request->herramientas;
            $model->mangueras = $request->mangueras;
            $model->espejos = $request->espejos;
            $model->tapa_cubos = $request->tapa_cubos;
            $model->antena = $request->antena;
            $model->radio = $request->radio;
            $model->focos = $request->focos;
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
            if($filter['propietario'] != "" || $filter['placa'] != "" || $filter['modelo'] != "" || $filter['color'] != "" || $filter['estado'] != ""){
                $page = 1;
            }
            if ( $filter['estado'] == null ){
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
                    ->where(' estado', $filter['estado'])
                    ->orderBy('id', 'desc')
                    ->paginate($request->per_page?:5, ['*'], 'page', $page);
            }
        }else{
            $rows = Orden::orderBy('id', 'desc')->paginate($request->per_page?:5);
        }
        return $rows;
    }
}
