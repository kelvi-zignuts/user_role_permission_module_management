<?php

namespace App\Http\Traits;

use Illuminate\Support\Str;

//resuable pieces of code that provides functionality to generate uuid
trait UUID
{
    //used protected because everyone not show uuid 
    protected static function boot ()
    {
        // Boot other traits on the Model
        parent::boot();

        /**
         * Listen for the creating event on the user model.
         * Sets the 'id' to a UUID using Str::uuid() on the instance being created
         */
        
        //if uuid primary key field is null then set the primary key attribute to generate uuid
        static::creating(function ($model) {
            if ($model->getKey() === null) {
                $model->setAttribute($model->getKeyName(), Str::uuid()->toString());
            }
        });
    }

    //primary key is not auto-incrementing
    public function getIncrementing ()
    {
        return false;
    }
    //it is of type string 
    public function getKeyType ()
    {
        return 'string';
    }
}