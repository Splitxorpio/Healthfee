<?php 
    include 'db.php';
    
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
      // echo $id;
      if (isset($_POST['review'])) {
        $review = $_POST['review'];
        $insertQuery = "INSERT INTO reviews (review, hospital) VALUES ('$review', '$id')";
      
        mysqli_query($conn, $insertQuery);
    }
      $myArrayHospital = array();
      if ($resultHospital = $conn->query("SELECT * FROM hospitals WHERE `id` = $id")) {
        while ($row = $resultHospital->fetch_array(MYSQLI_ASSOC)) {
          $myArrayHospital[] = $row;
        }
      }

      $myArrayReviews = array();
      if ($resultReviews = $conn->query("SELECT * FROM reviews WHERE `hospital` = $id")) {
        while ($row = $resultReviews->fetch_array(MYSQLI_ASSOC)) {
          $myArrayReviews[] = $row;
        }
      }

      $hospitalResult = $myArrayHospital[0];
      $reviewsResult = $myArrayReviews;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthFee</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="review.css">
</head>

<body>
    <ul>
        <div>
            <a href="index.php">
                <img style="height: 75px; width: 75px;" src="../images/logo.png">
            </a>
        </div >
        <div class="nav_link">
            
        </div>
    </ul>
    
    <div class="review">
        <div class="review_header_info">
            <h1 class="hospital_disc"><?php echo $hospitalResult['hospital_name'] ?></h1>
            <p><?php echo $hospitalResult['location'] ?></p>

            <span>Reviews: <?php echo count($reviewsResult) ?></span>

        </div>
        <hr>
        <div class="review_list_container">
            
            <?php foreach ($reviewsResult as $review){  ?>
                <div class="review_list">
                    <p><?php echo $review['review'] ?></p>
                </div>
            <?php } ?>
        </div>
        
        <div class="add_input">
            <form action="review.php?id=<?php echo $hospitalResult['id'] ?>" method="POST" autocomplete="off">
                <textarea placeholder="Add Review" name="review" ></textarea>

                <button type="submit">Add</button>
            </form>
        </div>

    </div>
</body>

</html>