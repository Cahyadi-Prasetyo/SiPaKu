<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Ruangan extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $ruanganModel = new \App\Models\RuanganModel();
        
        // Get all ruangan data ordered by newest first
        $ruangan = $ruanganModel->orderBy('created_at', 'ASC')->findAll();
        
        $data = [
            'title' => 'Data Ruangan',
            'breadcrumb' => 'Ruangan',
            'ruangan' => $ruangan
        ];
        return view('admin/ruangan/index', $data);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        // Check if request is AJAX
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Invalid request method'
            ]);
        }

        $ruanganModel = new \App\Models\RuanganModel();
        
        // Get ruangan data
        $ruangan = $ruanganModel->find($id);
        
        if (!$ruangan) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Ruangan tidak ditemukan'
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'data' => $ruangan
        ]);
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        // Check if request is AJAX
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Invalid request method'
            ]);
        }

        $ruanganModel = new \App\Models\RuanganModel();
        
        // Get POST data
        $data = [
            'nama_ruangan' => $this->request->getPost('nama_ruangan')
        ];

        // Validate data
        if (!$ruanganModel->validate($data)) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => $ruanganModel->errors()
            ]);
        }

        // Insert data
        try {
            if ($ruanganModel->insert($data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Ruangan berhasil ditambahkan',
                    'data'    => $data
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal menyimpan data ruangan'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        // Check if request is AJAX
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Invalid request method'
            ]);
        }

        $ruanganModel = new \App\Models\RuanganModel();
        
        // Check if ruangan exists
        $existingRuangan = $ruanganModel->find($id);
        if (!$existingRuangan) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Ruangan tidak ditemukan'
            ]);
        }

        // Get POST data
        $data = [
            'nama_ruangan' => $this->request->getPost('nama_ruangan')
        ];

        // Validate data (excluding unique check for same record)
        $validationRules = [
            'nama_ruangan' => 'required|min_length[3]|max_length[50]|is_unique[ruangan.nama_ruangan,id_ruangan,' . $id . ']'
        ];

        if (!$this->validate($validationRules)) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => $this->validator->getErrors()
            ]);
        }

        // Update data
        try {
            if ($ruanganModel->update($id, $data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Ruangan berhasil diupdate',
                    'data'    => array_merge(['id_ruangan' => $id], $data)
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal mengupdate data ruangan'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        // Check if request is AJAX
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Invalid request method'
            ]);
        }

        $ruanganModel = new \App\Models\RuanganModel();
        
        // Check if ruangan exists
        $existingRuangan = $ruanganModel->find($id);
        if (!$existingRuangan) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Ruangan tidak ditemukan'
            ]);
        }

        // Delete data
        try {
            if ($ruanganModel->delete($id)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Ruangan berhasil dihapus'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal menghapus data ruangan'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }
}
