<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{

    public function user()
    {
        // check if eloquent exist with user
        if (isset($this->user_id)) {

            return $this->belongsTo(User::class);

        }
        return null;
    }

}
