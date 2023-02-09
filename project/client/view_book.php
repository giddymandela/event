<?php
  error_reporting(0);
    // Username is root
    $user = 'root';
    //root has no password
    $password = '';
    // Database name is geeksforgeeks
    $database = 'royal_event';
    // Server is localhost 
    $servername='localhost';
    //connection code
    $mysqli = new mysqli($servername, $user, $password, $database);
    
    // Checking for connections
    if ($mysqli->connect_error) {
        die('Connect Error (' .
        $mysqli->connect_errno . ') '.
        $mysqli->connect_error);
    }
  $user = $_SESSION['login'];
    
    
    // SQL query to select data from database
    $sql = " SELECT * FROM booking where username=$user";
    $result = $mysqli->query($sql);

    //sql query to delete data from database
    
    //close connection
    $mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
     <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
            <a class="navbar-brand" href="home.php">EVENTS MANAGER</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto p-2 mg-4">
                        <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link"  data-bs-toggle="modal" data-bs-target="#newbook"href="#">New Booking</a></li>
                        <li class="nav-item"><a class="nav-link" href="view_book.php"><span>My Bookings</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="#"><span>Notification</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php"><span>Log out</span></a></li>
                    </ul>
                </div>
            </div>
        </nav>
     <!-- end nav -->
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                My bookings
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm" id="myData">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Event Date</th>
                            <th>Event Start Time</th>
                            <th>Event Ending Time</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- PHP CODE TO FETCH DATA FROM ROWS -->
                        <?php
                        // LOOP TILL END OF DATA
                        $count = 1;
                        while($rows=$result->fetch_assoc())
                        {
                        ?>
                        <tr>
                            <!-- FETCHING DATA FROM EACH ROW OF EVERY COLUMN -->
                            <td><?php echo $count;?></td>
                            <td><?php echo $rows['FullName'];?></td>
                            <td><?php echo $rows['Email'];?></td>
                            <td><?php echo $rows['Contact'];?></td>
                            <td><?php echo $rows['EventDate'];?></td>
                            <td><?php echo $rows['EventStartTime'];?></td>
                            <td><?php echo $rows['EventEndingTime'];?></td>
                            <td class="text-center">
                               <p>Pending</p>
                            </td>
                        </tr>
                        <?php
                        $count++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                
            </div>
        </div>
    </div>


<!-- The add booking Modal -->
<div class="modal" id="newbook">
            <div class="modal-dialog modal-dialog-scrollable">
              <div class="modal-content">
                  <!-- Add modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Book an Event</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <!-- Add Modal body -->
                  <div class="modal-body">
                      <form action="book.php" method="post" class="mx-1 mx-md-6">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="label" for="name">Full Name</label>
                          <input type="text" class="form-control" name="name" id="FullName" placeholder="Name">
                        </div>
                      </div>
                      <div class="col-md-6"> 
                        <div class="form-group">
                          <label class="label" for="email">Email Address</label>
                          <input type="email" class="form-control" name="email" id="Email" placeholder="Email">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="label" for="name">Contact No</label>
                          <input type="text" class="form-control" name="contact" id="Contact" placeholder="contact">
                        </div>
                      </div>
                      <div class="col-md-6"> 
                        <div class="form-group">
                          <label class="label" for="email">Event Date</label>
                          <input type="date" class="form-control" name="eventdate" id="EventDate" placeholder="">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="label" for="name">Event Starting Time</label>
                          <input type="time" class="form-control" name="EventStartTime">
                        </div>
                      </div>
                      <div class="col-md-6"> 
                        <div class="form-group">
                          <label class="label" for="email">Event Finish Time</label>
                          <input type="time" class="form-control" name="EventEndingTime">
                        </div>
                      </div>
                          <div class="d-flex flex-row align-items-center">
                              <div class="form-outline flex-fill mb-0 p-4">
                                    <button class="btn btn-primary btn-sm" type="submit" name="addbooking" >Submit</button>
                                    <button class="btn btn-danger btn-sm" type="button" data-bs-dismiss="modal">Cancel</button>                              
                                </div>
                          </div>
                        </form>
                  </div>
                  <!-- Add Modal footer -->
                  <div class="modal-footer">
                
                  </div>
              </div>
            </div>
        </div>
        <!-- end add booking modal -->

</body>
</html>


