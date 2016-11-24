# Weather Station Software Setup

There are a few steps involved in setting up the software for the Weather Station. Before commencing on this section, please ensure that you have [registered your School and Weather Station on the Oracle Database]()
.
## Getting the latest Raspberry Pi OS
1. The microSD card that comes with the Weather Station kit contains a, now, out-of-date version of Raspbian, the Raspberry Pi Operating System.
1. Follow the [guide on the Raspberry Pi website](https://www.raspberrypi.org/learning/software-guide/), on how to get the latest version of Raspbian onto your microSD card.

## Setting up the Sensing and Database software.
1. The simplest way to setup the software, is to use the a simple install script. If you wish to manually proceed through the steps, then you can follow [this guide](), but is only recommended if you have a firm understanding of command line interfaces, enjoy unnecessary labour or want to make custom adjustments to your setup.

1. When Raspbian boots up, press `Ctrl` and `Alt` and the character `t` on your keyboard. This will open up a terminal prompt.

1. It's always best to unsure the software bundled with Raspbian is up-to-date. Ensure that your Raspberry Pi is connected to the internet and then type the following into the Terminal.

   ```bash
   sudo apt-get update && sudo apt-get upgrade -y
   ```
   
  **Note that sometimes during the `update` and `upgrade` process you maybe prompted regarding whether you would like certain pieces of software installed or certain settings.**
  
1. Once Raspbian is up-to-date, it's time to install the Weather Station software. Type (or copy and paste) the following line into the terminal.

	```bash
	bash <(wget -O- https://gist.githubusercontent.com/MarcScott/a843c4dd4dfa3934b3de7b1fc0beadf8/raw/e65fd1c178202cf4ad8d4361ed5dcc1eeb2bb8d5/weather_install.sh)
	```

1. You can now proceed through the install process:
    - When prompted, press *any* key to continue.
	![](images/install_01.png)
    - When prompted type `y` if the time displayed is correct.
	![](images/install_02.png)
	- If the time is incorrect type `n` and then add in the correct time in the format `yyyy-mm-dd hh:mm:ss`
	![](images/install_03.png)
	- Next you will need to choose a database password. It can be anything you like, as it is the password for the local database on your Raspberry Pi. Write this down somewhere so you do not forget it.
	![](images/install_04.png)
	- Next you need to type in the Weather Station Name and Password/Key that you learned when you registered your Weather Station.
	![](images/install_05.png)
	
1. Once the install has finished, your Raspberry Pi should reboot. You can now proceed to setting up the rest of the hardware.

## What Next?
You can now proceed to finishing the hardware setup with our [Hardware Guide](build2.md) or testing the sensors with our [Testing Guide](test.md) if you've already finished the assembly.
