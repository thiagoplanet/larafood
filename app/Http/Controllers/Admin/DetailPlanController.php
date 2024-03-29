<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateDetailPlan;
use App\Models\DetailPlan;
use App\Models\Plan;


class DetailPlanController extends Controller
{
    protected $repository, $plan;

     public function __construct(DetailPlan $detailPlan, Plan $plan)
    {
        $this->repository = $detailPlan;
        $this->plan = $plan;
    }

    public function index($urlPlan){

        if(!$plan = $this->plan->where('url',$urlPlan)->first()){
            return redirect()->back();
        }


        $details = $plan->details()->paginate(); //retorno os detalhes do plano


       return view('admin.pages.plans.details.index',[
        'plan' => $plan,
             'details' => $details
       ]);

    }

    public function create($urlPlan){

        if (!$plan = $this->plan->where('url', $urlPlan)->first()) {
            return redirect()->back();
        }

        return view('admin.pages.plans.details.create',[
            'plan' => $plan
        ]);
    }

    public function store(StoreUpdateDetailPlan $request, $urlPlan){
        if (!$plan = $this->plan->where('url', $urlPlan)->first()) {
            return redirect()->back();
        }

        //melhor jeito de fazer, já que temos o relacionamento com o plano
        //pego o plano recuperado acima, e usamos o metodo detalils que faz o realacionamento com detals e plan
        $plan->details()->create($request->all());

        return redirect()->route('details.plan.index',$plan->url);

        //uma forma de inserção,
        //recupera os dados, depois pega o id do plano, e inserir na table details_plans
      //  $data = $request->all();
       // $data['plan_id'] = $plan->id;
       // $this->repository->create($data);


    }

    public function edit($urlPlan,$idDetail){

        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);


        if (!$plan || !$detail) {
            return redirect()->back();
        }

        return view('admin.pages.plans.details.edit',[
            'plan' => $plan,
            'detail'=> $detail
        ]);
    }

    public function update(StoreUpdateDetailPlan $request, $urlPlan,$idDetail){

        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);


        if (!$plan || !$detail) {
            return redirect()->back();
        }

        $detail->update($request->all());
        return redirect()->route('details.plan.index',$plan->url);

    }


    public function show($urlPlan,$idDetail){

        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);


        if (!$plan || !$detail) {
            return redirect()->back();
        }

        return view('admin.pages.plans.details.show',[
            'plan' => $plan,
            'detail'=> $detail
        ]);
    }

    public function destroy($urlPlan,$idDetail){

        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);


        if (!$plan || !$detail) {
            return redirect()->back();
        }

        $detail->delete();
        return redirect()->route('details.plan.index',$plan->url)
                          ->with('message','Registro deletado com sucesso');

    }

}
