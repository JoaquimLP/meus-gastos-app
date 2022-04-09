<?php

namespace App\Http\Livewire\Plan;

use App\Models\Plan;
use Livewire\Component;

class PlanCreateComponent extends Component
{
    public array $plan = [];


    protected $rules = [
        'plan.name' => 'required',
        'plan.description' => 'required',
        'plan.price' => 'required',
        'plan.slug' => 'required',
    ];

    public function render()
    {
        return view('livewire.plan.plan-create-component');
    }

    public function createPlan()
    {
        $this->validate();
        $plan = $this->plan;
        $plan["reference"] = "pague-seguro";
        Plan::create($plan);

        session()->flash('message', 'Registro criado com sucesso!');
        $this->plan = [];

        return redirect()->route("plans.index");
    }
}
