<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Accesorio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AccesorioController extends Controller
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
        $model = Accesorio::find($id);
        if ( !$model ){
            http_response_code(404);
            throw new \Exception('El registro no existe');
        }
        return $model;
    }

    private function format($model){
        return [
            'id'=>$model->id,
            'nombre'=>$model->nombre_completo,
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
                'nombre' => ['required'],
            ]);
            
            if ( $validator->fails() ){
                http_response_code(422);
                throw new \Exception($validator->errors()->first());
            }

            $imageName = null;
            $model = Accesorio::create([
                'nombre' => $request->nombre,
            ]);

            DB::commit();

            return response()->json($this->format($model), 201);

        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->formatError($th);
        }        
    }
    
    public function update(Request $request){
        DB::beginTransaction();
        try {
            $model = $this->getModel($id);

            $validator = Validator::make($request->all(), [
                'nombre' => ['required'],
            ]);
            
            if ( $validator->fails() ){
                http_response_code(422);
                throw new \Exception($validator->errors()->first());
            }

            $model->nombre = $request->nombre;

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
            if($filter['nombre'] != ""){
                $page = 1;
            }
            $rows = Accesorio::where('nombre', 'like', '%'.$filter['nombre'].'%')
                ->orderBy('id', 'desc')
                ->paginate($request->per_page?:5, ['*'], 'page', $page);
        }else{
            $rows = Accesorio::orderBy('id', 'desc')->paginate($request->per_page?:5);
        }
        return $rows;
    }

    public function todos(){
        return Accesorio::orderBy('id', 'desc')->get();
    }
}
