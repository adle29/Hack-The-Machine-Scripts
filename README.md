# Hack-The-Machine-Scripts
Scripts for the Navy Cyber Competition, Hack The Machine

AIS.py 
Cleaned the output from wireshark's tcp dump to clean AIVDO messages. 

encoder/ais.2.encode_sample.php 
Forged false AIVDO messages with manipulated coordinates and different encoded ship's information. 

Sniff.py 
A simple script to sniff the network to later be analyzed with wireshark. 

Spoof.py 
A script that sends forged AIVDO messages to the AIVDO messages receiver. UDP packets with the 
false are sent to spoof the ship's location.

