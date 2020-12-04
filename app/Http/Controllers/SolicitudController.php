<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SolicitudTrabajo;
use App\Vehiculo;
use App\Cliente;
use App\EstadoVehiculo;
use App\Accesorio;
use App\DetalleRepuesto;
use App\DetalleManoObra;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SolicitudController extends Controller
{
    private function getModel($id){
        $model = SolicitudTrabajo::find($id);
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
            'repuestos'=>$model->repuestos,
            'manosdeobra'=>$model->manosdeobra,
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
            $cliente = Cliente::create([
                'nombre_completo'=>$request->propietario,
                'telefono1'=>$request->telefono,
            ]);

            $vehiculo = Vehiculo::where('vehiculo', strtolower($request->vehiculo))
                ->where('vehiculo', strtolower($request->vehiculo))
                ->where('placa', strtolower($request->placa))
                ->where('modelo', strtolower($request->modelo))
                ->where('color', strtolower($request->color))
                ->get();
            if (!$vehiculo){
                $vehiculo = Vehiculo::create([
                    'vehiculo'=>strtolower($request->vehiculo),
                    'placa'=>strtolower($request->placa),
                    'modelo'=>strtolower($request->modelo),
                    'color'=>strtolower($request->color),
                    'ano'=>$request->ano,
                ]);
            }
            
            $model = SolicitudTrabajo::create([
                'cliente_id'=>$request->cliente_id,
                'vehiculo_id'=>$request->vehiculo_id,
                'fecha'=>$request->fecha,
                'tanque'=>$request->tanque,

                'otros'=>$request->otros,
                'responsable'=>null,
                'fecha_ingreso'=>$request->fecha_ingreso,
                'fecha_salida'=>null,
                'km_actual'=>null,
                'proximo_cambio'=>null,
                'pago'=>null,
                'detalle_pago'=>null,
                'estado'=>0,
            ]);

            // estado del vehiculo
            foreach ($accsorios as $key => $accesorio) {
                $mdDetAccesorio = EstadoVehiculo::create([
                    'solicitud_trabajo_id'=>$model->id,
                    'accesorio_id'=>$accesorio['accesorio'],
                    'fecha'=>Carbon::now()->format('Y-m-d'),
                ]);
            }
            

            // registrando trabajos de la solicitud
            // 'solicitud'=>$request->solicitud,
            $mdDetAccesorio = EstadoVehiculo::create([
                'solicitud_trabajo_id'=>$model->id,
                'accesorio_id'=>$accesorio['accesorio'],
                'fecha'=>Carbon::now()->format('Y-m-d'),
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
            $rows = SolicitudTrabajo::where('cliente.nombre_completo', 'like', '%'.$filter['propietario'].'%')
                ->where('vehiculo.placa', 'like', '%'.$filter['placa'].'%')
                ->where('vehiculo.modelo', 'like', '%'.$filter['modelo'].'%')
                ->where('vehiculo.color', 'like', '%'.$filter['color'].'%')
                ->where('vehiculo.ano', 'like', '%'.$filter['ano'].'%')
                ->select(
                    'cliente.nombre_completo',
                    'cliente.telefono1',
                    'cliente.telefono2',
                    'vehiculo.vehiculo',
                    'vehiculo.placa',
                    'vehiculo.modelo',
                    'vehiculo.color',
                    'vehiculo.ano',
                    'vehiculo.observacion',
                    'solicitud_trabajo.cliente_id',
                    'solicitud_trabajo.vehiculo_id',
                    'solicitud_trabajo.tanque',
                    'solicitud_trabajo.otros',
                    'solicitud_trabajo.fecha',
                    'solicitud_trabajo.fecha_ingreso',
                    'solicitud_trabajo.hora_ingreso',
                    'solicitud_trabajo.fecha_salida',
                    'solicitud_trabajo.hora_salida',
                    'solicitud_trabajo.km_actual',
                    'solicitud_trabajo.proximo_cambio',
                    'solicitud_trabajo.pago',
                    'solicitud_trabajo.detalle_pago',
                    'solicitud_trabajo.mecanico_id',
                    'solicitud_trabajo.estado')
                ->join('cliente', 'solicitud_trabajo.cliente_id', '=', 'cliente.id')
                ->join('vehiculo', 'solicitud_trabajo.vehiculo_id', '=', 'vehiculo.id')
                ->orderBy('solicitud_trabajo.id', 'desc')
                ->paginate($request->per_page?:5, ['*'], 'page', $page);
        }else{
            $rows = SolicitudTrabajo::select(
                    'cliente.nombre_completo',
                    'cliente.telefono1',
                    'cliente.telefono2',
                    'vehiculo.vehiculo',
                    'vehiculo.placa',
                    'vehiculo.modelo',
                    'vehiculo.color',
                    'vehiculo.ano',
                    'vehiculo.observacion',
                    'solicitud_trabajo.cliente_id',
                    'solicitud_trabajo.vehiculo_id',
                    'solicitud_trabajo.tanque',
                    'solicitud_trabajo.otros',
                    'solicitud_trabajo.fecha',
                    'solicitud_trabajo.fecha_ingreso',
                    'solicitud_trabajo.hora_ingreso',
                    'solicitud_trabajo.fecha_salida',
                    'solicitud_trabajo.hora_salida',
                    'solicitud_trabajo.km_actual',
                    'solicitud_trabajo.proximo_cambio',
                    'solicitud_trabajo.pago',
                    'solicitud_trabajo.detalle_pago',
                    'solicitud_trabajo.mecanico_id',
                    'solicitud_trabajo.estado')
                ->join('cliente', 'solicitud_trabajo.cliente_id', '=', 'cliente.id')
                ->join('vehiculo', 'solicitud_trabajo.vehiculo_id', '=', 'vehiculo.id')
                ->orderBy('solicitud_trabajo.id', 'desc')
                ->paginate($request->per_page?:5);
        }
        return $rows;
    }
}
