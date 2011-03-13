# Twitsquat

**Utility for checking if Twitter usernames are available or not.**

---

## Parameters

<pre>
	<code>
		twitsquat.php [digest] [email address] [usernames]
	</code>
</pre>

- digest: Boolean, whether to email digest of results
    - _eg 1: Send email with results of all available and unavailable usernames_
    - _eg 0: Send email with results of available usernames only_
- email address: Your email address which results will be sent to
    - _eg me@example.com_
- usernames: Space-separated list of usernames to check
    - _eg 'username1 username2 username3' etc_

---

## Command-line usage

<pre>
	<code>
		$ php twitsquat.php 0 me@example.com username1 username2 username3
	</code>
</pre>

---

## Cronjob usage

Add a new line in your crontab file by typing:

<pre>
	<code>
		$ crontab -e
	</code>
</pre>

Format your cron job like this:

<pre>
	<code>
		# m h  dom mon dow   command
		  30 * * * * /usr/bin/php /path/to/twitsquat.php 0 me@example.com username1 username2 username3
	</code>
</pre>

### Example crons

Check for these usernames every 15 minutes, and only send an email if one becomes available:

<pre>
	<code>
		  0,15,30,45 * * * * /usr/bin/php /path/to/twitsquat.php 0 me@example.com username1 username2 username3
	</code>
</pre>

Send an email digest every Monday at 6am to notify you of all available/unavailable usernames (_or just to check if Twitter have blocked your IP :p_)

<pre>
	<code>
		  0 6 * * 1 /usr/bin/php /path/to/twitsquat.php 1 me@example.com username1 username2 username3
	</code>
</pre>