# Acanotes Platform

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