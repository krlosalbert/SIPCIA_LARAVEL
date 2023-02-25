<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'tblrole';
    protected $primaryKey = 'RoleId';
    use HasFactory;
}
