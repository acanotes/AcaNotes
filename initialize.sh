#!/bin/bash
mysql -h 127.0.0.1 -u root -p123456 < ./populate/empty_database.sql
mysql -h 127.0.0.1 -u root -p123456 acanotes < ./populate/populate_data.sql
heroku local web -f Procfile.dev > /dev/null &
