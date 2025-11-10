<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    public function __construct()
    {
        $this->setPages(10);
        $this->setName('Dashboard');
        $this->setOrderList(['id', 'asc']);
        $this->setUrl(url("dashboard"));
        $this->setFolderView("dashboard");
    }

    public function Index(Request $request)
    {
        return view('dashboard.index');
    }
}