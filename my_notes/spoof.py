#! /usr/bin/env python

import socket
import urllib.request

# we 192.168.69.1, 172.16.189.1
# https://wiki.python.org/moin/TcpCommunication

UDP_IP = '172.31.24.3	'#'172.31.255.255'#'172.31.24.3' #'172.17.6.183'#'172.16.189.255'#'172.17.2.61'#'127.0.0.1'
UDP_PORT = 10033
BUFFER_SIZE = 1024
s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM) # UDP
POSITIONS = 10

def send_packet(MESSAGE):
	s.sendto(bytes(MESSAGE, "utf-8"), (UDP_IP, UDP_PORT))
	print ("packet sent")

def create_false_coordinates(lat, lon):
	url = "http://localhost:8000/ais.2.encode_sample.php?lat="+str(lat)+"&lon="+str(lon)
	
	with urllib.request.urlopen(url) as response:
	   html = response.read()
	   ais_message = html.decode("utf-8").strip()

	   return ais_message

def create_false_trayectory(start_lat, start_long):
	f = open("test.txt", 'w+')
	for i in range(POSITIONS+1):
		ais_message = create_false_coordinates(start_lat, start_long+(i/800.0) )
		print(ais_message)
		f.write(ais_message+"\n")
	f.close()


def main():
	f = open("test.txt")
	for line in f.readlines():
		packet_data = line.strip()
		send_packet(packet_data)
	s.close()

#create_false_trayectory(37.8038033333333, -122.392531666667)
main()

