import javax.swing.*;
import java.awt.*;

public class FenetreJeu extends JFrame {
    private JButton[][] boutons;
    private Grille grille;

    private int nb_ligne;
    private int nb_colonne;
    private int nb_Bombe;
    private boolean jeuEnCours = true;

    public FenetreJeu(int nb_ligne, int nb_colonne, int nb_Bombe) {
        setTitle("Démineur");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(800, 800); 
        setLocationRelativeTo(null);

        this.nb_ligne = nb_ligne;
        this.nb_colonne = nb_colonne;
        this.nb_Bombe = nb_Bombe;
        
        /* creation grille 2d */
        grille = new Grille();
        grille.creerGrille(nb_ligne, nb_colonne);
        grille.placementBombe(nb_Bombe);
        grille.calculer_Le_Nb_de_bombe();

        JPanel mainPanel = new JPanel(new BorderLayout());
        JPanel controlPanel = new JPanel();
        JPanel panelJeu = new JPanel(new GridLayout(nb_ligne, nb_colonne));
        controlPanel.setBackground(Color.BLACK);

        /* buttone */
        JButton boutonMenu = new JButton("Menu");
        JButton boutonQuitter = new JButton("Quitter");
        boutonQuitter.addMouseListener(new EcouteurJeu(this, 0, 0, 1));
        boutonMenu.addMouseListener(new EcouteurJeu(this, 0, 0, 2));
        boutons = new JButton[nb_ligne][nb_colonne];

        /* quantite de bombe sur la terane */
        JLabel qqteBombe = new JLabel("Nombre de bombes: " + nb_Bombe);
        qqteBombe.setForeground(Color.WHITE);

        /* creation de la teraine de jeu */
        for (int ligne = 0; ligne < nb_ligne; ligne++){
            for (int colonne = 0; colonne < nb_colonne; colonne++){
                boutons[ligne][colonne] = new JButton();
                boutons[ligne][colonne].setBackground(new Color(70, 70, 70));
                boutons[ligne][colonne].addMouseListener(new EcouteurJeu(this, ligne, colonne, 3));
                panelJeu.add(boutons[ligne][colonne]);
            }
        }

        /* add */
        controlPanel.add(qqteBombe);
        controlPanel.add(boutonMenu);
        controlPanel.add(boutonQuitter);
        mainPanel.add(controlPanel, BorderLayout.NORTH);
        mainPanel.add(panelJeu, BorderLayout.CENTER);

        setContentPane(mainPanel);
        setVisible(true); 
    }

    /* constructeur pour charger une partie */
    public FenetreJeu(String fichier) {
        setTitle("Démineur");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(800, 800); 
        setLocationRelativeTo(null);

        grille = new Grille();
        grille.charger(fichier);
        
        this.nb_ligne = grille.getNbLigne();
        this.nb_colonne = grille.getNbColonne();
        this.nb_Bombe = grille.getNbBombe();

        JPanel mainPanel = new JPanel(new BorderLayout());
        JPanel controlPanel = new JPanel();
        JPanel panelJeu = new JPanel(new GridLayout(nb_ligne, nb_colonne));
        controlPanel.setBackground(Color.BLACK);

        JButton boutonMenu = new JButton("Menu");
        JButton boutonQuitter = new JButton("Quitter");
        boutonQuitter.addMouseListener(new EcouteurJeu(this, 0, 0, 1));
        boutonMenu.addMouseListener(new EcouteurJeu(this, 0, 0, 2));
        boutons = new JButton[nb_ligne][nb_colonne];

        JLabel qqteBombe = new JLabel("Nombre de bombes: " + nb_Bombe);
        qqteBombe.setForeground(Color.WHITE);

        for (int ligne = 0; ligne < nb_ligne; ligne++){
            for (int colonne = 0; colonne < nb_colonne; colonne++){
                boutons[ligne][colonne] = new JButton();
                
                if(grille.estOuvert(ligne, colonne)){
                    boutons[ligne][colonne].setBackground(Color.LIGHT_GRAY);
                    int nb = grille.getBombe(ligne, colonne);
                    if(nb > 0){
                        boutons[ligne][colonne].setText("" + nb);
                        boutons[ligne][colonne].setForeground(Color.BLACK);
                    }
                } else {
                    boutons[ligne][colonne].setBackground(new Color(70, 70, 70));
                    String drp = grille.getDrapeau(ligne, colonne);
                    if(drp.equals("*")){
                        boutons[ligne][colonne].setText("*");
                        boutons[ligne][colonne].setForeground(Color.YELLOW);
                    } else if(drp.equals("?")){
                        boutons[ligne][colonne].setText("?");
                        boutons[ligne][colonne].setForeground(Color.WHITE);
                    }
                }
                
                boutons[ligne][colonne].addMouseListener(new EcouteurJeu(this, ligne, colonne, 3));
                panelJeu.add(boutons[ligne][colonne]);
            }
        }

        controlPanel.add(qqteBombe);
        controlPanel.add(boutonMenu);
        controlPanel.add(boutonQuitter);
        mainPanel.add(controlPanel, BorderLayout.NORTH);
        mainPanel.add(panelJeu, BorderLayout.CENTER);

        setContentPane(mainPanel);
        setVisible(true); 
    }

    /* gestion du clic sur une case */
    public void clicCase(int ligne, int colonne){
    /* pour pa qliquer sur les eventuelle bombe */

        String texte = boutons[ligne][colonne].getText();
        if(!texte.equals("*") && !texte.equals("?") && this.jeuEnCours){
            if (grille.estBombe(ligne, colonne)){
                new FenetrePerdu(this);
                this.jeuEnCours = false;
                afficherToutesLesBombes();

            } 
            else {
                revelerCase(ligne, colonne);
                verifierVictoire();
            }
        }
    }

    public void revelerCase(int ligne, int colonne){

        if (ligne < 0 || ligne >= nb_ligne || colonne < 0 || colonne >= nb_colonne){
            return;
        }
        JButton btn = boutons[ligne][colonne];

        /* Si déjà clique */
        if (btn.getBackground() == Color.LIGHT_GRAY){
            return;
        }

        /* nb de bombe d'acote */
        int nb = grille.getBombe(ligne, colonne);

        btn.setBackground(Color.LIGHT_GRAY);
        grille.setOuvert(ligne, colonne, true);

        if (nb > 0){
            /* si il y a un bombe */
            btn.setText("" + nb);
            btn.setForeground(Color.BLACK);
        } 
        else{
            /* si casse vide, pas de bombe a cote */
            for (int decalage_ligne = -1; decalage_ligne <= 1; decalage_ligne++){
                for (int decalage_colonne = -1; decalage_colonne <= 1; decalage_colonne++){
                    /* pour pas tester la meme case sur la quelle on avaite clique */
                    if (decalage_ligne != 0 || decalage_colonne != 0){
                        revelerCase(ligne + decalage_ligne, colonne + decalage_colonne);
                        btn.setText("");
                    }
                }
            }
        }
    }

    public void poserDrapeau(int ligne, int colonne) {

        JButton btn = boutons[ligne][colonne];

        /* tester si un case non clique */
        if (btn.getBackground().equals(new Color(70, 70, 70))){
            String texteActuel = btn.getText();

            /* premier qlique */
            if (texteActuel.equals("")){
                btn.setText("*");
                btn.setForeground(Color.YELLOW);
                grille.setDrapeau(ligne, colonne, "*");
            } 
            /* 2 eme qlique */
            else if (texteActuel.equals("*")){
                btn.setText("?");
                btn.setForeground(Color.WHITE);
                grille.setDrapeau(ligne, colonne, "?");
            } 
            /* 3 eme qlique */
            else{
                btn.setText("");
                grille.setDrapeau(ligne, colonne, "");
            }
        }
    }

    /* afficher les bombe apres la perde */
    public void afficherToutesLesBombes() {
        for (int ligne = 0; ligne < nb_ligne; ligne++){
            for (int colonne = 0; colonne < nb_colonne; colonne++){
                if (grille.estBombe(ligne, colonne)) {
                    boutons[ligne][colonne].setBackground(Color.RED);
                    boutons[ligne][colonne].setText("X");
                    boutons[ligne][colonne].setForeground(Color.WHITE);
                }
            }
        }
    }

    /* voire si pas encore persu */
    public boolean estEnCours() {
        return this.jeuEnCours;
    }

    /* sauvegarder la partie */
    public void sauvegarderPartie() {
        grille.sauvegarder("sauvegarde.txt");
    }

    /* verifier si le joueur a gagne */
    private void verifierVictoire() {
        int casesRevelees = 0;
        int totalCasesSansBombe = (nb_ligne * nb_colonne) - nb_Bombe;
        
        for (int ligne = 0; ligne < nb_ligne; ligne++) {
            for (int colonne = 0; colonne < nb_colonne; colonne++) {
                if (grille.estOuvert(ligne, colonne)) {
                    casesRevelees++;
                }
            }
        }
        
        if (casesRevelees == totalCasesSansBombe) {
            this.jeuEnCours = false;
            new FenetreGagne(this);
        }
    }

}