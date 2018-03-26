<?php

  session_start();

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
   *  Create hyperlink from a given URL, code, and display text
   *  @param  string  $url   Base URL
   *  @param  string  $id    Code, e.g. product code
   *  @param  string  $text  Text to display, e.g. product name
   */
  function format_text_as_link($url, $id, $text) {
    $text = iconv("UTF-8", "ISO-8859-1//IGNORE", $text);
    echo "<a href=\"$url?code=$id\">$text</a>";
  }

  /*
   *  Connect to database
   *  @param   string  $dbhost  Server address
   *  @param   string  $dbuser  Username in MySQL
   *  @param   string  $dbpass  Password in MySQL
   *  @param   string  $dbname  Database name
   *  @return  mysqli
   */
  $db = connect_to_db('localhost', 'root', '', 'classicmodels');
  function connect_to_db($dbhost, $dbuser, $dbpass, $dbname) {
    @$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    // Check database connection
    if ($connection->connect_errno) {
      printf("Database connection failed: %s\n", $connection->connect_error);
      exit();
    }
    return $connection;
  }

  /*
   *  Display a product's details as a table
   *  @param  string  $name         productName
   *  @param  string  $code         productCode
   *  @param  string  $line         productLine
   *  @param  string  $scale        productScale
   *  @param  string  $vendor       productVendor
   *  @param  string  $description  productDescription
   *  @param  int     $quantity     quantityInStock
   *  @param  double  $price        buyPrice
   *  @param  double  $msrp         MSRP
   */
  function display_modeldetails($name, $code, $line, $scale, $vendor, $description, $quantity, $price, $msrp) {
    $name = iconv("UTF-8", "ISO-8859-1//IGNORE", $name);
    $description = iconv("UTF-8", "ISO-8859-1//IGNORE", $description);
    echo "<table class=\"results-table\">";
    echo "<th colspan=\"2\"><h1>$name</h1></th>";
    echo "<tr><td>Product code</td><td>$code</td></tr>";
    echo "<tr><td>Product line</td><td>$line</td></tr>";
    echo "<tr><td>Scale</td><td>$scale</td></tr>";
    echo "<tr><td>Vendor</td><td>$vendor</td></tr>";
    echo "<tr><td>Description</td><td>$description</td></tr>";
    echo "<tr><td>Quantity in stock</td><td>$quantity</td></tr>";
    echo "<tr><td>MSRP</td><td>$msrp</td></tr>";
    echo "<tr><td>Our price</td><td>$price</td></tr>";
    echo "</table>";
  }

  /*
   *  Create opening form and fieldset tags, add legend
   *  @param  string  $url   URL to send the form data to after submission
   *  @param  string  $text  Text to display in legend
   */
  function form_start($url, $text) {
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
      echo "<input type =\"password\" name=\"$varname\" id=\"$varname\" value=\"$inputted_text\">";
    } else {
      echo "<input type =\"text\" name=\"$varname\" id=\"$varname\" value=\"$inputted_text\">";
    }
    echo "<br>";
  }

  /*
   *  Close fieldset and form tags, add submit button
   *  @param  string  $button_text  Text to display in button
   */
  function form_end($button_text) {
    echo "</fieldset>";
    echo "<input type=\"submit\" name=\"log in\" value=\"$button_text\">";
    echo "</form>";
  }

  /*
   *  Check if a form has been filled out completely
   *  @param   array  $form_vars  List of variables, e.g. passed to current script via HTTP POST
   *  @return  boolean
   */
  function filled_out($form_vars) {
    // Test that each variable has a value
    foreach ($form_vars as $key => $value) {
      if ((!isset($key)) || ($value == '')) {
        return false;
      }
    }
    return true;
  }

  /*
   *  Check if user left one of the name fields blank, or inputted spaces only
   *  @param   string  $firstname  First name as entered
   *  @param   string  $lastname   Last name as entered
   *  @return  boolean
   */
  function incomplete_name($firstname, $lastname) {
    if (trim($firstname) == '' || trim($lastname) == '') {
      return true;
    } else {
      return false;
    }
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

  function valid_username($username) {
    if (preg_match("/^[ \w]+$/", $username)) {
      return true;
    } else {
      return false;
    }
  }

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
   *  Check if all the registration data entered meets the checks above
   *  @param   string  $firstname  First name address as entered
   *  @param   string  $lastname   Last name as entered
   *  @param   string  $email      Email address as entered
   *  @param   string  $password   Password as entered
   *  @param   string  $password2  Password (again) as entered
   *  @param   mysqli  $db         Connection between PHP and MySQL database
   *  @return  boolean
   */
  function registration_data_valid($email, $username, $fav_genre, $password, $password2, $db) {
    if (filled_out($_POST) &&
        unique_email($email, $db) && valid_email($email) &&
        unique_username($username, $db) && valid_username($username, $db) && !((strlen($username) < 3) || (strlen($password) > 24)) &&
        ($password == $password2) && !((strlen($password) < 6) || (strlen($password) > 16)) && strong_password($password)) {
      return true;
    } else {
      return false;
    }
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
    $query = "INSERT INTO users VALUES "
           . "(?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('sssss', $email, $username, $password, $fav_genre, $profile_img);
    $stmt->execute();
    $stmt->free_result();
    $stmt->close();
  }

  /*
   *  Check if an item already exists in a user's watchlist
   *  @param   string  $email        User's email address
   *  @param   string  $productCode  Product code of the item
   *  @param   mysqli  $db           Connection between PHP and MySQL database
   *  @return  boolean
   */
  function not_already_in_watchlist($email, $productcode, $db) {
    $query = "SELECT * "
           . "FROM watchlist_items "
           . "WHERE watchlist_items.email = ? "
           . "AND watchlist_items.productCode = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ss', $email, $productcode);
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
   *  Get a product's name from its product code
   *  @param   string  $code  The product's code
   *  @param   mysqli  $db    Connection between PHP and MySQL database
   *  @return  string
   */
  function get_productname_from_code($code, $db) {
    $name_query = "SELECT productName FROM products WHERE productCode = ?";
    $name_stmt = $db->prepare($name_query);
    $name_stmt->bind_param('s', $code);
    $name_stmt->execute();
    $name_stmt->bind_result($productname);
    $name_stmt->fetch();
    return $productname;
    $name_stmt->free_result();
    $name_stmt->close();
  }

  /*
   *  Add a user's watchlist item to the database
   *  @param   string  $email        User's email address
   *  @param   string  $productcode  Product code of the item to add
   *  @param   mysqli  $db           Connection between PHP and MySQL database
   */
  function add_to_watchlist($email, $productcode, $db) {
    $query = "INSERT INTO watchlist_items VALUES "
           . "(?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ss', $email, $productcode);
    $stmt->execute();
    $stmt->free_result();
    $stmt->close();
  }

  /*
   *  Get a list of all valid product codes from database
   *  @param   mysqli  $db  Connection between PHP and MySQL database
   *  @return  array
   */
  function all_productcodes_list($db) {
    $query = "SELECT DISTINCT products.productCode "
           . "FROM products "
           . "ORDER BY products.productCode";
    $results = $db->query($query);

    if (!$results) {
      die("Couldn't get product codes: Database query failed.");
    }

    while($row = $results->fetch_assoc()) {
      $productcodes[] = $row["productCode"];
    }
    $results->free_result();
    return $productcodes;
  }

  /*
   *  Check of a product code is in the list of valid product codes from database
   *  @param   string  $code  Product code of item to check
   *  @param   mysqli  $db    Connection between PHP and MySQL database
   *  @return  boolean
   */
  function is_valid_product($code, $db) {
    if (in_array($code, all_productcodes_list($db))) {
      return true;
    } else {
      return false;
    }
  }

?>