<?php
   session_start();
   header('Content-Type: application/json');
   
   if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
       echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
       exit;
   }
   
   function sanitize_value($value) {
       return trim(strip_tags($value));
   }
   
   function repair_and_validate($value) {
       $minLength = 1;
       $maxLength = 200;
   
       $allowedPattern = "/[^a-zA-Z0-9\s@#%\^\-_,+.:\/]/";
   
       preg_match_all($allowedPattern, $value, $invalidCharsMatches);
       $invalidChars = array_unique($invalidCharsMatches[0]);
   
       $repaired = preg_replace($allowedPattern, ' ', $value);
   
       $repaired = preg_replace('/\s+/', ' ', $repaired);
       $repaired = trim($repaired);
   
       $length = strlen($repaired);
   
       $errors = [];
   
       if ($length < $minLength) {
           $errors[] = "Input is too short. Minimum $minLength character required.";
       }
   
       if ($length > $maxLength) {
           $errors[] = "Input is too long. Maximum $maxLength characters allowed.";
       }
   
       if (!empty($invalidChars)) {
           $invalidList = implode("', '", $invalidChars);
           $errors[] = "Input contains invalid characters: '{$invalidList}'. Allowed characters are letters, numbers, spaces, and @#%^-_+,.:/";
       }
   
       $isValid = empty($errors);
   
       return [
           'value' => $repaired,
           'valid' => $isValid,
           'errors' => $errors
       ];
   }
   
   $errors = [];
   
   foreach ($_POST as $key => $value) {
       if (is_array($value)) {
           $sanitizedArray = array_map('sanitize_value', $value);
           $finalArray = [];
   
           foreach ($sanitizedArray as $item) {
               $result = repair_and_validate($item);
   
               if (strlen($result['value']) === 0) {
                   continue;
               }
   
               if (!$result['valid']) {
                   $errors[$key][] = implode(" ", $result['errors']);
                   break;
               }
   
               $finalArray[] = $result['value'];
           }
   
           if (!isset($errors[$key])) {
               if (!empty($finalArray)) {
                   $_SESSION[$key] = $finalArray;
               } elseif (isset($_SESSION[$key])) {
                   unset($_SESSION[$key]); 
               }
           }
       } else {
           $sanitized = sanitize_value($value);
           $result = repair_and_validate($sanitized);
   
           if (strlen($result['value']) === 0) {
               if (isset($_SESSION[$key])) {
                   unset($_SESSION[$key]); 
               }
               continue;
           }
   
           if (!$result['valid']) {
               $errors[$key] = implode(" ", $result['errors']);
           } else {
               $_SESSION[$key] = $result['value'];
           }
       }
   }
   
   if (!empty($errors)) {
       echo json_encode(['status' => 'error', 'errors' => $errors]);
       exit;
   }
   $_SESSION['page'] = $_SESSION['page'] + 1;
   echo json_encode(['status' => 'success']);
   exit;
?>