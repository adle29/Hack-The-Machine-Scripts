f = open("ais.txt")
f2 = open("ais1.txt", "w")

for rawline in f.readlines():
	line = rawline.replace('.','').strip()


	if line != "" and "AIVDO" not in line and "$PFEC" not in line:# and "$PFEC" not in line:
		if line[0] != "!":
			line = line[1:]
		f2.write(line+"\n")

f2.close()
f.close()