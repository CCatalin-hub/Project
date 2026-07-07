#ifndef AFFICHER_H
#define AFFICHER_H

	void dessiner_cadres_selection(int img, int x1, int x2, int x3, int y1, int l1, int l2, int l3, int h1, int h2, int h3);	

	void afficher_regles_ecran(int L, int H);

	void afficher_colone_ligne(char *col,char *lig,int colone,int ligne,int x1,int x3,int y1,int largeur_img1,int l_h_flech,int hauteur_img1);

	void afficher_etap_1(char *menu_img1,char *menu_img2,char *menu_img3,int x1, int x2,int x3, int y1, int largeur_fenetre,int largeur_img1, int largeur_menu_img1, int largeur_menu_img2, int largeur_menu_img3, int hauteur_fenetre, int hauteur_menu_img1, int hauteur_menu_img2, int hauteur_menu_img3, int l_h_flech );

	void afficher_etap_2(char *menu_img1, char *menu_img2, char *menu_img3,int x1, int x2, int x3, int y1,int largeur_img1, int largeur_menu_img1, int largeur_menu_img2, int largeur_menu_img3,int hauteur_menu_img1, int hauteur_menu_img2, int hauteur_menu_img3,int l_h_flech, int flech_y_h, int flech_y_b,char *flech_b,char  *flech_h, int largeur_fenetre, int hauteur_fenetre);


#endif