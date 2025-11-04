<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\MahasiswaModel;

class Mahasiswa extends ResourceController
{

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $mahasiswaModel = new MahasiswaModel();
        
        // Get all mahasiswa data ordered by newest first
        $mahasiswa = $mahasiswaModel->orderBy('created_at', 'ASC')->findAll();
        
        $data = [
            'title' => 'Data Mahasiswa',
            'breadcrumb' => 'Mahasiswa',
            'mahasiswa' => $mahasiswa
        ];
        return view('admin/mahasiswa/index', $data);
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

        $mahasiswaModel = new MahasiswaModel();
        
        // Get mahasiswa data
        $mahasiswa = $mahasiswaModel->find($id);
        
        if (!$mahasiswa) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Mahasiswa tidak ditemukan'
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'data' => $mahasiswa
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

        $mahasiswaModel = new MahasiswaModel();
        
        // Get POST data
        $data = [
            'nim'  => $this->request->getPost('nim'),
            'nama' => $this->request->getPost('nama')
        ];

        // Validate data
        if (!$mahasiswaModel->validate($data)) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => $mahasiswaModel->errors()
            ]);
        }

        // Insert data
        try {
            if ($mahasiswaModel->insert($data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Mahasiswa berhasil ditambahkan',
                    'data'    => $data
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal menyimpan data mahasiswa'
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

        $mahasiswaModel = new MahasiswaModel();
        
        // Check if mahasiswa exists
        $existingMahasiswa = $mahasiswaModel->find($id);
        if (!$existingMahasiswa) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Mahasiswa tidak ditemukan'
            ]);
        }

        // Get POST data
        $data = [
            'nama' => $this->request->getPost('nama')
        ];

        // Validate data (excluding nim since it's not editable)
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
            if ($mahasiswaModel->update($id, $data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Mahasiswa berhasil diupdate',
                    'data'    => array_merge(['nim' => $id], $data)
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal mengupdate data mahasiswa'
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

        $mahasiswaModel = new MahasiswaModel();
        
        // Check if mahasiswa exists
        $existingMahasiswa = $mahasiswaModel->find($id);
        if (!$existingMahasiswa) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Mahasiswa tidak ditemukan'
            ]);
        }

        // Delete data
        try {
            if ($mahasiswaModel->delete($id)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Mahasiswa berhasil dihapus'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal menghapus data mahasiswa'
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
