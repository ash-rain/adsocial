# SocialSync

Manage user posts across multiple social platforms. Runs on Laravel 5.1.

## Configuration
* /.env
* /config/app.php
* /config/br.php
* /config/database.php

## Deployment

#### 1. Clone the repository

Or `git pull` in an existing clone's root directory.

#### 2. File permissions
Run `sudo chgrp www-data -R DIRECTORY && sudo chmod 775 -R DIRECTORY` replacing `DIRECTORY` with each of the following (i.e. issue a separate command for each dir):

* storage/
* public/
* bootstrap/cache/

The group (`www-data`) and permissions (`rwxrwxr-x`) may not always apply but are just a suggestion that works in the majority of cases. If your environment doesn't match these values you should change them.

#### 3. Composer
Run `composer install` if you have just cloned a fresh copy or `composer update` on an existing one.

#### 4. Migrations
Run `php artisan migrate`. If something goes wrong either run `php artisan migrate:rollback` until you reach the initial database state or delete and recreate your database and `migrate` again.

#### 5. .env
If you're setting up a new instance you have to `mv .env.example .env` and then change what's needed in the `.env` file.

That should cover everything about deployment. Steps 2-4 are not always necessary while step 5 applies only for a fresh deployment or if some settings have been changed.

## Queue
AdSocial has background workers that regularly check the status of a claimed reward for user action (i.e. a facebook like). There are two queue channels with different purposes:

#### Fast
The `fast` channel is for actions that are not accomplished via API such as commenting.
This channel is processed very often (20 seconds) and makes 8 attempts before dropping a claim for reward. When a claim is dropped no penalty or logging takes place.

#### Slow
The `slow` channel makes sure actions are not reverted after the user has been rewarded. The channel is processed every 8 hours and has no tolerance for false checks. If an action has been reverted (i.e. unlike, delete share/retweet, etc.) after a claim has been rewarded a penalty is applied and logged. If a linked account has received three penalties it gets locked down and nobody can use it in AdSocial anymore.
Claims older than a month are automatically dropped from the queue.

## Database Tables
* `oauth_data` : Information about an OAuth account/session and its relation to an AdSocial user.
* `market` : All actions that have a reward.
* `posts` : A dual-purpose cache/interface representing generic posts on social media.
* `jobs` : The queue storage
* `log` : Action reward log

## OAuth
Callback route: `/auth/callback/{provider}`. Currently supported:
* http://adsocial.microweber.com/auth/callback/google
* http://adsocial.microweber.com/auth/callback/facebook
* http://adsocial.microweber.com/auth/callback/linkedin
* http://adsocial.microweber.com/auth/callback/twitter
