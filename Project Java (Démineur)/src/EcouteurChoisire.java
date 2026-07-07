import java.awt.event.*;
import javax.swing.*;

public class EcouteurChoisire implements ActionListener{

    private FenetreChoix fenetre; 
    private int ligne_ou_colonne_ou_bombe;
    private int plus_ou_moins;

    /* constructeur */
    public EcouteurChoisire(FenetreChoix fenetre,int ligne_ou_colonne_ou_bombe, int plus_ou_moins) {
        this.fenetre = fenetre; 
        this.ligne_ou_colonne_ou_bombe=ligne_ou_colonne_ou_bombe;
        this.plus_ou_moins=plus_ou_moins;
    }

    @Override
    public void actionPerformed(ActionEvent e) {
        /* teste si ligne */
        if(ligne_ou_colonne_ou_bombe == 1){
            int nb = fenetre.getNbLigne(); 
                
            /*test si - */
            if (plus_ou_moins == 1) {
                if (nb < 30){
                    fenetre.setNbLigne(nb + 1);
                }
            }
            /*test si + */    
            if (plus_ou_moins == -1) {
                if (nb > 4){
                    fenetre.setNbLigne(nb - 1);
                }
            }
        }

        /* test si colonne*/
        if(ligne_ou_colonne_ou_bombe == 2){
            int nb = fenetre.getNbColonne(); 

            /* teste si - */
            if (plus_ou_moins == 1) {
                if (nb < 30){
                    fenetre.setNbColonne(nb + 1);
                }
            }   
            /* test si + */
            if (plus_ou_moins == -1) {
                if (nb > 4){
                    fenetre.setNbColonne(nb - 1);
                }
            }
        }


        if(ligne_ou_colonne_ou_bombe == 3){
            int nb = fenetre.getNbBombe(); 

            /* teste si - */
            if (plus_ou_moins == 1) {
                if (nb < fenetre.getNbColonne()*fenetre.getNbLigne()){
                    fenetre.setNbBombe(nb + 1);
                }
            }   
            /* test si + */
            if (plus_ou_moins == -1) {
                if (nb > 1){
                    fenetre.setNbBombe(nb - 1);
                }
            }
            /* si nb_bombe + grnade que nb_colone * nb ligne on reviene a 1 */
            if (nb > fenetre.getNbColonne()*fenetre.getNbLigne()){
                 fenetre.setNbBombe(1);
            }
        }

        /* continuer */
        if (ligne_ou_colonne_ou_bombe == 0) {
            /* si nb de bombe est plus petite que nb_colone * nb ligne */
            if(fenetre.getNbBombe() < fenetre.getNbLigne() * fenetre.getNbColonne()){
                fenetre.dispose();
                new FenetreJeu(fenetre.getNbLigne(), fenetre.getNbColonne(), fenetre.getNbBombe());
            }         
        }

    }

}