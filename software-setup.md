Software Setup
==============

Setting up the I2C
------------------------------

1.  Start with a fresh install of the latest version of [Raspbian](LINK
TO BE ADDED).
1.  When booting for the first time, you will be presented with the
    raspi-config menu.
1.  The Weather Station requires the
    [I²C](<https://en.wikipedia.org/wiki/I%C2%B2C>) communication
    protocol to be enabled on your Raspberry Pi. To do this:

1. Select `Advanced Options` and press `Enter`
1. Select `I2C` and press `Enter`
```
Would you like the ARM I2C interface to be enabled?
```
1. Select  `Yes` and press `Enter`
```
The ARM I2C interface is enabled
```
1.  Select `Ok` and press `Enter`
```
Would you like the I2C kernel module to be loaded by default?
```
1. Select `Yes` and press `Enter`
```
I2C kernel module will now be loaded by default
```
1. Select `Ok` and press `Enter`
1. Select `Finish` from the main menu and press `Enter`
```
Would you like to reboot now?
```
1. Select `Yes` and press `Enter`


Setting up the Real Time Clock
--------------------------------
1. First you'll need the Weather Station repository.

``` {.bash}
cd ~ && git clone https://github.com/raspberrypi/weather-station
```

1. In the repo you'll find an install script to set up the Real Time Clock. You can run this file, or alternatively follow the instructions below. If you choose to run the install script then once complete you can skip down to [Setting up the Database](to be added)

```bash
./weather-station/install.sh
```

1.  First you want to make sure you have all the latest updates for your
    Raspberry Pi.

``` {.bash}
sudo apt-get update && sudo apt-get upgrade
```

1.  You now need make some changes to a config file to allow the
    Raspberry Pi to use the real-time clock.

``` {.bash}
sudo nano /boot/config.txt
```

Add the following lines to the bottom of the file:

``` {.bash}
dtoverlay=w1-gpio
dtoverlay=pcf8523-rtc
```

Press \`Ctrl - O\` then \`Enter\` to save and \`Ctrl - X\` to quit nano.

Now set the required modules to load automatically on boot.

``` {.bash}
sudo nano /etc/modules
```

Add the following lines to the bottom of the file:

``` {.bash}
i2c-dev
w1-therm
```

Press \`Ctrl - O\` then \`Enter\` to save and \`Ctrl - X\` to quit nano.

1.  For the next steps we need the Weather Station hat to be connected
    to the Raspberry Pi.

``` {.bash}
sudo halt
```

1.  Reboot for the changes to take effect.

``` {.bash}
sudo reboot
```

1.  Check that the Real Time Clock (RTC) appears in \`/dev\`

``` {.bash}
ls /dev/rtc*
```

Expected result: `/dev/rtc0`

1.  Initialise the RTC with the correct time.

Use the \`date\` command to check the current system time is correct. If
correct then you can set the RTC time from the system clock with the
following command:

``` {.bash}
sudo hwclock -w
```

If not then you can set the RTC time manually using the command below
(you'll need to change the \`--date\` parameter, this example will set
the date to the 1st of January 2014 at midnight):

``` {.bash}
sudo hwclock --set --date="yyyy-mm-dd hh:mm:ss" --utc
```

for example:

``` {.bash}
sudo hwclock --set --date="2015-08-24 18:32:00" --utc
```

Then set the system clock from the RTC time.

``` {.bash}
sudo hwclock -s
```

1.  Enable setting the system clock automatically at boot time. First
    edit the hwclock udev rule:

``` {.bash}
sudo nano /lib/udev/hwclock-set
```

Find the lines at the bottom that read:

``` {.bash}
if [ yes = "$BADYEAR" ] ; then
    /sbin/hwclock --rtc=$dev --systz --badyear
else
    /sbin/hwclock --rtc=$dev --systz
fi
```

Change the \`--systz\` options to \`--hctosys\` so that they read:

``` {.bash}
if [ yes = "$BADYEAR" ] ; then
    /sbin/hwclock --rtc=$dev --hctosys --badyear
else
    /sbin/hwclock --rtc=$dev --hctosys
fi
```

Press `Ctrl - O` then `Enter` to save and `Ctrl - X` to quit nano.

1.  Remove the fake hardware clock package.

``` {.bash}
sudo update-rc.d fake-hwclock remove
sudo apt-get remove fake-hwclock -y
```

Testing the sensors
-------------------

1.  Install the necessary software packages.

``` {.bash}
sudo apt-get install i2c-tools python-smbus telnet -y
```

1.  Power up your Raspberry Pi and login.

2.  Test that the I²C devices are online and working.

``` {.bash}
sudo i2cdetect -y 1
```

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

