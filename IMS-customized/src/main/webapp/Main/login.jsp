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
    </head>
    <body>
        <div class="background-image">
            <div class="center">
                <h1>Login</h1>
                <form action="#" method="POST">
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
        
    </body>
</html>
