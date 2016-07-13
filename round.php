<?php
	include('Cartola.php');
	$cartola = new Cartola();
	$round = null;
	if(isset($_GET['round'])){
		$round = $_GET['round'];
	}
	$data = $cartola->getRound($round);
?>
	<style type="text/css" media="screen">
		.placar-jogo-link:hover { color: #333 !important; cursor: default; }
		.placar-jogo-complemento { display: none !important; }
		.games { margin-left: auto !important; margin-right: auto !important; }
		.games header, .games nav.tabela-navegacao { text-align: center !important; }
		.games nav.tabela-navegacao span.tabela-navegacao-seletor { padding: 0 100px !important; }
	</style>

	<div class="games">
		<header>
			<h2 class="gui-text-section-title tabela-header-titulo">JOGOS</h2>
		</header>
		<nav class="tabela-navegacao tabela-navegacao-jogos">
			<span class="gui-icon gui-icon-arrow-left-highlight tabela-navegacao-setas tabela-navegacao-anterior tabela-navegacao-setas-ativa"></span>
			<span data-rodadas-length="38" data-rodada="14" class="tabela-navegacao-seletor">14ª RODADA</span>
			<span class="gui-icon gui-icon-arrow-right-highlight tabela-navegacao-setas tabela-navegacao-proximo tabela-navegacao-setas-ativa"></span>
		</nav>
		<ul class="lista-de-jogos-conteudo">
			<?php
			echo $data;
			?>
		</ul>
	</div>