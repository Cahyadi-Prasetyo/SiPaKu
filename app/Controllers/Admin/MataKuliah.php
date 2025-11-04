<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MataKuliahModel;

class MataKuliah extends BaseController
{
    protected $mataKuliahModel;

    public function __construct()
    {
        $this->mataKuliahModel = new MataKuliahModel();
    }

    /**
     * Tampilkan halaman mata kuliah
     */
    public function index()
    {
        $data = [
            'title' => 'Kelola Mata Kuliah',
            'breadcrumb' => 'Mata Kuliah',
            'mataKuliah' => $this->mataKuliahModel->findAll()
        ];

        return view('admin/mata_kuliah/index', $data);
    }

    /**
     * Tambah mata kuliah baru
     */
    public function create()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $rules = [
            'kode_mata_kuliah' => 'required|min_length[3]|max_length[10]|is_unique[mata_kuliah.kode_mata_kuliah]',
            'nama_mata_kuliah' => 'required|min_length[3]|max_length[100]',
            'sks' => 'required|integer|greater_than[0]|less_than_equal_to[6]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $this->validator->getErrors()
            ]);
        }

        $data = [
            'kode_mata_kuliah' => $this->request->getPost('kode_mata_kuliah'),
            'nama_mata_kuliah' => $this->request->getPost('nama_mata_kuliah'),
            'sks' => $this->request->getPost('sks')
        ];

        if ($this->mataKuliahModel->insert($data)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Mata kuliah berhasil ditambahkan'
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal menambahkan mata kuliah'
        ]);
    }

    /**
     * Tampilkan detail mata kuliah
     */
    public function show($id)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $mataKuliah = $this->mataKuliahModel->find($id);

        if (!$mataKuliah) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Mata kuliah tidak ditemukan'
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'data' => $mataKuliah
        ]);
    }

    /**
     * Update mata kuliah
     */
    public function update($id)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Debug logging
        log_message('debug', 'MataKuliah Update - ID: ' . $id);
        log_message('debug', 'MataKuliah Update - POST data: ' . json_encode($this->request->getPost()));

        $mataKuliah = $this->mataKuliahModel->find($id);
        if (!$mataKuliah) {
            log_message('error', 'MataKuliah not found with ID: ' . $id);
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Mata kuliah tidak ditemukan'
            ]);
        }

        $rules = [
            'kode_mata_kuliah' => "required|min_length[3]|max_length[10]|is_unique[mata_kuliah.kode_mata_kuliah,id_mata_kuliah,{$id}]",
            'nama_mata_kuliah' => 'required|min_length[3]|max_length[100]',
            'sks' => 'required|integer|greater_than[0]|less_than_equal_to[6]'
        ];

        if (!$this->validate($rules)) {
            log_message('error', 'MataKuliah validation failed: ' . json_encode($this->validator->getErrors()));
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $this->validator->getErrors()
            ]);
        }

        $data = [
            'kode_mata_kuliah' => $this->request->getPost('kode_mata_kuliah'),
            'nama_mata_kuliah' => $this->request->getPost('nama_mata_kuliah'),
            'sks' => $this->request->getPost('sks')
        ];

        log_message('debug', 'MataKuliah Update data: ' . json_encode($data));

        try {
            $result = $this->mataKuliahModel->update($id, $data);
            log_message('debug', 'MataKuliah Update result: ' . ($result ? 'SUCCESS' : 'FAILED'));
            
            if ($result) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Mata kuliah berhasil diperbarui'
                ]);
            } else {
                $errors = $this->mataKuliahModel->errors();
                log_message('error', 'MataKuliah Model errors: ' . json_encode($errors));
                
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal memperbarui mata kuliah',
                    'debug_errors' => $errors
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'MataKuliah Update exception: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Hapus mata kuliah
     */
    public function delete($id)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $mataKuliah = $this->mataKuliahModel->find($id);
        if (!$mataKuliah) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Mata kuliah tidak ditemukan'
            ]);
        }

        if ($this->mataKuliahModel->delete($id)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Mata kuliah berhasil dihapus'
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal menghapus mata kuliah'
        ]);
    }
}
