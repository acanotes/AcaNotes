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

Then in the global config (in `/usr/local/etc/apache2/`), enable `mod_proxy` and `mod_proxy_fcgi`, and comment out the `Listen` directive

### Run the servers and platform

To get the server up and running for PHP code in `web/public`, run

```cmd
heroku local web -f Procfile.dev
```

To start up the frontend, cd into `web` and `npm start` or from root directory run
```cmd
npm start --prefix=web
```

To start up MariaDB, on Mac OS run

```cmd
brew services start mariadb
```

Test connection by going to http://localhost:5000/connect.php


Populate the local database with default data:
```cmd
mysql -h spvunyfm598dw67v.cbetxkdyhwsb.us-east-1.rds.amazonaws.com -u jkxyx78jy5ggulvw -pquwwf5br6nbc2giz thw42gj9sxaws9w7 < populate_data.sql
```

## Common Issues...

On Mac OS, if you can't seem to run `heroku local web -f Procfile.dev`, make sure to kill the httpd process. Find its PID by running `httpd` and then kill it


## Installations

Install PHP, composer, npm, and Node.js



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
