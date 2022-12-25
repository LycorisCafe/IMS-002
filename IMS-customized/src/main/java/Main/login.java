/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package Main;

import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.io.PrintWriter;

/**
 *
 * @author Anupama
 */
public class login extends HttpServlet {

    public void service(HttpServletRequest req, HttpServletResponse res) {
        String username = req.getParameter("username");
        String password = req.getParameter("password");
        if (username.equals("admin") && password.equals("admin")) {
            try {
                PrintWriter out = res.getWriter();
                out.print("Login success!");
            } catch (IOException e) {
                System.out.println(e);
            }
        } else {
            try {
                PrintWriter out = res.getWriter();
                out.print("Login faild!");
            } catch (IOException e) {
                System.out.println(e);
            }
        }
    }
}
