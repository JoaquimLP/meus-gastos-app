<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Livewire\Component;
use Livewire\WithFileUploads;

class ExpenseCreateComponent extends Component
{
    use WithFileUploads;

    public $amount = null;
    public $type = null;
    public $description = null;
    public $photo = null;
    public $expense_date = null;


    protected $rules = [
        "amount" => 'required',
        "type" => 'required',
        "description" => 'required',
        "expense_date" => 'nullable',
        "photo" => 'image|nullable',
    ];
    public function createExpense()
    {
        $this->validate();

        if($this->photo){
            $photo = $this->photo->store("expenses-photo", 'public');
        }

        Expense::create([
            "amount" =>$this->amount,
            "user_id" => auth()->user()->id,
            "type" =>$this->type,
            "description" =>$this->description,
            "photo" => $photo ?? null,
            "expense_date" => $this->expense_date ?? null,
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
