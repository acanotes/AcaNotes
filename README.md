# Acanotes Platform

## Development Setup

First install all necessary packages for PHP

```cmd
composer update
```

Then install all npm related in the web folder

```cmd
cd web && npm install
```

For Mac OS, we need to reconfigure Apache to get `heroku local` working to test locally. Solution from https://stackoverflow.com/questions/36362484/heroku-php-getting-started-doesn-t-run-locally-on-osx/36449401#36449401

First

```cmd
brew install homebrew/apache/httpd24 --with-mpm-event
```

Then in the global config (in `/usr/local/etc/apache2/`), enable `mod_proxy` and `mod_proxy_fcgi` and `mod_rewrite`, and comment out the `Listen` directive

### Run the servers and platform

To get the server and running for PHP code in `web/public` along with our database, run

```bash
cd web
docker-compose build
docker-compose up -d
```

To start up the frontend, cd into `web` and `npm start` or from root directory run

```bash
npm start --prefix=web
```

This will run the frontend from http://localhost:3000.


Test connection by going to http://localhost:5000/api/connect.php

You can view the database data directly with http://localhost:8081

By default, root user is `root` and password is dependent on your .env file. Check `sample.env`

Local database will by default populate itself with `populate_db/populdate_data.sql` and whatever other .sql files are in the `populate_db` folder.

To repopulate the database from a clean slate, run

```bash
docker-compose rm -fv
docker-compose up
```

## Local Production Setup

Build your most recent code

```bash
cd web && npm run build
```

Start up docker stuff

```bash
cd web
docker-compose -f docker-compose.prod.yml up
```

Run the server

```bash
heroku local web
```

Both frontend and backend are serviced here through http://localhost:5000

Note all backend only works through http://localhost:5000/api


## Serving to Production

First run

```bash
npm run build
```

from the `web` folder and push it all to master

Deploy from dashboard for master branch

Ensure that the correct contents are inside the web/.env file to be read by our backend

## Common Issues...

On Mac OS, if you can't seem to run `heroku local web -f Procfile.dev`, make sure to kill the httpd process. Find its PID by running `httpd` and then kill it

If for some reason too much memory is used, likely an exception was thrown and just do a `var_dump($error)` or something similar to find that error


## Installations

Install PHP, composer, npm, and Node.js, docker



## Heroku Setup

Add the proper build-packs

```cmd
heroku buildpacks:add --index 1 https://github.com/mars/create-react-app-buildpack.git
heroku buildpacks:add --index 2 heroku/php
```

Then push to heroku remote to start deployment

```cmd
git push heroku master
```

Go to https://acanotes.herokuapp.com/ to see the deploy
