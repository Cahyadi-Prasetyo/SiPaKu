<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Jadwal extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $jadwalModel = new \App\Models\JadwalModel();
        
        // Get sorting parameters
        $sortBy = $this->request->getGet('sort_by') ?? 'created_at';
        $sortOrder = $this->request->getGet('sort_order') ?? 'ASC';
        
        // Validate sort parameters
        $allowedSortFields = ['nama_kelas', 'hari', 'jam', 'nama_mata_kuliah', 'nama_dosen', 'nama_ruangan', 'created_at'];
        $allowedSortOrders = ['ASC', 'DESC'];
        
        if (!in_array($sortBy, $allowedSortFields)) {
            $sortBy = 'created_at';
        }
        
        if (!in_array(strtoupper($sortOrder), $allowedSortOrders)) {
            $sortOrder = 'ASC';
        }
        
        // Get all jadwal data with relations and sorting
        $jadwal = $jadwalModel->getJadwalWithRelations($sortBy, $sortOrder);
        
        $data = [
            'title' => 'Data Jadwal',
            'breadcrumb' => 'Jadwal',
            'jadwal' => $jadwal,
            'current_sort' => $sortBy,
            'current_order' => $sortOrder
        ];
        return view('admin/jadwal/index', $data);
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

        $jadwalModel = new \App\Models\JadwalModel();
        
        // Get jadwal data with relations
        $jadwal = $jadwalModel->getJadwalWithRelationsById($id);
        
        if (!$jadwal) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Jadwal tidak ditemukan'
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'data' => $jadwal
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

        $jadwalModel = new \App\Models\JadwalModel();
        
        // Get POST data
        $data = [
            'nama_kelas'     => $this->request->getPost('nama_kelas'),
            'id_mata_kuliah' => $this->request->getPost('id_mata_kuliah'),
            'id_ruangan'     => $this->request->getPost('id_ruangan'),
            'nidn'           => $this->request->getPost('nidn'),
            'hari'           => $this->request->getPost('hari'),
            'jam'            => $this->request->getPost('jam')
        ];

        // Validate data
        if (!$jadwalModel->validate($data)) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => $jadwalModel->errors()
            ]);
        }

        // Insert data
        try {
            if ($jadwalModel->insert($data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Jadwal berhasil ditambahkan',
                    'data'    => $data
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal menyimpan data jadwal',
                    'errors'  => $jadwalModel->errors()
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
     * Get mata kuliah data for dropdown
     */
    public function getMataKuliah()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Invalid request method'
            ]);
        }

        $mataKuliahModel = new \App\Models\MataKuliahModel();
        $data = $mataKuliahModel->findAll();

        return $this->response->setJSON([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Get dosen data for dropdown
     */
    public function getDosen()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Invalid request method'
            ]);
        }

        $dosenModel = new \App\Models\DosenModel();
        $data = $dosenModel->findAll();

        return $this->response->setJSON([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Get ruangan data for dropdown
     */
    public function getRuangan()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Invalid request method'
            ]);
        }

        $ruanganModel = new \App\Models\RuanganModel();
        $data = $ruanganModel->findAll();

        return $this->response->setJSON([
            'success' => true,
            'data' => $data
        ]);
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

        $jadwalModel = new \App\Models\JadwalModel();
        
        // Check if jadwal exists
        $existingJadwal = $jadwalModel->find($id);
        if (!$existingJadwal) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Jadwal tidak ditemukan'
            ]);
        }

        // Get POST data
        $data = [
            'nama_kelas'     => $this->request->getPost('nama_kelas'),
            'id_mata_kuliah' => $this->request->getPost('id_mata_kuliah'),
            'id_ruangan'     => $this->request->getPost('id_ruangan'),
            'nidn'           => $this->request->getPost('nidn'),
            'hari'           => $this->request->getPost('hari'),
            'jam'            => $this->request->getPost('jam')
        ];

        // Validate data
        if (!$jadwalModel->validate($data)) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => $jadwalModel->errors()
            ]);
        }

        // Update data
        try {
            if ($jadwalModel->update($id, $data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Jadwal berhasil diupdate',
                    'data'    => $data
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal mengupdate data jadwal',
                    'errors'  => $jadwalModel->errors()
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

        $jadwalModel = new \App\Models\JadwalModel();
        
        // Check if jadwal exists
        $existingJadwal = $jadwalModel->find($id);
        if (!$existingJadwal) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Jadwal tidak ditemukan'
            ]);
        }

        // Delete data
        try {
            if ($jadwalModel->delete($id)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Jadwal berhasil dihapus'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal menghapus data jadwal'
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
     * Check for schedule conflicts
     */
    public function checkConflict()
    {
        // Check if request is AJAX
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Invalid request method'
            ]);
        }

        $jadwalModel = new \App\Models\JadwalModel();
        
        // Get JSON data
        $json = $this->request->getJSON(true);
        
        if (!$json) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid JSON data'
            ]);
        }

        // Prepare data for conflict checking
        $data = [
            'id_ruangan' => $json['id_ruangan'] ?? null,
            'nidn' => $json['nidn'] ?? null,
            'hari' => $json['hari'] ?? null,
            'jam' => $json['jam'] ?? null
        ];

        $excludeId = $json['exclude_id'] ?? null;

        // Check for conflicts
        $conflicts = $jadwalModel->validateScheduleConflict($data, $excludeId);

        return $this->response->setJSON([
            'success' => true,
            'conflicts' => $conflicts,
            'has_conflicts' => !empty($conflicts)
        ]);
    }
}
