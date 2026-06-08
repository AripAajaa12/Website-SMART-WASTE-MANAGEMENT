<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Waste Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f5f7fa;
        }

        .sidebar{
            height:100vh;
            background:#198754;
            color:white;
        }

        .sidebar a{
            color:white;
            text-decoration:none;
            display:block;
            padding:12px;
        }

        .sidebar a:hover{
            background:rgba(255,255,255,.2);
        }

        .card-box{
            border:none;
            border-radius:15px;
            box-shadow:0 3px 10px rgba(0,0,0,.1);
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-2 sidebar p-3">
            <h3>♻ Smart Waste</h3>
            <hr>

            <a href="#">Dashboard</a>
            <a href="#">Waste Categories</a>
            <a href="#">Waste Bins</a>
            <a href="#">Pickup Requests</a>
            <a href="#">Users</a>
            <a href="#">Logout</a>
        </div>

        <div class="col-md-10 p-4">

            <h2>Dashboard Smart Waste Management</h2>

            <div class="row mt-4">

                <div class="col-md-4">
                    <div class="card card-box">
                        <div class="card-body">
                            <h5>Total Waste Bin</h5>
                            <h2>15</h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-box">
                        <div class="card-body">
                            <h5>Total Categories</h5>
                            <h2>5</h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-box">
                        <div class="card-body">
                            <h5>Pickup Requests</h5>
                            <h2>12</h2>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card mt-4">
                <div class="card-header">
                    Data Waste Bin
                </div>

                <div class="card-body">

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Location</th>
                            <th>Fill Level</th>
                            <th>Status</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>Kampus A</td>
                            <td>75%</td>
                            <td>
                                <span class="badge bg-warning">
                                    Almost Full
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Kampus B</td>
                            <td>30%</td>
                            <td>
                                <span class="badge bg-success">
                                    Normal
                                </span>
                            </td>
                        </tr>

                        </tbody>

                    </table>

                </div>
            </div>

        </div>

    </div>
</div>

</body>
</html>