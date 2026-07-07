#include <stdio.h>
#include <stdlib.h>
#include <graph.h>
#include "afficher.h"

void dessiner_cadres_selection(int img, int x1, int x2, int x3, int y1, int l1, int l2, int l3, int h1, int h2, int h3) {
    /* Effacer les anciens cadres (carré blanc) */
    ChoisirCouleurDessin(CouleurParComposante(119,136,153));
    DessinerRectangle(x1 - 5, y1 - 5, l1 + 10, h1 + 10);
    DessinerRectangle(x2 - 5, y1 - 5, l2 + 10, h2 + 10);
    DessinerRectangle(x3 - 5, y1 - 5, l3 + 10, h3 + 10);
    
    /* Dessiner le nouveau cadre rouge */
    ChoisirCouleurDessin(CouleurParComposante(255,0,0));
    if (img == 1) DessinerRectangle(x1 - 5, y1 - 5, l1 + 10, h1 + 10);
    if (img == 2) DessinerRectangle(x2 - 5, y1 - 5, l2 + 10, h2 + 10);
    if (img == 3) DessinerRectangle(x3 - 5, y1 - 5, l3 + 10, h3 + 10);
}

void afficher_regles_ecran(int L, int H) {
    EffacerEcran(CouleurParComposante(119,136,153));
    EcrireTexte(100, 100, "REGLES DU JEU :", 2);
    EcrireTexte(100, 200, "- SELECTIONNER L'IMAGE ET LA TAILLE DE LA GRILLE ( FLECHES CLAVIER).", 1);
    EcrireTexte(100, 250, "- DEPLACEZ LES PIECES POUR RECONSTITUER L'IMAGE.", 1);
    EcrireTexte(100, 300, "- LA CASE VIDE DOIT FINIR EN BAS A DROITE (SOURIS: CLIC ADJACENT / CLAVIER: FLECHES).", 1);
    EcrireTexte(L/2 - 150, H - 100, "CLIQUER POUR RETOURNER AU MENU", 1);
    while (!SourisCliquee() && !ToucheEnAttente())
    if (ToucheEnAttente())
        Touche();
}


void afficher_colone_ligne(char *col,char *lig,int colone,int ligne,int x1,int x3,int y1,int largeur_img1,int l_h_flech,int hauteur_img1){
    sprintf(col,"Colone: %d",colone);
    sprintf(lig, "Ligne: %d ",ligne); 
    ChoisirCouleurDessin(CouleurParComposante(119,136,153));
    RemplirRectangle(x1+(largeur_img1/3) + l_h_flech+100 ,y1+hauteur_img1+20,50,100);
    RemplirRectangle(x3+(largeur_img1/3) - l_h_flech +60 ,y1+hauteur_img1+20,50,100);
    ChoisirCouleurDessin(CouleurParComposante(0,0,0));
    EcrireTexte(x1+(largeur_img1/3) + l_h_flech+10, y1+hauteur_img1+20*5, col ,2); 
    EcrireTexte(x3+(largeur_img1/3) - l_h_flech, y1+hauteur_img1+20*5, lig ,2);
}

void afficher_etap_1(char *menu_img1,char *menu_img2,char *menu_img3,int x1, int x2,int x3, int y1, int largeur_fenetre,int largeur_img1, int largeur_menu_img1, int largeur_menu_img2, int largeur_menu_img3, int hauteur_fenetre, int hauteur_menu_img1, int hauteur_menu_img2, int hauteur_menu_img3, int l_h_flech ){
    EffacerEcran(CouleurParComposante(119,136,153));
    ChargerImage(menu_img1, x1, y1, 0, 0, largeur_menu_img1, hauteur_menu_img1);
    ChargerImage(menu_img2, x2, y1, 0, 0, largeur_menu_img2, hauteur_menu_img2);
    ChargerImage(menu_img3, x3, y1, 0, 0, largeur_menu_img3, hauteur_menu_img3);
    EcrireTexte(x1+largeur_menu_img1/2,y1 + hauteur_menu_img1 +25 ,"image 1",1);
    EcrireTexte(x2+(largeur_menu_img1/2),y1 +hauteur_menu_img2 +25,"image 2",1);
    EcrireTexte(x3+(largeur_menu_img1/2),y1 + hauteur_menu_img3 +25,"image 3",1);
    EcrireTexte(x2+(largeur_menu_img1/3),y1 * 20,"Choisir une image",1);
    EcrireTexte(largeur_fenetre - largeur_img1 ,hauteur_fenetre - l_h_flech, "SUIVANT" ,2);
}

void afficher_etap_2( char *menu_img1, char *menu_img2, char *menu_img3,int x1, int x2, int x3, int y1,int largeur_img1, int largeur_menu_img1, int largeur_menu_img2, int largeur_menu_img3,int hauteur_menu_img1, int hauteur_menu_img2, int hauteur_menu_img3,int l_h_flech, int flech_y_h, int flech_y_b,char  *flech_b, char *flech_h, int largeur_fenetre, int hauteur_fenetre){
    EffacerEcran(CouleurParComposante(119,136,153));
    ChargerImage(menu_img1, x1, y1, 0, 0, largeur_menu_img1, hauteur_menu_img1);
    ChargerImage(menu_img2, x2, y1, 0, 0, largeur_menu_img2, hauteur_menu_img2);
    ChargerImage(menu_img3, x3, y1, 0, 0, largeur_menu_img3, hauteur_menu_img3);
    ChargerImage(flech_h, x1+(largeur_img1/3), flech_y_h, 0, 0,l_h_flech,l_h_flech);
    ChargerImage(flech_b, x1+(largeur_img1/3), flech_y_b, 0, 0,l_h_flech,l_h_flech);
    ChargerImage(flech_h, x3+(largeur_img1/3), flech_y_h, 0, 0,l_h_flech,l_h_flech);
    ChargerImage(flech_b, x3+(largeur_img1/3), flech_y_b, 0, 0,l_h_flech,l_h_flech);
    ChoisirCouleurDessin(CouleurParComposante(0,0,0));
    EcrireTexte(largeur_fenetre - largeur_img1 ,hauteur_fenetre - l_h_flech, "SUIVANT" ,2);
}