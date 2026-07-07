#include <stdlib.h>
#include <graph.h>
#include "menu.h"
#include "bouton.h"
#include "afficher.h"

/*valider la choid de menu*/
int valid_menu(int touche,int selection_menu,int largeur_fenetre,int hauteur_fenetre,int suiv,int centre_y){
    if (touche == XK_Return){
        if (selection_menu == 1) { 
            return 1;
        }
        else if (selection_menu == 2){ 
            afficher_regles_ecran(largeur_fenetre, hauteur_fenetre); 
            dessiner_menu(largeur_fenetre,centre_y); 
        }
        else if (selection_menu == 3){ 
            FermerGraphique();  
        }
    }
    return suiv;
}

/*afficher la menu*/
void dessiner_menu(int l,int centre_y) {
    EffacerEcran(CouleurParComposante(119,136,153));
    ChoisirCouleurDessin(CouleurParComposante(0,0,0));
    EcrireTexte(l/2 - 100, centre_y - 250, "JEU DE TAQUIN", 2);

    /* Bouton JOUER */
    ChoisirCouleurDessin(CouleurParComposante(211,211,211));
    RemplirRectangle(l/2 - 150, centre_y - 150, 300, 100);
    ChoisirCouleurDessin(CouleurParComposante(0,0,0));
    DessinerRectangle(l/2 - 150, centre_y - 150, 300, 100);
    EcrireTexte(l/2 - 40, centre_y - 90, "JOUER", 2);

    /* Bouton REGLES */
    ChoisirCouleurDessin(CouleurParComposante(211,211,211));
    RemplirRectangle(l/2 - 150, centre_y, 300, 100);
    ChoisirCouleurDessin(CouleurParComposante(0,0,0));
    DessinerRectangle(l/2 - 150, centre_y, 300, 100);
    EcrireTexte(l/2 - 45, centre_y + 60, "REGLES", 2);

    /* Bouton QUITTER */
    ChoisirCouleurDessin(CouleurParComposante(211,211,211));
    RemplirRectangle(l/2 - 150, centre_y + 150, 300, 100);
    ChoisirCouleurDessin(CouleurParComposante(0,0,0));
    DessinerRectangle(l/2 - 150, centre_y + 150, 300, 100);
    EcrireTexte(l/2 - 50, centre_y + 210, "QUITTER", 2);
}

/*animation rouge + la selection des bouton*/
int menu(int hauteur_fenetre, int largeur_fenetre, int suiv) {
    int suiv_loc_1;
    int centre_y;
    int menu_haut_y;
    int touche;
    int selection_menu = 1;
    int coord_x, coord_y;

    while (suiv == 0) {
        suiv_loc_1 = 0;

        if (suiv_loc_1 == 0) {
            centre_y = hauteur_fenetre / 2;
            menu_haut_y = centre_y - 150;
            dessiner_menu(largeur_fenetre, centre_y);

            while (suiv_loc_1 == 0) {

                /* clavier */
                if (ToucheEnAttente()) {
                    touche = Touche();
                    selection_menu = bouton_menu(touche, selection_menu);

                    /* Validation Clavier */
                    if (touche == XK_Return) {
                        if (selection_menu == 1) {
                            return 1;
                        } else if (selection_menu == 2) {
                            afficher_regles_ecran(largeur_fenetre, hauteur_fenetre);
                            dessiner_menu(largeur_fenetre, centre_y);
                        } else if (selection_menu == 3) {
                            FermerGraphique();
                        }
                    }

                    /* Redessiner pour voir le changement de sélection */
                    suiv_loc_1 = suiv;
                    dessiner_menu(largeur_fenetre, centre_y);
                }

                /* souris */
                if (SourisCliquee()) {
                    SourisPosition();
                    coord_x = _X;
                    coord_y = _Y;

                    if (coord_x > largeur_fenetre / 2 - 150 && coord_x < largeur_fenetre / 2 + 150) {
                        if (coord_y > menu_haut_y && coord_y < menu_haut_y + 100) {
                            selection_menu = 1;
                            suiv_loc_1 = 1;
                            return 1;
                        } else if (coord_y > centre_y && coord_y < centre_y + 100) {
                            selection_menu = 2;
                            afficher_regles_ecran(largeur_fenetre, hauteur_fenetre);
                            dessiner_menu(largeur_fenetre, centre_y);
                        } else if (coord_y > centre_y + 150 && coord_y < centre_y + 250) {
                            selection_menu = 3;
                            FermerGraphique();
                        }
                    }
                }

                /* Dessiner le cadre rouge pour la sélection */
                ChoisirCouleurDessin(CouleurParComposante(255, 0, 0));
                if (selection_menu == 1)
                    DessinerRectangle(largeur_fenetre / 2 - 152, menu_haut_y - 2, 304, 104);
                if (selection_menu == 2)
                    DessinerRectangle(largeur_fenetre / 2 - 152, centre_y - 2, 304, 104);
                if (selection_menu == 3)
                    DessinerRectangle(largeur_fenetre / 2 - 152, centre_y + 148, 304, 104);
                ChoisirCouleurDessin(CouleurParComposante(0, 0, 0));
            }
        }
    }
    return 0;
}