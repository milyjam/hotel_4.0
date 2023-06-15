<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HotelModel;

class QuartoModel extends Model
{
    use HasFactory;
    
    protected $table = 'quarto';

    public function hotel()
    {
        return $this->belongsTo(HotelModel::class, 'fk_hotel');
    }
}
