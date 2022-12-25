/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package Helper;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

/**
 *
 * @author Lycoris Cafe
 */
public class DB {

    public static Connection connect() {
        Connection conn = null;
        String db = "ims";
        String username = "root";
        String password = "";
        try {
            conn = DriverManager.getConnection("jdbc:mysql://localhost/" + db + "?user=" + username
                    + "&password=" + password);
        } catch (SQLException ex) {
            // handle any errors
            System.out.println("SQLException: " + ex.getMessage());
            System.out.println("SQLState: " + ex.getSQLState());
            System.out.println("VendorError: " + ex.getErrorCode());
        }
        return conn;
    }
}
