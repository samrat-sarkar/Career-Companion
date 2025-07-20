<?php
session_start();
header('Content-Type: application/json');
include 'API-Key.php';

function safe_trim($val) {
    if (is_array($val)) {
        return trim(implode(', ', $val));
    } elseif (is_string($val)) {
        return trim($val);
    } else {
        return '';
    }
}

$education           = (!empty($_SESSION['education'])           && strlen(safe_trim($_SESSION['education'])) > 0)           ? safe_trim($_SESSION['education']) : 'N/A';
$degree              = (!empty($_SESSION['degree'])              && strlen(safe_trim($_SESSION['degree'])) > 0)              ? safe_trim($_SESSION['degree']) : 'N/A';
$major               = (!empty($_SESSION['major'])               && strlen(safe_trim($_SESSION['major'])) > 0)               ? safe_trim($_SESSION['major']) : 'N/A';
$industries          = (!empty($_SESSION['industries'])          && strlen(safe_trim($_SESSION['industries'])) > 0)          ? safe_trim($_SESSION['industries']) : 'N/A';
$career_goals        = (!empty($_SESSION['career-goals'])        && strlen(safe_trim($_SESSION['career-goals'])) > 0)        ? safe_trim($_SESSION['career-goals']) : 'N/A';
$motivation          = (!empty($_SESSION['motivation'])          && strlen(safe_trim($_SESSION['motivation'])) > 0)          ? safe_trim($_SESSION['motivation']) : 'N/A';
$programming_language= (!empty($_SESSION['programming-language'])&& strlen(safe_trim($_SESSION['programming-language'])) > 0)? safe_trim($_SESSION['programming-language']) : 'N/A';
$tools               = (!empty($_SESSION['tools'])               && strlen(safe_trim($_SESSION['tools'])) > 0)               ? safe_trim($_SESSION['tools']) : 'N/A';
$problemsolving      = (!empty($_SESSION['problemsolving'])      && strlen(safe_trim($_SESSION['problemsolving'])) > 0)      ? safe_trim($_SESSION['problemsolving']) : 'N/A';
$communication       = (!empty($_SESSION['communication'])       && strlen(safe_trim($_SESSION['communication'])) > 0)       ? safe_trim($_SESSION['communication']) : 'N/A';
$teamwork            = (!empty($_SESSION['teamwork'])            && strlen(safe_trim($_SESSION['teamwork'])) > 0)            ? safe_trim($_SESSION['teamwork']) : 'N/A';
$leadership          = (!empty($_SESSION['leadership'])          && strlen(safe_trim($_SESSION['leadership'])) > 0)          ? safe_trim($_SESSION['leadership']) : 'N/A';
$soft_skills         = (!empty($_SESSION['soft-skills'])         && strlen(safe_trim($_SESSION['soft-skills'])) > 0)         ? safe_trim($_SESSION['soft-skills']) : 'N/A';
$projects            = (!empty($_SESSION['projects'])            && strlen(safe_trim($_SESSION['projects'])) > 0)            ? safe_trim($_SESSION['projects']) : 'N/A';
$events              = (!empty($_SESSION['events'])              && strlen(safe_trim($_SESSION['events'])) > 0)              ? safe_trim($_SESSION['events']) : 'N/A';
$github              = (!empty($_SESSION['github'])              && strlen(safe_trim($_SESSION['github'])) > 0)              ? safe_trim($_SESSION['github']) : 'N/A';
$linkedin            = (!empty($_SESSION['linkedin'])            && strlen(safe_trim($_SESSION['linkedin'])) > 0)            ? safe_trim($_SESSION['linkedin']) : 'N/A';
$learningstyle       = (!empty($_SESSION['learningstyle'])       && strlen(safe_trim($_SESSION['learningstyle'])) > 0)       ? safe_trim($_SESSION['learningstyle']) : 'N/A';
$time_commitment     = (!empty($_SESSION['time-commitment'])     && strlen(safe_trim($_SESSION['time-commitment'])) > 0)     ? safe_trim($_SESSION['time-commitment']) : 'N/A';
$peer_learning       = (!empty($_SESSION['peer-learning'])       && strlen(safe_trim($_SESSION['peer-learning'])) > 0)       ? safe_trim($_SESSION['peer-learning']) : 'N/A';
$certifications      = (!empty($_SESSION['certifications'])      && strlen(safe_trim($_SESSION['certifications'])) > 0)      ? safe_trim($_SESSION['certifications']) : 'N/A';
$challenges          = (!empty($_SESSION['challenges'])          && strlen(safe_trim($_SESSION['challenges'])) > 0)          ? safe_trim($_SESSION['challenges']) : 'N/A';
$short_term_goal     = (!empty($_SESSION['short-term-goal'])     && strlen(safe_trim($_SESSION['short-term-goal'])) > 0)     ? safe_trim($_SESSION['short-term-goal']) : 'N/A';
$long_term_goal      = (!empty($_SESSION['long-term-goal'])      && strlen(safe_trim($_SESSION['long-term-goal'])) > 0)      ? safe_trim($_SESSION['long-term-goal']) : 'N/A';
$project_type        = (!empty($_SESSION['project-type'])        && strlen(safe_trim($_SESSION['project-type'])) > 0)        ? safe_trim($_SESSION['project-type']) : 'N/A';
$project_context     = (!empty($_SESSION['project-context'])     && strlen(safe_trim($_SESSION['project-context'])) > 0)     ? safe_trim($_SESSION['project-context']) : 'N/A';
$monetized           = (!empty($_SESSION['monetized'])           && strlen(safe_trim($_SESSION['monetized'])) > 0)           ? safe_trim($_SESSION['monetized']) : 'N/A';
$work                = (!empty($_SESSION['work'])                && strlen(safe_trim($_SESSION['work'])) > 0)                ? safe_trim($_SESSION['work']) : 'N/A';

$currentMonthYear = date('F Y'); 

$prompt = "Today is $currentMonthYear, Based on the following student profile, generate a detailed 5‑year career roadmap in 3‑month increments. Include milestones, learning projects, certifications, community engagement, internships, and role progression tailored to their goals and learning style. Format as JSON with a top-level 'roadmap' array, where each entry has 'quarter', 'focus', 'actions', and 'outcomes'.\n\n";

$prompt .= "My highest qualification is \"$education\" in $degree in major $major.\n";
$prompt .= "My major is $major.\n";
$prompt .= "I have experience or interest in industries like $industries.\n";
$prompt .= "My career goal is to become a $career_goals.\n";
$prompt .= "My motivation is $motivation.\n";
$prompt .= "I know programming languages: $programming_language.\n";
$prompt .= "Tools I use include: $tools.\n";
$prompt .= "My problem-solving skill level is $problemsolving.\n";
$prompt .= "My communication skill level is $communication.\n";
$prompt .= "My teamwork skill level is $teamwork.\n";
$prompt .= "My leadership skill level is $leadership.\n";
$prompt .= "My soft skills: $soft_skills.\n";
$prompt .= "Some of my projects: $projects.\n";
$prompt .= "I have participated in events like: $events.\n";
$prompt .= "My GitHub profile: $github.\n";
$prompt .= "My LinkedIn profile: $linkedin.\n";
$prompt .= "My preferred learning style is $learningstyle.\n";
$prompt .= "I can commit $time_commitment per week.\n";
$prompt .= "I prefer peer learning: $peer_learning.\n";
$prompt .= "Certifications I have: $certifications.\n";
$prompt .= "Challenges I face: $challenges.\n";
$prompt .= "My short-term goal is: $short_term_goal.\n";
$prompt .= "My long-term goal is: $long_term_goal.\n";
$prompt .= "Preferred project type: $project_type.\n";
$prompt .= "Project context: $project_context.\n";
$prompt .= "Interested in projects that can be monetized: $monetized.\n";
$prompt .= "Currently working: $work.\n";
$prompt .= "\nReturn ONLY valid JSON. No markdown or additional text.";

$url = "https://generativelanguage.googleapis.com/v1/models/gemini-1.5-flash:generateContent?key=$apiKey";
$data = [
    'contents' => [
        [
            'parts' => [
                ['text' => $prompt]
            ]
        ]
    ]
];
$jsonPayload = json_encode($data);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPayload);
$response = curl_exec($ch);

if (curl_errno($ch)) {
    http_response_code(500);
    echo json_encode(['error' => 'cURL Error: ' . curl_error($ch)]);
    exit;
}
curl_close($ch);

$result = json_decode($response, true);
$text = $result['candidates'][0]['content']['parts'][0]['text'] ?? '';
$text = preg_replace('/^```json\s*|\s*```$/', '', trim($text));
$roadmap = json_decode($text, true);

if (is_array($roadmap) && isset($roadmap['roadmap'])) {
    echo json_encode($roadmap);
} else {
    http_response_code(500);
    echo json_encode([
        'error' => 'Invalid JSON from model',
        'raw_response' => $text
    ]);
}
