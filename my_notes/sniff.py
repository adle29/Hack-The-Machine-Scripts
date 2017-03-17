import pyshark 

#172.31.24.3

INTERFACE = 'en0' #en4, en0, wlan0

capture = pyshark.LiveCapture(interface=INTERFACE, bpf_filter='udp') 
capture.sniff(timeout=50)

for packet in capture.sniff_continuously(packet_count=5):
    print ('Just arrived:', packet)
