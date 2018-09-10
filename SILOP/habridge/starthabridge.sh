cd /home/pi/alexa_bridge_interface/SILOP/habridge
rm /home/pi/alexa_bridge_interface/SILOP/habridge/habridge-log.txt
nohup java -jar -Dconfig.file=/home/pi/alexa_bridge_interface/SILOP/habridge/data/habridge.config /home/pi/alexa_bridge_interface/SILOP/habridge/ha-bridge-fibaro.jar > /home/pi/alexa_bridge_interface/SILOP/habridge/habridge-log.txt 2>&1 &

chmod 777 /home/pi/alexa_bridge_interface/SILOP/habridge/habridge-log.txt
