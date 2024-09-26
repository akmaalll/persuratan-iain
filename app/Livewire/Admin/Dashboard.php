<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Dashboard extends Component
{
//     public function render()
//     {
//         return view('livewire.admin.dashboard');
//     }
    public function home()
    {
        try {
            return view('app.welcome');
        } catch (\Exception $e) {
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }
}
