<?php require './includes/header.php'; ?>

<div class="container">
    <div class="weather-container">
    <h2>Weather Forecast</h2>
    <div class="search-box">
        <input type="text" id="cityInput" placeholder="Enter city name">
        <button onclick="getWeather()" class="search-button"><img src="assets/icons8-search-90.png" alt="search-icon" width="20" ></button>
    </div>
    <div id="weatherInfo" class="weather-info">

        <!-- Weather information will be displayed here -->
    </div>
    </div>
   
</div>

<script src="script.js"></script>
</body>

</html>