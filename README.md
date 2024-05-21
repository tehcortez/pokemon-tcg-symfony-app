# Pokemon Card API Client

Welcome to the Pokemon Card API Client! This application allows users to interact with the Pokemon Card API to fetch and 
display information about Pokemon cards.

## Table of Contents

- [Introduction](#introduction)
- [Getting Started](#getting-started)
    - [Prerequisites](#prerequisites)
    - [Installation](#installation)
- [Usage](#usage)
    - [Configuration](#configuration)
    - [Running the Application](#running-the-application)
    - [API Documentation](#api-documentation)
- [Testing](#testing)
- [Contributing](#contributing)
- [License](#license)

## Introduction

The Pokemon Card API Client is a simple PHP-based application that consumes the Pokemon Card API to retrieve and display 
information about various Pokemon cards. It offers a user-friendly interface for searching and viewing card details.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing 
purposes.

### Prerequisites

Before you begin, ensure you have the following installed:

- PHP 8.2 or higher
- Composer (for managing PHP dependencies)
- Git (for version control)

### Installation

1. Clone the repository to your local machine:
```bash
git clone https://github.com/your-username/pokemon-card-api-client.git
```
2. Navigate to the project directory:
```bash
cd pokemon-card-api-client
```
3. Install PHP dependencies using Composer:
```bash
composer install
```
## Usage
### Configuration
Before running the application, configure the base URL of the Pokemon Card API by editing the `config.php` file located 
in the `src` directory. Replace the placeholder URL with the actual base URL of the API.

### Running the Application
Use the built-in PHP web server to run the application. Navigate to the project directory and run the following command:
```bash
php -S localhost:8000 -t public
```
If you're using symfony cli, you can also run the command:
```bash
symfony serve
```
Once the server is running, open your web browser and navigate to http://localhost:8000 or http://127.0.0.1:8000/ to 
access the Pokemon Card API Client.
### Running with Docker
If you have command 'docker-compose' installed,  you can also run the command:
```bash
docker-compose up --build
```
To run the application using Docker, follow these steps:
1. Build the Docker image:
```bash
docker build -t pokemon-tcg-symfony-app .
```
2. Run the Docker container:

```bash
docker run -p 8080:80 pokemon-tcg-symfony-app
```
Once the container is running, open your web browser and navigate to http://localhost:8080 or http://127.0.0.1:8080/ to
access the Pokemon Card API Client.

### API Documentation
This project uses NelmioApiDocBundle to provide interactive API documentation. To access the API documentation, follow 
these steps:

1. Ensure the application is running (using one of the methods described above).
2. Open your web browser and navigate to http://localhost:8000/api/doc if using the built-in PHP server or Symfony CLI, 
or http://localhost:8080/api/doc if using Docker.
The interactive API documentation will be displayed, allowing you to explore the available endpoints and test them 
directly from the browser.

## Testing
To run the unit tests for the application, use the following command:
```bash
vendor/bin/phpunit
```
To read the Code Coverage Report, use the following command:
```bash
vendor/bin/phpunit --coverage-text
```
## Contributing
Contributions are welcome! If you would like to contribute to the project, please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bug fix.
3. Make your changes and commit them with descriptive commit messages.
4. Push your changes to your fork.
5. Submit a pull request to the main repository.
## License
The Pokemon Card API Client is open-source software licensed under the MIT license. For more information, see the 
LICENSE file.