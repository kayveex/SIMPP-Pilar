{{-- Use This Template If You Wanna Make A Page Without Dashboard Section --}}

@extends('layouts.nodash-master')

{{-- Page Title --}}
@section('page_title')
    Login - SIMPP Pillar Presisi
@endsection

{{-- Head - Styles --}}
@section('styles-head')
    
@endsection


{{-- Page content --}}
@section('whole-content')
    <section class="flex flex-col bg-[#335071] h-screen w-screen justify-center items-center">
        <div id="login-card" class="flex flex-col rounded-lg h-fit min-h-[400px] w-1/4 min-w-[320px] bg-slate-50 shadow-md">
            <div class="flex flex-col items-center h-full py-6 px-8">
                <div class="flex flex-col justify-center items-center">
                    <img src="{{ asset('assets/img/loginpillar.png') }}" alt="Logo" class="w-[180px]">
                </div>
                <form action="{{ route('doLogin') }}" method="post" class="flex flex-col w-full mt-2">
                    @csrf
                    {{-- Notification START --}}
                    @include('layouts.molecules.alert')
                    {{-- Notification END --}}

                    <div class="input-form">
                        <label class="text-md font-semibold text-gray-700 mb-2">Email</label>
                        <input type="email" value="{{ old('email') }}" name="email" class="p-2 rounded-md border border-gray-300 mb-4 w-full" required>
                    </div>
                    <div class="input-form">
                        <label class="text-md font-semibold text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" class="p-2 rounded-md border border-gray-300 mb-4 w-full" required>
                    </div>
                    <button type="submit" class="bg-[#EB1924] hover:cursor-pointer hover:bg-[#D11520] text-white font-medium my-4 py-2 px-4 rounded-md transition duration-200 ease-in-out transform hover:scale-[1.02] active:scale-[0.98] active:bg-[#C1131E] focus:outline-none focus:ring-2 focus:ring-[#EB1924] focus:ring-opacity-50 shadow-md hover:shadow-lg">
                        Sign In
                    </button>
                </form>

            </div>

        </div>
    </section>
    
@endsection

{{-- Script for JS --}}
@section('scripts')
    
@endsection

