<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\TareaExport;
use App\Imports\TareaImport;
use App\Models\UsuarioCCIP;
use App\Models\Tarea;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TareasExportEmpty;

class TareasController extends Controller
{
    public function updatetask(Request $request){
        $operaciones = request()->input('operaciones', []);
        $id = $request->input('id');
        $task = Tarea::where('usuario_id', $id)->first();
        $task->site = request()->input('site');
        $task->zona = request()->input('selectCuadrilla');
        $task->titulo = request()->input('selectTarea');
        $task->operaciones = json_encode($operaciones);
        $task->fechaCreacion = request()->input('fechaCreacion');
        $task->fechaVencimiento = request()->input('fechaVencimiento');
        $task->descripcion = request()->input('descripcion');
        $task->save();
        return redirect('home/tareas');
    }

    public function redirectupdatetask($id){
        $reditask = Tarea::find($id);
        $user = UsuarioCCIP::select('id', 'name')->where('id', $reditask->usuario_id)->first();
        //dd($user);
        return view('Tareas.update',compact('reditask','user'));
    }

    public function deletetask($id){
        Tarea::destroy($id);
        return redirect('home/tareas');
    }

    public function registertask(){
        $operaciones = request()->input('operaciones', []);
        
        $task = new Tarea();
        $task->usuario_id = request()->input('usuario_id');
        $task->site = request()->input('site');
        $task->zona = request()->input('selectCuadrilla');
        $task->titulo = request()->input('selectTarea');
        $task->operaciones = json_encode($operaciones);
        $task->fechaCreacion = request()->input('fechaCreacion');
        $task->fechaVencimiento = request()->input('fechaVencimiento');
        $task->descripcion = request()->input('descripcion');
        $task->save();
        return redirect('home/tareas');
    }

    public function listtareas(Request $request){
        $users = UsuarioCCIP::select('id', 'name')->get();
        $usuario = 0;
        $tasks = Tarea::all();
        if ($request->isMethod('post')) {
            $usuario_id = request()->input('usuario_id');
            $tasks = Tarea::where('usuario_id', $usuario_id)->get();
            $usuarios = UsuarioCCIP::find($usuario_id);
            if ($usuarios) {
                $usuario = $usuarios->id;
            }else{
                $tasks = Tarea::all();
            }
        }
        return view('Tareas.listtareas',compact('users', 'tasks','usuario'));
    }

    public function import(Request $request){
        if ($request->has('importar')) {
            try {
                Excel::import(new TareaImport, $request->file('archivo'));
                return back()->with('success', 'Los datos se importaron correctamente.');
            } catch (\Exception $e) {
                return back()->with('error', 'Hubo un error al importar los datos. Por favor, verifica el archivo excel.');
            }
        } else {
            return Excel::download(new TareasExportEmpty, 'ModelTask.xlsx');
        }        
    }
}
