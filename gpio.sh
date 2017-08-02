#!/bin/bash
#-----------------------------------------------------------------------------
##
## - $1 is the number between 1 and 8 for Pin Control
## - $2 is the state wanted, ON or OFF
##
GREEN='\033[0;32m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Make sure only root can run our script
if [ "$(id -u)" != "0" ]; then
   echo -e "${RED}This script must be run as root${NC}" 1>&2
   exit 1
fi

gpio=( '0' '5' '6' '13' '26' '21' '25' '16' '20' )
pin=$1   ## PIN Number
state=$2 ## Sate Wanted

## CHECK
if [ "$state" = "ON" ] ; then
value='1'
elif [ "$state" = "OFF" ] ; then
value='0'
elif [ "$state" = "true" ] ; then
value='1'
elif [ "$state" = "false" ] ; then
value='0'
else echo -e "${RED}ERREUR sur lecture de variable STATE${NC}" && exit 1
fi

## echo "Valeur : ${gpio[$pin]}"
## echo "State  : $state"

## SETTING THE VALUE TO ON / OFF
echo $value > /sys/class/gpio/gpio${gpio[$pin]}/value

exit 0
