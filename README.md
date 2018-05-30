Test Task: Posts and Comments
=============================

## Setup
For setup the project please follow these stepls:
- Clone the repository
- Run `composer install` in the terminal
- Provide database credentials to the `app/config/parameters.yml` file
- Run `bin/console d:s:u -f` to create MySQL tables in the database
- Run `bin/console server:start` to run local webserver
- Open `http://localhost:8000` in your browser.

Registration url: `http://localhost:8000/register`.

Email verification is enabled by default. To disable it please edit the `app/config/custom/fos.yml` file and remove or comment these lines:
```yaml
    registration:
        confirmation:
            enabled: true
```
### What could be improved in further steps
- Hide unused JSON fields with JMS serializer from API responses
- Handle invalid form responses
- For optimization I recommend separate the app for frontend and backend logic. Also jquery is not good for dynamic websites, so I recommend using angular/react/vue.js for the backend, and not use backend templates.
- Move work with entities from controllers to separate services
- For time zone I recommend use moment.js library on the front end. It can convert timestamp to local format.

### My comments are bellow with bold text

We're providing a basic structure for you, so you can focus more on what actually matters. Here is what we're asking for:
  * If user is not authenticated, redirect to login (restrict access if not authenticated) **(Done for all URLS except login/registration form)**
  * Add option to sign up **(it's already provided by FOS Users bundle. Url is `/register`)**
  * If logged in, redirect to `/posts`. If just registered, redirect also to `/posts` but add a hint on successful registration **(Done)**
    * (optional) require confirmation of email address to get access to posts **(Done)**
  * on `/posts`:
    * Add methods to create post (optionally over REST API and dynamically adding into the feed) **(Done)**
    * Add method to add comments via REST API (required) and dynamically add to post **(Done)**
    * Add method to remove own posts or comments **Done for comments**
  
  * Add a `Comment` entity to `Posts` **(Done)**
  * Add author information to `Posts` **(Done)**
  * Optimize for performance and explain which steps you took **(Also by default symfony runs in dev environment, and it's required to run it in the production env)**
  * Write tests to check functionality **(I haven't done that. If I worked on that I would made 2 types of test: unit tests with phpUnit or phpspec and functional tests with behat. Unit test are for separate classes, and behat is for testing REST API endpoints)**
  * Add instructions on how to setup project, run tests and what could be improved in further steps **(Done)**
  * (optional) add timezone support and serve content according to users timezone
  * Provide results within own git repository and add your remarks within this README or as comments within code (but describe here where to find those comments)
  
What's already done
-------------------

  * Basic symfony (3.4) structure
  * `User` and `Post` entity
  * Included frontend libraries:
    * jQuery (1.12.4)
    * Bootstrap (3.3.7)
  * Included bundles:
    * `FOSRestBundle`
    * `FOSUserBundle`
    * `JMSSerializerBundle`
