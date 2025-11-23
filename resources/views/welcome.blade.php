<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VoteAcademy - Sistem E-Voting Sekolah Modern</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .modern-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        }

        .accent-gradient {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
        }

        .success-gradient {
            background: linear-gradient(135deg, #00d2d3 0%, #54a0ff 100%);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite alternate;
        }

        @keyframes pulse-glow {
            from { box-shadow: 0 0 20px rgba(102, 126, 234, 0.4); }
            to { box-shadow: 0 0 30px rgba(102, 126, 234, 0.8); }
        }

        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .border-gradient {
            border: 2px solid transparent;
            background: linear-gradient(white, white) padding-box,
                        linear-gradient(135deg, #667eea, #764ba2) border-box;
        }

        .stats-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(255, 255, 255, 0.7) 100%);
            backdrop-filter: blur(10px);
        }

        .nav-blur {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
        }

        .section-spacing {
            padding: 100px 0;
        }

        .hero-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="rgba(255,255,255,0.05)" points="0,1000 1000,0 1000,1000"/></svg>');
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            font-size: 28px;
        }

        .candidate-avatar {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 24px;
            color: white;
        }

        .progress-bar {
            height: 8px;
            border-radius: 10px;
            overflow: hidden;
            background: #e9ecef;
        }

        .progress-fill {
            height: 100%;
            border-radius: 10px;
            transition: width 1s ease-in-out;
        }

        .testimonial-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border-left: 4px solid #667eea;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-secondary {
            background: transparent;
            color: #667eea;
            border: 2px solid #667eea;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- Navigation -->
    <nav class="fixed w-full top-0 z-50 nav-blur border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 modern-gradient rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-vote-yea text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">VoteAcademy</h1>
                        <p class="text-xs text-purple-600 font-semibold">Modern Voting System</p>
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-gray-700 hover:text-purple-600 font-semibold transition-colors">Beranda</a>
                    <a href="#features" class="text-gray-700 hover:text-purple-600 font-semibold transition-colors">Fitur</a>
                    <a href="#candidates" class="text-gray-700 hover:text-purple-600 font-semibold transition-colors">Kandidat</a>
                    <a href="#results" class="text-gray-700 hover:text-purple-600 font-semibold transition-colors">Hasil</a>
                    <a href="#testimonials" class="text-gray-700 hover:text-purple-600 font-semibold transition-colors">Testimoni</a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4">
                    <button class="hidden md:block text-gray-700 hover:text-purple-600 font-semibold transition-colors px-4 py-2">
                        <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                    </button>
                    <button class="btn-primary">
                        <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-bg text-white section-spacing pt-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Hero Content -->
                <div class="space-y-8">
                    <div class="inline-flex items-center space-x-2 bg-white/20 px-4 py-2 rounded-full backdrop-blur-sm">
                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                        <span class="text-sm font-semibold">✨ Platform Voting Modern #1</span>
                    </div>

                    <h1 class="text-5xl lg:text-6xl font-bold leading-tight">
                        Demokrasi Digital
                        <span class="text-white block mt-2">Yang Lebih Baik</span>
                    </h1>

                    <p class="text-xl text-white/90 leading-relaxed">
                        Transformasi sistem pemilihan sekolah dengan teknologi terkini. Cepat, aman, dan transparan untuk masa depan pendidikan yang lebih demokratis.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <button class="bg-white text-purple-600 px-8 py-4 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transition-all hover:scale-105 flex items-center justify-center space-x-2">
                            <span>Mulai Voting</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                        <button class="border-2 border-white text-white hover:bg-white hover:text-purple-600 px-8 py-4 rounded-xl font-bold text-lg transition-all flex items-center justify-center space-x-2">
                            <i class="fas fa-play-circle"></i>
                            <span>Lihat Demo</span>
                        </button>
                    </div>

                    <!-- Stats Row -->
                    <div class="grid grid-cols-3 gap-6 pt-8">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-white">500+</div>
                            <div class="text-sm text-white/80 mt-1">Sekolah</div>
                        </div>
                        <div class="text-center border-x border-white/20">
                            <div class="text-2xl font-bold text-white">50K+</div>
                            <div class="text-sm text-white/80 mt-1">Siswa</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-white">99.9%</div>
                            <div class="text-sm text-white/80 mt-1">Kepuasan</div>
                        </div>
                    </div>
                </div>

                <!-- Hero Visual -->
                <div class="relative">
                    <div class="glass-effect rounded-3xl p-8 shadow-2xl card-hover">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h3 class="text-2xl font-bold text-white">Live Dashboard</h3>
                                <p class="text-white/80">Pemilihan Ketua OSIS 2024</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="relative flex h-3 w-3">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                                </span>
                                <span class="text-sm font-semibold text-green-400">LIVE</span>
                            </div>
                        </div>

                        <!-- Candidates Progress -->
                        <div class="space-y-6">
                            <div class="space-y-2">
                                <div class="flex justify-between text-sm text-white/80">
                                    <span>Ahmad Fauzi</span>
                                    <span>58%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill modern-gradient" style="width: 58%"></div>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div class="flex justify-between text-sm text-white/80">
                                    <span>Siti Nurhaliza</span>
                                    <span>42%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill accent-gradient" style="width: 42%"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="grid grid-cols-3 gap-4 mt-8 pt-6 border-t border-white/20">
                            <div class="text-center">
                                <div class="text-xl font-bold text-white">1,466</div>
                                <div class="text-xs text-white/60">Total Suara</div>
                            </div>
                            <div class="text-center">
                                <div class="text-xl font-bold text-green-400">87%</div>
                                <div class="text-xs text-white/60">Partisipasi</div>
                            </div>
                            <div class="text-center">
                                <div class="text-xl font-bold text-orange-400">3h</div>
                                <div class="text-xs text-white/60">Sisa Waktu</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="section-spacing bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                    Mengapa Memilih
                    <span class="text-gradient">VoteAcademy?</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Platform voting modern dengan fitur-fitur canggih untuk pengalaman pemilihan yang luar biasa
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-3xl border-gradient card-hover">
                    <div class="feature-icon modern-gradient text-white mb-6">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Keamanan Terjamin</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Sistem enkripsi end-to-end dan teknologi blockchain untuk memastikan setiap suara aman dan tidak bisa dimanipulasi.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-3xl border-gradient card-hover">
                    <div class="feature-icon success-gradient text-white mb-6">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Cepat & Efisien</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Proses voting hanya butuh 30 detik dengan hasil real-time. Hemat waktu dan sumber daya.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-3xl border-gradient card-hover">
                    <div class="feature-icon accent-gradient text-white mb-6">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Analitik Real-Time</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Pantau perkembangan pemilihan secara live dengan dashboard interaktif dan visualisasi data yang menarik.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white p-8 rounded-3xl border-gradient card-hover">
                    <div class="feature-icon modern-gradient text-white mb-6">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Multi-Device</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Akses dari smartphone, tablet, atau desktop. Responsif di semua perangkat dan browser.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="bg-white p-8 rounded-3xl border-gradient card-hover">
                    <div class="feature-icon success-gradient text-white mb-6">
                        <i class="fas fa-file-export"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Laporan Lengkap</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Hasil pemilihan dapat diekspor dalam berbagai format (PDF, Excel) untuk dokumentasi dan analisis.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="bg-white p-8 rounded-3xl border-gradient card-hover">
                    <div class="feature-icon accent-gradient text-white mb-6">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Support 24/7</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Tim support siap membantu kapan saja melalui chat, email, atau telepon untuk memastikan kelancaran proses.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Candidates Section -->
    <section id="candidates" class="section-spacing bg-gradient-to-br from-gray-900 to-gray-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold mb-6">
                    Meet The
                    <span class="text-gradient">Candidates</span>
                </h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                    Kenali visi, misi, dan program kerja masing-masing kandidat sebelum menentukan pilihan
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Candidate 1 -->
                <div class="glass-effect rounded-3xl p-8 card-hover">
                    <div class="flex items-start space-x-6 mb-6">
                        <div class="candidate-avatar modern-gradient">
                            AF
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-2">Ahmad Fauzi Ramadhan</h3>
                            <p class="text-purple-300 font-semibold">Calon Ketua OSIS</p>
                            <p class="text-gray-400 text-sm">Kelas 11 IPA 1</p>
                        </div>
                    </div>

                    <div class="space-y-4 mb-6">
                        <div>
                            <h4 class="font-bold text-purple-300 mb-2">🎯 Visi & Misi</h4>
                            <p class="text-gray-300 leading-relaxed">
                                "Mewujudkan OSIS yang inovatif, berprestasi, dan menjadi wadah pengembangan potensi siswa melalui program-program kreatif dan bermanfaat."
                            </p>
                        </div>
                        <div>
                            <h4 class="font-bold text-purple-300 mb-2">✨ Program Unggulan</h4>
                            <ul class="grid grid-cols-1 gap-2 text-sm">
                                <li class="flex items-center text-gray-300">
                                    <i class="fas fa-check-circle text-green-400 mr-2"></i>
                                    Digital Learning Hub
                                </li>
                                <li class="flex items-center text-gray-300">
                                    <i class="fas fa-check-circle text-green-400 mr-2"></i>
                                    Student Startup Incubator
                                </li>
                                <li class="flex items-center text-gray-300">
                                    <i class="fas fa-check-circle text-green-400 mr-2"></i>
                                    Eco-School Movement
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-6 border-t border-gray-700">
                        <div>
                            <div class="text-2xl font-bold text-purple-300">856 suara</div>
                            <div class="text-gray-400 text-sm">58% dukungan</div>
                        </div>
                        <button class="btn-primary">
                            <i class="fas fa-vote-yea mr-2"></i>Pilih
                        </button>
                    </div>
                </div>

                <!-- Candidate 2 -->
                <div class="glass-effect rounded-3xl p-8 card-hover">
                    <div class="flex items-start space-x-6 mb-6">
                        <div class="candidate-avatar accent-gradient">
                            SN
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-2">Siti Nurhaliza Putri</h3>
                            <p class="text-pink-300 font-semibold">Calon Ketua OSIS</p>
                            <p class="text-gray-400 text-sm">Kelas 11 IPS 2</p>
                        </div>
                    </div>

                    <div class="space-y-4 mb-6">
                        <div>
                            <h4 class="font-bold text-pink-300 mb-2">🎯 Visi & Misi</h4>
                            <p class="text-gray-300 leading-relaxed">
                                "Menciptakan lingkungan sekolah yang kreatif, inklusif, dan penuh semangat kebersamaan dengan fokus pada pengembangan seni dan sosial."
                            </p>
                        </div>
                        <div>
                            <h4 class="font-bold text-pink-300 mb-2">✨ Program Unggulan</h4>
                            <ul class="grid grid-cols-1 gap-2 text-sm">
                                <li class="flex items-center text-gray-300">
                                    <i class="fas fa-check-circle text-green-400 mr-2"></i>
                                    Creative Art Festival
                                </li>
                                <li class="flex items-center text-gray-300">
                                    <i class="fas fa-check-circle text-green-400 mr-2"></i>
                                    Social Care Movement
                                </li>
                                <li class="flex items-center text-gray-300">
                                    <i class="fas fa-check-circle text-green-400 mr-2"></i>
                                    Student Voice Channel
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-6 border-t border-gray-700">
                        <div>
                            <div class="text-2xl font-bold text-pink-300">610 suara</div>
                            <div class="text-gray-400 text-sm">42% dukungan</div>
                        </div>
                        <button class="btn-primary">
                            <i class="fas fa-vote-yea mr-2"></i>Pilih
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Results Section -->
    <section id="results" class="section-spacing bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                    Hasil Voting
                    <span class="text-gradient">Real-Time</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Pantau perkembangan pemilihan secara transparan dan real-time
                </p>
            </div>

            <!-- Results Overview -->
            <div class="bg-white rounded-3xl p-8 shadow-xl mb-12">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">Pemilihan Ketua OSIS 2024</h3>
                        <p class="text-gray-600">SMA Nusantara Jaya • Periode 15-17 Desember 2024</p>
                    </div>
                    <div class="flex items-center space-x-2 bg-green-50 px-4 py-2 rounded-full">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                        <span class="font-semibold text-green-700">LIVE</span>
                    </div>
                </div>

                <!-- Results Chart -->
                <div class="space-y-6">
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Ahmad Fauzi Ramadhan</span>
                            <span>856 suara (58%)</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill modern-gradient" style="width: 58%"></div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Siti Nurhaliza Putri</span>
                            <span>610 suara (42%)</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill accent-gradient" style="width: 42%"></div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-8 pt-8 border-t border-gray-200">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-900">1,466</div>
                        <div class="text-sm text-gray-600">Total Suara</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-600">87%</div>
                        <div class="text-sm text-gray-600">Partisipasi</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-blue-600">3h 24m</div>
                        <div class="text-sm text-gray-600">Sisa Waktu</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-purple-600">24/mnt</div>
                        <div class="text-sm text-gray-600">Suara Baru</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="section-spacing bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                    Yang Mereka Katakan
                    <span class="text-gradient">Tentang Kami</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Testimoni dari sekolah-sekolah yang telah mempercayakan sistem pemilihan mereka pada VoteAcademy
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="testimonial-card p-8 rounded-3xl shadow-lg card-hover">
                    <div class="flex items-center mb-6">
                        <div class="w-14 h-14 modern-gradient rounded-full flex items-center justify-center text-white font-bold text-lg">
                            HW
                        </div>
                        <div class="ml-4">
                            <h4 class="font-bold text-gray-900">Drs. Hendra Wijaya</h4>
                            <p class="text-sm text-gray-600">Kepala Sekolah</p>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed italic">
                        "VoteAcademy benar-benar mengubah cara kami melakukan pemilihan. Prosesnya cepat, transparan, dan siswa sangat antusias!"
                    </p>
                    <div class="flex text-yellow-400 mt-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="testimonial-card p-8 rounded-3xl shadow-lg card-hover">
                    <div class="flex items-center mb-6">
                        <div class="w-14 h-14 success-gradient rounded-full flex items-center justify-center text-white font-bold text-lg">
                            AR
                        </div>
                        <div class="ml-4">
                            <h4 class="font-bold text-gray-900">Ahmad Rizki, S.Pd</h4>
                            <p class="text-sm text-gray-600">Pembina OSIS</p>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed italic">
                        "Sistem yang sangat user-friendly! Hasil langsung terlihat dan laporannya lengkap. Sangat membantu pekerjaan kami."
                    </p>
                    <div class="flex text-yellow-400 mt-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="testimonial-card p-8 rounded-3xl shadow-lg card-hover">
                    <div class="flex items-center mb-6">
                        <div class="w-14 h-14 accent-gradient rounded-full flex items-center justify-center text-white font-bold text-lg">
                            SN
                        </div>
                        <div class="ml-4">
                            <h4 class="font-bold text-gray-900">Siti Nurjanah</h4>
                            <p class="text-sm text-gray-600">Ketua OSIS</p>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed italic">
                        "Sebagai kandidat, saya merasa prosesnya sangat adil dan transparan. Semua orang bisa lihat hasil secara real-time."
                    </p>
                    <div class="flex text-yellow-400 mt-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section-spacing gradient-bg text-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl lg:text-5xl font-bold mb-6">
                Siap Memulai Voting Digital?
            </h2>
            <p class="text-xl text-white/90 mb-12 max-w-3xl mx-auto leading-relaxed">
                Bergabunglah dengan ratusan sekolah yang telah mempercayai VoteAcademy untuk sistem pemilihan digital mereka
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-16">
                <button class="bg-white text-purple-600 px-10 py-4 rounded-xl font-bold text-lg shadow-2xl hover:shadow-3xl transition-all hover:scale-105 flex items-center justify-center space-x-2">
                    <i class="fas fa-rocket"></i>
                    <span>Coba Gratis</span>
                </button>
                <button class="border-2 border-white text-white hover:bg-white hover:text-purple-600 px-10 py-4 rounded-xl font-bold text-lg transition-all flex items-center justify-center space-x-2">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Request Demo</span>
                </button>
            </div>

            <!-- Trust Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 pt-12 border-t border-white/20">
                <div>
                    <div class="text-3xl font-bold">500+</div>
                    <div class="text-white/80 mt-2">Sekolah</div>
                </div>
                <div>
                    <div class="text-3xl font-bold">50K+</div>
                    <div class="text-white/80 mt-2">Siswa</div>
                </div>
                <div>
                    <div class="text-3xl font-bold">2K+</div>
                    <div class="text-white/80 mt-2">Pemilihan</div>
                </div>
                <div>
                    <div class="text-3xl font-bold">99.8%</div>
                    <div class="text-white/80 mt-2">Kepuasan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <!-- Brand -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-12 h-12 modern-gradient rounded-xl flex items-center justify-center">
                            <i class="fas fa-vote-yea text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold">VoteAcademy</h3>
                            <p class="text-sm text-gray-400">Modern Voting System</p>
                        </div>
                    </div>
                    <p class="text-gray-400 leading-relaxed mb-6 max-w-md">
                        Platform e-voting modern untuk sekolah-sekolah di Indonesia. Aman, transparan, dan mudah digunakan.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-purple-600 rounded-lg flex items-center justify-center transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-purple-600 rounded-lg flex items-center justify-center transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-purple-600 rounded-lg flex items-center justify-center transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-purple-600 rounded-lg flex items-center justify-center transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-bold text-lg mb-6">Menu Cepat</h4>
                    <ul class="space-y-3">
                        <li><a href="#features" class="text-gray-400 hover:text-purple-400 transition-colors">Fitur</a></li>
                        <li><a href="#candidates" class="text-gray-400 hover:text-purple-400 transition-colors">Kandidat</a></li>
                        <li><a href="#results" class="text-gray-400 hover:text-purple-400 transition-colors">Hasil</a></li>
                        <li><a href="#testimonials" class="text-gray-400 hover:text-purple-400 transition-colors">Testimoni</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h4 class="font-bold text-lg mb-6">Dukungan</h4>
                    <ul class="space-y-3">
                        <li class="flex items-center text-gray-400">
                            <i class="fas fa-envelope mr-3"></i>
                            support@voteacademy.id
                        </li>
                        <li class="flex items-center text-gray-400">
                            <i class="fas fa-phone mr-3"></i>
                            +62 812-3456-7890
                        </li>
                        <li class="flex items-center text-gray-400">
                            <i class="fas fa-question-circle mr-3"></i>
                            Pusat Bantuan
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-gray-800 text-center">
                <p class="text-gray-400">
                    © 2024 VoteAcademy. All rights reserved. Made with ❤️ in Indonesia
                </p>
            </div>
        </div>
    </footer>

    <!-- Floating Action Button -->
    <button class="fixed bottom-8 right-8 w-14 h-14 modern-gradient rounded-full shadow-2xl hover:shadow-3xl transition-all hover:scale-110 z-50 flex items-center justify-center text-white">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        // Smooth Scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Scroll to Top
        document.querySelector('.fixed.bottom-8.right-8').addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Animate progress bars on scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const progressBars = entry.target.querySelectorAll('.progress-fill');
                    progressBars.forEach(bar => {
                        const width = bar.style.width;
                        bar.style.width = '0%';
                        setTimeout(() => {
                            bar.style.width = width;
                        }, 500);
                    });
                }
            });
        });

        document.querySelectorAll('#results, #candidates').forEach(section => {
            observer.observe(section);
        });
    </script>
</body>
</html>
