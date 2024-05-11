#!/usr/bin/env python
import serial
import time
import sys
import RPi.GPIO as GPIO
import statistics

c = 0
GPIO_TRIGGER = 23
GPIO_ECHO = 24
buzzer = 22
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
    
if __name__ == '__main__':
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(buzzer, GPIO.OUT)
    GPIO.output(buzzer, False)
    GPIO.setup(GPIO_TRIGGER, GPIO.OUT)
    GPIO.setup(GPIO_ECHO, GPIO.IN)
    ser = serial.Serial('/dev/ttyACM0', 9600)
    ser.flush()
    time.sleep(2)
    ser.write(b'w')
    weight_list = []
    height_list = []
	
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
                        weight_list.append(data)
                        dist = distance()
                        height_list.append(dist) 
                        print(line)
                        # Check if data_list has reached a length of 20
                        if len(weight_list) == 45:
                            print("Data list has reached 20 elements.")
                            break
                except ValueError:
                    print(f"Could not convert line to float: '{line}'")  # Handle conversion errors
            else:
                print("Received an empty line.")

    ser.close() 

    # Calculate the mean of the last 5 values in data_list, if available
    last_five_values = weight_list[-5:]
    if last_five_values:
        mean_last_five = sum(last_five_values) / len(last_five_values)
        print("Mean of last five values:", mean_last_five)
        weight_str = str(round(mean_last_five,2))
        height_str = str(200 - statistics.mode(height_list))
        print(height_str)
        final_data = height_str + " " + weight_str
        with open("/var/www/html/pupclinic/hardware/data.txt", "w") as file:
            file.write(final_data)
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
