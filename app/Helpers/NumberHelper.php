<?php

namespace App\Helpers;

/**
 * NumberHelper
 * 
 * Classe auxiliar para formatação de números.
 */
class NumberHelper
{
	/**
	 * Formata um número removendo zeros decimais desnecessários.
	 * 
	 * Exemplos:
	 * - 112.00 → 112
	 * - 112.20 → 112,20
	 * - 112.50 → 112,50
	 * - 1234.56 → 1.234,56
	 * 
	 * @param float|int|string $number O número a ser formatado
	 * @param int $decimals Número de casas decimais (padrão: 2)
	 * @param bool $useThousandsSeparator Se deve usar separador de milhares (padrão: true)
	 * @return string Número formatado
	 */
	public static function format($number, int $decimals = 2, bool $useThousandsSeparator = true): string
	{
		// Converte para float
		$number = floatval($number);
		
		// Formata o número
		$thousandsSeparator = $useThousandsSeparator ? '.' : '';
		$formatted = number_format($number, $decimals, ',', $thousandsSeparator);
		
		// Remove zeros decimais desnecessários
		if ($decimals > 0 && strpos($formatted, ',') !== false) {
			// Remove zeros à direita
			$formatted = rtrim($formatted, '0');
			// Se sobrou apenas a vírgula, remove também
			$formatted = rtrim($formatted, ',');
		}
		
		return $formatted;
	}

	/**
	 * Formata um número como moeda (BRL).
	 * 
	 * Exemplos:
	 * - 112.00 → R$ 112
	 * - 112.20 → R$ 112,20
	 * - 1234.56 → R$ 1.234,56
	 * 
	 * @param float|int|string $number O número a ser formatado
	 * @param string $symbol Símbolo da moeda (padrão: 'R$')
	 * @param bool $removeTrailingZeros Remove zeros decimais (padrão: true)
	 * @return string Valor formatado como moeda
	 */
	public static function currency($number, string $symbol = 'R$', bool $removeTrailingZeros = true): string
	{
		if ($removeTrailingZeros) {
			$formatted = self::format($number, 2, true);
		} else {
			$number = floatval($number);
			$formatted = number_format($number, 2, ',', '.');
		}
		
		return $symbol . ' ' . $formatted;
	}

	/**
	 * Formata um número sem separador de milhares.
	 * 
	 * @param float|int|string $number O número a ser formatado
	 * @param int $decimals Número de casas decimais (padrão: 2)
	 * @return string Número formatado
	 */
	public static function simple($number, int $decimals = 2): string
	{
		return self::format($number, $decimals, false);
	}

	/**
	 * Converte um número formatado BR (1.234,56) para float.
	 * 
	 * @param string $formattedNumber Número formatado em padrão BR
	 * @return float
	 */
	public static function toFloat(string $formattedNumber): float
	{
		// Remove pontos (separador de milhares)
		$number = str_replace('.', '', $formattedNumber);
		// Substitui vírgula por ponto (separador decimal)
		$number = str_replace(',', '.', $number);
		// Remove qualquer outro caractere não numérico (exceto ponto e sinal negativo)
		$number = preg_replace('/[^0-9.\-]/', '', $number);
		
		return floatval($number);
	}
}
	