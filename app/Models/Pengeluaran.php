<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran';
    protected $primaryKey = 'id';
    protected $fillable = ['date', 'amount', 'iuran', 'description'];

    public function santri(): BelongsTo {
        return $this->belongsTo(Santri::class, 'santri_id', 'id');
    }
}
