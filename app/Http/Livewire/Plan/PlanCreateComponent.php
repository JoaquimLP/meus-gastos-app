<?php

namespace App\Http\Livewire\Plan;

use App\Models\Plan;
use App\Models\Sandbox\ApiClient;
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

        // Criar o plano no pag seguro
        $params = [
            'name' =>  $this->plan['name'],
            'charge' => 'AUTO',
            'period' => 'MONTHLY',
            'amountPerPayment' =>  $this->plan['price'],
        ];

        $response = ApiClient::cretePlans( $this->plan['slug'], $params);
        $plan["reference"] = $response->json()['code'];
        $plano = Plan::create($plan);

        session()->flash('message', 'Registro criado com sucesso!');
        $this->plan = [];


        return redirect()->route("plans.index");
    }
}
