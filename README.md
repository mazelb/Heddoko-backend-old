# Folder Structure

Angular controllers reside in app/controllers.js. For now, fake data is included in these controllers. For example, pages use the controller using ng-controller="myCtrl". Graphs can read this data from the controller and display it.

Fonts and JS plugins are in /fonts and /scripts respectively. CSS files are in /styles. Twitter Bootstrap is included there, but all custom CSS is in /styles/main.css.

Each page of the website is considered the be a "template, where only the body of the page is present. These pages are located in /app/views/dashboards/. Additionally, The navigation bar and header are in /app/views/.

# Running the Web App

Initial setup instructions are in Theme Instructions/setup.md, which should be followed in the Team Management Dashboard/README.md. After setup, launching the site is down by running "grunt dev" in a terminal window in the root directory of the app. Point browser to 127.0.0.1:8888. Leave the terminal window open while running the website. It should detect code changes and only a browser refresh should be necessary to see changes. Sometimes CSS changes aren't updated for some time.

## Notes:

### General
- Grunt concatenates all css and javascript into 2 files and puts them in /dist. Do not bother editing these files during development.
- For some reason, and rarely, the JS hangs in Firefox. Never had issues in Chrome. Investigating this.

### Team Dashboard

- This code has not been modified since the previous commit.

### User Dashboard

- Development focus was put here, while following the wireframe model.
- Login page controls were added, but login page styling is incomplete.
- Navigation bar was changed to fit wireframe.
- Statistics page is almost done, however minor styling issues remain.
- User image was added to navigation bar, need to implement clickable drop-down and remove original user image.
- The rest of the dashboard pages need to be implemented.
- Login/Logout functionality needs to be investigated, along with backend+hosting specifics