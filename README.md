# common
Some scripts for managing GPIO with sysfs

- init_GPIO.sh should be run at startup (by loading it in /etc/rc.local)
- gpio.sh is the shell script which interacts with hardware GPIO
- index.php is the frontend
- action.php is the action file, which calls gpio.sh

If you use Apache, with www-data user :

For temperature access :
sudo addgroup www-data video

for GPIO access :
sudo addgroup www-data gpio

Grant adequate permissions (550 mean root and group www-data can read and execute, nobody can write) :
sudo chown root:www-data /home/pi/gpio.sh
sudo chmod 550 /home/pi/gpio.sh

And allow apache to sudo on this script :
sudo nano /etc/sudoers.d/020_www-data-nopasswd

Insert this lines :
www-data        ALL=(ALL) NOPASSWD:GPIO
# Cmnd alias specification
Cmnd_Alias GPIO = /home/pi/gpio.sh

Restart Apache :
sudo service apache2 restart
