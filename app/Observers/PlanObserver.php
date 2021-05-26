<?php


namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Plan;

class PlanObserver
{
    /**
     * Handle the plan "creting" event.
     *
     * @param  \App\Models\Plan  $plan
     * @return void
     */
    public function creating(Plan $plan)
    {
        //antes de cadstrar um plano atualizo URL
        $plan->url = Str::kebab($plan->name); //inserir o URL com o nome

    }

    /**
     * Handle the plan "updating" event.
     *
     * @param  \App\Models\Plan  $plan
     * @return void
     */
    public function updating(Plan $plan)
    {
        //antes de cadstrar um plano
$plan->url = Str::kebab($plan->name);

    }


}
