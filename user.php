<? require_once 'header.php'; 
require_once '../fonksiyon/filtrele.php'
?>
<head>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
</head>
<div class="container mt-5">
<table id="example" class="display mb-2" style="width:100%">
<thead>
<tr>
<th>Kullanıcı Adı</th>
<th></th>
</tr>
</thead>
<tbody>
<? 
$query="SELECT * from admin";
$s=$db->query($query);
while($f=$s->fetchArray()){
?>
<tr>
<td><?=$f["admin_kadi"]?></td>
<td><button class="btn btn-danger" onclick="ksil(<?=$f["Id"]?>)">Sil</button></td>
</tr>
<?  } ?>
</tbody>
</table>

<h3>Kullanıcı Ekle</h3>
<form  id="kekle">
<? input(array('text','text'),array('admin_kadi','admin_sifre'),array('Kullanıcı Adı','Şifre')); ?>
</form>
<button class="btn btn-primary" onclick="ekle('kekle','islem.php?islem=userek')" >Ekle</button>
</div>

<? require_once 'footer.php'; ?>
<script  src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable({
		"ordering": false,
        "info":     false
	});
} );
function ksil(a){
	var id=a;
	Swal.fire({
		type:"warning",
		title:"Emin misin",
		text:"Silme işlemi başlasın mı",
		showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Sil!',
  cancelButtonText: 'İptal!'
	}).then((result)=>{
		 if (result.value) {
		$.ajax({
			type:"post",
			url:"islem.php?islem=ksil",
			data:{ksil:id},
			success:function(response){
				g=JSON.parse(response);
				Swal.fire({
					type:g.status,
					title:g.title,
					text:g.message
				});
				if(g.status=="success"){
					setTimeout(function(){window.location.reload();},500);
				}
				
			},
			error:function(){
				Swal.fire({
  type: "error",
  title: "Hata oluştu",
  text: "İşlem başarısız",
  showConfirmButton:false
});
			}
		})
		 }
	});
}
</script>