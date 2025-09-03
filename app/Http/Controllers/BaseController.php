<?php

namespace App\Http\Controllers;

use App\Repositories\BaseRepository;
use App\Services\MediatorService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

/**
 * Class BaseController
 * @package App\Http\Controllers
 */
abstract class BaseController extends Controller
{
    // Use protected para facilitar herança
    protected string $pages;
    protected string $url;
    protected string $folder_view;
    protected string $models;
    protected string $name;
    protected array $orderList = ['created_at', 'desc'];
    protected BaseRepository $repository;
    protected MediatorService $mediator;

    public function __construct($repository = null, ?MediatorService $mediator = null)
    {
        $this->repository = $repository;
        $this->mediator = $mediator ?? new MediatorService();
    }

    public function getPages(): string
    {
        return $this->pages;
    }

    public function setPages(string $pages): void
    {
        $this->pages = $pages;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function getFolderView(): string
    {
        return $this->folder_view;
    }

    public function setFolderView(string $folder_view): void
    {
        $this->folder_view = $folder_view;
    }

    public function setModels(string $models): void
    {
        $this->models = $models;
    }

    public function getRepository(): BaseRepository
    {
        return $this->repository;
    }

    public function setRepository(BaseRepository $repository): void
    {
        $this->repository = $repository;
    }

    // Removido: getService e setService

    public function getOrderList(): array
    {
        return $this->orderList;
    }

    public function setOrderList(array $orderList): void
    {
        $this->orderList = $orderList;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getModelName(): string
    {
        return $this->models ?? 'models';
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Application|Factory|View
     * @throws \Exception
     */
    public function IndexBase(Request $request)
    {
        $this->getRepository()->findBy($request->all())->order($this->getOrderList()[0], $this->getOrderList()[1]);
        /**
         * @var LengthAwarePaginator $models
         */
        $models = $this->getRepository()->paginate($this->getPages());
        $models->appends($request->except('page'));

        return view( $this->getFolderView(). ".index", [
            'url' => $this->getUrl(),
            'title' => $this->getName(),
            $this->getModelName() => $models,
        ]);
    }

    /**
     * @return Factory|View
     */
    public function CreateBase()
    {
        return view($this->getFolderView() . ".create", [
            'url' => $this->getUrl()
        ]);
    }

    /**
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function StoreBase($request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            if(Auth::user()) {
                $request->request->add([
                    'user_id_update' => Auth::user()->id,
                    'user_id_create' => Auth::user()->id,
                ]);
            }

            // Chama o Mediator para resolver o service correto, se existir
            if($this->mediator) {
                $this->mediator->handle($request);
            }

            $this->getRepository()->store($request);

            if (isset($request->descriptionMessage) and isset($request->status)){
                $request->session()->flash('message', "{$this->getName()}");
            }else{
                $request->session()->flash('message', "{$this->getName()} cadastrado com sucesso");
            }

            DB::commit();
        } catch (\Exception $e) {
            $request->session()->flash('error', "Erro ao cadastrar o {$this->getName()}:  {$e->getMessage()}");

            DB::rollBack();

            Log::critical($e->getMessage(), [
                'url' => url()->current(),
                'method' => \request()->method(),
                'params' => \request()->all(),
            ]);

            return redirect()->back()->withInput($request->all());
        }
        
        return Redirect::to($this->getUrl());
    }

    /**
     * @return Factory|View
     */
    public function EditBase($model)
    {
        return view($this->getFolderView() . ".edit", [
            'model' => $model,
            'url' => $this->getUrl()
        ]);
    }

    /**
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function UpdateBase($model, $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $request->request->add([
                'user_id_update' => Auth::user()->id
            ]);

            //$this->getRepository()->replace($model, $request);

            $request->session()->flash('message', "{$this->getName()} atualizado");
            DB::commit();
        } catch (\Exception $e) {
            $request->session()->flash('error', "Erro ao atualizar o {$this->getName()}: {$e->getMessage()}");
            DB::rollBack();

            Log::critical($e->getMessage(), [
                'url' => url()->current(),
                'method' => \request()->method(),
                'params' => \request()->all(),
            ]);

            return Redirect::back()->withInput($request->all());
        }

        return Redirect::back();
    }

    /**
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function DestroyBase($model, $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $this->getRepository()->delete($model);

            $request->session()->flash('message', "{$this->getName()} removido");
            DB::commit();
        } catch (\Exception $e) {
            $request->session()->flash('error', "Problema ao remover o {$this->getName()}: {$e->getMessage()}");

            Log::critical($e->getMessage(), [
                'url' => url()->current(),
                'method' => \request()->method(),
                'params' => \request()->all(),
            ]);

            DB::rollBack();
        }

        return Redirect::back();
    }

    public function RedirectBase(
        Request $request, 
        string $message, 
        ?string $url = null
    ): RedirectResponse
    {
        if($this->mediator) {
            try {
                $this->mediator->handle($request);
                $request->session()->flash('success', $message);
            } catch (\Exception $e) {
                dd($e->getMessage());
                $request->session()->flash('error', $e->getMessage());
                return Redirect::to($url ?? $this->getUrl());
            }
        }
        return Redirect::to($url ?? $this->getUrl());
    }
}