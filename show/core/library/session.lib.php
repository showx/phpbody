<?php
/*
 * session 类
 * Author show
 * copyright PHPBODY
 */
global $sdb;
function open_session() {
    return true;
} 
function close_session() {
    return true;
} 
function read_session($sid) {
    global $sdb;
    $result = $sdb->getone("SELECT data FROM show_session WHERE id='{$sid}'");
    if($result!=false)
    {
        $result = $result['data'];
    }
    return $result;
} 
function write_session($sid, $data) {
    global $sdb;
    $time = time();
    $row = '';
    if($data != '')
    {
        $result = $sdb->query("REPLACE INTO show_session (id, data,lastaccess) VALUES ('{$sid}', '{$data}','{$time}')");
        $row = $sdb->affected_rows();
    }
    return $row;	
} 
function destroy_session($sid) {
	global $sdb;
        $result = $sdb->query("DELETE FROM show_session WHERE id='{$sid}'");
	$_SESSION = array();
	return $sdb->affected_rows();
} 
function clean_session($expire) {
	global $sdb;
        $sdb->query("DELETE FROM show_session WHERE DATE_ADD(lastaccess, INTERVAL %d SECOND) < NOW()");
	return $sdb->affected_rows();
}
session_set_save_handler('open_session', 'close_session', 'read_session', 'write_session', 'destroy_session', 'clean_session');
session_start();
?>
