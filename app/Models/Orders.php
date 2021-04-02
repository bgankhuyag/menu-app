<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'orders';

    public function condiments() {
        return $this->hasMany(Condiments::class);
    }

    public function toppings() {
        return $this->hasMany(Toppings::class);
    }

    public function users() {
      return $this->belongsTo(User::class);
    }

    public function bases() {
      return $this->belongsTo(Base::class);
    }
}
