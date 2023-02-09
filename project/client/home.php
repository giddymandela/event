<?php 
// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','royal_event');
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
$conn = mysqli_connect("localhost","root","","royal_event");

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="font-awesome/fontawesome.all.min.css">
    <title>Events Manager</title>
</head>
<body>
   <div class="container">
    <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
            <a class="navbar-brand" href="home.php">EVENTS</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto p-2 mg-4">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link"  data-bs-toggle="modal" data-bs-target="#newbook"href="#">New Booking</a></li>
                        <li class="nav-item"><a class="nav-link" href="view_book.php"><span>My Bookings</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="/pay/"><span>Make payment</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="notification.php"><span>Notification</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php"><span>Log out</span></a></li>
                        <li class="nav-item nav-profile dropdown">
        <?php
        $aid=$_SESSION['odmsaid'];
        $sql="SELECT * from  tbladmin where ID=:aid";
        $query = $dbh -> prepare($sql);
        $query->bindParam(':aid',$aid,PDO::PARAM_STR);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        $cnt=1;
        if($query->rowCount() > 0)
        {
          foreach($results as $row)
          { 
            ?>
            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <div class="nav-profile-img">
                <?php 
                if($row->Photo=="avatar15.jpg")
                { 
                  ?>
                  <img class="img-avatar" src="assets/img/avatars/avatar15.jpg" alt="">
                  <?php 
                } else { 
                  ?>
                  <img class="img-avatar" src="assets/img/profileimages/<?php  echo $row->Photo;?>" alt=""> 
                  <?php 
                } ?>
              </div>
              <div class="nav-profile-text ">
                <p class="mb-1 text-dark"><?php  echo $row->FirstName;?> <?php  echo $row->LastName;?></p>
              </div>
            </a>
            <?php
          }
        } ?>

        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="profile.php">
            <i class="mdi mdi-account mr-2 text-success"></i> Profile </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="change_password.php"><i class="mdi mdi-key mr-2 text-success"></i> Change Password </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logout.php">
              <i class="mdi mdi-logout mr-2 text-danger"></i> Signout </a>
            </div>
          </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- end nav -->
        <!-- content -->
        <!-- Carousel wrapper -->
        <div id="carouselMultiItemExample" class="carousel slide carousel-dark text-center" data-mdb-ride="carousel">
        <!-- Controls -->
        
        <!-- Inner -->
        <div class="carousel-inner py-4">
            <!-- Single item -->
            <div class="carousel-item active">
            <div class="container">
                <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                    <img
                        src="https://mdbcdn.b-cdn.net/img/new/standard/nature/181.webp"
                        class="card-img-top"
                        alt="Waterfall"
                    />
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">
                        Some quick example text to build on the card title and make up the bulk
                        of the card's content.
                        </p>
                        <a href="#!" class="btn btn-primary">Button</a>
                    </div>
                    </div>
                </div>

                <div class="col-lg-4 d-none d-lg-block">
                    <div class="card">
                    <img
                        src="https://mdbcdn.b-cdn.net/img/new/standard/nature/182.webp"
                        class="card-img-top"
                        alt="Sunset Over the Sea"
                    />
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">
                        Some quick example text to build on the card title and make up the bulk
                        of the card's content.
                        </p>
                        <a href="#!" class="btn btn-primary">Button</a>
                    </div>
                    </div>
                </div>

                <div class="col-lg-4 d-none d-lg-block">
                    <div class="card">
                    <img
                        src="https://mdbcdn.b-cdn.net/img/new/standard/nature/183.webp"
                        class="card-img-top"
                        alt="Sunset over the Sea"
                    />
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">
                        Some quick example text to build on the card title and make up the bulk
                        of the card's content.
                        </p>
                        <a href="#!" class="btn btn-primary">Button</a>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>

            
        </div>
        <!-- Inner -->
        </div>
        <!-- Carousel wrapper -->
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
                          <select type="text" class="form-control" name="est" required="true">
                            <option value="">Select Starting Time</option>
                            <option value="1 a.m">1 a.m</option>
                            <option value="2 a.m">2 a.m</option>
                            <option value="3 a.m">3 a.m</option>
                            <option value="4 a.m">4 a.m</option>
                            <option value="5 a.m">5 a.m</option>
                            <option value="6 a.m">6 a.m</option>
                            <option value="7 a.m">7 a.m</option>
                            <option value="8 a.m">8 a.m"</option>
                            <option value="9 a.m">9 a.m</option>
                            <option value="10 a.m">10 a.m</option>
                            <option value="11 a.m">11 a.m</option>
                            <option value="12 p.m">12 p.m</option>
                            <option value="1 p.m">1 p.m</option>
                            <option value="2 p.m">2 p.m</option>
                            <option value="3 p.m">3 p.m</option>
                            <option value="4 p.m">4 p.m</option>
                            <option value="5 p.m">5 p.m</option>
                            <option value="6 p.m">6 p.m</option>
                            <option value="7 p.m">7 p.m</option>
                            <option value="8 p.m">8 p.m</option>
                            <option value="9 p.m">9 p.m</option>
                            <option value="10 p.m">10 p.m</option>
                            <option value="10 p.m">10 p.m</option>
                            <option value="12 a.m">12 a.m</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6"> 
                        <div class="form-group">
                          <label class="label" for="email">Event Finish Time</label>
                          <select type="text" class="form-control" name="eetime" required="true">
                            <option value="">Select Finish Time</option>
                            <option value="1 a.m">1 a.m</option>
                            <option value="2 a.m">2 a.m</option>
                            <option value="3 a.m">3 a.m</option>
                            <option value="4 a.m">4 a.m</option>
                            <option value="5 a.m">5 a.m</option>
                            <option value="6 a.m">6 a.m</option>
                            <option value="7 a.m">7 a.m</option>
                            <option value="8 a.m">8 a.m"</option>
                            <option value="9 a.m">9 a.m</option>
                            <option value="10 a.m">10 a.m</option>
                            <option value="11 a.m">11 a.m</option>
                            <option value="12 p.m">12 p.m</option>
                            <option value="1 p.m">1 p.m</option>
                            <option value="2 p.m">2 p.m</option>
                            <option value="3 p.m">3 p.m</option>
                            <option value="4 p.m">4 p.m</option>
                            <option value="5 p.m">5 p.m</option>
                            <option value="6 p.m">6 p.m</option>
                            <option value="7 p.m">7 p.m</option>
                            <option value="8 p.m">8 p.m</option>
                            <option value="9 p.m">9 p.m</option>
                            <option value="10 p.m">10 p.m</option>
                            <option value="10 p.m">10 p.m</option>
                            <option value="12 a.m">12 a.m</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="label" for="name">Venue Address</label>
                          <input type="text" class="form-control" name="address" id="address" placeholder="venue address">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="label" for="subject">Type of Event:</label>
                          <select type="text" class="form-control" name="eventtype" required="true" >
                            <option value="">Choose Event Type</option>
                            <?php 

                            $sql2 = "SELECT * from   tbleventtype ";
                            $query2 = $dbh -> prepare($sql2);
                            $query2->execute();
                            $result2=$query2->fetchAll(PDO::FETCH_OBJ);

                            foreach($result2 as $row)
                            {          
                              ?>  
                              <option value="<?php echo htmlentities($row->EventType);?>"><?php echo htmlentities($row->EventType);?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="label" for="#">Additional Information</label>
                          <textarea name="info" class="form-control" id="info" cols="30" rows="4" placeholder=""></textarea>
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


        <script src="bootstrap\js\bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
</body>
</html>