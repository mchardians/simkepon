<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    use HasFactory;

    protected $table = 'saldo';
    protected $primaryKey = 'id';
    protected $fillable = ['nis', 'name', 'gender', 'birth_place', 'birth_date', 'wali_santri_id', 'address', 'picture'];
}
