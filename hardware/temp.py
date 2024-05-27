#!/usr/bin/env python
import time
import sys
import statistics
import board
import busio as io
import adafruit_mlx90614
from time import sleep
import RPi.GPIO as GPIO
buzzer = 22
GPIO.setmode(GPIO.BCM)
GPIO.setup(buzzer, GPIO.OUT)
GPIO.output(buzzer, False)
i2c = io.I2C(board.SCL, board.SDA, frequency=100000)
mlx = adafruit_mlx90614.MLX90614(i2c)

data = []
GPIO.output(buzzer, True)
time.sleep(.2)
GPIO.output(buzzer, False)
while len(data) < 40:
	targetTemp = mlx.object_temperature
	print(targetTemp)
	data.append(round(targetTemp,1))
	time.sleep(.1)
temp = statistics.mode(data) + 1
temp_str = str(temp)
file = open("/var/www/html/pupclinic/hardware/data.txt", "w")
file.write(temp_str)
file.close()
print(temp_str)
time.sleep(.2)
GPIO.output(buzzer, True)
time.sleep(.2)
GPIO.output(buzzer, False)
time.sleep(.2)
GPIO.output(buzzer, True)
time.sleep(.2)
GPIO.output(buzzer, False)
time.sleep(.2)
GPIO.output(buzzer, True)
time.sleep(.2)
GPIO.output(buzzer, False)
GPIO.cleanup()
sys.exit()
