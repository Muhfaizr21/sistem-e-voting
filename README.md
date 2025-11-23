# 🗳️ VoteAcademy - Sistem E-Voting Sekolah Modern

`VoteAcademy` adalah sistem e-voting berbasis web yang dikembangkan untuk memodernisasi proses pemilihan di lingkungan sekolah. Sistem ini menyediakan platform voting yang aman, transparan, dan efisien untuk pemilihan OSIS, ketua kelas, atau pemilihan sekolah lainnya.

## Tentang Proyek

Sistem ini dirancang untuk menggantikan sistem voting konvensional dengan solusi digital yang lebih modern. Dengan tiga peran utama (Admin, User/Guest), VoteAcademy menyediakan ekosistem lengkap mulai dari manajemen kandidat oleh admin, proses voting yang aman, hingga tampilan hasil real-time.

Fokus utama sistem ini adalah:
* **Admin:** Mengelola kandidat, memantau hasil voting, dan mengelola sistem
* **User:** Melihat kandidat, melakukan voting, dan memantau hasil
* **Public:** Melihat hasil voting secara transparan

## Fitur Utama

### 🎯 Core Features
* **Sistem Voting Aman:** Enkripsi end-to-end dan verifikasi multi-layer
* **Real-time Results:** Dashboard live dengan update hasil secara real-time
* **Multi-Platform:** Responsif di semua device (desktop, tablet, mobile)
* **Transparansi Penuh:** Audit trail lengkap untuk setiap aktivitas voting

### 👥 Role Management
* **Admin Panel:** Kelola kandidat, pantau hasil, reset sistem
* **User Dashboard:** Voting aman, lihat riwayat, kelola profil
* **Public View:** Hasil voting dapat diakses publik secara transparan

### 📊 Analytics & Reporting
* **Live Statistics:** Grafik perkembangan suara real-time
* **Detailed Reports:** Ekspor data dalam format PDF/Excel
* **Voting Analytics:** Partisipasi, tren voting, dan statistik detail

## 🚀 Demo Credentials

Anda dapat mencoba sistem menggunakan kredensial login berikut:

| Role | Email | Password |
| :--- | :--- | :--- |
| Admin | `admin@voteacademy.id` | `password123` |
| User | `user@example.com` | `password123` |
| Guest | - | Akses publik untuk hasil voting |

## 🛠️ Teknologi yang Digunakan

### Backend
* **Framework:** Laravel 11
* **Bahasa:** PHP 8.3
* **Database:** MySQL
* **Authentication:** Laravel Breeze

### Frontend
* **CSS Framework:** Tailwind CSS
* **Icons:** Font Awesome 6
* **Fonts:** Inter Google Font
* **JavaScript:** Alpine.js untuk interaktivitas

### Additional Features
* **Real-time Elements:** Live progress bars dan counters
* **Responsive Design:** Mobile-first approach
* **Modern UI/UX:** Glassmorphism effects dan gradient designs

## 🚀 Instalasi & Menjalankan Proyek

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL Database

### Step-by-Step Installation

1. **Clone repositori:**
```bash
git clone https://github.com/username-anda/voteacademy.git
cd voteacademy
```

2. **Install dependencies:**
```bash
composer install
npm install
```

3. **Setup environment:**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Konfigurasi database:**
Edit file `.env`:
```env
DB_DATABASE=voteacademy
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. **Jalankan migrations dan seeding:**
```bash
php artisan migrate --seed
```

6. **Build assets:**
```bash
npm run dev
# atau untuk production:
npm run build
```

7. **Jalankan server:**
```bash
php artisan serve
```
Akses aplikasi di `http://localhost:8000`

## 📱 Struktur Aplikasi

### 🏠 Public Pages
- **Homepage:** Landing page dengan fitur dan demo live dashboard
- **Results Page:** Halaman hasil voting yang bisa diakses publik
- **Candidate Profiles:** Informasi kandidat dan visi-misi

### 🔐 Authentication System
- **Login/Register:** Sistem auth menggunakan Laravel Breeze
- **Profile Management:** Edit profil dan pengaturan akun
- **Role-based Access:** Pembatasan akses berdasarkan role user

### 👑 Admin Panel
- **Dashboard:** Overview sistem dan statistik voting
- **Candidate Management:** CRUD data kandidat
- **Voting Results:** Detail hasil voting dengan analytics
- **User Management:** Kelola user dan permissions
- **System Tools:** Reset voting, export data, dll

### 👤 User Dashboard
- **Voting Interface:** Interface voting yang user-friendly
- **Voting History:** Riwayat voting user
- **Profile Settings:** Kelola data pribadi

## 🎨 Design System

### Color Palette
```css
Primary: #667eea (Purple)
Secondary: #764ba2 (Dark Purple)
Accent: #ff6b6b (Red)
Success: #00d2d3 (Teal)
```

### Components
- **Glass Effects:** Modern glassmorphism design
- **Gradient Backgrounds:** Dynamic gradient combinations
- **Card Hover Effects:** Smooth animations and transitions
- **Progress Bars:** Animated voting progress indicators

## 🔒 Security Features

### Voting Security
- **One Vote Per User:** Sistem verifikasi voting tunggal
- **Encrypted Data:** Enkripsi data voting dan user
- **Audit Trail:** Log lengkap semua aktivitas voting
- **Time-based Restrictions:** Batasan waktu voting

### System Security
- **CSRF Protection:** Laravel built-in protection
- **SQL Injection Prevention:** Eloquent ORM security
- **XSS Protection:** Data sanitization dan validation
- **Secure Authentication:** Laravel Breeze security features

## 📈 Performance Features

### Optimization
- **Lazy Loading:** Optimized image and content loading
- **Caching System:** Laravel cache untuk performa better
- **Database Indexing:** Optimized query performance
- **Asset Optimization:** Minified CSS dan JavaScript

### Real-time Features
- **Live Counters:** Animated number counters
- **Progress Animations:** Smooth progress bar animations
- **Dynamic Updates:** Real-time data updates tanpa refresh

## 🔄 Development Workflow

### Branch Structure
```
main          → Production ready code
develop       → Development branch
feature/*     → New features
hotfix/*      → Emergency fixes
```

### Commit Convention
```
feat: Tambah fitur voting real-time
fix: Perbaikan bug security
docs: Update dokumentasi
style: Perbaikan UI/UX
```

## 🧪 Testing

### Test Suite
```bash
# Unit Tests
php artisan test

# Feature Tests
php artisan test --group=feature

# Security Tests
php artisan test --group=security
```

### Test Coverage
- Authentication Testing
- Voting Process Testing
- Admin Functionality Testing
- Security Vulnerability Testing

## 📊 Monitoring & Analytics

### System Metrics
- **Voting Participation Rates**
- **User Engagement Analytics**
- **System Performance Metrics**
- **Error Tracking dan Reporting**

### Logging
- **Voting Activity Logs**
- **User Action Tracking**
- **System Error Logs**
- **Security Incident Logs**

## 🚀 Deployment

### Production Setup
```bash
# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force

# Storage link
php artisan storage:link
```

### Environment Requirements
- **PHP:** 8.2+
- **Database:** MySQL 8.0+
- **Web Server:** Nginx/Apache
- **SSL Certificate:** HTTPS wajib untuk security

## 🤝 Contributing

### Development Process
1. Fork repository
2. Create feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open Pull Request

### Code Standards
- PSR-12 Coding Standards
- Laravel Pint untuk code formatting
- Comprehensive documentation
- Test coverage untuk new features

## 📄 License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.

## 🆘 Support

### Documentation
- [User Guide](docs/user-guide.md)
- [Admin Manual](docs/admin-manual.md)
- [API Documentation](docs/api.md)

### Support Channels
- **Email:** support@voteacademy.id
- **Issues:** GitHub Issues
- **Discussions:** GitHub Discussions

## 🎯 Roadmap

### Upcoming Features
- [ ] **Mobile App** - Native mobile application
- [ ] **Blockchain Integration** - Enhanced security dengan blockchain
- [ ] **Advanced Analytics** - Predictive analytics dan insights
- [ ] **Multi-language Support** - Internationalization
- [ ] **API Development** - RESTful API untuk integrasi

### Future Enhancements
- **AI-powered Insights** - Smart voting analytics
- **Voice Voting** - Accessibility features
- **Offline Voting** - Support untuk area limited connectivity
- **Integration Tools** - Integration dengan sistem sekolah existing

---

**VoteAcademy** - Transforming School Democracy with Modern Technology 🚀
