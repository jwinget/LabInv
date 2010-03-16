#! /usr/bin/env python

import MySQLdb, csv, re, string

otm = open('/home/jason/www/otm.csv', 'rb')
reader = csv.reader(otm)

db = MySQLdb.connect(host='localhost', unix_socket='/opt/lampp/var/mysql/mysql.sock', user='mayorlab', passwd='T!b0m@y0r', db='labinv')
cursor = db.cursor()

reader.next()
for row in reader:
	oligo_name = string.upper(re.sub("\s+", "", row[0]))
	sequence = string.lower(re.sub("\s+", "", row[1]))
	if row[2] == '':
		notes = 'NULL'
	else:
		notes = row[2]
	supplier = row[3]
	if row[4] == '':
		concentration = 'NULL'
	else:
		concentration = row[4]
	if row[5] == '':
		originator = 'NULL'
	else:
		originator = row[5]
	query = 'INSERT INTO oligos (id, name, sequence, supplier, concentration, date_added, originator, notes) VALUES ("NULL", "'+oligo_name+'", "'+sequence+'", "'+supplier+'", "'+concentration+'", "2010-01-06", "'+originator+'", "'+notes+'")'
# execute SQL select statement
	#print query
	cursor.execute(query)
