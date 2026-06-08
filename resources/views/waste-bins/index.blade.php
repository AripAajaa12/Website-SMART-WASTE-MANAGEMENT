<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waste Bin Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
        }

        .card{
            border:none;
            box-shadow:0 2px 10px rgba(0,0,0,.1);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">

        <a class="navbar-brand" href="#">
            ♻ Smart Waste
        </a>

        <button onclick="logout()">
    Logout
</button>

    </div>
</nav>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h3>Waste Bin Management</h3>

        <button
            class="btn btn-success"
            data-bs-toggle="modal"
            data-bs-target="#addModal">
            + Tambah Waste Bin
        </button>

    </div>

    <div class="card">

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-success">

<tr>
    <th>Lokasi</th>
    <th width="250">Tingkat Kepenuhan</th>
    <th>Status</th>
    <th>Kategori Sampah</th>
    <th>Kondisi</th>
    <th width="120">Aksi</th>
</tr>

</thead>

                <tbody id="tableBody">

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- Modal Tambah -->
<div class="modal fade" id="addModal">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
    <h5>➕ Tambah Lokasi Tempat Sampah</h5>
</div>

<div class="modal-body">

    <input
        type="text"
        id="location_name"
        class="form-control mb-3"
        placeholder="Contoh: Surabaya Pusat">

    <input
        type="number"
        step="any"
        id="latitude"
        class="form-control mb-3"
        placeholder="Latitude">

    <input
        type="number"
        step="any"
        id="longitude"
        class="form-control mb-3"
        placeholder="Longitude">

    <input
        type="number"
        id="fill_level"
        class="form-control mb-3"
        placeholder="Tingkat Kepenuhan (%)">

    <select
        id="status"
        class="form-select mb-3">

        <option value="empty">🟢 Kosong</option>
        <option value="normal">🟡 Normal</option>
        <option value="full">🔴 Penuh</option>

    </select>

    <select
        id="waste_category_id"
        class="form-select">

        <option value="1">Organik</option>
        <option value="2">Anorganik</option>
        <option value="3">Plastik</option>
        <option value="4">Kertas</option>

    </select>

</div>

            <div class="modal-footer">

                <button
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    Batal
                </button>

                <button
                    onclick="createData()"
                    class="btn btn-success">
                    Simpan
                </button>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

const token = localStorage.getItem('token');

if(!token){
    window.location.href='/';
}

loadData();

async function loadData(){

    try{

        const response = await fetch('/api/waste-bins',{

            headers:{
                'Authorization':'Bearer '+token,
                'Accept':'application/json'
            }

        });

        const data = await response.json();

        let html = '';

        data.forEach(item => {

            html += `
            <tr>

                <td>
                    📍 ${item.location_name}
                </td>

                <td>

                    <div class="progress">

                        <div
                            class="progress-bar bg-success"
                            role="progressbar"
                            style="width:${item.fill_level}%">

                            ${item.fill_level}%

                        </div>

                    </div>

                </td>

                <td>

                    <span class="badge bg-${getStatusColor(item.status)}">

                        ${translateStatus(item.status)}

                    </span>

                </td>

                <td>

                    ${item.category ? item.category.name : 'Organik'}

                </td>

                <td>

                    ${getCondition(item.fill_level)}

                </td>

                <td>

                    <button
                        onclick="deleteData(${item.id})"
                        class="btn btn-danger btn-sm">

                        Hapus

                    </button>

                </td>

            </tr>
            `;
        });

        document.getElementById('tableBody').innerHTML = html;

    }catch(error){

        console.log(error);

        alert('Gagal mengambil data');

    }

}

function getStatusColor(status){

    switch(status){

        case 'full':
            return 'danger';

        case 'normal':
            return 'success';

        case 'empty':
            return 'secondary';

        default:
            return 'primary';
    }
}

async function createData(){

    try{

        const payload = {

            location_name:
                document.getElementById('location_name').value,

            latitude:
                document.getElementById('latitude').value,

            longitude:
                document.getElementById('longitude').value,

            fill_level:
                document.getElementById('fill_level').value,

            status:
                document.getElementById('status').value,

            waste_category_id:
                document.getElementById('waste_category_id').value
        };

        console.log('DATA DIKIRIM:', payload);

        const response = await fetch('/api/waste-bins', {

            method: 'POST',

            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + token
            },

            body: JSON.stringify(payload)

        });

        if(response.ok){

            const result = await response.json();

            console.log('BERHASIL:', result);

            alert('Data berhasil disimpan');

            location.reload();

        }else{

            const errorText = await response.text();

            console.log('ERROR:', errorText);

            alert(errorText);

        }

    }catch(error){

        console.log('CATCH ERROR:', error);

        alert(error.message);

    }
}
async function deleteData(id){

    if(!confirm('Yakin ingin menghapus data?')){
        return;
    }

    try{

        const response = await fetch('/api/waste-bins/' + id,{

            method:'DELETE',

            headers:{
                'Authorization':'Bearer '+token
            }

        });

        if(response.ok){

            loadData();

        }else{

            alert('Gagal menghapus data');

        }

    }catch(error){

        console.log(error);

        alert('Terjadi kesalahan');

    }
}

function translateStatus(status){

    switch(status){

        case 'full':
            return 'Penuh';

        case 'normal':
            return 'Normal';

        case 'empty':
            return 'Kosong';

        default:
            return status;
    }
}

function getCondition(level){

    level = parseInt(level);

    if(level >= 90){
        return '🔴 Segera Diangkut';
    }

    if(level >= 70){
        return '🟡 Perlu Dipantau';
    }

    return '🟢 Aman';
}

function logout(){

    localStorage.removeItem('token');

    window.location.href='/';

}

</script>

</body>
</html>