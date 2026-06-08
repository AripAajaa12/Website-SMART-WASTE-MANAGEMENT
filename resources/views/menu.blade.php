<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Menu Smart Waste</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f6f9;
}

.menu-card{
    transition:.3s;
    border:none;
    border-radius:15px;
    box-shadow:0 2px 10px rgba(0,0,0,.1);
}

.menu-card:hover{
    transform:translateY(-5px);
}

.icon{
    font-size:50px;
}

</style>

</head>
<body>

<div class="container py-5">

    <div class="text-center mb-5">

        <h1>♻ Smart Waste Management</h1>

        <p class="text-muted">
            Sistem Monitoring Tempat Sampah Pintar
        </p>

    </div>

    <div class="row g-4">

        <!-- Dashboard -->
        <div class="col-md-4">

            <div class="card menu-card">

                <div class="card-body text-center">

                    <div class="icon">
                        📊
                    </div>

                    <h4>Dashboard</h4>

                    <p>
                        Monitoring statistik dan grafik.
                    </p>

                    <a
                        href="/dashboard"
                        class="btn btn-success">

                        Buka Dashboard

                    </a>

                </div>

            </div>

        </div>

        <!-- Waste Bin -->
        <div class="col-md-4">

            <div class="card menu-card">

                <div class="card-body text-center">

                    <div class="icon">
                        🗑️
                    </div>

                    <h4>Waste Bin</h4>

                    <p>
                        Kelola data tempat sampah.
                    </p>

                    <a
                        href="/waste-bins"
                        class="btn btn-primary">

                        Kelola Data

                    </a>

                </div>

            </div>

        </div>

        <!-- Pickup -->
        <div class="col-md-4">

            <div class="card menu-card">

                <div class="card-body text-center">

                    <div class="icon">
                        🚚
                    </div>

                    <h4>Pickup Request</h4>

                    <p>
                        Riwayat dan jadwal pengangkutan.
                    </p>

                    <button
                        class="btn btn-warning">

                        Segera Hadir

                    </button>

                </div>

            </div>

        </div>

        <!-- Export -->
        <div class="col-md-4">

            <div class="card menu-card">

                <div class="card-body text-center">

                    <div class="icon">
                        📄
                    </div>

                    <h4>Export CSV</h4>

                    <p>
                        Download laporan data sampah.
                    </p>

                    <a
                        href="/api/export"
                        class="btn btn-info">

                        Download

                    </a>

                </div>

            </div>

        </div>

        <!-- User -->
        <div class="col-md-4">

            <div class="card menu-card">

                <div class="card-body text-center">

                    <div class="icon">
                        👤
                    </div>

                    <h4>Profil User</h4>

                    <p>
                        Informasi akun pengguna.
                    </p>

                    <button
                        class="btn btn-secondary">

                        Profil

                    </button>

                </div>

            </div>

        </div>

        <!-- Logout -->
        <div class="col-md-4">

            <div class="card menu-card">

                <div class="card-body text-center">

                    <div class="icon">
                        🔐
                    </div>

                    <h4>Logout</h4>

                    <p>
                        Keluar dari sistem.
                    </p>

                    <button
                        onclick="logout()"
                        class="btn btn-danger">

                        Logout

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

if(!localStorage.getItem('token')){
    window.location.href='/';
}

function logout(){

    localStorage.removeItem('token');

    window.location.href='/';
}

</script>

</body>
</html>