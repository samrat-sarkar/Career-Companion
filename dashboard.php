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
   $sections = [
     'Basic Information' => ['name', 'email', 'education', 'degree', 'major', 'industries'],
     'Career Interests' => ['career-goals', 'motivation', 'projects', 'events', 'github', 'linkedin'],
     'Skills Inventory' => ['programming-language', 'problemsolving', 'communication', 'teamwork', 'leadership', 'soft-skills'],
     'Past Experience' => ['tools', 'certifications', 'work'],
     'Learning Style & Preferences' => ['learningstyle', 'time-commitment', 'peer-learning'],
     'Challenges & Goals' => ['challenges', 'short-term-goal', 'long-term-goal'],
     'Preferred Project Types' => ['project-type', 'project-context', 'monetized']
   ];
   
   function display_value($value) {
     if (is_array($value)) {
       return htmlspecialchars(implode(', ', $value));
     }
     return nl2br(htmlspecialchars($value));
   }
   ?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>Dashboard</title>
      <link href="https://fonts.googleapis.com/css?family=ABeeZee" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="style.css?i=<?php echo time(); ?>" />
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
         .dashboard-container {
         max-width: 700px;
         margin: 0 auto;
         padding: 1rem;
         display: flex;
         flex-direction: column;
         gap: 1.5rem;
         }
         .section {
         width: 100%;
         background: #000000c0;
         border-radius: 20px;
         padding: 1.5rem 2rem;
         color: #fff;
         box-shadow: 0 0 10px #0057ef33;
         }
         .section h2 {
         border-bottom: 2px solid #0057ef;
         padding-bottom: 0.3rem;
         margin-bottom: 1rem;
         color: #00aaff;
         }
         .field-row {
         display: flex;
         justify-content: space-between;
         align-items: center;
         padding: 0.6rem 0;
         }
         .field-name {
         font-weight: bold;
         max-width: 35%;
         color: #ffffff;
         word-break: break-word;
         }
         .field-value {
         max-width: 60%;
         white-space: pre-wrap;
         color: #fff;
         word-break: break-word;
         font-family: 'ABeeZee', sans-serif;
         }
         .action-buttons {
         display: flex;
         flex-direction: column;
         gap: 1rem;
         margin-bottom: 1rem;
         }
         .action-buttons button {
         padding: 1rem 2.5rem;
         border-radius: 8px;
         font-weight: 600;
         font-size: 1.1rem;
         cursor: pointer;
         position: relative;
         overflow: hidden;
         transition: all 0.3s ease;
         user-select: none;
         width: 100%;
         max-width: 420px;
         align-self: center;
         color: #fff;
         border: none;
         }
         .action-buttons button::before {
         content: '';
         position: absolute;
         top: 0;
         left: -100%;
         width: 100%;
         height: 100%;
         transition: left 0.3s;
         z-index: -1;
         border-radius: 8px;
         }
         .action-buttons button:hover::before {
         left: 0;
         }
         .action-buttons button:hover {
         transform: translateY(-2px);
         }
         .action-buttons button:active {
         transform: translateY(0);
         box-shadow: none;
         }
         .roadmap {
         background: linear-gradient(135deg, #0061ff, #60efff);
         }
         .roadmap::before {
         background: #0047cc;
         }
         .roadmap:hover {
         color: #e0f0ff;
         }
         .project {
         background: linear-gradient(135deg, #00c853, #b2ff59);
         }
         .project::before {
         background: #00a844;
          }
         .project:hover {
         color: #eafff3;
          }
         .resources {
         background: linear-gradient(135deg, #ff6f00, #ffca28);
         }
         .resources::before {
         background: #e65100;
         }
         .resources:hover {
         color: #fff8e1;
         }
         @media (max-width: 600px) {
         .action-buttons button {
         font-size: 1rem;
         padding: 0.9rem 1.5rem;
         }
         }
         @media (max-width: 600px) {
         .field-row {
         flex-direction: column;
         align-items: flex-start;
         }
         .field-name, .field-value {
         max-width: 100%;
         margin: 0.25rem 0;
         }
         }
         #backBtn {
         display: block;         
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
      <button id="backBtn" onclick="location.href='form8.php'">Return to Form</button>
      <?php if (empty($_SESSION)): ?>
      <p style="text-align:center; color:#bbb; margin-top:2rem;">No user data available</p>
      <?php else: ?>
      <div class="dashboard-container">
         <div class="action-buttons">
            <button class="roadmap" type="button" onclick="location.href='career-roadmap.php'">Explore Career Roadmaps</button>
            <button class="project" type="button" onclick="location.href='project-suggestions.php'">Discover Project Suggestions</button>
            <button class="resources" type="button" onclick="location.href='resources.php'">Personalized Resources</button>
         </div>
         <?php foreach ($sections as $sectionTitle => $keys): 
            $hasData = false;
            foreach ($keys as $k) {
              if (isset($_SESSION[$k])) {
                $hasData = true;
                break;
              }
            }
            if (!$hasData) continue; 
            ?>
         <section class="section" aria-label="<?php echo htmlspecialchars($sectionTitle); ?>">
            <h2><?php echo htmlspecialchars($sectionTitle); ?></h2>
            <?php foreach ($keys as $key): 
               if (!isset($_SESSION[$key])) continue; ?>
            <div class="field-row">
               <div class="field-name"><?php echo htmlspecialchars(ucwords(str_replace(['-', '_'], ' ', $key))); ?></div>
               <div class="field-value"><?php echo display_value($_SESSION[$key]); ?></div>
            </div>
            <?php endforeach; ?>
         </section>
         <?php endforeach; ?>
      </div>
      <?php endif; ?>
   </body>
</html>