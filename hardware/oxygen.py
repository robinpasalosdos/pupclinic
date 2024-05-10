#!/usr/bin/env python
import max30102
import hrcalc
import time
import statistics
import sys
from time import sleep

m = max30102.MAX30102()

hr2 = 0
sp2 = 0

data = []
while len(data) < 40:
	red, ir = m.read_sequential()
	hr,hrb,sp,spb = hrcalc.calc_hr_and_spo2(ir, red)
	data.append(round(sp))
	print(data)
	time.sleep(.1)
filtered_data = [num for num in data if num > 0]
oxygen = str(statistics.mode(filtered_data))
file = open("/var/www/html/pupclinic/hardware/data.txt", "w")
file.write(oxygen)
file.close()
print(oxygen)
sys.exit()
