# Career Companion

**Real-Time Skill-Based Career Guidance Platform**

---

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [How It Works](#how-it-works)
- [Project Structure](#project-structure)
- [Setup Instructions](#setup-instructions)
- [Usage Guide](#usage-guide)
- [Advantages](#advantages)
- [Security & Best Practices](#security--best-practices)
- [License](#license)

---

## Overview

**Career Companion** is an AI-powered web platform designed to help students and early-career professionals discover, plan, and achieve their career goals. By collecting detailed information about your skills, experiences, and interests, the platform generates:
- Personalized career roadmaps
- Actionable project suggestions
- Curated learning resources

All recommendations are tailored in real-time using Google Gemini AI, ensuring guidance is relevant and actionable for each unique user.

---

## Features

- **Multi-Step Onboarding:** 8-step form collects comprehensive user data (skills, education, experience, interests, goals, etc.)
- **Personalized Dashboard:** Summarizes all user data and provides access to AI-driven features.
- **AI-Generated Career Roadmap:** 5-year, quarter-by-quarter plan with milestones, learning projects, certifications, and more.
- **Project Suggestions:** 5 actionable project ideas tailored to your skills and aspirations.
- **Curated Learning Resources:** At least 10 learning resources matched to your background and learning style.
- **Modern, Responsive UI:** Clean, accessible design with smooth navigation.
- **Secure Data Handling:** All user data is sanitized and stored securely in PHP sessions.

---

## How It Works

1. **User Onboarding:**  
   Users complete an 8-step form, providing information about their background, skills, experiences, and preferences.

2. **Session Management:**  
   All data is securely stored in the PHP session, ensuring privacy and persistence across the user journey.

3. **Dashboard:**  
   After onboarding, users access a dashboard summarizing their profile and offering three main AI-powered features:
   - **Career Roadmap**
   - **Project Suggestions**
   - **Learning Resources**

4. **AI Integration:**  
   When a user requests a roadmap, project suggestions, or resources, the platform sends their profile to the Google Gemini 1.5 Flash API. The AI returns structured, actionable recommendations, which are displayed in a user-friendly format.

5. **Iterative Guidance:**  
   Users can revisit and update their profile at any time, receiving updated recommendations instantly.

---

## Project Structure

```
Career-Companion/
│
├── index.php                # Landing page
├── form1.php - form8.php    # Multi-step onboarding forms
├── dashboard.php            # User dashboard
├── career-roadmap.php       # Career roadmap UI
├── generate-roadmap.php     # Roadmap AI integration (backend)
├── project-suggestions.php  # Project suggestions UI
├── generate-projects.php    # Project suggestions AI integration (backend)
├── resources.php            # Learning resources UI
├── generate-resources.php   # Learning resources AI integration (backend)
├── session.php              # Session management and data validation
├── API-Key.php              # Google Gemini API key (DO NOT COMMIT REAL KEYS)
├── style.css                # Main stylesheet
├── bg.gif                   # Background image asset
├── Google_Gemini.png        # Gemini logo asset
└── ...
```

---

## Setup Instructions

### 1. **Requirements**

- PHP 7.4+ (with cURL enabled)
- Web server (e.g., Apache, Nginx, XAMPP, etc.)
- Internet connection (for Google Gemini API)
- Google Gemini API Key (get from [Google AI Studio](https://aistudio.google.com/app/apikey))

### 2. **Clone the Repository**

```bash
git clone https://github.com/samrat-sarkar/Career-Companion.git
cd Career-Companion
```

### 3. **Install Dependencies**

No external PHP dependencies are required. Ensure your server supports PHP sessions and cURL.

### 4. **Configure the API Key**

- Open `API-Key.php` and replace the placeholder with your actual Gemini API key:

```php
<?php
$apiKey = 'YOUR_GEMINI_API_KEY_HERE';
```

### 5. **Set Up Assets**

Ensure `bg.gif` and `Google_Gemini.png` are present in the root directory for full UI experience.

### 6. **Run the Application**

- Place the project folder in your web server's root directory (e.g., `htdocs` for XAMPP).
- Start your web server.
- Open your browser and navigate to:  
  `http://localhost/Career-Companion/index.php`

---

## Usage Guide

1. **Start at the Landing Page:**  
   Click "Start Your Journey" to begin the onboarding process.

2. **Complete the 8-Step Form:**  
   - Enter your basic info, interests, skills, experience, learning style, and goals.
   - Each step saves your data securely.

3. **Access Your Dashboard:**  
   - Review your profile summary.
   - Explore your personalized career roadmap, project suggestions, and learning resources.

4. **Interact with AI Features:**  
   - Click the respective buttons to fetch AI-generated recommendations.
   - All results are tailored to your unique profile.

5. **Update Your Profile Anytime:**  
   - Return to the forms to update your information and receive new recommendations.

---

## Advantages

- **Truly Personalized:**  
  Recommendations are based on your real skills, experiences, and aspirations not generic templates.

- **Real-Time AI Guidance:**  
  Uses Google Gemini 1.5 Flash for up-to-date, context-aware advice.

- **Comprehensive Support:**  
  Covers career planning, project ideation, and learning resource curation in one platform.

- **Modern, Accessible UI:**  
  Responsive design, clear navigation, and visually appealing interface.

- **Secure & Private:**  
  All data is stored in PHP sessions and never shared or persisted beyond your session.

- **Extensible:**  
  Easily add new forms, AI prompts, or features as your needs grow.

---

## Security & Best Practices

- **API Key Safety:**  
  Never commit your real API key to version control. Use environment variables or server-side secrets in production.

- **Input Validation:**  
  All user input is sanitized and validated before being stored or sent to the AI.

- **Session Security:**  
  PHP sessions are used for temporary, secure data storage.

- **Error Handling:**  
  Graceful error messages are shown for invalid input or API issues.

---

## License

[MIT License](LICENSE)  
Feel free to use, modify, and distribute this project with attribution.

---

**Empower your future with AI-driven, skill-based career guidance.**  
*Career Companion – Your personalized roadmap to success.* 
