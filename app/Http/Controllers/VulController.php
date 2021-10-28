<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\analysisxvulns;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VulController extends Controller
{
    public function store(Request $request){
        
        
        $attributes = request()->validate([
            'vulName' => 'nullable|string',
            'vulDescription' => 'nullable|string',
            'vulRecomendation' => 'nullable|string',
            'vulReference' => 'nullable|string',
            'vulRisk' => 'nullable|string',
            'target' => 'nullable|string',
            
        ]); 

        if($attributes['target'] == '') {
            $attributes['target'] = 'NO TARGET';
        }
        

   
 $attributes['evidences'] = '';  
    
 
 $uploadedFiles = $request->evidences;
if($uploadedFiles != '') {
    foreach ($uploadedFiles as $file){
        $photoName = Str::random(10) . '.'. $file->getClientOriginalExtension(); //str_replace(' ', '', $file->getClientOriginalName());
        $attributes['evidences'] = $attributes['evidences']  . ',' . $photoName ;
      
        Storage::putFileAs('public', new File($file), $photoName);
        

    }
}
  
    //return response(['status'=>'success'],200);

    //DON'T FORGET TO RUN THE COMMAND ->   php artisan storage:link

    

     $id = analysisxvulns::insertGetId($attributes);

       return $id;
    }




 
    public function destroy(Request $request){
        $attributes = request()->validate([
            'id'  => 'required|string',
       ]);

       analysisxvulns::find($attributes['id'])->destroy($attributes);

        //YOU NEED TO CREATE A FUNCTION HERE TO DELETE ALL IMAGES FROM THIS VUL
        return 'Deleted';
    }

    
}
