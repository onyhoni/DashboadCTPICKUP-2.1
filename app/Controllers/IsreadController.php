<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\IsRead;

class IsreadController extends BaseController
{

    public function store()
    {
        $IsRead = new IsRead();
        $IsRead->save([
            'message_id' => $this->request->getVar('id'),
            'read' => 1,
        ]);
    }
}
