<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

/**
 * Create DownloadExport receive the data for export.
 * @author Zin Lin Htet
 * @created 26/6/2023
 */
class DownloadExport implements FromCollection, WithHeadings, WithEvents, WithColumnWidths, ShouldAutoSize, WithStyles, WithTitle
{
    private $employees;

    public function __construct($employees)
    {
        $this->employees = $employees;
    }

    /**
     * Define the title name
     * @author Zin Lin Htet
     * @create 23/6/2023
     * @return string
     */
    public function title(): string
    {
        return 'EmployeesList';
    }
    /**
     * collect the data return to export
     * @author Zin Lin Htet
     * @create 26/6/2023
     * @return '$collection'
     */
    public function collection()
    {
        $employees = $this->employees;
        $collection = new Collection();
        $no = 1; // Initialize the "No" value

        foreach ($employees as $employee) {
            if ($employee->gender == 1) {
                $gender = 'Male';
            } else {
                $gender = 'Female';
            }

            if ($employee->marital_status == 1) {
                $marital = 'Single';
            } elseif ($employee->marital_status == 2) {
                $marital = 'Married';
            } elseif ($employee->marital_status == 3) {
                $marital = 'Divorce';
            } else {
                $marital = ' ';
            }

            $collection->push([
                'No' =>  $no++,
                'Employee ID' => $employee->employee_id,
                'Employee Code' => $employee->employee_code,
                'Employee Name' => $employee->employee_name,
                'NRC Number' => $employee->nrc_number,
                'Email Address' => $employee->email_address,
                'Gender' => $gender,
                'Date of Birth' =>  $employee->date_of_birth,
                'Marital Status' => $marital,
                'Address' => $employee->address
            ]);
        }

        return $collection;
    }

    /**
     * @return array
     */
    /**
     * Define the heading name
     * @author Zin Lin Htet
     * @create 26/6/2023
     * @return string
     */
    public function headings(): array
    {
        // Define the column headings for the Excel file
        return [
            'No',
            'Employee ID',
            'Employee Code',
            'Employee Name',
            'NRC Number',
            'Email Address',
            'Gender',
            'Date of Birth',
            'Marital Status',
            'Address'

        ];
    }

    /**
     * Define the style of the excel
     * @author Zin Lin Htet
     * @create 23/6/2023
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
                $event->sheet->getStyle('J')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
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
                $event->sheet->getStyle('J')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);


                // Set the background color of column headers (A1, B1, C1, etc.)
                $event->sheet->getStyle('A1:J1')->applyFromArray([
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
                $event->sheet->getStyle('B1:F1')->applyFromArray([
                    'font' => [
                        'color' => [
                            'rgb' => 'ff0000' // Replace with your desired font color
                        ],
                    ],
                ]);
                $event->sheet->getStyle('H1')->applyFromArray([
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
     * @return array
     */
    /**
     * Define columnWidths of excel table
     * @author Zin Lin Htet
     * @create 26/6/2023
     * @return array
     */
    public function columnWidths(): array
    {
        // Define the column widths for the Excel file
        return [
            'A' => 10,
            'B' => 15,
            'C' => 20,
            'D' => 20,
            'E' => 20,
            'F' => 25,
            'G' => 10,
            'H' => 15,
            'I' => 20,
            'J' => 40,


        ];
    }

    /**
     * Define styles of excel table
     * @author Zin Lin Htet
     * @create 23/6/2023
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
            'A1:J1' => ['font' => ['size' => 14]],
            'A1:J1' => ['borders' => ['allBorders' => ['borderStyle' => 'thin', 'color' => ['rgb' => '000000']]]],
            'A2:J' . ($sheet->getHighestRow()) => ['borders' => ['allBorders' => ['borderStyle' => 'thin', 'color' => ['rgb' => '000000']]]],
        ];
    }
}
