# Twitsquat

**Utility for checking if Twitter usernames are available or not.**

---

## Usage

	$ bash twitsquat.sh [username1 username2 username3 ...] [email address]

eg

	$ bash twitsquat.sh geoff jenny user13190238d nancy_spungeon me@example.com

A summary of available usernames will be sent to the email address specified. Should work out of the box, but you may need to set up mail on your machine/server. I can't help you with that, sorry.

## Cronjob usage

Open your crontab

	$ crontab -e

Check four times an hour

	0,15,30,45 * * * * /bin/bash /path/to/twitsquat.sh username1 username2 me@example.com

Check every minute

	*/1 * * * * /bin/bash /path/to/twitsquat.sh username1 username2 me@example.com

## Important note on false-positives

The script basically just sends a GET request to twitter.com/[username]. If it returns a 404, then we assume the username is available. False positives will occur when Twitter is borken and throwing 404s for all requests. This happens from time-to-time, but just take it as reassurance that twitsquat is working ^.^
