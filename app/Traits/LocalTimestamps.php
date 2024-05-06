<?php

namespace App\Traits;

trait LocalTimestamps
{
    public function getCreatedAtAttribute($value)
    {
        // Convert the stored UTC timestamp to your desired timezone
        return \Carbon\Carbon::parse($value)->timezone('Asia/Manila')->format('m/d/Y h:i a');
    }

    public function getUpdatedAtAttribute($value)
    {
        // Convert the stored UTC timestamp to your desired timezone
        return \Carbon\Carbon::parse($value)->timezone('Asia/Manila')->format('m/d/Y h:i a');
    }

    public function setCreatedAtAttribute($value)
    {
        // Convert the incoming datetime to UTC before storing
        $this->attributes['created_at'] = \Carbon\Carbon::parse($value)->timezone('Asia/Manila');
    }

    public function setUpdatedAtAttribute($value)
    {
        // Convert the incoming datetime to UTC before storing
        $this->attributes['updated_at'] = \Carbon\Carbon::parse($value)->timezone('Asia/Manila');
    }
}
