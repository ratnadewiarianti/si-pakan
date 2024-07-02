<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SubRincianObjekModel;
use App\Models\DetailDPAModel;
use App\Models\RakBelanjaModel;
use App\Models\DetailRakBelanjaModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
class RakBelanjaController extends BaseController
{
    protected $DetailRakBelanjaModel;
    protected $SubRincianObjekModel;
    protected $RakBelanjaModel;
    protected $DetailDPAModel;
    public function __construct()
    {
        $this->SubRincianObjekModel = new SubRincianObjekModel();
        $this->RakBelanjaModel = new RakBelanjaModel();
        $this->DetailDPAModel = new DetailDPAModel();
        $this->DetailRakBelanjaModel = new DetailRakBelanjaModel();
    }

    public function cekwaktu()
    {
        return view('rakbelanja/cekwaktu');
    }

    public function index($waktu)
    {
        $data['rakbelanja'] = $this->RakBelanjaModel->findDatabyTime($waktu);
        foreach ($data['rakbelanja'] as &$rak) {
            $totalRak = $this->RakBelanjaModel->getTotalRak($rak['id']);
            $rak['total_rak'] = $totalRak;
        }
        return view('rakbelanja/index', $data);
    }


    public function create($waktu)
    {
        $data['rekening'] = $this->DetailDPAModel->getRekening();
        // $data['rekening'] = $this->SubRincianObjekModel->getRekening();
        return view('rakbelanja/create', $data);
    }

    public function getTotalJumlah($id)
    {
        try {
            $totalJumlah = $this->DetailDPAModel->getTotalJumlah($id);
            $jumlahRak = $this->RakBelanjaModel->where('id_detail_dpa', $id)->countAllResults();
            $totalNilaiRincian = 0;
            if ($jumlahRak > 0) {
                $totalNilaiRincian = $this->RakBelanjaModel->where('id_detail_dpa', $id)->selectSum('nilai_rincian')->get()->getRow()->nilai_rincian;
                $hasil = $totalJumlah - $totalNilaiRincian;
            }else{
                $hasil = $totalJumlah;
            }
            return $this->response->setJSON(['total_jumlah' => $hasil]);
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Terjadi kesalahan pada server.']);
        }
    }

    public function cekNilai($idDetailDPA, $nilaiRincian)
    {
        try {
            $totalJumlah = $this->DetailDPAModel->getTotalJumlah($idDetailDPA);
            $jumlahRak = $this->RakBelanjaModel->where('id_detail_dpa', $idDetailDPA)->countAllResults();
            $totalNilaiRincian = 0;

            if ($jumlahRak > 0) {
                $totalNilaiRincian = $this->RakBelanjaModel->where('id_detail_dpa', $idDetailDPA)->selectSum('nilai_rincian')->get()->getRow()->nilai_rincian;
                $hasil = $totalJumlah - $totalNilaiRincian;

                if ($nilaiRincian > $hasil) {
                    return $this->response->setJSON(['error' => 'Nilai rincian melebihi jumlah maksimal.']);
                }
            } else {
                if ($nilaiRincian > $totalJumlah) {
                    return $this->response->setJSON(['error' => 'Nilai rincian melebihi jumlah maksimal.']);
                }
            }

            return $this->response->setJSON(['success' => 'Nilai rincian valid.']);
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Terjadi kesalahan pada server.']);
        }
    }

    public function store()
    {
        
        $data = [
            // 'nm_subkegiatan' => $this->request->getPost('nm_subkegiatan'),
            'id_detail_dpa' => $this->request->getPost('id_detail_dpa'),
            'nilai_rincian' => $this->request->getPost('nilai_rincian'),
            'waktu' => $this->request->getPost('waktu'),
            'tahun' => session()->get('tahun')
        ];
        $waktu = $data['waktu'];


        $this->RakBelanjaModel->insert($data);

        return redirect()->to("/rakbelanja/index/$waktu");
     }


    public function edit($id)
    {
        $data = [
            'rakbelanja' => $this->RakBelanjaModel->find($id),
            'rekening' => $this->DetailDPAModel->getRekening()
        ];
        return view('rakbelanja/edit', $data);
    }

    public function update($id)
    {
        $data = [
            // 'nm_subkegiatan' => $this->request->getPost('nm_subkegiatan'),
            'id_detail_dpa' => $this->request->getPost('id_detail_dpa'),
            'nilai_rincian' => $this->request->getPost('nilai_rincian'),
            'waktu' => $this->request->getPost('waktu'),
        ];

        $this->RakBelanjaModel->update($id, $data);

        return redirect()->to('rakbelanja');
    }

    public function destroy($id)
    {
        $rak = $this->RakBelanjaModel->find($id);
        $waktu = $rak['waktu'];

        $this->RakBelanjaModel->delete($id);

        return redirect()->to("/rakbelanja/index/$waktu");
    }

    public function cetakExcel($waktu)
    {
        // Fetch data from the model
        $rakBelanjaData = $this->RakBelanjaModel->findDatabyTime($waktu);

        // Prepare header row
        $data = [
            ['Kode Akun', 'Nama Akun', 'Nilai Rincian', 'Total RAK', 'bulan1', 'bulan2', 'bulan3', 'bulan4', 'bulan5', 'bulan6', 'bulan7', 'bulan8', 'bulan9', 'bulan10', 'bulan11', 'bulan12']
        ];

        // Process data
        foreach ($rakBelanjaData as $rak) {
            $totalRak = $this->RakBelanjaModel->getTotalRak($rak['id']);

            // Initialize months array with '-'
            $months = array_fill(0, 12, '-');

            // Fetch detailrak data
            $detailRakData = $this->DetailRakBelanjaModel->where('id_rakbelanja', $rak['id'])->findAll();

            // Fill months array with data
            foreach ($detailRakData as $detail) {
                $monthIndex = $this->getMonthIndex($detail['bulan']);
                if ($monthIndex !== false) {
                    $months[$monthIndex] = $detail['nilai'];
                }
            }

            if (empty($totalRak)) {
                $totalRak = 0;
            }
            
            // Convert 0 values to '-'
            foreach ($months as &$month) {
                if ($month === 0) {
                    $month = '-';
                }
            }

            // Add row data with modified Nilai Rincian
            $data[] = [
                $rak['kode_rekening'],
                $rak['uraian_akun'],
                $rak['nilai_rincian'],
                $totalRak,
                ...$months
            ];
        }

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Fill spreadsheet with data
        $rowNumber = 1;
        foreach ($data as $row) {
            $columnNumber = 'A';
            foreach ($row as $cell) {
                $sheet->setCellValue($columnNumber . $rowNumber, $cell);
                $columnNumber++;
            }
            $rowNumber++;
        }

        // Set number format for number columns
        $numberColumns = ['C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P'];
        foreach ($numberColumns as $col) {
            // $sheet->getStyle($col . '2:' . $col . $rowNumber)
            //     ->getNumberFormat()
            //     ->setFormatCode(NumberFormat::FORMAT_NUMBER);
            $sheet->getStyle($col . '2:' . $col . $rowNumber)
                ->getNumberFormat()
                ->setFormatCode('#,##0');
        }
       

        // Set column widths
        $sheet->getColumnDimension('A')->setWidth(20); // Kode Akun
        $sheet->getColumnDimension('B')->setWidth(50); // Nama Akun
        $sheet->getColumnDimension('C')->setWidth(15); // Nilai Rincian
        $sheet->getColumnDimension('D')->setWidth(15); // Total RAK
        $sheet->getColumnDimension('E')->setWidth(15); // Bulan1
        $sheet->getColumnDimension('F')->setWidth(15); // Bulan2
        $sheet->getColumnDimension('G')->setWidth(15); // Bulan3
        $sheet->getColumnDimension('H')->setWidth(15); // Bulan4
        $sheet->getColumnDimension('I')->setWidth(15); // Bulan5
        $sheet->getColumnDimension('J')->setWidth(15); // Bulan6
        $sheet->getColumnDimension('K')->setWidth(15); // Bulan7
        $sheet->getColumnDimension('L')->setWidth(15); // Bulan8
        $sheet->getColumnDimension('M')->setWidth(15); // Bulan9
        $sheet->getColumnDimension('N')->setWidth(15); // Bulan10
        $sheet->getColumnDimension('O')->setWidth(15); // Bulan11
        $sheet->getColumnDimension('P')->setWidth(15); // Bulan12

        // Write the file
        $writer = new Xlsx($spreadsheet);

        // Create a temporary file in the system's temporary directory
        $fileName = 'Rak_Belanja_' . $waktu . '.xlsx';
        $filePath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $fileName;

        $writer->save($filePath);

        // Return the file as a response to download
        return $this->response->download($filePath, null)->setFileName($fileName);
    }



    private function getMonthIndex($month)
    {
        $months = [
            'januari' => 0,
            'februari' => 1,
            'maret' => 2,
            'april' => 3,
            'mei' => 4,
            'juni' => 5,
            'juli' => 6,
            'agustus' => 7,
            'september' => 8,
            'oktober' => 9,
            'november' => 10,
            'desember' => 11
        ];

        $month = strtolower($month);
        return $months[$month] ?? false;
    }


}
