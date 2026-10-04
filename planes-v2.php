<?php
// Historic direct links now resolve to the one public, consultant-led pricing page.
$query = $_SERVER['QUERY_STRING'] ?? '';
header('Location: /planes.php' . ($query === '' ? '' : '?' . $query), true, 302);
exit;
