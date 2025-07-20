<?php 
session_start(); 
$this_page = 7;
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
      <form id="challenges-goals-form">
         <h2>Challenges & Goals [7/8]</h2>
         <label for="challenges"><span style="color: red; font-weight: bold;">* </span>What are your biggest challenges in choosing or pursuing a career path ?</label>
         <textarea id="challenges" name="challenges" placeholder="Describe any blockers or difficulties you’re facing..." required><?php echo isset($_SESSION['challenges']) ? htmlspecialchars($_SESSION['challenges']) : ''; ?></textarea>
         <label for="short-term-goal"><span style="color: red; font-weight: bold;">* </span>What’s a short-term goal (next 6 months) you’d like to achieve ?</label>
         <textarea id="short-term-goal" name="short-term-goal" placeholder="e.g. Learn React, build a portfolio, get an internship..." required><?php echo isset($_SESSION['short-term-goal']) ? htmlspecialchars($_SESSION['short-term-goal']) : ''; ?></textarea>
         <label for="long-term-goal"><span style="color: red; font-weight: bold;">* </span>What’s a long-term vision you’re working toward (3–5 years) ?</label>
         <textarea id="long-term-goal" name="long-term-goal" placeholder="e.g. Become a software engineer, launch a startup..." required><?php echo isset($_SESSION['long-term-goal']) ? htmlspecialchars($_SESSION['long-term-goal']) : ''; ?></textarea>
         <div class="buttons">
            <button type="submit" class="next-button">Next</button>
            <button type="button" class="back-button" onclick="goBack()">Back</button>
         </div>
      </form>
      <script>
         function goBack() {
           window.location.href = "form6.php";
         }
         
         document.getElementById("challenges-goals-form").addEventListener("submit", function(e) {
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
               window.location.href = "form8.php";
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