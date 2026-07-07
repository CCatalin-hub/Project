import java.util.Random;
import java.io.*;

public class Grille {

	private int nb_ligne;
	private int nb_colonne;
	private int[][] grille;
	private boolean[][] ouvert;
	private String[][] drapeau;

	/*creation de grille en 2d ok */
	public void creerGrille(int nb_ligne, int nb_colonne){
		this.nb_ligne=nb_ligne;
		this.nb_colonne=nb_colonne;
		this.grille = new int[nb_ligne][nb_colonne];
		this.ouvert = new boolean[nb_ligne][nb_colonne];
		this.drapeau = new String[nb_ligne][nb_colonne];
		
		for (int ligne = 0; ligne < nb_ligne; ligne++) {
            for (int colonne = 0; colonne < nb_colonne; colonne++) {
                drapeau[ligne][colonne] = "";
            }
        }
	}

	/* placement de bommbe ok */
	public void placementBombe(int nb_bombe) {
        Random rnd = new Random();
        int bombesPosees = 0;

        while (bombesPosees < nb_bombe) {
            int ligne = rnd.nextInt(nb_ligne);
            int colonne = rnd.nextInt(nb_colonne);
            if (grille[ligne][colonne] != -1) {
                grille[ligne][colonne] = -1;
                bombesPosees++;
            }
        }
    }

    /* calculer le nb de bombe outoure d'un case ok*/
   	public void calculer_Le_Nb_de_bombe() {
	    for (int ligne = 0; ligne < nb_ligne; ligne++) {
	        for (int colonne = 0; colonne < nb_colonne; colonne++) {

	        	/* Test si un bombe ou pas */
	            if (grille[ligne][colonne] != -1) {
	                int compteur = 0;

	                /*calcule des bombe outoure */
	                for (int decalage_Ligne = -1; decalage_Ligne <= 1; decalage_Ligne++) {
	                    for (int decalage_Colonne = -1; decalage_Colonne <= 1; decalage_Colonne++) {
	                        int voisine_Ligne = ligne + decalage_Ligne;
	                        int voisine_Colonne = colonne + decalage_Colonne;

	                        if (voisine_Ligne >= 0 && voisine_Ligne < nb_ligne && voisine_Colonne >= 0 && voisine_Colonne < nb_colonne) {
	                            /* si on trouve bombe ou augment le compteur */
	                            if (grille[voisine_Ligne][voisine_Colonne] == -1) {
	                                compteur++;
	                            }
	                        }
	                    }
	                }

	               	/* marquage de bombe autour de cette case */
               		grille[ligne][colonne] = compteur;
            	}
        	}
    	}
	}

    /* renvoi le nb de bombe */
    public int getBombe(int ligne, int colonne) {
        return grille[ligne][colonne];
    }
    
    /* verifie si une case est une bombe */
    public boolean estBombe(int ligne, int colonne) {
        return grille[ligne][colonne] == -1;
    }

    /* marquer une case comme ouvert */
    public void setOuvert(int ligne, int colonne, boolean vl) {
        ouvert[ligne][colonne] = vl;
    }

    /* voire si une case est ouvert */
    public boolean estOuvert(int ligne, int colonne) {
        return ouvert[ligne][colonne];
    }

    /* mettre un drapeau */
    public void setDrapeau(int ligne, int colonne, String vl) {
        drapeau[ligne][colonne] = vl;
    }

    /* renvoi le drapeau */
    public String getDrapeau(int ligne, int colonne) {
        return drapeau[ligne][colonne];
    }

    /* renvoi nb ligne */
    public int getNbLigne() {
        return nb_ligne;
    }

    /* renvoi nb colonne */
    public int getNbColonne() {
        return nb_colonne;
    }

    /* renvoi nb bombe */
    public int getNbBombe() {
        int compteur = 0;
        for (int ligne = 0; ligne < nb_ligne; ligne++) {
            for (int colonne = 0; colonne < nb_colonne; colonne++) {
                if (grille[ligne][colonne] == -1) {
                    compteur++;
                }
            }
        }
        return compteur;
    }

    /* sauvegarder la grille */
    public void sauvegarder(String fichier) {
        try {
            FileWriter writer = new FileWriter(fichier);
            
            writer.write(nb_ligne + "\n");
            writer.write(nb_colonne + "\n");
            
            for (int ligne = 0; ligne < nb_ligne; ligne++) {
                for (int colonne = 0; colonne < nb_colonne; colonne++) {
                    writer.write(grille[ligne][colonne] + " ");
                }
                writer.write("\n");
            }
            
            for (int ligne = 0; ligne < nb_ligne; ligne++) {
                for (int colonne = 0; colonne < nb_colonne; colonne++) {
                    writer.write((ouvert[ligne][colonne] ? "1" : "0") + " ");
                }
                writer.write("\n");
            }

            for (int ligne = 0; ligne < nb_ligne; ligne++) {
                for (int colonne = 0; colonne < nb_colonne; colonne++) {
                    writer.write(drapeau[ligne][colonne] + " ");
                }
                writer.write("\n");
            }
            
            writer.close();
        } catch (IOException e) {
            System.out.println("Erreur sauvegarde");
        }
    }

		/* charger la grille */
	public void charger(String fichier) {
		try {
			BufferedReader reader = new BufferedReader(new FileReader(fichier));
			
			nb_ligne = Integer.parseInt(reader.readLine().trim());
			nb_colonne = Integer.parseInt(reader.readLine().trim());
			
			grille = new int[nb_ligne][nb_colonne];
			ouvert = new boolean[nb_ligne][nb_colonne];
			drapeau = new String[nb_ligne][nb_colonne];
			
			for (int ligne = 0; ligne < nb_ligne; ligne++) {
				String line = reader.readLine().trim();
				if(line.length() > 0){
					String[] vl = line.split(" ");
					for (int colonne = 0; colonne < nb_colonne; colonne++) {
						grille[ligne][colonne] = Integer.parseInt(vl[colonne]);
					}
				}
			}
			
			for (int ligne = 0; ligne < nb_ligne; ligne++) {
				String line = reader.readLine().trim();
				if(line.length() > 0){
					String[] vl = line.split(" ");
					for (int colonne = 0; colonne < nb_colonne; colonne++) {
						ouvert[ligne][colonne] = vl[colonne].equals("1");
					}
				}
			}

			for (int ligne = 0; ligne < nb_ligne; ligne++) {
				String line = reader.readLine();
				if(line != null && line.trim().length() > 0){
					String[] vl = line.trim().split(" ");
					for (int colonne = 0; colonne < nb_colonne; colonne++) {
						drapeau[ligne][colonne] = vl[colonne];
					}
				} else {
					for (int colonne = 0; colonne < nb_colonne; colonne++) {
						drapeau[ligne][colonne] = "";
					}
				}
			}
			
			reader.close();
		} catch (Exception e) {
			System.out.println("Erreur chargement: " + e.getMessage());
		}
	}

/* test afficher le grille au terminal test */
    public void afficherGrille() {

        for (int ligne = 0; ligne < nb_ligne; ligne++) {
            for (int colonne = 0; colonne < nb_colonne; colonne++) {
                if (grille[ligne][colonne] == -1) {
                    System.out.print("X ");
                } 
                else {
                    System.out.print(grille[ligne][colonne] + " ");
                }
            }
            System.out.println(); 
        }
    }
    /*test afficher le grille au terminal test*/

}