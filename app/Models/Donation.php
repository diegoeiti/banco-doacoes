<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'title',
        'description',
        'category',
        'quantity',
        'status',
        'user_id'
    ];

    // RELACIONAMENTO: Uma doação pertence a um usuário (doador)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // RELACIONAMENTO: Uma doação pode ter muitos recebimentos
    public function recebimentos()
    {
        return $this->hasMany(Recebimento::class);
    }
}
