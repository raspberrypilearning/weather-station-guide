# Using the weather station disk image
The easiest way to get your Raspberry Pi Oracle Weather Station up and running is to use the pre-built disk image.

## Download and write the image to the SD card
1.	[Download the disk image](LINK)

2.	Follow the instructions for writing it to the SD card that came with the weather station (or any other SD card of 8Gb or bigger)
2.	Put the SD card into the Raspberry Pi in your weather station and power it up.

## A bit of housekeeping

The Pi will boot to a text prompt:

1. Login with `user` pi and password `raspberry`
2. Run the configuration tool: `sudo raspi-config`
3. Select 1 `Resize .... blah`
 
    ![pic]()

4. Select \<Finish\>

5. Select \<No\> when asked to reboot.

6. It's a good idea to change your password while you're here.


## Make the weather station run at boot and log data automatically

1. Go to the WeatherStation folder
    `cd WeatherStation` 
2. Setup the scheduled (cron) job
    `crontab WeatherStation.cron`  

## Check that the time is correct

1. Check date and time
    `date`
2. If the date is wrong fix it
    `blah`
   
3. Finally reboot
    `sudo reboot`

## Set up your weather station to upload to the Oracle Apex database
This is the one thing we couldn't put in the disk image--your weather station name and password from when you [registered with Oracle's Apex database](). You have to fill these in manually into the credentials file as follows:


1. Go to your home directory
    `cd ~\`

2. Edit the credentials file using the *nano* editor
    `nano credentials.json`

Change the lines: 
``` java
{
    mysql : { host : "localhost", user : "pi", pass: "raspberry", database : "weather" }
}
```

to:

``` java
{
    mysql : { host : "localhost", user : "pi", pass: "raspberry", database : "weather" },
    cloud : { url : "https://apex.oracle.com/pls/apex/raspberrypi/weatherstation/submitmeasurement",
              user: "MyStation", pass: "MyPass"}
}
```
Double check curly braces and commas are in the right place!


With **MyStation** and **MyPass** changed to your weather station name and passcode. Make sure you type them in exactly, they are case sensitive.


3. Save file with `CTRL-O`, press `Enter` then `CTRL-X` to quit 
 
It should be picked up and reconfigured automatically when you write the file back.

## Check that it's working

1. Log in to the database [password: tiger]
    `mysql -u root -p weather` 

2. SELECT CREATED, LEVEL, TEXT FROM LOG ORDER BY CREATED;
3. Expected result: 


????

4.	Go to [Database Set-up](database-setup.md)

