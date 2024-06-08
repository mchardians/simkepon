<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WaliSantri extends Model
{
    use HasFactory;

    protected $table = 'wali_santri';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nik', 'name', 'email', 'education',
        'job', 'phone', 'address',
    ];

    public function santri(): HasMany {
        return $this->hasMany(Santri::class, 'wali_santri_id', 'id');
    }
}
