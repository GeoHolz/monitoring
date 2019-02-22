#!/usr/bin/python3
# -*- coding: utf-8 -*-
"""
rss-alert.py: search rss for keywords and alert via email
"""
from feedparser import parse
from re import search
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
import smtplib
import datetime
import urllib.request, urllib.error, urllib.parse
import logging
import argparse

# Variable
fromaddr = "XXX@gmail.com"
toaddr = "XXX@gmail.com"
server_smtp = "smtp.gmail.com"
server_smtp_password = "XXX"
lstfound="Liste : "
now = datetime.datetime.now()
fluxrss = "URL"
keywords = ["WORD1","WORD2","WORD3","ETC"]
countfound=0

# Get argument --debug
parser = argparse.ArgumentParser()
parser.add_argument("--debug", help="increase output verbosity", action="store_true")
args = parser.parse_args()


# Create logger object for redirect output to console
logger = logging.getLogger()
logger.setLevel(logging.DEBUG if args.debug else logging.INFO)  
stream_handler = logging.StreamHandler()
stream_handler.setLevel(logging.DEBUG)
logger.addHandler(stream_handler)
# Example : logger.debug('Hello') logger.debug('Testing %s', 'foo')


# Accept cookie and user-agent mozilla
opener = urllib.request.build_opener(urllib.request.HTTPCookieProcessor())
opener.addheaders = [('User-agent', 'Mozilla/5.0')]
response = opener.open(fluxrss)

def mail_me(mail_body):
	msg = MIMEMultipart()
	msg['From'] = fromaddr
	msg['To'] = toaddr
	msg['Subject'] = "Object of mail"
	msg.attach(MIMEText(lstfound, 'plain'))
	server = smtplib.SMTP(server_smtp, 587)
	server.starttls()
	server.login(fromaddr, server_smtp_password)
	text = msg.as_string()
	server.sendmail(fromaddr, toaddr, text)
	server.quit()

d = parse(response)
for entry in d.entries:
		date = entry.published_parsed
		#logger.debug(entry.title)
		if date.tm_year == now.year and date.tm_mon == now.month  and date.tm_mday == now.day and date.tm_hour > now.hour-3:
			for word in keywords:
				if search(r'\b'+word.lower()+r'\b', entry.title.lower()): 
					logger.debug(entry.published_parsed)
					logger.debug(entry.title)
					lstfound = lstfound + "\n" +  entry.title + " : " + entry.link
					countfound+=1
logger.debug(countfound)
if countfound > 0:
	mail_me(lstfound)
