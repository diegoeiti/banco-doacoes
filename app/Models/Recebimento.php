<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recebimento extends Model
{
    use HasFactory;

    protected $fillable = [
        'donation_id',
        'user_id',
        'quantidade_recebida'
    ];

    // RELACIONAMENTO: Um recebimento pertence a uma doação
    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }

    // RELACIONAMENTO: Um recebimento pertence a um usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
