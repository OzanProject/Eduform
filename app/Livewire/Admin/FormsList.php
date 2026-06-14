<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Form;

#[Layout('components.layouts.admin')]
class FormsList extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function toggleActive($formId)
    {
        $form = Form::where('user_id', auth()->id())->findOrFail($formId);
        $form->is_active = !$form->is_active;
        $form->save();
    }

    #[\Livewire\Attributes\On('delete-form')]
    public function performDelete($params)
    {
        $id = $params['id'];
        $form = Form::where('user_id', auth()->id())->findOrFail($id);
        
        // hapus semua pertanyaan
        $form->questions()->delete();
        // hapus formulir
        $form->delete();

        $this->dispatch('swal:toast', [
            'icon' => 'success',
            'title' => 'Formulir berhasil dihapus.'
        ]);
    }

    public function render()
    {
        $forms = Form::where('user_id', auth()->id())
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('slug', 'like', '%' . $this->search . '%');
            })
            ->withCount(['questions', 'responses'])
            ->latest()
            ->paginate(10);

        return view('livewire.admin.forms-list', [
            'forms' => $forms
        ])->title('Formulir');
    }
}
