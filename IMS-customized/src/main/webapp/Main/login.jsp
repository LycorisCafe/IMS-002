<%-- 
    Document   : login
    Created on : Dec 25, 2022, 11:37:17 PM
    Author     : Anupama
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Login</title>
        <link href="..\bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
        <!-- Custom styles for this template -->
        <link href="navbar-top.css" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">SFT Thaksalawa</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="Main/login.jsp">Login</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                  </li>
                </ul>
                <form class="d-flex">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
              </div>
            </div>
          </nav>
        <div class="background-image">
            <div class="container">
                <h1 class="display-3" style="text-align: center;">Science For Technology</h1><br><br>
            <div class="center">
                <center>
               
                <div class="card" style="width: 28rem;">
                    <img src="../Media/images/bg2.jpg" class="card-img-top" style="background-position: center; background-size: cover;">
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                              <label for="exampleInputUsername" class="form-label">Username</label>
                              <input type="text" class="form-control" id="exampleInputUsername" aria-describedby="usernameHelp">

                            </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label">Password</label>
                              <input type="password" class="form-control" id="exampleInputPassword1">
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
</center>
        </div>  
       </div>
        <br/><br/>
    </body>
</html>
