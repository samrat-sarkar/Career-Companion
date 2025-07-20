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

$project_type = (!empty($_SESSION['project-type']) && strlen(safe_trim($_SESSION['project-type'])) > 0)
    ? safe_trim($_SESSION['project-type']) : 'N/A';

$project_context = (!empty($_SESSION['project-context']) && strlen(safe_trim($_SESSION['project-context'])) > 0)
    ? safe_trim($_SESSION['project-context']) : 'N/A';

$monetized = (!empty($_SESSION['monetized']) && strlen(safe_trim($_SESSION['monetized'])) > 0)
    ? safe_trim($_SESSION['monetized']) : 'N/A';

$prompt = "Based on the following student profile, generate 5 focused project suggestions that align with their goals and skills. Each project should include: 'title', 'description', 'skills_required', 'tools_needed', 'estimated_duration', 'difficulty_level', and 'real_world_application'. Return the response as valid JSON with a top-level 'projects' array.\n\n";

$prompt .= "My career goal is to become a $career_goals.\n";
$prompt .= "My highest qualification is \"$education\" in $degree in major $major.\n";
$prompt .= "I know programming languages: $programming_language.\n";
$prompt .= "Certifications I have: $certifications.\n";
$prompt .= "Preferred project type: $project_type.\n";
$prompt .= "Project context: $project_context.\n";
$prompt .= "Interested in projects that can be monetized : $monetized.\n";

$prompt .= "\nReturn ONLY valid JSON. No markdown or extra text.";

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
$projects = json_decode($text, true);

if (is_array($projects) && isset($projects['projects'])) {
    echo json_encode($projects);
} else {
    http_response_code(500);
    echo json_encode([
        'error' => 'Invalid JSON from model',
        'raw_response' => $text
    ]);
}
