# Publishing weather data with Oracle

One of the big ideas with the weather station is to allow users to upload their data to a shared Oracle database. Schools data can then compare their data with other schools and carry out comparisons, test hypotheses and get a bigger picture of global weather. It's also the easiest way to visualise your data using graphing tools and to download it in various formats and reports.

## Register for an Oracle Apex database account
### Register

Go [here to register](https://apex.oracle.com/pls/apex/f?p=84942:LOGIN_DESKTOP:9427101834476:&tz=0:00)
  
![](images/login.png)

**Do not fill in any details.** Just click on the "Register" button. On the next screen fill in your details. Contactable means you are happy to be contacted by other schools as part of the project.

![](images/details.png)

Hit "Register" top right. You will see:

![](images/confirm.png)

  
Registrations are validated manually and may take up to 24 hours depending on your time zone. If you have been waiting more than 24 hours please first check your junk mail folder and then contact weather@raspberrypi.org.

The activation email will contain a password and a verification code. 

###Log in

Log in using your **school name** (as entered in the registration form) for the Username and the password from the email. 

![](images/school-login.png)

You will be prompted for the verification code from the email when logging in for the first time.

![](images/activation.PNG)


###Edit your school details
You should change your password to something more memorable. Click on your school name and then "Edit" to change your details.

![](images/edit-school.png)


##Add your weather station
  
Weather stations tab --> Add Weather Station

![](images/addws.png)


The *latitude* and *longitude* of the weather station will be required for this. There are lots of websites such as [www.latlong.net](www.latlong.net) that will do this. Once you have created a weather station it will be given a password. You will need this in the next step to connect to the Oracle database. 

![](images/ws-passcode.png)
  
  
## Update credential files with your weather station details
Add the weather station name and password to the local Oracle credentials file. This allows the code that uploads to Oracle to add it to the correct weather station.

  `cd ~/weather-station`
  
  `nano credentials.oracle.template`
  
  Replace the `name` and `key` parameters with the `Weather Station Name` and `Passcode` of the weather station above. The double quotes `"` enclosing these values in this file are important so take care not to remove them by mistake. The weather station name must match exactly and is case sensitive.
  
  Press `Ctrl - O` then `Enter` to save and `Ctrl - X` to quit nano.
  
Rename the Oracle credentials template file to enable it.

  `mv credentials.oracle.template credentials.oracle`
  
## Checking that data is received

Manually trigger an upload with the following command:

  `sudo ~/weather-station/upload_to_oracle.py`

Login to your Oracle Apex account as above and go to 'Weather measurements' You should see the station readings. 

![](images/weather-readings.png)


You can download your data in various formats and also make charts using the menu:

![](images/wsmenu.png)



