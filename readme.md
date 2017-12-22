
## Example Podcast App

This is an app that uses Laravel to create a simple podcast site that shows a list of episodes for the podcast, allows admins to upload new podcasts, and contains an XML RSS feed that would be used to register the podcast with podcast directories like iTunes.

### Routes available

- / -> home page showing a list of episodes
- /feed -> xml rss feed for the podcast
- /admin -> admin area for adding new episodes 

## To run the app

1. Pull the master branch
2. Edit the .env file to use the correct database credentials in MySQL on your local instance.
3. Run "php composer install"
4. Run "php artisan migrate --seed"
5. Run "php artisan serve"
6. Navigate to 127.0.0.1:8000/

You may need to give write permissions to the 'storage/' and/or the 'public/podcasts' directories in the project for it to run.

### Improvements to be made

Given a shortage of time, there are a number of improvements that could be made to this example site

- Adding episodes should be done using REST API endpoints for the episodes resource.  That way the admin could handle creating, updating and deleting episodes from javascript.
- The front page can have pagination added to allow scrolling through the podcast episodes 10 or so at a time.  At the moment, the front page is limited to showing the latest 10 episodes (the first page of episodes)
- The layouts and styles are all pretty much exactly the same as the laravel default installation, and could be customized and componentized for reuse.
- Validation should be added to the new episode form, and to the xml feed service so that it doesn't error out due to incorrect episode data