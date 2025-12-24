# Enum Translator - Guia de Uso

## O que é?
Um sistema centralizador de traduções para enums. Você define todas as traduções em um único lugar (`EnumTranslator.php`) e elas são usadas automaticamente.

## Como funciona?

### 1. Definir traduções no EnumTranslator

Edite `app/Traits/EnumTranslator.php` e adicione suas traduções:

```php
private static array $translations = [
    'EProfile' => [
        'ADMIN' => 'Administrador',
        'SELLER' => 'Vendedor',
    ],
    'EUnitFormat' => [
        'DECIMAL' => 'Decimal',
        'INTEGER' => 'Inteiro',
    ],
];
```

### 2. Usar nos enums
Seus enums já herdão de `TBaseEnum` que automaticamente usa o tradutor:

```php
enum EProfile: int implements IBaseEnum
{
    use TBaseEnum;

    case ADMIN = 1;
    case SELLER = 2;
}
```

### 3. Como chamar as traduções

```php
// Via método getDescription() - recomendado
$profile = EProfile::ADMIN;
echo $profile->getDescription(); // Output: "Administrador"

// Via array do enum
$profileArray = EProfile::toArray();
// Output: [1 => 'Administrador', 2 => 'Vendedor']

// Via EnumTranslator direto
echo EnumTranslator::translate('EProfile', 'ADMIN');
// Output: "Administrador"
```

## Métodos disponíveis no EnumTranslator

### `translate(string $enumClass, string $caseName, ?string $default = null): string`
Obtém a tradução de um case específico.

```php
EnumTranslator::translate('EProfile', 'ADMIN'); // "Administrador"
EnumTranslator::translate('EProfile', 'UNKNOWN', 'Desconhecido'); // "Desconhecido"
```

### `add(string $enumClass, string $caseName, string $translation): void`
Adiciona ou atualiza uma tradução em tempo de execução.

```php
EnumTranslator::add('EProfile', 'MODERATOR', 'Moderador');
```

### `all(string $enumClass): array`
Obtém todas as traduções de um enum.

```php
$translations = EnumTranslator::all('EProfile');
// ['ADMIN' => 'Administrador', 'SELLER' => 'Vendedor']
```

## Exemplo Completo

```php
// Enum
enum EUnitFormat: int implements IBaseEnum
{
    use TBaseEnum;

    case DECIMAL = 1;
    case INTEGER = 2;
}

// Em EnumTranslator.php
'EUnitFormat' => [
    'DECIMAL' => 'Decimal',
    'INTEGER' => 'Inteiro',
],

// Usando
$unit = EUnitFormat::DECIMAL;
echo $unit->getDescription(); // "Decimal"

foreach (EUnitFormat::toArray() as $value => $description) {
    echo "$value: $description"; // "1: Decimal", "2: Inteiro"
}
```

## Vantagens
- ✅ Centralizador: todas as traduções em um único arquivo
- ✅ Fácil de atualizar: basta editar um array
- ✅ Suporta múltiplos idiomas: você pode estender para suportar i18n
- ✅ Sem quebra de compatibilidade: `getDescription()` continua funcionando normalmente
- ✅ Flexível: permite adicionar traduções em tempo de execução
