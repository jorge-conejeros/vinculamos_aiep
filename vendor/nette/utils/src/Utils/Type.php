<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

namespace Nette\Utils;

use Nette;


/**
 * PHP type reflection.
 */
final class Type
{
<<<<<<< HEAD
	/** @var array */
	private $types;

	/** @var bool */
	private $single;
=======
	/** @var array<int, string|self> */
	private $types;

	/** @var bool */
	private $simple;
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c

	/** @var string  |, & */
	private $kind;


	/**
	 * Creates a Type object based on reflection. Resolves self, static and parent to the actual class name.
	 * If the subject has no type, it returns null.
	 * @param  \ReflectionFunctionAbstract|\ReflectionParameter|\ReflectionProperty  $reflection
	 */
	public static function fromReflection($reflection): ?self
	{
		if ($reflection instanceof \ReflectionProperty && PHP_VERSION_ID < 70400) {
			return null;
		} elseif ($reflection instanceof \ReflectionMethod) {
			$type = $reflection->getReturnType() ?? (PHP_VERSION_ID >= 80100 ? $reflection->getTentativeReturnType() : null);
		} else {
			$type = $reflection instanceof \ReflectionFunctionAbstract
				? $reflection->getReturnType()
				: $reflection->getType();
		}

<<<<<<< HEAD
		if ($type === null) {
			return null;

		} elseif ($type instanceof \ReflectionNamedType) {
			$name = self::resolve($type->getName(), $reflection);
			return new self($type->allowsNull() && $type->getName() !== 'mixed' ? [$name, 'null'] : [$name]);
=======
		return $type ? self::fromReflectionType($type, $reflection, true) : null;
	}


	private static function fromReflectionType(\ReflectionType $type, $of, bool $asObject)
	{
		if ($type instanceof \ReflectionNamedType) {
			$name = self::resolve($type->getName(), $of);
			return $asObject
				? new self($type->allowsNull() && $name !== 'mixed' ? [$name, 'null'] : [$name])
				: $name;
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c

		} elseif ($type instanceof \ReflectionUnionType || $type instanceof \ReflectionIntersectionType) {
			return new self(
				array_map(
<<<<<<< HEAD
					function ($t) use ($reflection) { return self::resolve($t->getName(), $reflection); },
=======
					function ($t) use ($of) { return self::fromReflectionType($t, $of, false); },
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
					$type->getTypes()
				),
				$type instanceof \ReflectionUnionType ? '|' : '&'
			);

		} else {
<<<<<<< HEAD
			throw new Nette\InvalidStateException('Unexpected type of ' . Reflection::toString($reflection));
=======
			throw new Nette\InvalidStateException('Unexpected type of ' . Reflection::toString($of));
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
		}
	}


	/**
	 * Creates the Type object according to the text notation.
	 */
	public static function fromString(string $type): self
	{
<<<<<<< HEAD
		if (!preg_match('#(?:
			\?([\w\\\\]+)|
			[\w\\\\]+ (?: (&[\w\\\\]+)* | (\|[\w\\\\]+)* )
		)()$#xAD', $type, $m)) {
			throw new Nette\InvalidArgumentException("Invalid type '$type'.");
		}

		[, $nType, $iType] = $m;
		if ($nType) {
			return new self([$nType, 'null']);
		} elseif ($iType) {
			return new self(explode('&', $type), '&');
		} else {
			return new self(explode('|', $type));
		}
=======
		if (!Validators::isTypeDeclaration($type)) {
			throw new Nette\InvalidArgumentException("Invalid type '$type'.");
		}

		if ($type[0] === '?') {
			return new self([substr($type, 1), 'null']);
		}

		$unions = [];
		foreach (explode('|', $type) as $part) {
			$part = explode('&', trim($part, '()'));
			$unions[] = count($part) === 1 ? $part[0] : new self($part, '&');
		}

		return count($unions) === 1 && $unions[0] instanceof self
			? $unions[0]
			: new self($unions);
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
	}


	/**
	 * Resolves 'self', 'static' and 'parent' to the actual class name.
<<<<<<< HEAD
	 * @param  \ReflectionFunctionAbstract|\ReflectionParameter|\ReflectionProperty  $reflection
	 */
	public static function resolve(string $type, $reflection): string
	{
		$lower = strtolower($type);
		if ($reflection instanceof \ReflectionFunction) {
			return $type;
		} elseif ($lower === 'self' || $lower === 'static') {
			return $reflection->getDeclaringClass()->name;
		} elseif ($lower === 'parent' && $reflection->getDeclaringClass()->getParentClass()) {
			return $reflection->getDeclaringClass()->getParentClass()->name;
=======
	 * @param  \ReflectionFunctionAbstract|\ReflectionParameter|\ReflectionProperty  $of
	 */
	public static function resolve(string $type, $of): string
	{
		$lower = strtolower($type);
		if ($of instanceof \ReflectionFunction) {
			return $type;
		} elseif ($lower === 'self' || $lower === 'static') {
			return $of->getDeclaringClass()->name;
		} elseif ($lower === 'parent' && $of->getDeclaringClass()->getParentClass()) {
			return $of->getDeclaringClass()->getParentClass()->name;
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
		} else {
			return $type;
		}
	}


	private function __construct(array $types, string $kind = '|')
	{
<<<<<<< HEAD
		if ($types[0] === 'null') { // null as last
			array_push($types, array_shift($types));
		}

		$this->types = $types;
		$this->single = ($types[1] ?? 'null') === 'null';
=======
		$o = array_search('null', $types, true);
		if ($o !== false) { // null as last
			array_splice($types, $o, 1);
			$types[] = 'null';
		}

		$this->types = $types;
		$this->simple = is_string($types[0]) && ($types[1] ?? 'null') === 'null';
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
		$this->kind = count($types) > 1 ? $kind : '';
	}


	public function __toString(): string
	{
<<<<<<< HEAD
		return $this->single
			? (count($this->types) > 1 ? '?' : '') . $this->types[0]
			: implode($this->kind, $this->types);
=======
		$multi = count($this->types) > 1;
		if ($this->simple) {
			return ($multi ? '?' : '') . $this->types[0];
		}

		$res = [];
		foreach ($this->types as $type) {
			$res[] = $type instanceof self && $multi ? "($type)" : $type;
		}
		return implode($this->kind, $res);
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
	}


	/**
	 * Returns the array of subtypes that make up the compound type as strings.
<<<<<<< HEAD
	 * @return string[]
	 */
	public function getNames(): array
	{
		return $this->types;
=======
	 * @return array<int, string|string[]>
	 */
	public function getNames(): array
	{
		return array_map(function ($t) {
			return $t instanceof self ? $t->getNames() : $t;
		}, $this->types);
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
	}


	/**
	 * Returns the array of subtypes that make up the compound type as Type objects:
	 * @return self[]
	 */
	public function getTypes(): array
	{
<<<<<<< HEAD
		return array_map(function ($name) { return self::fromString($name); }, $this->types);
=======
		return array_map(function ($t) {
			return $t instanceof self ? $t : new self([$t]);
		}, $this->types);
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
	}


	/**
<<<<<<< HEAD
	 * Returns the type name for single types, otherwise null.
	 */
	public function getSingleName(): ?string
	{
		return $this->single
=======
	 * Returns the type name for simple types, otherwise null.
	 */
	public function getSingleName(): ?string
	{
		return $this->simple
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
			? $this->types[0]
			: null;
	}


	/**
	 * Returns true whether it is a union type.
	 */
	public function isUnion(): bool
	{
		return $this->kind === '|';
	}


	/**
	 * Returns true whether it is an intersection type.
	 */
	public function isIntersection(): bool
	{
		return $this->kind === '&';
	}


	/**
<<<<<<< HEAD
	 * Returns true whether it is a single type. Simple nullable types are also considered to be single types.
	 */
	public function isSingle(): bool
	{
		return $this->single;
=======
	 * Returns true whether it is a simple type. Single nullable types are also considered to be simple types.
	 */
	public function isSimple(): bool
	{
		return $this->simple;
	}


	/** @deprecated use isSimple() */
	public function isSingle(): bool
	{
		return $this->simple;
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
	}


	/**
<<<<<<< HEAD
	 * Returns true whether the type is both a single and a PHP built-in type.
	 */
	public function isBuiltin(): bool
	{
		return $this->single && Reflection::isBuiltinType($this->types[0]);
=======
	 * Returns true whether the type is both a simple and a PHP built-in type.
	 */
	public function isBuiltin(): bool
	{
		return $this->simple && Validators::isBuiltinType($this->types[0]);
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
	}


	/**
<<<<<<< HEAD
	 * Returns true whether the type is both a single and a class name.
	 */
	public function isClass(): bool
	{
		return $this->single && !Reflection::isBuiltinType($this->types[0]);
=======
	 * Returns true whether the type is both a simple and a class name.
	 */
	public function isClass(): bool
	{
		return $this->simple && !Validators::isBuiltinType($this->types[0]);
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
	}


	/**
	 * Determines if type is special class name self/parent/static.
	 */
	public function isClassKeyword(): bool
	{
<<<<<<< HEAD
		return $this->single && Reflection::isClassKeyword($this->types[0]);
=======
		return $this->simple && Validators::isClassKeyword($this->types[0]);
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
	}


	/**
	 * Verifies type compatibility. For example, it checks if a value of a certain type could be passed as a parameter.
	 */
<<<<<<< HEAD
	public function allows(string $type): bool
=======
	public function allows(string $subtype): bool
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
	{
		if ($this->types === ['mixed']) {
			return true;
		}

<<<<<<< HEAD
		$type = self::fromString($type);

		if ($this->isIntersection()) {
			if (!$type->isIntersection()) {
				return false;
			}

			return Arrays::every($this->types, function ($currentType) use ($type) {
				$builtin = Reflection::isBuiltinType($currentType);
				return Arrays::some($type->types, function ($testedType) use ($currentType, $builtin) {
					return $builtin
						? strcasecmp($currentType, $testedType) === 0
						: is_a($testedType, $currentType, true);
				});
			});
		}

		$method = $type->isIntersection() ? 'some' : 'every';
		return Arrays::$method($type->types, function ($testedType) {
			$builtin = Reflection::isBuiltinType($testedType);
			return Arrays::some($this->types, function ($currentType) use ($testedType, $builtin) {
				return $builtin
					? strcasecmp($currentType, $testedType) === 0
					: is_a($testedType, $currentType, true);
=======
		$subtype = self::fromString($subtype);
		return $subtype->isUnion()
			? Arrays::every($subtype->types, function ($t) {
				return $this->allows2($t instanceof self ? $t->types : [$t]);
			})
			: $this->allows2($subtype->types);
	}


	private function allows2(array $subtypes): bool
	{
		return $this->isUnion()
			? Arrays::some($this->types, function ($t) use ($subtypes) {
				return $this->allows3($t instanceof self ? $t->types : [$t], $subtypes);
			})
			: $this->allows3($this->types, $subtypes);
	}


	private function allows3(array $types, array $subtypes): bool
	{
		return Arrays::every($types, function ($type) use ($subtypes) {
			$builtin = Validators::isBuiltinType($type);
			return Arrays::some($subtypes, function ($subtype) use ($type, $builtin) {
				return $builtin
					? strcasecmp($type, $subtype) === 0
					: is_a($subtype, $type, true);
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
			});
		});
	}
}
