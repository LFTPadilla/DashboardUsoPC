#!/bin/bash

#CREAR
if [[ $1 -eq 1 ]]; then
	result="$(sudo useradd -c "$3,$4" $2)"
fi

#MODIFICAR
if [[ $1 -eq 2 ]]; then
	result="$(sudo usermod -c "$3,$4" $2)"
fi

#ELIMINAR
if [[ $1 -eq 3 ]]; then
	result="$(sudo userdel $2)"
fi

#CAMBIAR CONTRASENA
if [[ $1 -eq 4 ]]; then
	result="$(sudo echo -e "$3\n$3" | sudo passwd $2)"
fi

