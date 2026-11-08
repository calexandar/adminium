@php
    $currentValue = settings()->group($group)->get($field['name'], $field['default'] ?? '#000000');
    $layout = $field['layout'] ?? 'default';
    $size = $field['size'] ?? 'medium';
    $showAlpha = $field['show_alpha'] ?? false;
    $presets = $field['presets'] ?? [];
    
    $sizeClasses = [
        'small' => 'w-8 h-8',
        'medium' => 'w-10 h-10', 
        'large' => 'w-12 h-12'
    ];
    
    $colorSizeClass = $sizeClasses[$size] ?? $sizeClasses['medium'];
@endphp

<div class="col-span-full {{ $layout === 'horizontal' ? 'flex items-center gap-4' : '' }}">
    <label for="{{ $field['name'] }}" class="{{ $layout === 'horizontal' ? 'flex-shrink-0 w-1/3' : 'block' }} text-sm/6 font-medium text-gray-900 dark:text-white">
        {{ $field['label'] }}
    </label>
    <div class="mt-2 {{ $layout === 'horizontal' ? 'mt-0 flex-1' : '' }}">
        <div class="flex items-center gap-x-3">
            <!-- Color swatch (clickable) -->
            <div class="relative">
                <button type="button" 
                        class="{{ $colorSizeClass }} rounded-lg border-2 border-gray-300 dark:border-gray-600 shadow-sm hover:shadow-md transition-all duration-200 cursor-pointer hover:scale-105"
                        style="background-color: {{ $currentValue }};"
                        data-color-swatch="{{ $field['name'] }}">
                    <span class="sr-only">Choose {{ $field['label'] }}</span>
                </button>
                <!-- Hidden native color input -->
                <input type="color" 
                       id="{{ $field['name'] }}" 
                       name="{{ $field['name'] }}" 
                       value="{{ $currentValue }}"
                       class="absolute inset-0 opacity-0 cursor-pointer"
                       data-color-input="{{ $field['name'] }}">
            </div>
            
            <!-- Hex value display -->
            <span class="text-sm text-gray-600 dark:text-gray-400 font-mono" data-hex-display="{{ $field['name'] }}">{{ $currentValue }}</span>
        </div>
        
        <!-- Color presets (optional) -->
        @if(count($presets) > 0)
            <div class="mt-3 flex gap-2 flex-wrap">
                @foreach($presets as $color)
                    <button type="button" 
                            class="w-6 h-6 rounded-full border-2 border-gray-200 dark:border-gray-700 hover:scale-110 transition-transform cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1"
                            style="background-color: {{ $color }};"
                            data-color-preset="{{ $field['name'] }}"
                            data-color-value="{{ $color }}"
                            title="{{ $color }}"></button>
                @endforeach
            </div>
        @endif
        
        <!-- Alpha slider (optional) -->
        @if($showAlpha)
            @php
                $alphaValue = 100; // Default to 100% opacity - you can enhance this to store alpha values
            @endphp
            <div class="mt-3">
                <label class="text-xs text-gray-600 dark:text-gray-400">Opacity: <span data-alpha-display="{{ $field['name'] }}">{{ $alphaValue }}</span>%</label>
                <input type="range" 
                       min="0" 
                       max="100" 
                       value="{{ $alphaValue }}"
                       class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                       data-alpha-slider="{{ $field['name'] }}">
            </div>
        @endif
    </div>
    
    <!-- Error handling -->
    @error($field['name'])
        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>

@push('admin_script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fieldName = '{{ $field['name'] }}';
    const colorInput = document.querySelector(`[data-color-input="${fieldName}"]`);
    const colorSwatch = document.querySelector(`[data-color-swatch="${fieldName}"]`);
    const hexDisplay = document.querySelector(`[data-hex-display="${fieldName}"]`);
    
    const presetButtons = document.querySelectorAll(`[data-color-preset="${fieldName}"]`);
    const alphaSlider = document.querySelector(`[data-alpha-slider="${fieldName}"]`);
    const alphaDisplay = document.querySelector(`[data-alpha-display="${fieldName}"]`);
    
    // Sync color swatch clicks with color input
    if (colorSwatch && colorInput) {
        colorSwatch.addEventListener('click', function() {
            colorInput.click();
        });
    }
    
    // Update swatch and hex display when color changes
    if (colorInput) {
        colorInput.addEventListener('input', function(e) {
            const color = e.target.value;
            if (colorSwatch) {
                colorSwatch.style.backgroundColor = color;
            }
            if (hexDisplay) {
                hexDisplay.textContent = color;
            }
        });
    }
    
    
    
    // Color preset functionality
    presetButtons.forEach(button => {
        button.addEventListener('click', function() {
            const color = this.getAttribute('data-color-value');
            
            if (colorInput) {
                colorInput.value = color;
                colorInput.dispatchEvent(new Event('input'));
            }
            
            if (hexDisplay) {
                hexDisplay.textContent = color;
            }
            
            
        });
    });
    
    // Alpha slider functionality
    if (alphaSlider && alphaDisplay) {
        alphaSlider.addEventListener('input', function(e) {
            alphaDisplay.textContent = e.target.value;
            
            // You can enhance this to apply alpha to the color
            // This would require storing the alpha value separately
        });
    }
});
</script>
@endpush