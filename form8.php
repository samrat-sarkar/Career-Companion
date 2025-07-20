<?php 
session_start(); 
$this_page = 8;
if (!isset($_SESSION['page'])) {
    header("Location: form1.php");
    exit();
}
$page_value = $_SESSION['page'];
if ($page_value < $this_page) {
    $redirect_page = "form" . $page_value . ".php";
    header("Location: $redirect_page");
    exit();
}
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
      <form id="project-preferences-form">
         <h2>Preferred Project Types [8/8]</h2>
         <label for="project-type"><span style="color: red; font-weight: bold;">* </span>What type of projects do you enjoy ?</label>
         <select id="project-type" name="project-type" required>
            <option value="">--Select--</option>
            <?php
               $projectType = isset($_SESSION['project-type']) ? $_SESSION['project-type'] : '';
               $projectTypeOptions = ['Team-based', 'Solo', 'Research', 'Startup-style'];
               foreach ($projectTypeOptions as $option) {
                   $selected = ($projectType === $option) ? 'selected' : '';
                   echo "<option value=\"$option\" $selected>$option</option>";
               }
               ?>
         </select>
         <label for="project-context"><span style="color: red; font-weight: bold;">* </span>What kind of project would you prefer to work on ?</label>
         <select id="project-context" name="project-context" required>
            <option value="">--Select--</option>
            <?php
               $projectContext = isset($_SESSION['project-context']) ? $_SESSION['project-context'] : '';
               $contextOptions = [
                 'Real-world projects' => 'Real-world',
                 'Fictional projects' => 'Fictional',
                 'Open-source projects' => 'Open-Source'
               ];
               foreach ($contextOptions as $value => $label) {
                   $selected = ($projectContext === $value) ? 'selected' : '';
                   echo "<option value=\"$value\" $selected>$label</option>";
               }
               ?>
         </select>
         <label for="monetized"><span style="color: red; font-weight: bold;">* </span>Are you interested in projects that can be monetized ?</label>
         <select id="monetized" name="monetized" required>
            <option value="">--Select--</option>
            <?php
               $monetized = isset($_SESSION['monetized']) ? $_SESSION['monetized'] : '';
               foreach (['Yes', 'No'] as $option) {
                   $selected = ($monetized === $option) ? 'selected' : '';
                   echo "<option value=\"$option\" $selected>$option</option>";
               }
               ?>
         </select>
         <div class="buttons">
            <button type="submit" class="next-button">Next</button>
            <button type="button" class="back-button" onclick="goBack()">Back</button>
         </div>
      </form>
      <script>
         function goBack() {
           window.location.href = "form7.php";
         }
         
         document.getElementById("project-preferences-form").addEventListener("submit", function(e) {
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
               window.location.href = "dashboard.php";
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