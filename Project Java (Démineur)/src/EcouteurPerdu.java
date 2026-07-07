import java.awt.event.*;
import javax.swing.*;

public class EcouteurPerdu implements ActionListener{

	private int button;
	private FenetrePerdu fenetre;
	private FenetreJeu jeu;

	public EcouteurPerdu(FenetrePerdu fenetre, int button, FenetreJeu jeuEnCours){
	 	this.fenetre = fenetre;
	 	this.button = button;
	 	this.jeu = jeuEnCours;
	}

	@Override
    public void actionPerformed(ActionEvent e) {
    	if (button == 1){
    		fenetre.dispose();
    		jeu.dispose();
        	new FenetreMenu();
    	}
    	if (button == 2){
    		fenetre.dispose();
    		jeu.dispose();
    		System.exit(0);
    	}
    }
}