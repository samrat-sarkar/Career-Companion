<?php
   session_start();
   session_destroy();
   ?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>Career Companion</title>
      <link href="https://fonts.googleapis.com/css?family=ABeeZee" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="style.css?i=<?php echo time(); ?>" />
      <style>
         body {
         margin: 0;
         font-family: 'ABeeZee', sans-serif;
         background: linear-gradient(135deg, #004e92, #000428);
         color: #e0f7ff;
         display: flex;
         flex-direction: column;
         justify-content: space-between; 
         align-items: center;
         min-height: 100vh; 
         text-align: center;
         padding: 2rem 1rem; 
         box-sizing: border-box;
         }
         h1 {
         font-size: 3rem;
         margin-bottom: 0.5rem;
         color: #00c8ff;
         text-shadow: 0 0 15px #00c8ffaa;
         }
         p {
         font-size: 1.25rem;
         max-width: 600px;
         margin: 1rem auto 2rem;
         line-height: 1.6;
         color: #c0eaffcc;
         }
         .highlight {
         color: #00e5ff;
         font-weight: 700;
         text-shadow: 0 0 8px #00e5ffbb;
         }
         .start-btn {
         background: #00c8ff;
         color: #001f33;
         border: none;
         padding: 1rem 3rem;
         font-size: 1.25rem;
         font-weight: bold;
         border-radius: 30px;
         cursor: pointer;
         box-shadow: 0 0 15px #00c8ffbb;
         transition: background-color 0.3s ease, color 0.3s ease;
         user-select: none;
         }
         .start-btn:hover {
         background: #0099cc;
         color: #fff;
         box-shadow: 0 0 25px #0099ccdd;
         }
         footer {
         font-size: 0.85rem;
         color: #fff;
         margin-top: 2rem;
         width: 100%;
         text-align: center;
         user-select: none;
         }
         .floating-images {
         position: fixed;
         bottom: 20px;
         right: 20px;
         display: flex;
         flex-direction: column;
         align-items: flex-end;
         gap: 10px;
         z-index: 999;
         }
         .floating-images img {
         width: 80px;
         height: auto;
         transition: transform 0.3s ease;
         }
         .floating-images img {
         width: 80px;
         height: auto;
         transition: transform 0.3s ease;
         will-change: filter;
         }
         .floating-images img:hover {
         transform: scale(1.1);
         }
         @media (max-width: 480px) {
         h1 {
         font-size: 2.2rem;
         }
         p {
         font-size: 1rem;
         padding: 0 0.5rem;
         }
         .start-btn {
         padding: 0.75rem 2rem;
         font-size: 1rem;
         }
         .floating-images img {
         width: 60px;
         }
         .floating-images {
         bottom: 15px;
         right: 15px;
         gap: 8px;
         }
         }
      </style>
   </head>
   <body>
      <h1>Welcome to Career Companion</h1>
      <p>
         Struggling to find the <span class="highlight">career path</span> that fits your unique skills and interests ?  
         You're not alone. Many students feel unsure about where to focus their energy and time.
      </p>
      <p>
         <strong>Career Companion</strong> uses cutting-edge AI powered by <em>Gemini 1.5 Flash</em> to analyze your <span class="highlight">event history</span>, <span class="highlight">project experience</span> and <span class="highlight">skills</span> then provides tailored <em>career roadmaps</em>, <em>project suggestions</em> and <em>curated resources</em> to help you navigate your journey with confidence.
      </p>
      <button class="start-btn" onclick="location.href='form1.php'">Start Your Journey</button>
      <div class="floating-images">
         <img src="Google_Gemini.png" alt="Google Gemini" />
      </div>
      <footer>
         &copy; <?php echo date('Y'); ?> Career Companion &mdash; Empowering Your Future with AI
      </footer>
   </body>
</html>