#!/usr/bin/env python
import max30102
import hrcalc
import time
import statistics
import sys
from time import sleep
import RPi.GPIO as GPIO

m = max30102.MAX30102()

hr2 = 0
sp2 = 0
buzzer = 15
oxygen = []
heart_rate = []

GPIO.setup(buzzer, GPIO.OUT)
GPIO.output(buzzer, False)

GPIO.output(buzzer, True)
time.sleep(.2)
GPIO.output(buzzer, False)
while len(oxygen) < 25:
	red, ir = m.read_sequential()
	hr,hrb,sp,spb = hrcalc.calc_hr_and_spo2(ir, red)
	oxygen.append(round(sp))
	heart_rate.append(round(hr))
	print(oxygen)
	print(heart_rate)
	time.sleep(.1)
filtered_oxygen = [num for num in oxygen if num > 0]
filtered_heart_rate = [num for num in heart_rate if num > 0]
if len(filtered_oxygen) != 0:
	oxygen_str = str(statistics.mode(filtered_oxygen))
else:
	oxygen_str = "0"
if len(filtered_heart_rate) != 0:
	heart_rate_str = str(statistics.mode(filtered_heart_rate))
else:
	heart_rate_str = "0"
data = heart_rate_str + " " + oxygen_str
file = open("/var/www/html/pupclinic/hardware/data.txt", "w")
file.write(data)
file.close()
print(data)
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
