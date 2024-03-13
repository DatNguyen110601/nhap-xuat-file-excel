<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\ThongTinUngVien;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
// use Maatwebsite\Excel\Concerns\WithTemplate;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class ThongTinUngVienExport implements FromCollection,WithHeadings,WithMapping,WithEvents
{

    protected $thongTinUngVien;

    public function __construct($thongTinUngVien)
    {
        $this->thongTinUngVien = $thongTinUngVien;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        return $this->thongTinUngVien;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Set title
                $title = 'THÔNG TIN BẮT BUỘC CỦA ỨNG VIÊN KHI ỨNG TUYỂN TẢI 3DS';
                $event->sheet->mergeCells('A1:J1'); // Merge cells for the title
                $event->sheet->setCellValue('A1', $title); // Set the title text
                $event->sheet->getStyle('A1')->applyFromArray([
                    'font'      => ['bold' => true, 'size' => 11, 'color' => ['argb' => 'FF0000']], // Bold font, size 11
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER ,
                        'vertical' => Alignment::VERTICAL_CENTER,
                        'wrapText' => true
                    ], // Center-align text
                    'fill'      => [
                        'fillType'   => Fill::FILL_SOLID,
                    ],
                ]);

                // Set column headings
                $headings = $this->headings();
                foreach ($headings as $index => $heading) {
                    $column = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($index + 1);
                    $event->sheet->setCellValue($column . '2', $heading);
                }

                $event->sheet->getStyle('A2:J2')->applyFromArray([
                    'font'      => ['bold' => true], // Make font bold
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER, // Center-align text horizontally
                        'vertical' => Alignment::VERTICAL_CENTER, // Middle-align text vertically
                        'wrapText' => true
                    ],
                    'fill'      => [
                        'fillType'   => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '93ccea'] // Set background color
                    ],
                ]);

                // Set content starting from row 3
                $row = 3;
                foreach ($this->collection() as $user) {
                    $rowData = $this->map($user);
                    foreach ($rowData as $index => $value) {
                        $column = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($index + 1);
                        $event->sheet->setCellValue($column . $row, $value);
                    }
                    $row++;
                }

                // Set height for the headings row
                $event->sheet->getRowDimension(2)->setRowHeight(50);
                $event->sheet->getColumnDimension('A')->setWidth(20);
                $event->sheet->getColumnDimension('B')->setWidth(20);
                $event->sheet->getColumnDimension('C')->setWidth(20);
                $event->sheet->getColumnDimension('D')->setWidth(20);
                $event->sheet->getColumnDimension('E')->setWidth(20);
                $event->sheet->getColumnDimension('F')->setWidth(20);
                $event->sheet->getColumnDimension('G')->setWidth(20);
                $event->sheet->getColumnDimension('H')->setWidth(20);
                $event->sheet->getColumnDimension('I')->setWidth(20);
                $event->sheet->getColumnDimension('J')->setWidth(20);


                // Apply borders to all cells
                $lastRow = $event->sheet->getDelegate(2)->getHighestRow();
                $lastColumn = $event->sheet->getDelegate()->getHighestColumn();
                $cellRange = 'A2:' . $lastColumn . $lastRow;
                $event->sheet->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN, // Add thin border around cells
                            'color' => ['rgb' => '000000'], // Border color
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER, // Center-align text horizontally
                        'vertical' => Alignment::VERTICAL_CENTER, // Middle-align text vertically
                    ],
                ]);
            },
        ];
    }



    /**
     * Returns headers for report
     * @return array
     */
    public function headings(): array {
        return [
            'Họ tên',
            'Ngày tháng năm sinh',
            'Vị trí ứng tuyển',
            'Số điện thoại',
            'Số zalo',
            'Email',
            'Trình độ học vấn',
            'Địa chỉ đang ở',
            'Add CV',
            'Nguồn'

        ];
    }

    public function map($thongTinUngVien): array {
        return [
            $thongTinUngVien->ho_ten,
            $thongTinUngVien->ngay_sinh,
            $thongTinUngVien->vi_tri,
            $thongTinUngVien->dien_thoai,
            $thongTinUngVien->so_zalo,
            $thongTinUngVien->email,
            $thongTinUngVien->trinh_do,
            $thongTinUngVien->dia_chi,
            $thongTinUngVien->url_cv,
            $thongTinUngVien->nguon
        ];
    }

}
