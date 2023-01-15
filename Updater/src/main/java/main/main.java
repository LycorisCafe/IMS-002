/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 */
package main;

import com.formdev.flatlaf.FlatDarculaLaf;
import java.io.File;

/**
 *
 * @author Anupama
 */
public class main {

    public static void main(String[] args) {
        FlatDarculaLaf.setup();
        if (!new File("C:\\ProgramData\\LycorisCafe\\IMS-002").exists()){
            new File("C:\\ProgramData\\LycorisCafe\\IMS-002").mkdirs();
        }
        if (back.updater.checkUpdates() == true) {
            new front.updater().setVisible(true);
            new back.updater().update();
        } else {
            System.exit(0);
        }
    }
}
