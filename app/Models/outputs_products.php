<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class outputs_products extends Model
{
    use HasFactory;
    protected $table = 'outputs_products';
    protected $primaryKey = 'id';
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'amount',
        'output_id',
        'product_id',

    ];

    //definir la relación con la tabla principal
    public function output()
    {
        return $this->belongsTo(output::class, 'output_id');
    }
}
