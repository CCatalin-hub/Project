### VARIABLES ###
JC = javac
JCFLAGS = -encoding UTF-8 -d class -sourcepath src
JVM = java
JVMFLAGS = -cp class

all : class Main.class

#Créer le dossier class s'il n'existe pas
class :
	mkdir -p class

### REGLES ESSENTIELLES ###

Main.class : src/Main.java FenetreJeu.class
	${JC} ${JCFLAGS} src/Main.java

FenetreJeu.class : src/FenetreJeu.java Grille.class
	${JC} ${JCFLAGS} src/FenetreJeu.java

Grille.class : src/Grille.java
	${JC} ${JCFLAGS} src/Grille.java


### REGLES OPTIONNELLES ###

run : all
	${JVM} ${JVMFLAGS} Main

clean :
	rm -rf class/*.class

mrproper : clean
	rm -rf class

### BUTS FACTICES ###

.PHONY : all run clean mrproper

### FIN ###