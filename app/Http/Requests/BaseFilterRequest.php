<?php

namespace App\Http\Requests;

class BaseFilterRequest extends BaseRequest
{
    protected function prepareForValidation()
    {
        $this->request->add([
            'baseId' => \session('base_id')
        ]);
    }
}