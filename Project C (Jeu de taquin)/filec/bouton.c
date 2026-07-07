#include <graph.h>
#include "bouton.h"

 /*suivant souri*/
int bouton_suivant(int suiv,int coord_x, int coord_y, int hauteur_fenetre, int largeur_fenetre, int largeur_img1, int l_h_flech ){
    if (coord_y >= hauteur_fenetre - l_h_flech -50  && coord_y <= hauteur_fenetre - l_h_flech  ){
        if (coord_x >= largeur_fenetre - largeur_img1   && coord_x <= largeur_fenetre - largeur_img1 +100){
            suiv+=1;
            return  suiv;
                }}
                return suiv;
    }

/* bouton colone souri */
int bouton_c(int coord_x, int coord_y, int x1,int largeur_img1,int l_h_flech,int flech_y_h,int flech_y_b,int colone){
  if (coord_y >= flech_y_h && coord_y <= flech_y_h + l_h_flech){
        if (coord_x >= x1+(largeur_img1/3) && coord_x <= x1+(largeur_img1/3) + l_h_flech){
            colone++;
            return colone;
    }
} 
if (coord_y >= flech_y_b && coord_y <= flech_y_b + l_h_flech){ 
                if (coord_x >= x1+(largeur_img1/3) && coord_x <= x1+(largeur_img1/3) + l_h_flech){
                    colone-=1;
                    return colone;
            }
    }
    return colone;
}  

/* bouuton ligne souri */
int bouton_l(int coord_x,int coord_y,int x3,int largeur_img1,int l_h_flech,int flech_y_b,int flech_y_h,int ligne){
    if (coord_y >= flech_y_h && coord_y <= flech_y_h + l_h_flech){
        if (coord_x >= x3+(largeur_img1/3)  && coord_x <= x3+(largeur_img1/3) +l_h_flech){
            ligne++;
            return ligne;
        }
    }
    if (coord_y >= flech_y_b && coord_y <= flech_y_b + l_h_flech){ 
        if (coord_x >= x3+(largeur_img1/3)  && coord_x <= x3+(largeur_img1/3) +l_h_flech){
            ligne-=1;
            return ligne;
        }
    }
    return ligne;
}

/* les 3 boutone du benu */
int bouton_menu(int touche,int selection_menu){
    if (touche == XK_Down){
        if (selection_menu < 3){
            selection_menu+=1;
        }
        else{
            selection_menu=1;
        }
    }   
    if (touche == XK_Up){ 
        if (selection_menu > 1){
            selection_menu-=1;
        }
        else{
            selection_menu=3;

        }
    }
    return selection_menu;
}

/*limit pour colone*/
int lim_colone(int colone){
    int min_colone, max_colone;

    min_colone=3;
    max_colone=8;

    if (colone < min_colone){
        colone = min_colone;
    }
    if (colone > max_colone){
        colone = max_colone;
    }
    return colone;
}

/*limit pour ligne*/
int lim_ligne(int ligne){
    int min_ligne,max_ligne;

    min_ligne=3;
    max_ligne=8;

    if (ligne < min_ligne){
        ligne = min_ligne;
    }
    if (ligne > max_ligne){
        ligne = max_ligne;
    }
    return ligne;
}

/*choi img par souri*/
int choi_img(int img, int coord_x, int coord_y, int hauteur_img1, int largeur_img1, int largeur_img2, int largeur_img3, int x1, int x2, int x3,int y1){
    if (coord_y >= y1 && coord_y <= hauteur_img1){
        if (coord_x >= x1 && coord_x <= x1 + largeur_img1 ){
            img = 1;}
        if (coord_x >= x2 && coord_x <= x2 + largeur_img2 ){
            img = 2;}
        if (coord_x >= x3 && coord_x <= x3 + largeur_img3 ){
            img = 3;}
    }
    return img;
}