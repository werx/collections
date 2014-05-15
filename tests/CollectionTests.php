<?php

namespace werx\CollectionTests;

use werx\Collections\Collection;

use werx\CollectionTests\Resources\Collections\Foo;

class CollectionTests extends \PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->data = $this->getTestData();
	}

	public function testCanExtendCollection()
	{
		$collection = new Foo();

		$this->assertTrue(is_subclass_of($collection, 'werx\Collections\Collection'));
	}

	public function testCanFillCollectionConstructor()
	{
		$collection = new Collection($this->data);
		$this->assertEquals(2, $collection->count());
		$this->assertEquals('Foo', $collection->first());
	}

	public function testCanSetArray()
	{
		$collection = new Collection();
		$collection->set($this->data);
		$this->assertEquals(2, $collection->count());
		$this->assertEquals('Foo', $collection->first());
	}

	public function testCanSetItem()
	{
		$collection = new Collection();
		$collection->set('foo', 'Foo');
		$this->assertEquals('Foo', $collection->get('foo'));
	}

	public function testCanSetItemObjectSyntax()
	{
		$collection = new Collection();
		$collection->foo = 'Foo';

		$this->assertEquals('Foo', $collection->get('foo'));
	}

	public function testCanRemoveItem()
	{
		$collection = new Collection();
		$collection->set('foo', 'Foo');
		$this->assertTrue($collection->has('foo'));

		$collection->remove('foo');
		$this->assertFalse($collection->has('foo'));
	}

	public function testCanGetFirstItem()
	{
		$collection = new Collection();
		$collection->set('one', 'One');
		$collection->set('two', 'Two');
		$collection->set('three', 'Three');

		$this->assertEquals('One', $collection->first());
	}

	public function testCanGetLastItem()
	{
		$collection = new Collection();
		$collection->set('one', 'One');
		$collection->set('two', 'Two');
		$collection->set('three', 'Three');

		$this->assertEquals('Three', $collection->last());
	}

	public function testCanAddString()
	{
		$collection = new Collection();
		$collection->add('Foo');
		$this->assertEquals('Foo', $collection->first());
	}

	public function testCanAddArray()
	{
		$collection = new Collection();
		$collection->add(['foo'=>'Foo']);
		$data = $collection->first();
		$this->assertEquals('Foo', $data['foo']);
	}

	public function testCanAddObject()
	{
		$collection = new Collection();
		$collection->add((object) ['foo'=>'Foo']);
		$data = $collection->first();
		$this->assertEquals('Foo', $data->foo);
	}

	public function testCanClearCollection()
	{
		$collection = new Collection($this->data);
		$this->assertEquals(2, $collection->count());

		$collection->clear();
		$this->assertEquals(0, $collection->count());
	}

	public function testCanCountItems()
	{
		$collection = new Collection($this->data);
		$this->assertEquals(2, $collection->count());
	}

	public function testCanCountItemsInitialEmptyCollection()
	{
		$collection = new Collection();
		$this->assertEquals(0, $collection->count);
	}

	public function testImplementsCountableInterface()
	{
		$collection = new Collection($this->data);
		$this->assertEquals(2, count($collection));
	}

	public function testCollectionShouldHaveKey()
	{
		$collection = new Collection($this->data);
		$this->assertTrue($collection->has('foo'));
	}

	public function testCollectionShouldNotHaveKey()
	{
		$collection = new Collection($this->data);
		$this->assertFalse($collection->has('x'));
	}

	public function testCanGetItem()
	{
		$collection = new Collection($this->data);
		$this->assertEquals('Foo', $collection->get('foo'));
		$this->assertEquals('Bar', $collection->get('bar'));
	}

	public function testCanGetItemObjectSyntax()
	{
		$collection = new Collection($this->data);
		$this->assertEquals('Foo', $collection->foo);
		$this->assertEquals('Bar', $collection->bar);
	}

	public function testCanGetDefaultValue()
	{
		$collection = new Collection($this->data);
		$this->assertEquals(null, $collection->get('x'), 'Default Value.');
		$this->assertEquals('z', $collection->get('x', 'z'), 'Default Value Override.');
	}

	public function testCanGetDefaultItemObjectSyntax()
	{
		$collection = new Collection($this->data);
		$this->assertEquals(null, $collection->x);
	}

	public function testAllReturnsArray()
	{
		$collection = new Collection($this->data);
		$this->assertEquals($this->data, $collection->all());
	}

	public function testToArrayReturnsArray()
	{
		$collection = new Collection($this->data);
		$this->assertEquals($this->data, $collection->toArray());
	}

	public function testToJsonReturnsValidJson()
	{
		$collection = new Collection($this->data);
		$json = $collection->toJson();
		$this->assertEquals($this->data, json_decode($json, true));
	}

	public function testToStringReturnsExpectedString()
	{
		$collection = new Collection($this->data);
		$this->assertEquals('{"foo":"Foo","bar":"Bar"}', (string) $collection);
	}

	public function testCanGetIterator()
	{
		$collection = new Collection($this->data);
		$iterator = $collection->getIterator();

		$this->assertInstanceOf('ArrayIterator', $iterator);
	}

	public function getTestData()
	{
		return ['foo' => 'Foo', 'bar' => 'Bar'];
	}
}
