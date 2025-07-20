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
      <title>Resources</title>
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
         .resources-container {
         background-color: #000000c0;
         border-radius: 20px;
         padding: 2rem;
         max-width: 900px;
         width: 100%;
         margin-top: 2rem;
         }
         .resource-card {
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
         .resource-card:hover {
         border-color: #00ffcc;
         box-shadow: 0 0 10px #00ffcccc;
         }
         .resource-card h3 {
         margin: 0 0 0.5rem 0;
         color: #00ffcc;
         }
         .resource-card p {
         margin: 0.4rem 0;
         }
         .resource-card strong {
         color: #fff;
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
      <h2 id="pt">Building Your Custom Learning Resources...</h2>
      <button id="backBtn" onclick="location.href='dashboard.php'">Return to Dashboard</button>
      <div class="loader-wrapper">
      <div class="loader" id="loader"></div>
      </div>
      <div class="resources-container" id="resources" style="display:none;"></div>
      <script>
         window.addEventListener('DOMContentLoaded', () => {
           fetch('generate-resources.php')
           .then(response => response.json())
           .then(data => {
             document.getElementById('loader').style.display = 'none';
             const container = document.getElementById('resources');
             container.style.display = 'block';
         
             document.getElementById('pt').innerText = 'Your Personalized Learning Resources';
             document.getElementById('backBtn').style.display = 'block';
             document.querySelector('.loader-wrapper')?.remove();
         
             if (!data.resources || !Array.isArray(data.resources)) {
               container.innerHTML = '<p style="color:red;">Invalid resources format.</p>';
               return;
             }
         
             data.resources.forEach(resource => {
               const card = document.createElement('div');
               card.className = 'resource-card';
         
               card.innerHTML = `
                   <h3>${resource.title || 'Untitled Resource'}</h3>
                   <p><strong>Platform:</strong> ${resource.platform || 'N/A'} (${resource.access || 'N/A'})</p>
                   <p><strong>Difficulty:</strong> ${resource.difficulty || 'N/A'}</p>
                   <p><strong>Duration:</strong> ${resource.duration || 'N/A'}</p>
                   <p><strong>How to access:</strong> ${resource.how_to_access || 'N/A'}</p>
                   <p><strong>Relevance:</strong> ${resource.relevance || 'N/A'}</p>
               `;
         
               container.appendChild(card);
             });
           })
           .catch(err => {
             document.getElementById('loader').style.display = 'none';
             const container = document.getElementById('resources');
             container.style.display = 'block';
             container.innerHTML = `<p style="color:red;">❌ Error loading resources.</p><pre>${err}</pre>`;
           });
         });
      </script>
   </body>
</html>