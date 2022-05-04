# Elephant Todo
[![Run on Repl.it](https://repl.it/badge/github/fatfingers23/Elephant-Todo.git)](https://repl.it/github/fatfingers23/Elephant-Todo.git)

A simple PHP web application built with the PHP micro framework . If you are familiar with [express](https://expressjs.com/) or [Flask](https://flask.palletsprojects.com/en/2.1.x/) you will feel right at home with Slim. The Github link can be found [here](https://github.com/fatfingers23/Elephant-Todo). Happy hacking!

## Featuers
* [Slim](https://www.slimframework.com/) a micro PHP framework to make handling routing, templating, and requests a breeze.
* [Twig](https://twig.symfony.com/) A template engine for PHP. Even though we can display PHP directly with HTML on our own. This makes it secure and a breeze.
* [intelephense](https://intelephense.com) as a language server for code intelligence inside of Replit.
* [Composer](https://packagist.org) for package manager.


## Layout
* `app` - This is where the logic of your application lives. The files are divided into classes like any other OOP language.
  * `Database.php` - This holds all the logic that uses my [composer package ](https://github.com/fatfingers23/Replit-Database-Client) to interact with the Replit database.
* `public` - This holds any public accessible PHP files
  * `index.php` - Entrypoint for the web app. This is where Slim is setup and route logic is set.
  * `templates` - This holds the Twig templates that are used in this application. The HTML template is styled with Styled with [tailwindcss](https://tailwindcss.com) and [daisyui](https://daisyui.com).
  * `tests` - This folder holds any tests you make for the project using [Pest](https://pestphp.com).

## Composer scripts

`composer test` - Run this in the shell to run your Pest tests.
