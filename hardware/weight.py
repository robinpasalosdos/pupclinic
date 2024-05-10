#!/usr/bin/env python
import serial
import time
import sys
import RPi.GPIO as GPIO

buzzer = 22
c = 0

if __name__ == '__main__':
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(buzzer, GPIO.OUT)
    GPIO.output(buzzer, False)
    ser = serial.Serial('/dev/ttyACM0', 9600)
    ser.flush()
    time.sleep(2)
    ser.write(b'w')
    data_list = []
	
    while True:
        if ser.in_waiting > 0:
            line = ser.readline().decode('utf-8').rstrip()
            if line:
                try:
                    data = float(line) 
                    if c == 0:
                        time.sleep(4)
                        GPIO.output(buzzer, True)
                        time.sleep(.2)
                        GPIO.output(buzzer, False)
                        c+=1
                    if data > 2:
                        data_list.append(data) 
                        print(line)
                        # Check if data_list has reached a length of 20
                        if len(data_list) == 45:
                            print("Data list has reached 20 elements.")
                            break
                except ValueError:
                    print(f"Could not convert line to float: '{line}'")  # Handle conversion errors
            else:
                print("Received an empty line.")

    ser.close() 

    # Calculate the mean of the last 5 values in data_list, if available
    last_five_values = data_list[-5:]
    if last_five_values:
        mean_last_five = sum(last_five_values) / len(last_five_values)
        print("Mean of last five values:", mean_last_five)
        with open("/var/www/html/pupclinic/hardware/data.txt", "w") as file:
            file.write(str(round(mean_last_five,2)))
    else:
        print("No values greater than 5 were recorded, or fewer than 5 values available.")
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
