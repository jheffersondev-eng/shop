<?php

namespace App\Http\Dto;

abstract class BaseDto
{
	public function toArray(): array
	{
		// Use reflection so we capture private/protected properties declared on subclasses
		try {
			$reflect = new \ReflectionObject($this);
			$props = $reflect->getProperties();
			$data = [];
			foreach ($props as $prop) {
				$prop->setAccessible(true);
				$data[$prop->getName()] = $prop->getValue($this);
			}
		} catch (\Throwable $e) {
			// fallback to get_object_vars if reflection fails
			$data = get_object_vars($this);
		}

		return $this->normalize($data);
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
