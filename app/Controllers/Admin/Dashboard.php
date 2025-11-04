<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\MahasiswaModel;
use App\Models\JadwalModel;
use App\Models\RuanganModel;
use App\Models\UserModel;
use App\Models\DosenModel;

class Dashboard extends Controller
{
    protected $mahasiswaModel;
    protected $jadwalModel;
    protected $ruanganModel;
    protected $userModel;
    protected $dosenModel;
    // Configuration for data limits
    protected $config = [
        'recent_activities_limit' => 5,   // Limit aktivitas terbaru
        'recent_data_limit' => 5,          // 0 = show all data
        'tab_data_limit' => 5,             // 0 = show all data per tab
        'activity_mahasiswa_limit' => 5,   // Limit mahasiswa di aktivitas
        'activity_jadwal_limit' => 5,      // Limit jadwal di aktivitas  
        'activity_ruangan_limit' => 5      // Limit ruangan di aktivitas
    ];

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
        $this->jadwalModel = new JadwalModel();
        $this->ruanganModel = new RuanganModel();
        $this->userModel = new UserModel();
        $this->dosenModel = new DosenModel();
    }

    public function index()
    {
        // Get statistics from database
        $stats = $this->getStatistics();
        
        // Get recent activities
        $activities = $this->getRecentActivities();
        
        // Get recent data for preview table
        $recentData = $this->getRecentData();

        $data = [
            'title' => 'Dashboard Admin',
            'breadcrumb' => 'Dashboard',
            'stats' => $stats,
            'activities' => $activities,
            'recent_data' => $recentData,
            'config' => $this->config  // Pass config to view
        ];

        return view('admin/dashboard', $data);
    }

    private function getStatistics()
    {
        try {
            // Count total mahasiswa
            $totalMahasiswa = $this->mahasiswaModel->countAll();
            
            // Count total dosen
            $totalDosen = $this->dosenModel->countAll();
            
            // Count total ruangan
            $totalRuangan = $this->ruanganModel->countAll();
            
            // Count total jadwal
            $totalJadwal = $this->jadwalModel->countAll();

            // Count total users (semua user di sistem)
            $totalUsers = $this->userModel->countAll();

            return [
                'mahasiswa' => $totalMahasiswa ?: 0,
                'dosen' => $totalDosen ?: 0,
                'ruangan' => $totalRuangan ?: 0,
                'jadwal' => $totalJadwal ?: 0,
                'users' => $totalUsers ?: 0
            ];
        } catch (\Exception $e) {
            // Fallback to default values if database error
            log_message('error', 'Dashboard statistics error: ' . $e->getMessage());
            return [
                'mahasiswa' => 0,
                'dosen' => 0,
                'ruangan' => 0,
                'jadwal' => 0,
                'users' => 0
            ];
        }
    }

    private function getRecentActivities()
    {
        try {
            $activities = [];
            
            // Get recent mahasiswa
            $recentMahasiswa = $this->mahasiswaModel
                ->orderBy('created_at', 'DESC')
                ->limit($this->config['activity_mahasiswa_limit'])
                ->find();
            
            foreach ($recentMahasiswa as $mahasiswa) {
                $activities[] = [
                    'message' => 'Mahasiswa baru ditambahkan: ' . $mahasiswa['nama'],
                    'time' => $this->timeAgo($mahasiswa['created_at']),
                    'color' => 'green',
                    'timestamp' => strtotime($mahasiswa['created_at'])
                ];
            }
            
            // Get recent jadwal
            $recentJadwal = $this->jadwalModel
                ->select('jadwal.*, mata_kuliah.nama_mata_kuliah')
                ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah', 'left')
                ->orderBy('jadwal.created_at', 'DESC')
                ->limit($this->config['activity_jadwal_limit'])
                ->find();
            
            foreach ($recentJadwal as $jadwal) {
                $activities[] = [
                    'message' => 'Jadwal baru dibuat: ' . ($jadwal['nama_mata_kuliah'] ?? 'Mata Kuliah') . ' - ' . $jadwal['nama_kelas'],
                    'time' => $this->timeAgo($jadwal['created_at']),
                    'color' => 'blue',
                    'timestamp' => strtotime($jadwal['created_at'])
                ];
            }
            
            // Get recent ruangan
            $recentRuangan = $this->ruanganModel
                ->orderBy('created_at', 'DESC')
                ->limit($this->config['activity_ruangan_limit'])
                ->find();
            
            foreach ($recentRuangan as $ruangan) {
                $activities[] = [
                    'message' => 'Ruangan baru ditambahkan: ' . $ruangan['nama_ruangan'],
                    'time' => $this->timeAgo($ruangan['created_at']),
                    'color' => 'yellow',
                    'timestamp' => strtotime($ruangan['created_at'])
                ];
            }
            
            // Sort activities by timestamp (most recent first)
            usort($activities, function($a, $b) {
                return $b['timestamp'] - $a['timestamp'];
            });
            
            return array_slice($activities, 0, $this->config['recent_activities_limit']);
            
        } catch (\Exception $e) {
            log_message('error', 'Dashboard activities error: ' . $e->getMessage());
            return [
                [
                    'message' => 'Sistem SIPAKU aktif dan berjalan',
                    'time' => 'Baru saja',
                    'color' => 'green'
                ]
            ];
        }
    }

    private function getRecentData()
    {
        try {
            // Get recent mahasiswa with additional info
            $query = $this->mahasiswaModel->orderBy('created_at', 'DESC');
            
            // Apply limit only if not 0 (0 means show all)
            if ($this->config['recent_data_limit'] > 0) {
                $query->limit($this->config['recent_data_limit']);
            }
            
            $recentMahasiswa = $query->find();
            
            $formattedData = [];
            foreach ($recentMahasiswa as $mahasiswa) {
                $formattedData[] = [
                    'nim' => $mahasiswa['nim'],
                    'nama' => $mahasiswa['nama'],
                    'prodi' => $this->getProdiName($mahasiswa['nim']), // You might need to implement this
                    'status' => 'Aktif',
                    'created_at' => $mahasiswa['created_at']
                ];
            }
            
            return $formattedData;
            
        } catch (\Exception $e) {
            log_message('error', 'Dashboard recent data error: ' . $e->getMessage());
            return [
                [
                    'nim' => 'N/A',
                    'nama' => 'Data tidak tersedia',
                    'prodi' => 'N/A',
                    'status' => 'N/A'
                ]
            ];
        }
    }

    private function getProdiName($nim)
    {
        // Simple logic to determine prodi based on NIM pattern
        // You can modify this based on your NIM format
        $nimPrefix = substr($nim, 0, 2);
        
        switch ($nimPrefix) {
            case '11':
                return 'Teknik Informatika';
            case '12':
                return 'Sistem Informasi';
            case '13':
                return 'Teknik Komputer';
            default:
                return 'Program Studi';
        }
    }

    private function timeAgo($datetime)
    {
        if (!$datetime) return 'Tidak diketahui';
        
        try {
            $time = time() - strtotime($datetime);
            
            if ($time < 60) {
                return 'Baru saja';
            } elseif ($time < 3600) {
                $minutes = floor($time / 60);
                return $minutes . ' menit yang lalu';
            } elseif ($time < 86400) {
                $hours = floor($time / 3600);
                return $hours . ' jam yang lalu';
            } elseif ($time < 2592000) {
                $days = floor($time / 86400);
                return $days . ' hari yang lalu';
            } else {
                return date('d M Y', strtotime($datetime));
            }
        } catch (\Exception $e) {
            return 'Tidak diketahui';
        }
    }

    /**
     * AJAX endpoint untuk mendapatkan data berdasarkan tab
     */
    public function getTabData($type = 'mahasiswa')
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['error' => 'Invalid request']);
        }

        try {
            $data = [];
            
            switch ($type) {
                case 'mahasiswa':
                    $query = $this->mahasiswaModel->orderBy('created_at', 'DESC');
                    if ($this->config['tab_data_limit'] > 0) {
                        $query->limit($this->config['tab_data_limit']);
                    }
                    $data = $query->find();
                    break;
                    
                case 'dosen':
                    $dosenModel = new \App\Models\DosenModel();
                    $query = $dosenModel->orderBy('created_at', 'DESC');
                    if ($this->config['tab_data_limit'] > 0) {
                        $query->limit($this->config['tab_data_limit']);
                    }
                    $data = $query->find();
                    break;
                    
                case 'ruangan':
                    $query = $this->ruanganModel->orderBy('created_at', 'DESC');
                    if ($this->config['tab_data_limit'] > 0) {
                        $query->limit($this->config['tab_data_limit']);
                    }
                    $data = $query->find();
                    break;
                    
                case 'jadwal':
                    $query = $this->jadwalModel
                        ->select('jadwal.*, mata_kuliah.nama_mata_kuliah, ruangan.nama_ruangan')
                        ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah', 'left')
                        ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan', 'left')
                        ->orderBy('jadwal.created_at', 'DESC');
                    if ($this->config['tab_data_limit'] > 0) {
                        $query->limit($this->config['tab_data_limit']);
                    }
                    $data = $query->find();
                    break;
                    
                default:
                    return $this->response->setJSON(['error' => 'Invalid type']);
            }
            
            return $this->response->setJSON([
                'success' => true,
                'data' => $data,
                'type' => $type
            ]);
            
        } catch (\Exception $e) {
            log_message('error', 'Dashboard tab data error: ' . $e->getMessage());
            return $this->response->setJSON([
                'error' => 'Database error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Method untuk mengubah konfigurasi limit (opsional)
     */
    public function updateConfig()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $newConfig = $this->request->getJSON(true);
        
        // Validate and update config
        if (isset($newConfig['recent_activities_limit'])) {
            $this->config['recent_activities_limit'] = max(1, min(20, (int)$newConfig['recent_activities_limit']));
        }
        
        if (isset($newConfig['recent_data_limit'])) {
            $this->config['recent_data_limit'] = max(1, min(50, (int)$newConfig['recent_data_limit']));
        }
        
        if (isset($newConfig['tab_data_limit'])) {
            $this->config['tab_data_limit'] = max(1, min(100, (int)$newConfig['tab_data_limit']));
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Konfigurasi berhasil diperbarui',
            'config' => $this->config
        ]);
    }

    /**
     * Get current configuration
     */
    public function getConfig()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['error' => 'Invalid request']);
        }

        return $this->response->setJSON([
            'success' => true,
            'config' => $this->config
        ]);
    }

    /**
     * Search functionality
     */
    public function search()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['error' => 'Invalid request']);
        }

        $input = $this->request->getJSON(true);
        $type = $input['type'] ?? '';
        $query = $input['query'] ?? '';

        if (empty($query)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Query tidak boleh kosong'
            ]);
        }

        try {
            $results = [];

            switch ($type) {
                case 'mahasiswa':
                    $results = $this->mahasiswaModel
                        ->like('nim', $query)
                        ->orLike('nama', $query)
                        ->limit(10)
                        ->find();
                    break;

                case 'dosen':
                    $results = $this->dosenModel
                        ->like('nidn', $query)
                        ->orLike('nama', $query)
                        ->limit(10)
                        ->find();
                    break;

                case 'ruangan':
                    $results = $this->ruanganModel
                        ->like('nama_ruangan', $query)
                        ->limit(10)
                        ->find();
                    break;

                case 'jadwal':
                    $results = $this->jadwalModel
                        ->select('jadwal.*, mata_kuliah.nama_mata_kuliah')
                        ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah', 'left')
                        ->like('jadwal.nama_kelas', $query)
                        ->orLike('mata_kuliah.nama_mata_kuliah', $query)
                        ->limit(10)
                        ->find();
                    break;

                default:
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Tipe pencarian tidak valid'
                    ]);
            }

            return $this->response->setJSON([
                'success' => true,
                'results' => $results,
                'count' => count($results)
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Dashboard search error: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mencari data'
            ]);
        }
    }

    /**
     * Get detailed statistics
     */
    public function getDetailedStats()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['error' => 'Invalid request']);
        }

        try {
            $stats = [];

            // Mahasiswa statistics
            $stats['mahasiswa_aktif'] = $this->mahasiswaModel->countAll();
            $stats['mahasiswa_recent'] = $this->mahasiswaModel
                ->where('created_at >=', date('Y-m-d H:i:s', strtotime('-7 days')))
                ->countAllResults();

            // Dosen statistics
            $stats['dosen_aktif'] = $this->dosenModel->countAll();
            $stats['dosen_recent'] = $this->dosenModel
                ->where('created_at >=', date('Y-m-d H:i:s', strtotime('-7 days')))
                ->countAllResults();

            // Ruangan statistics
            $stats['ruangan_lab'] = $this->ruanganModel
                ->like('nama_ruangan', 'LAB', 'both')
                ->countAllResults();
            $stats['ruangan_kelas'] = $this->ruanganModel
                ->notLike('nama_ruangan', 'LAB', 'both')
                ->countAllResults();

            // Jadwal statistics
            $currentDay = date('l'); // Get current day name
            $dayInIndonesian = $this->translateDayToIndonesian($currentDay);
            
            $stats['jadwal_today'] = $this->jadwalModel
                ->where('hari', $dayInIndonesian)
                ->countAllResults();
            
            $stats['jadwal_week'] = $this->jadwalModel->countAll();

            // Activity statistics (based on created_at timestamps)
            $today = date('Y-m-d');
            $weekAgo = date('Y-m-d', strtotime('-7 days'));
            $monthAgo = date('Y-m-d', strtotime('-30 days'));

            // Count activities from all tables
            $activityToday = 0;
            $activityWeek = 0;
            $activityMonth = 0;

            // Mahasiswa activities
            $activityToday += $this->mahasiswaModel->where('DATE(created_at)', $today)->countAllResults();
            $activityWeek += $this->mahasiswaModel->where('created_at >=', $weekAgo)->countAllResults();
            $activityMonth += $this->mahasiswaModel->where('created_at >=', $monthAgo)->countAllResults();

            // Dosen activities
            $activityToday += $this->dosenModel->where('DATE(created_at)', $today)->countAllResults();
            $activityWeek += $this->dosenModel->where('created_at >=', $weekAgo)->countAllResults();
            $activityMonth += $this->dosenModel->where('created_at >=', $monthAgo)->countAllResults();

            // Ruangan activities
            $activityToday += $this->ruanganModel->where('DATE(created_at)', $today)->countAllResults();
            $activityWeek += $this->ruanganModel->where('created_at >=', $weekAgo)->countAllResults();
            $activityMonth += $this->ruanganModel->where('created_at >=', $monthAgo)->countAllResults();

            // Jadwal activities
            $activityToday += $this->jadwalModel->where('DATE(created_at)', $today)->countAllResults();
            $activityWeek += $this->jadwalModel->where('created_at >=', $weekAgo)->countAllResults();
            $activityMonth += $this->jadwalModel->where('created_at >=', $monthAgo)->countAllResults();

            $stats['activity_today'] = $activityToday;
            $stats['activity_week'] = $activityWeek;
            $stats['activity_month'] = $activityMonth;

            return $this->response->setJSON([
                'success' => true,
                'stats' => $stats
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Dashboard detailed stats error: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal memuat statistik detail'
            ]);
        }
    }

    private function translateDayToIndonesian($englishDay)
    {
        $days = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu'
        ];

        return $days[$englishDay] ?? 'Senin';
    }

    /*
    // Export functionality - commented out for now
    public function export($type = 'mahasiswa')
    {
        try {
            $data = [];
            $filename = '';
            $headers = [];

            switch ($type) {
                case 'mahasiswa':
                    $data = $this->mahasiswaModel->findAll();
                    $filename = 'data_mahasiswa_' . date('Y-m-d') . '.csv';
                    $headers = ['NIM', 'Nama', 'Created At', 'Updated At'];
                    break;

                case 'dosen':
                    $data = $this->dosenModel->findAll();
                    $filename = 'data_dosen_' . date('Y-m-d') . '.csv';
                    $headers = ['NIDN', 'Nama', 'Created At', 'Updated At'];
                    break;

                case 'ruangan':
                    $data = $this->ruanganModel->findAll();
                    $filename = 'data_ruangan_' . date('Y-m-d') . '.csv';
                    $headers = ['ID Ruangan', 'Nama Ruangan', 'Created At', 'Updated At'];
                    break;

                case 'jadwal':
                    $data = $this->jadwalModel->getJadwalWithRelations();
                    $filename = 'data_jadwal_' . date('Y-m-d') . '.csv';
                    $headers = ['ID', 'Nama Kelas', 'Mata Kuliah', 'Dosen', 'Hari', 'Jam', 'Ruangan', 'Created At'];
                    break;

                default:
                    throw new \Exception('Tipe export tidak valid');
            }

            // Set headers for CSV download
            $this->response->setHeader('Content-Type', 'text/csv');
            $this->response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');
            $this->response->setHeader('Cache-Control', 'no-cache, must-revalidate');

            // Create CSV content
            $output = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Add headers
            fputcsv($output, $headers);

            // Add data rows
            foreach ($data as $row) {
                $csvRow = [];
                
                switch ($type) {
                    case 'mahasiswa':
                        $csvRow = [
                            $row['nim'],
                            $row['nama'],
                            $row['created_at'] ?? '',
                            $row['updated_at'] ?? ''
                        ];
                        break;

                    case 'dosen':
                        $csvRow = [
                            $row['nidn'],
                            $row['nama'],
                            $row['created_at'] ?? '',
                            $row['updated_at'] ?? ''
                        ];
                        break;

                    case 'ruangan':
                        $csvRow = [
                            $row['id_ruangan'],
                            $row['nama_ruangan'],
                            $row['created_at'] ?? '',
                            $row['updated_at'] ?? ''
                        ];
                        break;

                    case 'jadwal':
                        $csvRow = [
                            $row['id'],
                            $row['nama_kelas'],
                            $row['nama_mata_kuliah'] ?? 'N/A',
                            $row['nama_dosen'] ?? 'N/A',
                            $row['hari'],
                            $row['jam'],
                            $row['nama_ruangan'] ?? 'N/A',
                            $row['created_at'] ?? ''
                        ];
                        break;
                }
                
                fputcsv($output, $csvRow);
            }

            fclose($output);
            return;

        } catch (\Exception $e) {
            log_message('error', 'Dashboard export error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengexport data: ' . $e->getMessage());
        }
    }
    */
}