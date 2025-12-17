<?php

namespace App\Helpers;

use Illuminate\Support\Str;

/**
 * ButtonHelper (Builder fluente)
 *
 * Permite criar botões de forma encadeada:
 * \App\Helpers\ButtonHelper::make('Novo')->setClass('btn-primary')->setLink(route('users.create'))->render('create');
 */
class ButtonHelper
{
	protected ?string $name = null;
	protected ?string $class = null;
	protected ?string $link = null;
	protected ?string $route = null;
	protected ?int $size = 100;
	protected ?string $method = null;
	protected ?string $id = null;
	protected ?string $type = 'button';
	protected $enabled = null; // bool|callable|null
	protected bool $disabled = false;
	protected array $attributes = [];
	protected ?string $icon = null;
	protected ?string $target = null;
	protected $confirm = null;
	protected ?string $dataMethod = null;
	protected ?string $dataAction = null;
	protected ?string $dataTitle = null;
	protected ?string $dataMessage = null;
	protected ?string $title = null;

	public function __construct(?string $name = null)
	{
		$this->name = $name;
	}

	public static function make(?string $name = null): self
	{
		return new self($name);
	}

	// Métodos de configuração fluentes
	public function setName(string $name): self
	{
		$this->name = $name;
		return $this;
	}

	public function setClass(string $class): self
	{
		$this->class = $class;
		return $this;
	}

	public function setLink(string $url): self
	{
		$this->link = $url;
		return $this;
	}

	public function setRoute(string $route): self
	{
		$this->route = $route;
		return $this;
	}

	public function setSize(int $size): self
	{
		$this->size = $size;
		return $this;
	}

	public function setMethod(string $method): self
	{
		$this->method = strtoupper($method);
		return $this;
	}

	public function setId(string $id): self
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * Define se o elemento button será 'button' ou 'submit'.
	 * @param string $type 'button'|'submit'
	 */
	public function setType(string $type): self
	{
		$type = strtolower($type);
		$this->type = $type === 'submit' ? 'submit' : 'button';
		return $this;
	}

	public function setEnabled($enabled): self
	{
		$this->enabled = $enabled;
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

	public function setIcon(string $icon): self
	{
		$this->icon = $icon;
		return $this;
	}

	public function setTarget(string $target): self
	{
		$this->target = $target;
		return $this;
	}

	public function setConfirm(string $confirm): self
	{
		$this->confirm = $confirm;
		return $this;
	}

	public function setDataMethod(string $method): self
	{
		$this->dataMethod = $method;
		return $this;
	}

	public function setDataAction(string $action): self
	{
		$this->dataAction = $action;
		return $this;
	}

	public function setDataTitle(string $title): self
	{
		$this->dataTitle = $title;
		return $this;
	}

	public function setDataMessage(string $message): self
	{
		$this->dataMessage = $message;
		return $this;
	}

	public function setTitle(string $title): self
	{
		$this->title = $title;
		return $this;
	}

	/**
	 * Gera o array de opções que será passado para o component Blade.
	 */
	public function toArray(): array
	{
		// Avalia enabled callable
		$disabled = $this->disabled;
		if ($this->enabled !== null) {
			if (is_callable($this->enabled)) {
				try {
					$enabled = (bool) call_user_func($this->enabled);
				} catch (\Throwable $e) {
					$enabled = false;
				}
			} else {
				$enabled = (bool) $this->enabled;
			}
			$disabled = $enabled ? false : true;
		}

		return [
			'type' => $this->type,
			'size' => $this->size,
			'class' => $this->class,
			'label' => $this->name,
			'url' => $this->link,
			'route' => $this->route,
			'method' => $this->method,
			'id' => $this->id,
			'disabled' => $disabled,
			'attributes' => $this->attributes,
			'icon' => $this->icon,
			'target' => $this->target,
			'confirm' => $this->confirm,
			'dataMethod' => $this->dataMethod,
			'dataAction' => $this->dataAction,
			'dataTitle' => $this->dataTitle,
			'dataMessage' => $this->dataMessage,
			'title' => $this->title,
		];
	}

	/**
	 * Renderiza usando o component correspondente ao tipo.
	 * Tipos conhecidos: link, modal, patch (update), create, edit, delete
	 */
	public function render(string $type = 'link'): string
	{
		$opts = $this->toArray();

		// Mapeamos apenas três components: button (genérico), buttonLink e buttonModal
		$view = 'components.buttons.button';
		switch (Str::lower($type)) {
			case 'link':
				$view = 'components.buttons.buttonLink';
				break;
			case 'modal':
				$view = 'components.buttons.buttonModal';
				break;
			case 'button':
			default:
				$view = 'components.buttons.button';
				break;
		}

		try {
			return view($view, $opts)->render();
		} catch (\Throwable $e) {
			// Fallback simples
			$label = htmlspecialchars($opts['label'] ?? ucfirst($type), ENT_QUOTES, 'UTF-8');
			$classAttr = $opts['class'] ? ' class="' . e($opts['class']) . '"' : '';
			$disabled = $opts['disabled'] ? ' disabled' : '';
			$url = $opts['url'] ? ' href="' . e($opts['url']) . '"' : '';
			return "<a{$url}{$classAttr}{$disabled}>{$label}</a>";
		}
	}

	// Métodos estáticos de compatibilidade / atalhos que usam o builder
	public static function create(string $url, string $label = 'Criar', array $opts = []): string
	{
		$b = self::make($label)->setLink($url);
		if (!empty($opts['class'])) $b->setClass($opts['class']);
		if (!empty($opts['attributes'])) $b->setAttributes($opts['attributes']);
		return $b->render('button');
	}

	public static function edit(string $url, string $label = 'Editar', array $opts = []): string
	{
		$b = self::make($label)->setLink($url);
		if (!empty($opts['class'])) $b->setClass($opts['class']);
		return $b->render('button');
	}

	public static function patch(string $url, string $label = 'Patch', array $opts = []): string
	{
		$b = self::make($label)->setLink($url)->setMethod('PATCH');
		if (!empty($opts['class'])) $b->setClass($opts['class']);
		return $b->render('button');
	}

	public static function modal(string $id, string $label = 'Abrir', array $opts = []): string
	{
		$b = self::make($label)->setId($id);
		if (!empty($opts['class'])) $b->setClass($opts['class']);
		return $b->render('modal');
	}

	public static function delete(string $url, string $label = 'Excluir', array $opts = []): string
	{
		$b = self::make($label)->setLink($url)->setMethod('DELETE');
		if (!empty($opts['class'])) $b->setClass($opts['class']);
		if (!empty($opts['confirm'])) $b->setConfirm($opts['confirm']);
		return $b->render('button');
	}
}

