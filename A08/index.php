<?php
include("connect.php");

// Retrieve flight logs
$flightLogsQuery = "SELECT flightNumber, departureAirportCode, arrivalAirportCode, departureDateTime, arrivalDateTime, flightDurationMinutes, airlineName, aircraftType, passengerCount, ticketPrice, pilotName FROM flightLogs";
$flightLogsResults = executeQuery($flightLogsQuery);
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Flight Logs</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .card {
      border: 1px solid #dee2e6;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .flightTable th {
      background-color: #343a40;
      color: white;
      padding: 12px;
      text-align: center;
      vertical-align: middle;
      font-size: 18px;
    }
    .flightTable td {
      padding: 10px;
      color: #212529;
      border-bottom: 1px solid #dee2e6;
      text-align: center;
      vertical-align: middle;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row my-5">
      <div class="col">
        <div class="card p-4 rounded-5">
          <h1 class="text-center mb-4">Flight Logs</h1>
          <table class="table flightTable">
            <thead>
              <tr>
                <th scope="col">Flight Number</th>
                <th scope="col">Departure Airport</th>
                <th scope="col">Arrival Airport</th>
                <th scope="col">Departure Time</th>
                <th scope="col">Arrival Time</th>
                <th scope="col">Duration (Minutes)</th>
                <th scope="col">Airline</th>
                <th scope="col">Aircraft Type</th>
                <th scope="col">Passengers</th>
                <th scope="col">Ticket Price</th>
                <th scope="col">Pilot</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (mysqli_num_rows($flightLogsResults) > 0) {
                while ($flightsrow = mysqli_fetch_assoc($flightLogsResults)) {
                  ?>
                  <tr>
                    <td><?php echo $flightsrow['flightNumber']; ?></td>
                    <td><?php echo $flightsrow['departureAirportCode']; ?></td>
                    <td><?php echo $flightsrow['arrivalAirportCode']; ?></td>
                    <td><?php echo $flightsrow['departureDateTime']; ?></td>
                    <td><?php echo $flightsrow['arrivalDateTime']; ?></td>
                    <td><?php echo $flightsrow['flightDurationMinutes']; ?></td>
                    <td><?php echo $flightsrow['airlineName']; ?></td>
                    <td><?php echo $flightsrow['aircraftType']; ?></td>
                    <td><?php echo $flightsrow['passengerCount']; ?></td>
                    <td><?php echo $flightsrow['ticketPrice']; ?></td>
                    <td><?php echo $flightsrow['pilotName']; ?></td>
                  </tr>
                  <?php
                }
              } else {
                ?>
                <tr>
                  <td colspan="11" class="text-center">No flight logs available</td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>
</html>
