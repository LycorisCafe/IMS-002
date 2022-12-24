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
        <link href="..\ExternalCSS/style.css" rel="stylesheet">
        <link href="..\bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="background-image">
            <h1 class="header">Science For Technology</h1>
            <div class="center">
                <h1 class="hd">Login</h1>
                <form action="AdminPanel.jsp" method="POST">
                    <div class="txt-field">
                        <input type="text" name="username" required>
                        <span></span>
                        <label>Username</label>
                    </div>
                    <div class="txt-field">
                        <input type="Password" name="password" required>
                        <span></span>
                        <label>Password</label>
                    </div>
                    <input type="submit" name="submit" value="Login">
                </form>
            </div>
        </div>  
        
        <footer class="footer">

            <div class="container-fluid bg-primary">
                <div class="row">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <br>
                            <h3>About US</h3>
                        </div>
                        <p> Welcome to our Software Development team! We are a group of passionate and dedicated software developers who are excited to be starting out in this exciting field. We are eager to learn and build our skills, and we are committed to delivering high-quality software solutions that meet the needs of our customers and stakeholders. Our team consists of experienced professionals who are proficient in a variety of programming languages and technologies, and we use agile development methodologies to ensure that we are continuously improving and delivering value. We are excited to share our knowledge and expertise with you and we look forward to working together to create innovative software applications.</p>   
                        <div class="footer-right">
                            <a class="btn btn-dark p-3" href="https://github.com/LycorisCafe" role="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                                <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
                                </svg>
                                &copy; 2022 Lycoris Cafe
                            </a>
                        </div>   
                        <h4><br></h4>
                    </div>
                </div>
        </footer>
        
    </body>
</html>
