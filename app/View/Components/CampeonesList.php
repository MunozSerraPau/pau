<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Campeon;

class CampeonesList extends Component
{
    public $campeones;

    public function __construct($perPage = 9, $order = 'asc')
    {
        $this->campeones = Campeon::orderBy('name', $order)
            ->paginate($perPage)
            ->appends(['perPage' => $perPage, 'order' => $order]);
    }

    public function render()
    {
        return view('components.campeones-list', ['campeones' => $this->campeones]);
    }
}
