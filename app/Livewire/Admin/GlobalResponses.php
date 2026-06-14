<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Response;

#[Layout('components.layouts.admin')]
class GlobalResponses extends Component
{
    use WithPagination;

    public function render()
    {
        // Fetch responses belonging to the user's forms
        $responses = Response::whereHas('form', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->with(['form', 'answers.question'])
            ->latest()
            ->paginate(15);

        return view('livewire.admin.global-responses', [
            'responses' => $responses
        ])->title('Semua Respon');
    }
}
