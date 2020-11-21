<? 
$db=new SQLite3("mysql.db");
$db->busyTimeout(5000);
$db->exec('PRAGMA journal_mode = wal;');

 ?>