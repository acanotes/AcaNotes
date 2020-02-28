#!/bin/bash
mysql -h 127.0.0.1 -u root -p123456 < ./web/populate/empty_database.sql
mysql -h 127.0.0.1 -u root -p123456 acanotes < ./web/populate/populate_data.sql
heroku local web -f Procfile.dev &
