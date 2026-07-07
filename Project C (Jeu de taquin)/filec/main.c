#include <stdlib.h>
#include <graph.h>
#include "config.h"
#include "jeux_part_2.h"

int main(void) {

    InitialiserGraphique();
    CreerFenetre(0, 0, largeur_fenetre, hauteur_fenetre);

    jeux_part_2();

    return EXIT_SUCCESS;
}
