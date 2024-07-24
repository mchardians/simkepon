<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPemasukan extends Model
{
    use HasFactory;

    protected $table = 'detail_pemasukan';
    protected $primaryKey = 'id';
    protected $fillable = ['month', 'year', 'amount', 'iuran', 'pemasukan_id'];

    public function pemasukan(): BelongsTo {
        return $this->belongsTo(Pemasukan::class, 'pemasukan_id', 'id');
    }
}
