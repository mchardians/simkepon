<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cicilan extends Model
{
    use HasFactory;

    protected $table = 'cicilan';
    protected $primaryKey = 'id';
    protected $fillable = ['amount', 'due_date', 'iuran', 'description', 'santri_id'];

    public function santri(): BelongsTo {
        return $this->belongsTo(Santri::class, 'santri_id', 'id');
    }
}
