<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

/**
 * EmployeeExport to build the sheet with defined format
 * @author Zin Lin Htet
 * @created 23/06/2023
 */
class EmployeeExport implements WithHeadings, WithEvents, WithColumnWidths, ShouldAutoSize, WithStyles, WithTitle
{
    /**
     * Define the title name
     * @author Zin Lin Htet
     * @create 23/06/2023
     * @return string
     */
    public function title(): string
    {
        return 'EmployeeRegistration';
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
    public function headings(): array
    {
        return [
            'Employee Code',
            'Employee Name',
            'NRC Number',
            'Password',
            'Email Address',
            'Gender',
            'Date of Birth',
            'Marital Status',
            'Address',
            // Add more column headings as necessary
        ];
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
                $event->sheet->getRowDimension(1)->setRowHeight(35);

                // ID left align
                $event->sheet->getStyle('A')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                //Title center align
                $event->sheet->getStyle('B')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('C')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('D')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('E')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('F')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('G')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('H')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('I')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                //ID, description center align


                //vertical
                $event->sheet->getStyle('A')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $event->sheet->getStyle('B')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $event->sheet->getStyle('C')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $event->sheet->getStyle('D')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $event->sheet->getStyle('E')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $event->sheet->getStyle('F')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $event->sheet->getStyle('G')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $event->sheet->getStyle('H')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $event->sheet->getStyle('I')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);


                // Set the background color of column headers (A1, B1, C1, etc.)
                $event->sheet->getStyle('A1:I1')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => 'A1C2F1' // Replace with your desired color code
                        ],
                    ],
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                        'color' => [
                            'rgb' => '000000' // Replace with your desired font color
                        ],
                    ],
                ]);
                $event->sheet->getStyle('A1:E1')->applyFromArray([
                    'font' => [
                        'color' => [
                            'rgb' => 'ff0000' // Replace with your desired font color
                        ],
                    ],
                ]);
                $event->sheet->getStyle('G1')->applyFromArray([
                    'font' => [
                        'color' => [
                            'rgb' => 'ff0000' // Replace with your desired font color
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
            'A' => 20,  // Width of column A
            'B' => 20, // Width of column B
            'C' => 20, // Width of column C
            'D' => 15, // Width of column D
            'E' => 20, // Width of column E
            'F' => 15, // Width of column F
            'G' => 15, // Width of column G
            'H' => 17, // Width of column H
            'I' => 25, // Width of column I
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
            'A1:I1' => ['font' => ['size' => 14]],
            'A1:I1' => ['borders' => ['allBorders' => ['borderStyle' => 'thin', 'color' => ['rgb' => '000000']]]],
            'A2:I' . ($sheet->getHighestRow()) => ['borders' => ['allBorders' => ['borderStyle' => 'thin', 'color' => ['rgb' => '000000']]]],
        ];
    }
}
