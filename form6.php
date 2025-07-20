<?php 
session_start(); 
$this_page = 6;
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
      <form id="tool-certifications-form">
         <h2>Tool Proficiency & Certifications [6/8]</h2>
         <label for="certifications">Have you earned any certifications? (Coursera, Udemy, Microsoft, etc.)</label>
         <div id="certifications-wrapper" class="certifications-group">
            <?php
               if (isset($_SESSION['certifications']) && is_string($_SESSION['certifications'])) {
                 $certifications = explode(',', $_SESSION['certifications']);
                 foreach ($certifications as $cert) {
                   $trimmed = trim($cert);
                   echo '<input type="text" name="certifications[]" value="' . htmlspecialchars($trimmed) . '" placeholder="List any certifications you\'ve earned...">';
                 }
               } else {
                 echo '<input type="text" name="certifications[]" placeholder="List any certifications you\'ve earned...">';
               }
               ?>
         </div>
         <div class="add-more-btn-wrapper">
            <button type="button" class="add-more-btn" onclick="addCertification()">(+) Add More</button>
         </div>
         <div class="buttons">
            <button type="submit" class="next-button">Next</button>
            <button type="button" class="back-button" onclick="goBack()">Back</button>
         </div>
      </form>
      <script>
         function goBack() {
           window.location.href = "form5.php";
         }
         
         function addCertification() {
           const wrapper = document.getElementById('certifications-wrapper');
           const newInput = document.createElement('input');
           newInput.type = 'text';
           newInput.name = 'certifications[]';
           newInput.placeholder = "List any certifications you've earned...";
           wrapper.appendChild(newInput);
         }
         
         document.getElementById("tool-certifications-form").addEventListener("submit", function(e) {
           e.preventDefault();
         
           const form = e.target;
           const formData = new FormData(form);
         
           const certs = [];
           form.querySelectorAll('input[name="certifications[]"]').forEach(input => {
             const value = input.value.trim();
             if (value !== '') {
               certs.push(value);
             }
           });
         
           formData.delete('certifications[]');
           if (certs.length > 0) {
             formData.append('certifications', certs.join(', '));
           }
         
           fetch("session.php", {
             method: "POST",
             body: formData
           })
           .then(response => response.json())
           .then(data => {
             if (data.status === "success") {
               window.location.href = "form7.php";
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