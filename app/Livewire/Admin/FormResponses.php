<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Form;
use App\Models\Response;

#[Layout('components.layouts.admin')]
class FormResponses extends Component
{
    use WithPagination;

    public $form;
    public $deleteId = null;
    public $search = '';
    public $perPage = 10;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function mount($form)
    {
        // Pastikan form milik user yang sedang login
        $this->form = Form::where('user_id', auth()->id())
            ->with(['questions' => function ($q) {
                $q->orderBy('order');
            }])
            ->findOrFail($form);
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function cancelDelete()
    {
        $this->deleteId = null;
    }

    public function deleteResponse()
    {
        if ($this->deleteId) {
            $response = $this->form->responses()->find($this->deleteId);
            if ($response) {
                // Delete associated files if any
                foreach ($response->answers as $ans) {
                    if ($ans->question->type === 'file_upload' && $ans->value) {
                        \Illuminate\Support\Facades\Storage::disk('public')->delete($ans->value);
                    }
                }
                $response->delete();
            }
            $this->deleteId = null;
        }
    }
    public function exportExcel()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\FormResponsesExport($this->form), 
            $this->form->slug . '-responses.xlsx'
        );
    }

    public function exportPdf()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\FormResponsesExport($this->form), 
            $this->form->slug . '-responses.pdf',
            \Maatwebsite\Excel\Excel::DOMPDF
        );
    }

    public function render()
    {
        $query = $this->form->responses()
            ->with('answers');

        if (!empty($this->search)) {
            $query->whereHas('answers', function($q) {
                $q->where('value', 'like', '%' . $this->search . '%');
            });
        }

        $responses = $query->latest()
            ->paginate($this->perPage);

        return view('livewire.admin.form-responses', [
            'responses' => $responses
        ])->title('Respon - ' . $this->form->title);
    }
}
