<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\VetController;
use App\Http\Controllers\ReceptionistController;

new #[Layout('layouts.guest')] class extends Component
{
    public string $complete_name = '';
    public int $role; // The user will select this
    public string $address = '';
    public string $contact_no = '';
    public string $gender = '';
    public ?string $birth_date = null; // Allow null value for birth_date
    public int $status = 1; // Default status
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'complete_name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'integer', 'in:0,1,2,3'], // Validate roles
            'address' => ['required', 'string', 'max:255'],
            'contact_no' => ['string', 'max:15'],
            'gender' => ['required', 'string'],
            'birth_date' => ['nullable', 'date'], // Validate birth_date, allow null
            'status' => ['required', 'integer'], // Changed to integer
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // Log validated data for debugging
        \Log::info('Registration validated', $validated);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        if ($user->role === 0) {
        $this->redirect(route('dashboard', absolute: false), navigate: true);
    } elseif ($user->role === 1) {
        $this->redirect(route('owner-dashboard', absolute: false), navigate: true);
    } elseif ($user->role === 2) {
        $this->redirect(route('vet-dashboard', absolute: false), navigate: true);
    } elseif ($user->role === 3) {
        $this->redirect(route('receptionist-dashboard', absolute: false), navigate: true);
    } else {
        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
    }
}
?>

<div>
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="/">
                <img class="h-24 w-auto mx-auto" src="{{ asset('assets/1.jpg') }}" alt="Your Logo">
            </a>
        </div>
    
    <form wire:submit="register">
        <!-- Complete Name -->
        <div>
            <x-input-label for="complete_name" :value="__('Full Name')" />
            <x-text-input wire:model="complete_name" id="complete_name" class="block mt-1 w-full" type="text" name="complete_name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('complete_name')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select wire:model="role" id="role" class="block mt-1 w-full" required>
                <option value="">Select Role</option>
                <option value="0">Admin</option>
                <option value="1">Animal Owner</option>
                <option value="2">Veterinarian</option>
                <option value="3">Veterinary Receptionist</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input wire:model="address" id="address" class="block mt-1 w-full" type="text" name="address" required />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Contact Number -->
        <div class="mt-4">
            <x-input-label for="contact_no" :value="__('Contact Number')" />
            <x-text-input wire:model="contact_no" id="contact_no" class="block mt-1 w-full" type="text" name="contact_no" />
            <x-input-error :messages="$errors->get('contact_no')" class="mt-2" />
        </div>

        <!-- Gender -->
        <div class="mt-4">
            <x-input-label for="gender" :value="__('Gender')" />
            <select wire:model="gender" id="gender" class="block mt-1 w-full" required>
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>

        <!-- Birth Date -->
        <div class="mt-4">
            <x-input-label for="birth_date" :value="__('Birth Date')" />
            <x-text-input wire:model="birth_date" id="birth_date" class="block mt-1 w-full" type="date" name="birth_date"  />
            <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
        </div>
 
        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
