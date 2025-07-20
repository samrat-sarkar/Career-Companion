<?php 
session_start(); 
$_SESSION['page'] = 1;
?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Career Companion</title>
      <link href="https://fonts.googleapis.com/css?family=ABeeZee" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="style.css?i=<?php echo time(); ?>">
   </head>
   <body>
      <form id="basic-info-form">
         <h2>Basic Information [1/8]</h2>
         <div class="form-group">
            <label for="name"><span style="color: red; font-weight: bold;">* </span>What is your full name ?</label>
            <input type="text" id="name" name="name" placeholder="e.g. Samrat Sarkar" 
               value="<?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : ''; ?>" required>
         </div>
         <div class="form-group">
            <label for="email"><span style="color: red; font-weight: bold;">* </span>What is your email ?</label>
            <input type="text" id="email" name="email" placeholder="e.g. example@abc.com"
               value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>" required>
         </div>
         <div class="form-group">
            <label for="education"><span style="color: red; font-weight: bold;">* </span>What is your current level of education ?</label>
            <select id="education" name="education" required>
               <option value="">--Select an option--</option>
               <?php
                  $options = ['High School', 'Undergraduate', 'Graduate', 'Postgraduate', 'Above Postgraduate'];
                  foreach ($options as $option) {
                      $selected = (isset($_SESSION['education']) && $_SESSION['education'] === $option) ? 'selected' : '';
                      echo "<option value=\"$option\" $selected>$option</option>";
                  }
                  ?>
            </select>
         </div>
         <div class="form-group">
            <label for="degree"><span style="color: red; font-weight: bold;">* </span>What is your degree ?</label>
            <input type="text" id="degree" name="degree" placeholder="e.g. B.Tech"
               value="<?php echo isset($_SESSION['degree']) ? htmlspecialchars($_SESSION['degree']) : ''; ?>" required>
         </div>
         <div class="form-group">
            <label for="major"><span style="color: red; font-weight: bold;">* </span>What is your major or field of study ?</label>
            <input type="text" id="major" name="major" placeholder="e.g. CSE, Electronics"
               value="<?php echo isset($_SESSION['major']) ? htmlspecialchars($_SESSION['major']) : ''; ?>" required>
         </div>
         <div class="buttons">
            <button type="submit" class="next-button">Next</button>
            <button type="button" class="back-button" onclick="goBack()">Back</button>
         </div>
      </form>
      <script>
         function goBack() {
           window.location.href = "index.php";
         }

         document.getElementById("basic-info-form").addEventListener("submit", function (e) {
           e.preventDefault();
         
           const form = e.target;
           const formData = new FormData(form);
         
           fetch("session.php", {
             method: "POST",
             body: formData
           })
             .then(response => response.json())
             .then(data => {
               if (data.status === "success") {
                 window.location.href = "form2.php";
               } else if (data.status === "error") {
                 alert("Please correct the following errors:\n" +
                   Object.entries(data.errors)
                     .map(([field, msg]) => `${field}: ${msg}`)
                     .join("\n")
                 );
               }
             })
             .catch(error => {
               console.error("Submission error:", error);
               alert("Something went wrong while submitting the form.");
             });
         });
      </script>
   </body>
</html>