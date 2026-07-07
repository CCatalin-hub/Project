#include <stdio.h>
#include <stdlib.h>
#include <graph.h>
#include "matrix.h"
#include "bouton.h"
#include "afficher.h"
#include "jeux_part_1.h"
#include "config.h"

int jeux_part_1(int suiv, int img, int largeur_fenetre, int largeur_img1, int hauteur_fenetre, int hauteur_img1, int flech_y_b,int flech_y_h, int x1, int x3,int y1,int victoire ){
    if(1){
    int coord_x,coord_y,colone,ligne, touche;
    char col[15], lig[15];
    int l_h_flech=120;
    colone=3;ligne=3;
        afficher_etap_2(  menu_img1, menu_img2,  menu_img3,x1,  x2,  x3,  y1,largeur_img1,  largeur_menu_img1,  largeur_menu_img2,  largeur_menu_img3,hauteur_menu_img1,  hauteur_menu_img2,  hauteur_menu_img3,l_h_flech,  flech_y_h,  flech_y_b,flech_b, flech_h, largeur_fenetre,  hauteur_fenetre);
        afficher_colone_ligne( col, lig, colone, ligne, x1, x3, y1, largeur_img1, l_h_flech, hauteur_img1);
        while(suiv == 2){
            
            if (SourisCliquee()){
                SourisPosition();
                coord_x=_X;
                coord_y=_Y;
                colone=bouton_c(coord_x,coord_y,x1,largeur_img1,l_h_flech,flech_y_h,flech_y_b,colone);
                ligne=bouton_l(coord_x,coord_y,x3,largeur_img1,l_h_flech,flech_y_b,flech_y_h,ligne);

                colone = lim_colone(colone);
                ligne = lim_ligne(ligne);
                afficher_colone_ligne( col, lig, colone, ligne, x1, x3, y1, largeur_img1, l_h_flech, hauteur_img1);
                suiv=bouton_suivant(suiv,coord_x,coord_y,hauteur_fenetre,largeur_fenetre,largeur_img1,l_h_flech);
            }
            if (ToucheEnAttente()){
                touche = Touche();
                if (touche == XK_Right){ 
                    colone+=1;}
                if (touche == XK_Left){ 
                    colone-=1;}
                if (touche == XK_Up){ 
                    ligne+=1;}
                if (touche == XK_Down){
                    ligne-=1;}
                if (touche == XK_Return){ 
                    suiv = 3;}

                   colone = lim_colone(colone);
                ligne = lim_ligne(ligne);
                afficher_colone_ligne( col, lig, colone, ligne, x1, x3, y1, largeur_img1, l_h_flech, hauteur_img1);
            }
        }

        if (suiv == 3){
            char *img1 = "img/plancton.jpg";
            char *img2 = "img/f1.jpg";
            char *img3 = "img/tortue.jpg";
            char ess[15];
            char *image_jeu;
            int nb_essey=0,o,jeux_en_cours,img_l, img_h;
            int **matrix = matrix_f(colone,ligne);

            jeux_en_cours = 1;

            if (img == 1){
               img_l=485; 
                img_h=717;
                image_jeu=img1;
            }

            if (img == 2){
                img_l=647; 
                img_h=431;
                image_jeu=img2;
            }

            if (img == 3){
                img_l=822; 
                img_h=514;
                image_jeu=img3;
            }

            melanger(matrix,ligne,colone);
            affiche_matrix(matrix, image_jeu, img_l, img_h, colone, ligne, largeur_fenetre, hauteur_fenetre);
            sprintf(ess,"Essais: %d",nb_essey);
            ChoisirCouleurDessin(CouleurParComposante(0,0,0));
            EcrireTexte(x1+(largeur_fenetre/6)+100, (y1+hauteur_fenetre / 10)+400 , ess ,2); 
            EcrireTexte(x1+(largeur_fenetre/6)+100, (y1+hauteur_fenetre / 10)+400*2 , "ESC pour revenir a menu." ,2);

            while(jeux_en_cours == 1){
                int dec_centre_x,dec_centre_y,clic_l,clic_c,piece_l,piece_h,mouvement_ok,boucle,c;
                int vide_l,vide_c,coord_y,coord_x;

                /* Dimensions d'une pièce et décalage pour centrer l'image */
                dec_centre_x = (largeur_fenetre - img_l) / 2;
                dec_centre_y = (hauteur_fenetre - img_h) / 2;
                piece_l = img_l / colone;
                piece_h = img_h / ligne;
                mouvement_ok=0;
             
                if (ToucheEnAttente()) {
                    touche = Touche();
                    
                    mouvement_ok = 0;
                    if (touche == XK_Escape) {
                        jeux_en_cours = 0; 
                        suiv = 2;          
                        break;             
                    }

                    /* Trouver la case vide */
                    vide_l = -1;
                    vide_c = -1;
                    for (boucle = 0; boucle < ligne; boucle++) {
                        for (c = 0; c < colone; c++) {
                            if (matrix[boucle][c] == 0) {
                                vide_l = boucle;
                                vide_c = c;
                                break;
                            }
                        }
                        if (vide_l != -1) {
                            break;
                        }
                     }

                    /* Si pas trouvé */
                    if (vide_l != -1 && vide_c != -1) {

                        /* Choisir la case selon la touche */
                        clic_l = vide_l;
                        clic_c = vide_c;

                        if (touche == XK_Right)       clic_c -= 1;
                        else if (touche == XK_Left)   clic_c += 1;
                        else if (touche == XK_Up)     clic_l += 1;
                        else if (touche == XK_Down)   clic_l -= 1;

                        /* Des limites  */
                        if (clic_l >= 0 && clic_l < ligne &&
                            clic_c >= 0 && clic_c < colone) {

                            /* Vérifier adjacent -*/
                            if ((abs(clic_l - vide_l) == 1 && clic_c == vide_c) ||
                                (abs(clic_c - vide_c) == 1 && clic_l == vide_l)) {

                                /* Échanger*/
                                matrix[vide_l][vide_c] = matrix[clic_l][clic_c];
                                matrix[clic_l][clic_c] = 0;

                                mouvement_ok = 1;
                                nb_essey++;
                            }
                        }
                    }
                }

                /* souri */
                if (SourisCliquee()) {
                    SourisPosition();
                    coord_x = _X;
                    coord_y = _Y;
                    if (coord_x > largeur_fenetre - img_l && coord_y > hauteur_fenetre - l_h_flech){ 
                        jeux_en_cours = 0; 
                        suiv = -1; }
                    else {
                        clic_l = (coord_y - dec_centre_y) / piece_h;
                        clic_c = (coord_x - dec_centre_x) / piece_l;
                        if (clic_l >= 0 && clic_l < ligne && clic_c >= 0 && clic_c < colone){
                            for (boucle = 0; boucle < ligne; boucle++){ 
                                for (c = 0; c < colone; c++){ 
                                    if (matrix[boucle][c] == 0){ 
                                        vide_l = boucle; 
                                        vide_c = c; 
                                        break; 
                                    } 
                                } 
                            }
                                    
                            if ((abs(clic_l - vide_l) == 1 && clic_c == vide_c) || (abs(clic_c - vide_c) == 1 && clic_l == vide_l)){
                                matrix[vide_l][vide_c] = matrix[clic_l][clic_c];
                                matrix[clic_l][clic_c] = 0;
                                mouvement_ok = 1;
                                nb_essey+=1;
                            }
                        }
                    }
                }
                         
                if (mouvement_ok == 1) {
                    deplacer_case(image_jeu, img_l, img_h, colone, ligne, largeur_fenetre, hauteur_fenetre, vide_c, vide_l, matrix[vide_l][vide_c]);
                    dessiner_blanc_seul(largeur_fenetre, hauteur_fenetre, img_l, img_h, colone, ligne, clic_c, clic_l);
                        
                    sprintf(ess,"Essais: %d",nb_essey);
                    ChoisirCouleurDessin(CouleurParComposante(119,136,153));
                    RemplirRectangle(x1+(largeur_fenetre/6) +80 +100 ,(y1+hauteur_fenetre / 17)+400,70,50);
                    ChoisirCouleurDessin(CouleurParComposante(0,0,0));
                    EcrireTexte(x1+(largeur_fenetre/6)+100,(y1+hauteur_fenetre / 10)+400, ess ,2);  
                }



                if (verifier_victoire(matrix, ligne, colone)){ 
                    jeux_en_cours = 0; 
                    victoire = 1 ; 
                }
            }
            for (o = 0; o < ligne; o++){ 
                free(matrix[o]);
            }
            free(matrix);
    
        }

    
    }
    

    return victoire;
}
