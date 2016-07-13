<?php
$times = [
'o-abencoado',
'meterino-f-c',
'boleiro-united-fc',
'arena-prime',
'ramongadelhafc',
'anglo-will',
'turique',
'eduardo-ado-f-c',
'selecao-cabulosa',
'tricolordoarrudafc',
'leicester-rubr0-negr0',
'tricolordoarrudafc',
'paulao-winners-club',
'roque-sz-fc',
'david83',
'fifo-batista',
'rc-1985',
'dubala-fc',
'teimoso-da-bola-fc'
];

$athlet_points = file_get_contents('https://api.cartolafc.globo.com/atletas/pontuados');
$athlet_points = json_decode($athlet_points);
$athlet_points = (array)$athlet_points->atletas;
$list_points = [];
foreach ($athlet_points as $key => $data) {
	$list_points[$key] = $data->pontuacao;
}
$id_athlets = array_keys($athlet_points);
$partial = [];
foreach($times as $time):
	$url_time = 'https://api.cartolafc.globo.com/time/'.$time;
	$data = file_get_contents($url_time);
	$data = json_decode($data);
	$points = $data->atletas;
	$point = 0;
	$qtd = 0;
	foreach ($points as $data_pont):
		$athlet = $data_pont->atleta_id;
		if(in_array($athlet, $id_athlets)):
			$point += $list_points[$athlet];
		$qtd++;
		endif;
	endforeach;
	$partial[$data->time->nome.' - '.$qtd.' / 12'] = number_format($point, 2, '.', '');
endforeach;
arsort($partial);
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<title></title>
</head>
<body>
	<table class="table" style="width: 400px;">
		<?php
			$count = 1;
			foreach ($partial as $key => $data):
		?>
			<tr>
				<td><?php echo $count++; ?></td>
				<td><?php echo $key; ?></td>
				<td><?php echo $data; ?></td>
			</tr>
		<?php
			endforeach;
		?>
	</table>
</body>
</html>