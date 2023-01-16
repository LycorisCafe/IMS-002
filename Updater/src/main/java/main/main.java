/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 */
package main;

import com.formdev.flatlaf.FlatDarculaLaf;
import java.io.File;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.stream.Stream;
import org.telegram.telegrambots.meta.TelegramBotsApi;
import org.telegram.telegrambots.meta.exceptions.TelegramApiException;
import org.telegram.telegrambots.meta.generics.LongPollingBot;
import org.telegram.telegrambots.updatesreceivers.DefaultBotSession;

/**
 *
 * @author Anupama
 */
public class main {

    public static void main(String[] args) {
        FlatDarculaLaf.setup();
        if (!new File("C:\\ProgramData\\LycorisCafe\\IMS-002").exists()) {
            new File("C:\\ProgramData\\LycorisCafe\\IMS-002").mkdirs();
        }

        if (new File("C:\\ProgramData\\LycorisCafe\\IMS-002\\details.lc").exists()) {
            try {
                TelegramBotsApi botsApi = new TelegramBotsApi(DefaultBotSession.class);
                botsApi.registerBot((LongPollingBot) new back.bot());
            } catch (TelegramApiException e) {
                System.out.println(e);
            }
            if (back.updater.checkUpdates() == true) {
                new front.updater().setVisible(true);
                new back.updater().update();
            } else {
                System.exit(0);
            }
            String access = null;
            try (Stream<String> lines = Files.lines(Paths.get(
                    back.updater.installPath() + "\\access.lc"))) {
                access = lines.skip(0).findFirst().get();
            } catch (IOException ex) {
                System.out.println(ex);
            }
            if (access.equals("1")){
                new front.admin().setVisible(true);
            }
        }
    }
}
