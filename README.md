Muhvieh-Mobile
==============

This is a webpage written in PHP. It comes with jquery Mobile, so it can be used on smartphones and laptops. Muhvieh-Mobile is a webapp to administer your moviecollection with informations from TMDB.

To use Muhvieh-mobile you need a API-Key from TMDB.
Installation (example Ubuntu 14.04)

Download the script to your webdirectory

    $ cd /var/www/html
    $ git clone https://github.com/Ezak91/Muhvieh-Mobile.git

Add the database and tables with the commands from :

    $ nano Muhvieh-Mobile/scripts/muhvieh.sql

Edit the config file and add your credentials

    $ nano Muhvieh-Mobile/conf/config.php

Credentials for your database connection

    $config = array (
    "mysql_server" => "localhost",
    "mysql_user" => "root",
    "mysql_password" => "password",
    "mysql_database" => "muhvieh_db"
    );

TMDB Api-Key, mail of the administrator, homepageurl, homepagename

    // Settings
    $api_key = "Your TMDB Api-Key";
    $admin_mail = "Your Muhvieh Admin Mail";
    $homepage = "Your Muhvieh Hompage Url";
    $hp_name = "Name of your Muhvieh-Url";
    ?>

Now it's possible to call the script in your webbrowser http://youripordomaine/Muhvieh-mobile

You can login and change the inital password of the administrator account.

    User: admin@muh.vieh
    password: muhvieh

Update Muhvieh-Mobile

You can simply update Muhvieh-Mobile with git.

    * cd /var/www/html/Muhvieh-Mobile
    * git pull
