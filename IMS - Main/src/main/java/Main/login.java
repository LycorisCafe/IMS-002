/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/JSP_Servlet/Servlet.java to edit this template
 */
package Main;

import jakarta.servlet.RequestDispatcher;
import jakarta.servlet.ServletException;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;
import java.awt.HeadlessException;
import java.io.IOException;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.SimpleDateFormat;
import java.util.Date;

/**
 *
 * @author Lycoris Cafe
 */
public class login extends HttpServlet {

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        String username = request.getParameter("username");
        String password = request.getParameter("password");

        String logtime = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").format(new Date());
        Connection con = Helper.DB.connect();
        int x = 0;
        try {
            Statement stmt = con.createStatement();
            ResultSet rs = stmt.executeQuery("SELECT * "
                    + "FROM login "
                    + "WHERE user='" + username + "' "
                    + "AND pass='" + password + "'");
            while (rs.next()) {
                String userid = rs.getString("id");
                x = 1;
                Statement stmt2 = con.createStatement();
                stmt2.executeUpdate("UPDATE login SET lastLogin='" + logtime + "' "
                        + "WHERE id='" + userid + "'");
            }
            con.close();
        } catch (HeadlessException | SQLException e) {
            System.out.println(e);
        }
        if (x == 1) {
            RequestDispatcher rd = request.getRequestDispatcher("Admin");
            rd.forward(request, response);
        } else {
            RequestDispatcher rd = request.getRequestDispatcher("login.jsp");
            request.setAttribute("label", "Invalid username or password!");
            rd.forward(request, response);
        }
    }
}
