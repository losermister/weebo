<?php

  session_start();

  /*
   *  The show_id of the show to feature on the homepage
   */
  static $featured_show_id = 17;

  /*
   *  The number of avatars users can pick from
   *  The avatars are named 'avatar/avatar-#.png'
   */
  static $num_of_avatars = 4;

  /*
   *  The number of shows to display per page in Browse
   *  6 shows per row
   */
  static $items_per_page = 18;

?>
