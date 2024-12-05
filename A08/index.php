<?php
include("connect.php");

$airlineFilter = isset($_GET['airline']) ? $_GET['airline'] : '';
$departureAirportFilter = isset($_GET['departureAirport']) ? $_GET['departureAirport'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';
$order = isset($_GET['order']) ? $_GET['order'] : '';

$flightLogsQuery = "SELECT flightNumber, departureAirportCode, arrivalAirportCode, departureDateTime, arrivalDateTime, flightDurationMinutes, airlineName, aircraftType, passengerCount, ticketPrice, pilotName FROM flightLogs";

if ($airlineFilter != '' || $departureAirportFilter != '') {
  $flightLogsQuery .= " WHERE";

  if ($airlineFilter != '') {
    $flightLogsQuery .= " airlineName='$airlineFilter'";
  }

  if ($airlineFilter != '' && $departureAirportFilter != '') {
    $flightLogsQuery .= " AND";
  }

  if ($departureAirportFilter != '') {
    $flightLogsQuery .= " departureAirportCode='$departureAirportFilter'";
  }
}


if ($sort != '') {
  $flightLogsQuery .= " ORDER BY $sort";

  if ($order != '') {
    $flightLogsQuery .= " $order";
  }
}

$flightLogsResults = executeQuery($flightLogsQuery);

$airlineQuery = "SELECT DISTINCT(airlineName) FROM flightLogs";
$departureAirportQuery = "SELECT DISTINCT(departureAirportCode) FROM flightLogs";
$airlineResults = executeQuery($airlineQuery);
$departureAirportResults = executeQuery($departureAirportQuery);
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

<style>
  table td,
  table th {
    vertical-align: middle;
    text-align: center;
  }

  table th {
    font-size: 18px;
  }
</style>

<body>
  <div class="container">
    <div class="row my-5">
      <div class="col-12">
        <form>
          <div class="card p-4 rounded-5">
            <div class="h2 text-center mb-5 bg-dark p-2" style="color: white;">
              Filter
            </div>
            <div class="row">
              <div class="col-12 col-md-3 mb-3">
                <label for="airlineSelect" class="form-label"
                  style="font-size: 1.5rem; font-weight: bold;">Airline</label>
                <select id="airlineSelect" name="airline" class="form-select">
                  <option value="">Any</option>
                  <?php
                  if (mysqli_num_rows($airlineResults) > 0) {
                    while ($airlineRow = mysqli_fetch_assoc($airlineResults)) {
                      ?>
                      <option <?php if ($airlineFilter == $airlineRow['airlineName']) {
                        echo "selected";
                      } ?>
                        value="<?php echo $airlineRow['airlineName'] ?>">
                        <?php echo $airlineRow['airlineName'] ?>
                      </option>
                      <?php
                    }
                  }
                  ?>
                </select>
              </div>

              <div class="col-12 col-md-3 mb-3">
                <label for="departureAirportSelect" class="form-label"
                  style="font-size: 1.5rem; font-weight: bold;">Departure Airport</label>
                <select id="departureAirportSelect" name="departureAirport" class="form-select">
                  <option value="">Any</option>
                  <?php
                  if (mysqli_num_rows($departureAirportResults) > 0) {
                    while ($airportRow = mysqli_fetch_assoc($departureAirportResults)) {
                      ?>
                      <option <?php if ($departureAirportFilter == $airportRow['departureAirportCode']) {
                        echo "selected";
                      } ?> value="<?php echo $airportRow['departureAirportCode'] ?>">
                        <?php echo $airportRow['departureAirportCode'] ?>
                      </option>
                      <?php
                    }
                  }
                  ?>
                </select>
              </div>

              <div class="col-12 col-md-3 mb-3">
                <label for="sort" class="form-label" style="font-size: 1.5rem; font-weight: bold;">Sort By</label>
                <select id="sort" name="sort" class="form-select">
                  <option value="">None</option>
                  <option <?php if ($sort == "flightNumber") {
                    echo "selected";
                  } ?> value="flightNumber">Flight Number
                  </option>
                  <option <?php if ($sort == "departureDateTime") {
                    echo "selected";
                  } ?> value="departureDateTime">
                    Departure Date
                  </option>
                  <option <?php if ($sort == "arrivalDateTime") {
                    echo "selected";
                  } ?> value="arrivalDateTime">
                    Arrival Date
                  </option>
                  <option <?php if ($sort == "flightDurationMinutes") {
                    echo "selected";
                  } ?> value="flightDurationMinutes">
                    Duration
                  </option>
                </select>
              </div>

              <div class="col-12 col-md-3 mb-3">
                <label for="order" class="form-label" style="font-size: 1.5rem; font-weight: bold;">Order</label>
                <select id="order" name="order" class="form-select">
                  <option <?php if ($order == "ASC") {
                    echo "selected";
                  } ?> value="ASC">Ascending</option>
                  <option <?php if ($order == "DESC") {
                    echo "selected";
                  } ?> value="DESC">Descending</option>
                </select>
              </div>

              <div class="col-12 text-center mt-4">
                <button class="btn btn-primary" style="width: fit-content">Submit</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="row my-5">
      <div class="col-12">
        <div class="card p-4 rounded-5">
          <h1 class="text-center mb-4 bg-dark text-white p-3">
            Flight Logs
          </h1>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col" class="text-center">Flight Number</th>
                  <th scope="col" class="text-center">Departure Airport</th>
                  <th scope="col" class="text-center">Arrival Airport</th>
                  <th scope="col" class="text-center">Departure Date</th>
                  <th scope="col" class="text-center">Arrival Date</th>
                  <th scope="col" class="text-center">Duration (Minutes)</th>
                  <th scope="col" class="text-center">Airline</th>
                  <th scope="col" class="text-center">Aircraft Type</th>
                  <th scope="col" class="text-center">Passengers</th>
                  <th scope="col" class="text-center">Ticket Price</th>
                  <th scope="col" class="text-center">Pilot</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (mysqli_num_rows($flightLogsResults) > 0) {
                  while ($flightsrow = mysqli_fetch_assoc($flightLogsResults)) {
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $flightsrow['flightNumber']; ?></td>
                      <td class="text-center"><?php echo $flightsrow['departureAirportCode']; ?></td>
                      <td class="text-center"><?php echo $flightsrow['arrivalAirportCode']; ?></td>
                      <td class="text-center"><?php echo $flightsrow['departureDateTime']; ?></td>
                      <td class="text-center"><?php echo date('Y-m-d', strtotime($flightsrow['arrivalDateTime'])); ?></td>
                      <td class="text-center"><?php echo $flightsrow['flightDurationMinutes']; ?></td>
                      <td class="text-center"><?php echo $flightsrow['airlineName']; ?></td>
                      <td class="text-center"><?php echo $flightsrow['aircraftType']; ?></td>
                      <td class="text-center"><?php echo $flightsrow['passengerCount']; ?></td>
                      <td class="text-center"><?php echo $flightsrow['ticketPrice']; ?></td>
                      <td class="text-center"><?php echo $flightsrow['pilotName']; ?></td>
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
</body>

</html>