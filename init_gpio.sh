#-----------------------------------------------------------------------------
# Init sysfs GPIO ports Raspberry Pi 2/3
##                              RUN AS ROOT !!!
#
#               CHECK OVERLAY AT BOOT FOR PWM-2CHAN
# PWM0 = pin 12 = GPIO18
# PWM1 = pin 35 = GPIO19
#
#-----------------------------------------------------------------------------
##
GREEN='\033[0;32m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Make sure only root can run our script
if [ "$(id -u)" != "0" ]; then
   echo -e "${RED}This script must be run as root${NC}" 1>&2
   exit 1
fi

## Check for BC (necessary for calculs of Duty Cycle for PWM)
dpkg -l | grep "ii  bc" > /dev/null
if [ "$(echo $?)" != "0" ]; then
echo "NO BC, installing..."
apt-get install -y bc
else
echo "BC found... Ok."
fi

## UNEXPORT
for pins in 5 6 12 13 16 25 20 26 21 18 19
do
#echo "Unexport"
#echo $pins
echo $pins > /sys/class/gpio/unexport
done
echo 0 > /sys/class/pwm/pwmchip0/unexport ## PWM0
echo 1 > /sys/class/pwm/pwmchip0/unexport ## PWM1

## EXPORT
for pins in 5 6 12 13 16 25 20 26 21 18 19
do
#echo "Export"
#echo $pins
echo $pins > /sys/class/gpio/export
done
echo 0 > /sys/class/pwm/pwmchip0/export ## PWM0
echo 1 > /sys/class/pwm/pwmchip0/export ## PWM1

## Set direction = in/out
for pins in 5 6 12 13 16 25 20 26 21 ## 18 19  # not necessary for PWM pins
do
#echo "Direction"
#echo $pins
echo out > /sys/class/gpio/gpio$pins/direction
done

### PIR SENSOR
# echo 7 > /sys/class/gpio/export
# echo in > /sys/class/gpio/gpio7/direction
