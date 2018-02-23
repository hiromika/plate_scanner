import RPi.GPIO as GPIO
import time
import subprocess
import requests
#import picamera

#camera = picamera.PiCamera()

#GPIO.cleanup() 
GPIO.setwarnings(False) # Ignore warning for now

img = "";
url = "http://192.168.137.1/plate_scanner/upload_img_pi.php?ig=1"
gate_url = "http://192.168.137.1/plate_scanner/check_gate.php?ig=1"
gate_act_url = "http://192.168.137.1/plate_scanner/change_status_gate.php?ig=1"


GPIO.setmode(GPIO.BCM)

GPIO.setup(18, GPIO.IN, pull_up_down=GPIO.PUD_UP)
GPIO.setup(23, GPIO.OUT)  #LED to GPIO24

while True:
	GPIO.output(23, False)
	input_state = GPIO.input(18)
 	#camera.start_preview()
	if input_state == False:

		try:
			img=subprocess.check_output("/home/pi/script/image_capture.sh",shell=False)
			img=img.decode("utf-8")
			time.sleep(1)
			if img :
				files = {'file': open('capture/'+img+".jpg", 'rb')}
				r = requests.post(url, files=files)
				time.sleep(1)
		except:
			print("Camera Not Ready")
	else:
		GPIO.output(23, False)
		r = requests.post(gate_url)
		data = r.json()
		if data['status'] == "1":
			GPIO.output(23, True)
			r = requests.post(gate_act_url)
			time.sleep(3)


