# Implementation Plan - Database Dummy Data

- [x] 1. Create base seeder infrastructure


  - Create DatabaseSeeder.php as main orchestrator with proper execution order
  - Set up transaction management and error handling framework
  - _Requirements: 4.3, 4.4, 4.5_



- [ ] 2. Implement independent table seeders
- [ ] 2.1 Create MahasiswaSeeder with realistic Indonesian student data
  - Generate 20 mahasiswa records with valid NIM format (YYYY + sequential)


  - Use diverse Indonesian names and proper timestamp fields
  - _Requirements: 1.1, 3.1_



- [ ] 2.2 Create DosenSeeder with realistic lecturer data
  - Generate 10 dosen records with valid NIDN format (10-digit)
  - Use diverse Indonesian names with academic titles


  - _Requirements: 1.2, 3.2_

- [x] 2.3 Create MataKuliahSeeder with academic course data


  - Generate 15 mata_kuliah records covering various subjects
  - Use proper course codes and appropriate SKS values (1-6)
  - _Requirements: 1.3, 3.3_



- [ ] 2.4 Create RuanganSeeder with campus room data
  - Generate 8 ruangan records with realistic room names
  - Include various room types (labs, classrooms, auditoriums)
  - _Requirements: 1.4_



- [ ] 2.5 Create NilaiMutuSeeder with Indonesian grading scale
  - Insert standard Indonesian grade values (A, AB, B, BC, C, D, E)
  - Map each grade to proper numerical values (4.00 to 0.00)


  - _Requirements: 1.5_

- [ ] 3. Implement dependent table seeders
- [ ] 3.1 Create JadwalSeeder with course scheduling data
  - Generate 25+ jadwal records referencing existing mata_kuliah, ruangan, and dosen


  - Create diverse class schedules across different days and time slots
  - Ensure no scheduling conflicts for same room/time combinations
  - _Requirements: 2.1, 2.4, 3.4_




- [ ] 3.2 Create RencanaStudiSeeder with student enrollment data
  - Generate 100+ rencana_studi records linking mahasiswa to jadwal
  - Include varied grade distributions with realistic nilai_angka values
  - Ensure each student has multiple course enrollments
  - _Requirements: 2.2, 3.5_

- [ ] 3.3 Create UserSeeder with authentication data
  - Generate user records for all mahasiswa and dosen entries
  - Create additional admin users for system management
  - Link users to appropriate mahasiswa or dosen records based on role
  - _Requirements: 2.3_

- [ ] 4. Integrate and test complete seeding system
- [ ] 4.1 Update DatabaseSeeder to orchestrate all individual seeders
  - Execute seeders in proper dependency order
  - Implement comprehensive error handling and rollback mechanisms
  - _Requirements: 4.1, 4.2, 4.3_

- [ ] 4.2 Create seeder execution command and documentation
  - Provide clear instructions for running the complete seeding process
  - Document the data structure and relationships created
  - _Requirements: 4.1, 4.4_

- [ ]* 4.3 Write validation tests for seeded data
  - Create tests to verify referential integrity after seeding
  - Test data diversity and format compliance
  - Validate relationship consistency across all tables
  - _Requirements: 2.1, 2.2, 2.3, 2.4_