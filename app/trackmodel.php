<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class trackmodel extends Model
{
    public $table = "track_and_trace";
   	protected $fillable = [

   	'nhi',
   	'ward',
   	'status',
   	'receival_time',
   	'completed_time'
   	];

protected $dates = ['created_at', 'updated_at', 'receival_time','completed_time'];

public function getCompletedTimeAttribute($timestamp)
{
    // flexible:
    return ( ! starts_with($timestamp, '0000')) ? $this->asDateTime($timestamp) : null;
    // or explicit:
    // return ($timestamp !== '0000-00-00 00:00:00') ? $this->asDateTime($timestamp) : 'None';
}
}