<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
    public function getName()
    {
        return "{$this->prefix} {$this->name}";
    }
}
