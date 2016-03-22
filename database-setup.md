#Database setup

This guide will show you how to set up your Weather Station to automatically log the collected weather data. The data is stored on the Pi's SD card using a database system called MySQL. Once your station is successfully logging data locally you will also be able to [upload that data](oracle.md) to a central Oracle Apex database to share it with others. 

**Note:** If you used our weather station disk image, skip to the section **View the data in the database**

 
## Install the necessary software packages

At the command line type the following:

  ```
  sudo apt-get update
  sudo apt-get install apache2 mysql-server python-mysqldb php5 libapache2-mod-php5 php5-mysql -y
  ```
  
> **Pro tip**: If you make a mistake, use the cursor UP arrow to go back to previous lines for editing.

**This will take some time**. You will be prompted to create and confirm a password for the root user of the MySQL database server. Don't forget it, you'll need it later.

## Set up a local database

###Create the database within MySQL

  `mysql -u root -p`
  
  Enter the password that you chose during installation.
  
  You'll now be at the MySQL prompt `mysql>`, first create the database:
  
  `CREATE DATABASE weather;`
  
  Expected result: `Query OK, 1 row affected (0.00 sec)`
  
  Switch to that database:
  
  `USE weather;`
  
  Expected result: `Database changed`

>**Pro tip**: If MySQL doesn't do anything when it should you've probably forgotten the final `;`. Just type it in when prompted and press `Enter`
  
###Create the table that will store the weather data

Tips:

- Don't forget the commas at the end of row
- Use the cursor UP arrow to copy and edit a previous line as many are similar
- Type the code carefully and *exactly* as written. Otherwise things will break later.
- Use CAPSLOCK!
  
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

## Setup the weather station software

### 1. Download the data logging code [Skip this step if you have set up the [Real Time Clock](software-setup.md)]

  ```
  cd ~
  git clone https://github.com/raspberrypi/weather-station.git
  ```
  
  This will create a new folder in the home directory called `weather-station`.

### 2. Start the Weather Station daemon and test it

> **Note:** A daemon is process that runs in the background.

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

### 3. Set the Weather Station daemon to automatically start at boot

`sudo nano /etc/rc.local`
  
Insert the following lines before `exit 0` at the bottom of the file:
  
    
    echo "Starting Weather Station daemon..."
    
    /home/pi/weather-station/interrupt_daemon.py start
    
Press `Ctrl - O` then `Enter` to save and `Ctrl - X` to quit nano.
    

### 4. Update the MySQL credentials file with the password for the MySQL *root* user that you chose during installation
If you are *not* in the `weather-station` folder:

`cd ~/weather-station`

then: 

  `nano credentials.mysql`
  
  Change the password field to the password you chose during installation of MySQL. The double quotes `"` enclosing the values are important so take care not to remove them by mistake.
  
  Press `Ctrl - O` then `Enter` to save and `Ctrl - X` to quit nano.

### 5. Automate updating of the database

The main entry points for the code are `log_all_sensors.py` and `upload_to_oracle.py`. These will be called by a scheduling tool called [cron](http://en.wikipedia.org/wiki/Cron) to automatically take measurements. The measurements will be saved in the local MySQL database as well as uploaded to the Oracle Apex Database online ([if you registered](oracle.md)).

1. Enable cron to automatically start taking measurements, also known as *data logging mode*. 

  `crontab < crontab.save`

  Your weather station is now live and recording data at timed intervals.
  
  You can disable data logging mode at any time by removing the crontab with the command below:
  
  `crontab -r`
  
  To enable data logging mode again use the command below:
  
  `crontab < ~/weather-station/crontab.save`
  
  >**Note**: Do not have data logging mode enabled while you're working through the lessons in the [scheme of work](https://github.com/raspberrypilearning/weather-station-sow).*
  

###Manually trigger a measurement
You can manually cause a measurement to be taken at any time with the following command:

  `sudo ~/weather-station/log_all_sensors.py`
  
  Don't worry if you see `Warning: Data truncated for column X at row 1`, this is expected.

  
### View the data in the database 

  `mysql -u root -p`
  
  Enter the password (default for the disk image installation is 'tiger'). Then switch to the `weather` database:
  
  `USE weather;`
  
  Run a select query to return the contents of the `WEATHER_MEASUREMENT` table.
  
  `SELECT * FROM WEATHER_MEASUREMENT;`

![](images/database.png)
  
  After a lot of measurements have been recorded it will be sensible to use the SQL *where* clause to only select records that were created after a specific date and time:
  
  `SELECT * FROM WEATHER_MEASUREMENT WHERE CREATED > '2014-01-01 12:00:00';`
  
  Press `Ctrl - D` or type `exit` to quit MySQL.


## Next Steps
- [Publish data to the Oracle Apex database](oracle.md)
- [Visualise your data on a website](demo_site.md)
- [Schemes of work](https://github.com/raspberrypilearning/weather-station-sow)


