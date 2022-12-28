<%-- 
    Document   : main
    Created on : Dec 28, 2022, 3:27:17 PM
    Author     : Anupama
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ page import="java.io.PrintWriter"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">FirstName</th>
                    <th scope="col">LastName</th>
                    <th scope="col">GuardianName</th>
                    <th scope="col">Address</th>
                </tr>
            </thead>
            <tbody>
                <% 
int myCount = Integer.parseInt (request.getParameter("count"));
PrintWriter out = request.getWriter();
for (int count = 0; count < myCount ; count++) {
                
                
               out.print("<tr>"); 
                    out.print("<th scope="row">count</th>"); 
                    out.print("<td>name1[count]</td>"); 
                    out.print("<td>name2[count]</td>"); 
                    out.print("<td>g[count]</td>"); 
                    out.print("<td>a[count]</td>"); 
                out.print("</tr>
                
                            
                        }
                %>
            </tbody>
        </table>
    </body>
</html>
