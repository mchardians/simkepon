<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Santri extends Model
{
    use HasFactory;

    protected $table = 'santri';
    protected $primaryKey = 'id';

    public function walisantri(): BelongsTo {
        return $this->belongsTo(WaliSantri::class, 'wali_santri_id', 'id');
    }
}
