<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Campeon;

class CampeonesList extends Component
{
    public $campeones;

    public function __construct()
    {
        $this->campeones = Campeon::all();
    }

    public function render()
    {
        return view('components.campeones-list');
    }
}
