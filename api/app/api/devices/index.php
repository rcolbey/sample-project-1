<?php
$pg_connect_string = getenv("PG_CONNECT_STRING");
if ($pg_connect_string == NULL) {
	$pg_connect_string  = "postgres://sample:password@172.17.0.1:5432/sample";
}
$db_params = parse_url($pg_connect_string);

$dbname=ltrim($db_params['path'],'/');
$db_handle = pg_connect("host={$db_params['host']} dbname={$dbname} user={$db_params['user']} password={$db_params['pass']}");
if ($db_handle) {
	$location    = (isset($_GET['location']))    ? $_GET['location']    : NULL;
	$device_type = (isset($_GET['device_type'])) ? $_GET['device_type'] : NULL;
	$device_id   = (isset($_GET['device_id']))   ? $_GET['device_id']   : NULL;
	$params = [ $location, $device_type, $device_id ];
	$query = "select * from get_devices($1,$2,$3)";
	$prepared    = pg_prepare($db_handle, "devices", $query);
	$result      = pg_execute($db_handle, "devices", $params);
	pg_close($db_handle);
	if ($result) {
		http_response_code(200);
		exit(json_encode(pg_fetch_all($result)));
	} else {
		http_response_code(500);
	}
} else {
	http_response_code(500);
}
?>
