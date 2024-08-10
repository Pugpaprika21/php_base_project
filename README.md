# PHP Project

## Overview

This is a PHP project that uses Docker for containerization and PostgreSQL for the database. This README provides instructions on how to set up and run the project.

## Prerequisites

- Docker and Docker Compose must be installed on your machine. You can download and install Docker from [here](https://www.docker.com/products/docker-desktop).

## Getting Started

To get started with the project, follow these steps:

1. **Clone the Repository**

   ```bash
   git clone https://your-repository-url.git
   cd your-project-directory

2. **Start the Project**

    Use Docker Compose to build and run the containers:

    docker-compose up
    
    This command will start the PHP application and PostgreSQL database containers.

3. **Access the Application**

    Web Interface: Open your browser and navigate to the following URL to access the web interface:

    http://localhost:8000/?route=/web/helloworld/index

    API Endpoint: To access the API, use the following URL:

    http://localhost:8000/?route=/api/user/index

4. **Access the PostgreSQL Database**

    You can manage the PostgreSQL database using a GUI tool. Open the following URL in your browser:

    http://localhost:5050

    Use the appropriate credentials provided in your docker-compose.yml file to connect to the database.

5. **Project Structure**
    src
    │
    ├── app
    │   ├── constant
    │   ├── controllers
    │   ├── di
    │   ├── foundation
    │   ├── helpers
    │   ├── libs
    │   ├── repository
    │   └── autoload.php
    ├── config
    ├── db
    ├── logs
    ├── schema
    ├── utils
    ├── views
    └── index.php
    docker-compose.yml
    Dockerfile
    README.md

## Contact Me ..
    For any questions or support, please contact pugpaprika21@gmail.com

## Create By Pug

