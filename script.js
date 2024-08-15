
document.addEventListener('DOMContentLoaded', () => {
    getWeather();
});
function getWeather() {
    const city = document.getElementById('cityInput').value ||"Pokhara";
    const apiKey = '2de9e8ebd605944d35dc6c9793354dce'; // Replace with your actual API key from OpenWeatherMap
    const apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric`;

    fetch(apiUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data); // Optional: Log the JSON response to see all the details

            // Construct the HTML to display current weather information
            let weatherInfo = `
            <div class="weather-card">
    <img src="https://openweathermap.org/img/wn/${data.weather[0].icon}.png" alt="Weather Icon">
    <div class="weather-info">
        <p><strong>${new Date().toLocaleTimeString()}</strong></p>
        <p><strong>Temperature:</strong> ${data.main.temp} °C</p>
        <p><strong>Feels Like:</strong> ${data.main.feels_like} °C</p>
        <p><strong>Humidity:</strong> ${data.main.humidity} %</p>
        <p><strong>Wind:</strong> ${data.wind.speed} m/s, ${data.wind.deg}°</p>
        <p><strong>Cloudiness:</strong> ${data.clouds.all} %</p>
        <p><strong>Weather:</strong> ${data.weather[0].description}</p>
    </div>
</div>
              
            `;
            
            document.getElementById('weatherInfo').innerHTML = weatherInfo;

            // Call function to fetch and display hourly forecast
            // getHourlyForecast(city);
        })
        .catch(error => {
            console.error('Error fetching weather data:', error);
            document.getElementById('weatherInfo').innerHTML = `<p>Error fetching weather data</p>`;
        });
}

document.getElementById('getForecastButton').addEventListener('click', () => {
    const city = document.getElementById('cityInput').value;
    if (city) {
        getHourlyForecast(city);
    } else {
        alert('Please enter a city name.');
    }
});

function getHourlyForecast() {
    const city = document.getElementById('cityinput').value || 'Pokhara';

    const apiKey = '2de9e8ebd605944d35dc6c9793354dce'; // Replace with your actual API key
    const apiUrl = `https://api.openweathermap.org/data/2.5/forecast?q=${city}&appid=${apiKey}&units=metric`;

    fetch(apiUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data); // Optional: Log the JSON response to see all the details

            // Construct HTML to display hourly forecast information for the next 12 hours
            let forecastInfo = '';
            data.list.slice(0, 12).forEach(item => {
                const date = new Date(item.dt * 1000).toLocaleString(); // Convert timestamp to local date and time
                const weather = item.weather[0];
                const iconUrl = `https://openweathermap.org/img/wn/${weather.icon}.png`;
                
                forecastInfo += `
                    <div class="weather-card">
    <img src="${iconUrl}" alt="Weather Icon" class="weather-icon">
    <div class="weather-info">
        <p><strong>${date}</strong></p>
        <p><strong>Temperature:</strong> ${item.main.temp} °C</p>
        <p><strong>Feels Like:</strong> ${item.main.feels_like} °C</p>
        <p><strong>Humidity:</strong> ${item.main.humidity} %</p>
        <p><strong>Wind:</strong> ${item.wind.speed} m/s, ${item.wind.deg}°</p>
        <p><strong>Cloudiness:</strong> ${item.clouds.all} %</p>
        <p><strong>Weather:</strong> ${weather.description}</p>
    </div>
</div>

                `;
            });

            document.getElementById('hourlyForecast').innerHTML = forecastInfo;
        })
        .catch(error => {
            console.error('Error fetching hourly forecast data:', error);
            document.getElementById('hourlyForecast').innerHTML = `<p>Error fetching hourly forecast data</p>`;
        });
}



