#ifndef MATRIX_H
#define MATRIX_H

	int **matrix_f(int colone, int ligne);

	void melanger(int **matrix,int ligne, int colone);

	void affiche_matrix(int **matrix,char *image_jeu,int img_l,int img_h,int colone,int ligne,int largeur_fenetre,int hauteur_fenetre);
	
	void deplacer_case(char *img_path, int img_l, int img_h, int nb_col, int nb_lig, int win_l, int win_h,int case_c, int case_l, int val_piece);

	void dessiner_blanc_seul(int win_l, int win_h, int img_l, int img_h,int nb_col, int nb_lig,int case_c, int case_l);

	int verifier_victoire(int **matrix, int ligne, int colone);
#endif