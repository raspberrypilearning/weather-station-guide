# Anemometer

This is the anemometer sensor supplied with the Raspberry Pi weather station kit. It's used to measure wind speed.

![Anemometer](images/anemometer.png)

## How does it work?

The wind catches the three cups and drives them round, spinning the central section.

To help explain how the device works, you can dismantle it following these steps:

1. First, hold the base in one hand and pull on the blades/cups with the other hand. You don't need to use much force. 

1. Look at the underside of the blades/cups and you'll see a small metal cylinder on one side. This is a magnet, just like the one found on the bucket of the rain gauge. Test it with a paper clip if you like.

![Anemometer Magnet](images/anemometer_magnet.png)

1. Now use a screwdriver to remove the three screws on the bottom of the base. The base should then pop out easily. Slide it down the cable to get it out of the way. If you look inside you'll see our old friend the reed switch again.

![Anemometer Reed](images/anemometer_reed.png)

So what does this mean? When the blades/cups are in their original position and spinning, the magnet will rotate in a tight circle above the reed switch. So for every complete rotation, there will be two moments when the switch is closed.

If we can detect the number of rotations in a given time period, we can calculate the speed at which the arms are spinning. As some energy is lost in the pushing of the cups, an anemometer often under-reports the wind speed. To compensate for this, we will multiply our calculated speed by a factor of 1.18 (specific to this anemometer).

The following algorithm can be used to calculate wind speed:

> For each time period **t**  
> --- **count** = recorded anemometer signals 
> --- **rotations** = count / 2  
> --- **distance** = rotations * 2 * pi * radius (9cm)  
> --- **speed** = distance / t (**in cm/s**)  
> 
> To convert **speed** into **km/h**  
> --- speed = speed / 100000 (**km/s**)  
> --- speed = speed * 3600 (**km/h**)  
> 
> To compensate for anemometer factor  
> --- speed = speed * 1.18  

## How does the sensor connect?

To connect the anemometer to the weather station board, first you'll need to have set up the main [weather station box](hardware-setup.md).

1. Locate the socket on the weather station board marked **WIND** and the corresponding grommet.
1. The anemometer can be connected directly to the board, but ideally via the [wind vane](wind_vane.md).
1. Unscrew the grommet from the case and thread the wind vane plug through to the inside of the box.

  ![Connecting](images\Fix_Grommit.jpg)

1. Connect the plug to the socket, and tighten up the grommet.

When connected, the anemometer uses **GPIO pin 5** (BCM).

## Sample code

The following program uses a GPIO interrupt handler to detect input from the anemometer, and convert it into a meaningful measurement which is displayed on-screen.

```python

import RPi.GPIO as GPIO
import time, math

pin = 5
count = 0

def calculate_speed(r_cm, time_sec):
    global count
    circ_cm = (2 * math.pi) * r_cm
    rot = count / 2.0
    dist_km = (circ_cm * rot) / 100000.0 # convert to kilometres
    km_per_sec = dist_km / time_sec
    km_per_hour = km_per_sec * 3600 # convert to distance per hour
    return km_per_hour

def spin(channel):
    global count
    count += 1
    print (count)

GPIO.setmode(GPIO.BCM)
GPIO.setup(pin, GPIO.IN, GPIO.PUD_UP)
GPIO.add_event_detect(pin, GPIO.FALLING, callback=spin)

interval = 5

while True:
    count = 0
    time.sleep(interval)
    print (calculate_speed(9.0, interval), "kph")
```
