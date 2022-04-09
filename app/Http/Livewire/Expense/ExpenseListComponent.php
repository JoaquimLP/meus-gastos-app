<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Livewire\Component;

class ExpenseListComponent extends Component
{
    public function render()
    {
        $expenses = Expense::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(10);
        return view('livewire.expense.expense-list-component', compact("expenses"));
    }

    public function remove($id)
    {
        $exp = Expense::find($id);
        $exp->delete();

        session()->flash('message', 'Registro Deletado com sucesso!');
    }
}
