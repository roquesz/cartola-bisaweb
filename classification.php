<?php
	include('Cartola.php');
	$cartola = new Cartola();
	$data = $cartola->getGames();
?>
	<style type="text/css" media="screen">
		.tabela-times { float: left !important;  }
		.tabela-scroll { opacity: 1 !important; margin-left: 18% !important; }
		@media only screen and (max-width:640px) {
			.tabela-scroll { margin-left: 28% !important; }
		}
		@media only screen and (max-width:767px) {
			.tabela-scroll { margin-left: 28% !important; }
		}
		.tabela-times-time-sigla, .tabela-times-variacao { display: none }
		.tabela-pontos-ultimos-jogos .tabela-icone { height: 7px; width: 7px; }
		.tabela-pontos-ultimos-jogos .tabela-icone-v { background-color: #51a81e; }
		.tabela-pontos-ultimos-jogos .tabela-icone-circulo { border-radius: 50%; }
		.tabela-pontos-ultimos-jogos .tabela-icone-d { background-color: #f00; }
		.tabela-pontos-ultimos-jogos .tabela-icone-neutra { background-color: #ccc; }
		.tabela-times-time-link:hover, .tabela-body-linha:hover, .tabela-times-time-nome:hover { color: #333 !important; cursor: default; }
		.tabela-head-linha th { text-align: center !important;  }
	</style>
	<div id="widget-classificacao">
		<?php
		echo $data;
		?>
	</div>
