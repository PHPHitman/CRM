


# CRM Symfony
> Simple CRM project.

## Table of contents
* [General info](#general-info)
* [Screenshots](#screenshots)
* [Technologies](#technologies)
* [Setup](#setup)
* [Features](#features)
* [Status](#status)
* [Inspiration](#inspiration)
* [Contact](#contact)

## General info
Simple CRM system for a company.

For now it has:
* Login page with authentication
* Administration panel
  * Admin can view, delete or create new employee
* User or admin can add new clients
  * All of the users can view details about client
  * Appication save information about date and person who added new client
* All of users can add new orders
  * Orders are related to clients
  * Application save details about who added order and at what date


## Screenshots

<img src="https://imagizer.imageshack.com/img924/4347/GmtPMl.png"/><br/>
List of employee<br/><br/>

<img src="https://imagizer.imageshack.com/img922/1328/uvAYoj.png"/><br/>
List of clients<br/><br/>

<img src="https://imagizer.imageshack.com/img922/3198/gkhkxW.png"/><br/>
Add new client form<br/><br/>

<img src="https://imagizer.imageshack.com/img923/6444/i3XiyU.png"/><br/>
List of orders<br/><br/>

<img src="https://imagizer.imageshack.com/img923/6023/AqiYV1.png"><br/>
Add new order form<br/><br/>

## Technologies
* Tech 1 - Symfony 5.0.7
* Tech 2 - PHP 7.3.10
* Tech 3 - HTML/SCSS/JavaScript
* Tech 4 - Bootstrap 4
* Tech 4 - Twig
* Tech 4 - Webpack
* Tech 4 - Entity Manager

## Setup


 * Start your local server, for example Apache with XAMPP, and switch on MySQL server as well. You can use Symfony server instead by executing command:
	  * php -S 127.0.0.1:8000 -t public<br/><br/>
 Ececute commands:
	* composer install
	* yarn install
	* yarn add --dev @symfony/webpack-encore
	* yarn add webpack-notifier --dev
	* yarn encore dev

* Type localhost address in your browser

If I missed something, sorry, never tested on different machine.

## Code Examples


## Features

* Easy access to information about clients and orders

* Clear interface

## Status
Project is in progress.

## Inspiration
Internet and others CRM

## Contact
Created by PHPHitman.
