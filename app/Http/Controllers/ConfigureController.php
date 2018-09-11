<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class ConfigureController extends Controller
{
    public function configure(){
    	return view('config.config');
    }

    public function alexa(){
        $aid = 0;
        $index = 0;
        $apis = array();
        $path = base_path();
        $alexa_path = env('ALEXA_TIS_BRIDGE_PATH');
        $inputfile = $path.$alexa_path."inputFile.dat";
        if(!file_exists($inputfile))
                File::put($inputfile,"");
        $content = File::get($inputfile);
        $rows = explode("\n",$content);
        foreach ($rows as $row) {
            if($row!=NULL){
                $data = explode(" ", $row);
                $temp['index'] = $data[0];
                $temp['ip_addr'] = $data[1];
                $temp['deviceID'] = $data[2];
                $temp['subnetID'] = $data[3];
                $temp['channel'] = $data[4];
                $temp['id'] = $aid;
                array_push($apis,$temp);
                $aid++;

                $index = $data[0];
            }
        }

        return view('config.alexa',['apis'=>$apis,'index'=>$index]);
    }


    public function alexa_add_api(Request $request){
        try{
            $rules = [
                'device_id' => 'required|numeric',
                'ip_addr' => 'required|ipv4',
                'subnet_id' => 'required|numeric',
                'channel' => 'required|numeric',
                'index' => 'required|numeric'
            ];
            $this->validate($request, $rules);
            $data = $request->all();
            $path = base_path();
            $alexa_path = env('ALEXA_TIS_BRIDGE_PATH');
            $apis = $path.$sbus_path."inputFile.dat";
            $temp = $data['index']." ".$data['ip_addr']." ".$data['device_id']." ".$data['subnet_id']." ".$data['channel']."\n";
            File::append($apis, $temp);
            exec("",$output,$return);
            return redirect('/alexa');
        }
        catch(Exception $e){

        }
    }

    public function alexa_delete_api($id){
        try{

        }
        catch(Exception $e){

        }
    }



    public function reset(){
    	try{
    		$path = base_path()."/SILOP/HA_Bridge.key";

    		File::Delete($path);
			/*$sbus_keys = $path.env('SBUS_BRIDGE_PATH')."keys.txt";
			$sbus_devices = $path.env('SBUS_BRIDGE_PATH')."devices.txt";
			$sbus_buttons = $path.env('SBUS_BRIDGE_PATH')."buttons.txt";
			$sbus_gateways = $path.env('SBUS_BRIDGE_PATH')."gateways.txt";

			$zmote_keys = $path.env('ZMOTE_BRIDGE_PATH')."keys.txt";
			$zmote_devices = $path.env('ZMOTE_BRIDGE_PATH')."Devices.txt";
			$zmote_buttons = $path.env('ZMOTE_BRIDGE_PATH')."Buttons.txt";
			$zmote_zmotes = $path.env('ZMOTE_BRIDGE_PATH')."ZMotes.txt";

			File::Delete($sbus_keys);
			File::Delete($sbus_devices);
			File::Delete($sbus_buttons);
			File::Delete($sbus_gateways);

			File::Delete($zmote_keys);
			File::Delete($zmote_devices);
			File::Delete($zmote_buttons);
			File::Delete($zmote_zmotes);*/
    		return redirect('/');
    	}
    	catch(Exception $e){
    		
    	}
    }

    public function reboot(){
    	try{
    		echo "Device Rebooting...";
    		$path = base_path().'/phpreboot';
    		exec('sudo reboot',$output,$result);
    	}
    	catch(Exception $e){
    		return $e;
    	}
    }

    public function reload($id){
    	try{
    		$path = base_path().'/SILOP/';
    		$pid="0";
    		if($id==1){
    			exec("ps -aux | grep 'java -jar SILOP.jar'",$output,$result);
    			$res = explode(" ", $output[1]);
    			$len = sizeof($res);
    			if($res[0]=="root"){
    				for($i=1;$i<$len;$i++){
    					if($res[$i]!=NULL){
    						$pid=$res[$i];
    						break;
    					}
    				}
    			}
    			$command = "sudo kill -KILL ".$pid;
    			if($pid!="0"){
    				exec($command,$output2,$result2);	
    			}
    			$path = $path.env('SBUS_BRIDGE_PATH')."SILOP.jar";
    			exec('/home/pi/gateway.sh > /dev/null 2>/dev/null &',$output,$result);
    			return redirect('/sbus');
    			//return [$pid,$output,$output2,$result2];
    		}
    		else{
    			exec("ps -aux | grep 'java -jar SILOP2.jar'",$output,$result);
    			$res = explode(" ", $output[1]);
    			$len = sizeof($res);
    			if($res[0]=="root"){
    				for($i=1;$i<$len;$i++){
    					if($res[$i]!=NULL){
    						$pid=$res[$i];
    						break;
    					}
    				}
    			}
    			$command = "sudo kill -KILL ".$pid;
    			if($pid!="0"){
    				exec($command,$output2,$result2);	
    			}
    			$path = $path.env('ZMOTE_BRIDGE_PATH')."SILOP2.jar";
    			exec('/home/pi/gateway2.sh > /dev/null 2>/dev/null &',$output,$result);
    			return redirect('/zmote');
    			//return [$pid,$output,$result];
    		}
    		return "No such process found.";

    	}
    	catch(Exception $e){

    	}
    }
}
