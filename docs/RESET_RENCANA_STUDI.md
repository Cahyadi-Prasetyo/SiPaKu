# Reset Data Rencana Studi

## 📋 Overview

Script untuk membuat ulang data rencana studi dari awal dengan:
- ✅ ID dimulai dari 1
- ✅ Urutan berdasarkan NIM mahasiswa (ascending)
- ✅ Data fresh dan clean
- ✅ Auto increment reset

---

## 🚀 Cara Menjalankan

### Metode 1: Menggunakan Batch File (Windows)

**Langkah:**
1. Double-click file `reset_rencana_studi.bat`
2. Tunggu proses selesai
3. Selesai!

### Metode 2: Manual via Command Line

**Windows (CMD/PowerShell):**
```bash
php spark db:seed RencanaStudiSeeder
```

**Linux/Mac:**
```bash
php spark db:seed RencanaStudiSeeder
```

---

## 🔄 Apa yang Dilakukan Script?

### 1. Hapus Data Lama
```sql
TRUNCATE TABLE rencana_studi;
```
- Menghapus semua data lama
- Reset auto increment

### 2. Reset Auto Increment
```sql
ALTER TABLE rencana_studi AUTO_INCREMENT = 1;
```
- ID akan dimulai dari 1 lagi

### 3. Ambil Data Mahasiswa (Urut NIM)
```php
$mahasiswa = $mahasiswaModel->orderBy('nim', 'ASC')->findAll();
```
- Mahasiswa diurutkan berdasarkan NIM
- Mahasiswa pertama akan diproses pertama

### 4. Generate Data Rencana Studi
Untuk setiap mahasiswa:
- Ambil 5-8 mata kuliah secara random
- 80% kemungkinan sudah ada nilai
- 20% kemungkinan belum ada nilai
- Nilai diambil dari tabel `nilai_mutu`

### 5. Insert Data Baru
```php
$this->db->table('rencana_studi')->insertBatch($rencanaStudiData);
```
- Data diinsert dengan ID auto increment dari 1

---

## 📊 Output yang Dihasilkan

### Console Output:
```
🔄 Membuat ulang data Rencana Studi...

Memproses mahasiswa: John Doe (NIM: 2021001)
Memproses mahasiswa: Jane Smith (NIM: 2021002)
...

🗑️  Menghapus data lama...
💾 Menyimpan data baru...

✅ Berhasil menambahkan 150 data rencana studi untuk 25 mahasiswa.

📊 Statistik:
   - Total rencana studi: 150
   - Sudah ada nilai: 120
   - Belum ada nilai: 30

👤 Mahasiswa Pertama:
   - NIM: 2021001
   - Nama: John Doe
   - Jumlah mata kuliah: 6

✨ Data rencana studi berhasil dibuat ulang dengan ID dimulai dari 1!
```

---

## 🗄️ Struktur Data yang Dihasilkan

### Tabel: rencana_studi

| id_rencana_studi | nim      | id_jadwal | nilai_angka | nilai_huruf | created_at | updated_at |
|------------------|----------|-----------|-------------|-------------|------------|------------|
| 1                | 2021001  | 5         | 85          | A           | ...        | ...        |
| 2                | 2021001  | 12        | 78          | B           | ...        | ...        |
| 3                | 2021001  | 3         | NULL        | NULL        | ...        | ...        |
| 4                | 2021002  | 8         | 92          | A           | ...        | ...        |
| ...              | ...      | ...       | ...         | ...         | ...        | ...        |

**Karakteristik:**
- ID dimulai dari 1
- Urutan berdasarkan NIM mahasiswa
- Setiap mahasiswa punya 5-8 mata kuliah
- 80% sudah ada nilai, 20% belum

---

## 🎯 Nilai yang Dihasilkan

### Distribusi Nilai Huruf:
Nilai diambil secara random dari tabel `nilai_mutu`:
- A (4.00)
- A- (3.50)
- B (3.00)
- B- (2.50)
- C (2.00)
- D (1.00)
- E (0.00)

### Nilai Angka:
Disesuaikan dengan nilai huruf:
- A: 85-100
- A-: 80-84
- B: 70-79
- B-: 65-69
- C: 55-64
- D: 40-54
- E: 0-39

---

## ⚠️ Perhatian

### Sebelum Menjalankan:

1. **Backup Data Lama (Opsional)**
   ```sql
   CREATE TABLE rencana_studi_backup AS SELECT * FROM rencana_studi;
   ```

2. **Pastikan Data Prasyarat Ada:**
   - ✅ Tabel `mahasiswa` sudah terisi
   - ✅ Tabel `jadwal` sudah terisi
   - ✅ Tabel `nilai_mutu` sudah terisi

3. **Data Akan Dihapus:**
   - ⚠️ Semua data lama di `rencana_studi` akan dihapus
   - ⚠️ Tidak bisa di-undo
   - ⚠️ Pastikan sudah backup jika diperlukan

---

## 🔍 Verifikasi Hasil

### 1. Cek ID Dimulai dari 1
```sql
SELECT MIN(id_rencana_studi) as first_id FROM rencana_studi;
-- Expected: 1
```

### 2. Cek Urutan NIM
```sql
SELECT nim, COUNT(*) as total_matkul 
FROM rencana_studi 
GROUP BY nim 
ORDER BY nim ASC 
LIMIT 5;
```

### 3. Cek Statistik Nilai
```sql
SELECT 
    COUNT(*) as total,
    SUM(CASE WHEN nilai_huruf IS NOT NULL THEN 1 ELSE 0 END) as dengan_nilai,
    SUM(CASE WHEN nilai_huruf IS NULL THEN 1 ELSE 0 END) as tanpa_nilai
FROM rencana_studi;
```

### 4. Cek Mahasiswa Pertama
```sql
SELECT * FROM rencana_studi 
WHERE nim = (SELECT MIN(nim) FROM mahasiswa)
ORDER BY id_rencana_studi ASC;
```

---

## 🐛 Troubleshooting

### Error: "Data mahasiswa tidak ditemukan"
**Solusi:**
```bash
php spark db:seed MahasiswaSeeder
```

### Error: "Data jadwal tidak ditemukan"
**Solusi:**
```bash
php spark db:seed JadwalSeeder
```

### Error: "Data nilai_mutu tidak ditemukan"
**Solusi:**
```bash
php spark db:seed NilaiMutuSeeder
```

### Error: "Foreign key constraint fails"
**Solusi:**
1. Cek apakah `id_jadwal` yang direferensikan ada di tabel `jadwal`
2. Cek apakah `nim` yang direferensikan ada di tabel `mahasiswa`

### ID Tidak Dimulai dari 1
**Solusi:**
```sql
-- Manual reset auto increment
TRUNCATE TABLE rencana_studi;
ALTER TABLE rencana_studi AUTO_INCREMENT = 1;
```

---

## 📝 Customization

### Ubah Jumlah Mata Kuliah per Mahasiswa

Edit file `app/Database/Seeds/RencanaStudiSeeder.php`:

```php
// Dari:
$jumlahMatkul = rand(5, min(8, count($jadwal)));

// Menjadi (misal 3-6 mata kuliah):
$jumlahMatkul = rand(3, min(6, count($jadwal)));
```

### Ubah Persentase Mahasiswa dengan Nilai

```php
// Dari:
$hasNilai = rand(1, 100) <= 80; // 80% ada nilai

// Menjadi (misal 100% ada nilai):
$hasNilai = true;

// Atau (misal 50% ada nilai):
$hasNilai = rand(1, 100) <= 50;
```

### Ubah Range Nilai Angka

```php
private function generateNilaiAngka($nilaiHuruf)
{
    $ranges = [
        'A'  => [90, 100],  // Ubah dari [85, 100]
        'A-' => [85, 89],   // Ubah dari [80, 84]
        // ... dst
    ];
}
```

---

## 🎓 Use Cases

### 1. Development/Testing
- Reset data untuk testing fitur baru
- Generate data dummy yang konsisten
- Testing dengan data fresh

### 2. Demo/Presentation
- Data yang rapi dan terurut
- Mudah untuk dijelaskan
- Konsisten setiap kali reset

### 3. Production (Hati-hati!)
- Hanya jika benar-benar diperlukan
- Pastikan sudah backup
- Koordinasi dengan tim

---

## ✅ Checklist Sebelum Reset

- [ ] Backup data lama (jika diperlukan)
- [ ] Pastikan data mahasiswa sudah ada
- [ ] Pastikan data jadwal sudah ada
- [ ] Pastikan data nilai_mutu sudah ada
- [ ] Koordinasi dengan tim (jika production)
- [ ] Siap kehilangan data lama

---

## 📞 Support

Jika ada masalah atau pertanyaan:
1. Cek dokumentasi ini
2. Cek error message di console
3. Cek log database
4. Hubungi tim development

---

## 🎉 Summary

Script ini akan:
- ✅ Menghapus semua data lama
- ✅ Reset auto increment ke 1
- ✅ Generate data baru dengan urutan NIM
- ✅ Setiap mahasiswa dapat 5-8 mata kuliah
- ✅ 80% sudah ada nilai, 20% belum
- ✅ Data fresh dan clean

**Status: Ready to Use** 🚀
