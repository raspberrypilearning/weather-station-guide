# Weather Station software setup

There are a few steps involved in setting up the software for the Weather Station. Before beginning this section, please ensure that you have [registered your School and Weather Station on the Oracle database](register.md).

## Getting the latest Raspberry Pi OS
1. The SD card that comes with the Weather Station kit contains a now-out-of-date version of Raspbian, the Raspberry Pi operating system.
1. Follow the [guide on the Raspberry Pi website](https://www.raspberrypi.org/learning/software-guide/) which tells you how to install the latest version of Raspbian.

## Setting up the sensing and database software.

1. The simplest way to set the software up is to use a simple install script. If you wish to proceed manually through the steps, then you can follow [this guide](manual-setup.md), but this is only recommended if you have a firm understanding of command line interface, enjoy unnecessary labour, or want to make custom adjustments to your setup.

1. When Raspbian boots up, press **Ctrl** and **Alt** and the character **t** on your keyboard. This will open up a terminal prompt.

1. Type

    ```bash
    sudo raspi-config
    ```

1. Now enable [Secure Shell access](https://www.raspberrypi.org/blog/ssh-shenanigans/) from the "Interfacing Options" menu. This will allow you to remotely login to your Pi via the network. In this way you can work on your Pi Weather Station without having a monitor, keyboard and mouse attached.


1. Once Raspbian has been updated, it's time to install the Weather Station software. Type (or copy and paste) the following line into the terminal window.

	```bash
	curl -L http://rpf.io/wsinstall | bash
	```

1. You can now proceed through the installation process. When prompted, press **y** to continue.

    ![](images/install_01.png)

The first part of the installation is to update any packages that may have been upgraded by their developers since the Raspbian image was built. Note that sometimes during the `update` and `upgrade` process you maybe prompted as to whether you would like certain pieces of software to be installed or certain settings to be changed.

1. When prompted, type **y** if the time displayed is correct.

    ![](images/install_02.png)

1. If the time is incorrect, type **n** and then enter the correct time in the format `yyyy-mm-dd hh:mm:ss`.

    ![](images/install_03.png)

1.  Next you will need to choose a database password. It can be anything you like, as it is the password for the local database on your Raspberry Pi. Write the password down somewhere so you do not forget it.

    ![](images/install_04.png)

1. The MariaDB packages will now be installed. This will provide a local database on your Pi for storing your weather data.

1. Next you need to type in the Weather Station name and password/key that you obtained when you registered your Weather Station.

    ![](images/install_05.png)

1. Once the install has finished, your Raspberry Pi should reboot. You can now proceed to setting up the rest of the hardware.

## What next?

You can now proceed to finishing the hardware setup with our [hardware guide](build2.md), or move on to testing the sensors with our [testing guide](test.md) if you've already finished the assembly.
