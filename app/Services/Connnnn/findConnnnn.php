<?php
namespace App\Services\Connnnn;

use App\Models\connnnn;

class findConnnnn 
{
    public function handle($id)
    {
        $connnnn = connnnn::find($id);

        return $connnnn;
    }
}