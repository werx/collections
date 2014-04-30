<?php

namespace werx\CollectionTests;

use werx\Collection;

use werx\CollectionTests\Resources\Collections\Foo;

class CollectionTests extends \PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->data = $this->getTestData();
	}

	public function testCanExtendCollection()
	{
		$foo = new Foo();

		$this->assertTrue(is_subclass_of($foo, 'werx\Collections\Collection'));
	}

	public function testCanFillCollectionConstructor()
	{
		$foo = new Foo($this->data);
		$this->assertEquals(2, $foo->count());
		$this->assertEquals('Foo', $foo->first());
	}

	public function testCanFillCollectionMethod()
	{
		$foo = new Foo();
		$foo->fill($this->data);
		$this->assertEquals(2, $foo->count());
		$this->assertEquals('Foo', $foo->first());
	}

	public function testCanSetItem()
	{
		$foo = new Foo();
		$foo->set('foo', 'Foo');
		$this->assertEquals('Foo', $foo->get('foo'));
	}

	public function testCanRemoveItem()
	{
		$foo = new Foo();
		$foo->set('foo', 'Foo');
		$this->assertTrue($foo->has('foo'));

		$foo->remove('foo');
		$this->assertFalse($foo->has('foo'));
	}

	public function testCanGetFirstItem()
	{
		$foo = new Foo();
		$foo->set('one', 'One');
		$foo->set('two', 'Two');
		$foo->set('three', 'Three');

		$this->assertEquals('One', $foo->first());
	}

	public function testCanGetLastItem()
	{
		$foo = new Foo();
		$foo->set('one', 'One');
		$foo->set('two', 'Two');
		$foo->set('three', 'Three');

		$this->assertEquals('Three', $foo->last());
	}

	public function testCanAddString()
	{
		$foo = new Foo();
		$foo->add('Foo');
		$this->assertEquals('Foo', $foo->first());
	}

	public function testCanAddArray()
	{
		$foo = new Foo();
		$foo->add(['foo'=>'Foo']);
		$data = $foo->first();
		$this->assertEquals('Foo', $data['foo']);
	}

	public function testCanAddObject()
	{
		$foo = new Foo();
		$foo->add((object) ['foo'=>'Foo']);
		$data = $foo->first();
		$this->assertEquals('Foo', $data->foo);
	}

	public function testCanClearCollection()
	{
		$foo = new Foo($this->data);
		$this->assertEquals(2, $foo->count());

		$foo->clear();
		$this->assertEquals(0, $foo->count());
	}

	public function testCanCountItems()
	{
		$foo = new Foo($this->data);
		$this->assertEquals(2, $foo->count());
	}

	public function testCanCountItemsInitialEmptyCollection()
	{
		$foo = new Foo();
		$this->assertEquals(0, $foo->count);
	}

	public function testCollectionShouldHaveKey()
	{
		$foo = new Foo($this->data);
		$this->assertTrue($foo->has('foo'));
	}

	public function testCollectionShouldNotHaveKey()
	{
		$foo = new Foo($this->data);
		$this->assertFalse($foo->has('x'));
	}

	public function testCanGetValue()
	{
		$foo = new Foo($this->data);
		$this->assertEquals('Foo', $foo->get('foo'));
		$this->assertEquals('Bar', $foo->get('bar'));
	}

	public function testCanGetDefaultValue()
	{
		$foo = new Foo($this->data);
		$this->assertEquals(null, $foo->get('x'), 'Default Value.');
		$this->assertEquals('z', $foo->get('x', 'z'), 'Default Value Override.');
	}

	public function testAllReturnsArray()
	{
		$foo = new Foo($this->data);
		$this->assertEquals($this->data, $foo->all());
	}

	public function testToArrayReturnsArray()
	{
		$foo = new Foo($this->data);
		$this->assertEquals($this->data, $foo->toArray());
	}

	public function testToJsonReturnsValidJson()
	{
		$foo = new Foo($this->data);
		$json = $foo->toJson();
		$this->assertEquals($this->data, json_decode($json, true));
	}

	public function testToStringReturnsExpectedString()
	{
		$foo = new Foo($this->data);
		$this->assertEquals('{"foo":"Foo","bar":"Bar"}', (string) $foo);
	}

	public function getTestData()
	{
		return ['foo' => 'Foo', 'bar' => 'Bar'];
	}
}
