#ifndef MENU_H
#define MENU_H

	int valid_menu(int touche,int selection_menu,int largeur_fenetre,int hauteur_fenetre,int suiv,int centre_y);

	void dessiner_menu(int L,int centre_y);
	
	int menu( int hauteur_fenetre, int largeur_fenetre, int suiv );
#endif