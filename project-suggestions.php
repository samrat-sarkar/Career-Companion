<?php 
session_start(); 
$this_page = 9;
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
      <title>Project Suggestions</title>
      <link href="https://fonts.googleapis.com/css?family=ABeeZee" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="style.css?i=<?php echo time(); ?>">
      <style>
         body {
         margin: 0;
         height: 100vh;
         background: radial-gradient(circle at center, #00aaff, #003366 70%, #0d0d0d 100%);
         background-size: 200% 200%;
         animation: radialGradientShift 30s ease-in-out infinite;
         color: #ffffff;
         font-family: 'ABeeZee', sans-serif;
         text-shadow: 0 0 5px rgba(0, 170, 255, 0.6);
         }
         @keyframes radialGradientShift {
         0% {
         background-position: center center;
         background-size: 150% 150%;
         }
         50% {
         background-position: center center;
         background-size: 250% 250%;
         }
         100% {
         background-position: center center;
         background-size: 150% 150%;
         }
         }
         h2 {
         color: #ffffff;
         margin-bottom: 1rem;
         }
         .loader {
         width: 50px;
         aspect-ratio: 1;
         display: grid;
         border: 4px solid transparent;
         border-radius: 50%;
         border-color: #00aaff transparent;
         animation: l16 1s infinite linear;
         margin-top: 50px;
         filter: drop-shadow(0 0 5px #ffffff);
         }
         .loader-wrapper {
         display: flex;
         justify-content: center;
         align-items: center;
         height: 60vh;
         width: 100%;
         }
         .loader::before,
         .loader::after {
         content: "";
         grid-area: 1/1;
         margin: 2px;
         border: inherit;
         border-radius: 50%;
         }
         .loader::before {
         border-color: #00ffcc transparent;
         animation: inherit;
         animation-duration: 0.5s;
         animation-direction: reverse;
         filter: drop-shadow(0 0 6px #00ffcc);
         }
         .loader::after {
         margin: 8px;
         border-color: #004466 transparent;
         filter: drop-shadow(0 0 3px #004466);
         }
         @keyframes l16 {
         100% { transform: rotate(1turn); }
         }
         .projects-container {
         background-color: #000000c0;
         border-radius: 20px;
         padding: 2rem;
         max-width: 900px;
         width: 100%;
         margin-top: 2rem;
         }
         .project-card {
         background: rgba(16, 16, 16, 0.8);
         border: 2px solid rgba(255, 255, 255, 0.2);
         border-radius: 12px;
         padding: 1.5rem;
         margin-bottom: 1.5rem;
         transition: border-color 0.3s ease;
         word-wrap: break-word;
         overflow-wrap: break-word;
         word-break: break-word;
         }
         .project-card h3 {
         margin: 0 0 0.75rem 0;
         color: #00ffcc;
         }
         .project-card:hover {
         border-color: #00ffcc;
         box-shadow: 0 0 10px #00ffcccc;
         }
         .project-card p {
         margin: 0.4rem 0;
         }
         .project-card strong {
         color: #ffffff;
         }
         #backBtn {
         display: none;         
         margin: 1rem auto 2rem; 
         padding: 0.5rem 1rem;
         background: #00a1ff;
         border: none;
         border-radius: 25px;
         color: #fff;
         cursor: pointer;
         transition: background-color 0.3s ease, color 0.3s ease;
         }
         #backBtn:hover {
         background: #ffffff;
         color: #000;
         transform: translateY(-0.5px);
         font-weight: bold;
         }
      </style>
   </head>
   <body>
      <h2 id="pt">Crafting Personalized Project Suggestions for You...</h2>
      <button id="backBtn" onclick="location.href='dashboard.php'">Return to Dashboard</button>
      <div class="loader-wrapper">
      <div class="loader" id="loader"></div>
      </div>
      <div class="projects-container" id="projects" style="display: none;"></div>
      <script>
         window.addEventListener('DOMContentLoaded', () => {
           fetch('generate-projects.php')
           .then(response => response.json())
           .then(data => {
             const loader = document.getElementById('loader');
             const container = document.getElementById('projects');
             loader.style.display = 'none';
             container.style.display = 'block';
         
             document.getElementById('pt').innerText = 'Unleash Your Potential with These Projects';
             document.getElementById('backBtn').style.display = 'block';
             document.querySelector('.loader-wrapper')?.remove();
         
             if (!data.projects || !Array.isArray(data.projects)) {
               container.innerHTML = '<p style="color:red;">Invalid project data.</p>';
               return;
             }
         
             data.projects.forEach(project => {
               const card = document.createElement('div');
               card.className = 'project-card';
         
               card.innerHTML = `
                 <h3>${project.title}</h3>
                 <p><strong>Description:</strong> ${project.description}</p>
                 <p><strong>Skills Required:</strong> ${project.skills_required}</p>
                 <p><strong>Tools Needed:</strong> ${project.tools_needed}</p>
                 <p><strong>Estimated Duration:</strong> ${project.estimated_duration}</p>
                 <p><strong>Difficulty Level:</strong> ${project.difficulty_level}</p>
                 <p><strong>Real-World Application:</strong> ${project.real_world_application}</p>
               `;
         
               container.appendChild(card);
             });
           })
           .catch(err => {
             document.getElementById('loader').style.display = 'none';
             document.getElementById('projects').style.display = 'block';
             document.getElementById('projects').innerHTML =
           `<p style="color:red;">❌ Error loading projects.</p><pre>${err}</pre>`;
         });
         });
      </script>
   </body>
</html>