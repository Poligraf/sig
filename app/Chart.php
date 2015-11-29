<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

}