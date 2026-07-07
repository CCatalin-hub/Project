import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import javax.swing.JFrame;
import java.io.File;

public class EcouteurMenu implements ActionListener {
    private JFrame menu;
    private int type;

    public EcouteurMenu(JFrame menu, int type) {
        this.menu = menu;
        this.type = type;
    }

    @Override
    public void actionPerformed(ActionEvent e) {
        if(type == 1){
            menu.dispose(); 
            new FenetreChoix(); 
        }
        if(type == 2){
            System.exit(0);
        }
        if(type == 3){
            File fichier = new File("sauvegarde.txt");
            if(fichier.exists()){
                menu.dispose();
                new FenetreJeu("sauvegarde.txt");
            }
        }
    }
}