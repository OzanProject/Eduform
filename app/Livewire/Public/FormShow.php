<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use App\Models\Form;

#[Layout('components.layouts.public')]
class FormShow extends Component
{
    use WithFileUploads;

    public $slug;
    public $form;
    public $answers = [];
    public $isSubmitted = false;
    public $errorMessage = null;
    public $isNotRobot = false;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->form = Form::where('slug', $slug)->with(['questions' => function($q) {
            $q->orderBy('order');
        }, 'questions.options'])->firstOrFail();

        if (!$this->form->is_active) {
            $this->errorMessage = 'Formulir ini sudah tidak menerima respon lagi.';
            return;
        }

        // Initialize answers array
        foreach ($this->form->questions as $q) {
            if ($q->type === 'checkbox') {
                $this->answers[$q->id] = [];
            } else {
                $this->answers[$q->id] = null;
            }
        }
    }

    public function submit()
    {
        if (!$this->form->is_active) {
            return;
        }

        // Build validation rules dynamically
        $rules = [];
        $messages = [];

        foreach ($this->form->questions as $q) {
            $field = 'answers.' . $q->id;
            $ruleSet = [];

            if ($q->is_required) {
                $ruleSet[] = 'required';
                $messages[$field . '.required'] = 'Pertanyaan ini wajib diisi.';
            } else {
                $ruleSet[] = 'nullable';
            }

            if ($q->type === 'file_upload') {
                $ruleSet[] = 'file';
                $ruleSet[] = 'max:5120'; // 5MB max
                $messages[$field . '.max'] = 'Ukuran file maksimal 5MB.';
            } elseif ($q->type === 'checkbox') {
                $ruleSet[] = 'array';
            }

            $rules[$field] = $ruleSet;
        }

        $rules['isNotRobot'] = 'accepted';
        $messages['isNotRobot.accepted'] = 'Harap centang kotak verifikasi bahwa Anda bukan robot.';

        $this->validate($rules, $messages);

        // Save Response
        $response = $this->form->responses()->create([
            'session_id' => session()->getId(),
        ]);

        foreach ($this->form->questions as $q) {
            $answerVal = $this->answers[$q->id] ?? null;
            $answerText = null;

            if (empty($answerVal) && $answerVal !== '0' && $answerVal !== 0) {
                continue; // Skip empty non-required answers
            }

            if ($q->type === 'file_upload') {
                if ($answerVal instanceof \Illuminate\Http\UploadedFile) {
                    $path = $answerVal->store('responses', 'public');
                    $answerText = $path;
                }
            } elseif ($q->type === 'checkbox') {
                if (is_array($answerVal) && count($answerVal) > 0) {
                    $answerText = implode(', ', $answerVal);
                } else {
                    continue;
                }
            } else {
                $answerText = (string) $answerVal;
            }

            $response->answers()->create([
                'question_id' => $q->id,
                'value' => $answerText,
            ]);
        }

        $this->isSubmitted = true;
    }

    public function render()
    {
        return view('livewire.public.form-show')->title($this->form->title ?? 'Formulir');
    }
}
