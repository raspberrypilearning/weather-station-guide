Weather Station
==============

Data logging code for the Raspberry Pi Weather Station HAT

## Building the Weather Station Hat
1. Before you begin assembling your Weather Station,ensure you have the following components and kit.
  1. Large acrylic base
  2. Raspberry Pi 2
  3. Weather Station HAT
  4. CR1225 Coin Cell Battery
  5. 40 pin GPIO extender
  6. 4 x 8mm screws
  7. 4 x 6mm screws
  8. 4 x Hex spacers
  ![](fullkit.jpg)

1. Place the Raspberry Pi onto the acrylic base plate as shown below. Ensure the power connector is oriented to the base correctly..
![]()

1. Thread an 8mm screw through the underside of the acrylic base and the Raspberry Pi, and secure with a hex spacer.

![]()
![]()

1. Repeat this step for the remaining screws and spacers

![]()

1. Attach the 40 pin extender to the the Raspberry Pi

![]()

1. Take the Weather Station Hat and carefully snap it in two, along one of the scored lines.

![]()

1. Use pliers to remove the remaining section of the HAT.

![]()

1. Insert the coin cell battery with the positive side facing upwards into the HAT.

1. Attach the HAT to the Raspberry Pi.

![]()

1. Secure the hat using the 6mm screws.

![]()

1. Put the air-sensor to one side, as you'll be needing that later.

![]()

1. Insert your SD card into the Raspberry Pi.

![]()

1. The HAT provides power to the Raspberry Pi, via the GPIO pins. To power the Raspberry Pi, you will need the following parts.
  1. Power over Ethernet (PoE) injector
  2. Power over Ethernet (PoE) splitter
  3. 24V Transformer with international adaptors.
  4. CAT5 Ethernet cable (supplied?)

![]()

1. Connect your keyboard, screen and mouse to your Raspberry Pi.

![]()

1. Connect the PoE splitter to the Pi and the HAT.

![]()

1. Connect the PoE splitter to the PoE injector using the CAT5 ethernet cable.

![]()

1. Connect the PoE injector to the transformer, with the appropriate adaptor attached.

![]()

1. Connect the PoE injector to a network switch or router.

![]()

1. Plugin the adaptor to power up you Rasperry Pi.


## Instructions to setup software.

1. Start with a fresh install of the latest version of [Raspbian](LINK TO BE ADDED).
1. When booting for the first time, you will be presented with the raspi-config menu.
1. The Weather Station requires the [I²C](https://en.wikipedia.org/wiki/I%C2%B2C) communication protocol to be enabled on your Raspberry Pi. To do this:
  
  Select `Advanced Options` and press `Enter`
  
  Select `I2C` and press `Enter`
  
  Would you like the ARM I2C interface to be enabled? `Yes` > `Enter`
  
  The ARM I2C interface is enabled `Ok` > `Enter`
  
  Would you like the I2C kernel module to be loaded by default? `Yes` > `Enter`
  
  I2C kernel module will now be loaded by default `Ok` > `Enter`
  
  Select `Finish` from the main menu and press `Enter`
  
  Would you like to reboot now? `Yes` > `Enter`
  
1. First you want to make sure you have all the latest updates for your Raspberry Pi.

```bash
sudo apt-get update && sudo apt-get upgrade
```

1. You now need make some changes to a config file to allow the Raspberry Pi to use the real-time clock.

  `sudo nano /boot/config.txt`
  
  Add the following lines to the bottom of the file:
  
  ```
  dtoverlay=w1-gpio
  dtoverlay=pcf8523-rtc
  ```
  
  Press `Ctrl - O` then `Enter` to save and `Ctrl - X` to quit nano.

  Now set the required modules to load automatically on boot.

  `sudo nano /etc/modules`
  
  Add the following lines to the bottom of the file:
  
  ```
  i2c-dev
  w1-therm
  ```
  
  Press `Ctrl - O` then `Enter` to save and `Ctrl - X` to quit nano.

1. For the next steps we need the Weather Station hat to be connected to the Raspberry Pi.

```bash
sudo halt
```

1. Reboot for the changes to take effect.

  `sudo reboot`

1. Check that the Real Time Clock (RTC) appears in `/dev`
  
  `ls /dev/rtc*`
  
  Expected result: `/dev/rtc0`
  
1. Initialise the RTC with the correct time.

  Use the `date` command to check the current system time is correct. If correct then you can set the RTC time from the system clock with the following command:
  
  `sudo hwclock -w`
  
  If not then you can set the RTC time manually using the command below (you'll need to change the `--date` parameter, this example will set the date to the 1st of January 2014 at midnight):
  
  `sudo hwclock --set --date="yyyy-mm-dd hh:mm:ss" --utc`

for example:

  `sudo hwclock --set --date="2015-08-24 18:32:00" --utc`
  
  Then set the system clock from the RTC time.
  
  `sudo hwclock -s`

1. Enable setting the system clock automatically at boot time. First edit the hwclock udev rule:

  `sudo nano /lib/udev/hwclock-set`
  
  Find the lines at the bottom that read:
  
  ```
  if [ yes = "$BADYEAR" ] ; then
      /sbin/hwclock --rtc=$dev --systz --badyear
  else
      /sbin/hwclock --rtc=$dev --systz
  fi
  ```

  Change the `--systz` options to `--hctosys` so that they read:
  
  ```
  if [ yes = "$BADYEAR" ] ; then
      /sbin/hwclock --rtc=$dev --hctosys --badyear
  else
      /sbin/hwclock --rtc=$dev --hctosys
  fi
  ```

  Press `Ctrl - O` then `Enter` to save and `Ctrl - X` to quit nano.

1. Remove the fake hardware clock package.

  ```
  sudo update-rc.d fake-hwclock remove
  sudo apt-get remove fake-hwclock -y
  ```


1. Install the necessary software packages.

  ```
  sudo apt-get update
  sudo apt-get install i2c-tools python-smbus telnet apache2 mysql-server python-mysqldb php5 libapache2-mod-php5 php5-mysql -y
  ```
  
  This will take some time. You will be prompted to create and confirm a password for the root user of the MySQL database server.

1. Now it's time to connect the sensors, so poweroff your Raspberry Pi

```bash
sudo poweroff
```
## Connecting the sensors

The HAT has many sensors on the board, and several external sensors which connect to it. Details on each sensor and how to assemble and connect them can be found on the following pages:

[Rain Gauge]()
[Anemometer and Wind Vain]()
[Temperature probe]()

1. Connect the Air Sensor module to the Weather Station HAT using the cable provided.

2. Connect the sensors using the guides listed above.

## Testing the sensors

1. Power up your Raspberry Pi and login.

1. Test that the I²C devices are online and working.

  `sudo i2cdetect -y 1`
  
  Expected output:
  
  ```
       0  1  2  3  4  5  6  7  8  9  a  b  c  d  e  f
  00:          -- -- -- -- -- -- -- -- -- -- -- -- -- 
  10: -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
  20: -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
  30: -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
  40: 40 -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
  50: -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
  60: -- -- -- -- -- -- -- -- UU 69 6a -- -- -- -- -- 
  70: -- -- -- -- -- -- -- 77                         
  ```
  
  - `40` = HTU21D. Humidity and temperature sensor.
  - `77` = BMP180. Barometric pressure sensor.
  - `68` = PCF8523. Real Time Clock, it will show as `UU` because it's reserved by the driver.
  - `69` = MCP3427. Analogue to Digital Converter on main board.
  - `6a` = MCP3427. Analogue to Digital Converter on snap off AIR board (not present on prototype version).

  Note: `40`, `77` and `6a` will only show if you have connected the **AIR** board to the main board.

1. Download the data logging code.

  ```
  cd ~
  git clone https://github.com/raspberrypi/weather-station.git
  ```
  
  This will create a new folder in the home directory called `weather-station`.
1. **IMPORTANT**

1. Start the Weather Station daemon and test it.

  `sudo ~/weather-station/interrupt_daemon.py start`
  
  Expected result: `PID: 2345` (your number will be different)
  
  A continually running process is required to monitor the rain gauge and the anemometer. These are reed switch sensors and the code uses interrupt detection. These interrupts can occur at any time as opposed to the timed measurements of the other sensors. You can use the *telnet* program to test or monitor it.
  
  `telnet localhost 49501`
  
  Expected result:
  
  ```
  Trying 127.0.0.1...
  Connected to localhost.
  Escape character is '^]'.
  OK
  ```
  
  The following text commands can be used:
  
  - `RAIN`: displays rainfall in ml
  - `WIND`: displays average wind speed in kph
  - `GUST`: displays wind gust speed in kph
  - `RESET`: resets the rain gauge and anemometer interrupt counts to zero
  - `BYE`: quits
  
  Use the `BYE` command to quit.

---
BREAK HERE - 
---

## Assembling the Main Case.
1. Unpack the large grey case, and remove the 4 screws from inside and set them to one side. They are used for securing the lid at the end.

[]()

1. For this stage you will need:
  1. The large case
  2. 6 x 10mm screws
  3. Your acrylic mounted Raspberry Pi and Weather HAT

[]()

1. Fix the acryrlic base to the bottom of the case, using the 6 x 10mm screws

[]()


## Attaching the rain gauge and wind vain

1. Now you can attach the rain gauge. Remove the rubber seal from the side of the case.

[]()

1. Remove the 12mm plastic nut from the gromit on the rain gauge RJ11 cable

[]()

1. Using the nut as a guide, mark the seal with a 10mm (approx) circle.

[]()
[]()

1. Use a scalpel or sharp knife to cut a hole through the seal.

[]()

1. Push the end of the RJ11 cable through the seal.

[]()

2. Push the threaded end of the gromit through the seal, twisting might make this easier.

[]()

1. Feed the plastic nut back onto the RJ11 cable and thread it onto the gromit.

[]()

1. Push the seal back into the case.

[]()

2. Repeat the previous steps for the wind vain.

1. Connect the RJ11 cables to the Weather HAT.

[]()

1. Tighten the outer end of the grommit so it grips the cable and forms a water-tight seal.

## Setting up the air sensor housing.

1. For this you will need:
  1. 4 x Plastic Fixing Screws
  2. 4 x Plastic Spacers
  3. 4 x Plastic Fixing Nuts
  4. Small acrylic base
  5. Small air sensor housing.
  6. 2 x Mounting Screws

[]()

1. Align the air sensor board with the acrylic base as shown.

[]()

1. Using the plastic spacers to keep the board away from the acrylic base, fix it in place using the fixing screws and nuts.

[]()

1. Mount the acrylic base into the housing as shown below.

[]()

1. Conect the RJ11 cables from the Rasberry Pi housing and the temperature probe to the air sensor module.

[]()

TODO
 - Connecting air sensor via gromit
 - Connecting ethernet
 - Mounting feet
 - Placement
 - 


## Setting up the datalogging

1. Set the Weather Station daemon to automatically start at boot time.

  `sudo nano /etc/rc.local`
  
  Insert the following lines before `exit 0` at the bottom of the file:
  
  ```
  echo "Starting Weather Station daemon..."
  /home/pi/weather-station/interrupt_daemon.py start
  ```

## Creating a MySQL Database to store weathe data
1. Create the database within MySQL.

  `mysql -u root -p`
  
  Enter the password that you chose during installation.
  
  You'll now be at the MySQL prompt `mysql>`, first create the database:
  
  `CREATE DATABASE weather;`
  
  Expected result: `Query OK, 1 row affected (0.00 sec)`
  
  Switch to that database:
  
  `USE weather;`
  
  Expected result: `Database changed`
  
  Create the table that will store all of the weather measurements:
  
  ```
  CREATE TABLE WEATHER_MEASUREMENT(
    ID BIGINT NOT NULL AUTO_INCREMENT,
    REMOTE_ID BIGINT,
    AMBIENT_TEMPERATURE DECIMAL(6,2) NOT NULL,
    GROUND_TEMPERATURE DECIMAL(6,2) NOT NULL,
    AIR_QUALITY DECIMAL(6,2) NOT NULL,
    AIR_PRESSURE DECIMAL(6,2) NOT NULL,
    HUMIDITY DECIMAL(6,2) NOT NULL,
    WIND_DIRECTION DECIMAL(6,2) NULL,
    WIND_SPEED DECIMAL(6,2) NOT NULL,
    WIND_GUST_SPEED DECIMAL(6,2) NOT NULL,
    RAINFALL DECIMAL (6,2) NOT NULL,
    CREATED TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY ( ID )
  );
  ```
  
  Expected result: `Query OK, 0 rows affected (0.05 sec)`
  
  Press `Ctrl - D` or type `exit` to quit MySQL.



1. Update the to the local MySQL credentials file with the password for the MySQL *root* user that you chose during installation.

  `nano credentials.mysql`
  
  The PASSWORD field is probably the only one you need to change - set it to the password you chose during the MySQL install. The double quotes `"` enclosing the values are important so take care not to remove them by mistake.
  
  Press `Ctrl - O` then `Enter` to save and `Ctrl - X` to quit nano.

1. The code that collects the sensor data is `log_all_sensors.py`. This can be run manually, but we are going to automate it using the [cron](http://en.wikipedia.org/wiki/Cron) scheduler.

  The template crontab file `crontab.save` is provided as a default.


1. To enable your Weather Station to start taking measurements, also known as *data logging mode*, use the command:

  `crontab < ~/weather-station/crontab.save`
  
  Your weather station is now live and recording data at timed intervals.
  
  You can disable data logging mode at any time by removing the crontab with the command below:
  
  `crontab -r`


  
  1. Heads up! At this point you may wish to stop and check out the Weather Station scheme of work ([here](https://github.com/raspberrypilearning/weather-station-sow)).
  
  *Note: Do not have data logging mode enabled while you're working through the data Collection lessons in the scheme of work.*
  
1. You can manually cause a measurement to be taken at any time with the following command:

  `sudo ~/weather-station/log_all_sensors.py`
  
  Don't worry if you see `Warning: Data truncated for column X at row 1`, this is expected.

1. You can manually trigger an upload too with the following command:

  `sudo ~/weather-station/upload_to_oracle.py`
  
1. You can also view the data in the database using the following commands:

  `mysql -u root -p`
  
  Enter the password. Then switch to the `weather` database:
  
  `USE weather;`
  
  Run a select query to return the contents of the `WEATHER_MEASUREMENT` table.
  
  `SELECT * FROM WEATHER_MEASUREMENT;`
  
  After a lot of measurements have been recorded it will be sensible to use the SQL *where* clause to only select records that were created after a specific date and time:
  
  `SELECT * FROM WEATHER_MEASUREMENT WHERE CREATED > '2014-01-01 12:00:00';`
  
  Press `Ctrl - D` or type `exit` to quit MySQL.

1. Go [here](https://github.com/raspberrypi/weather-station-www) to download and install the demo website.

## Optional - Connect to the Oracle Global Database

1. If you wish you can register your Weather Station with a cloud based **Oracle** database so that your data can be used by other schools.

  [Oracle Apex Database](https://apex.oracle.com/pls/apex/f?p=84942:LOGIN_DESKTOP:9427101834476:&tz=0:00)
  
  You will need to complete a form whereupon you must wait for a Raspberry Pi admin to approve your school in the database. Once approved an activation email will be sent to you containing a verification code. Log in using your **school name** for the username and the password that you chose. You will then be prompted for the verification code from the email.
  
  Many weather stations can belong to one school. Once you have logged in you'll need to create a new weather station under your school. The *latitude* and *longitude* of the weather station will be required for this. Once you have created a weather station it will have its own password automatically generated, this is used by the weather station itself when it uploads the measurements to Oracle and is separate to your school login.
  
  *Note:* There is a known bug here where the *Add Weather Station* screen does not show a `Create` button, but only a `Return` button on the right. If you experience this just log out and back in and that should fix it.
  
1. Add the weather station name and password to the local Oracle credentials file. This allows the code that uploads to Oracle to know what credentials to use.

  `cd ~/weather-station`
  
  `nano credentials.oracle.template`
  
  Replace the `name` and `key` parameters with the `Weather Station Name` and `Passcode` of the weather station as specified in Oracle (under *Home > Weather Stations*). The double quotes `"` enclosing these values in this file are important so take care not to remove them by mistake.
  
  Press `Ctrl - O` then `Enter` to save and `Ctrl - X` to quit nano.
  
1. Rename the Oracle credentials template file to enable it.

  `mv credentials.oracle.template credentials.oracle`
