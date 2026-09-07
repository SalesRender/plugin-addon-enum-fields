<?php

namespace SalesRender\Plugin\Addon\EnumFields;

use PHPUnit\Framework\TestCase;
use ReflectionProperty;
use SalesRender\Plugin\Components\Form\FieldDefinitions\ListOfEnum\Limit;
use SalesRender\Plugin\Components\Form\FieldDefinitions\ListOfEnum\Values\StaticValues;
use SalesRender\Plugin\Components\Form\FieldDefinitions\ListOfEnumDefinition;
use SalesRender\Plugin\Components\Form\FormData;
use SalesRender\Plugin\Components\Translations\Translator;

class CustomerFieldsValidatorTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        Translator::config('en_US');

        $data = new ReflectionProperty(CustomerFieldsFetcherHelper::class, 'data');
        $data->setValue(null, [
            ['name' => 'field_1', 'label' => 'Field 1', '__typename' => CustomerFieldTypesRegistry::STRING],
            ['name' => 'field_2', 'label' => 'Field 2', '__typename' => CustomerFieldTypesRegistry::STRING],
            ['name' => 'field_3', 'label' => 'Field 3', '__typename' => CustomerFieldTypesRegistry::STRING],
        ]);
    }

    private function definition(?int $min, ?int $max): ListOfEnumDefinition
    {
        return new ListOfEnumDefinition(
            'title',
            null,
            fn() => [],
            new StaticValues(['field_1' => ['title' => 'Field 1', 'group' => 'Group']]),
            new Limit($min, $max)
        );
    }

    private function validator(bool $allowNull = false): CustomerFieldsValidator
    {
        return new CustomerFieldsValidator([CustomerFieldTypesRegistry::STRING], $allowNull);
    }

    public function testNullWhenNotAllowed(): void
    {
        $errors = ($this->validator())(null, $this->definition(null, null), new FormData());
        $this->assertContains('Value can not be null', $errors);
    }

    public function testNonArrayValue(): void
    {
        $errors = ($this->validator())('string', $this->definition(null, null), new FormData());
        $this->assertSame(['Incorrect value'], $errors);
    }

    public function testBelowMin(): void
    {
        $errors = ($this->validator())(['field_1'], $this->definition(2, 5), new FormData());
        $this->assertSame(['You should choose minimum of 2 option(s)'], $errors);
    }

    public function testAboveMax(): void
    {
        $errors = ($this->validator())(['field_1', 'field_2', 'field_3'], $this->definition(1, 2), new FormData());
        $this->assertSame(['You should choose less than 2 option(s)'], $errors);
    }

    public function testNullMaxIsNotLimited(): void
    {
        $errors = ($this->validator())(['field_1', 'field_2', 'field_3'], $this->definition(1, null), new FormData());
        $this->assertSame([], $errors);
    }

    public function testNullMinIsNotLimited(): void
    {
        $errors = ($this->validator())(['field_1'], $this->definition(null, 2), new FormData());
        $this->assertSame([], $errors);
    }

    public function testValidValues(): void
    {
        $errors = ($this->validator())(['field_1', 'field_2'], $this->definition(1, 3), new FormData());
        $this->assertSame([], $errors);
    }

    public function testInvalidValue(): void
    {
        $errors = ($this->validator())(['unknown_field'], $this->definition(null, null), new FormData());
        $this->assertSame(['Invalid value "unknown_field"'], $errors);
    }

}
