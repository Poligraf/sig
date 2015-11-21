<?php

namespace App\Http\Controllers;



use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\trackmodel;
use Carbon\Carbon;
use Input;
use App\Http\Requests\ValidateNhiRequest;
use App\Http\Requests\QueryNhiRequest;
use DB;
use Excel;

class PagesController extends Controller
{

    
    public function Separate_Nhi_Ward($data)
        {
            $separated = explode(',',$data);
            $separated['nhi'] = $separated [0];
            $separated['ward'] = $separated [1];        
            return $separated;
        
        }  

    public function start()
    {
        $recieved = 'Chart Received';
        return view(('pages.start'), compact('recieved'));
    }   //

        public function storenhi(ValidateNhiRequest $request)
    {
        $input =  Input::get('nhi_and_ward');
        $NhiWardTime =  $this->Separate_Nhi_Ward($input);
        $NhiWardTime['receival_time'] = Carbon::now();
        trackmodel::create($NhiWardTime);
        return redirect('start');
    }   

    public function deliverystatus()
    {
        $notification = 'Welcome to SIG Delivery Status';

        if (\Input::get('ward')== 'All Wards'){
        $fields =  trackmodel::where('receival_time', '>=' , Carbon::today())
        ->orderBy('chart_query' , 'DESC')-> orderBy('receival_time' , 'DESC')
        ->get();
        }
        else {
        $fields =  trackmodel::where('receival_time', '>=' , Carbon::today())
        ->orderBy('chart_query' , 'DESC')-> orderBy('receival_time' , 'DESC')
        ->where('ward', \Input::get('ward'))->get();

        }
        return view(('pages.status'), compact('notification','fields'));

    }//


    public function stop()
    {
        $recieved = 'Chart Completed';;
        return view(('pages.stop'), compact('recieved'));

    }//

    public function updatenhi(ValidateNhiRequest $request)
    {
        $input =  Input::get('nhi_and_ward');
        $NhiWardTime =  $this->Separate_Nhi_Ward($input);
        $track =  trackmodel::where('nhi', $NhiWardTime['nhi'])
        ->where('ward',$NhiWardTime['ward'])
        ->where('completed_time','0000-00-00 00:00:00')
        ->where('receival_time', '>=' , Carbon::today())
        ->orderBy('receival_time' , 'DESC')
        ->first();
        if(empty($track)){
            return redirect('chart_update') -> with('error','Could not find NHI'); 
        }
        $track -> completed_time = Carbon::now();
        $track -> status = 'Chart Completed';
        $track ->save();

        if(empty($track)){
            return redirect('chart_update') -> with('error','Could not find NHI'); 
        }
        return redirect('chart_update');
    }

    public function query()
    {
        $queried = 'Chart Queried';
        return view(('pages.queried'), compact('queried'));

    }//

    public function queryChart(QueryNhiRequest $request)
    {   $input =  Input::get('nhi_and_ward');
        $NhiQuery[0] = substr($input, 0, 1);
        $NhiQuery[1] = substr($input, 1, 7);
        $NhiQuery['nhi'] = $NhiQuery [1];
        $NhiQuery['chart_query'] = $NhiQuery [0];

        if ($NhiQuery['chart_query'] == 'q') {
            $result = array( 
                            'chart_query' => '1',
                            'status' => 'Chart Queried'
            );
        }

        else{
            $result = array( 
                            'chart_query' => '0',
                            'status' => 'Query Resolved'
                            );
        }

        $track =  trackmodel::where('nhi', $NhiQuery['nhi'])
        ->where('receival_time', '>=' , (Carbon::today()->subHours(2)))
        ->orderBy('receival_time' , 'DESC')
        ->update($result); 

                  

        if(empty($track)){
            return redirect('query') -> with('error','Could not find NHI'); 
        }

        return redirect('query');
        

    }

    public function ExcelExport()
    {
        $track_times =  DB::table('track_and_trace')
        ->orderBy('chart_query' , 'DESC')-> orderBy('receival_time' , 'DESC')
        ->get(array('nhi', 'ward', 'receival_time', 'completed_time'));

        foreach ($track_times as &$track_time) {
            $track_time = (array)$track_time;
        }
      
        
        Excel::create('Filename', function($excel) use($track_times) {

            $excel->sheet('Sheetname', function($sheet) use($track_times) {
                $sheet->setColumnFormat(array(
                'C' => 'dd/mm/yy',
                'D' => 'dd/mm/yy'
                ));

                $sheet->with($track_times);

            });

        })->download('csv');
    }
}
