# Sistem Status KRS - Mahasiswa

## 📋 Overview

Sistem status KRS menggunakan 3 status untuk mengontrol akses input/edit KRS mahasiswa:
- **Draft** - Mahasiswa bisa input/edit KRS
- **Submitted** - KRS sudah diajukan, tidak bisa diubah
- **Approved** - KRS sudah disetujui PA/Akademik

---

## 🎯 Status KRS

### 1. Draft (Default)
**Karakteristik:**
- ✅ Mahasiswa **BISA** tambah mata kuliah
- ✅ Mahasiswa **BISA** hapus mata kuliah
- ✅ Mahasiswa **BISA** ajukan KRS
- ✅ Semua button **AKTIF**

**Warna:** Kuning (Warning)

### 2. Submitted (Setelah Ajukan)
**Karakteristik:**
- ❌ Mahasiswa **TIDAK BISA** tambah mata kuliah
- ❌ Mahasiswa **TIDAK BISA** hapus mata kuliah
- ❌ Mahasiswa **TIDAK BISA** ajukan KRS lagi
- ✅ Mahasiswa **BISA** cetak KRS
- ❌ Semua button edit **DISABLED**

**Warna:** Biru (Info)

**Pesan:**
> "KRS Sudah Diajukan! Status: Menunggu Persetujuan. KRS yang sudah diajukan tidak dapat diubah lagi. Untuk perubahan KRS, silakan hubungi Dosen Pembimbing Akademik atau Bagian Akademik."

### 3. Approved (Disetujui PA)
**Karakteristik:**
- ❌ Mahasiswa **TIDAK BISA** tambah mata kuliah
- ❌ Mahasiswa **TIDAK BISA** hapus mata kuliah
- ❌ Mahasiswa **TIDAK BISA** ajukan KRS lagi
- ✅ Mahasiswa **BISA** cetak KRS
- ❌ Semua button edit **DISABLED**

**Warna:** Hijau (Success)

**Pesan:**
> "KRS Sudah Diajukan! Status: Disetujui. KRS yang sudah diajukan tidak dapat diubah lagi."

---

## 🔄 Flow Status KRS

```
┌─────────────────────────────────────────────────────────┐
│                    MAHASISWA LOGIN                       │
└────────────────────┬────────────────────────────────────┘
                     │
                     ▼
            ┌────────────────┐
            │  Status: DRAFT │ (Default)
            └────────┬───────┘
                     │
                     │ Mahasiswa input KRS
                     │ (Tambah/Hapus mata kuliah)
                     │
                     ▼
            ┌────────────────┐
            │  Klik "Ajukan  │
            │      KRS"      │
            └────────┬───────┘
                     │
                     │ Konfirmasi
                     │
                     ▼
         ┌──────────────────────┐
         │  Status: SUBMITTED   │
         │ (Menunggu Persetujuan)│
         └──────────┬───────────┘
                    │
                    │ PA/Akademik approve
                    │ (Manual/Future feature)
                    │
                    ▼
         ┌──────────────────────┐
         │  Status: APPROVED    │
         │    (Disetujui)       │
         └──────────────────────┘
```

---

## 💾 Database Schema

### Tabel: mahasiswa

**Field Baru:**
```sql
krs_status ENUM('draft', 'submitted', 'approved') NOT NULL DEFAULT 'draft'
```

**Contoh Data:**
| id_mahasiswa | nim      | nama          | krs_status |
|--------------|----------|---------------|------------|
| 1            | 2021001  | John Doe      | draft      |
| 2            | 2021002  | Jane Smith    | submitted  |
| 3            | 2021003  | Bob Johnson   | approved   |

---

## 🔧 Implementation

### Migration
**File:** `app/Database/Migrations/2025-11-08-161756_AddStatusToRencanaStudi.php`

```php
public function up()
{
    $fields = [
        'krs_status' => [
            'type' => 'ENUM',
            'constraint' => ['draft', 'submitted', 'approved'],
            'default' => 'draft',
            'null' => false
        ]
    ];
    
    $this->forge->addColumn('mahasiswa', $fields);
}
```

**Run Migration:**
```bash
php spark migrate
```

### Controller Logic
**File:** `app/Controllers/Mahasiswa/MahasiswaController.php`

```php
// Cek status KRS
$mahasiswa = $this->mahasiswaModel->where('nim', $nim)->first();
$krsStatus = $mahasiswa['krs_status'] ?? 'draft';

// Mahasiswa hanya bisa input/edit jika status 'draft'
$canInputKRS = ($krsStatus === 'draft');
```

### Submit KRS
```php
public function submitKRS()
{
    // Cek status saat ini
    if ($mahasiswa['krs_status'] !== 'draft') {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'KRS sudah diajukan dan tidak dapat diubah'
        ]);
    }

    // Update status menjadi 'submitted'
    $this->mahasiswaModel->update($mahasiswa['id_mahasiswa'], [
        'krs_status' => 'submitted'
    ]);
}
```

---

## 🎨 UI Components

### Alert Status

**Draft (Hijau):**
```html
<div class="bg-green-50 border-l-4 border-green-400">
    Periode Input KRS Aktif!
    Silakan pilih mata kuliah yang ingin Anda ambil.
</div>
```

**Submitted/Approved (Merah):**
```html
<div class="bg-red-50 border-l-4 border-red-400">
    KRS Sudah Diajukan!
    Status: Menunggu Persetujuan
    Untuk perubahan, hubungi Dosen PA atau Bagian Akademik.
</div>
```

### Status Card

```php
<?php if ($krs_status === 'draft'): ?>
    <p>Draft</p>
    <p class="text-yellow-600">dapat diubah</p>
<?php elseif ($krs_status === 'submitted'): ?>
    <p>Menunggu Persetujuan</p>
    <p class="text-blue-600">menunggu persetujuan</p>
<?php else: ?>
    <p>Disetujui</p>
    <p class="text-green-600">sudah disetujui</p>
<?php endif; ?>
```

### Buttons

```php
<button 
    onclick="addToKRS(<?= $matkul['id'] ?>)" 
    <?= !$can_input_krs ? 'disabled' : '' ?>
    class="<?= !$can_input_krs ? 'bg-gray-400 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700' ?>">
    <?= !$can_input_krs ? 'Tidak Dapat Ditambah' : 'Tambah ke KRS' ?>
</button>
```

---

## 🧪 Testing Scenarios

### Test 1: Status Draft (Bisa Input)
```
1. Login sebagai mahasiswa dengan krs_status = 'draft'
2. Buka halaman KRS
3. Expected:
   - Alert hijau "Periode Input KRS Aktif"
   - Semua button aktif
   - Bisa tambah/hapus mata kuliah
   - Bisa ajukan KRS
```

### Test 2: Submit KRS
```
1. Login sebagai mahasiswa dengan krs_status = 'draft'
2. Tambah beberapa mata kuliah
3. Klik "Ajukan KRS"
4. Konfirmasi
5. Expected:
   - Status berubah menjadi 'submitted'
   - Alert merah muncul
   - Semua button disabled
   - Tidak bisa tambah/hapus lagi
```

### Test 3: Status Submitted (Tidak Bisa Input)
```
1. Login sebagai mahasiswa dengan krs_status = 'submitted'
2. Buka halaman KRS
3. Expected:
   - Alert merah "KRS Sudah Diajukan"
   - Semua button disabled
   - Tidak bisa tambah/hapus
   - Hanya bisa cetak
```

### Test 4: Coba Submit Lagi
```
1. Login sebagai mahasiswa dengan krs_status = 'submitted'
2. Coba klik "Ajukan KRS" (jika masih bisa)
3. Expected:
   - Error: "KRS sudah diajukan dan tidak dapat diubah"
```

---

## 🔄 Reset Status (Admin/Development)

### Reset ke Draft (Manual)
```sql
-- Reset 1 mahasiswa
UPDATE mahasiswa SET krs_status = 'draft' WHERE nim = '2021001';

-- Reset semua mahasiswa
UPDATE mahasiswa SET krs_status = 'draft';
```

### Reset via Seeder (Future)
```php
// Tambahkan di seeder
$this->db->table('mahasiswa')->update(['krs_status' => 'draft']);
```

---

## 📞 Perubahan KRS Setelah Submit

### Untuk Mahasiswa:
1. Hubungi **Dosen Pembimbing Akademik (PA)**
2. Atau hubungi **Bagian Akademik**
3. Jelaskan alasan perubahan
4. PA/Akademik akan reset status ke 'draft'

### Untuk PA/Akademik (Future Feature):
```php
// Reset status mahasiswa ke draft
$this->mahasiswaModel->update($id_mahasiswa, [
    'krs_status' => 'draft'
]);
```

---

## 🎯 Advantages

### Dibanding Sistem Semester:
- ✅ **Lebih Sederhana** - Tidak perlu tracking semester
- ✅ **Lebih Fleksibel** - PA bisa reset kapan saja
- ✅ **Lebih Jelas** - Status eksplisit (draft/submitted/approved)
- ✅ **Lebih Aman** - Tidak bisa ubah setelah submit

### User Experience:
- ✅ Mahasiswa tahu kapan bisa/tidak bisa edit
- ✅ Pesan error yang jelas
- ✅ Visual indicator (warna) yang jelas
- ✅ Proses yang transparan

---

## 🚀 Future Enhancements

### Prioritas Tinggi:
- [ ] Fitur PA approve KRS (ubah status ke 'approved')
- [ ] Fitur PA reset KRS (ubah status ke 'draft')
- [ ] Notifikasi email saat KRS disetujui
- [ ] History perubahan status

### Prioritas Sedang:
- [ ] Deadline otomatis (auto-submit setelah tanggal tertentu)
- [ ] Reminder sebelum deadline
- [ ] Alasan perubahan KRS (jika PA reset)
- [ ] Log aktivitas KRS

### Prioritas Rendah:
- [ ] Approval workflow (PA → Kaprodi → Akademik)
- [ ] Batch approval untuk PA
- [ ] Dashboard PA untuk monitor KRS mahasiswa
- [ ] Export laporan KRS per prodi

---

## ✅ Summary

**Sistem Status KRS:**
- ✅ 3 Status: draft, submitted, approved
- ✅ Mahasiswa hanya bisa edit saat status 'draft'
- ✅ Setelah submit, status berubah ke 'submitted'
- ✅ Tidak bisa ubah lagi setelah submit
- ✅ Harus hubungi PA/Akademik untuk perubahan
- ✅ UI menampilkan status dengan jelas
- ✅ Semua button disabled saat tidak bisa edit

**Status: Production Ready** 🚀
