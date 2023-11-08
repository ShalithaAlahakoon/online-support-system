# Project Setup Guide

  

Follow these steps to set up and run your project in WSL (Ubuntu) using Docker containers for local development.

  

## Open Project in WSL (Ubuntu)

Open your project in Windows Subsystem for Linux (WSL) using the Ubuntu server.

  

## Create Docker Container

Inside the WSL terminal, run the following command to create a Docker container for your project:

  

    sail up

  
  
  

## Install Composer Dependencies

Install PHP dependencies using Composer:

  

    sail composer install

  
  
  
  

## Install NPM Dependencies

Install Node.js dependencies using NPM:

  

    sail npm install

  
  
  

## Build Assets

Execute the following command to build your project's assets:

  

    sail npm run build

  
  
  

## Run Database Migrations and Seed

Apply migrations and seed the database by running:

  

    sail artisan migrate --seed

  
  
  

## Clear Configuration Cache

Clear the configuration cache with:

  

    sail artisan config:clear

  
  
  

## Clear Application Cache

Clear the application cache using:

  

    sail artisan cache:clear

  
  
  

## Rebuild Assets (Optional)

If necessary, rebuild assets by running the following command again:

  

    sail npm run build

  
  
  

## Login to System

Use the following credentials to log in to your system:

  

-  **Username:** support@onlinesupportsystem.com

-  **Password:** password

  

## Test the Project

Proceed to test your project after completing the setup.

  

## Email Testing with Mailtrap

To configure Mailtrap for email testing, update the `.env` file with your Mailtrap credentials.

  

Remember to refer to your project's documentation for specific setup instructions if it's not a Laravel project with Sail.

  
Happy coding!
