<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    private $repository;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan;
    }

    public function index()
    {
        $plans = $this->repository->latest()->paginate();
                return view('admin.pages.plans.index',[
            'plans' => $plans
        ]);
    }



     public function create(){
        return view('admin.pages.plans.create');
    }

   public function store(StoreUpdatePlan $request){
        //dd($request->all());
        //cadastro atraves do repository que é um objeto de plan
        $data = $request->all();
         //inserir o URL com o nome ficou no observer
        $this->repository->create($data); //cria no banco

        return redirect()->route('plans.index'); //redireciona
    }




    public function show($url){

        //uso where pq não é id e sim string,
        //retorno pelo first = 1 objeto e não pelo get = varios objetos
        $plan = $this->repository->where('url',$url)->first();
        if(!$plan){
            return redirect()->back();
        }

        return view('admin.pages.plans.show',[
            'plan' => $plan
        ]);
    }

      public function destroy($url){

        //uso where pq não é id e sim string,
        //retorno pelo first = 1 objeto e não pelo get = varios objetos
        $plan = $this->repository
                                ->with('details')
                                ->where('url',$url)
                                ->first();

        if(!$plan){
            return redirect()->back();
        }

        //dd($plan->details->count());
        //retorna o relacionamento de planos e detalhes,
        //se o plano tiver detahes não vai deixar deletar
        if($plan->details->count() > 0 ){
            return redirect()
                            ->back()
                            ->with('error','Existem detalhes neste plano, favor deleta-los antes');
        }

        $plan->delete();
        return redirect()->route('plans.index')->with('message','Arquivo deletado com sucesso');
    }


    public function search(Request $request){
        //tem que pegar e enviar o filtro, pq existe paginação
        //se não enviar esse filter ao paginar, perde o filtro que estava, fica no url por get
        //faço a verificação na view paginate  = {!! $plans->appends($filters)->links() !!}
        //coloco exceção de trazer o _token
        $filters = $request->except('_token'); //na view só pega array
        $plans = $this->repository->search($request->filter);
        return view('admin.pages.plans.index',[
            'plans' => $plans,
            'filters' => $filters
        ]);
    }

     public function edit($url){

        //uso where pq não é id e sim string,
        //retorno pelo first = 1 objeto e não pelo get = varios objetos
        $plan = $this->repository->where('url',$url)->first();
        if(!$plan){
            return redirect()->back();
        }

        return view('admin.pages.plans.edit',[
            'plan' => $plan
        ]);
    }

    public function update(StoreUpdatePlan $request, $url){
        //uso where pq não é id e sim string,
        //retorno pelo first = 1 objeto e não pelo get = varios objetos
        $plan = $this->repository->where('url', $url)->first();
        if (!$plan) {
            return redirect()->back();
        }

        $plan->update($request->all());

        return redirect()->route('plans.index');
    }
}
