<?php

namespace App\Helpers;

/**
 * SelectHelper (Builder fluente)
 *
 * Permite criar selects de forma encadeada e padronizada:
 * SelectHelper::make('categoria_id')
 *    ->setLabel('Categoria')
 *    ->setOptions($categories)
 *    ->setClass('form-select-lg')
 *    ->setPlaceholder('Escolha uma categoria')
 *    ->render();
 */
class SelectHelper
{
	protected ?string $name = null;
	protected ?string $id = null;
	protected ?string $class = null;
	protected ?string $placeholder = 'Selecione';
	protected $options = [];
	protected ?string $objectName = 'name';
	protected ?string $selected = null;
	protected ?string $label = null;
	protected bool $required = false;
	protected array $attributes = [];
	protected bool $disabled = false;
	protected ?string $helpText = null;

	public function __construct(?string $name = null)
	{
		$this->name = $name;
		$this->id = $name;
	}

	public static function make(?string $name = null): self
	{
		return new self($name);
	}

	// Métodos de configuração fluentes
	public function setName(string $name): self
	{
		$this->name = $name;
		if (!$this->id) {
			$this->id = $name;
		}
		return $this;
	}

	public function setId(string $id): self
	{
		$this->id = $id;
		return $this;
	}

	public function setClass(string $class): self
	{
		$this->class = $class;
		return $this;
	}

	public function setPlaceholder(string $placeholder): self
	{
		$this->placeholder = $placeholder;
		return $this;
	}

	public function setOptions($options): self
	{
		$this->options = $options;
		return $this;
	}

	public function setObjectName(string $objectName): self
	{
		$this->objectName = $objectName;
		return $this;
	}

	public function setSelected($selected): self
	{
		$this->selected = old($this->name, $selected);
		return $this;
	}

	public function setLabel(string $label): self
	{
		$this->label = $label;
		return $this;
	}

	public function setRequired(bool $required = true): self
	{
		$this->required = $required;
		return $this;
	}

	public function setDisabled(bool $disabled = true): self
	{
		$this->disabled = $disabled;
		return $this;
	}

	public function setAttributes(array $attributes): self
	{
		$this->attributes = $attributes;
		return $this;
	}

	public function addAttribute(string $key, $value): self
	{
		$this->attributes[$key] = $value;
		return $this;
	}

	public function setHelpText(string $helpText): self
	{
		$this->helpText = $helpText;
		return $this;
	}

	/**
	 * Gera o array de opções que será passado para o component Blade.
	 */
	public function toArray(): array
	{
		return [
			'name' => $this->name,
			'id' => $this->id,
			'class' => $this->class,
			'placeholder' => $this->placeholder,
			'values' => $this->options,
			'objectName' => $this->objectName,
			'selected' => $this->selected,

			'label' => $this->label,
			'required' => $this->required,
			'disabled' => $this->disabled,
			'attributes' => $this->attributes,
			'helpText' => $this->helpText,
		];
	}

	/**
	 * Renderiza o select usando o component correspondente.
	 */
	public function render(): string
	{
		$opts = $this->toArray();

		try {
			return view('components.select.select', $opts)->render();
		} catch (\Throwable $e) {
			// Fallback simples
			$id = $opts['id'] ? ' id="' . e($opts['id']) . '"' : '';
			$name = $opts['name'] ? ' name="' . e($opts['name']) . '"' : '';
			$class = $opts['class'] ? ' class="form-select ' . e($opts['class']) . '"' : ' class="form-select"';
			$required = $opts['required'] ? ' required' : '';
			$disabled = $opts['disabled'] ? ' disabled' : '';

			$html = "<select{$id}{$name}{$class}{$required}{$disabled}>";
			$html .= '<option value="">' . e($opts['placeholder'] ?? 'Selecione') . '</option>';

			if (!empty($opts['values'])) {
				foreach ($opts['values'] as $value) {
					$optionValue = $value->id ?? '';
					$optionName = $value[$opts['objectName'] ?? 'name'] ?? '';
					$selected = ($opts['selected'] == $optionValue) ? ' selected' : '';
					$html .= '<option value="' . e($optionValue) . '"' . $selected . '>' . e($optionName) . '</option>';
				}
			}

			$html .= '</select>';
			return $html;
		}
	}

	// Métodos estáticos de conveniência
	/**
	 * Cria um select a partir de uma Query Builder, Paginator ou Collection.
	 * Aceita qualquer tipo de coleção (Collection, Paginator, LengthAwarePaginator, etc).
	 */
	public static function fromQuery($queryOrCollection, string $name, array $opts = []): string
	{
		$builder = self::make($name);

		if (!empty($opts['class'])) $builder->setClass($opts['class']);
		if (!empty($opts['placeholder'])) $builder->setPlaceholder($opts['placeholder']);
		if (!empty($opts['objectName'])) $builder->setObjectName($opts['objectName']);
		if (!empty($opts['selected'])) $builder->setSelected($opts['selected']);
		if (!empty($opts['label'])) $builder->setLabel($opts['label']);
		if (!empty($opts['required'])) $builder->setRequired($opts['required']);
		if (!empty($opts['attributes'])) $builder->setAttributes($opts['attributes']);

		// Detecta o tipo e obtém os dados
		if (is_object($queryOrCollection)) {
			// Query Builder - tem get()
			if (method_exists($queryOrCollection, 'get') && is_callable([$queryOrCollection, 'get'])) {
				// Verifica se é Query Builder (Builder ou seus parentes)
				$className = class_basename($queryOrCollection);
				if (in_array($className, ['Builder', 'EloquentBuilder'])) {
					$options = $queryOrCollection->get();
				} else {
					// É Paginator ou Collection, usa direto
					$options = $queryOrCollection;
				}
			} else {
				// Já é Collection ou similar
				$options = $queryOrCollection;
			}
		} else {
			// Array ou outros tipos iteráveis
			$options = $queryOrCollection;
		}

		$builder->setOptions($options);

		return $builder->render();
	}
}
