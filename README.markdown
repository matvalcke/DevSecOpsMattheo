Project Information:
This project was completed as part of a practical assignment. The subject can be found in the "Doc" folder. It was developed solely by Matthéo Valcke. An SQL file named "init.sql" is provided in the "mysql" folder to set up a database with test data.

Local Project Setup:
To set up the project locally, navigate to the project directory in your terminal and run the following command:

composer install
Then, open your DATABASE manager (e.g., MySQL) and create a database named "gift". Configure the .env file with your database settings:

DATABASE_URL="mysql://root:@127.0.0.1:3306/gift"
Next, execute the following command in the terminal to migrate tables to your database:

php bin/console doctrine:migrations:migrate
Finally, start the server by running:

symfony server:start --port=8000
The microservice will be running on port 127.0.0.1:8000.

Project Initialization with Docker:
To access the project with Docker, simply switch to the "Docker" branch of the project. I attempted to set up Docker for this project, but encountered issues with the database connectivity. Here are the details:

I set up a docker-compose with a symfony service and a mysql service.
A Dockerfile was created for the symfony service.
Unfortunately, i have unable to resolve a database connection error from the project (see the .env file). Therefore, i decided not to implement Docker on the main branch. To run the project with Docker, use the following command:

docker-compose up -d --build





