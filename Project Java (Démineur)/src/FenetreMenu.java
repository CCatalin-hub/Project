import java.awt.*;
import javax.swing.*;
import java.io.File;

public class FenetreMenu extends JFrame {

    /* 3 buttone pour le menu */
    private JButton btn_Nouvelle_Partie;
    private JButton btn_Reprendre;
    private JButton btn_Quitter;

    /* affichage de fenetre menu ok */
    public FenetreMenu() {
        setTitle("Menu");
        
        btn_Nouvelle_Partie = creerBouton("Nouvelle partie", new Color(45,45,45));
        btn_Reprendre = creerBouton("Reprendre",new Color(45,45,45));
        btn_Quitter = creerBouton("Quitter",new Color(45,45,45));

        btn_Quitter.addActionListener(new EcouteurMenu(this, 2));
        btn_Nouvelle_Partie.addActionListener(new EcouteurMenu(this, 1));
        btn_Reprendre.addActionListener(new EcouteurMenu(this, 3));

        File fichier = new File("sauvegarde.txt");
        if(!fichier.exists()){
            btn_Reprendre.setEnabled(false);
        }

        Buton_Titre();

        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(600, 600);
        setLocationRelativeTo(null);
        
        setVisible(true);
    }

    /* creatuin de 3 buttone et le texte ok */
    private void Buton_Titre() {

        JPanel panneau = new JPanel(new GridLayout(4, 1, 20, 20));
        panneau.setBorder(BorderFactory.createEmptyBorder(50, 100, 50, 100));
        panneau.setBackground(Color.BLACK);

        /* creation de titre */
        JLabel titre = new JLabel("DEMINEUR", SwingConstants.CENTER);
        titre.setFont(new Font("Monospaced", Font.BOLD, 40));
        titre.setForeground(Color.WHITE);

        panneau.add(titre);
        panneau.add(btn_Nouvelle_Partie);
        panneau.add(btn_Reprendre);
        panneau.add(btn_Quitter);

        this.setContentPane(panneau);
        this.getContentPane().doLayout();
    }

    /* creation d'un buttone ok */
    private JButton creerBouton(String texte, Color fond) {
        JButton btn = new JButton(texte);
        btn.setBackground(fond);
        btn.setForeground(new Color(255,255,255));
        btn.setAlignmentX(Component.CENTER_ALIGNMENT);
        return btn; 
    }

}