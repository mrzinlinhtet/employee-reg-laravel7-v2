<?php

namespace App\Exports;


use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

/**
 * GenderExport to build the sheet with defined format
 * @author Zin Lin Htet
 * @created 23/06/2023
 */
class GenderExport implements FromCollection, WithTitle, WithEvents, WithColumnWidths, ShouldAutoSize, WithStyles
{
    /**
     * Define the title name
     * @author Zin Lin Htet
     * @create 23/06/2023
     * @return string
     */
    public function title(): string
    {
        return 'Gender';
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    /**
     * Define the headings name
     * @author Zin Lin Htet
     * @create 23/06/2023
     * @return array
     */
    public function collection()
    {
        //define default value of gender
        $data = [
            ["Gender List"],
            ['ID', 'Gender Name'],
            ['ID' => '1', 'Gender Name' => 'Male'],
            ['ID' => '2', 'Gender Name' => 'Female']
        ];

        return collect([$data]);
    }

    /**
     * Define the style of the excel
     * @author Zin Lin Htet
     * @create 23/06/2023
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {


                // Set the height of rows
                $event->sheet->getRowDimension(1)->setRowHeight(20);
                $event->sheet->getRowDimension(2)->setRowHeight(20);
                $event->sheet->getRowDimension(3)->setRowHeight(25);
                $event->sheet->getRowDimension(4)->setRowHeight(25);

                // ID left align
                $event->sheet->getStyle('A')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                //Title center align
                $event->sheet->getStyle('B')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                //ID, description center align


                //vertical
                $event->sheet->getStyle('A')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $event->sheet->getStyle('B')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

                // Set the background color of column headers (A1, B1, C1, etc.)
                $event->sheet->getStyle('A2:B2')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => 'A1C2F1' // Replace with your desired color code
                        ],
                    ],
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                        'color' => [
                            'rgb' => '000000' // Replace with your desired font color
                        ],
                    ],
                ]);
            },
        ];
    }

    /**
     * Define columnWidths of excel table
     * @author Zin Lin Htet
     * @create 23/06/2023
     * @return array
     */
    public function columnWidths(): array
    {
        return [
            'A' => 15,  // Width of column A
            'B' => 15
            // Add more column width definitions as needed
        ];
    }

    /**
     * Define styles of excel table
     * @author Zin Lin Htet
     * @create 23/06/2023
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
            'A1:B1' => ['font' => ['size' => 14]],
            'A2:B2' => ['borders' => ['allBorders' => ['borderStyle' => 'thin', 'color' => ['rgb' => '000000']]]],
            'A2:B' . ($sheet->getHighestRow()) => ['borders' => ['allBorders' => ['borderStyle' => 'thin', 'color' => ['rgb' => '000000']]]],
        ];
    }
}
