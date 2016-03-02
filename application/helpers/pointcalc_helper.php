<?php
	function calculatePoints($formula, $data)
	{
		$formula = str_replace('=','',$formula);
		if (count($data) == 0)
		{
			return $formula;
		}
		else
		{
			if (isset($data['valor_informado']))
			{
				$formula = str_replace('valor_informado', $data['valor_informado'], $formula);
			}
			if (isset($data['classif_informado']))
			{
				$formula = str_replace('classif_informado', $data['classif_informado'], $formula);
			}
			if (isset($data['decorrente_informado']))
			{
				if (count($data['decorrente_informado'])==1)
				{
					$formula = str_replace('decorrente_informado', $data['decorrente_informado'][0], $formula);
				}
				else if (count($data['decorrente_informado'])==2)
				{
					$formula = str_replace('decorrente_informado_1', $data['decorrente_informado'][0], $formula);
					$formula = str_replace('decorrente_informado_2', $data['decorrente_informado'][1], $formula);
				}
			}
			return solve($formula);
		}
		return -1;
	}

	function solve($exp)
	{
		$finished = false;
		$exp = str_replace(' ', '', $exp);
		while (!$finished)
		{
			echo $exp;
			$iParentese = 0;
			$fParentese = 0;
			for ($i=0; $i < strlen($exp) && $fParentese == 0; $i++) { 
				if ($exp[$i] == '(' )	$iParentese = $i;
				if ($exp[$i] == ')' )	$fParentese = $i;
			}
			if ($iParentese==$fParentese)	$finished = true;
			else
			{
				$subExp = substr($exp, $iParentese+1, $fParentese - $iParentese-1);
				$op = '';
				for ($i=0; $i < strlen($subExp) && $op==''; $i++) { 
					if ($subExp[$i] == '+'  || $subExp[$i] == '-' || $subExp[$i] == '*' || $subExp[$i] == '/')
					{
						$op = $subExp[$i];
					}
					else if ($subExp[$i]=='&')
					{
						$op = '&&';
					}
					elseif ($subExp[$i]=='|') {
						$op = '||';
					}
				}
				$result = 0;
				if ($op != '')
				{
					$fator = explode($op, $subExp);
					switch ($op) {
						case '+':
							$result=$fator[0]+$fator[1];
							break;

						case '-':
							$result=$fator[0]-$fator[1];
							break;

						case '*':
							$result=$fator[0]*$fator[1];
							break;

						case '/':
							$result=$fator[0]/$fator[1];
							break;

						case '&&':
							if ($fator[0]&&$fator[1])
							{
								$result= $fator[0] > $fator[1] ? $fator[0] : $fator[1];
							}
							else
							{
								$result = 0;
							}
							break;

						case '||':
							$result=$fator[0]||$fator[1];
							break;
					}
				}
				else
				{
					$result = $subExp;
				}
				$exp = str_replace('('.$subExp.')', $result, $exp);
			}
		}
		return $exp;
	}
?>