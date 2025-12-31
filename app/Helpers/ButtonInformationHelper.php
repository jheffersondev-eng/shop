<?php

namespace App\Helpers;

use Carbon\Carbon;

/**
 * ButtonInformationHelper
 * 
 * Classe auxiliar para formatação de informações de auditoria em botões.
 */
class ButtonInformationHelper
{
	private $createdBy;
	private $createdAt;
	private $updatedBy;
	private $updatedAt;
	private $deletedBy;
	private $deletedAt;

	/**
	 * Cria uma instância a partir de um modelo ou dados diretos
	 * 
	 * @param mixed $data Modelo ou array com os dados
	 * @return ButtonInformationHelper
	 */
	public static function make($data = null): self
	{
		$instance = new self();

		if ($data) {
			$instance->createdBy = $data->createdByName ?? $data->created_by_name ?? null;
			$instance->createdAt = $data->createdAt ?? $data->created_at ?? null;
			$instance->updatedBy = $data->updatedByName ?? $data->updated_by_name ?? null;
			$instance->updatedAt = $data->updatedAt ?? $data->updated_at ?? null;
			$instance->deletedBy = $data->deletedByName ?? $data->deleted_by_name ?? null;
			$instance->deletedAt = $data->deletedAt ?? $data->deleted_at ?? null;
		}

		return $instance;
	}

	/**
	 * Define o nome de quem criou
	 */
	public function setCreatedBy(string $createdBy): self
	{
		$this->createdBy = $createdBy;
		return $this;
	}

	/**
	 * Define a data de criação
	 */
	public function setCreatedAt($createdAt): self
	{
		$this->createdAt = $createdAt;
		return $this;
	}

	/**
	 * Define o nome de quem atualizou
	 */
	public function setUpdatedBy(?string $updatedBy): self
	{
		$this->updatedBy = $updatedBy;
		return $this;
	}

	/**
	 * Define a data de atualização
	 */
	public function setUpdatedAt($updatedAt): self
	{
		$this->updatedAt = $updatedAt;
		return $this;
	}

	/**
	 * Define o nome de quem deletou
	 */
	public function setDeletedBy(?string $deletedBy): self
	{
		$this->deletedBy = $deletedBy;
		return $this;
	}

	/**
	 * Define a data de deleção
	 */
	public function setDeletedAt($deletedAt): self
	{
		$this->deletedAt = $deletedAt;
		return $this;
	}

	/**
	 * Renderiza o botão
	 */
	public function render(): string
	{
		if (!$this->createdBy) {
			return '';
		}

		$data = $this->prepare();

		$history = '';
		foreach ($data['history'] as $action => $info) {
			$label = match ($action) {
				'created' => 'Criado',
				'updated' => 'Atualizado',
				'deleted' => 'Deletado',
				default => $action,
			};

			$date = $info['at'] ? '<br><small>Em: ' . $info['at'] . '</small>' : '';
			$history .= '<div style="margin-bottom: 8px;"><strong>' . $label . '</strong><br><small>Por: ' . $info['by'] . $date . '</small></div>';
		}

		return <<<HTML
			<div class="position-relative d-inline-block">
				<button 
					type="button" 
					class="btn btn-sm btn-outline-secondary"
					data-bs-toggle="tooltip"
					data-bs-placement="top"
					title="{$data['lastActionLabel']}"
				>
					<i class="bi {$data['icon']}"></i>
				</button>

				<div class="btn-information-tooltip" style="display: none; position: absolute; bottom: 100%; left: 50%; transform: translateX(-50%); background: #333; color: white; padding: 12px; border-radius: 4px; font-size: 12px; white-space: normal; z-index: 1000; margin-bottom: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.2); width: 200px;">
					{$history}
				</div>
			</div>

			<script>
				document.addEventListener('DOMContentLoaded', function() {
					const buttons = document.querySelectorAll('[data-bs-toggle="tooltip"]');
					buttons.forEach(button => {
						new bootstrap.Tooltip(button);

						button.addEventListener('click', function(e) {
							e.preventDefault();
							const tooltip = this.parentElement.querySelector('.btn-information-tooltip');
							if (tooltip) {
								tooltip.style.display = tooltip.style.display === 'none' ? 'block' : 'none';
							}
						});
					});

					document.addEventListener('click', function(e) {
						document.querySelectorAll('.btn-information-tooltip').forEach(tooltip => {
							if (!tooltip.parentElement.contains(e.target)) {
								tooltip.style.display = 'none';
							}
						});
					});
				});
			</script>
		HTML;
	}

	/**
	 * Prepara os dados de auditoria para exibição
	 */
	private function prepare(): array
	{
		$history = [];

		// Criação (obrigatória)
		$history['created'] = [
			'by' => $this->createdBy,
			'at' => $this->createdAt ? self::formatDate($this->createdAt) : null,
		];

		// Atualização (opcional)
		if ($this->updatedBy) {
			$history['updated'] = [
				'by' => $this->updatedBy,
				'at' => $this->updatedAt ? self::formatDate($this->updatedAt) : null,
			];
		}

		// Deleção (opcional)
		if ($this->deletedBy) {
			$history['deleted'] = [
				'by' => $this->deletedBy,
				'at' => $this->deletedAt ? self::formatDate($this->deletedAt) : null,
			];
		}

		return [
			'history' => $history,
			'lastActionLabel' => $this->getLastActionLabel($history),
			'icon' => $this->getIcon($history),
		];
	}

	/**
	 * Obtém o rótulo da última ação
	 */
	private function getLastActionLabel(array $history): string
	{
		$labels = [];

		if (isset($history['created'])) {
			$labels[] = "Criado por {$history['created']['by']}";
		}

		if (isset($history['updated'])) {
			$labels[] = "Atualizado por {$history['updated']['by']}";
		}

		if (isset($history['deleted'])) {
			$labels[] = "Deletado por {$history['deleted']['by']}";
		}

		return implode(' • ', $labels) ?: 'Sem ação';
	}

	/**
	 * Obtém o ícone apropriado baseado na última ação
	 */
	private function getIcon(array $history): string
	{
		$actions = ['deleted', 'updated', 'created'];

		foreach ($actions as $action) {
			if (isset($history[$action])) {
				return match ($action) {
					'deleted' => 'bi-info-circle',
					'updated' => 'bi-info-circle',
					'created' => 'bi-info-circle',
					default => 'bi-info-circle',
				};
			}
		}

		return 'bi-info-circle';
	}

	/**
	 * Formata uma data para exibição
	 */
	private static function formatDate($date): ?string
	{
		if (!$date) {
			return null;
		}

		try {
			$carbon = $date instanceof Carbon ? $date : Carbon::parse($date);
			return $carbon->format('d/m/Y H:i');
		} catch (\Exception $e) {
			return null;
		}
	}
}
