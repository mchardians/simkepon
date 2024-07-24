<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pemasukan extends Model
{
    use HasFactory;

    protected $table = 'pemasukan';
    protected $primaryKey = 'id';
    protected $fillable = ['payment_code', 'total_payment', 'payment_date', 'status', 'santri_id'];

    public function santri(): BelongsTo {
        return $this->belongsTo(Santri::class, 'santri_id', 'id');
    }

    public function detailPemasukan(): HasMany {
        return $this->hasMany(DetailPemasukan::class, 'pemasukan_id', 'id');
    }
}
