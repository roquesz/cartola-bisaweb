<?php
class Cartola
{
	public function getData()
	{
		try {
			$status_market = $this->getStatusMarket();
			if($status_market->status_mercado == 2){
				$url = 'json/pontuados.json';
			}
			$url = 'https://api.cartolafc.globo.com/atletas/pontuados';
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL,$url);
			$athlet_points = curl_exec($ch);
			curl_close($ch);
			$round = $status_market->rodada_atual;
			$fp = fopen('json/pontuados.json', 'w');
			fwrite($fp, $athlet_points);
			fclose($fp);
			$athlet_points = json_decode($athlet_points);
			$round = $athlet_points->rodada;
			$athlet_points = (array)$athlet_points->atletas;
			$list_points = [];
			foreach ($athlet_points as $key => $data) {
				$list_points[$key] = $data->pontuacao;
			}
			$id_athlets = array_keys($athlet_points);
			$partial = [];
			$partial['round'] = 'Pontos da rodada '.$round;
			$teams = $this->getTeams();
			foreach($teams as $team):
				$url_time = 'https://api.cartolafc.globo.com/time/'.$team;
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
				$partial['points'][] = [
										'name' => $data->time->nome_cartola,
										'team' => $data->time->nome,
										'point' => number_format($point, 2, '.', ''),
										'players' => $qtd .' / 12'
										];
			endforeach;
			usort($partial['points'], function ($item1, $item2) {
			    if ($item1['point'] == $item2['point']) return 0;
			    return $item1['point'] > $item2['point'] ? -1 : 1;
			});
			return $partial;
		} catch (Exception $e) {
		}

	}

	public function getStatusMarket()
	{
		$url = 'https://api.cartolafc.globo.com/mercado/status';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$url);
		$status_market = curl_exec($ch);
		curl_close($ch);
		$status_market = json_decode($status_market);
		return $status_market;
	}

	public function getGames()
	{
		$url = 'http://globoesporte.globo.com/futebol/brasileirao-serie-a/';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$url);
		$data = curl_exec($ch);
		$data = explode('<section class="section-container section-container-last">', $data);
		$data = $data[1];
		$data = explode('<footer class="legenda-classificacao">', $data);
		$data = $data[0];
		curl_close($ch);
		return $data;

	}

	public function getTeams()
	{
		$teams = [
			'flaliracity',
			'confianca-mf-clube',
			'corinthians-glins',
			'ae-santa-cruz',
			'super-santa',
			'roque-sz-fc',
			'sport-fcfc',
			'ikarosales-fc',
			'somostodosmarcio-fc',
			'mim-diga-fc'
			];
		return $teams;
	}

	public function getRound($round = null)
	{
		if(is_null($round)){
			$status_market = $this->getStatusMarket();
			$round = $status_market->rodada_atual;
		}
		$url = 'http://globoesporte.globo.com/servico/esportes_campeonato/responsivo/widget-uuid/5ccc4223-e3f3-4202-8fee-c984fceb8420/fases/fase-unica-seriea-2016/rodada/'.$round.'/jogos.html';
		$data = file_get_contents($url);
		$trans = [
			'<span class="tabela-icone tabela-icone-versus"></span>' => " x ",
			'<a class="placar-jogo-link placar-jogo-link-confronto-js" href="' => '<a class="placar-jogo-link placar-jogo-link-confronto-js"'
		];
		$data = strtr($data, $trans);
		// $data = str_replace(, 'X', $data);
		return $data;
	}
}