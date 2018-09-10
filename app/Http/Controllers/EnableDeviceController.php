<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class EnableDeviceController extends Controller
{
    public function index(){
    	try{
    		$path = base_path()."/SILOP";
			/*$sbus_path = env('ALEXA_TIS_BRIDGE_PATH');*/
			$keyfile_name = "HA_Bridge.key";
			$path = $path."/".$keyfile_name;
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
    		$path = base_path()."/SILOP";
    		$sbus_path = base_path().env('ALEXA_TIS_BRIDGE_PATH');
    		//$zmote_path = base_path().env('ZMOTE_BRIDGE_PATH');
            /*return $request->file('key')->getClientSize();*/
    		$rules = [
    			'key' => 'required|max:15'
    		];
    		$this->validate($request, $rules);
    		$file = $request->file('key');
    		$file->move($path, $file->getClientOriginalName());
    		$file_path = $path."/".$file->getClientOriginalName();
            exec("sudo chmod +x ".$file_path,$output2,$return2);

    		exec($file_path." 2>&1",$output1, $return1);
		exec("sudo /home/pi/mac_lock.sh",$output3,$return3);
    		/*exec("java -jar ".$file_path." > ".$zmote_path."keys.txt",$output2, $return2);*/
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
