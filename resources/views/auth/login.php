<!DOCTYPE html>
<html>
<head>
    <title>Login Smart Waste</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:#f4f6f9">

<div class="container">

    <div class="row vh-100 justify-content-center align-items-center">

        <div class="col-md-4">

            <div class="card shadow">

                <div class="card-body">

                    <h2 class="text-center mb-4">
                        Smart Waste Login
                    </h2>

                    <form id="loginForm">

                        <div class="mb-3">
                            <input
                                type="email"
                                id="email"
                                class="form-control"
                                placeholder="Email"
                            >
                        </div>

                        <div class="mb-3">
                            <input
                                type="password"
                                id="password"
                                class="form-control"
                                placeholder="Password"
                            >
                        </div>

                        <button
                            type="submit"
                            class="btn btn-success w-100">
                            Login
                        </button>

                    </form>

                    <div id="message" class="mt-3"></div>

                    <div class="text-center mt-3">
                        <a href="/register">
                            Belum punya akun?
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

<script>
document.getElementById('loginForm').addEventListener('submit', async function(e){

    e.preventDefault();

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    try{

        const response = await fetch('/api/login-jwt',{

            method:'POST',

            headers:{
                'Content-Type':'application/json',
                'Accept':'application/json'
            },

            body:JSON.stringify({
                email:email,
                password:password
            })

        });

        const data = await response.json();

        console.log(data);

        if(response.ok){

            localStorage.setItem(
                'token',
                data.access_token
            );

            window.location.href='/menu';

        }else{

            document.getElementById('message').innerHTML =
            '<div class="alert alert-danger">Email atau Password salah</div>';

        }

    }catch(error){

        console.log(error);

        alert('Terjadi kesalahan saat login');

    }

});
</script>