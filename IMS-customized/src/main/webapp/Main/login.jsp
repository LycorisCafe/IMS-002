<%-- 
    Document   : login
    Created on : Dec 26, 2022, 8:04:21 PM
    Author     : Anupama
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
    <body>
        <style>
            body {
                background-image: url('../Media/images/bg.jpg');
            }
        </style>
        <div class="row justify-content-center">
            <div class="col col-5">
                <h1>Hey user, Login is here!</h1>
            </div>
        </div>
        <br>
        <form action="login" method="POST">
            <div class="row justify-content-center">
                <div class="col col-5">
                    <label for="exampleFormControlInput1" class="form-label">Username :</label>
                    <input type="text" class="form-control" name="username" placeholder="Enter username here!">
                </div>
            </div>
            <br>
            <div class="row justify-content-center">
                <div class="col col-5">
                    <label for="exampleFormControlTextarea1" class="form-label">Password :</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter password here!">
                </div>
            </div>
            <br>
            <div class="row justify-content-center">
                <div class="d-grid col-5">
                    <button type="submit" class="btn btn-primary mb-3">Login</button>
                </div>
            </div>
        </form>
        <script src="../bootstrap/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>
