<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Dosen extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $dosenModel = new \App\Models\DosenModel();
        
        // Get all dosen data ordered by newest first
        $dosen = $dosenModel->orderBy('created_at', 'ASC')->findAll();
        
        // Debug: Log jumlah data
        log_message('info', 'Dosen data count: ' . count($dosen));
        
        $data = [
            'title' => 'Data Dosen',
            'breadcrumb' => 'Dosen',
            'dosen' => $dosen
        ];
        return view('admin/dosen/index', $data);
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

        $dosenModel = new \App\Models\DosenModel();
        
        // Get dosen data
        $dosen = $dosenModel->find($id);
        
        if (!$dosen) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Dosen tidak ditemukan'
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'data' => $dosen
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

        $dosenModel = new \App\Models\DosenModel();
        
        // Get POST data
        $data = [
            'nidn' => $this->request->getPost('nidn'),
            'nama' => $this->request->getPost('nama')
        ];

        // Validate data
        if (!$dosenModel->validate($data)) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => $dosenModel->errors()
            ]);
        }

        // Insert data
        try {
            if ($dosenModel->insert($data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Dosen berhasil ditambahkan',
                    'data'    => $data
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal menyimpan data dosen'
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

        $dosenModel = new \App\Models\DosenModel();
        
        // Check if dosen exists
        $existingDosen = $dosenModel->find($id);
        if (!$existingDosen) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Dosen tidak ditemukan'
            ]);
        }

        // Get POST data
        $data = [
            'nama' => $this->request->getPost('nama')
        ];

        // Validate data (excluding nidn since it's not editable)
        $validationRules = [
            'nama' => 'required|min_length[3]|max_length[100]'
        ];

        if (!$this->validate($validationRules)) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => $this->validator->getErrors()
            ]);
        }

        // Update data
        try {
            if ($dosenModel->update($id, $data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Dosen berhasil diupdate',
                    'data'    => array_merge(['nidn' => $id], $data)
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal mengupdate data dosen'
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

        $dosenModel = new \App\Models\DosenModel();
        
        // Check if dosen exists
        $existingDosen = $dosenModel->find($id);
        if (!$existingDosen) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Dosen tidak ditemukan'
            ]);
        }

        // Delete data
        try {
            if ($dosenModel->delete($id)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Dosen berhasil dihapus'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal menghapus data dosen'
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
