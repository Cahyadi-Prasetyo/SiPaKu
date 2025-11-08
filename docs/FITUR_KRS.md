# Fitur Kartu Rencana Studi (KRS) - Mahasiswa

## Overview
Sistem KRS yang lengkap untuk mahasiswa dengan validasi real-time, pencegahan bentrok jadwal, dan fitur cetak.

## Fitur Utama

### 1. Dashboard KRS
- **Summary Cards**: Menampilkan total SKS, jumlah mata kuliah, status KRS, dan sisa kuota
- **Real-time Update**: Counter otomatis update saat menambah/menghapus mata kuliah
- **Status Tracking**: Menampilkan status KRS (Draft/Menunggu Persetujuan/Disetujui)

### 2. Manajemen Mata Kuliah

#### Tambah Mata Kuliah
- Pencarian mata kuliah dengan filter hari
- Validasi otomatis:
  - Batas maksimal 24 SKS
  - Deteksi bentrok jadwal
  - Pencegahan duplikasi mata kuliah
  - Highlight mata kuliah yang bentrok
- Loading indicator saat proses
- Toast notification untuk feedback

#### Hapus Mata Kuliah
- Hapus per mata kuliah
- Hapus semua sekaligus
- Konfirmasi sebelum menghapus
- Update counter otomatis

### 3. Validasi Jadwal

#### Deteksi Bentrok
- Cek overlap waktu kuliah
- Tampilkan nama mata kuliah yang bentrok
- Disable tombol untuk mata kuliah yang bentrok
- Visual indicator (opacity + background merah)

#### Validasi SKS
- Batas maksimal 24 SKS per semester
- Batas minimal 12 SKS (warning saat submit)
- Real-time calculation

#### Validasi Duplikasi
- Cegah mengambil mata kuliah yang sama
- Cek berdasarkan ID mata kuliah (bukan jadwal)

### 4. Submit KRS
- Validasi minimal SKS
- Konfirmasi sebelum submit
- Update status KRS
- Disable semua tombol setelah submit
- Notifikasi sukses/gagal

### 5. Cetak KRS
- Format A4 professional
- Header universitas
- Info mahasiswa lengkap
- Tabel mata kuliah
- Summary SKS
- Tempat tanda tangan mahasiswa & PA
- Print-friendly layout
- Auto-open print dialog (optional)

### 6. Search & Filter
- Search by nama mata kuliah
- Filter by hari
- Real-time filtering
- Case-insensitive search

## Teknologi

### Frontend
- **Tailwind CSS**: Styling responsive
- **Vanilla JavaScript**: Interaktivitas
- **AJAX/Fetch API**: Komunikasi dengan backend
- **Toast Notifications**: User feedback

### Backend
- **CodeIgniter 4**: Framework PHP
- **RESTful API**: Endpoint untuk AJAX
- **Validation**: Server-side validation
- **Database**: MySQL dengan relasi

## API Endpoints

### POST /mahasiswa/krs/add
Menambahkan mata kuliah ke KRS
```json
Request:
{
  "jadwal_id": 1
}

Response:
{
  "success": true,
  "message": "Mata kuliah berhasil ditambahkan ke KRS",
  "total_sks": 18
}
```

### POST /mahasiswa/krs/remove
Menghapus mata kuliah dari KRS
```json
Request:
{
  "jadwal_id": 1
}

Response:
{
  "success": true,
  "message": "Mata kuliah berhasil dihapus dari KRS",
  "total_sks": 15
}
```

### POST /mahasiswa/krs/submit
Mengajukan KRS untuk persetujuan
```json
Request:
{
  "total_sks": 18,
  "total_matkul": 6
}

Response:
{
  "success": true,
  "message": "KRS berhasil diajukan dan menunggu persetujuan",
  "total_sks": 18,
  "total_matkul": 6
}
```

### GET /mahasiswa/krs/print
Membuka halaman cetak KRS dalam tab baru

## Database Schema

### Tabel: rencana_studi
```sql
- id_rencana_studi (PK)
- nim (FK -> mahasiswa)
- id_jadwal (FK -> jadwal)
- nilai_angka
- nilai_huruf
- created_at
- updated_at
```

### Relasi
- `rencana_studi` -> `jadwal` (many-to-one)
- `jadwal` -> `mata_kuliah` (many-to-one)
- `jadwal` -> `dosen` (many-to-one)
- `jadwal` -> `ruangan` (many-to-one)

## Validasi

### Client-side
1. Cek duplikasi di tabel KRS
2. Cek batas SKS maksimal
3. Highlight bentrok jadwal
4. Disable button untuk mata kuliah bentrok

### Server-side
1. Validasi jadwal_id exists
2. Cek duplikasi di database
3. Cek duplikasi mata kuliah (ID berbeda, mata kuliah sama)
4. Validasi batas SKS
5. Deteksi bentrok jadwal dengan overlap time
6. Return error message yang informatif

## User Experience

### Loading States
- Button disabled saat proses
- Loading spinner di button
- Toast notification "Menambahkan..."
- Reload page setelah sukses

### Error Handling
- Toast notification untuk error
- Error message yang jelas dan informatif
- Button re-enabled jika gagal
- Console log untuk debugging

### Visual Feedback
- Hover effect pada card
- Transition smooth
- Color coding (blue=normal, red=bentrok, yellow=warning)
- Icon yang sesuai konteks

## Fitur Masa Depan

### Prioritas Tinggi
- [ ] Status persetujuan PA (Pembimbing Akademik)
- [ ] Notifikasi email saat KRS disetujui/ditolak
- [ ] History perubahan KRS
- [ ] Export KRS ke PDF

### Prioritas Sedang
- [ ] Kuota mata kuliah
- [ ] Waiting list jika kuota penuh
- [ ] Rekomendasi mata kuliah berdasarkan IPK
- [ ] Prasyarat mata kuliah

### Prioritas Rendah
- [ ] Drag & drop untuk reorder
- [ ] Calendar view untuk jadwal
- [ ] Simulasi IPK jika mengambil mata kuliah tertentu
- [ ] Sharing KRS dengan teman

## Testing

### Manual Testing Checklist
- [x] Tambah mata kuliah normal
- [x] Tambah mata kuliah melebihi 24 SKS
- [x] Tambah mata kuliah yang bentrok
- [x] Tambah mata kuliah duplikat
- [x] Hapus mata kuliah
- [x] Hapus semua mata kuliah
- [x] Submit KRS dengan < 12 SKS
- [x] Submit KRS dengan >= 12 SKS
- [x] Cetak KRS
- [x] Search mata kuliah
- [x] Filter by hari

### Browser Compatibility
- [x] Chrome/Edge (Chromium)
- [x] Firefox
- [x] Safari (perlu testing)
- [x] Mobile responsive

## Troubleshooting

### Mata kuliah tidak muncul
- Cek apakah jadwal sudah dibuat di database
- Cek join table di query
- Cek filter hari

### Bentrok tidak terdeteksi
- Cek format jam di database (HH:MM-HH:MM)
- Cek fungsi `isTimeOverlap()`
- Cek case sensitivity hari

### Toast tidak muncul
- Cek apakah `window.toast` sudah didefinisikan di layout
- Cek console untuk error JavaScript
- Cek apakah script toast sudah di-load

### Print tidak berfungsi
- Cek route `/mahasiswa/krs/print`
- Cek apakah view `krs_print.php` exists
- Cek popup blocker browser

## Maintenance

### Update Batas SKS
Edit di file: `app/Views/mahasiswa/krs.php`
```javascript
// Line ~50
if (currentSKS + sks > 24) { // Ubah 24 ke nilai baru
```

### Update Periode KRS
Edit di file: `app/Views/mahasiswa/krs.php`
```html
<!-- Line ~20 -->
<strong>Periode KRS:</strong> 15 Januari - 15 Februari 2025
```

### Update Tahun Akademik
Edit di file: `app/Controllers/Mahasiswa/MahasiswaController.php`
```php
// Method printKRS()
'tahun_akademik' => '2024/2025' // Update di sini
```

## Credits
Developed for SIPAKU (Sistem Informasi Akademik)
