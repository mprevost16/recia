<?php
	
	$url = "https://ent.recia.fr/esco-apps-redirector/getInfosJson.php";
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
$json = curl_exec($ch);
if(!$json) {
    echo curl_error($ch);
}
curl_close($ch);

$structures = json_decode($json, true);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.min.css" integrity="sha256-BJ/G+e+y7bQdrYkS2RBTyNfBHpA9IuGaPmf9htub5MQ=" crossorigin="anonymous" />

    <title>RECIA</title>
  </head>
  <body><div class="container-fluid bg-light text-dark p-5">
    <div class="container bg-light p-5">
        <h1 class="display-4">RECIA - Exercice développement</h1>
        <hr>
        <p>Réalisation d’une interface web affichant la liste des établissements
de formation présents dans un référentiel</p>
    </div>
</div>
<br>
  <div class="table-responsive">
  <table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">Action</th>
      <th scope="col">Siren</th>
      <th scope="col">Nom</th>
      <th scope="col">Type d’établissement</th>
      <th scope="col">Contexte de rattachement de l’établissement</th>
      <th scope="col">Adresse</th>
      <th scope="col">N° téléphone</th>
      <th scope="col">Code UAI</th>
      <th scope="col">N° téléphone bis</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $cpt =0;
  foreach($structures as $structure) {
	  $siren = "";
	  $nom = "";
	  $type = "";
	  $bp = "";
	  $street = "";
	  $context = "";
	  $phoneNumber = "";
	  $phoneNumberBis = "";
	  $uai = "";
	  $postalCode = "";
	  $city = "";
	  
	if (isset($structure["entstructuresiren"])) {
		$siren = $structure["entstructuresiren"];
	}
	if (isset($structure["entstructurenomcourant"])) {
		$nom = $structure["entstructurenomcourant"];
	}
	if (isset($structure["entstructuretypestruct"])) {
		$type = $structure["entstructuretypestruct"];
	}
	if (isset($structure["postofficebox"])) {
		$bp = $structure["postofficebox"];
	}
	if (isset($structure["street"])) {
		$street = $structure["street"];
	}
	if (isset($structure["context"])) {
		$context = $structure["context"];
	}
	if (isset($structure["telephonenumber"])) {
		$phoneNumber = $structure["telephonenumber"];
	}
	if (isset($structure["facsimiletelephonenumber"])) {
		$phoneNumberBis = $structure["facsimiletelephonenumber"];
	}
	if (isset($structure["entstructureuai"])) {
		$uai = $structure["entstructureuai"];
	}
	if (isset($structure["postalcode"])) {
		$postalCode = $structure["postalcode"];
	}
	if (isset($structure["l"])) {
		$city = $structure["l"];
	}
	?>
    <tr>
	  <td><span class="oi oi-pencil" title="Edit" aria-hidden="true"></span>&nbsp;&nbsp;
		  <span class="oi oi-trash" style="cursor:pointer" title="Delete" aria-hidden="true"></span>
	  </td>
      <th scope="row"><?php echo $siren ?></th>
      <td><?php echo $nom?></td>
      <td><?php echo $type ?></td>
      <td><?php echo $context ?></td>
      <td><?php echo $street ?><br><?php echo $bp ?><br><?php echo $postalCode ." ".$city?></td>
      <td><?php echo $phoneNumber ?></td>
      <td><?php echo $uai ?></td>
      <td><?php echo $phoneNumberBis ?></td>
    </tr>
  <?php } ?>
  </tbody>
</table>
</div>
<script>
$('#myTable tr .oi-trash').click(function(){
    $(this).parents('tr').remove();
    return false;
});
</script>
  </body>
</html>