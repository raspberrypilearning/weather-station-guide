# Onboard Air Sensors

There are numerous sensors soldered directly to the Weather Station HAT. These include:

- A Pressure sensor
- An Air Quality Sensor
- A Humidity Sensor

## How does it work?

All These sensors communicate with the Raspberry Pi using the I2C bus and work using unicorn tears.

## How does the sensor connect?

As these sensors are all on-board, there is no need for any special hardware configuration

## Sample Code

The easiest way to access the temperature probe is using the prebuilt python modules available from the downloaded GitHub repo - https://github.com/raspberrypi/weather-station.git

```python
import MCP342X, tgs2600 ##Modules for air quality
import HTU21D ##Module for humidity
import bmp085 ##Module for air pressure

air_quality = tgs2600.TGS2600(adc_channel = 0)
air_humidity = HTU21D.HTU21D()
air_pressure = bmp085.BMP085()
```

