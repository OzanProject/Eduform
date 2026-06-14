<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Form;
use App\Models\Question;
use App\Models\Option;

#[Layout('components.layouts.admin')]
class FormBuilder extends Component
{
    use WithFileUploads;

    public ?Form $formModel = null;
    public $isNew = true;

    // Form settings
    public $title = '';
    public $slug = '';
    public $description = '';
    public $is_active = true;
    public $confirmation_message = 'Terima kasih, respon Anda telah direkam.';
    public $headerImage = null;
    public $existingHeaderImage = null;

    // State
    public $questions = [];
    public $activeTab = 'questions';
    public $activeQuestionId = null;

    protected $rules = [
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:forms,slug',
        'questions.*.label' => 'required|string',
        'questions.*.type' => 'required|string',
    ];

    public function mount(Form $form = null)
    {
        if ($form && $form->exists) {
            $this->isNew = false;
            $this->formModel = $form;
            $this->title = $form->title;
            $this->slug = $form->slug;
            $this->description = $form->description;
            $this->is_active = $form->is_active;
            $this->confirmation_message = $form->confirmation_message;
            $this->existingHeaderImage = $form->header_image;

            // Load questions
            $loadedQuestions = $form->questions()->orderBy('order')->with('options')->get();
            foreach ($loadedQuestions as $q) {
                $this->questions[] = [
                    'id' => $q->id,
                    'type' => $q->type,
                    'label' => $q->text,
                    'description' => $q->description,
                    'is_required' => $q->is_required,
                    'options' => $q->options->pluck('value')->toArray(),
                    'order' => $q->order,
                ];
            }
            if (count($this->questions) > 0) {
                $this->activeQuestionId = $this->questions[0]['id'];
            }
        }
    }

    public function updatedTitle($value)
    {
        if ($this->isNew) {
            $this->slug = Str::slug($value);
        }
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function setActiveQuestion($id)
    {
        $this->activeQuestionId = $id;
    }

    public function addQuestion($type)
    {
        $newId = 'temp_' . uniqid();
        $hasOptions = in_array($type, ['radio', 'checkbox', 'dropdown']);
        
        $this->questions[] = [
            'id' => $newId,
            'type' => $type,
            'label' => 'Pertanyaan baru',
            'description' => '',
            'is_required' => false,
            'options' => $hasOptions ? ['Opsi 1'] : [],
            'order' => count($this->questions) + 1,
        ];
        
        $this->activeQuestionId = $newId;
    }

    public function removeQuestion($id)
    {
        $this->questions = collect($this->questions)->filter(function ($q) use ($id) {
            return $q['id'] !== $id;
        })->values()->toArray();

        if ($this->activeQuestionId === $id) {
            $this->activeQuestionId = count($this->questions) > 0 ? $this->questions[0]['id'] : null;
        }
    }

    public function moveQuestionUp($index)
    {
        if ($index > 0) {
            $temp = $this->questions[$index - 1];
            $this->questions[$index - 1] = $this->questions[$index];
            $this->questions[$index] = $temp;
        }
    }

    public function moveQuestionDown($index)
    {
        if ($index < count($this->questions) - 1) {
            $temp = $this->questions[$index + 1];
            $this->questions[$index + 1] = $this->questions[$index];
            $this->questions[$index] = $temp;
        }
    }

    public function addOption($questionIndex)
    {
        $currentCount = count($this->questions[$questionIndex]['options']);
        $this->questions[$questionIndex]['options'][] = 'Opsi ' . ($currentCount + 1);
    }

    public function removeOption($questionIndex, $optionIndex)
    {
        unset($this->questions[$questionIndex]['options'][$optionIndex]);
        $this->questions[$questionIndex]['options'] = array_values($this->questions[$questionIndex]['options']);
    }

    public function removeHeaderImage()
    {
        $this->headerImage = null;
        $this->existingHeaderImage = null;
    }

    public function save()
    {
        \Log::info("FormBuilder save() triggered! isNew: " . ($this->isNew ? 'true' : 'false'));
        try {
            $this->validate([
                'title' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:forms,slug,' . ($this->formModel->id ?? 'null'),
            ]);
            \Log::info("Validation passed. Title: " . $this->title);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::warning("Validation failed: " . json_encode($e->errors()));
            $this->activeTab = 'settings';
            throw $e;
        }

        $wasNew = $this->isNew;
        $formData = [
            'user_id' => auth()->id(),
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'is_active' => $this->is_active,
            'confirmation_message' => $this->confirmation_message,
        ];

        // Handle header image upload
        if ($this->headerImage) {
            // Delete old if exists
            if ($this->formModel && $this->formModel->header_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($this->formModel->header_image);
            }
            $path = $this->headerImage->store('headers', 'public');
            $formData['header_image'] = $path;
        } elseif (is_null($this->existingHeaderImage) && $this->formModel && $this->formModel->header_image) {
            // If existing is null but form model exists, it means user removed it
            \Illuminate\Support\Facades\Storage::disk('public')->delete($this->formModel->header_image);
            $formData['header_image'] = null;
        }

        // Save Form
        if ($this->isNew) {
            $this->formModel = Form::create($formData);
            $this->isNew = false;
        } else {
            $this->formModel->update($formData);
        }

        // Save Questions
        $existingQuestionIds = [];
        foreach ($this->questions as $index => $qData) {
            $order = $index + 1;
            
            if (str_starts_with($qData['id'], 'temp_')) {
                $q = $this->formModel->questions()->create([
                    'type' => $qData['type'],
                    'text' => $qData['label'],
                    'description' => $qData['description'] ?? null,
                    'is_required' => $qData['is_required'],
                    'order' => $order,
                ]);
                $this->questions[$index]['id'] = $q->id; // Update temp id to real id
                $existingQuestionIds[] = $q->id;
            } else {
                $q = Question::find($qData['id']);
                if ($q) {
                    $q->update([
                        'type' => $qData['type'],
                        'text' => $qData['label'],
                        'description' => $qData['description'] ?? null,
                        'is_required' => $qData['is_required'],
                        'order' => $order,
                    ]);
                    $existingQuestionIds[] = $q->id;
                }
            }

            // Sync Options
            if (in_array($qData['type'], ['radio', 'checkbox', 'dropdown'])) {
                // To prevent deleting and recreating if not changed, we can just delete all and recreate for simplicity since there are no foreign keys relying on options.
                $q->options()->delete();
                foreach ($qData['options'] as $optIndex => $optValue) {
                    $q->options()->create([
                        'value' => $optValue,
                        'order' => $optIndex + 1,
                    ]);
                }
            } else {
                $q->options()->delete();
            }
        }

        // Delete removed questions
        if (!empty($existingQuestionIds)) {
            $this->formModel->questions()->whereNotIn('id', $existingQuestionIds)->delete();
        } else {
            $this->formModel->questions()->delete();
        }

        if ($wasNew) {
            session()->flash('success', 'Formulir berhasil dibuat!');
            return redirect()->route('admin.forms.builder', $this->formModel->id);
        }

        $this->dispatch('swal:toast', [
            'icon' => 'success',
            'title' => 'Formulir berhasil disimpan!'
        ]);
        
        if ($this->activeQuestionId && str_starts_with($this->activeQuestionId, 'temp_')) {
            // Re-find the active question if it was a temp
            $this->activeQuestionId = $this->questions[0]['id'] ?? null;
        }
    }

    public function render()
    {
        return view('livewire.admin.form-builder')->title($this->title ?: 'Formulir Baru');
    }
}
