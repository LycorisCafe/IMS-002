/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package back;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLConnection;
import java.util.ArrayList;

/**
 *
 * @author Anupama
 */
public class updater {

    public static boolean checkUpdates() {
        boolean update = false;
        if (newVersion() != null) {
            float thisVersionx = 0;
            float newVersionx = 0;
            try {
                thisVersionx = Float.parseFloat(thisVersion());
                newVersionx = Float.parseFloat(newVersion());
            } catch (NumberFormatException e) {
                System.out.println(e);
            }

            if (thisVersionx < newVersionx) {
                update = true;
            }
        }
        return update;
    }

    private static String thisVersion() {
        return "";
    }

    private static String tempPath() {
        return "";
    }

    private static String installPath() {
        return "";
    }

    private static String newVersion() {
        String verUrl = "https://pastebin.com/raw/m7QWRgAw";
        String newVersion = null;
        try {
            URL url = new URL(verUrl);
            URLConnection con = url.openConnection();
            InputStream is = con.getInputStream();
            try (BufferedReader br = new BufferedReader(new InputStreamReader(is))) {
                String line = null;
                while ((line = br.readLine()) != null) {
                    newVersion = line;
                }
            }
        } catch (MalformedURLException ex) {
            System.out.println(ex);
        } catch (IOException ex) {
            System.out.println(ex);
        }
        return newVersion;
    }

    private static ArrayList downloads() {
        String verDownUrl = "https://pastebin.com/raw/emB3kRj8";
        ArrayList<String> downLinks = new ArrayList<>();
        try {
            URL url = new URL(verDownUrl);
            URLConnection con = url.openConnection();
            InputStream is = con.getInputStream();
            try (BufferedReader br = new BufferedReader(new InputStreamReader(is))) {
                String line = null;
                while ((line = br.readLine()) != null) {
                    downLinks.add(line);
                }
            }
        } catch (MalformedURLException ex) {
            System.out.println(ex);
        } catch (IOException ex) {
            System.out.println(ex);
        }
        return downLinks;
    }

    private static String UnRAR() {
        return "https://pastebin.com/raw/iLHAGbGS";
    }

    public void update() {
        Thread t1 = new Thread(new Runnable() {
            @Override
            public void run() {
                
            }
        }
        );
        t1.start();
    }

}
