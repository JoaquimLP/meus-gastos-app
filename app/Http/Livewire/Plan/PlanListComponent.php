<?php

namespace App\Http\Livewire\Plan;

use App\Models\Plan;
use Livewire\Component;

class PlanListComponent extends Component
{
    public function render()
    {
        $plans = Plan::orderBy('id', 'desc')->paginate(10);
        return view('livewire.plan.plan-list-component', compact("plans"));
    }
}
