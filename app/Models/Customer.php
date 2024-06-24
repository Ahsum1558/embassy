<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function customerDocoment()
    {
        return $this->hasOne(CustomerDocoment::class);
    }

    public function customerPassport()
    {
        return $this->hasOne(CustomerPassport::class);
    }

    public function customerEmbassy()
    {
        return $this->hasOne(CustomerEmbassy::class);
    }

    public function customerVisa()
    {
        return $this->hasOne(CustomerVisa::class);
    }

    public function customerRate()
    {
        return $this->hasOne(CustomerRate::class);
    }

    public function customerManpower()
    {
        return $this->hasOne(CustomerManpower::class);
    }
}