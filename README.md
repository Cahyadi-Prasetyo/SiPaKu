# SIPAKU - Sistem Informasi Perkuliahan Akademik Ku

![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=flat&logo=php&logoColor=white)
![CodeIgniter](https://img.shields.io/badge/CodeIgniter-4.x-EF4223?style=flat&logo=codeigniter&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=flat&logo=mysql&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.x-06B6D4?style=flat&logo=tailwindcss&logoColor=white)

Sistem Informasi Perkuliahan Akademik Ku (SIPAKU) adalah aplikasi web untuk mengelola data akademik perguruan tinggi yang dibangun menggunakan CodeIgniter 4 dengan antarmuka modern berbasis TailwindCSS.

## 🚀 Fitur Utama

### 👨‍💼 Admin Dashboard
- **Manajemen User**: Kelola data dosen dan mahasiswa
- **Manajemen Mata Kuliah**: CRUD mata kuliah dengan sistem SKS
- **Manajemen Jadwal**: Penjadwalan kuliah dengan validasi konflik
- **Manajemen Ruangan**: Kelola data ruang kuliah
- **Dashboard Analytics**: Statistik dan laporan akademik

### 🎓 Fitur Mahasiswa
- **Profil Mahasiswa**: Kelola data pribadi
- **Jadwal Kuliah**: Lihat jadwal kuliah per semester
- **Riwayat Akademik**: Tracking progress akademik

### 👨‍🏫 Fitur Dosen
- **Profil Dosen**: Manajemen data pribadi
- **Jadwal Mengajar**: Lihat jadwal mengajar
- **Manajemen Kelas**: Kelola kelas yang diampu

## 🛠️ Teknologi yang Digunakan

- **Backend**: CodeIgniter 4.x (PHP Framework)
- **Frontend**: TailwindCSS + Preline UI Components
- **Database**: MySQL 8.0+
- **JavaScript**: Vanilla JS dengan AJAX
- **Icons**: Heroicons
- **Build Tools**: Vite (untuk asset compilation)

## 📋 Persyaratan Sistem

### Server Requirements
- **PHP**: 8.1 atau lebih tinggi
- **Database**: MySQL 8.0+ atau MariaDB 10.4+
- **Web Server**: Apache 2.4+ atau Nginx 1.18+

### PHP Extensions
- `intl` - Internationalization support
- `mbstring` - Multibyte string support
- `mysqlnd` - MySQL Native Driver
- `curl` - HTTP client library
- `json` - JSON support (enabled by default)
- `xml` - XML support
- `gd` - Image processing (optional)

## 🚀 Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/your-username/sipaku.git
cd sipaku
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Environment Setup
```bash
# Copy environment file
cp env .env

# Edit .env file
nano .env
```

### 4. Database Configuration
Edit file `.env` dan sesuaikan konfigurasi database:
```env
# Database
database.default.hostname = localhost
database.default.database = sipaku_db
database.default.username = your_username
database.default.password = your_password
database.default.DBDriver = MySQLi

# Base URL
app.baseURL = 'http://localhost:8080/'

# Environment
CI_ENVIRONMENT = development
```

### 5. Database Migration & Seeding
```bash
# Run migrations
php spark migrate

# Run seeders (optional - untuk data dummy)
php spark db:seed DatabaseSeeder
```

### 6. Build Assets
```bash
# Development
npm run dev

# Production
npm run build
```

### 7. Start Development Server
```bash
php spark serve
```

Aplikasi akan berjalan di `http://localhost:8080`

## 📁 Struktur Project

```
sipaku/
├── app/
│   ├── Controllers/
│   │   ├── Admin/          # Admin controllers
│   │   ├── Dosen/          # Dosen controllers
│   │   └── Mahasiswa/      # Mahasiswa controllers
│   ├── Models/             # Database models
│   ├── Views/
│   │   ├── admin/          # Admin views
│   │   ├── dosen/          # Dosen views
│   │   ├── mahasiswa/      # Mahasiswa views
│   │   └── layout/         # Layout templates
│   ├── Database/
│   │   ├── Migrations/     # Database migrations
│   │   └── Seeds/          # Database seeders
│   └── Config/             # Configuration files
├── public/
│   ├── assets/             # Compiled assets
│   └── uploads/            # File uploads
├── resources/              # Source assets
│   ├── css/
│   └── js/
└── writable/               # Writable directories
```

## 🎨 UI Components

Aplikasi menggunakan komponen UI modern dengan:
- **Responsive Design**: Mobile-first approach
- **Dark/Light Mode**: Theme switching (coming soon)
- **Interactive Components**: Modals, dropdowns, notifications
- **Data Tables**: Advanced filtering, pagination, search
- **Form Validation**: Real-time validation dengan feedback

## 🔧 Development

### Code Style
- Follow PSR-12 coding standards
- Use meaningful variable and function names
- Comment complex logic
- Keep functions small and focused

### Database Conventions
- Table names: `snake_case` (plural)
- Column names: `snake_case`
- Primary keys: `id_[table_name]`
- Foreign keys: `id_[referenced_table]`

### Frontend Guidelines
- Use TailwindCSS utility classes
- Keep JavaScript modular
- Use semantic HTML
- Ensure accessibility compliance

## 🧪 Testing

```bash
# Run all tests
php spark test

# Run specific test
php spark test App\\Tests\\Models\\UserModelTest
```

## 📝 API Documentation

API endpoints tersedia di `/api/docs` setelah aplikasi berjalan.

### Authentication
```bash
POST /api/auth/login
POST /api/auth/logout
POST /api/auth/refresh
```

### User Management
```bash
GET    /api/users
POST   /api/users
GET    /api/users/{id}
PUT    /api/users/{id}
DELETE /api/users/{id}
```

## 🤝 Contributing

1. Fork repository
2. Create feature branch (`git checkout -b feature/amazing-feature`)
3. Commit changes (`git commit -m 'Add amazing feature'`)
4. Push to branch (`git push origin feature/amazing-feature`)
5. Open Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

Jika mengalami masalah atau memiliki pertanyaan:

1. **Issues**: [GitHub Issues](https://github.com/Cahyadi-Prasetyo/sipaku/issues)
2. **Documentation**: [Wiki](https://github.com/Cahyadi-Prasetyo/sipaku/wiki)

## 🙏 Acknowledgments

- [CodeIgniter 4](https://codeigniter.com/) - PHP Framework
- [TailwindCSS](https://tailwindcss.com/) - CSS Framework
- [Preline UI](https://preline.co/) - UI Components
- [Heroicons](https://heroicons.com/) - Icon Library

---

**SIPAKU** - Memudahkan pengelolaan akademik dengan teknologi modern 🎓
