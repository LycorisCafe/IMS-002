/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package back;

import java.io.BufferedReader;
import java.io.File;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLConnection;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.nio.file.StandardCopyOption;
import java.util.ArrayList;
import java.util.stream.Stream;
import javax.swing.JOptionPane;

/**
 *
 * @author Lycoris Cafe
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
        String version = null;
        try (Stream<String> lines = Files.lines(Paths.get(
                installPath() + "\\version.lc"))) {
            version = lines.skip(0).findFirst().get();
        } catch (IOException ex) {
            System.out.println(ex);
        }
        return version;
    }

    public static String installPath() {
        String path = null;
        try (Stream<String> lines = Files.lines(Paths.get(
                "C:\\ProgramData\\LycorisCafe\\IMS-002\\details.lc"))) {
            path = lines.skip(0).findFirst().get();
        } catch (IOException ex) {
            System.out.println(ex);
        }
        return path;
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
                front.updater.jProgressBar1.setMinimum(0);
                front.updater.jProgressBar1.setMaximum(downloads().size());
                front.updater.jProgressBar1.setStringPainted(true);

                for (int i = 0; i < 5; i++) {
                    try {
                        front.updater.jProgressBar1.setValue(i);
                        InputStream in = new URL(downloads().get(i).toString()).openStream();
                        Files.copy(in, Paths.get("C:\\ProgramData\\LycorisCafe\\IMS-002\\part" + i + ".rar"),
                                StandardCopyOption.REPLACE_EXISTING);
                    } catch (IOException e) {
                        System.out.println(e);
                    }
                }

                try {
                    InputStream in = new URL(UnRAR()).openStream();
                    Files.copy(in, Paths.get("C:\\ProgramData\\LycorisCafe\\IMS-002\\unrar.exe"),
                            StandardCopyOption.REPLACE_EXISTING);
                } catch (IOException e) {
                    System.out.println(e);
                }

                org.apache.commons.io.FileUtils.deleteQuietly(new File(installPath()));
                if (!new File(installPath()).exists()){
                    new File(installPath()).mkdirs();
                }

                try {
                    ProcessBuilder processBuilder
                            = new ProcessBuilder("cmd.exe", "/c",
                                    "\"C:\\ProgramData\\LycorisCafe\\IMS-002\\unrar.exe\" "
                                    + "x "
                                    + "\"C:\\ProgramData\\LycorisCafe\\IMS-002\\part1.rar\" "
                                    + "\"" + installPath() + "\"");
                    processBuilder.redirectErrorStream(true);
                    processBuilder.start();
                } catch (IOException e) {
                    System.out.println(e);
                }

                JOptionPane.showMessageDialog(new front.updater(), "Update success!");
                new front.updater().dispose();
                
            }
        }
        );
        t1.start();
    }

}
