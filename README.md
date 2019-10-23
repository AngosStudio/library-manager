# Hands on Project (optional)
In this last part of the assessment you need to create a small project, you can choose any of the following languages: “NodeJS”, “PHP”, “Dotnet”
You must create a system to manage a library’s books.
It must be a simple application for creating, deleting and updating books.
It should have:
- Back-end application (you can use a SPA with SSR)
- Stores the data in a database (MongoDB or MySQL)
- Validate all the forms before server submission (must validate in the server as well)
You must supply a Readme.MD explaining how to use your application and how to setup the database.
You can create a Docker-Compose file for you project if you want.

## How to use
- Create a DB in MySQL;
- Import file `lib.sql`;
- Copy all files to a local server (wamp, xampp, lamp, ...);
- Change database infos inside file `application/config/database.php`;
- Change file `.htaccess` where is `RewriteBase /` to `RewriteBase /[app-folder-name]/`;
- Change in file `application/config/config.php` base_url to your [app-folder-name], in `$config['base_url'] = 'http://localhost/';` to `$config['base_url'] = 'http://localhost/[app-folder-name]/';`;
- Open in your browser `http://localhost/[app-folder-name]`;
- And *Voilà* you have a Library's Manager access;
