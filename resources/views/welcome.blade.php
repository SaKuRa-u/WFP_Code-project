<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WFP - Layanan Konsultasi Kesehatan Modern</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        /* CSS Tambahan untuk Modernisasi Tanpa Sidebar */
        body {
            background-color: #f8fafc;
            font-family: 'Poppins', sans-serif;
            /* Pakai font yang lebih bagus */
            color: #334155;
        }

        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 0;
        }

        .card-custom {
            border-radius: 20px;
            border: none;
            overflow: hidden;
        }

        .btn-custom-lg {
            padding: 0.75rem 2rem;
            font-size: 1.1rem;
            border-radius: 12px;
            font-weight: 600;
        }
    </style>
</head>

<body>

    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-7 text-center text-lg-left mb-5 mb-lg-0 pr-lg-5">
                    <h1 class="display-4 font-weight-bold text-primary mb-3">
                        <i class="fas fa-heartbeat text-danger mr-2"></i>WFP
                    </h1>
                    <p class="lead text-muted mb-4" style="line-height: 1.9; font-weight: 300; font-size: 1.15rem;">
                        <span class="font-weight-600 text-dark">Solusi layanan kesehatan digital modern.</span> Konsultasi dokter spesialis, manajemen rekam medis, dan layanan resep obat jadi lebih <span class="font-weight-600 text-success">cepat</span>, <span class="font-weight-600 text-info">aman</span>, dan <span class="font-weight-600 text-primary">terintegrasi</span> dalam satu platform tanpa ribet.
                    </p>

                    <br>

                    @if (Route::has('login'))
                    <div class="mt-2">
                        @auth
                        <div class="alert alert-success d-inline-block p-2 px-3 shadow-sm mb-3 text-left rounded-pill border border-success-light">
                            <i class="fas fa-check-circle mr-2"></i> Anda telah masuk ke sistem medis.
                        </div>
                        <br>
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-custom-lg shadow px-4">
                            <i class="fas fa-tachometer-alt mr-2"></i> Masuk ke Dashboard Utama
                        </a>
                        @else
                        <div class="d-sm-flex justify-content-center justify-content-lg-start">
                            <a href="{{ route('login') }}" class="btn btn-primary btn-custom-lg shadow px-4 mb-2 mb-sm-0 mr-sm-3">
                                <i class="fas fa-sign-in-alt mr-2"></i> Masuk (Login)
                            </a>
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-custom-lg shadow-sm px-4">
                                <i class="fas fa-user-plus mr-2"></i> Daftar Akun Baru
                            </a>
                            @endif
                        </div>
                        @endauth
                    </div>
                    @endif
                </div>

                <div class="col-lg-5 text-center d-none d-lg-block pl-lg-5">
                    <div class="card card-custom bg-white shadow-lg border-light">
                        <div class="card-body p-5">
                            <div class="p-4 bg-light rounded-circle d-inline-block mx-auto mb-4 border border-light shadow-inner" style="width: 140px; height: 140px; line-height: 100px;">
                                <i class="fas fa-user-md text-primary" style="font-size: 5rem;"></i>
                            </div>
                            <h4 class="font-weight-bold text-dark mb-2">Konsultasi Medis Online</h4>
                            <p class="text-sm text-muted mb-0">Hubungkan kesehatan Anda dengan dokter spesialis terbaik kami kapan saja dan di mana saja.</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row text-center mt-5 pt-5 border-top border-light align-items-center">
                <div class="col-4 border-right border-light">
                    <h4 class="font-weight-bold text-primary mb-1">24 / 7</h4>
                    <p class="text-xs text-muted mb-0">Sistem Siaga</p>
                </div>
                <div class="col-4 border-right border-light">
                    <h4 class="font-weight-bold text-success mb-1">100+</h4>
                    <p class="text-xs text-muted mb-0">Dokter Spesialis</p>
                </div>
                <div class="col-4">
                    <h4 class="font-weight-bold text-info mb-1">SSL</h4>
                    <p class="text-xs text-muted mb-0">Data Terenkripsi</p>
                </div>
            </div>

        </div>
    </div>

</body>

</html>