#!/usr/bin/env python
import RPi.GPIO as GPIO
import time
import sys
import statistics

# Set GPIO Pins
GPIO_TRIGGER = 23
GPIO_ECHO = 24
buzzer = 22
btn = 21
i = 0
GPIO.setmode(GPIO.BCM)
GPIO.setup(GPIO_TRIGGER, GPIO.OUT)
GPIO.setup(GPIO_ECHO, GPIO.IN)
GPIO.setup(buzzer, GPIO.OUT)
GPIO.setup(btn, GPIO.IN, pull_up_down=GPIO.PUD_UP)
GPIO.output(buzzer, False)
def distance():
    # Set Trigger to HIGH
    GPIO.output(GPIO_TRIGGER, True)

    # Set Trigger after 0.01ms to LOW
    time.sleep(0.00001)
    GPIO.output(GPIO_TRIGGER, False)

    StartTime = time.time()
    StopTime = time.time()

    # Save StartTime
    while GPIO.input(GPIO_ECHO) == 0:
        StartTime = time.time()

    # Save time of arrival
    while GPIO.input(GPIO_ECHO) == 1:
        StopTime = time.time()

    # Time difference between start and arrival
    TimeElapsed = StopTime - StartTime
    # Multiply with the sonic speed (34300 cm/s)
    # and divide by 2, because there and back
    distance = (TimeElapsed * 34300) / 2

    return round(distance)
data = []
while i == 0:
		if GPIO.input(btn) == GPIO.LOW:
			print("ok")
			i = 1

if i == 1:
	GPIO.output(buzzer, True)
	time.sleep(.2)
	GPIO.output(buzzer, False)
	while len(data) < 40:
		dist = distance()
		data.append(dist)
		time.sleep(.1)
	distance = statistics.mode(data)
	height = str(200 - distance)
	file = open("/var/www/html/pupclinic/hardware/data.txt", "w")
	file.write(height)
	file.close()
	print(height)
	time.sleep(2)
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
