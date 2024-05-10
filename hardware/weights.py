from hx711 import HX711
import time

def cleanAndExit():
    print("Cleaning...")
    GPIO.cleanup()
    print("Bye!")
    sys.exit()

hx = HX711(21, 20)
hx.set_reading_format("MSB", "MSB")
hx.set_reference_unit(1)  # Set this to a calibrated value

hx.reset()
hx.tare()

val = hx.get_weight(5)
print(f"Weight: {val} grams")
hx.power_down()
hx.power_up()
time.sleep(0.1)

cleanAndExit()

