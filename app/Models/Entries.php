<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entries extends Model
{
    use HasFactory;
    protected $table = 'entries';
    protected $primaryKey = 'id';
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'supplier_id',
        'invoice_id',

    ];

    //definir la relación con la tabla secundaria
    public function entries_products()
    {
        return $this->hasMany(entries_products::class, 'entry_id');
    }
}
