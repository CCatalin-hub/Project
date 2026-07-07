#include <stdlib.h>
#include <graph.h>
#include "bouton.h"
#include "menu.h"
#include "afficher.h"
#include "jeux_part_1.h"
#include "jeux_part_2.h"
#include "config.h"

void jeux_part_2(){
    int img=0;
    int suiv=0;
    int victoire=0;
    while(!victoire){
        EffacerEcran(CouleurParComposante(255,255,255));

        /*afficher menu + tout ca logique*/
        suiv=menu(hauteur_fenetre, largeur_fenetre, suiv); 
        /*afficher l'etap de choix d'img*/
        afficher_etap_1(menu_img1,menu_img2,menu_img3,x1, x2,x3, y1, largeur_fenetre,largeur_img1, largeur_menu_img1, largeur_menu_img2, largeur_menu_img3, hauteur_fenetre, hauteur_menu_img1, hauteur_menu_img2, hauteur_menu_img3,l_h_flech );

        /*choix img*/
       while(suiv == 1){
            int old_img = img;

            /* clavie*/
            if (ToucheEnAttente()){
                int touche;
                touche = Touche();
                if (touche == XK_Left){
                    if (img > 1){
                        img-=1;}
                    else{
                        img=3;}
                }
                if (touche == XK_Right){
                    if (img < 3){
                        img+=1;}
                    else{
                        img=1;}
                }

                if (touche == XK_Return && img != 0){
                    suiv = 2;}
            }

            /*souri*/
            if (SourisCliquee()){
                int coord_x,coord_y;
                SourisPosition();
                coord_x=_X;
                coord_y=_Y;  
                img = choi_img(img, coord_x, coord_y, hauteur_menu_img1, largeur_menu_img1, largeur_menu_img2, largeur_menu_img3, x1, x2, x3, y1);
                
                if(img != 0){
                    suiv=bouton_suivant(suiv,coord_x,coord_y,hauteur_fenetre,largeur_fenetre, largeur_img1,l_h_flech);
                }
            }
            if (old_img != img) {
                dessiner_cadres_selection(img, x1, x2, x3, y1,largeur_menu_img1, largeur_menu_img2, largeur_menu_img3,hauteur_menu_img1, hauteur_menu_img2, hauteur_menu_img3);
            }
        }
    
        /*afficher menu du colone ligne*/
        
        
        /*jeux part 1*/
        victoire=jeux_part_1( suiv, img,  largeur_fenetre, largeur_img1,  hauteur_fenetre, hauteur_img1,flech_y_b,flech_y_h, x1, x3, y1,victoire);

        /*retour au menu*/
        if (victoire == 1) {
            EffacerEcran(CouleurParComposante(119,136,153));
            ChargerImage(img_victoir,largeur_fenetre/3,hauteur_fenetre /10,0,0,largeur_img_victoir,hauteur_img_victoir);

            ChoisirCouleurDessin(CouleurParComposante(0,0,0));
            EcrireTexte(largeur_fenetre / 3 , (hauteur_fenetre / 10)+ 30 +hauteur_img_victoir, "VICTOIRE !", 2);
            EcrireTexte(largeur_fenetre/ 3 , (hauteur_fenetre / 10) + 60 + hauteur_img_victoir, "Appuyez sur la clavie ou clicke pour revenir au menu", 2);

            while (victoire == 1) {
                if (ToucheEnAttente() || SourisCliquee()) {
                    victoire = 0; 
                    suiv=0;
                    img=0;                      
                }
            }
        }
    }
}
