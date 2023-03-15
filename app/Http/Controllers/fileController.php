<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class fileController extends Controller
{
    //
    public function uploadFromCsv(Request $request){   
        if ($request->hasFile('bulkContacts')) {
            // $filesystem = Storage::disk('local');
            $file = $request->file('bulkContacts');
            $filename = $file->getClientOriginalName();
            // $path = $request->file('studentfile')->store('students', $filename);
            $path = Storage::putFile('contacts', $request->file('bulkContacts'));
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(strcasecmp($ext, "csv") != 0){
                return (json_encode("File must be a CSV file"));
            }
            $file = Storage::disk('local')->get($path);
            $rows = explode("\n", $file);            
            $response = array();
            $counter = 0;
            foreach ($rows as $row) {
                $data = str_getcsv($row);
                $counter++;
                if(($data[0] == null) || ($data[0] == "") || ($data[0] == "null")){
                    continue;
                }
                array_push($response, $data[0]);
            }
            Storage::delete($path);
            return json_encode($response);
        }
        else{
            echo json_encode([]);
        }
    }

    function generateCustomeMessages(Request $request){
        $response = array();
        $parameters = array();
        $genericMessage = $request->message;
        if ($request->hasFile('messageParameters')) {
            $file = $request->file('messageParameters');
            $filename = $file->getClientOriginalName();
            $path = Storage::putFile('contacts', $request->file('messageParameters'));
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(strcasecmp($ext, "csv") != 0){
                return (json_encode("File must be a CSV file"));
            }
            $file = Storage::disk('local')->get($path);
            $rows = explode("\n", $file);            
            $response = array();
            $counter = 0;
            foreach ($rows as $row) {
                $data = str_getcsv($row);
                $counter++;
                if(($data[0] == null) || ($data[0] == "") || ($data[0] == "null")){
                    continue;  //we Ignore all the null rows and columns
                }
                array_push($parameters, $data);
            }
            Storage::delete($path); //remove the file coz we dont really need it
            $headers = $parameters[0];
            $values = array();
            array_shift($parameters);
            foreach($parameters as $parameter){
                $data = array();
                for($i = 0; $i < sizeof($parameter); $i++){
                    $data = array_merge_recursive($data, array(
                        $headers[$i] => $parameter[$i]
                    ));
                }
                array_push($values, $data);
            }

            foreach($values as $value){
                $message = $genericMessage;
                foreach($value as $key => $param){
                    $pattern = "/@".$key."/i";
                    $message = preg_replace($pattern, $param, $message);
                }
                array_push($response, array($value['Number'], $message));
            }
        }
        return json_encode($response);
    }
}
