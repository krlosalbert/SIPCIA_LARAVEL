<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class outputs extends Model
{
    use HasFactory;
    protected $table = 'outputs';
    protected $primaryKey = 'id';
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'number',
        'subaccount_id',
        'department_id',
        'employee_id',
        'user_id'

    ];

    //definir la relación con la tabla secundaria
    public function outputs_products()
    {
        return $this->hasMany(outputs_products::class, 'output_id');
    }
}
