<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
         private $customerRepository;

     public function __construct(CustomerRepository $customerRepository)
     {
         //bring customer Repo
         $this->customerRepository = $customerRepository;


     }
    public function index()
    {

        $customer = $this->customerRepository->all();


       return $customer;


        // //1-  
        // // $customer = Customer::all();

        // // $customer = Customer::orderby('name')->get(); //alpha
        // $customer = Customer::orderby('name')
        //     ->where('active', 1)
        //     ->get()
        //     ->map(function ($customer) { //formate 
        //         return [

        //             'customer_id' => $customer->id,
        //             'name'=> $customer->name,
        //         ];
        //     });
        // return $customer;
    }

    public function show($customerId){
          $customer = $this->customerRepository->findbyId($customerId);

          return $customer;
           }


    public function update($customerId){
              $this->customerRepository->update($customerId);
              return redirect('/customer/'  .$customerId);
    }

    public function destroy($customerId)
    {
        $this->customerRepository->delete($customerId);
        return redirect('/');
    }
}
