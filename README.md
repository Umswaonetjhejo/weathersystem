## Weather App

This app is created with Laravel 8, MySQL (MariaDB version 10.1.37).
The app shows the current weather for the location of the user/device and the weather forecast for the next coming 5 days.

## How does it archieve that

When app loads it:
- Get the user/device's location (the name of the City and the Country) from https://geolocation-db.com
- It then used response it got from the above statement to get the weather forcast from https://api.openweathermap.org/current and https://api.openweathermap.org/forcast5
- Store the response to MySQL
- And display the weather forcast to the user.

