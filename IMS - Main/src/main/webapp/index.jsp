<%-- 
    Document   : index
    Created on : Dec 27, 2022, 10:13:29 PM
    Author     : Anupama
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!doctype html>
<html lang="en" data-bs-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="bootstrap-5.3.0/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>

        <nav class="navbar navbar-expand-md bg-body-tertiary fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.jsp">
                    <img src="Media/LycorisCafe.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                    Lycoris Cafe
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" href="Main/login.jsp">Login</a>
                        <a class="nav-link" href="Main/about.jsp">About Us</a>
                    </div>
                </div>
            </div>
        </nav>
        <img src="Media/images/bg3.png" class="d-block w-100" alt="image">
        <div class="container text-center">
            <div class="display-1">
                <b>Lycoris Cafe</b>
            </div>
            <h6><i>Your Choice, Our Serve!</i></h6>
        </div>
        <br>
        <div class="container">
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu 
            fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt
            in culpa qui officia deserunt mollit anim id est laborum."
        </div>
        <br>
        <footer>
            <div class="container-fluid bg-primary-subtle text-emphasis-primary">
                <br>
                <div class="row align-items-center">
                    <div class="container col-lg-3 col-md-3 col-xs-12 text-center">
                        <img src="Media/LycorisCafe.png" class="img-fluid rounded"  alt="img">
                    </div>
                    <div class="container col-md-4 col-xs-12">
                        <div class="display-2">Lycoris Cafe</div>
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu 
                        fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt
                        in culpa qui officia deserunt mollit anim id est laborum."
                    </div>
                </div>
                <br>
            </div>
        </footer>
        <script src="bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
