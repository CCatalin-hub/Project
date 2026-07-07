#include <stdlib.h>
#include <stdio.h>
#include <graph.h>
#include <time.h>
#include "matrix.h"

/* Créer la matrice avec le vide (0) en haut à gauche */
int **matrix_f(int colone, int ligne) {                        
    int **tab = malloc(ligne * sizeof(int*));   
    int compteur = 1, i, j;

    for (i = 0; i < ligne; i++) {
        tab[i] = malloc(colone * sizeof(int));
    }

    for (i = 0; i < ligne; i++) {
        for (j = 0; j < colone; j++) {
            if (i == 0 && j == 0)
                tab[i][j] = 0; /* Le vide est placé au début */
            else
                tab[i][j] = compteur++;
        }
    }
    return tab;  
}

/* Mélanger en partant du coin haut gauche */
void melanger(int **matrix, int ligne, int colone) {
    int direction_l[] = {-1, 1,0,0};
    int direction_c[] = { 0,0, -1, 1};
    int nb_coups, compteur;
       int vide_l, vide_c;

    int choix, coor_depl_l, coor_depl_c, tmp;
    int valide; 

    srand(time(NULL));
 

    vide_l = 0; 
    vide_c = 1;
    nb_coups = 200 + rand() % 51 ;

    for (compteur = 0; compteur < nb_coups; compteur++) {
        valide = 0;
        while (!valide) {
            choix = rand() % 4;
             coor_depl_l = vide_l + direction_l[choix];
             coor_depl_c = vide_c + direction_c[choix];

             /*pour pas toucher la case vide*/
             if (coor_depl_l >= 0 && coor_depl_l < ligne && coor_depl_c >= 0 && coor_depl_c < colone  && matrix[coor_depl_l][coor_depl_c] == 0 && matrix[vide_l][vide_c] == 0) {
                vide_l+=1;
                vide_c+=1;
                valide = 1;
             }
            /* Vérifie si le mouvement reste dans la grille */
            if (coor_depl_l >= 0 && coor_depl_l < ligne && coor_depl_c >= 0 && coor_depl_c < colone && matrix[coor_depl_l][coor_depl_c] != 0 && matrix[vide_l][vide_c] != 0) {

                 tmp = matrix[coor_depl_l][coor_depl_c];
                 matrix[coor_depl_l][coor_depl_c] = matrix[vide_l][vide_c];
                 matrix[vide_l][vide_c] = tmp;

                 vide_l = coor_depl_l;
                 vide_c = coor_depl_c;
                 valide = 1;
            }

        }
    }
}

/* Vérifier la victoire avec le vide en haut à gauche */
int verifier_victoire(int **matrix, int ligne, int colone){
    int l, c, compte = 1;
    for (l = 0; l < ligne; l++) {
        for (c = 0; c < colone; c++) {
            if (l == 0 && c == 0) {
                if (matrix[l][c] != 0) return 0; 
            } else {
                if (matrix[l][c] != compte) return 0; 
                compte++;
            }
        }
    }
    return 1;
}

/* Affichage complet de la matrice */
void affiche_matrix(int **matrix, char *image_jeu, int img_l, int img_h, int colone, int ligne, int largeur_fenetre, int hauteur_fenetre){
    int coord_x, coord_y, nb2, nb1;
    int piece_l, piece_h, dec_centre_x, dec_centre_y, coord_img_s_l, coord_img_s_c;

    piece_l = img_l / colone;
    piece_h = img_h / ligne;

    dec_centre_x = (largeur_fenetre - img_l) / 2;
    dec_centre_y = (hauteur_fenetre - img_h) / 2;

    ChoisirCouleurDessin(CouleurParComposante(119,136,153));
    RemplirRectangle(0, 0, largeur_fenetre, hauteur_fenetre);

    for(nb1 = 0; nb1 < ligne; nb1++) {
        for(nb2 = 0; nb2 < colone; nb2++) {
            coord_x = dec_centre_x + nb2 * piece_l;
            coord_y = dec_centre_y + nb1 * piece_h;
            
            if(matrix[nb1][nb2] != 0) {

                coord_img_s_l = (matrix[nb1][nb2]) / colone; 
                coord_img_s_c = (matrix[nb1][nb2]) % colone;

                ChargerImage(image_jeu, coord_x, coord_y, coord_img_s_c * piece_l, coord_img_s_l * piece_h, piece_l, piece_h);
            } 

                
            
            ChoisirCouleurDessin(CouleurParComposante(119,136,153));
            DessinerRectangle(coord_x, coord_y, piece_l - 2, piece_h - 2);
        }
    }
}

/* Dessiner un déplacement unique (optimisation) */
void deplacer_case(char *img_path, int img_l, int img_h, int nb_col, int nb_lig, int win_l, int win_h, int case_c, int case_l, int val_piece){
    int piece_l, piece_h;
    int dec_x, dec_y;
    int dest_x, dest_y;
    int src_col, src_lig, src_x, src_y;

    piece_l = img_l / nb_col;
    piece_h = img_h / nb_lig;
    dec_x = (win_l - img_l) / 2;
    dec_y = (win_h - img_h) / 2;
    dest_x = dec_x + case_c * piece_l;
    dest_y = dec_y + case_l * piece_h;

    if (val_piece > 0) {
        /* Doit correspondre à la logique de affiche_matrix */
        src_col = (val_piece) % nb_col;
        src_lig = (val_piece) / nb_col;
        
        src_x = src_col * piece_l;
        src_y = src_lig * piece_h;

        ChargerImage(img_path, dest_x, dest_y, src_x, src_y, piece_l, piece_h);
        ChoisirCouleurDessin(CouleurParComposante(0,0,0));
        DessinerRectangle(dest_x, dest_y, piece_l, piece_h);
    }
}

/* Dessine le carré gris (vide) */
void dessiner_blanc_seul(int win_l, int win_h, int img_l, int img_h, int nb_col, int nb_lig, int case_c, int case_l){
    int piece_l = img_l / nb_col;
    int piece_h = img_h / nb_lig;
    int dec_x = (win_l - img_l) / 2;
    int dec_y = (win_h - img_h) / 2;
    int dest_x = dec_x + case_c * piece_l;
    int dest_y = dec_y + case_l * piece_h;

    ChoisirCouleurDessin(CouleurParComposante(119,136,153));
    RemplirRectangle(dest_x, dest_y, piece_l, piece_h);
}