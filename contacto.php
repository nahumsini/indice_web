<?php
// Existing inbound links now share the single diagnosis intake.
$query = $_SERVER['QUERY_STRING'] ?? '';
header('Location: /diagnostico.php' . ($query === '' ? '' : '?' . $query), true, 302);
exit;
