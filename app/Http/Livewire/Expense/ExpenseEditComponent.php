<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Livewire\Component;

class ExpenseEditComponent extends Component
{
    public $amount = null;
    public $type = null;
    public $description = null;
    public $expense = null;


    protected $rules = [
        "amount" => 'required',
        "type" => 'required',
        "description" => 'required'
    ];


    public function mount($expense)
    {
        $this->expense = Expense::where('id', $expense)->where('user_id', auth()->user()->id)->first();

        if ($this->expense) {
            $this->amount = $this->expense->amount;
            $this->type = $this->expense->type;
            $this->description = $this->expense->description;
            $this->expense = $this->expense;
        }else{
            session()->flash('error', 'Registro não encontrado');
            return redirect()->route("expenses.index");
        }
    }

    public function editExpense()
    {
        $this->validate();
        $this->expense->update([
            "amount" =>$this->amount,
            "user_id" => auth()->user()->id,
            "type" =>$this->type,
            "description" =>$this->description
        ]);

        session()->flash('message', 'Registro Atualizado com sucesso!');

        return redirect()->route("expenses.index");
    }

    public function render()
    {
        return view('livewire.expense.expense-edit-component');
    }
}
