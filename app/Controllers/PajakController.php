<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PajakModel;
class PajakController extends BaseController
{
    protected $PajakModel;
    public function __construct()
    {
        $this->PajakModel = new PajakModel();

    }

    public function index()
    {
        $data['pajak'] = $this->PajakModel->findAll();
        return view('pajak/index', $data);
    }

    public function create()
    {
        return view('pajak/create');
    }

    public function store()
    {
        $data = [
            'nama_pajak' => $this->request->getPost('nama_pajak'),
            'persen' => $this->request->getPost('persen'),
        ];

        $this->PajakModel->insert($data);

        return redirect()->to('/pajak');
    }


    public function edit($id)
    {
        $data = [
            'pajak' => $this->PajakModel->find($id),
        ];
        return view('pajak/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'nama_pajak' => $this->request->getPost('nama_pajak'),
            'persen' => $this->request->getPost('persen'),
        ];

        $this->PajakModel->update($id, $data);

        return redirect()->to('pajak');
    }

    public function destroy($id)
    {
        $this->PajakModel->delete($id);

        return redirect()->to('/pajak');
    }
}
