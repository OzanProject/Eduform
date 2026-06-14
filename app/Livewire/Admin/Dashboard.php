<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Form;
use App\Models\Response;

#[Layout('components.layouts.admin')]
class Dashboard extends Component
{
    public function render()
    {
        $userId = auth()->id();

        $stats = [
            'total_forms' => Form::where('user_id', $userId)->count(),
            'active_forms' => Form::where('user_id', $userId)->where('is_active', true)->count(),
            'total_responses' => Response::whereHas('form', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->count(),
            'recent_forms' => Form::where('user_id', $userId)
                ->withCount('responses')
                ->latest()
                ->take(5)
                ->get()
        ];

        return view('livewire.admin.dashboard', [
            'stats' => $stats
        ])->title('Beranda');
    }
}
