<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class EnableDeviceController extends Controller
{
    public function index(){
    	try{
    		$path = base_path();
			$sbus_path = env('ALEXA_TIS_BRIDGE_PATH');
			$keyfile_name = "HA_Bridge.key";
			$path = $path.$sbus_path.$keyfile_name;
			if(!file_exists($path)){
				return view('config.index');
			}
			$data = file($path);
			if(empty($data)){
				return view('config.index');
			}
			return redirect('configure');
    	}
    	catch(Exception $e){
    		return $e;
    	}
    	
    }

    public function enable(Request $request){
    	try{
    		$path = base_path()."/storage/SILOP";
    		$sbus_path = base_path().env('SBUS_BRIDGE_PATH');
    		$zmote_path = base_path().env('ZMOTE_BRIDGE_PATH');
    		$rules = [
    			'key' => 'required|mimetypes:application/java-archive|size:2659.671875'
    		];
    		$this->validate($request, $rules);
    		$file = $request->file('key');
    		$file->move($path, $file->getClientOriginalName());
    		$file_path = $path."/".$file->getClientOriginalName();
    		exec("java -jar ".$file_path." > ".$sbus_path."keys.txt",$output1, $return1);
    		exec("java -jar ".$file_path." > ".$zmote_path."keys.txt",$output2, $return2);
    		File::Delete($file_path);
    		if(!$return1)
    			return redirect('configure');
    		else
    			return back()->withInput()->withErrors(['errors' => 'Error validating key.']);
			return $file_path;
    	}
    	catch(Exception $e){

    	}
    }
}
