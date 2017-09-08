# introduction

The Weather Station software has two main elements. The first is the collection of drivers and scripts that are needed to communicate with the various weather sensors. The second is the local MariaDB database that is used to store all the data produced by the sensors. This is regularly uploaded to our online Oracle database so that it can be analysed and compared with all the other Weather Stations from around the world.

# Weather Station software setup

There are a few steps involved in setting up the software for the Weather Station.  Before beginning this section, please ensure that you have [registered your School and Weather Station on the Oracle database](register.md).

The entire software installation process can take a while, especially if you have a slow Internet connection. If you're planning to carry out the installation as part of a lesson or club, you should make sure you have downloaded the Raspbian operating system (Step 1) and burned the SD card **before** the session.

## Getting the latest Raspberry Pi OS
1. The SD card that comes with the Weather Station kit contains a version of Raspbian, the Raspberry Pi operating system which is now extremely out-of-date and should not be used.

1. Follow the [guide on the Raspberry Pi website](https://www.raspberrypi.org/learning/software-guide/) which tells you how to install the latest version of Raspbian. You can use the full Desktop version or the slimmer 'Lite' one. The latter is a smaller download as it does *not* include LibreOffice, Wolfram and many other packages which are not required for operation of the Weather Station. However it is command-line only and therefore all configuration is performed through this interface.  

## Setting up the Weather Station software.

1. The simplest way to set up the software up is to use our one-line install script. If you wish to proceed manually through the steps, then you can follow [this guide](manual-setup.md), but this is only recommended if you're confident using the command line interface, enjoy unnecessary typing, or want to make custom adjustments to your setup.

1. When Raspbian boots up, press **Ctrl** and **Alt** and the character **t** on your keyboard. This will open up a Terminal window. [Desktop Raspbian only]

1. Type

    ```bash
    sudo raspi-config
    ```

    ![](images/ssh_01.png)

1. Now enable [Secure Shell access](https://www.raspberrypi.org/blog/ssh-shenanigans/) from the "Interfacing Options" menu. This will allow you to remotely login to your Pi via the network. In this way you can work on your Pi Weather Station without having a monitor, keyboard and mouse attached.


    ![](images/ssh_02.png)


1. Now run the one-line installer.  Type (or copy and paste) the following line into the terminal window.

	```bash
	curl -L http://rpf.io/wsinstall | bash
	```

1. You can now proceed through the installation process. When prompted, press **y** to continue.

    ![](images/install_01.png)

1. The first part of the installation is to update any packages that may have been upgraded by their developers since the Raspbian image was built. Note that sometimes during the `update` and `upgrade` process you maybe prompted as to whether you would like certain pieces of software to be installed or certain settings to be changed.
It is normally fine to accept the default answer, but always read the request carefully.

1. The Real Time Clock (RTC) is configured next. When prompted, type **y** if the time displayed is correct.

    ![](images/install_02.png)

1. If the time is incorrect, type **n** and then enter the correct time in the format `yyyy-mm-dd hh:mm:ss`.

    ![](images/install_03.png)

1.  Next you will need to choose a database password. It can be anything you like, as it is the password for the local MariaDB database on your Raspberry Pi. Write the password down somewhere so you do not forget it.

    ![](images/install_04.png)

1. The MariaDB packages will now be installed. This will provide the local database on your Pi for storing your weather data.

1. Next you need to type in the Weather Station name and password/key that you obtained when you [registered] (https://www.raspberrypi.org/learning/weather-station-guide/register.md) your Weather Station with the online Oracle database.

    ![](images/install_05.png)

1. That's it. Once the install has finished, your Raspberry Pi should reboot. You can now proceed to setting up the rest of the hardware if you have not already sone so.

## What next?

You can now proceed to finishing the hardware setup with our [hardware guide](build2.md), or move on to testing the sensors with our [testing guide](test.md) if you've already finished the assembly.
