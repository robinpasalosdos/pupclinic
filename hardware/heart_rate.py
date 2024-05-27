import serial
import sys
import time
import RPi.GPIO as GPIO

# Define the GPIO pin for the buzzer
buzzer = 22

def buzz(pattern):
    """Activate the buzzer in a specified pattern."""
    for duration in pattern:
        GPIO.output(buzzer, True)
        time.sleep(duration)
        GPIO.output(buzzer, False)
        time.sleep(duration)

if __name__ == '__main__':
    try:
        # Setup GPIO
        GPIO.setmode(GPIO.BCM)
        GPIO.setup(buzzer, GPIO.OUT)
        
        # Setup serial communication
        ser = serial.Serial('/dev/ttyACM0', 9600)
        ser.flush()
        time.sleep(2)
        
        # Signal the start
        ser.write(b'b')
        buzz([0.2])  # Single short buzz
        
        start_time = time.time()
        
        while True:
            if ser.in_waiting > 0:
                line = ser.readline().decode('utf-8').rstrip()
                
                # Write the received line to a file
                with open("/var/www/html/pupclinic/hardware/data.txt", "w") as file:
                    file.write(line)
                
                print(line)
                
                # Check elapsed time
                elapsed_time = time.time() - start_time
                if elapsed_time > 5:
                    break

        # Signal the end with a specific buzzer pattern
        buzz([0.2, 0.2, 0.2])
        
    except Exception as e:
        print(f"An error occurred: {e}")
    
    finally:
        # Clean up GPIO and close serial
        GPIO.cleanup()
        ser.close()
        sys.exit()
