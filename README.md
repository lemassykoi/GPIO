# GPIO

Some scripts for managing GPIO with sysfs (ie. with new kernel 4.9) on Raspberry Pi 2/3

- init_GPIO.sh should be run at startup (by loading it in /etc/rc.local)
- gpio.sh is the shell script which interacts with hardware GPIO
- index.php is the frontend
- action.php is the action file, which calls gpio.sh

If you use Apache, with www-data user :


For temperature access :

<code>sudo addgroup www-data video</code>


for GPIO access :

<code>sudo addgroup www-data gpio</code>


Grant adequate permissions (550 mean root and group www-data can read and execute, nobody can write) :

<code>sudo chown root:www-data /home/pi/gpio.sh</code>
<code>sudo chmod 550 /home/pi/gpio.sh</code>


And allow apache to sudo on this script :

<code>sudo nano /etc/sudoers.d/020_www-data-nopasswd</code>


Insert this lines :

<code>www-data        ALL=(ALL) NOPASSWD:GPIO</code>
<code>Cmnd_Alias GPIO = /home/pi/gpio.sh</code>


Restart Apache :

<code>sudo service apache2 restart</code>

![alt text](https://raw.githubusercontent.com/lemassykoi/GPIO/master/index.PNG)
