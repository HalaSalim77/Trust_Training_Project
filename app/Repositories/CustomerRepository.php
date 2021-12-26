<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository
{
	//if i need to  change it , change in one place
	//Repo is just  data provider 
	public function all()
	{

		return Customer::orderby('name')
		->where('active', 1)
			->get()
			->map->format();
	
		// // $customer = Customer::all();
		// // $customer = Customer::orderby('name')->get(); //alpha
		// return Customer::orderby('name')
		// 	->where('active', 1)
		// 	->get()
		// 	->map(function ($customer) { //formate 
		// 		// return [

		// 		// 	'customer_id' => $customer->id,
		// 		// 	'name' => $customer->name,
		// 		// ];

		// 		// return $this->format($customer); //if the format fun is in the Repo
        //            return $customer->format();
		// 	});
	}

	public function findbyId($customerId)
	{
		// $customer= Customer::where('id', $customerId)
		// 	->where('active', 1)
		// 	->firstOrfail();

		// 	return $this->format($customer);

			return Customer::where('id', $customerId)
			->where('active', 1)
			->firstOrfail()
			->format();

	}

	//if i need the same formate 
	// protected function format($customer)
	// {
	// 	return [

	// 		'customer_id' => $customer->id,
	// 		'name' => $customer->name,
	// 	];
	// }

	public function update($customerId){
		$customer = Customer::where('id' , $customerId)->firstOrfail();

		$customer->update(request()->only('name'));
	}

	public function delete($customerId)
	{
		$customer = Customer::where('id', $customerId)->delete();

	  
	}
}