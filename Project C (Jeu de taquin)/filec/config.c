#include "config.h"

/* taile du fenetre */
const int largeur_fenetre = 1920;
const int hauteur_fenetre = 1080;

/*largeure + longueur des img */
const int largeur_menu_img1 = 406;
const int hauteur_menu_img1 = 600;
const int largeur_menu_img2 = 600; 
const int hauteur_menu_img2 = 400;
const int largeur_menu_img3 = 640; 
const int hauteur_menu_img3 = 400;
const int largeur_img1 = 485; 
const int hauteur_img1 = 717;
const int largeur_img2 = 647;
const int largeur_img3 = 822;
const int l_h_flech=120;
const int hauteur_img_victoir = 600;
const int largeur_img_victoir = 600;

/* Petit espace entre les images */
const int espace = 20;

/* Coordone */
const int y1 = 30;
const int x1 = (largeur_fenetre - (largeur_img1 + largeur_img2 + largeur_img3 + 2 * espace))/2;
const int x2 = x1 + largeur_img1 + espace;
const int x3 = x2 + largeur_img2 + espace;
const int flech_y_h = y1+hauteur_img1+20;
const int flech_y_b = y1+hauteur_img1+20*7;
 
 /* image*/
 char *flech_h = "img/flech_2.png";
 char *flech_b = "img/flech_1.png";
 char *menu_img1 = "img/menu_plancton.jpg";
 char *menu_img2 = "img/menu_f1.jpg";
 char *menu_img3 = "img/menu_tortue.jpg";
 char *img_victoir = "img/victoire.jpg";