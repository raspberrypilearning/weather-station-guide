# Using the weather station disk image
The easiest way to get your Raspberry Pi Oracle Weather Station up and running is to use our disk image.

###Download image


###Write image to SD card

[Download] from 

####Login

You will find your self at the command line.
follow the instructions to image to SD card 

Login:


 use sudo raspi-config to resize the file system. 

[pic]

Select <Finish>

Select <No> when asked to reboot.

also change password



cd WeatherStation 

set it up to run the weather station at boot.

crontab WeatherStation.cron  

It's also a good idea to check that the time is right and, if not, fix that.

Finally reboot and you're running.

To configure cloud services change the credentials.json file in the home directory from:
{
    mysql : { host : "localhost", user : "pi", pass: "raspberry", database : "weather" }
}
to:
{
    mysql : { host : "localhost", user : "pi", pass: "raspberry", database : "weather" },
    cloud : { url : "https://apex.oracle.com/pls/apex/raspberrypi/weatherstation/submitmeasurement",
              user: "MyStation", pass: "MyPass"}
}
With MyStation and MyPass changed to your cloud credentials. It should be picked up and reconfigured automatically when you write the file back.

To see what's happening log into the database with mysql -u root -p weather and password tiger and then issue the command:  select created, level, text from LOG order by created;


