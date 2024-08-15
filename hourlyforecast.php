<?php require './includes/header.php'; ?>

<div class="hourly-forecast-container">
    <div>
    <h1>Hourly Forecast</h1>
    <div class="search-box">
        <input type="text" id="cityinput" placeholder="Enter city name">
        <button id="getForecastButton" onclick="getHourlyForecast()">Get Forecast</button>
    </div>
    <h3 style="text-align:center;">Hourly Forecast of (Next 24 hours)</h3>
    <div id="hourlyForecast" class="hourly-forecast">
        <!-- Hourly forecast information will be displayed here -->
    </div>
    </div>
    
</div>
<script src="script.js"></script>
</body>

</html>