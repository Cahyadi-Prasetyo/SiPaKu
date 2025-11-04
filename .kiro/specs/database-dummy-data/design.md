# Design Document - Database Dummy Data

## Overview

This design outlines the implementation of comprehensive database seeders for the SIPAKU system. The solution will create realistic dummy data for all tables while maintaining referential integrity and following CodeIgniter 4 seeding best practices.

## Architecture

### Seeder Structure
```
app/Database/Seeds/
├── DatabaseSeeder.php (Main seeder orchestrator)
├── MahasiswaSeeder.php
├── DosenSeeder.php
├── MataKuliahSeeder.php
├── RuanganSeeder.php
├── NilaiMutuSeeder.php
├── JadwalSeeder.php
├── RencanaStudiSeeder.php
└── UserSeeder.php
```

### Execution Order
1. Independent tables (no foreign keys): mahasiswa, dosen, mata_kuliah, ruangan, nilai_mutu
2. Dependent tables: jadwal (depends on mata_kuliah, ruangan, dosen)
3. Final dependent tables: rencana_studi (depends on mahasiswa, jadwal, nilai_mutu), user (depends on mahasiswa, dosen)

## Components and Interfaces

### DatabaseSeeder (Main Orchestrator)
- **Purpose**: Coordinates execution of all individual seeders
- **Methods**:
  - `run()`: Executes all seeders in proper order
  - Handles transaction management for data consistency

### Individual Seeders
Each seeder follows the same pattern:
- **Methods**:
  - `run()`: Main execution method
  - `generateData()`: Creates sample data arrays
  - `insertData()`: Batch inserts data into database

### Data Generation Strategy
- Use Indonesian names and realistic academic data
- Generate valid format identifiers (NIM, NIDN)
- Create diverse but realistic course schedules
- Maintain proper grade distributions

## Data Models

### Sample Data Specifications

#### Mahasiswa (20 records)
```php
[
    'nim' => '2021001001', // Format: YYYY + sequential
    'nama' => 'Ahmad Rizki Pratama',
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s')
]
```

#### Dosen (10 records)
```php
[
    'nidn' => '0123456789', // 10-digit NIDN format
    'nama' => 'Dr. Siti Nurhaliza, M.Kom',
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s')
]
```

#### Mata Kuliah (15 records)
```php
[
    'kode_mata_kuliah' => 'IF101',
    'nama_mata_kuliah' => 'Algoritma dan Pemrograman',
    'sks' => 3,
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s')
]
```

#### Ruangan (8 records)
```php
[
    'nama_ruangan' => 'Lab Komputer 1',
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s')
]
```

#### Nilai Mutu (Standard Indonesian grading)
```php
[
    ['nilai_huruf' => 'A', 'nilai_mutu' => 4.00],
    ['nilai_huruf' => 'AB', 'nilai_mutu' => 3.50],
    ['nilai_huruf' => 'B', 'nilai_mutu' => 3.00],
    ['nilai_huruf' => 'BC', 'nilai_mutu' => 2.50],
    ['nilai_huruf' => 'C', 'nilai_mutu' => 2.00],
    ['nilai_huruf' => 'D', 'nilai_mutu' => 1.00],
    ['nilai_huruf' => 'E', 'nilai_mutu' => 0.00]
]
```

#### Jadwal (25+ records)
```php
[
    'nama_kelas' => 'IF-A',
    'id_mata_kuliah' => 1, // FK to mata_kuliah
    'id_ruangan' => 1, // FK to ruangan
    'nidn' => '0123456789', // FK to dosen
    'hari' => 'Senin',
    'jam' => '08:00-10:00',
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s')
]
```

#### Rencana Studi (100+ records)
```php
[
    'nim' => '2021001001', // FK to mahasiswa
    'id_jadwal' => 1, // FK to jadwal
    'nilai_huruf' => 'A', // FK to nilai_mutu
    'nilai_angka' => 85.50,
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s')
]
```

#### User (30+ records)
```php
[
    'nama_user' => 'Ahmad Rizki Pratama',
    'role' => 'mahasiswa', // or 'dosen' or 'admin'
    'kode' => '2021001001', // NIM for mahasiswa, NIDN for dosen
    'nim' => '2021001001', // FK to mahasiswa (nullable)
    'nidn' => null, // FK to dosen (nullable)
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s')
]
```

## Error Handling

### Database Constraints
- Handle foreign key constraint violations
- Validate data format before insertion
- Use database transactions for atomicity

### Seeder Error Management
- Graceful handling of duplicate key errors
- Rollback mechanism for failed operations
- Clear error messages for debugging

### Data Validation
- Validate NIM and NIDN formats
- Check SKS values are within valid range (1-6)
- Ensure time slots don't conflict

## Testing Strategy

### Unit Testing
- Test individual seeder data generation
- Validate data format compliance
- Test foreign key relationship integrity

### Integration Testing
- Test complete seeding process
- Verify referential integrity after seeding
- Test seeder execution order

### Data Validation Testing
- Verify all tables are populated
- Check data diversity and realism
- Validate relationship consistency

## Implementation Notes

### Performance Considerations
- Use batch inserts for better performance
- Implement chunked processing for large datasets
- Optimize foreign key lookups

### Maintenance
- Modular seeder design for easy updates
- Configurable data quantities
- Clear documentation for data relationships

### CodeIgniter 4 Integration
- Follow CI4 seeder conventions
- Use CI4 database builder methods
- Integrate with CI4 migration system