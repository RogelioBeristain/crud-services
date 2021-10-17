<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ally;
use Carbon\Carbon;

class AllyController extends Controller{
    public function index(){
        $dataAlly = Ally::all();
        return response()->json(array('data'=>$dataAlly));
    }

    public function save(Request $request){
        $dataAliances = new Ally;

        if($request->hasFile('img')){


            $originalName = $request->file('img')->getClientOriginalName();
            $newName = Carbon::now()->timestamp."_".$originalName;
            $pathFiles = './upload/allianses/';
            $request->file('img')->move($pathFiles, $newName);
            $dataAliances->img = ltrim($pathFiles,'.').$newName;
        }

        $dataAliances->name = $request['name'];
        $dataAliances->web = $request['web'];

        $dataAliances->save();
        return response()->json(array('data'=>$newName),201);
    }

    public function show($id){
        $dataAlly = Ally::find($id);
        return response()->json(array('data'=>$dataAlly));
    }

    public function update(Request $request, $id){
        $dataAliances = Ally::find($id);
        if($request->hasFile('img')){
            $last_path =  base_path('public').$dataAliances->img;
            if(file_exists($last_path)){
                unlink($last_path);
            }
            $originalName = $request->file('img')->getClientOriginalName();
            $newName = Carbon::now()->timestamp."_".$originalName;
            $pathFiles = './upload/allianses/';
            $request->file('img')->move($pathFiles, $newName);
            $dataAliances->img = ltrim($pathFiles,'.').$newName;
        }
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
