<?php

use Livewire\Component;

use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;

new class extends Component
{
    public $addresses = [];
    public $showAddressModal = false;
    public $editAddressMode = false;
    public $addressId = null;

    // Form inputs
    public $type = 'shipping';
    public $name = '';
    public $phone = '';
    public $address_line1 = '';
    public $address_line2 = '';
    public $city = '';
    public $state = '';
    public $zip = '';
    public $is_default = false;

    public function mount()
    {
        $this->loadAddresses();
    }

    public function loadAddresses()
    {
        if (Auth::check()) {
            $this->addresses = UserAddress::where('user_id', Auth::id())
                ->orderBy('is_default', 'desc')
                ->orderBy('created_at', 'desc')
                ->get();
        }
    }

    public function openCreateModal()
    {
        $this->resetValidation();
        $this->resetForm();
        $this->editAddressMode = false;
        $this->showAddressModal = true;
    }

    public function openEditModal($id)
    {
        $this->resetValidation();
        $address = UserAddress::where('user_id', Auth::id())->findOrFail($id);
        
        $this->addressId = $address->id;
        $this->type = $address->type;
        $this->name = $address->name;
        $this->phone = $address->phone;
        $this->address_line1 = $address->address_line1;
        $this->address_line2 = $address->address_line2;
        $this->city = $address->city;
        $this->state = $address->state;
        $this->zip = $address->zip;
        $this->is_default = $address->is_default;

        $this->editAddressMode = true;
        $this->showAddressModal = true;
    }

    public function saveAddress()
    {
        $validated = $this->validate([
            'type' => 'required|in:shipping,billing',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip' => 'required|string|max:20',
            'is_default' => 'boolean',
        ]);

        if ($this->is_default) {
            // Unset other defaults of the same type for this user
            UserAddress::where('user_id', Auth::id())
                ->where('type', $this->type)
                ->update(['is_default' => false]);
        }

        if ($this->editAddressMode) {
            $address = UserAddress::where('user_id', Auth::id())->findOrFail($this->addressId);
            $address->update($validated + ['user_id' => Auth::id()]);
            session()->flash('message', 'Address updated successfully.');
        } else {
            UserAddress::create($validated + ['user_id' => Auth::id()]);
            session()->flash('message', 'Address added successfully.');
        }

        $this->showAddressModal = false;
        $this->loadAddresses();
    }

    public function deleteAddress($id)
    {
        $address = UserAddress::where('user_id', Auth::id())->findOrFail($id);
        $address->delete();
        session()->flash('message', 'Address deleted successfully.');
        $this->loadAddresses();
    }

    public function resetForm()
    {
        $this->addressId = null;
        $this->type = 'shipping';
        $this->name = '';
        $this->phone = '';
        $this->address_line1 = '';
        $this->address_line2 = '';
        $this->city = '';
        $this->state = '';
        $this->zip = '';
        $this->is_default = false;
    }

    public function render()
    {
        return view('components.user.address.address');
    }
};