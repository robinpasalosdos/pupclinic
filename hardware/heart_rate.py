import serial
import sys
import time
import RPi.GPIO as GPIO

buzzer = 22

if __name__ == '__main__':
    GPIO.setmode(GPIO.BCM)
    ser = serial.Serial('/dev/ttyACM0', 9600)
    ser.flush()
    time.sleep(2)
    ser.write(b'b')
    start_time = time.time()
    GPIO.setup(buzzer, GPIO.OUT)
    GPIO.output(buzzer, True)
    time.sleep(.2)
    GPIO.output(buzzer, False)
    while True:
        if ser.in_waiting > 0:
            
            line = ser.readline().decode('utf-8').rstrip()
            file = open("/var/www/html/pupclinic/hardware/data.txt", "w")
            file.write(line)
            file.close()
            print(line)
            if start_time > 5:
                break

	
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
    ser.close()
    sys.exit()
