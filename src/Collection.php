<?php

namespace werx\Collections;

class Collection
{
	protected $items = [];

	public function __construct($data = [])
	{
		$this->fill($data);
	}

	/**
	 * Fill the collection with the specified data.
	 * Any existing items with the same key will be replaced.
	 *
	 * @param type $data
	 */
	public function fill($data)
	{
		foreach ($data as $key => $value) {
			$this->items[$key] = $value;
		}
	}

	/**
	 * Does the collection contain an item with the specified key?
	 *
	 * @param string $key
	 * @return boolean
	 */
	public function has($key)
	{
		return array_key_exists($key, $this->items);
	}

	/**
	 * How many keys in this collection?
	 *
	 * @return int
	 */
	public function count()
	{
		return count($this->items);
	}

	/**
	 * Set a key with the specified value.
	 * Any existing item with the same key will be replaced.
	 *
	 * @param string $key
	 * @param mixed $value
	 */
	public function set($key, $value = null)
	{
		$this->items[$key] = $value;
	}

	/**
	 * Get the value for the specified key
	 *
	 * @param string $key
	 * @param mixed $default Default if collection doesn't contain the key.
	 * @return mixed
	 */
	public function get($key, $default = null)
	{
		return $this->has($key) ? $this->items[$key] : $default;
	}

	/**
	 * Get the first item in the collection.
	 *
	 * @return mixed
	 */
	public function first()
	{
		return reset($this->items);
	}

	/**
	 * Get the last item in the collection.
	 *
	 * @return mixed
	 */
	public function last()
	{
		// Get the last item
		$last = end($this->items);

		// Reset the internal pointer.
		reset($this->items);

		// Return the last item.
		return $last;
	}

	/**
	 * Remove the specified key from the collection.
	 *
	 * @param string $key
	 */
	public function remove($key)
	{
		if ($this->has($key)) {
			unset($this->items[$key]);
		}
	}

	/**
	 * Add an item onto the end of the array.
	 *
	 * New item will be numerically indexed.
	 *
	 * @param type $data
	 */
	public function add($data = null)
	{
		$this->items[] = $data;
	}

	/**
	 *  Remove all items in the collection.
	 */
	public function clear()
	{
		$this->items = [];
	}

	/**
	 * Return the entire collection as an array.
	 *
	 * @return array
	 */
	public function all()
	{
		return $this->items;
	}

	/**
	 * Alias for all()
	 *
	 * @return array
	 */
	public function toArray()
	{
		return $this->all();
	}

	/**
	 * Return the entire collection json encoded.
	 *
	 * @return string
	 */
	public function toJson()
	{
		return json_encode($this->all());
	}

	/**
	 * Alias for toJson();
	 *
	 * @return string
	 */
	public function __toString()
	{
		return $this->toJson();
	}

	/**
	 * Magic Method - alias for get().
	 *
	 * @param string $key
	 * @return get
	 */
	public function __get($key)
	{
		return $this->get($key);
	}
}
