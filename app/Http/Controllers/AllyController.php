<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ally;
use Carbon\Carbon;

class AllyController extends Controller{

    private function saveFile($request, $input_name){
        if($request->hasFile($input_name)){
            $originalName = $request->file($input_name)->getClientOriginalName();
            $newName = Carbon::now()->timestamp."_".$originalName;
            $pathFiles = './upload/allianses/';
            $request->file($input_name)->move($pathFiles, $newName);
            return ltrim($pathFiles,'.').$newName;

        }
    }

    private function updateFile($request, $input_name, $last_name){
        if($request->hasFile($input_name)){
            $last_path =  base_path('public').$last_name;
            if(file_exists($last_path)){
                unlink($last_path);
            }
            $originalName = $request->file($input_name)->getClientOriginalName();
            $newName = Carbon::now()->timestamp."_".$originalName;
            $pathFiles = './upload/allianses/';
            $request->file($input_name)->move($pathFiles, $newName);
            return ltrim($pathFiles,'.').$newName;
        }
    }
    public function index(){
        $dataAlly = Ally::all();
        return response()->json(array('data'=>$dataAlly));
    }

    public function save(Request $request){
        $dataAliances = new Ally;

        $dataAliances->img = $this->saveFile($request, "img");
        $dataAliances->cover = $this->saveFile($request, "cover");
        $dataAliances->name = $request['name'];
        $dataAliances->description = $request['description'];
        $dataAliances->web = $request['web'];

        $dataAliances->web = $request['web'];

        $dataAliances->save();
        return response()->json(array('data'=>$dataAliances->img),201);
    }

    public function show($id){
        $dataAlly = Ally::find($id);
        return response()->json(array('data'=>$dataAlly));
    }

    public function update(Request $request, $id){
        $dataAliances = Ally::find($id);
        $dataAliances->img = $this->updateFile($request,"img",$dataAliances->img);
        $dataAliances->cover = $this->updateFile($request,"cover",$dataAliances->cover);
        $dataAliances->description = $request->input('description');
        $dataAliances->name = $request->input('name');
        $dataAliances->web = $request->input('web');
        $dataAliances->save();
        return response()->json(array('message'=> 'Update ok'),201);
    }

     public function delete($id){
        $dataAlly = Ally::find($id);
        if($dataAlly) {
            $pathFile = base_path('public').$dataAlly->img;
            if(file_exists($pathFile)){
                unlink($pathFile);
            }
            $dataAlly->delete();
        }
        return response()->json(array('message'=>'delate ok'));
    }
}
