<?php 
session_start(); 
$this_page = 4;
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
      <form id="past-experience-form">
         <h2>Past Experience [4/8]</h2>
         <label for="projects">What is the best project you have ever worked on ? Briefly describe it.</label>
         <textarea id="projects" name="projects" placeholder="Describe your projects..."><?php echo isset($_SESSION['projects']) ? htmlspecialchars($_SESSION['projects']) : ''; ?></textarea>
         <label for="events">Have you participated in any hackathons, workshops or competitions ?</label>
         <textarea id="events" name="events" placeholder="List any relevant events, hackathons, workshops or competitions..."><?php echo isset($_SESSION['events']) ? htmlspecialchars($_SESSION['events']) : ''; ?></textarea>
         <label for="work">Any internships, freelance gigs or part-time work ?</label>
         <textarea id="work" name="work" placeholder="Describe your work experience..."><?php echo isset($_SESSION['work']) ? htmlspecialchars($_SESSION['work']) : ''; ?></textarea>
         <label for="github">Do you have a GitHub profile you’d like to share ?</label>
         <input type="text" id="github" name="github" placeholder="Paste links here..." value="<?php echo isset($_SESSION['github']) ? htmlspecialchars($_SESSION['github']) : ''; ?>">
         <label for="linkedin">Do you have a LinkedIn profile you’d like to share ?</label>
         <input type="text" id="linkedin" name="linkedin" placeholder="Paste links here..." value="<?php echo isset($_SESSION['linkedin']) ? htmlspecialchars($_SESSION['linkedin']) : ''; ?>">
         <div class="buttons">
            <button type="submit" class="next-button">Next</button>
            <button type="button" class="back-button" onclick="goBack()">Back</button>
         </div>
      </form>
      <script>
         function goBack() {
           window.location.href = "form3.php";
         }
         
         document.getElementById("past-experience-form").addEventListener("submit", function(e) {
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
               window.location.href = "form5.php";
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