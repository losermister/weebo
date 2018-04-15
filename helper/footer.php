		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <script type="text/javascript">
      // Ajax call to dynamically search for anime and autofill
      $(document).ready(function() {
        $('.search-show input[type="text"]').on("keyup input",function() {
          var inputVal = $(this).val();
          var resultDropdown = $(this).siblings(".result");

          if (inputVal.length) {
            $.get("update-search.php", {term: inputVal}).done(function(data) {
              resultDropdown.html(data);
            });
          } else{
            resultDropdown.empty();
          }
        });

        // Set search input value on click of result item
        $(document).on("click", ".result p", function(){
          $(this).parents(".search-show").find('input[type="text"]').val($(this).text());
          $(this).parent(".result").empty();
        });
      });
    </script>

    <script type="text/javascript">
      // Show dropdown menu for logged in users
      $('#user-click').click(function() {
        $('.user-dropdown').toggle();
      });
    </script>

	</body>
</html>