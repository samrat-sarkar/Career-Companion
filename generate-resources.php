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

$career_goals = (!empty($_SESSION['career-goals']) && strlen(safe_trim($_SESSION['career-goals'])) > 0)
    ? safe_trim($_SESSION['career-goals']) : 'N/A';

$education = (!empty($_SESSION['education']) && strlen(safe_trim($_SESSION['education'])) > 0)
    ? safe_trim($_SESSION['education']) : 'N/A';

$degree = (!empty($_SESSION['degree']) && strlen(safe_trim($_SESSION['degree'])) > 0)
    ? safe_trim($_SESSION['degree']) : 'N/A';

$major = (!empty($_SESSION['major']) && strlen(safe_trim($_SESSION['major'])) > 0)
    ? safe_trim($_SESSION['major']) : 'N/A';

$programming_language = (!empty($_SESSION['programming-language']) && strlen(safe_trim($_SESSION['programming-language'])) > 0)
    ? safe_trim($_SESSION['programming-language']) : 'N/A';

$certifications = (!empty($_SESSION['certifications']) && strlen(safe_trim($_SESSION['certifications'])) > 0)
    ? safe_trim($_SESSION['certifications']) : 'N/A';

$projects = (!empty($_SESSION['projects']) && strlen(safe_trim($_SESSION['projects'])) > 0)
    ? safe_trim($_SESSION['projects']) : 'N/A';

$events = (!empty($_SESSION['events']) && strlen(safe_trim($_SESSION['events'])) > 0)
    ? safe_trim($_SESSION['events']) : 'N/A';

$learningstyle = (!empty($_SESSION['learningstyle']) && strlen(safe_trim($_SESSION['learningstyle'])) > 0)
    ? safe_trim($_SESSION['learningstyle']) : 'N/A';

$time_commitment = (!empty($_SESSION['time-commitment']) && strlen(safe_trim($_SESSION['time-commitment'])) > 0)
    ? safe_trim($_SESSION['time-commitment']) : 'N/A';


$prompt = "You are an expert career and learning advisor. Based on the following student profile, recommend at least 10 curated learning resources. For each resource, provide:\n";
$prompt .= "- Exact Name of the Resource\n";
$prompt .= "- Platform (e.g., Coursera, Udemy, YouTube)\n";
$prompt .= "- Access type (Free, Paid, or Free with paid audit option)\n";
$prompt .= "- Difficulty level (Basic, Intermediate, Advanced)\n";
$prompt .= "- Average time to complete (in hours or weeks)\n";
$prompt .= "- How the student can access it (link, website, or instructions)\n";
$prompt .= "- Why this resource is relevant based on the student's projects, skills, career goals, learning style, and available time commitment\n";
$prompt .= "Make sure no field is left empty or marked as N/A in the response. Provide concrete details and actionable information.\n\n";
$prompt .= "Student Profile:\n";

$prompt .= "career goal $career_goals.\n";
$prompt .= "highest qualification \"$education\" in $degree in major $major.\n";
$prompt .= "I know: $programming_language.\n";
$prompt .= "Certifications done: $certifications.\n";
$prompt .= "projects done: $projects.\n";
$prompt .= "participated in: $events.\n";
$prompt .= "My learning style is $learningstyle.\n";
$prompt .= "I can commit $time_commitment per week.\n";

$prompt .= "\nReturn the response as strict JSON with a top-level \"resources\" array. Each item must have: title, platform, access, difficulty, duration, how_to_access, relevance.\n";
$prompt .= "Do not include any explanation, markdown, or extra text. Only return valid JSON.\n";

$url = "https://generativelanguage.googleapis.com/v1/models/gemini-1.5-flash:generateContent?key=$apiKey";
$data = ['contents' => [['parts' => [['text' => $prompt]]]]];
$payload = json_encode($data);

$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    CURLOPT_POSTFIELDS => $payload,
]);
$response = curl_exec($ch);

if (curl_errno($ch)) {
    http_response_code(500);
    echo json_encode(['error' => 'cURL Error: ' . curl_error($ch)]);
    exit;
}
curl_close($ch);

$res = json_decode($response, true);
$text = $res['candidates'][0]['content']['parts'][0]['text'] ?? '';
$text = preg_replace('/^```json\s*|\s*```$/', '', trim($text));
$resources = json_decode($text, true);

if (is_array($resources) && isset($resources['resources'])) {
    echo json_encode($resources);
} else {
    http_response_code(500);
    echo json_encode([
        'error' => 'Invalid JSON from model',
        'raw_response' => $text
    ]);
}

