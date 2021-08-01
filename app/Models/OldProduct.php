<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OldProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'key',
        'quantity_on_hand'
    ];
    protected $table = 'old_products';

}
