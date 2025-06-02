@extends('layouts.app')

{{-- Logika ini akan menentukan apakah kita dalam mode edit atau buat,
     berdasarkan variabel $profile yang dikirim dari controller.
     Untuk 'create.mine', controller akan mengirim $profile = new UserProfile() atau null.
     Untuk 'edit.mine', controller akan mengirim $profile = Auth::user()->profile. --}}
@php
    // $profile dikirim dari controller:
    // - Untuk create: $profile adalah instance baru UserProfile (atau null)
    // - Untuk edit: $profile adalah instance UserProfile yang mau diedit (milik auth user)
    $currentUserProfile = $profile ?? (Auth::user()->profile ?? new App\Models\UserProfile()); // Default ke instance baru jika tidak ada
    $isEditMode = $currentUserProfile->exists; // true jika model sudah ada di database (mode edit)

    if ($isEditMode) {
        $formAction = route('user-profiles.update.mine'); // Rute untuk update profil sendiri
        $headerTitle = 'Edit Profil Saya';
        $buttonText = 'Update Profil';
    } else {
        $formAction = route('user-profiles.store.mine'); // Rute untuk store profil sendiri
        $headerTitle = 'Lengkapi Profil Saya';
        $buttonText = 'Simpan Profil';
    }
@endphp

@section('header', $headerTitle)

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 md:p-8 text-[var(--dark-text)]">
                
                <form action="{{ $formAction }}" method="POST">
                    @csrf
                    @if($isEditMode)
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-1">
                            <label for="main_skill" class="block text-sm font-medium text-[var(--medium-text)] mb-1">Keahlian Utama Saya <span class="text-red-500">*</span></label>
                            <input type="text" id="main_skill" name="main_skill"
                                   value="{{ old('main_skill', $currentUserProfile->main_skill) }}"
                                   class="mt-1 block w-full py-2 px-3 border border-[var(--border-color)] rounded-md shadow-sm focus:outline-none focus:ring-[var(--primary-color)] focus:border-[var(--primary-color)] sm:text-sm @error('main_skill') border-red-500 @enderror"
                                   required>
                            @error('main_skill')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-1">
                            <label for="needed_skill" class="block text-sm font-medium text-[var(--medium-text)] mb-1">Keahlian yang Saya Cari <span class="text-red-500">*</span></label>
                            <input type="text" id="needed_skill" name="needed_skill"
                                   value="{{ old('needed_skill', $currentUserProfile->needed_skill) }}"
                                   class="mt-1 block w-full py-2 px-3 border border-[var(--border-color)] rounded-md shadow-sm focus:outline-none focus:ring-[var(--primary-color)] focus:border-[var(--primary-color)] sm:text-sm @error('needed_skill') border-red-500 @enderror"
                                   required>
                            @error('needed_skill')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="bio" class="block text-sm font-medium text-[var(--medium-text)] mb-1">Tentang Saya (Bio)</label>
                        <textarea id="bio" name="bio" rows="4"
                                  class="mt-1 block w-full py-2 px-3 border border-[var(--border-color)] rounded-md shadow-sm focus:outline-none focus:ring-[var(--primary-color)] focus:border-[var(--primary-color)] sm:text-sm @error('bio') border-red-500 @enderror">{{ old('bio', $currentUserProfile->bio) }}</textarea>
                        @error('bio')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <hr class="my-8 border-[var(--border-color)]">
                    <h3 class="text-lg font-semibold text-[var(--dark-text)] mb-4">Informasi Pribadi</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="date_of_birth" class="block text-sm font-medium text-[var(--medium-text)] mb-1">Tanggal Lahir</label>
                            <input type="date" id="date_of_birth" name="date_of_birth"
                                   value="{{ old('date_of_birth', $currentUserProfile->date_of_birth ? $currentUserProfile->date_of_birth->format('Y-m-d') : '') }}"
                                   class="mt-1 block w-full py-2 px-3 border border-[var(--border-color)] rounded-md shadow-sm focus:outline-none focus:ring-[var(--primary-color)] focus:border-[var(--primary-color)] sm:text-sm @error('date_of_birth') border-red-500 @enderror">
                            @error('date_of_birth')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="gender" class="block text-sm font-medium text-[var(--medium-text)] mb-1">Jenis Kelamin</label>
                            <select id="gender" name="gender"
                                    class="mt-1 block w-full py-2 px-3 border border-[var(--border-color)] bg-white rounded-md shadow-sm focus:outline-none focus:ring-[var(--primary-color)] focus:border-[var(--primary-color)] sm:text-sm @error('gender') border-red-500 @enderror">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" {{ old('gender', $currentUserProfile->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('gender', $currentUserProfile->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                <option value="Lainnya" {{ old('gender', $currentUserProfile->gender) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('gender')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="phone_number" class="block text-sm font-medium text-[var(--medium-text)] mb-1">Nomor Telepon</label>
                            <input type="tel" id="phone_number" name="phone_number"
                                   value="{{ old('phone_number', $currentUserProfile->phone_number) }}"
                                   placeholder="Contoh: 081234567890"
                                   class="mt-1 block w-full py-2 px-3 border border-[var(--border-color)] rounded-md shadow-sm focus:outline-none focus:ring-[var(--primary-color)] focus:border-[var(--primary-color)] sm:text-sm @error('phone_number') border-red-500 @enderror">
                            @error('phone_number')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="address" class="block text-sm font-medium text-[var(--medium-text)] mb-1">Alamat Lengkap</label>
                        <textarea id="address" name="address" rows="3"
                                  placeholder="Contoh: Jl. Merdeka No. 10, RT 01 RW 02, Kelurahan, Kecamatan"
                                  class="mt-1 block w-full py-2 px-3 border border-[var(--border-color)] rounded-md shadow-sm focus:outline-none focus:ring-[var(--primary-color)] focus:border-[var(--primary-color)] sm:text-sm @error('address') border-red-500 @enderror">{{ old('address', $currentUserProfile->address) }}</textarea>
                        @error('address')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                        <div>
                            <label for="city" class="block text-sm font-medium text-[var(--medium-text)] mb-1">Kota/Kabupaten</label>
                            <input type="text" id="city" name="city"
                                   value="{{ old('city', $currentUserProfile->city) }}"
                                   class="mt-1 block w-full py-2 px-3 border border-[var(--border-color)] rounded-md shadow-sm focus:outline-none focus:ring-[var(--primary-color)] focus:border-[var(--primary-color)] sm:text-sm @error('city') border-red-500 @enderror">
                            @error('city')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="province" class="block text-sm font-medium text-[var(--medium-text)] mb-1">Provinsi</label>
                            <input type="text" id="province" name="province"
                                   value="{{ old('province', $currentUserProfile->province) }}"
                                   class="mt-1 block w-full py-2 px-3 border border-[var(--border-color)] rounded-md shadow-sm focus:outline-none focus:ring-[var(--primary-color)] focus:border-[var(--primary-color)] sm:text-sm @error('province') border-red-500 @enderror">
                            @error('province')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="postal_code" class="block text-sm font-medium text-[var(--medium-text)] mb-1">Kode Pos</label>
                            <input type="text" id="postal_code" name="postal_code"
                                   value="{{ old('postal_code', $currentUserProfile->postal_code) }}"
                                   class="mt-1 block w-full py-2 px-3 border border-[var(--border-color)] rounded-md shadow-sm focus:outline-none focus:ring-[var(--primary-color)] focus:border-[var(--primary-color)] sm:text-sm @error('postal_code') border-red-500 @enderror">
                            @error('postal_code')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <label for="profile_picture_url" class="block text-sm font-medium text-[var(--medium-text)] mb-1">URL Foto Profil (Opsional)</label>
                        <input type="url" id="profile_picture_url" name="profile_picture_url"
                               value="{{ old('profile_picture_url', $currentUserProfile->profile_picture_url) }}"
                               placeholder="https://example.com/path/to/your/image.jpg"
                               class="mt-1 block w-full py-2 px-3 border border-[var(--border-color)] rounded-md shadow-sm focus:outline-none focus:ring-[var(--primary-color)] focus:border-[var(--primary-color)] sm:text-sm @error('profile_picture_url') border-red-500 @enderror">
                        @error('profile_picture_url')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="flex items-center justify-end space-x-4 pt-6 mt-8 border-t border-[var(--border-color)]">
                        <a href="{{ $isEditMode && $currentUserProfile->id ? route('user-profiles.show', $currentUserProfile->id) : route('dashboard') }}"
                           class="px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-[var(--medium-text)] bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--primary-color)] transition ripple">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-6 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[var(--success-color)] hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--success-color)] transition ripple">
                            {{ $buttonText }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Any specific JavaScript for this form can go here.
</script>
@endpush
