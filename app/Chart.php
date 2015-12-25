<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class Chart extends Model
{
    public $table = "track_and_trace";
   	
    //mass assigned fields
    protected $fillable = [

   	'nhi',
   	'ward',
   	'status',
   	'receival_time',
   	'completed_time',
    'chart_query_time',
    'chart_query_resolved_time'
   	];

    // add dates specified as an instance of Carbon
  protected $dates = ['created_at', 'updated_at', 'receival_time','completed_time','chart_query_time','chart_query_resolved_time'];

    //this is to bypass a bug in carbon where "0000-00-00 00:00:00" is not parsed as 
    // "0000-00-00 00:00:00". So a getter needed to fix issue and pass correct value.

  public function getCompletedTimeAttribute($timestamp)
  {


    // flexible:
    return ( ! starts_with($timestamp, '0000')) ? $this->asDateTime($timestamp) : null;
    // or explicit:
    // return ($timestamp !== '0000-00-00 00:00:00') ? $this->asDateTime($timestamp) : 'None';
  }

  public function scopeReceivalTimeToday($query) {
    return $query->where('receival_time', '>=' , Carbon::today())
        ->orderBy('chart_query' , 'DESC')-> orderBy('receival_time' , 'DESC');
  }

  public function scopeFilterByWard($query, $input) {
    return $query->where('ward', $input);
  }

  public static function updateReceivalTime($nhi,$ward){


    return static::where('nhi', $nhi)
        ->where('ward',$ward)
        ->where('completed_time','0000-00-00 00:00:00')
        ->where('receival_time', '>=' , Carbon::today())
        ->orderBy('receival_time' , 'DESC')->first();

  }

  public static function queryNhi($nhi, $timeDifference, $result) {

    return static::where('nhi', $nhi)
        ->where('receival_time', '>=' , ($timeDifference))
        ->orderBy('receival_time' , 'DESC')
        ->update($result);
  }

  public static function saveData ($track){

    $track -> completed_time = Carbon::now();
    $track -> status = 'Chart Completed';
    $track ->save();


  }

  public static function timeQuery($chartQuery) {
        if ($chartQuery === 'q') {
            
            return array( 
                            'chart_query' => '1',
                            'status' => 'Chart Queried',
                            'query_time' =>Carbon::now()
                            
            );
        }

        //resolve all nhi issues in past 12 hours
        else{
            
            return array( 
                            'chart_query' => '0',
                            'status' => 'Query Resolved',
                            'resolved_query_time' =>Carbon::now()
                            
                            );
        }

  }

  public static function exportToExcel() {
    return DB::table('track_and_trace')-> orderBy('receival_time' , 'DESC')
        ->get(array('nhi', 'ward', 'receival_time', 'completed_time','query_time','resolved_query_time'));
  }




}