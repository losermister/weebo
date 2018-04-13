<?php

  require('helper/variables.php');

  /*
   *  Trigger SSL communication by turning HTTP request to HTTPS request
   */
  function require_ssl() {
    if($_SERVER["HTTPS"] != "on") {
      header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
      exit();
    }
  }

  /*
   *  Switch back to HTTP from HTTPS
   */
  function use_http() {
    if(isset($_SERVER["HTTPS"]) && strtolower($_SERVER["HTTPS"]) == "on") {
      header("Location: http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
      exit();
    }
  }

  /*
   *  Connect to database
   *  @param   string  $dbhost  Server address
   *  @param   string  $dbuser  Username in MySQL
   *  @param   string  $dbpass  Password in MySQL
   *  @param   string  $dbname  Database name
   *  @return  mysqli
   */
  $db = connect_to_db('localhost', 'root', '', 'anime');
  function connect_to_db($dbhost, $dbuser, $dbpass, $dbname) {
    @$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    $connection->set_charset("utf8");
    // Check database connection
    if ($connection->connect_errno) {
      printf("Database connection failed: %s\n", $connection->connect_error);
      exit();
    }
    return $connection;
  }

  /*
   *  HTML to display a user's profile details
   *  @param   string  $username      User's display name
   *  @param   string  $email        User's email address
   *  @param   string  $fav_genre    User's selected favourite genre
   *  @param   string  $profile_img  Path to user's chosen avatar
   */
  function display_user_profile($username, $email, $fav_genre, $profile_img) {
    echo "<div class='col-3of12'>";
    echo "<div class='info'>";
    echo "<img class='img-center profile-img' src='$profile_img'>";
    echo "<h2 class='text-center username-text'>$username</h2>";
    echo "<h4>email:</h4>";
    echo "<p>$email</p>";
    echo "<h4>favourite genre:</h4>";
    echo "<p> $fav_genre</p>";
    echo "</div>";
    echo "</div>";
  }

  /*
   *  HTML to display a user's recent activity on their profile
   *  @param   string  $username     User's display name
   *  @param   string  $video_url    The video link of any comments the user made
   *  @param   string  $rating       The rating given to any shows the user rated
   *  @param   string  $dated_added  The date and time of the activity
   *  @param   int     $show_id      The show_id of the show interacted with (comment or rating)
   *  @param   mysqli  $db           Connection between PHP and MySQL database
   */
  function display_user_activity($username, $video_url, $rating, $date_added, $show_id, $db) {
    echo "<div class='col-2of12' id='test-list'>";
    if ($video_url == '') {
      echo "<p>$date_added</p>";
      echo "<p>$username rated <a href='show.php?id=$show_id'>" . showname_from_id($show_id, $db) . "</a> " . number_format($rating * 10) . "/10.</p>";
    } else {
      echo "<p>$date_added</p>";
      $episode_num = episode_num_from_video_url($video_url, $db);
      echo "<p>$username commented on <a href='watch.php?show=$show_id&ep=$episode_num'>" . show_name_and_episode_num_from_video_url($video_url, $db) ."</a>.</p>";
    }
    echo "</div>";
  }

  /*
   *  Get a show's name and episode formatted as 'Show Name - Episode #'
   *  @param   string  $video_url  The video URL of the episode
   *  @param   mysqli  $db         Connection between PHP and MySQL database
   */
  function show_name_and_episode_num_from_video_url($video_url, $db) {
    $query = "SELECT name, episode_num FROM shows "
           . "INNER JOIN links ON shows.show_id = links.show_id "
           . "WHERE links.video_url = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $video_url);
    $stmt->execute();
    $stmt->bind_result($show_name, $episode_num);
    $stmt->fetch();
    $stmt->free_result();
    $stmt->close();
    return $show_name . ' - Episode ' . $episode_num;
  }

  /*
   *  Get the episode number from a video URL
   *  @param   string  $video_url  The video URL of the episode
   *  @param   mysqli  $db         Connection between PHP and MySQL database
   */
  function episode_num_from_video_url($video_url, $db) {
    $query = "SELECT episode_num FROM shows "
           . "INNER JOIN links ON shows.show_id = links.show_id "
           . "WHERE links.video_url = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $video_url);
    $stmt->execute();
    $stmt->bind_result($episode_num);
    $stmt->fetch();
    $stmt->free_result();
    $stmt->close();
    return $episode_num;
  }

  /*
   *  Create form and fieldset tags, add legend
   *  @param  string  $url   URL to send the form data to after submission
   *  @param  string  $text  Text to display in legend
   */
  function form_start($url, $text) {
    echo "<div class='small-container'>";
    echo "<form action=\"$url\" method=\"post\">";
    echo "<fieldset>";
    echo "<legend>$text</legend>";
  }

  /*
   *  Create a text input field
   *  @param  string  $varname  Name attribute of the input element
   *  @param  string  $label    Text to display
   */
  function add_textfield($varname, $label) {
    // If form was submitted, save inputted data and display again
    if (isset($_POST[$varname])) {
      $inputted_text = trim($_POST[$varname]);
    } else {
      $inputted_text = '';
    }
    echo "<label for =\"$varname\">$label</label>";
    // If the textfield is for passwords, use the password input type to ensure typed characters are masked
    if (strpos($varname, 'password') !== false) {
      echo "<input type =\"password\" placeholder=\"$label\" name=\"$varname\" id=\"$varname\" value=\"$inputted_text\">";
    } else {
      echo "<input type =\"text\" placeholder=\"$label\" name=\"$varname\" id=\"$varname\" value=\"$inputted_text\">";
    }
  }

  /*
   *  Create a group of radio buttons
   *  @param  string  $varname  Name attribute of the input element
   *  @param  array   $options  Values/ids of each option
   */
  function add_radio_buttons($varname, $options) {
  	echo "<label for =\"$varname\">$varname</label>";
    $i = 0;
    foreach ($options as $opt) {
      add_radio_options($varname, $opt, $i);
      $i++;
    }
  }

  /*
   *  Create a page navigation for pagination
   *  @param  int     $current_page  The current page that the user is on
   *  @param  int     $pages         Total number of pages to show
   *  @param  string  $idname        Optional id for the form element
   */
  function add_page_nav($current_page, $pages, $idname='') {
    echo "<form class='row browse-form page-form' id=$idname>";
    for ($i = 1; $i <= $pages; $i++) {
      echo "<label class='pagination'><input id='filter-page' type='radio' name='page' value='$i' ";
      if ($i == $current_page) {
        echo "checked";
      }
      echo "><span>$i</span></label>";
    }
    echo "</form>";
  }

  /*
   *  Create each radio button
   *  @param  string  $varname  Name attribute of the input element
   *  @param  array   $opt      Values/ids of each option
   *  @param  int     $i        Index of each option
   */
  function add_radio_options($varname, $opt, $i) {
  	echo "<div class='col-3of12'>";
    echo "<label class='avatar-style' for='$opt'><img class='img-responsive' src='avatar/" . $opt . ".png'/></label>";
    echo "<input type='radio' value='$opt' name='$varname' id='$opt' ";
    if ($i == 0) echo "checked";
    echo "/>";
    echo"</div>";
  }

  /*
   *  Create a dropdown menu for text
   *  @param  string   $label    Label text to display
   *  @param  string   $varname  Name attribute of the input element
   *  @param  array    $options  Values of each option
   *  @param  array    $texts    Text to display for each option
   */
  function add_dropdown($label, $varname, $options, $texts) {
    global $$varname;
    echo "<label>$label</label>";
    echo "<div class='dropdown'>";
    echo "<select name='$varname' id='$varname'>";

    $i = 0;
    foreach ($options as $opt)
      add_dropdown_options($texts[$i++], $varname, $opt);

    echo "</select>";
    echo "<span class='fas fa-caret-down'></span>";
    echo "</div>";
  }

  /*
   *  Create a dropdown menu for text, to be used as a filter in Browse
   *  @param  string   $label    Label text to display
   *  @param  string   $varname  Name attribute of the input element
   *  @param  array    $options  Values of each option
   *  @param  array    $texts    Text to display for each option
   */
  function add_dropdown_filter($label, $varname, $options, $texts) {
    global $$varname;
    echo "<div class='dropdown-filter'>";
    echo "<select name='$varname' id='$varname'>";
    echo "<option value = 'All'" ;
    echo ">$label</option>";

    $i = 0;
    foreach ($options as $opt)
      add_dropdown_options($texts[$i++], $varname, $opt);

    echo "</select>";
    echo "<span class='fas fa-caret-down'></span>";
    echo "</div>";
  }


  /*
   *  Create each option for the text or filter dropdown
   *  @param  string  $text     Text to display for each option
   *  @param  string  $varname  Name attribute of the input element
   *  @param  string  $opt      Value of each option
   */
  function add_dropdown_options($text, $varname, $opt) {
    global $$varname;
    echo "<option value = '$opt'" ;
    if ($opt == $$varname) echo "selected";
    echo ">$text</option>";
  }

  /*
   *  Create a dropdown menu for a range of numbers
   *  @param  string  $varname  Name attribute of the input element
   *  @param  int     $min      Lowest value to choose from
   *  @param  int     $max      Highest value to choose from
   */
  function add_dropdown_num_range($varname, $min, $max) {
    global $$varname;
    if (isset($_POST['rating'])) $rating = $_POST['rating']; else $rating = '';
    echo "<select name = '$varname'>";
    echo "<option value = '' disabled selected>Rate out of 10</option>";
    for ($i = $min; $i <= $max; $i++) {
      add_dropdown_num_range_options($i, $varname);
    }
    echo "</select>";
  }

  /*
   *  Create each option for the number range dropdown
   *  @param  int     $i        Index of each option in the range
   *  @param  string  $varname  Name attribute of the input element
   */
  function add_dropdown_num_range_options($i, $varname) {
    global $$varname;
    $fraction = $i / 10;
    echo "<option value ='$fraction' ";
    if ($$varname == $fraction) echo "selected";
    echo ">$i</option>";
  }

  /*
   *  Add a checklist and labels
   *  @param  string  $varname  Name attribute of the input elements
   *  @param  array   $options  List of value attributes for each option
   *  @param  array   $texts    List of label names to display
   */
  function add_checklist($varname, $options, $texts) {
    global $$varname;
    $i = 0;
    foreach($options as $opt)
      add_checklist_options($texts[$i++], $varname, $opt);
  }

  /*
   *  Add options to checklist
   *  @param  string  $text     Text to display as labels
   *  @param  string  $varname  Name attribute of inputs
   *  @param  string  $opt      Value attributes for each option
   */
  function add_checklist_options($text, $varname, $opt) {
    global $$varname;
    echo "<label class='checkbox'><input type=\"checkbox\" name=\"$varname\" value=\"$opt\" id='filter-by-multi-genre'><span class=\"check\"></span>$text</label>";
  }

  /*
   *  Add a radio button list and labels
   *  @param  string  $varname  Name attribute of the input elements
   *  @param  array   $options  List of value attributes for each option
   *  @param  array   $texts    List of label names to display
   */
  function add_radiolist($varname, $options, $texts) {
    global $$varname;
    echo "<label class='checkbox'><input type=\"radio\" name=\"$varname\" value=\"All\" id='filter-by-status'><span class=\"check\"></span>All</label>";
    $i = 0;
    foreach($options as $opt)
      add_radiolist_options($texts[$i++], $varname, $opt);
  }

  /*
   *  Add options to a radio button list
   *  @param  string  $text     Text to display as labels
   *  @param  string  $varname  Name attribute of inputs
   *  @param  string  $opt      Value attributes for each option
   */
  function add_radiolist_options($text, $varname, $opt) {
    global $$varname;
    echo "<label class='checkbox'><input type=\"radio\" name=\"$varname\" value=\"$opt\" id='filter-by-status'><span class=\"check\"></span>$text</label>";
  }

  /*
   *  Create a hidden textfield with generic name to catch spam bots
   *  @param  string  $varname  Name attribute of the input element
   *  @param  string  $label    Placeholder text
   */
  function add_honeypot_textfield($varname, $label) {
    // If form was submitted, save inputted data and display again
    if (isset($_POST[$varname])) {
      $inputted_text = trim($_POST[$varname]);
    } else {
      $inputted_text = '';
    }
    // If the textfield is for passwords, use the password input type to ensure typed characters are masked
    if (strpos($varname, 'password') !== false) {
      echo "<input style=\"display: none\" autocomplete=\"off\" placeholder=\"$label\" type =\"password\" name=\"$varname\" id=\"$varname\" value=\"$inputted_text\">";
    } else {
      echo "<input style=\"display: none\" autocomplete=\"off\" type =\"text\" placeholder=\"$varname\" name=\"$varname\" id=\"$varname\" value=\"$inputted_text\">";
    }
  }

  /*
   *  Check if the hidden text field was filled out
   *  @param   string   $input  Input from the honeypot text field
   *  @return  boolean
   */
  function honeypot_caught($input) {
    // Check if that the variable has a value
    if ((!isset($input)) || ($input == '')) {
      return false;
    }
    return true;
  }

  /*
   *  Close fieldset and form tags, add submit button
   *  @param  string  $button_text  Text to display on submit button
   */
  function form_end($button_text) {
    echo "</fieldset>";
    echo "<input type=\"submit\" name=\"log in\" value=\"$button_text\">";
    echo "</form>";
    echo "</div>";
  }

  /*
   *  Check if user inputted a valid email address
   *  @param   string  $address  Email address as entered
   *  @return  boolean
   */
  function valid_email($address) {
    if (preg_match("/^[^@]*@[^@]*\.[^@]*$/", $address)) {
      return true;
    } else {
      return false;
    }
  }

  /*
   *  Check if user inputted an email address that's not already in the database
   *  @param   string  $address  Email address as entered
   *  @param   mysqli  $db       Connection between PHP and MySQL database
   *  @return  boolean
   */
  function unique_email($address, $db) {
    $query = "SELECT * "
           . "FROM users "
           . "WHERE email = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $address);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
      echo "Oops! Couldn't execute query.";
    }
    if ($result->num_rows > 0) {
      return false;
    }
    return true;
    $stmt->free_result();
    $stmt->close();
  }

  /*
   *  Check if the user provided a username that meets the character requirements
   *  @param   string   $username  Username as entered
   *  @return  boolean
   */
  function valid_username($username) {
    if (preg_match("/^[ \w]+$/", $username)) {
      return true;
    } else {
      return false;
    }
  }

  /*
   *  Check if user inputted a username that's not already in the database
   *  @param   string  $username  Username as entered
   *  @param   mysqli  $db        Connection between PHP and MySQL database
   *  @return  boolean
   */
  function unique_username($username, $db) {
    $query = "SELECT * "
           . "FROM users "
           . "WHERE user_id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
      echo "Oops! Couldn't execute query.";
    }
    if ($result->num_rows > 0) {
      return false;
    }
    return true;
    $stmt->free_result();
    $stmt->close();
  }

  /*
   *  Check if user inputted a password meets the strength requirements
   *  @param   string  $password  Password as entered
   *  @return  boolean
   */
  function strong_password($password) {
    // Check if password contains at least 1 uppercase letter, 1 lowercase letter, and 1 number
    $uppercase = preg_match("@[A-Z]@", $password);
    $lowercase = preg_match("@[a-z]@", $password);
    $number    = preg_match("@[0-9]@", $password);
    if ($uppercase && $lowercase && $number) {
      return true;
    } else {
      return false;
    }
  }

  /*
   *  Check if all the registration data entered meets the checks
   *  @param   string   $honeypot   Any text entered in the hidden input field
   *  @param   string   $email      Email address as entered
   *  @param   string   $username   Username as entered
   *  @param   string   $fav_genre  User's favourite genre as entered
   *  @param   string   $password   Password  as entered
   *  @param   string   $password2  Password (again) as entered
   *  @param   mysqli   $db         Connection between PHP and MySQL database
   *  @return  boolean
   */
  function registration_data_valid($honeypot, $email, $username, $fav_genre, $password, $password2, $db) {
    if (!honeypot_caught($honeypot) &&
        unique_email($email, $db) && valid_email($email) &&
        unique_username($username, $db) && valid_username($username, $db) && !((strlen($username) < 3) || (strlen($username) > 24)) &&
        ($password == $password2) && !((strlen($password) < 6) || (strlen($password) > 16)) && strong_password($password)) {
      return true;
    } else {
      return false;
    }
  }

  /*
   *  Check if all the user's updated profile data entered meets the checks
   *  @param   string   $username   Username as entered
   *  @param   string   $fav_genre  User's favourite genre as entered
   *  @param   string   $password   Password  as entered
   *  @param   string   $password2  Password (again) as entered
   *  @param   mysqli   $db         Connection between PHP and MySQL database
   *  @return  boolean
   */
  function updated_user_data_valid($username, $fav_genre, $password, $password2, $db) {
    if (unique_username($username, $db) && valid_username($username, $db) && !((strlen($username) < 3) || (strlen($username) > 24)) &&
        ($password == $password2) && !((strlen($password) < 6) || (strlen($password) > 16)) && strong_password($password)) {
      return true;
    } else {
      return false;
    }
  }

  /*
   *  Update a user's profile information in the DB
   *  @param   string   $email      User's email (can't be changed)
   *  @param   string   $username   User's new display name
   *  @param   string   $password   User's new password
   *  @param   string   $fav_genre  User's favourite genre as entered
   *  @param   string   $password   Path to user's new avatar
   *  @param   mysqli   $db         Connection between PHP and MySQL database
   */
  function update_profile($email, $username, $password, $fav_genre, $profile_img, $db) {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $profile_img = 'avatar/' . $profile_img . '.png';
    $query = "UPDATE users "
           . "SET user_id = ?, hashed_password = ?, fav_genre = ?, profile_img = ? "
           . "WHERE email = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('sssss', $username, $password, $fav_genre, $profile_img, $email);
    $stmt->execute();
    $stmt->free_result();
    $stmt->close();
  }

  function update_rating($email, $show_id, $rating, $db) {
    $query = "INSERT INTO oso_user_ratings(email, show_id, rating, date_added) "
             . "VALUES (?, ?, ?, NOW()) "
             . "ON DUPLICATE KEY UPDATE rating = ?";
    $stmt = $db->prepare($query);
    if ( !$stmt ) {
      printf('errno: %d, error: %s', $db->errno, $db->error);
      die;
    }
    $stmt->bind_param('sidd', $email, $show_id, $rating, $rating);
    $stmt->execute();
    $stmt->store_result();
    $stmt->free_result();
    $stmt->close();
  }

  /*
   *  Add a new account to the database
   *  @param  string  $firstname  First name address as entered
   *  @param  string  $lastname   Last name as entered
   *  @param  string  $email      Email address as entered
   *  @param  string  $password   Password as entered
   *  @param  mysqli  $db         Connection between PHP and MySQL database
   */
  function register($email, $username, $password, $fav_genre, $profile_img, $db) {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $profile_img = 'avatar/' . $profile_img . '.png';
    $query = "INSERT INTO users VALUES "
           . "(?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('sssss', $email, $username, $password, $fav_genre, $profile_img);
    $stmt->execute();
    $stmt->free_result();
    $stmt->close();
  }

  function get_num_favourites($db) {
    $email = $_SESSION['valid_user'];
    $query = "SELECT * "
           . "FROM favourite_shows "
           . "WHERE email = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
      echo "Oops! Couldn't execute query.";
    }
    $stmt->free_result();
    $stmt->close();
    return $result->num_rows;
  }

  function in_favourites_list($email, $show_id, $db) {
    $query = "SELECT * "
           . "FROM favourite_shows "
           . "WHERE favourite_shows.email = '$email' "
           . "AND favourite_shows.show_id = $show_id";
    $results = $db->query($query);

    if ($results->num_rows > 0) {
      return true;
    } else {
      return false;
    }
    $results->free_result();
  }

  function add_to_favourites($email, $show_id, $db) {
    $query = "INSERT INTO favourite_shows VALUES "
           . "(?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('si', $email, $show_id);
    $stmt->execute();
    $stmt->free_result();
    $stmt->close();
  }

  function remove_from_favourites($email, $show_id, $db) {
    $query = "DELETE FROM favourite_shows "
           . "WHERE favourite_shows.email = ? AND favourite_shows.show_id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('si', $email, $show_id);
    $stmt->execute();
    $stmt->free_result();
    $stmt->close();
  }

  function display_notification_success($text) {
    echo "
      <div class='notify-msg-container'>
        <span class='notify-text-success'>"
          . $text .
        "</span>
      </div>
    ";
  }

  function display_notification_error($text) {
    echo "
      <div class='notify-msg-container'>
        <span class='notify-text-error'>"
          . $text .
        "</span>
      </div>
    ";
  }

  function usernames_list($db) {
    $query = "SELECT users.user_id "
           . "FROM users "
           . "ORDER BY users.user_id";
    $results = $db->query($query);

    if (!$results) {
      die("Couldn't get usernames: Database query failed.");
    }

    while($row = $results->fetch_assoc()) {
      $usernames[] = $row["user_id"];
    }
    $results->free_result();
    return $usernames;
  }

  function check_username_list($username, $db) {
    if (in_array($username, usernames_list($db))) {
      return true;
    } else {
      return false;
    }
  }

  function shows_list($db) {
    $query = "SELECT shows.show_id "
           . "FROM shows "
           . "ORDER BY shows.show_id";
    $results = $db->query($query);

    if (!$results) {
      die("Couldn't get show IDs: Database query failed.");
    }

    while($row = $results->fetch_assoc()) {
      $shows[] = $row["show_id"];
    }
    $results->free_result();
    return $shows;
  }

  function episodes_list($show_id, $db) {
    $query = "SELECT DISTINCT episode_num "
           . "FROM links "
           . "LEFT JOIN shows ON links.show_id = shows.show_id "
           . "WHERE links.show_id = $show_id "
           . "ORDER BY episode_num ASC";
    $results = $db->query($query);

    if (!$results) {
      die("Couldn't get episodes list: Database query failed.");
    }

    while($row = $results->fetch_assoc()) {
      $episodes[] = $row["episode_num"];
    }
    $results->free_result();
    return $episodes;
  }

  function check_episodes_list($episode_num, $show_id, $db) {
    if (in_array($episode_num, episodes_list($show_id, $db))) {
      return true;
    } else {
      return false;
    }
  }

  function check_shows_list($show_id, $db) {
    if (in_array($show_id, shows_list($db))) {
      return true;
    } else {
      return false;
    }
  }

  function display_search_list($show_id, $show_name, $show_img, $db) {
    // Trim show name if longer than 12 characters, for consistent card sizing
    $show_name = strlen($show_name) > 10 ? substr($show_name, 0, 10)."..." : $show_name;


    echo "
      <a href=\"show.php?id=" . $show_id . "\">" . "

          <div class='show-container fade-in'>
            <div class='redirect'></div>

            <div class='show-img-container'><span class='avgrate' style='$rating_style'>$avg_rating</span><div class='show-img' style='background-image:url($show_img)'></div></div>

            <div class='show-info' data-show-id='$show_id'>
              <div class='show-descript'>
                <span class='show-title'>$show_name</span>

              </div>

            </div>
          </div>

      </a>
    ";
  }


  function display_show_card($avg_rating, $show_id, $show_name, $show_img, $db) {
    // Trim show name if longer than 12 characters, for consistent card sizing
    $show_name = strlen($show_name) > 10 ? substr($show_name, 0, 10)."..." : $show_name;
    // Format average rating to be out of 10 and 2 decimal places
    $avg_rating = number_format($avg_rating * 10, 1);

    $rating_style;
    if (($avg_rating >= 0.0) && ($avg_rating < 5.0)) {
      $rating_style = "background:#ff3a3a;";
    } else if (($avg_rating >= 5.0) && ($avg_rating < 8.0)) {
      $rating_style = "background:#ffc800;";
    } else if (($avg_rating >= 8.0) && ($avg_rating <= 10.0)) {
      $rating_style = "background:#2cb757;";
    }

    echo "
      <a href=\"show.php?id=" . $show_id . "\">" . "
        <div class='col-2of12'>
          <div class='show-container fade-in'>
            <div class='redirect'></div>

            <div class='show-img-container'><span class='avgrate' style='$rating_style'>$avg_rating</span><div class='show-img' style='background-image:url($show_img)'></div></div>

            <div class='show-info' data-show-id='$show_id'>
              <div class='show-descript'>
                <span class='show-title'>$show_name</span>

              </div>
              <div class='functions'>
                <form action='favourites.php' class='save-btn'>";
                  if (isset($_SESSION['valid_user'])) {
                    $email = $_SESSION['valid_user'];
                  } else {
                    $email = '';
                  }

                  if (in_favourites_list($email, $show_id, $db)) {
                    echo "
                      <button type='submit' class='save saved-state' value=''><span class='fas fa-check'></span></button>
                    ";
                  } else {
                    echo "
                      <button type='submit' class='save' value=''><span class='fas fa-heart'></span></button>
                    ";
                  }

                echo "</form>
              </div>
            </div>
          </div>
        </div>
      </a>
    ";
  }

  function display_video_card($show_id, $show_name, $episode_num, $show_img) {
  	$show_name = strlen($show_name) > 20 ? substr($show_name, 0, 20)."..." : $show_name;
    echo "
      <a href=\"watch.php?show=$show_id&ep=$episode_num\">" . "
        <div class='col-2of12'>
          <div class='show-container'>
            <div class='redirect'></div>

            <div class='show-img-container'><div class='show-img' style='background-image:url($show_img)'></div></div>

            <div class='show-info'>
              <div class='show-descript'>
                <span class='show-title'>$show_name</span>
                <span class='show-epi'>Episode $episode_num</span>
              </div>
            </div>
          </div>
        </div>
      </a>
    ";
  }

  function display_show_list($show_id, $show_name, $episode_num, $show_img) {
    // Trim show name if longer than 20 characters, for consistent sizing
    $show_name = strlen($show_name) > 20 ? substr($show_name, 0, 20)."..." : $show_name;
    echo "
      <a href=\"watch.php?show=$show_id&ep=$episode_num\">" . "
        <div class='col-2of12' id='test-list'>
          <div class='show-container''>
            <div class='redirect'></div>
            <div class='show-img-container'><div class='show-img' style='background-image:url($show_img)'></div></div>
            <div class='show-info'>
              <div class='show-descript'>
                <span class='show-title'>$show_name</span>
                <span class='show-title'>Episode $episode_num</span>
              </div>
              <div class='functions'></div>
            </div>
          </div>
        </div>
      </a>
    ";
  }


  function display_upcoming_list($show_id, $show_name, $ep_num, $episode_num, $show_img) {
    // Trim show name if longer than 20 characters, for consistent sizing
    $show_name = strlen($show_name) > 20 ? substr($show_name, 0, 20)."..." : $show_name;

    if($episode_num == $ep_num){
    echo "
      <a href=\"watch.php?show=$show_id&ep=$episode_num\">" . "
        <div class='upcoming-list clicked'>
            <div class='redirect'></div>
            <div class='show-img-container'><div class='show-img' style='background-image:url($show_img)'></div></div>
            <div class='show-info'>
              <div class='show-descript'>
                <span class='show-epi'>Episode $episode_num</span>
                <span class='show-title'>$show_name</span>
              </div>
            </div>
        </div>
      </a>
    ";
  }
  else{
    echo "
      <a href=\"watch.php?show=$show_id&ep=$episode_num\">" . "
        <div class='upcoming-list '>
            <div class='redirect'></div>
            <div class='show-img-container'><div class='show-img' style='background-image:url($show_img)'></div></div>
            <div class='show-info'>
              <div class='show-descript'>
                <span class='show-epi'>Episode $episode_num</span>
                <span class='show-title'>$show_name</span>
              </div>
            </div>
        </div>
      </a>
    ";
  }

  }

  function email_from_username($username, $db) {
    $name_query = "SELECT users.email FROM users WHERE users.user_id = ?";
    $name_stmt = $db->prepare($name_query);
    $name_stmt->bind_param('s', $username);
    $name_stmt->execute();
    $name_stmt->bind_result($email);
    $name_stmt->fetch();
    $name_stmt->free_result();
    $name_stmt->close();
    return $email;
  }

  function username_from_email($db) {
    $email = $_SESSION['valid_user'];
    $name_query = "SELECT users.user_id FROM users WHERE users.email = ?";
    $name_stmt = $db->prepare($name_query);
    $name_stmt->bind_param('s', $email);
    $name_stmt->execute();
    $name_stmt->bind_result($username);
    $name_stmt->fetch();
    $name_stmt->free_result();
    $name_stmt->close();
    return $username;
  }

  function avatar_from_email($db) {
    $email = $_SESSION['valid_user'];
    $name_query = "SELECT users.profile_img FROM users WHERE users.email = ?";
    $name_stmt = $db->prepare($name_query);
    $name_stmt->bind_param('s', $email);
    $name_stmt->execute();
    $name_stmt->bind_result($avatar);
    $name_stmt->fetch();
    $name_stmt->free_result();
    $name_stmt->close();
    return $avatar;
  }

  function showname_from_id($show_id, $db) {
    $name_query = "SELECT shows.name FROM shows WHERE shows.show_id = ?";
    $name_stmt = $db->prepare($name_query);
    $name_stmt->bind_param('i', $show_id);
    $name_stmt->execute();
    $name_stmt->bind_result($showname);
    $name_stmt->fetch();
    $name_stmt->free_result();
    $name_stmt->close();
    return $showname;
  }

  function showid_from_name($show_name, $db) {
    $id_query = "SELECT shows.show_id FROM shows WHERE shows.name = ?";
    $id_stmt = $db->prepare($id_query);
    $id_stmt->bind_param('s', $show_name);
    $id_stmt->execute();
    $id_stmt->bind_result($show_id);
    $id_stmt->fetch();
    $id_stmt->free_result();
    $id_stmt->close();
    return $show_id;
  }

  function showbanner_from_id($show_id, $db) {
    $query = "SELECT shows.banner_img FROM shows WHERE shows.show_id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $show_id);
    $stmt->execute();
    $stmt->bind_result($show_banner_url);
    $stmt->fetch();
    $stmt->free_result();
    $stmt->close();
    return $show_banner_url;
  }

  function genres_list_from_id($show_id, $db) {
    $query = "SELECT genre "
           . "FROM genres "
           . "WHERE show_id = $show_id";
    $results = $db->query($query);

    if (!$results) {
      die("Couldn't get genres list for show: Database query failed.");
    }

    while($row = $results->fetch_assoc()) {
      $genres[] = $row["genre"];
    }

    $results->free_result();
    return $genres;
  }

  function all_years_list($db) {
    $query = "SELECT YEAR(airing_date) as year "
           . "FROM shows "
           . "GROUP BY year "
           . "ORDER BY year DESC";
   $results = $db->query($query);

    if (!$results) {
      die("Couldn't get genres list for show: Database query failed.");
    }

    while($row = $results->fetch_assoc()) {
      $years[] = $row["year"];
    }

    $results->free_result();
    return $years;
  }

  function all_status_list($db) {
    $query = "SELECT DISTINCT status "
           . "FROM shows";
   $results = $db->query($query);

    if (!$results) {
      die("Couldn't get genres list for show: Database query failed.");
    }

    while($row = $results->fetch_assoc()) {
      $statuses[] = $row["status"];
    }

    $results->free_result();
    return $statuses;
  }

  function all_genres_list($db) {
    $query = "SELECT DISTINCT genre FROM genres ORDER BY genre";
    $results = $db->query($query);

    if (!$results) {
      die("Couldn't get genres list for show: Database query failed.");
    }

    while($row = $results->fetch_assoc()) {
      $genres[] = $row["genre"];
    }

    $results->free_result();
    return $genres;
  }

  function avg_show_rating($show_id, $db) {
    $query = "SELECT AVG(rating) as avg_rating "
           . "FROM oso_user_ratings "
           . "WHERE show_id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $show_id);
    $stmt->execute();
    $stmt->bind_result($avg_rating);
    $stmt->fetch();
    $stmt->store_result();
    $stmt->free_result();
    $stmt->close();
    return $avg_rating;
  }

  function rated_shows_list($email, $db) {
    $rated_shows[] = '';
    $query = "SELECT oso_user_ratings.show_id "
           . "FROM oso_user_ratings "
           . "WHERE email = '$email'";
    $results = $db->query($query);

    if (!$results) {
      die("Couldn't get ratings: Database query failed.");
    }

    while($row = $results->fetch_assoc()) {
      $rated_shows[] = $row["show_id"];
    }

    $results->free_result();
    return $rated_shows;
  }

  function remove_already_rated($recs, $email, $db) {
    $new_recs = array();
    foreach ($recs as $rec) {
      if (!in_array($rec, rated_shows_list($email, $db))) {
        array_push($new_recs, $rec);
      }
    }
    return $new_recs;
  }

  function post_comment($email, $video_url, $comment_body, $db) {
    $query = "INSERT INTO comments(email, video_url, comment_body, date_added) "
           . "VALUES (?, ?, ?, NOW())";
    $stmt = $db->prepare($query);
    if ( !$stmt ) {
      printf('errno: %d, error: %s', $db->errno, $db->error);
      die;
    }
    $stmt->bind_param('sss', $email, $video_url, $comment_body);
    $stmt->execute();
    $stmt->store_result();
    $stmt->free_result();
    $stmt->close();
  }

  function get_num_comments($video_url, $db) {
    $query = "SELECT * FROM comments "
           . "WHERE video_url = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $video_url);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
      echo "Oops! Couldn't execute query.";
    }
    $stmt->free_result();
    $stmt->close();
    return $result->num_rows;
  }

  function display_comment($username, $avatar, $comment, $date) {
    echo "
      <div class='col-1of12'>
        <a href='user.php?id=$username'><img src='$avatar'></a>
      </div>
      <div class='col-11of12'>
        <h6><a href='user.php?id=$username'>" . $username . "</a> • $date</h6>
         <p>$comment</p>
      </div>
    ";
  }

  function get_user_rating_for_show($email, $show_id, $db) {
    if (!isset($_SESSION['valid_user'])) {
      echo "<p><a href='login.php'>Log in</a> to rate shows!</p>";
    } else {
      $query = "SELECT rating "
             . "FROM oso_user_ratings "
             . "WHERE email = ? "
             . "AND show_id = ?";
      $stmt = $db->prepare($query);
      $stmt->bind_param('si', $email, $show_id);
      $stmt->execute();
      $stmt->bind_result($rating);
      $stmt->fetch();
      $stmt->free_result();
      $stmt->close();
      if ($rating <= 0) {
        echo '<p>You haven\'t rated this show yet!</p>';
      } else {
        $rating = $rating * 10;
        echo '<p>You last rated this show ' . $rating . '/10</p>';
      }
    }
  }

  function display_featured_show($featured_show_id, $heading, $short_description, $email, $db) {
    $show_name = showname_from_id($featured_show_id, $db);
    $banner_img = showbanner_from_id($featured_show_id, $db);
    echo
      "<div class='banner-container'>
        <div class='text-container'>
          <div class='banner-text'>
            <div class='col-12of12'>
              <span>staff pick</span>
            </div>
          </div>
          <div class='banner-details'>
            <div class='col-6of12'>
              <h2 data-show-id=$featured_show_id>$show_name</h2>
              <p>$short_description</p>
              <a href='show.php?id=$featured_show_id' class='btn btn-primary'>watch series</a>";
                if (in_favourites_list($email, $featured_show_id, $db)) {
                  echo "<button type='submit' class='bkmrk-state btn btn-secondary' name='add_show_btn' value=''><span class='fas fa-check'></span>saved</button>";
                } else {
                    echo "<a href='favourites.php'><button type='submit' class='btn btn-secondary' name='add_show_btn' value=''><span class='fas fa-heart'></span>favourite</button></a>";
                  }
              echo "
            </div>
          </div>
        </div>
        <div class='banner-overlay'></div>
        <div class='banner-img-container'>
          <div class='show-img' style='background-image:url($banner_img)'></div>
        </div>
      </div>
    ";
  }

  function display_show_banner($show_id, $show_name, $show_name_jp, $banner_img, $email, $db) {
    echo "
      <div class='banner-container'>
        <div class='text-container'>
          <div class='banner-details'>
            <div class='col-6of12'>
              <h2 data-show-id=$show_id>$show_name</h2>
              <p>$show_name_jp</p>";
                if (in_favourites_list($email, $show_id, $db)) {
                  echo "<button type='submit' class='bkmrk-state btn btn-secondary' name='add_show_btn' value=''><span class='fas fa-check'></span>saved</button>";
                } else {
                    echo "<a href='favourites.php'><button type='submit' class='btn btn-secondary' name='add_show_btn' value=''><span class='fas fa-heart'></span>favourite</button></a>";
                }
              echo "
            </div>
          </div>
        </div>
        <div class='banner-overlay'></div>
        <div class='banner-img-container'>
          <div class='show-img' style='background-image:url($banner_img)'></div>
        </div>
      </div>
    ";
  }

  function display_show_trailer($heading, $trailer_url) {
    echo "
      <div class='row'>
        <div class='col-12of12'>
          <h3 class='cat'>$heading</h3>
        </div>
      </div>
      <iframe class='trailer' src='$trailer_url' frameborder='0' allow='autoplay; encrypted-media' allowfullscreen></iframe>
    ";
  }

  function display_show_synopsis($heading, $description) {
    echo "
      <div class='row'>
        <div class='col-12of12'>
          <h3 class='cat'>$heading</h3>
        </div>
      </div>
      <div class='row'>
        <div class='col-12of12'>
          <div class='info'>
            <p class='descript'>$description</p>
          </div>
        </div>
      </div>
    ";
  }

  function display_show_info($heading, $avg_rating, $show_id, $email, $airing_date, $status, $genres, $db) {
    echo "
      <div class='row'>
        <div class='col-12of12'>
            <h3 class='cat'>$heading</h3>
        </div>
      </div>
      <div class='row'>
        <div class='col-12of12'>
          <div class='info'>
            <section id = 'display-rating'>
              <h4>Average rating:</h4>
              <p>" . number_format($avg_rating * 10, 1) . "</p>";

              if (isset($_SESSION['valid_user'])) {
                echo "<form action='show.php?id=$show_id' id='rate' method ='post'>";
                add_dropdown_num_range('rating', 1, 10);
                echo "<button type='submit' id='submit-rating' form ='rate' value ='Submit' class='btn-small'>Rate</button>
                </form>";
              }

              get_user_rating_for_show($email, $show_id, $db);
            echo "
            </section>
            <h4>Airing date:</h4>
            <p>$airing_date</p>
            <h4>Status:</h4>
            <p>$status</p>
            <h4>Genre:</h4>
            <p><a href='#'>$genres</a></p>
          </div>
        </div>
      </div>
    ";
  }

  function display_all_videos($show_id, $show_name, $show_img, $db) {
    $episodes_query = "SELECT DISTINCT episode_num "
                    . "FROM links "
                    . "WHERE show_id = ? "
                    . "ORDER BY episode_num DESC";
    $episodes_stmt = $db->prepare($episodes_query);
    $episodes_stmt->bind_param('i', $show_id);
    $episodes_stmt->execute();
    $episodes_stmt->bind_result($episode_num);
    $episodes_stmt->store_result();

    echo "
      <div class='row'>
        <div class='col-12of12'>
          <h3 class='cat'>videos ($episodes_stmt->num_rows)</h3>
        </div>
      </div>
      <div class='row'>";
        while ($episodes_stmt->fetch()) {
          display_video_card($show_id, $show_name, $episode_num, $show_img);
        }
      echo "
      </div>";

    $episodes_stmt->free_result();
    $episodes_stmt->close();
    $db->close();
  }


?>
