   # Laravel HubSpot Starter Kit
### A good place to start if you're building a public App for HubSpot

##### [View the live demo](https://laravel-hubspot-starter-kit.herokuapp.com/register)

## Features
- [Laravel 9.x](https://laravel.com/docs/9.x)
- [Vite 3.x](https://vitejs.dev/)
- [Vue 3.x](https://vuejs.org/guide/introduction.html) with Vue Router
- [Pinia](https://pinia.vuejs.org/introduction.html) State Manager
- [Tailwind](https://tailwindcss.com/) 3.x
- [Laravel Valet](https://laravel.com/docs/9.x/valet)
- [Laravel Ziggy](https://github.com/tighten/ziggy)
- Integrated SPA (Utilizes Laravel API and vue 3 front-end on the same server instance)
- Laravel Auth
- [HubSpot OAuth2](https://developers.hubspot.com/docs/api/working-with-oauth) flow
- A user can belong to many teams
- A team can add many portals
- Set team and portal in session to allow subsequent api calls within the app relate to chosen portal instance
- Procfile included for easy deployment to [Heroku](https://www.heroku.com/)

## Requiremnts
- [Laravel Valet](https://laravel.com/docs/9.x/valet) or [equivalent](https://www.wampserver.com/en/)
- [Composer](https://getcomposer.org/)
- [Node v16.13.1](https://github.com/nvm-sh/nvm) or later
- [HubSpot Developer Account](https://developers.hubspot.com/)

## Laravel Installation
1. Clone or Fork this repo
2. Open terminal and cd to the working directory `cd laravel-hubspot-starter-kit`
3. run `composer install`
4. run `yarn install` or `npm install`
5. run `valet link` - To link your working directory to a `.local` or `.dev` domain (example: https://laravel-hubspot-starter-kit.dev/ is pointing to your local directory)
6. Secure your local API with `valet secure` - HubSpot apps require an SSL unless you are testing with `http://localhost`
7. At this point, if you run `yarn dev` you should be able to see your Laravel app running, but we still need to setup the database
8. Create your MySQL or MariaDB database
9. In your working directory, rename `.env.example` to `.env`
10. Enter your new database credentials in your `.env` file and save
11. While you're in the `.env` file, let's set the app URL `APP_URL=https://laravel-hubspot-starter-kit.dev`
12. Don't forget to save your `.env` file
13. Now that we have our database connected via the `.env` file, let's run the migrations with `php artisan migrate`
14. You should now be able to navigate to `https://laravel-hubspot-starter-kit.dev/register` in your browser, and register as a new user

> you might see a broken SSL in the browser, that’s okay, we really needed to secure the Laravel API since HubSpot Auth callbacks require the HTTPS protocol and we are a little less worried about securing the SPA at this point.

## Creating your HubSpot App
1. Login or create a developer account at https://developers.hubspot.com/
2. Choose to create a new public APP in HubSpot developer account
3. Name your app under App Info
4. Click on the Auth tab
5. First, let’s set our redirect url - this is the url that’s going to be called in our app after the user authenticates with HubSpot `https://llaravel-hubspot-starter-kit.dev/submitauth`  
![Developers-Hub-Spot-2022-10-30-06-03-52.png](https://i.postimg.cc/43C6VchT/Developers-Hub-Spot-2022-10-30-06-03-52.png)
6. Next let's set some scopes... For the demo, we are going to choose to read contact lists (Make sure you have some lists created in your HubSpot client portal if you want to see some data pulled in)
7. Choose the CRM Dropdown
8. Then toggle on `crm.lists` Read  
![scopes.png](https://i.postimg.cc/K8mk25Lj/Scopes.png)
9. When you’re done filling out the information hit Save, then we need to add our HubSpot app credentials to our `.env` file
10. Open your `.env` file again and add the following  
```
HS_AUTH_URL=https://app.hubspot.com/oauth/authorize
HS_APP_ID=<your app id from HubSpot>
HS_CLIENT_ID=<your client id from HubSpot>
HS_CLIENT_SECRET=<your client secret from hubspot>
```
11. Save your `.env` file
12. In your browser, login to your sample app and go to "My Hubs"
13. Click “Add Portal”
14. You should now be able to walk through the HubSpot OAuth flow
15. After you connect to your HubSpot portal, you should have been redirected to a page in your app that shows all of your HubSpot lists   
![preview.png](https://i.postimg.cc/GtsY4hhp/preview.png)

## Contributing
- Fork the repo, add your feature then create a pull request
- All contributions will be credited


   