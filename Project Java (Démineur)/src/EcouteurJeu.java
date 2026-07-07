import java.awt.event.*;
import javax.swing.*;

public class EcouteurJeu extends MouseAdapter { 
    private FenetreJeu fenetre;
    private int ligne;
    private int colonne;
    private int type;

    public EcouteurJeu(FenetreJeu fenetre, int ligne, int colonne, int type) {
        this.fenetre = fenetre;
        this.ligne = ligne;
        this.colonne = colonne;
        this.type = type;
    }

    @Override
    public void mousePressed(MouseEvent e) {
        if (fenetre.estEnCours()){
            /* quiter */
            if (type == 1){
                fenetre.sauvegarderPartie();
                System.exit(0);
            }

            /* revenire au menu */
            if (type == 2){
                fenetre.sauvegarderPartie();
                new FenetreMenu();
                fenetre.dispose();
            }

            if (type == 3){
                /* si qlique droite */
                if (SwingUtilities.isRightMouseButton(e)) {
                    /* pour clique droite */
                    fenetre.poserDrapeau(ligne, colonne);
                } 
                /* si qlique gouche */
                if (SwingUtilities.isLeftMouseButton(e)) {
                    /* clique sur la case */
                    fenetre.clicCase(ligne, colonne);
                }
            }
        }
    }

}