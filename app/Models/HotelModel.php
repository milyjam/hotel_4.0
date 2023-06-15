<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuartoModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'hotel';
    
    public function quarto()
    {
        return $this->hasOne(QuartoModel::class, 'fk_hotel');
    }
}
