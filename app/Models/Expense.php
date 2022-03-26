<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// model de gastos
class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'description', 'type', 'amount', 'photo', 'expense_date'
    ];

    protected $dates = ["expense_date"];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function setExpenseDateAttribute($prop)
    {
        return $this->attributes['expense_date'] = (\DateTime::createFromFormat('d/m/Y H:i:s', $prop))->format('Y-m-d H:i:s');
    }
}
