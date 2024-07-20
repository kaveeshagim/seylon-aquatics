<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Metric;

class Dashboard extends Component
{

    public $metrics = [];

    protected $listeners = ['refreshMetrics' => 'loadMetrics'];

    public function mount()
    {
        $this->loadMetrics();
    }

    public function loadMetrics()
    {
        $this->metrics = Metric::all()->toArray();
    }

    public function render()
    {
        return view('livewire.dashboard')
        ->layout('components.layouts.app');
    }
}








