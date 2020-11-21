<?  
/*
$sql=new SQLite3("mysql.db");
$sql->exec("CREATE TABLE admin(
Id INTEGER PRIMARY KEY,
admin_kadi VARCHAR NOT NULL,
admin_sifre VARCHAR NOT NULL,
saat VARCHAR NOT NULL,
komisyon VARCHAR NOT NULL,
kredi VARCHAR NOT NULL
)");

$sql->exec("CREATE TABLE faturaler(
id INTEGER PRIMARY KEY,
  fatura_ad VARCHAR NOT NULL,
  fatura_no VARCHAR NOT NULL,
  isletme_no VARCHAR NOT NULL,
  fatura_tutar VARCHAR NOT NULL,
  fatura_zaman TİMESTAMP NOT NULL DEFAULT CURRENT_TİMESTAMP,
  fatura_sonodeme VARCHAR NOT NULL,
  fatura_onay ENUM(0,1) NULL DEFAULT 0,
  fatura_kar VARCHAR  NOT NULL DEFAULT 2
)");

*/

/*
$sql->exec("INSERT INTO admin(Id,admin_kadi,admin_sifre,saat,komisyon,kredi) VALUES(NULL,'asd','deneme','14:23','2','4') ");
$s=$sql->query("select * from admin");
$m=$s->fetchAll(PDO::FETCH_OBJ);
foreach($m as $t){
	echo $t->Id."-".$t->admin_kadi."<br />";
}*/
$db=new PDO('sqlite:mysql.db');
if(isset($_POST['kaydet'])){  
    //Form verilerini değişkene aktarma   
    $ad=$_POST['ad'];
    $soyad=$_POST['soyad'];
    $adres=$_POST['adres'];
    $tarih=$_POST['tarih'];  
    $liste=[$ad,$soyad,$adres,$tarih];  
 
    //form ekleme sorgusu ve kayıt ekleme işlemi
    $kayit_sorgu = "INSERT INTO uye (ad, soyad, adres, tarih) 
                    VALUES (?,?,?,?)";
    $stmt = $db->prepare($kayit_sorgu);
    $stmt->execute($liste);
    $db = null;
    
}
 
//$_POST['guncelle'] nesnesi varsa güncelleme yapacak
if(isset($_POST['guncelle'])){  
    $ad=$_POST['ad'];
    $soyad=$_POST['soyad'];
    $adres=$_POST['adres'];
    $tarih=$_POST['tarih']; 
    $ID=$_POST['ID'];
    //sorguda ? sırasına göre Form verilerini değişkene aktarma
    $liste=[$ad,$soyad,$adres,$tarih,$ID]; 
    
    $sorgu = "UPDATE `uye` SET `ad` = ?, `soyad` = ?, `adres` = ?, `tarih` = ? WHERE `ID` = ?";
    $stmt = $db->prepare($sorgu);
    $stmt->execute($liste);
    $db = null;
}
 
if(ISSET($_REQUEST['id'])){
    $sorgu = "DELETE FROM `uye` WHERE ID = '$_REQUEST[id]'";
    $stmt = $db->prepare($sorgu);
    $stmt->execute();
    $db = null;
}


?>