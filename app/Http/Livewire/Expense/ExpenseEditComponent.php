<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ExpenseEditComponent extends Component
{
    use WithFileUploads;
    public $amount = null;
    public $type = null;
    public $description = null;
    public $expense = null;
    public $photo = null;


    protected $rules = [
        "amount" => 'required',
        "type" => 'required',
        "description" => 'required',
        "photo" => 'image|nullable',
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
            "description" =>$this->description,
            "photo" =>$this->photo ?? $this->expense->photo,
        ]);

        if($this->photo){
            if(isset($this->expense->photo) && Storage::disk('public')->exists($this->expense->photo)){
                Storage::disk('public')->delete($this->expense->photo);
            }
            $photo = $this->photo->store("expenses-photo", 'public');
            $this->expense->update([
                "photo" => $photo ,
            ]);
        }


        session()->flash('message', 'Registro Atualizado com sucesso!');

        return redirect()->route("expenses.index");
    }

    public function render()
    {
        return view('livewire.expense.expense-edit-component');
    }
}
