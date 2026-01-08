<?php

namespace App\Http\Controllers\Login;

use Illuminate\View\View;

class HomeController 
{

    protected function getFolderView(): string
    {
        return "home";
    }

    protected function getUrl(): string
    {
        return "login";
    }

    protected function getName(): string
    {
        return "Login";
    }

    public function about(): View
    {
        return view( $this->getFolderView(). ".index", [
            'url' => $this->getUrl(),
            'title' => $this->getName()
        ]);
    }
}