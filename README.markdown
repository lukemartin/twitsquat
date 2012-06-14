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