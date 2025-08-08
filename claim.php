<?php
$upi = trim(strtolower($_POST['upi']));

// Validate format
if (!$upi || !preg_match("/@/", $upi)) {
  echo "invalid";
  exit;
}

// File to store claimed UPIs
$file = "claimed_upis.txt";
if (!file_exists($file)) {
  file_put_contents($file, "");
}

$claimed = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
if (in_array($upi, $claimed)) {
  echo "already";
  exit;
}

// Simulate ₹2 transfer (in real use, call payment API here)
file_put_contents($file, $upi . "\n", FILE_APPEND);
echo "success";