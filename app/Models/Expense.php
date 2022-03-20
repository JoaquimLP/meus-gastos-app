<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// model de gastos
class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'description', 'type', 'amount',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
