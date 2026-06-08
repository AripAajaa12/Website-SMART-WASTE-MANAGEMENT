<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Smart Waste Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{
    background:#f4f6f9;
}

.sidebar{
    min-height:100vh;
    background:#198754;
    color:white;
}

.sidebar a{
    color:white;
    text-decoration:none;
    display:block;
    padding:12px;
    border-radius:8px;
}

.sidebar a:hover{
    background:rgba(255,255,255,.15);
}

.card{
    border:none;
    box-shadow:0 2px 10px rgba(0,0,0,.1);
}

.stat-number{
    font-size:32px;
    font-weight:bold;
}

</style>

</head>
<body>

<div class="container-fluid">

<div class="row">

<!-- SIDEBAR -->
<div class="col-md-2 sidebar p-3">

    <h4 class="mb-4">
        ♻ Smart Waste
    </h4>

    <a href="/dashboard">
        Dashboard
    </a>

    <a href="/waste-bins">
        Waste Bins
    </a>

    <a href="#" onclick="logout()">
        Logout
    </a>
    <button onclick="logout()">
    Logout
</button>

</div>

<!-- CONTENT -->
<div class="col-md-10">

    <nav class="navbar navbar-light bg-white shadow-sm mb-4">

        <div class="container-fluid">

            <span class="navbar-brand">
                Smart Waste Monitoring Dashboard
            </span>

        </div>

    </nav>

    <!-- STATISTIC CARDS -->
    <div class="row mb-4">

        <div class="col-md-3">

            <div class="card">

                <div class="card-body">

                    <h6>Total Waste Bin</h6>

                    <div
                        class="stat-number text-success"
                        id="totalBin">
                        0
                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card">

                <div class="card-body">

                    <h6>Full Bin</h6>

                    <div
                        class="stat-number text-danger"
                        id="fullBin">
                        0
                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card">

                <div class="card-body">

                    <h6>Normal Bin</h6>

                    <div
                        class="stat-number text-primary"
                        id="normalBin">
                        0
                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card">

                <div class="card-body">

                    <h6>Empty Bin</h6>

                    <div
                        class="stat-number text-secondary"
                        id="emptyBin">
                        0
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- CHART -->
    <div class="row">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">
                    Status Waste Bin
                </div>

                <div class="card-body">

                    <canvas id="statusChart"></canvas>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card">

                <div class="card-header">
                    Monitoring Fill Level
                </div>

                <div
                    class="card-body"
                    id="fillContainer">

                </div>

            </div>

        </div>

    </div>
<div class="row mt-4">

    <div class="col-md-4">
        <a href="/waste-bins" class="btn btn-success w-100 p-4">
            ♻ Kelola Tempat Sampah
        </a>
    </div>

    <div class="col-md-4">
        <button class="btn btn-warning w-100 p-4">
            🚚 Riwayat Pengangkutan
        </button>
    </div>

    <div class="col-md-4">
        <button class="btn btn-primary w-100 p-4">
            📊 Export Laporan
        </button>
    </div>

</div>
<div class="col-md-3">
    <div class="card">
        <div class="card-body">

            <h6>Persentase Penuh</h6>

            <div
                class="stat-number text-danger"
                id="percentFull">

                0%

            </div>

        </div>
    </div>
</div>
    <!-- TABLE -->
    <div class="card mt-4">

        <div class="card-header">

            Daftar Waste Bin

            <a
                href="/waste-bins"
                class="btn btn-success btn-sm float-end">

                Kelola Waste Bin

            </a>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <thead class="table-success">

                <tr>
                    <th>ID</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Fill Level</th>
                </tr>

                </thead>

                <tbody id="tableBody">

                </tbody>

            </table>

        </div>

    </div>

</div>

</div>

</div>

<script>

const token = localStorage.getItem('token');

if(!token){

    window.location.href='/';

}

let chart;

loadDashboard();

async function loadDashboard(){

    try{

        const response = await fetch('/api/waste-bins',{

            headers:{
                Authorization:'Bearer '+token,
                Accept:'application/json'
            }

        });

        const bins = await response.json();

        let full = 0;
        let normal = 0;
        let empty = 0;

        let tableHTML = '';
        let fillHTML = '';

        bins.forEach(bin=>{

            if(bin.status === 'full') full++;
            else if(bin.status === 'normal') normal++;
            else if(bin.status === 'empty') empty++;

            tableHTML += `
                <tr>
                    <td>${bin.id}</td>
                    <td>${bin.location_name}</td>
                    <td>${bin.status}</td>
                    <td>${bin.fill_level}%</td>
                </tr>
            `;

            fillHTML += `

                <div class="mb-3">

                    <strong>
                        ${bin.location_name}
                    </strong>

                    <div class="progress">

                        <div
                            class="progress-bar"
                            style="width:${bin.fill_level}%">

                            ${bin.fill_level}%

                        </div>

                    </div>

                </div>

            `;

        });

        document.getElementById('totalBin').innerText =
            bins.length;

        document.getElementById('fullBin').innerText =
            full;

        document.getElementById('normalBin').innerText =
            normal;

        document.getElementById('emptyBin').innerText =
            empty;

        document.getElementById('tableBody').innerHTML =
            tableHTML;

        document.getElementById('fillContainer').innerHTML =
            fillHTML;
        const percent =
Math.round((full / bins.length) * 100);

document.getElementById('percentFull')
.innerText = percent + '%';

        createChart(full,normal,empty);

    }catch(error){

        console.log(error);

        alert('Gagal memuat dashboard');

    }

}

function createChart(full,normal,empty){

    const ctx =
        document.getElementById('statusChart');

    if(chart){
        chart.destroy();
    }

    chart = new Chart(ctx,{

        type:'doughnut',

        data:{

            labels:[
                'Full',
                'Normal',
                'Empty'
            ],

            datasets:[{

                data:[
                    full,
                    normal,
                    empty
                ]

            }]
        }

    });
}

function logout(){

    localStorage.removeItem('token');

    window.location.href='/';

}

</script>

</body>
</html>