<?php

namespace App\Http\Controllers;



use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Chart;
use Carbon\Carbon;
use Input;
use App\Http\Requests\ValidateNhiRequest;
use App\Http\Requests\QueryNhiRequest;
use Excel;


class PagesController extends Controller
{

    // explode data by comma or by substring
    //url in routes for methods called at /start and /chart_update
    private function separateNhiWard($data, $bySubstring = null)
    {
        if ($bySubstring === null) {
            $separated = explode(',',$data);
            $separated['nhi'] = $separated [0];
            $separated['ward'] = $separated [1];        
            return $separated;
        }

        else {
            $separated[0] = substr($data, 0, 1);
            $separated[1] = substr($data, 1, 7);
            $separated['nhi'] = $separated [1];
            $separated['chart_query'] = $separated [0];
            return $separated;

        }
        
    } 

    private function redirectWithErrors() {
        
        $error = 'Could not find NHI';
        
        return response()->json(['nhi_and_ward' => [$error]],400);
    
    }
   

    public function start()
    {
        $notification = 'Chart Received';
        return view(('pages.start'), compact('notification'));
    }   //

    //exactly what it says on the tin store nhi and ward
        public function storeNhi(ValidateNhiRequest $request)
    {
        $input =  Input::get('nhi_and_ward');
        $nhiWardTime =  $this->separateNhiWard($input);
        $nhiWardTime['receival_time'] = Carbon::now();
        $insertNhi = Chart::create($nhiWardTime);
        return $insertNhi;
    }   

    //if input is all wards show all wards if not filter by input ward
    //form see status.blade.php and chart model
    public function deliveryStatus()
    {
        $notification = 'Welcome to SIG Delivery Status';

        if ((\Input::get('ward')=== 'All Wards') or (\Input::get('ward')===null)){

            $fields =  Chart::receivalTimeToday()->get();
        }

        //filter by ward
        else 
        { 
            $fields =  Chart::receivalTimeToday()->filterByWard(\Input::get('ward'))->get();
        
        }

        return view(('pages.status'), compact('notification','fields'));
    }

//chart completion timestamps
    public function stop()
    {
        $recieved = 'Chart Completed';;
        return view(('pages.stop'), compact('recieved'));

    }//

//add timestamp of completed time for one occurence of nhi in past 24 hours
// if multiple occurence of nhi present oldest recieval time get completed first  
    public function updateNhi(ValidateNhiRequest $request)
    {
        $input =  Input::get('nhi_and_ward');
        $nhiWardTime =  $this->separateNhiWard($input);
        $track =  Chart::updateReceivalTime($nhiWardTime['nhi'],$nhiWardTime['ward']);
        
        if($track ===null){
            return $this->redirectWithErrors();
        }

        else {

        $saveData = (Chart::saveData($track));

        return response()->json([$saveData]);
        }
        
    }

    public function query()
    {
        $queried = 'Chart Queried';
        return view(('pages.queried'), compact('queried'));

    }//

//grab query or resolved by typing q or r in url:/query
    public function queryChart(QueryNhiRequest $request)
    {   $input =  Input::get('nhi_and_ward');
        $nhiQuery =  $this->separateNhiWard($input,TRUE);
        
        $result = Chart::timeQuery($nhiQuery['chart_query']);
        
        if ($nhiQuery['chart_query'] ==='q'){
            $timeDiffFromQuery = Carbon::today()->subHours(2);
        }

        else {
            $timeDiffFromQuery = Carbon::today()->subHours(12);
        }
        //query all instances of nhi within 2 hour period
        //resolve all nhi queries within a 12 hours period
        $track =  Chart::queryNhi($nhiQuery['nhi'],$timeDiffFromQuery, $result); 

                  
        if(empty($track)){
            return $this->redirectWithErrors();
        }

        else {

        return response()->json([$track]);
        
        }

    }

    //export to csv

    //There is a carbon bug where if you try to reference the Chart model
    // Carbon tries to parse "0000-00-00 00:00:00" and fails with error:

    //in Carbon.php line 414
    //at Carbon::createFromFormat('Y-m-d H:i:s', '-0001-11-30 00:00:00') in Model.php line 2925

    public function ExcelExport()
    {
        $track_times =  Chart::exportToExcel();
        foreach ($track_times as &$track_time) {
            $track_time = (array)$track_time;
        }
      
        
        Excel::create('track_and_trace', function($excel) use($track_times) {
            $excel->sheet('Sheetname', function($sheet) use($track_times) {
                $sheet->setColumnFormat(array(
                'C' => 'dd/mm/yy',
                'D' => 'dd/mm/yy',
                'E' => 'dd/mm/yy',
                'F' => 'dd/mm/yy',
                ));
                $sheet->with($track_times);
            });
        })->download('csv');
    }

    public function fallbackForOldIE()
    {        
        return view('pages.error');
    }//
}
