<?php

  //=============================================================================
  // Use this script to test recommendations, and add random ratings for a user!
  //=============================================================================

  require('helper/functions.php');
  require './OpenSlopeOne.php';

  $openslopeone = new OpenSlopeOne();
  $openslopeone->initSlopeOneTable('MySQL');

  // var_dump($openslopeone->getRecommendedItemsById(345));
  // var_dump($openslopeone->getRecommendedItemsById(9527));
  // var_dump($openslopeone->getRecommendedItemsByUser('mandy@sfu.ca', 10));

  $email = 'buinhatminh1995@gmail.com';

  $all_shows = shows_list($db);
  // print_r(shows_list($db));

  // For each show, randomly generate a rating out of 10 and insert into database
  // Ratings adjusted for database: 0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1.0
  foreach ($all_shows as $show) {
      $query = 'INSERT INTO `oso_user_ratings`(`email`, `show_id`, `rating`) VALUES '
             . '(\''
             . $email
             . '\''
             . ', '
             . $show
             . ', ROUND((CEILING(RAND()*10))/10, 1))';
      // $results = $db->query($query);
  }

  echo $query;

?>
