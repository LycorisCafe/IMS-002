/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package back;

import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.stream.Stream;
import org.telegram.telegrambots.bots.TelegramLongPollingBot;
import org.telegram.telegrambots.meta.api.objects.Update;

/**
 *
 * @author Anupama
 */
public class bot extends TelegramLongPollingBot {

    @Override
    public String getBotToken() {
        String api = null;
        try (Stream<String> lines = Files.lines(Paths.get(
                "C:\\ProgramData\\LycorisCafe\\IMS-002\\details.lc"))) {
            api = lines.skip(2).findFirst().get();
        } catch (IOException ex) {
            System.out.println(ex);
        }
        return api;
    }

    @Override
    public void onUpdateReceived(Update update) {

    }

    @Override
    public String getBotUsername() {
        String user = null;
        try (Stream<String> lines = Files.lines(Paths.get(
                "C:\\ProgramData\\LycorisCafe\\IMS-002\\details.lc"))) {
            user = lines.skip(1).findFirst().get();
        } catch (IOException ex) {
            System.out.println(ex);
        }
        return user;
    }

}
