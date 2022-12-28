/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/JSP_Servlet/Servlet.java to edit this template
 */
package Admin;

import jakarta.servlet.RequestDispatcher;
import java.io.IOException;
import jakarta.servlet.ServletException;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;

/**
 *
 * @author Anupama
 */
public class main extends HttpServlet {

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        Connection con = Helper.DB.connect();
        int count = 0;
        ArrayList<String> fName = new ArrayList<>();
        ArrayList<String> lName = new ArrayList<>();
        ArrayList<String> gName = new ArrayList<>();
        ArrayList<String> address = new ArrayList<>();
        try {
            Statement stmt = con.createStatement();
            ResultSet rs = stmt.executeQuery("SELECT COUNT(*) "
                    + "FROM students");
            while (rs.next()) {
                count = rs.getInt(1);
                ResultSet rs2 = stmt.executeQuery("SELECT * "
                        + "FROM students");
                while (rs2.next()) {
                    fName.add(rs2.getString("firstName"));
                    lName.add(rs2.getString("lastName"));
                    gName.add(rs2.getString("guardianName"));
                    address.add(rs2.getString("address"));
                }
            }
        } catch (SQLException e) {
            System.out.println(e);
        }
        RequestDispatcher rd = request.getRequestDispatcher("../Admin/main.jsp");
        request.setAttribute("studentCount", count);
        request.setAttribute("name1", fName);
        request.setAttribute("name2", lName);
        request.setAttribute("g", gName);
        request.setAttribute("a", address);
        rd.forward(request, response);
    }

}
