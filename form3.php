<?php 
session_start(); 
$this_page = 3;
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
      <form id="skills-inventory-form">
         <h2>Skills Inventory [3/8]</h2>
         <div class="form-group">
            <label for="programming-language"><span style="color: red; font-weight: bold;">* </span>What programming languages are you familiar with?</label>
            <input type="text" id="programming-language" name="programming-language" placeholder="e.g. Python, JavaScript" 
               value="<?php echo isset($_SESSION['programming-language']) ? htmlspecialchars($_SESSION['programming-language']) : ''; ?>" required>
         </div>
         <div class="form-group">
            <label for="tools"><span style="color: red; font-weight: bold;">* </span>What tools are you familiar with?</label>
            <input type="text" id="tools" name="tools" placeholder="e.g. Figma, Git" 
               value="<?php echo isset($_SESSION['tools']) ? htmlspecialchars($_SESSION['tools']) : ''; ?>" required>
         </div>
         <label>Rate your proficiency in the following skills (1 = Beginner, 5 = Expert)</label>
         <div class="rating-group">
            <label>
               Problem Solving:
               <select name="problemsolving">
                  <option value="">--Rate--</option>
                  <?php for ($i = 1; $i <= 5; $i++): ?>
                  <option value="<?php echo $i; ?>" <?php echo (isset($_SESSION['problemsolving']) && $_SESSION['problemsolving'] == $i) ? 'selected' : ''; ?>>
                     <?php echo $i; ?>
                  </option>
                  <?php endfor; ?>
               </select>
            </label>
            <label>
               Communication:
               <select name="communication">
                  <option value="">--Rate--</option>
                  <?php for ($i = 1; $i <= 5; $i++): ?>
                  <option value="<?php echo $i; ?>" <?php echo (isset($_SESSION['communication']) && $_SESSION['communication'] == $i) ? 'selected' : ''; ?>>
                     <?php echo $i; ?>
                  </option>
                  <?php endfor; ?>
               </select>
            </label>
            <label>
               Teamwork:
               <select name="teamwork">
                  <option value="">--Rate--</option>
                  <?php for ($i = 1; $i <= 5; $i++): ?>
                  <option value="<?php echo $i; ?>" <?php echo (isset($_SESSION['teamwork']) && $_SESSION['teamwork'] == $i) ? 'selected' : ''; ?>>
                     <?php echo $i; ?>
                  </option>
                  <?php endfor; ?>
               </select>
            </label>
            <label>
               Leadership:
               <select name="leadership">
                  <option value="">--Rate--</option>
                  <?php for ($i = 1; $i <= 5; $i++): ?>
                  <option value="<?php echo $i; ?>" <?php echo (isset($_SESSION['leadership']) && $_SESSION['leadership'] == $i) ? 'selected' : ''; ?>>
                     <?php echo $i; ?>
                  </option>
                  <?php endfor; ?>
               </select>
            </label>
         </div>
         <label for="soft-skills"><span style="color: red; font-weight: bold;">* </span>Do you have soft skills like communication, leadership or teamwork experience?</label>
         <textarea id="soft-skills" name="soft-skills" placeholder="Describe any soft skills or experiences you have..." required><?php echo isset($_SESSION['soft-skills']) ? htmlspecialchars($_SESSION['soft-skills']) : ''; ?></textarea>
         <div class="buttons">
            <button type="submit" class="next-button">Next</button>
            <button type="button" class="back-button" onclick="goBack()">Back</button>
         </div>
      </form>
      <script>
         function goBack() {
           window.location.href = "form2.php";
         }
         
         document.getElementById("skills-inventory-form").addEventListener("submit", function(e) {
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
               window.location.href = "form4.php";
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