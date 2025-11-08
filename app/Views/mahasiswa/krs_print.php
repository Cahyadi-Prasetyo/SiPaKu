<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        @media print {
            @page {
                size: A4;
                margin: 1cm;
            }
            body {
                margin: 0;
                padding: 0;
            }
            .no-print {
                display: none;
            }
        }
        
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #000;
            background: #fff;
            margin: 0;
            padding: 20px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #000;
            padding-bottom: 15px;
        }
        
        .header h1 {
            margin: 0;
            font-size: 18pt;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .header h2 {
            margin: 5px 0;
            font-size: 16pt;
            font-weight: bold;
        }
        
        .header p {
            margin: 3px 0;
            font-size: 11pt;
        }
        
        .info-section {
            margin-bottom: 20px;
        }
        
        .info-row {
            display: flex;
            margin-bottom: 5px;
        }
        
        .info-label {
            width: 150px;
            font-weight: bold;
        }
        
        .info-value {
            flex: 1;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        table th {
            background-color: #f0f0f0;
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            font-weight: bold;
        }
        
        table td {
            border: 1px solid #000;
            padding: 8px;
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-right {
            text-align: right;
        }
        
        .summary {
            margin-top: 20px;
            font-weight: bold;
        }
        
        .signature-section {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }
        
        .signature-box {
            width: 45%;
            text-align: center;
        }
        
        .signature-line {
            margin-top: 80px;
            border-top: 1px solid #000;
            padding-top: 5px;
        }
        
        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        
        .print-button:hover {
            background-color: #1d4ed8;
        }
    </style>
</head>
<body>
    <button class="print-button no-print" onclick="window.print()">🖨️ Cetak</button>
    
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Universitas XYZ</h1>
            <h2>Kartu Rencana Studi (KRS)</h2>
            <p>Tahun Akademik <?= $tahun_akademik ?> - Semester <?= $semester ?></p>
        </div>
        
        <!-- Info Mahasiswa -->
        <div class="info-section">
            <div class="info-row">
                <div class="info-label">NIM</div>
                <div class="info-value">: <?= $mahasiswa['nim'] ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Nama</div>
                <div class="info-value">: <?= $mahasiswa['nama'] ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Program Studi</div>
                <div class="info-value">: <?= $mahasiswa['program_studi'] ?? 'Teknik Informatika' ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Semester</div>
                <div class="info-value">: <?= $semester ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Tanggal Cetak</div>
                <div class="info-value">: <?= date('d F Y') ?></div>
            </div>
        </div>
        
        <!-- Tabel KRS -->
        <table>
            <thead>
                <tr>
                    <th class="text-center" style="width: 30px;">No</th>
                    <th style="width: 80px;">Kode MK</th>
                    <th>Mata Kuliah</th>
                    <th style="width: 40px;" class="text-center">SKS</th>
                    <th style="width: 120px;">Dosen</th>
                    <th style="width: 100px;">Jadwal</th>
                    <th style="width: 80px;">Ruangan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($krs_aktif)): ?>
                    <?php 
                    $no = 1;
                    $totalSKS = 0;
                    foreach ($krs_aktif as $krs): 
                        $totalSKS += $krs['sks'];
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $krs['kode_mata_kuliah'] ?></td>
                            <td><?= $krs['nama_mata_kuliah'] ?></td>
                            <td class="text-center"><?= $krs['sks'] ?></td>
                            <td><?= $krs['nama_dosen'] ?></td>
                            <td><?= $krs['hari'] ?>, <?= $krs['jam'] ?></td>
                            <td><?= $krs['nama_ruangan'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3" class="text-right"><strong>Total SKS</strong></td>
                        <td class="text-center"><strong><?= $totalSKS ?></strong></td>
                        <td colspan="3"></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Belum ada mata kuliah yang dipilih</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        
        <!-- Summary -->
        <div class="summary">
            <p>Jumlah Mata Kuliah: <?= count($krs_aktif) ?> mata kuliah</p>
            <p>Total SKS: <?= $total_sks ?> SKS</p>
        </div>
        
        <!-- Signature Section -->
        <div class="signature-section">
            <div class="signature-box">
                <p>Mahasiswa</p>
                <div class="signature-line">
                    <?= $mahasiswa['nama'] ?>
                </div>
                <p>NIM: <?= $mahasiswa['nim'] ?></p>
            </div>
            
            <div class="signature-box">
                <p>Pembimbing Akademik</p>
                <div class="signature-line">
                    (...................................)
                </div>
                <p>NIDN: ........................</p>
            </div>
        </div>
        
        <!-- Footer Note -->
        <div style="margin-top: 30px; font-size: 10pt; font-style: italic;">
            <p>Catatan:</p>
            <ul style="margin: 5px 0; padding-left: 20px;">
                <li>KRS ini dicetak pada tanggal <?= date('d F Y, H:i') ?> WIB</li>
                <li>KRS yang telah disetujui tidak dapat diubah tanpa persetujuan Pembimbing Akademik</li>
                <li>Mahasiswa wajib mengikuti seluruh mata kuliah yang tercantum dalam KRS</li>
            </ul>
        </div>
    </div>
    
    <script>
        // Auto print on load (optional)
        // window.onload = function() { window.print(); }
    </script>
</body>
</html>
