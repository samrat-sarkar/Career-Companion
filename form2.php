<?php 
session_start(); 
$this_page = 2;
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
      <form id="career-interests-form">
         <h2>Career Interests [2/8]</h2>
         <div class="form-group">
            <label for="industries"><span style="color: red; font-weight: bold;">* </span>What industries or domains are you interested in ?</label>
            <textarea id="industries" name="industries" placeholder="e.g. AI, Design, Finance, Healthcare, Game Development" required><?php echo isset($_SESSION['industries']) ? htmlspecialchars($_SESSION['industries']) : ''; ?></textarea>
         </div>
         <div class="form-group">
            <label for="career-goals">Do you have any specific career goals in mind ?</label>
            <textarea id="career-goals" name="career-goals" placeholder="e.g. Data Scientist, UX Designer, Entrepreneur"><?php echo isset($_SESSION['career-goals']) ? htmlspecialchars($_SESSION['career-goals']) : ''; ?></textarea>
         </div>
         <div class="form-group">
            <label for="motivation">What motivates you for this job ?</label>
            <textarea id="motivation" name="motivation" placeholder="e.g. Solving problems, Creating products, Helping others, High income"><?php echo isset($_SESSION['motivation']) ? htmlspecialchars($_SESSION['motivation']) : ''; ?></textarea>
         </div>
         <div class="buttons">
            <button type="submit" class="next-button">Next</button>
            <button type="button" class="back-button" onclick="goBack()">Back</button>
         </div>
      </form>
      <script>
         function goBack() {
           window.location.href = "form1.php";
         }
         
         document.getElementById("career-interests-form").addEventListener("submit", function(e) {
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
               window.location.href = "form3.php";
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