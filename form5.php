<?php 
session_start(); 
$this_page = 5;
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
      <form id="learning-preferences-form">
         <h2>Learning Style & Preferences [5/8]</h2>
         <label><span style="color: red; font-weight: bold;">* </span>How do you prefer to learn ?</label>
         <div class="checkbox-group">
            <?php
               $learningStyles = isset($_SESSION['learningstyle']) ? (array) $_SESSION['learningstyle'] : [];
               ?>
            <label>
            <input type="checkbox" name="learningstyle[]" value="Offline"
               <?php echo in_array('Offline', $learningStyles) ? 'checked' : ''; ?>>
            Offline
            </label>
            <label>
            <input type="checkbox" name="learningstyle[]" value="Online Videos"
               <?php echo in_array('Online Videos', $learningStyles) ? 'checked' : ''; ?>>
            Online Videos
            </label>
            <label>
            <input type="checkbox" name="learningstyle[]" value="Online PDFs"
               <?php echo in_array('Online PDFs', $learningStyles) ? 'checked' : ''; ?>>
            Online PDFs
            </label>
         </div>
         <label for="time-commitment"><span style="color: red; font-weight: bold;">* </span>How much time can you dedicate per week for learning or building projects ?</label>
         <input type="text" id="time-commitment" name="time-commitment"
            placeholder="e.g. 5 hours, 15 hours" required
            value="<?php echo isset($_SESSION['time-commitment']) ? htmlspecialchars($_SESSION['time-commitment']) : ''; ?>">
         <label for="peer-learning"><span style="color: red; font-weight: bold;">* </span>Interested in peer learning or community-based experiences ?</label>
         <select id="peer-learning" name="peer-learning" required>
            <option value="">--Select--</option>
            <?php
               $selectedPeerLearning = isset($_SESSION['peer-learning']) ? $_SESSION['peer-learning'] : '';
               $options = ['Yes', 'No'];
               foreach ($options as $option) {
                   $selected = ($selectedPeerLearning === $option) ? 'selected' : '';
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
           window.location.href = "form4.php";
         }
         
         document.getElementById("learning-preferences-form").addEventListener("submit", function(e) {
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
               window.location.href = "form6.php";
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