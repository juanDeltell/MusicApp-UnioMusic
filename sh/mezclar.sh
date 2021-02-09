#!/bin/bash
# Script que recibe dos archivos de sonido y los mezcla usando SoX
# Si es necesario modifica el numero de canales y/o el sample rate
# de alguno de los dos.
#
# Necesita tener instalado SoX (Sound eXchange)
# Tipos de archivo soportados por Sox:
#	- aiff
#	- flac
#	- ogg
#	- wav
#
# Comprobado que funciona tambien con la libreria mp3 de SoX.
# (libsox-fmt-mp3)

SOXI=/usr/bin/soxi
# Si falta un campo
if [ ! $1 ] || [ ! $2 ] || [ ! $3 ]; then

	echo "Faltan argumentos."
	echo "Usage ./mezclar.sh <sonido1> <sonido2> <sonidoResultante>"
	exit -1

fi

# Si no existe algun archivo
if [ ! -f $1 ]; then

	echo "No existe el archivo 1."
	exit -2

elif [ ! -f $2 ]; then

	echo "No existe el archivo 2."
	exit -3

fi

# Numero de canales de los sonidos
CAN_1=`$SOXI $1 | sed -n 3p | cut -d ":" -f 2`
CAN_2=`$SOXI $2 | sed -n 3p | cut -d ":" -f 2`

# Sample Rate de los sonidos
SAMP_1=`$SOXI $1 | sed -n 4p | cut -d ":" -f 2`
SAMP_2=`$SOXI $2 | sed -n 4p | cut -d ":" -f 2`

SONIDO1=$1
SONIDO2=$2

# He hecho esto por si se intenta crear dos sonidos nuevos a la vez.
# Se llamara "sonidoNuevo_[numero]_[samp, can].wav" y no se sobreescribiran.
# [numero] es el numero de segundos desde 1970 hasta la fecha actual.
A="sonidoNuevo_"
B=`date +%s`
CC="_can.wav"
CS="_samp.wav"

NEW_NAME_CANAL="/var/www/html/UnionMusic/tmp/"$A$B$CC
NEW_NAME_SAMPLE="/var/www/html/UnionMusic/tmp/"$A$B$CS

# Si no tienen el mismo numero de canales no se pueden mezclar.
# Se coge el que menos canales tenga y se iguala al numero de canales
# del otro sonido.
if [ $CAN_1 != $CAN_2 ]; then 

	echo "No tienen el mismo numero de canales."

	if [ $CAN_1 -lt $CAN_2 ]; then

		SONIDO1=$NEW_NAME_CANAL
		sox $1 -c $CAN_2 $SONIDO1


	else

		SONIDO2=$NEW_NAME_CANAL
		sox $2 -c $CAN_1 $SONIDO2

	fi
fi

# Igual con el Sample Rate.
# En este caso trabaja con la variable SONIDO1 y SONIDO2 
# por si ha tenido que cambiar el numero de canales.
if [ $SAMP_1 != $SAMP_2 ]; then
	
	echo "No tienen el mismo sample rate."

	if [ $SAMP_1 -lt $SAMP_2 ]; then
		
		SONIDO1=$NEW_NAME_SAMPLE
		sox $SONIDO1 -r $SAMP_2 $SONIDO1

	else
		
		SONIDO2=$NEW_NAME_SAMPLE
		sox $SONIDO2 -r $SAMP_1 $SONIDO2

	fi

fi

echo "Mezclando " $SONIDO1 y $SONIDO2 en $3

sox -m $SONIDO1 $SONIDO2 $3

# Borra cualquier sonido modificado. Sobre todo para no generar mucha basura.
# Es mejor volver a modificar que andar guardando mil versiones del
# mismo sonido (Y los wav ocupan una barbaridad).
if [ $NEW_NAME_CANAL ] && [ -f $NEW_NAME_CANAL ]; then 

	rm $NEW_NAME_CANAL
	
fi

if [ $NEW_NAME_SAMPLE ] && [ -f $NEW_NAME_SAMPLE ]; then 

	rm $NEW_NAME_SAMPLE
	
fi
