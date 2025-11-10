<?php

namespace App\Http\Dto;

abstract class BaseDto
{
	public function toArray(): array
	{
		// Use reflection to collect properties from the class and its parents
		// including private properties declared on the parents. Convert property
		// names to snake_case so the returned array matches Eloquent column names.
		$data = [];
		try {
			$reflect = new \ReflectionObject($this);
			// Walk the class hierarchy to ensure we capture private properties from parents
			$cls = $reflect->getName();
			while ($cls) {
				$rc = new \ReflectionClass($cls);
				$props = $rc->getProperties();
				foreach ($props as $prop) {
					$prop->setAccessible(true);
					$name = $prop->getName();
					$snake = $this->toSnake($name);
					// Do not override if a child class already set this property
					if (!array_key_exists($snake, $data)) {
						$data[$snake] = $prop->getValue($this);
					}
				}
				$cls = get_parent_class($cls);
				if ($cls === false) {
					break;
				}
			}
		} catch (\Throwable $e) {
			// fallback to get_object_vars if reflection fails
			$data = get_object_vars($this);
		}

		return $this->normalize($data);
	}

	/**
	 * Convert a property name from camelCase or PascalCase to snake_case.
	 */
	protected function toSnake(string $name): string
	{
		// If already contains underscore, assume it's already snake_case
		if (strpos($name, '_') !== false) {
			return strtolower($name);
		}

		$snake = preg_replace('/([a-z0-9])([A-Z])/', '$1_$2', $name);
		$snake = preg_replace('/([A-Z])([A-Z][a-z])/', '$1_$2', $snake);
		return strtolower($snake);
	}

	/**
	 * Recursively normalize values so any nested object becomes a simple array of name=>value.
	 * - If an object has a toArray() method it will be used.
	 * - If an object is a DateTimeInterface it will be converted to string.
	 * - Arrays are normalized element-wise.
	 * @param mixed $value
	 * @return mixed
	 */
	protected function normalize(mixed $value): mixed
	{
		if (is_null($value)) {
			return null;
		}

		if (is_scalar($value)) {
			return $value;
		}

		if ($value instanceof \DateTimeInterface) {
			return $value->format('Y-m-d H:i:s');
		}

		if (is_array($value)) {
			$out = [];
			foreach ($value as $k => $v) {
				$out[$k] = $this->normalize($v);
			}
			return $out;
		}

		if (is_object($value)) {
			// prefer explicit toArray implementations (Eloquent models, DTOs, etc.)
			if (method_exists($value, 'toArray')) {
				return $this->normalize($value->toArray());
			}

			if ($value instanceof \JsonSerializable) {
				return $this->normalize($value->jsonSerialize());
			}

			// fallback: get public/protected/private properties
			$vars = get_object_vars($value);
			// If get_object_vars returned empty (possible for e.g. internal objects), try reflection
			if (empty($vars)) {
				try {
					$reflect = new \ReflectionObject($value);
					$props = $reflect->getProperties();
					$vars = [];
					foreach ($props as $prop) {
						$prop->setAccessible(true);
						$vars[$prop->getName()] = $prop->getValue($value);
					}
				} catch (\Throwable $e) {
					// give up and cast to string
					return (string) $value;
				}
			}

			return $this->normalize($vars);
		}

		// fallback: convert to string
		return (string) $value;
	}
}
