<?php

namespace App\Exports;

use App\Models\Form;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FormResponsesExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $form;

    public function __construct(Form $form)
    {
        $this->form = $form;
    }

    public function collection()
    {
        return $this->form->responses()->with('answers.question')->latest()->get();
    }

    public function headings(): array
    {
        $headings = ['Waktu Submit'];
        
        foreach ($this->form->questions as $question) {
            $headings[] = $question->text;
        }

        return $headings;
    }

    public function map($response): array
    {
        $row = [
            $response->created_at->format('Y-m-d H:i:s'),
        ];

        foreach ($this->form->questions as $question) {
            $ans = $response->answers->firstWhere('question_id', $question->id);
            $val = $ans ? $ans->value : '';

            if ($question->type === 'file_upload' && $val) {
                // If it's a file, provide the full URL
                $val = url('storage/' . $val);
            }

            $row[] = $val;
        }

        return $row;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
