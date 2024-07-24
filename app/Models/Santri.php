<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Santri extends Model
{
    use HasFactory;

    protected $table = 'santri';
    protected $primaryKey = 'id';
    protected $fillable = ['nis', 'name', 'gender', 'birth_place', 'birth_date', 'wali_santri_id', 'address', 'picture'];

    public function walisantri(): BelongsTo {
        return $this->belongsTo(WaliSantri::class, 'wali_santri_id', 'id');
    }

    public function iuran(): HasMany {
        return $this->hasMany(Iuran::class, 'santri_id', 'id');
    }

    public function pemasukan(): HasMany {
        return $this->hasMany(Pemasukan::class, 'santri_id', 'id');
    }

    public function cicilan(): HasMany {
        return $this->hasMany(Cicilan::class, 'santri_id', 'id');
    }
}
