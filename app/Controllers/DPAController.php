<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DPAModel;
use App\Models\DetailDPAModel;
use App\Models\SubkegiatanModel;
use App\Models\SubRincianObjekModel;
use App\Models\DetailDPASubkegiatanModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DPAController extends BaseController
{
    protected $DetailDPAModel;
    protected $DPAModel;
    protected $SubkegiatanModel;
    protected $SubRincianObjekModel;
    protected $DetailDPASubkegiatanModel;
    public function __construct()
    {
        $this->DetailDPAModel = new DetailDPAModel();
        $this->DPAModel = new DPAModel();
        $this->SubkegiatanModel = new SubkegiatanModel();
        $this->SubRincianObjekModel = new SubRincianObjekModel();
        $this->DetailDPASubkegiatanModel = new DetailDPASubkegiatanModel();
    }

    public function index()
    {
        $data['dpa'] = $this->DPAModel->findAll();
        return view('dpa/index', $data);
    }

    public function create()
    {
        return view('dpa/create');
    }

    public function store()
    {
        $data = [
            'nomor_dpa' => $this->request->getPost('nomor_dpa'),
        ];

        $this->DPAModel->insert($data);

        return redirect()->to('/dpa');
    }


    public function edit($id)
    {
        $data = [
            'dpa' => $this->DPAModel->find($id),
        ];
        return view('dpa/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'nomor_dpa' => $this->request->getPost('nomor_dpa'),
        ];

        $this->DPAModel->update($id, $data);

        return redirect()->to('dpa');
    }

    public function destroy($id)
    {
        $this->DPAModel->delete($id);

        return redirect()->to('/dpa');
    }

    public function cetakExcel($id)
    {
        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $dpa = $this->DPAModel->find($id);
        $detaildpa = $this->DetailDPAModel->getDetailDPA($id);

        // Set the values in the cells as per your requirement
        // Headers and Main Titles
        $sheet->setCellValue('A1', 'Nomor DPA');
        $sheet->setCellValue('B1', $dpa['nomor_dpa']);

        // Bold the Nomor DPA row
        $sheet->getStyle('A1:B1')->getFont()->setBold(true);

        $startRow = 2;
        foreach ($detaildpa as $row) {
            $row['jumlahdpa'] = $this->DetailDPAModel->getTotalJumlah($row['id']);
            $detailsub = $this->DetailDPASubkegiatanModel->where('id_detail_dpa', $row['id'])->getDetailDPASubkegiatan($row['id']);

            // Initialize $data with the initial data
            $data = [
                ['Sub Kegiatan', $row['kode_urusan'] . '.' . $row['kode_bidang_urusan'] . '.' . $row['kode_program'] . '.' . $row['kode_kegiatan'] . '.' . $row['kode_subkegiatan'] . ' - ' . $row['nama_subkegiatan']],
                ['Kode Rek', 'Uraian', 'Koefisien', 'Satuan', 'Harga', 'PPN', 'Jumlah (Rp)', 'Keterangan'],
                [$row['kode_akun'], $row['uraian_akun'], '', '', '', '', 'Rp ' . number_format($row['jumlahdpa'], 0, ',', '.'), ''],
                [$row['kode_akun'] . '.' . $row['kode_kelompok'], $row['uraian_kelompok'], '', '', '', '', 'Rp ' . number_format($row['jumlahdpa'], 0, ',', '.'), ''],
                [$row['kode_akun'] . '.' . $row['kode_kelompok'] . '.' . $row['kode_jenis'], $row['uraian_jenis'], '', '', '', '', 'Rp ' . number_format($row['jumlahdpa'], 0, ',', '.'), ''],
                [$row['kode_akun'] . '.' . $row['kode_kelompok'] . '.' . $row['kode_jenis'] . '.' . $row['kode_objek'], $row['uraian_objek'], '', '', '', '', 'Rp ' . number_format($row['jumlahdpa'], 0, ',', '.'), ''],
                [$row['kode_akun'] . '.' . $row['kode_kelompok'] . '.' . $row['kode_jenis'] . '.' . $row['kode_objek'] . '.' . $row['kode_rincian_objek'], $row['uraian_rincian_objek'], '', '', '', '', 'Rp ' . number_format($row['jumlahdpa'], 0, ',', '.'), ''],
                [$row['kode_akun'] . '.' . $row['kode_kelompok'] . '.' . $row['kode_jenis'] . '.' . $row['kode_objek'] . '.' . $row['kode_rincian_objek'] . '.' . $row['kode_sub_rincian_objek'], $row['uraian_sub_rincian_objek'], '', '', '', '', 'Rp ' . number_format($row['jumlahdpa'], 0, ',', '.'), ''],
            ];

            // Save the starting row for details to apply border later
            $startDetailRow = $startRow + 1;

            // Add data from $detailsub to $data
            if (!empty($detailsub)) {
                foreach ($detailsub as $detail) {
                    $data[] = ['', $detail['uraian'], $detail['koefisien'], $detail['satuan'], 'Rp ' . number_format($detail['harga'], 0, ',', '.'), 'Rp ' . number_format($detail['ppn'], 0, ',', '.'), 'Rp ' . number_format($detail['jumlah'], 0, ',', '.'), $detail['keterangan']];
                }
            }

            // Process data for each row
            foreach ($data as $rowIndex => $rowData) {
                $col = 'A';
                foreach ($rowData as $cellData) {
                    $sheet->setCellValueExplicit($col . $startRow, (string) $cellData, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                    $col++;
                }

                // Apply full border and bold text to "Kode Rek" row
                if ($rowIndex == 1) {
                    $sheet->getStyle("A$startRow:H$startRow")->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            ],
                        ],
                        'font' => [
                            'bold' => true,
                        ],
                    ]);
                }

                $startRow++;
            }

            // Apply outline border to detail rows
            $sheet->getStyle("A$startDetailRow:H" . ($startRow - 1))->applyFromArray([
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ]);

            // Add two empty rows without border
            $startRow += 2;
        }

        // Auto size columns
        foreach (range('A', 'H') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Save the spreadsheet
        $writer = new Xlsx($spreadsheet);

        // Generate file for download
        $filename = 'data DPA.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }



}
