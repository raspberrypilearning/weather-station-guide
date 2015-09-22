# Air Temperature Probe

The Temperature sensor is integrated into the 

![Temperature probe](images/temperature.jpg)

## How does it work?



## How does the sensor connect?

To connect the temperature sensor, you will fist have to have set up the main weather station box and the air sensor board.

1. Locate the socket on the air sensor board labeled Temperature Probe

2. The Temperature probe can be directly connected into this socket.

*When connected the temperature rcorded by the probe is written to a file in /sys*

## Sample Code

The easiest way to access the temperature probe is using the prebuilt python module `ds18b29_therm.py` available from the downloaded GitHub repo - https://github.com/raspberrypi/weather-station.git

```python
import ds18b20_therm

temp_probe = des18b20_therm.DS18B20()
print(temp_probe)
```

The current temperature is recorded in a text file at /sys/bus/w1/devices/28*/w1_slave
If we the current temperature, we can first check the contents of this file.

Open up `lxterminal` and then try the following command:

```bash
cat /sys/bus/w1/devices/28*/w1_slave
```

The output should look something like this:
```
61 01 4b 46 7f ff 0f 10 02 : crc=02 YES
61 01 4b 46 7f ff 0f 10 02 t=22062
```

The first line reports whether the data is valid or not - so a `YES` means we have valid data.
The second line reports the recorded temperature. In this case we have a recorded value of 22062.

This temperature might seem pretty high - but it's recorded in millicelsius (1000th of a degree). To conert this to celcius you'll need to divide it by 1000.

Here is some sample code to show you one way of accessing the temperature.

```python
##The name of the directory might be different on different devices. Check the name by using:
##ls /sys/bus/w1/devices
directory = "28-00000717878a"
##Open the file and store the first line
with open("/sys/bus/w1/devices/"+directory+"/w1_slave") as file:
    lines = file.readlines()
    temp = lines[1]
	#find where the temperature is recorded in the line and store the position
    position = temp.find("t=") + 2
	#Extract the numerical value and convert to a float
    temperature = float(temp[position:].rstrip())
	print(float(temperature)/1000)
```
	
