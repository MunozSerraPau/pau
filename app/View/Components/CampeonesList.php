<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Campeon;

class CampeonesList extends Component
{
    public $campeones;

    public function __construct($perPage = 9)
    {
        $this->campeones = Campeon::paginate($perPage)->appends(['perPage' => $perPage]);
    }

    public function render()
    {
        return view('components.campeones-list', ['campeones' => $this->campeones]);
    }
}
