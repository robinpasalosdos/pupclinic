#!/usr/bin/env python3
import board
import busio as io
import adafruit_mlx90614

from time import sleep

i2c = io.I2C(board.SCL, board.SDA, frequency=100000)
mlx = adafruit_mlx90614.MLX90614(i2c)

targetTemp = "{:.2f}".format(mlx.object_temperature)

sleep(2)

file = open("/var/www/html/pupclinic/hardware/data.txt", "w")
file.write(targetTemp)
file.close()
print(targetTemp)
