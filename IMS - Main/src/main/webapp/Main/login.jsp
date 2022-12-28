<%-- 
    Document   : login
    Created on : Dec 27, 2022, 9:54:22 PM
    Author     : Lycoris Cafe
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!doctype html>
<html lang="en" data-bs-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="../bootstrap-5.3.0/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <style>
            body {
                background-image: url('../Media/aaa.jpg');
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
            }
        </style>
        <br><br><br>
        <div class="container col-lg-4 col-md-5 align-self-center">
            <div class="card">
                <div class="card-header text-center">
                    <h3><i>Login</i></h3>
                </div>
                <div class="card-body">
                    <form action="login"  method="POST">
                        <div class="col-auto mb-3">
                            <label class="form-label">Username :</label>
                            <input type="text" class="form-control" name="username" aria-describedby="username">
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">Password :</label>
                            <input type="password" class="form-control" name="password" aria-describedby="password">
                            <label class="font-monospace text-danger"><i>${label}</i></label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="keeplogin">
                            <label class="form-check-label">Remember me!</label>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br><br><br>

        <script src="../bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
