<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * ModalHelper (Builder fluente)
 *
 * Permite criar modais de forma encadeada:
 * ModalHelper::make()
 *     ->setSize('lg')
 *     ->setData(['title' => 'Exemplo'])
 *     ->setBody('profile.modals.example')
 *     ->render();
 */
class ModalHelper
{
	protected string $size = 'md'; // sm, md, lg
	protected array $data = [];
	protected ?string $body = null;
	protected ?string $id = null;
	protected ?string $title = null;
	protected bool $centered = true;
	protected bool $scrollable = false;
	protected array $attributes = [];
	protected ?string $icon = null;
	protected ?string $buttonClass = null;
	protected ?string $buttonLabel = null;
	protected ?string $permission = null;
	protected bool $hasPermission = true;

	public function __construct()
	{
		$this->id = 'modal-' . uniqid();
	}

	public static function make(): self
	{
		return new self();
	}

	/**
	 * Define o tamanho da modal: sm, md, lg
	 */
	public function setSize(string $size): self
	{
		$size = strtolower($size);
		$this->size = in_array($size, ['sm', 'md', 'lg']) ? $size : 'md';
		return $this;
	}

	/**
	 * Define os dados que serão passados para a view da modal
	 */
	public function setData(array $data): self
	{
		$this->data = $data;
		return $this;
	}

	/**
	 * Adiciona dados à modal
	 */
	public function addData(string $key, $value): self
	{
		$this->data[$key] = $value;
		return $this;
	}

	/**
	 * Define a view que será renderizada no corpo da modal
	 */
	public function setBody(string $view): self
	{
		$this->body = $view;
		return $this;
	}

	/**
	 * Define o ID da modal
	 */
	public function setId(string $id): self
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * Define o título da modal
	 */
	public function setTitle(string $title): self
	{
		$this->title = $title;
		return $this;
	}

	/**
	 * Define se a modal é centralizada
	 */
	public function setCentered(bool $centered = true): self
	{
		$this->centered = $centered;
		return $this;
	}

	/**
	 * Define se a modal é scrollável
	 */
	public function setScrollable(bool $scrollable = true): self
	{
		$this->scrollable = $scrollable;
		return $this;
	}

	/**
	 * Adiciona atributos customizados
	 */
	public function addAttribute(string $key, $value): self
	{
		$this->attributes[$key] = $value;
		return $this;
	}

	/**
	 * Define o ícone do botão que abre a modal
	 */
	public function setIcon(string $icon): self
	{
		$this->icon = $icon;
		return $this;
	}

	/**
	 * Define a classe CSS do botão
	 */
	public function setButtonClass(string $class): self
	{
		$this->buttonClass = $class;
		return $this;
	}

	/**
	 * Define o label do botão
	 */
	public function setButtonLabel(string $label): self
	{
		$this->buttonLabel = $label;
		return $this;
	}

	/**
	 * Define a permissão necessária para abrir a modal
	 * Formato: "ControllerName@method"
	 */
	public function setPermission(string $permission): self
	{
		$this->permission = $permission;

		$this->hasPermission = Auth::check() 
			? Auth::user()->can(strtolower($permission))
			: false;
		return $this;
	}

	/**
	 * Gera o array de opções que será passado para a view
	 */
	public function toArray(): array
	{
		return [
			'id' => $this->id,
			'size' => $this->size,
			'title' => $this->title,
			'centered' => $this->centered,
			'scrollable' => $this->scrollable,
			'body' => $this->body,
			'data' => $this->data,
			'attributes' => $this->attributes,
			'icon' => $this->icon,
			'buttonClass' => $this->buttonClass ?? 'btn btn-primary',
			'buttonLabel' => $this->buttonLabel ?? '',
			'permission' => $this->permission,
			'hasPermission' => $this->hasPermission,
		];
	}

	/**
	 * Renderiza a modal
	 * Tipos: 'default' (botão + modal), 'button' (apenas botão), 'modal' (apenas modal)
	 */
	public function render(string $type = 'default'): string
	{
		$opts = $this->toArray();

		try {
			if ($type === 'button') {
				return view('components.modals.button', $opts)->render();
			} elseif ($type === 'modal') {
				return view('components.modals.modal', $opts)->render();
			} else {
				// default: renderiza botão + modal
				$button = view('components.modals.button', $opts)->render();
				$modal = view('components.modals.modal', $opts)->render();
				return $button . $modal;
			}
		} catch (\Throwable $e) {
			return "<!-- Erro ao renderizar modal: " . e($e->getMessage()) . " -->";
		}
	}
}
