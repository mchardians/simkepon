<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Iuran extends Model
{
    use HasFactory;

    protected $table = 'iuran';
    protected $primaryKey = 'id';
    protected $fillable = [
        'masak', 'gas_minyak', 'kas', 'tabungan', 'bisaroh',
        'transport', 'darurat', 'date', 'santri_id'
    ];

    public function santri(): BelongsTo {
        return $this->belongsTo(Santri::class, 'santri_id', 'id');
    }
}
