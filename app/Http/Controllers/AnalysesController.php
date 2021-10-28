<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vulnerability;
use App\AnalysisXvuln;
use App\analysisxvulns;
use App\Analysis;
use App\Analyses;
use Auth;

class AnalysesController extends Controller
{
    public function addreport() {

        $vuls = vulnerability::latest()->get();
        return view('reportgenerator' , ['vuls' => $vuls ]);

    }

  

    public function index() {
        $reports = Analysis::latest()->orderBy('created_at', 'desc')->paginate(20);

        return view('allreports' , ['reports' => $reports]);
    }



    public function destroy(Request $request) {

        $attributes = request()->validate([
            'id'  => 'required|string',
        ]);
        $vuls_ids = Analysis::where('id', '=', $attributes['id'])->value('vuls_ids');

        $pieces = explode(",", $vuls_ids);
 
        foreach ($pieces as $piece) {
            analysisxvulns::destroy($piece);
        }

        Analysis::find($attributes['id'])->destroy($attributes);

        return back()->with('status', 'The report was deleted');
    }
 

    public function changestatus(Request $request) {
        $attributes = request()->validate([
            'id'  => 'required|string',
        ]);
        $status = Analysis::where('id', '=', $attributes['id'])->value('status');

        if($status == 'Open'){
            Analysis::where('id', $attributes['id'])
                ->update(['status' => "Closed"]);
        }else {
            Analysis::where('id',  $attributes['id'])
                ->update(['status' => "Open"]);
        }

        return back();

    }

    public function show(Request $request) {

        $reports = Analysis::where('id', '=', $request->get('id'))->get();
        $vuls_ids = Analysis::where('id', '=', $request->get('id'))->value('vuls_ids');

        $pieces = explode(",", $vuls_ids);


            $vuls = analysisxvulns::find($pieces);



        return view('singlreport', ['reports' => $reports, 'vuls' => $vuls]);
    }

    public function store(Request $request) {
        $attributes = request()->validate([
            'name' => 'required|string',
            'introduction' => 'required|string',
            'conclusion' => 'required|string',
            'vuls_ids' => 'nullable|string',
        ]);


        if($attributes['vuls_ids'] == ''){
            $attributes['vuls_ids'] = 'NONE';
        }

        
        $attributes['status'] = 'Open';

        $attributes['user_id'] = 1;
       
        

        Analyses::create($attributes);

        return 'The new report was added';

    }

    public function edit(Request $request) {

        $attributes = request()->validate([
            'id'  => 'required|string',
       ]);

       $reports = Analyses::where('id', '=', $attributes['id'])->get();

       $vuls_ids = Analyses::where('id', '=', $attributes['id'])->value('vuls_ids');

       $pieces = explode(",", $vuls_ids);
       $vuls = analysisxvulns::find($pieces);
       
        return view('editreport', ['reports' => $reports, 'vuls' =>$vuls]);
    }

    public function update(Request $request) {
        $attributes = request()->validate([
            'id'  => 'required|string',
            'name' => 'required|string',
            'introduction' => 'required|string',
            'conclusion' => 'required|string',
            
        ]);



        Analyses::find($attributes['id'])->update($attributes);

        return back()->with('status', 'Updated');
    }

    public function updatevul(Request $request) {

        $attributes = request()->validate([
            'id'  => 'required|string',
            'vulName' => 'required|string',
            'vulDescription' => 'required|string',
            'vulRecomendation' => 'required|string',
            'vulReference' => 'required|string',
            'vulRisk' => 'required|string',
            'target' => 'required|string',
        ]);

        analysisxvulns::find($attributes['id'])->update($attributes);

        return back()->with('message', 'Updated');

    }
    


}
