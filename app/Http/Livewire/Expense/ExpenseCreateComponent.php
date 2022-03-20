<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Livewire\Component;

class ExpenseCreateComponent extends Component
{
    public $amount = null;
    public $type = null;
    public $description = null;

    protected $rules = [
        "amount" => 'required',
        "type" => 'required',
        "description" => 'required'
    ];

    public function createExpense()
    {
        $this->validate();
        Expense::create([
            "amount" =>$this->amount,
            "user_id" => auth()->user()->id,
            "type" =>$this->type,
            "description" =>$this->description
        ]);

        session()->flash('message', 'Registro criado com sucesso!');

        $this->amount = $this->type = $this->description = null;

        return redirect()->route("expenses.index");
    }

    public function render()
    {
        return view('livewire.expense.expense-create-component');
    }
}
