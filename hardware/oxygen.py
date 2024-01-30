#!/usr/bin/env python
import serial
import time

if __name__ == '__main__':
    ser = serial.Serial('/dev/ttyACM0', 9600)
    ser.flush()
    time.sleep(2)
    ser.write(b'o')
    start_time = time.time()
    run_time = 12

    while time.time() - start_time < run_time:
        if ser.in_waiting > 0:
            line = ser.readline().decode('utf-8').rstrip()
            file = open("/var/www/html/pupclinic/hardware/data.txt", "w")
            file.write(line)
            file.close()
            print(line)
            

    ser.close()

