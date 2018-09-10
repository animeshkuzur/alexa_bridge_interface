<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class ConfigureController extends Controller
{
    public function configure(){
    	return view('config.config');
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
