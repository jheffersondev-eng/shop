<?php

namespace App\Http\Controllers;

use App\Repositories\BaseRepository;
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

    /**
     * UserController constructor.
     * @param $repository
     */
    public function __construct($repository = null)
    {
        $this->repository = $repository;
    }

    /**
     * @return string
     */
    public function getPages(): string
    {
        return $this->pages;
    }

    /**
     * @param string $pages
     */
    public function setPages(string $pages): void
    {
        $this->pages = $pages;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getFolderView(): string
    {
        return $this->folder_view;
    }

    /**
     * @param string $folder_view
     */
    public function setFolderView(string $folder_view): void
    {
        $this->folder_view = $folder_view;
    }

    /**
     * @param string $models
     */
    public function setModels(string $models): void
    {
        $this->models = $models;
    }

    /**
     * @return BaseRepository
     */
    public function getRepository(): BaseRepository
    {
        return $this->repository;
    }

    /**
     * @param BaseRepository $repository
     */
    public function setRepository(BaseRepository $repository): void
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     */
    public function getOrderList(): array
    {
        return $this->orderList;
    }

    /**
     * @param array $orderList
     */
    public function setOrderList(array $orderList): void
    {
        $this->orderList = $orderList;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getModelName(): string
    {
        return $this->models ?? 'models';
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * ]
     * @param Request $request
     * @return Application|Factory|View
     * @throws \Exception
     */
    public function indexBase(Request $request)
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
    public function createBase()
    {
        return view($this->getFolderView() . ".create", [
            'url' => $this->getUrl()
        ]);
    }

    /**
     * @param $request
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function storeBase($request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $request->request->add([
                'user_id_update' => Auth::user()->id,
                'user_id_create' => Auth::user()->id,
            ]);

            //$this->getRepository()->store($request);

            if (isset($request->observacao) and isset($request->status)){
                $request->session()->flash('message', " Status do {$this->getName()} alterado");
            }else{
                $request->session()->flash('message', "{$this->getName()} cadastrado");
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

            return Redirect::back()->withInput($request->all());
        }

        return Redirect::to($this->getUrl());
    }

    /**
     * @param $model
     * @return Factory|View
     */
    public function editBase($model)
    {
        return view($this->getFolderView() . ".edit", [
            'model' => $model,
            'url' => $this->getUrl()
        ]);
    }

    /**
     * @param $request
     * @param $model
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function updateBase($model, $request): RedirectResponse
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
     * @param $request
     * @param $model
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function destroyBase($model, $request): RedirectResponse
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
}