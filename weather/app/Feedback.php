<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{

    public function user()
    {
        if (isset($this->user_id)) {
            return $this->belongsTo(User::class);
        }
    }

}
