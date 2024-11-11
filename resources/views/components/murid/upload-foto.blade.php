@props(['id_option'])

<div class="flex items-center justify-center w-full">
    <div class="w-full">
        {{-- Upload Area --}}
        <div x-data="{
            showPreview: false,
            imageData: null,
            errorMessage: '',
            validateFile(file) {
                // Reset error message
                this.errorMessage = '';

                // Check file size (1MB = 1024 * 1024 bytes)
                if (file.size > 1024 * 1024) {
                    this.errorMessage = 'Ukuran file terlalu besar. Maksimum 1MB';
                    this.$refs.fileInput.value = '';
                    return false;
                }

                // Check file type
                if (!['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
                    this.errorMessage = 'Tipe file tidak didukung. Gunakan PNG atau JPG';
                    this.$refs.fileInput.value = '';
                    return false;
                }

                return true;
            }
        }">
            <label for="dropzone-file-{{ $id_option }}"
                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500"
                x-show="!showPreview">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                    </svg>
                    <p class="mb-2 px-2 text-sm text-center text-gray-500 dark:text-gray-400">
                        <span class="font-semibold">Upload jawaban disini</span>
                        Klik untuk upload
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG atau JPG (Max. 1MB)</p>
                </div>
            </label>

            {{-- Preview Area --}}
            <div x-show="showPreview" class="relative w-full h-64">
                <img :src="imageData"
                     class="w-full h-full rounded-lg object-contain border-2 border-gray-300"
                     alt="Preview Image">
                <button type="button"
                        class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1.5 hover:bg-red-600"
                        @click="showPreview = false; imageData = null; errorMessage = ''; $refs.fileInput.value = ''">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <input id="dropzone-file-{{ $id_option }}"
                   type="file"
                   class="hidden"
                   accept="image/png,image/jpeg,image/jpg"
                   x-ref="fileInput"
                   wire:model="answer_image.{{ $id_option }}"
                   @change="
                        const file = $event.target.files[0];
                        if(file) {
                            if(validateFile(file)) {
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    imageData = e.target.result;
                                    showPreview = true;
                                };
                                reader.readAsDataURL(file);
                            }
                        }
                   "/>

            {{-- Custom Error Message --}}
            <div x-show="errorMessage"
                 x-text="errorMessage"
                 class="text-red-500 text-sm mt-2">
            </div>

            {{-- Livewire Error Message --}}
            @error('answer_image.'.$id_option)
                <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
