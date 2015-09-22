Automated Data Logging
======================

Setting up automated data logging.
----------------------------------

1.  Download the data logging code.

``` {.bash}
cd ~
git clone https://github.com/raspberrypi/weather-station.git
```

This will create a new folder in the home directory called
`weather-station`.

1.  Start the Weather Station daemon and test it.

``` {.bash}
sudo ~/weather-station/interrupt_daemon.py start`
```

Expected result: `PID: 2345` (your number will be different)

A continually running process is required to monitor the rain gauge and
the anemometer. These are reed switch sensors and the code uses
interrupt detection. These interrupts can occur at any time as opposed
to the timed measurements of the other sensors. You can use the
**telnet** program to test or monitor it.

``` {.bash}
telnet localhost 49501`
```

Expected result:

    Trying 127.0.0.1...
    Connected to localhost.
    Escape character is '^]'.
    OK

The following text commands can be used:

-   `RAIN`: displays rainfall in ml
-   `WIND`: displays average wind speed in kph
-   `GUST`: displays wind gust speed in kph
-   `RESET`: resets the rain gauge and anemometer interrupt counts to
    zero
-   `BYE`: quits

Use the `BYE` command to quit.

1.  First you need to install some extra software packages.

``` {.bash}
sudo apt-get update && sudo apt-get install apache2 mysql-server python-mysqldb php5 libapache2-mod-php5 php5-mysql -y
```

This will take some time. You will be prompted to create and confirm a
password for the root user of the MySQL database server.

1.  Set the Weather Station daemon to automatically start at boot time.

``` {.bash}
sudo nano /etc/rc.local
```

Insert the following lines before \`exit 0\` at the bottom of the file:

``` {.bash}
echo "Starting Weather Station daemon..." /home/pi/weather-station/interrupt_daemon.py start
```

Creating a MySQL Database to store weather data
-----------------------------------------------

1.  Create the database within MySQL.

``` {.bash}
mysql -u root -p
```

Enter the password that you chose during installation.

You'll now be at the MySQL prompt \`mysql\>\`, first create the
database:

``` {.sql}
CREATE DATABASE weather;
```

Expected result: `Query OK, 1 row affected (0.00 sec)`

Switch to that database:

``` {.sql}
USE weather;
```

Expected result: `Database changed`

Create the table that will store all of the weather measurements:

``` {.sql}
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

1.  Update the to the local MySQL credentials file with the password for
    the MySQL **root** user that you chose during installation.

``` {.bash}
nano credentials.mysql
```

The PASSWORD field is probably the only one you need to change - set it
to the password you chose during the MySQL install. The double quotes
\`"\` enclosing the values are important so take care not to remove them
by mistake.

Press `Ctrl - O` then `Enter` to save and `Ctrl - X` to quit nano.

1.  The code that collects the sensor data is \`log~allsensors~.py\`.
    This can be run manually, but we are going to automate it using the
    [cron](http://en.wikipedia.org/wiki/Cron) scheduler.

The template crontab file \`crontab.save\` is provided as a default.

1.  To enable your Weather Station to start taking measurements, also
    known as **data logging mode**, use the command:

``` {.bash}
crontab < ~/weather-station/crontab.save`
```

Your weather station is now live and recording data at timed intervals.

You can disable data logging mode at any time by removing the crontab
with the command below:

``` {.bash}
crontab -r`
```

1.  You can manually cause a measurement to be taken at any time with
    the following command:

``` {.bash}
sudo ~/weather-station/log_all_sensors.py
```

Don't worry if you see \`Warning: Data truncated for column X at row
1\`, this is expected.

1.  You can manually trigger an upload too with the following command:

``` {.bash}
sudo ~/weather-station/upload_to_oracle.py
```

1.  You can also view the data in the database using the following
    commands:

``` {.bash}
mysql -u root -p
```

Enter the password. Then switch to the \`weather\` database:

``` {.sql}
USE weather;
```

Run a select query to return the contents of the
\`WEATHER~MEASUREMENT~\` table.

``` {.sql}
SELECT * FROM WEATHER_MEASUREMENT;
```

After a lot of measurements have been recorded it will be sensible to
use the SQL **where** clause to only select records that were created
after a specific date and time:

``` {.sql}
SELECT * FROM WEATHER_MEASUREMENT WHERE CREATED > '2014-01-01 12:00:00';`
```

Press `Ctrl - D` or type `exit` to quit MySQL.

1.  Go [here](https://github.com/raspberrypi/weather-station-www) to
    download and install the demo website.

Optional - Connect to the Oracle Global Database
------------------------------------------------

1.  If you wish you can register your Weather Station with a cloud based
    **\*Oracle\*** database so that your data can be used by other
    schools.

[Oracle Apex
Database](https://apex.oracle.com/pls/apex/f?p=84942:LOGIN_DESKTOP:9427101834476:&tz=0:00)

You will need to complete a form whereupon you must wait for a Raspberry
Pi admin to approve your school in the database. Once approved an
activation email will be sent to you containing a verification code. Log
in using your **school name** for the username and the password that you
chose. You will then be prompted for the verification code from the
email.

Many weather stations can belong to one school. Once you have logged in
you'll need to create a new weather station under your school. The
**latitude** and **longitude** of the weather station will be required
for this. Once you have created a weather station it will have its own
password automatically generated, this is used by the weather station
itself when it uploads the measurements to Oracle and is separate to
your school login.

\*Note:\* There is a known bug here where the **Add Weather Station**
screen does not show a `Create` button, but only a `Return` button on
the right. If you experience this just log out and back in and that
should fix it.

1.  Add the weather station name and password to the local Oracle
    credentials file. This allows the code that uploads to Oracle to
    know what credentials to use.

``` {.bash}
cd ~/weather-station
nano credentials.oracle.template
```

Replace the `name` and `key` parameters with the `Weather Station Name`
and `Passcode` of the weather station as specified in Oracle (under
**Home \> Weather Stations**). The double quotes \`"\` enclosing these
values in this file are important so take care not to remove them by
mistake.

Press `Ctrl - O` then `Enter` to save and `Ctrl - X` to quit nano.

1.  Rename the Oracle credentials template file to enable it.

``` {.bash}
mv credentials.oracle.template credentials.oracle
```
