<?php

namespace App\Exports;

use App\Models\Form;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FormResponsesExport implements FromCollection, WithHeadings, WithMapping, WithStyles
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
        // Setup kertas F4 (Folio) Landscape
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_FOLIO);
        
        // Fit ke lebar halaman supaya tidak terpotong
        $sheet->getPageSetup()->setFitToWidth(1);
        $sheet->getPageSetup()->setFitToHeight(0);

        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        // Mencegah tulisan nabrak (Wrap Text)
        $sheet->getStyle('A1:' . $highestColumn . $highestRow)->getAlignment()->setWrapText(true);
        $sheet->getStyle('A1:' . $highestColumn . $highestRow)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);

        // Atur lebar kolom statis supaya rapi
        $sheet->getColumnDimension('A')->setWidth(20); // Waktu Submit
        
        $highestColIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
        for ($col = 2; $col <= $highestColIndex; $col++) {
            $colString = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col);
            $sheet->getColumnDimension($colString)->setWidth(35); // Lebar proporsional untuk jawaban
        }

        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
