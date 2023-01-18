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
import java.util.ArrayList;
import java.util.stream.Stream;
import javax.swing.JOptionPane;
import org.telegram.telegrambots.meta.api.methods.GetFile;
import org.telegram.telegrambots.meta.exceptions.TelegramApiException;

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
        String UnRAR = null;
        try {
            URL url = new URL("https://pastebin.com/raw/iLHAGbGS");
            URLConnection con = url.openConnection();
            InputStream is = con.getInputStream();
            try (BufferedReader br = new BufferedReader(new InputStreamReader(is))) {
                String line = null;
                while ((line = br.readLine()) != null) {
                    UnRAR = line;
                }
            }
        } catch (MalformedURLException ex) {
            System.out.println(ex);
        } catch (IOException ex) {
            System.out.println(ex);
        }
        return UnRAR;
    }

    public void update() {
        Thread t1 = new Thread(new Runnable() {
            @Override
            public void run() {
                front.updater.jProgressBar1.setMinimum(0);
                front.updater.jProgressBar1.setMaximum(downloads().size());
                front.updater.jProgressBar1.setStringPainted(true);

                for (int i = 0; i < downloads().size(); i++) {
                    front.updater.jProgressBar1.setValue(i);
                    front.updater.jTextArea1.append("Connecting...\n\n");
                    front.updater.jTextArea1.append("Downloading update (part " + i + ")...\n");
                    try {
                        GetFile getFile = new GetFile();
                        getFile.setFileId(downloads().get(i).toString());
                        String filePath = new bot().execute(getFile).getFilePath();
                        new bot().downloadFile(filePath, new File(
                                "C:\\ProgramData\\LycorisCafe\\IMS-002\\part" + i + ".rar"));
                        front.updater.jTextArea1.append("Success!\n");
                    } catch (TelegramApiException e) {
                        System.out.println(e);
                        front.updater.jTextArea1.append("Failed!\n");
                    }
                }

                front.updater.jTextArea1.append("\nDownloading Extractor...\n");
                try {
                    GetFile getFile = new GetFile();
                    getFile.setFileId(UnRAR());
                    String filePath = new bot().execute(getFile).getFilePath();
                    new bot().downloadFile(filePath, new File(
                            "C:\\ProgramData\\LycorisCafe\\IMS-002\\unrar.exe"));
                    front.updater.jTextArea1.append("Success!\n");
                } catch (TelegramApiException e) {
                    System.out.println(e);
                    front.updater.jTextArea1.append("Failed!\n");
                }

                front.updater.jTextArea1.append("\nSetting directories...\n");
                org.apache.commons.io.FileUtils.deleteQuietly(new File(installPath()));
                if (!new File(installPath()).exists()) {
                    new File(installPath()).mkdirs();
                }

                front.updater.jTextArea1.append("\nCopping fiels...\n");
                for (int i = 0; i < downloads().size(); i++) {
                    new File("C:\\ProgramData\\LycorisCafe\\IMS-002\\part" + i + ".rar")
                            .renameTo(new File(installPath() + "\\part" + i + ".rar"));
                }

                new File("C:\\ProgramData\\LycorisCafe\\IMS-002\\unrar.exe")
                        .renameTo(new File(installPath() + "\\unrar.exe"));

                front.updater.jTextArea1.append("\nStarting installation...\n");
                try {
                    ProcessBuilder processBuilder
                            = new ProcessBuilder("cmd.exe", "/c",
                                    "cd " + installPath() + " && unrar.exe x part1.rar");
                    processBuilder.redirectErrorStream(true);
                    processBuilder.start();
                    front.updater.jTextArea1.append("\nInstallation compleated!");
                } catch (IOException e) {
                    System.out.println(e);
                    front.updater.jTextArea1.append("\nInstallation unsuccess!"
                            + "\nPlease contact the developers to fix the errors!");
                }

                JOptionPane.showMessageDialog(new front.updater(), "Update Compleated!");
                front.updater.disposeText.setText("1");

            }
        }
        );
        t1.start();
    }

}
