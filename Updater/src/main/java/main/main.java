/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 */
package main;

import com.formdev.flatlaf.FlatDarculaLaf;

/**
 *
 * @author Anupama
 */
public class main {

    public static void main(String[] args) {
        FlatDarculaLaf.setup();
        if (back.updater.checkUpdates() == true) {
            new front.updater().setVisible(true);
            new back.updater().update();
        } else {
            System.exit(0);
        }
    }
}
