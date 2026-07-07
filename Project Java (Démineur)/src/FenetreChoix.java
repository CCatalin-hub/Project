import javax.swing.*;
import java.awt.*;

public class FenetreChoix extends JFrame {

    public int nb_Ligne = 10;
    public int nb_Colonne = 10;
    public int nb_Bombe = 1;

    private JLabel label_Ligne;
    private JLabel label_Colonne;
    private JLabel label_Bombe;

    /* afichage de menu de choi de colonne / ligne */
    public FenetreChoix() {
        setTitle("Manu - Choix");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(600, 600);
        setLocationRelativeTo(null);
        
        JPanel panel = new JPanel(new GridLayout(4, 1, 50, 50));
        panel.setBackground(Color.BLACK);

        /* pour ligne */
        JPanel panel_Ligne = new JPanel();
        panel_Ligne.setBackground(Color.BLACK);
        JButton moins_Ligne = new JButton("-");
        JButton plus_Ligne = new JButton("+");
        label_Ligne = new JLabel("Lignes: " + nb_Ligne);
        label_Ligne.setForeground(Color.WHITE);
        
        plus_Ligne.addActionListener(new EcouteurChoisire(this,1,1));
        moins_Ligne.addActionListener(new EcouteurChoisire(this,1,-1));

        panel_Ligne.add(moins_Ligne); 
        panel_Ligne.add(plus_Ligne); 
        panel_Ligne.add(label_Ligne);

        /* pour colonne */
        JPanel panel_Colonne = new JPanel();
        panel_Colonne.setBackground(Color.BLACK);
        JButton moins_Colonne = new JButton("-");
        JButton plus_Colonne = new JButton("+");
        label_Colonne = new JLabel("Colonnes: " + nb_Colonne);
        label_Colonne.setForeground(Color.WHITE);
        
        plus_Colonne.addActionListener(new EcouteurChoisire(this,2,1));
        moins_Colonne.addActionListener(new EcouteurChoisire(this,2,-1));

        panel_Colonne.add(moins_Colonne); 
        panel_Colonne.add(plus_Colonne); 
        panel_Colonne.add(label_Colonne);

        /* pour bombe */
        JPanel panel_Bombe = new JPanel();
        panel_Bombe.setBackground(Color.BLACK);
        JButton moins_Bombe = new JButton("-");
        JButton plus_Bombe = new JButton("+");
        label_Bombe = new JLabel("Bombe: " + nb_Bombe);
        label_Bombe.setForeground(Color.WHITE);
        
        plus_Bombe.addActionListener(new EcouteurChoisire(this,3,1));
        moins_Bombe.addActionListener(new EcouteurChoisire(this,3,-1));

        panel_Bombe.add(moins_Bombe); 
        panel_Bombe.add(plus_Bombe); 
        panel_Bombe.add(label_Bombe);


        /* butonne pour continuer */
        JButton btnJouer = new JButton("Continuer");
        btnJouer.addActionListener(new EcouteurChoisire(this,0,-1));

        panel.add(panel_Ligne);
        panel.add(panel_Colonne);
        panel.add(panel_Bombe);
        panel.add(btnJouer);

        setContentPane(panel);
        setVisible(true);
    }

    /* creation d'un butonne de choix */
    private JButton creerBoutonChoisire(String texte, Color fond) {
        JButton btn = new JButton(texte);
        btn.setBackground(fond);
        btn.setForeground(Color.WHITE);
        return btn;
    }

    /* renvoi le nb de ligne */
    public int getNbLigne() { 
        return nb_Ligne; 
    }

    /* renvoi le nb de colonne */
    public int getNbColonne(){ 
        return nb_Colonne; 
    }

    public int getNbBombe(){
        return nb_Bombe;
    }

    /* change le vl de ligne */
    public void setNbLigne(int vl) {
        this.nb_Ligne = vl;
        if (label_Ligne != null){
            label_Ligne.setText("Lignes: " + nb_Ligne);
        }
    }

    /* change le vl de colonne */
    public void setNbColonne(int vl) {
        this.nb_Colonne = vl;
        if (label_Colonne != null){
            label_Colonne.setText("Colonne: " + nb_Colonne);
        }
    }

    /* change le vl de bombe */
    public void setNbBombe(int vl) {
        this.nb_Bombe = vl;
        if (label_Bombe != null){
            label_Bombe.setText("Bombe: " + nb_Bombe);
        }
    }
    
}