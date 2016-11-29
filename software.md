# Weather Station Software Setup

There are a few steps involved in setting up the software for the Weather Station. Before beginning this section, please ensure that you have [registered your School and Weather Station on the Oracle Database](https://apex.oracle.com/pls/apex/f?p=81290:5:0::NO:::&tz=1:00).

## Getting the latest Raspberry Pi OS
1. The SD card that comes with the Weather Station kit contains a now-out-of-date version of Raspbian, the Raspberry Pi operating system.
1. Follow the [guide on the Raspberry Pi website](https://www.raspberrypi.org/learning/software-guide/) which tells you how to install the latest version of Raspbian.

## Setting up the Sensing and Database software.
1. The simplest way to set the software up is to use a simple install script. If you wish to proceed manually through the steps, then you can follow [this guide](), but this is only recommended if you have a firm understanding of command line interface, enjoy unnecessary labour, or want to make custom adjustments to your setup.

1. When Raspbian boots up, press **Ctrl** and **Alt** and the character **t** on your keyboard. This will open up a terminal prompt.

1. It's always best to ensure the software you are running is the latest version. Ensure that your Raspberry Pi is connected to the internet and then type the following into the terminal window.

   ```bash
   sudo apt-get update && sudo apt-get upgrade -y
   ```
   
  **Note that sometimes during the `update` and `upgrade` process you maybe prompted as to whether you would like certain pieces of software to be installed or certain settings to be changed.**
  
1. Once Raspbian has been updated, it's time to install the Weather Station software. Type (or copy and paste) the following line into the terminal window.

	```bash
	bash <(wget -O- https://gist.githubusercontent.com/MarcScott/a843c4dd4dfa3934b3de7b1fc0beadf8/raw/e65fd1c178202cf4ad8d4361ed5dcc1eeb2bb8d5/weather_install.sh)
	```

1. You can now proceed through the installation process:
    - When prompted, press any key to continue.
	![](images/install_01.png)
    - When prompted, type **y** if the time displayed is correct.
	![](images/install_02.png)
	- If the time is incorrect type **n** and then enter the correct time in the format `yyyy-mm-dd hh:mm:ss`
	![](images/install_03.png)
	- Next you will need to choose a database password. It can be anything you like, as it is the password for the local database on your Raspberry Pi. Write the password down somewhere so you do not forget it.
	![](images/install_04.png)
	- Next you need to type in the Weather Station name and password/key that you learned when you registered your Weather Station.
	![](images/install_05.png)
	
1. Once the install has finished, your Raspberry Pi should reboot. You can now proceed to setting up the rest of the hardware.

## What Next?
You can now proceed to finishing the hardware setup with our [Hardware Guide](build2.md), or move on to testing the sensors with our [Testing Guide](test.md) if you've already finished the assembly.
