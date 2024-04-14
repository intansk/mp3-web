<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Kuma Car Spa</title>
        <link rel="stylesheet" href="../css/vertical-layout-light/style.css">
        <link rel="shortcut icon" href="../images/favicon.png" />

        <style>
            .role-main{
                display: flex;
                justify-content: center;
                align-items: center;
                flex-wrap: wrap;
                margin-top: 50px;
                gap: 4rem;
            }

            .title{
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 2rem;
                padding-bottom: 1rem;
            }

            .role-container {
                padding: 10rem 3rem;
            }

            p {
                font-size: 1.1rem;
            }

            a {
                text-decoration: none;
                color: black;
            }

            .pegawai, .pelanggan {
                width: 200px; 
                margin: 0 20px; 
                text-align: center;
            }

            .pegawai img, .pelanggan img {
                width: 200px; 
                height: 200px; 
                border-radius: 50%; 
                margin-bottom: 10px; 
            }
            </style>
    </head>

    <body>
        <div class="role-container">
            <h3 class="title">Pilih role login</h3>
            <div class="role-main">
                <div class="pegawai">
                    <a href="./login-pegawai.php">
                        <img src="https://m.media-amazon.com/images/I/41jLBhDISxL.jpg" class="rounded mx-auto d-block" alt="Login Pegawai">
                        <p>Pegawai</p>
                    </a>
                </div>
                <div class="pelanggan"> 
                    <a href="./login-pelanggan.php">
                        <img src="https://m.media-amazon.com/images/I/31Cd9UQp6eL._AC_UF1000,1000_QL80_.jpg" class="rounded mx-auto d-block" alt="Login Pelanggan">
                        <p>Pelanggan</p>
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
