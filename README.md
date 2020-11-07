# Web-based Server Logfile

This is a simple realization of a online logfile. The intention is to have a central logfile which can be fed from different sources to provide an easy status overview.

## Installation
There are no special requirements to run the code. You just need a web server with a running PHP instance and the SQLite3 extension. Make sure to add a security key in the `index.php`. (Click [here](https://tools.faullab.com/keygenerator/index.php?length=15) to generate a key.)

Before the logfile can be used, the database has to be initialized. This is done by `https://log.example.org/index.php?key=KEY&mode=init`, where KEY is the special key that is defined in the `index.php` and `https://log.example.org` the path to the script on the webserver. If the initialization is successful `init_successful` is returned. Make sure to delete the file `INITIALIZE` in the root folder afterwards to disable further initialization of the database.

## Usage
### View Entries
The logfile can be accessed by `https://log.example.org/index.php?key=KEY&mode=view`.

### Add Entry
An entry can be added by calling `https://log.example.org/index.php?key=KEY&mode=add&dev=DEVICE&type=MSGTYPE&msg=MESSAGE`, where `DEVICE`, `MSGTYPE` and `MESSAGE` are predefined fields that describe and categorize entries. Note that special characters in the messages must be encoded using [URL encoding](https://en.wikipedia.org/wiki/Percent-encoding).

Example:
```
https://log.example.org/index.php?key=iuzwa79&mode=add&dev=FTP%2DServer&type=warning&msg=FTP%2DServer%20not%20started
```

Suppose a logfile entry is added from a bash script, then the return value can be evaluated. Successfully adding an entry to the logfile returns `add_successful` while `add_failed` is returned if the entry could not be added.

### Clear List
The complete list can be cleared by calling `https://log.example.org/index.php?key=KEY&mode=clear`. Note that all entries are deleted immediately and it is not asked for confirmation.  
If the logfile is cleared successfully, the script will return `clear_successful` and `clear_failed` if an error occurred.


## License
This project is licensed under the [MIT](./LICENSE.md) license.