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
</head>

<body>
  <div class="container">
    <div class="row my-5">
      <div class="col">
        <div class="card p-4 rounded-5">
          <table class="table">
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
                while ($row = mysqli_fetch_assoc($flightLogsResults)) {
                  ?>
                  <tr>
                    <td><?php echo $row['flightNumber']; ?></td>
                    <td><?php echo $row['departureAirportCode']; ?></td>
                    <td><?php echo $row['arrivalAirportCode']; ?></td>
                    <td><?php echo $row['departureDateTime']; ?></td>
                    <td><?php echo $row['arrivalDateTime']; ?></td>
                    <td><?php echo $row['flightDurationMinutes']; ?></td>
                    <td><?php echo $row['airlineName']; ?></td>
                    <td><?php echo $row['aircraftType']; ?></td>
                    <td><?php echo $row['passengerCount']; ?></td>
                    <td><?php echo $row['ticketPrice']; ?></td>
                    <td><?php echo $row['pilotName']; ?></td>
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