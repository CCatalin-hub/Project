#ifndef BUTTON_H
#define BUTTON_H

 	int bouton_suivant(int suiv,int coord_x, int coord_y,int hauteur_fenetre, int largeur_fenetre, int largeur_img1 , int l_h_flech);

	int bouton_c(int coord_x, int coord_y, int x1,int largeur_img1,int l_h_flech,int flech_y_h,int flech_y_b,int colone);

	int bouton_l(int coord_x,int coord_y,int x3,int largeur_img1,int l_h_flech,int flech_y_b,int flech_y_h,int ligne);

	int bouton_menu(int touche,int selection_menu);

	int lim_colone(int colone);

	int lim_ligne(int ligne);

	int choi_img(int img, int coord_x, int coord_y, int hauteur_img1, int largeur_img1, int largeur_img2, int largeur_img3, int x1, int x2, int x3,int y1);

#endif