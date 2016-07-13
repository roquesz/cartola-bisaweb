<?php
	include('Cartola.php');
	$cartola = new Cartola();
	$partial = $cartola->getData();
?>
		<div id="widget-classificacao">
			<header>
				<h2 class="gui-text-section-title tabela-header-titulo"><?php echo $partial['round']?></h2>
			</header>
			<div class="tabela tabela-sem-jogos-por-grupo">
				<table style="width: 100%;">
					<tr class="tabela-head-linha">
						<th>#</th>
						<th>Cartoleiro</th>
						<th>Time</th>
						<th>Jogadores</th>
						<th>Pontos</th>
					</tr>
					<?php
						$count = 1;
						foreach ($partial['points'] as $data):
					?>
						<tr class="tabela-body-linha">
							<td><?php echo $count++; ?></td>
							<td><?php echo $data['name']; ?></td>
							<td><?php echo $data['team'] ?></td>
							<td><?php echo $data['players']; ?></td>
							<td><?php echo $data['point']; ?></td>
						</tr>
					<?php
						endforeach;
					?>
				</table>
			</div>
		</div>