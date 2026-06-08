<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Smart Waste</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
        }

        .card-register{
            max-width:500px;
            margin:auto;
            margin-top:50px;
            border:none;
            border-radius:15px;
            box-shadow:0 0 15px rgba(0,0,0,.1);
        }
    </style>
</head>
<body>

<div class="container">

    <div class="card card-register">

        <div class="card-body">

            <h2 class="text-center mb-4">
                Registrasi Smart Waste
            </h2>

            <form id="registerForm">

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" id="name" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" id="email" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" id="password" class="form-control">
                </div>

                <button type="submit" class="btn btn-success w-100">
                    Register
                </button>

            </form>

            <div id="message" class="mt-3"></div>

            <div class="text-center mt-3">
                <a href="/">Sudah punya akun? Login</a>
            </div>

        </div>

    </div>

</div>

<script>

document.getElementById('registerForm').addEventListener('submit', async function(e){

    e.preventDefault();

    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    try{

        const response = await fetch('/api/register',{

            method:'POST',

            headers:{
                'Content-Type':'application/json'
            },

            body:JSON.stringify({
                name,
                email,
                password
            })

        });

        const data = await response.json();

        if(response.ok){

            document.getElementById('message').innerHTML =
            '<div class="alert alert-success">Registrasi berhasil. Silakan login.</div>';

            setTimeout(()=>{
                window.location.href='/';
            },1500);

        }else{

            document.getElementById('message').innerHTML =
            '<div class="alert alert-danger">'+
            (data.message || 'Registrasi gagal')+
            '</div>';

        }

    }catch(error){

        document.getElementById('message').innerHTML =
        '<div class="alert alert-danger">Server Error</div>';

    }

});

</script>

</body>
</html>