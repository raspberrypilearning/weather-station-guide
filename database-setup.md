#Database setup

You can setup your Weather Station to automatically log all the collected data in a MySQL database, and optionally upload that data to a Central Global Datatbes.

## Install the necessary software packages.

  ```
  sudo apt-get update
  sudo apt-get install apache2 mysql-server python-mysqldb php5 libapache2-mod-php5 php5-mysql -y
  ```
  
This will take some time. You will be prompted to create and confirm a password for the root user of the MySQL database server.

## Setup a local database

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

## Setup the weather station station software

1. Unless you have already done so when setting up the RTC - download the data logging code.

  ```
  cd ~
  git clone https://github.com/raspberrypi/weather-station.git
  ```
  
  This will create a new folder in the home directory called `weather-station`.

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

1. Set the Weather Station daemon to automatically start at boot time.

  `sudo nano /etc/rc.local`
  
  Insert the following lines before `exit 0` at the bottom of the file:
  
  ```
  echo "Starting Weather Station daemon..."
  /home/pi/weather-station/interrupt_daemon.py start
  ```
  


1. Update the to the local MySQL credentials file with the password for the MySQL *root* user that you chose during installation.

  `nano credentials.mysql`
  
  The PASSWORD field is probably the only one you need to change (unless you also chose `raspberry`). The double quotes `"` enclosing the values are important so take care not to remove them by mistake.
  
  Press `Ctrl - O` then `Enter` to save and `Ctrl - X` to quit nano.

1. The main entry points for the code are `log_all_sensors.py` and `upload_to_oracle.py`. These will be called by the [cron](http://en.wikipedia.org/wiki/Cron) scheduler to automatically take measurements. The measurements will be saved in the local MySQL database as well as uploaded to the Oracle Apex Database online (if you registered).

  The template crontab file `crontab.save` is provided as a default. If you wish to change the measurement or upload frequency then edit this file before going onto the next step:
  
  `nano crontab.save`
  
  Press `Ctrl - O` then `Enter` to save and `Ctrl - X` to quit nano when you're done.

1. Heads up! At this point you may wish to stop and check out the Weather Station scheme of work ([here](https://github.com/raspberrypilearning/weather-station-sow)).
1. Enable cron to automatically start taking measurements, also known as *data logging mode*. 

  `crontab < crontab.save`

  Your weather station is now live and recording data at timed intervals.
  
  You can disable data logging mode at any time by removing the crontab with the command below:
  
  `crontab -r`
  
  To enable data logging mode again use the command below:
  
  `crontab < ~/weather-station/crontab.save`
  
  *Note: Do not have data logging mode enabled while you're working through the lessons in the scheme of work.*
  
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

## Next Steps:
- [Publish data with Oracle](oracle.md)
- [Install Data Logging Site](demo_site.md)
- [Schemes of work]()


