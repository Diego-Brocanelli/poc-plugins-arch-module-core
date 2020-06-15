

    <div class="form-group {{ $class }}">
        
        @if($type === 'file')

            <div class="custom-file">
                <input type="file" class="custom-file-input" id="js-input-{{ $type }}-{{ $name }}">
                <label for="js-input-{{ $type }}-{{ $name }}" class="custom-file-label" data-browse="{{ $buttonLabel }}">
                    {{ $label }}
                </label>
            </div>
            
        @else 

            <label for="js-input-{{ $type }}-{{ $name }}">
                {{ $label }}
            </label>
            
            <input type="{{ $type }}" 
                class="form-control" 
                id="js-input-{{ $type }}-{{ $name }}" 
                name="{{ $name }}"
                data-mask="{{ $mask }}" 
                placeholder="{{ $placeholder }}"
                {{ $required === true ? 'required' : '' }}
                {{ $disabled === true ? 'disabled' : '' }}
                {{ $min !== null ? "min='{$min}'" : '' }}
                {{ $max !== null ? "max='{$max}'" : '' }}
                >

        @endif 

        @if($help !== null)
            <small id="js-input-{{ $type }}-{{ $name }}-help" class="form-text text-muted">
                {{ $help }}
            </small>
        @endif

        @if($tipValid !== null)
        <div class="valid-tooltip">{{ $tipValid }}</div>
        @endif

        @if($tipInvalid !== null)
        <div class="invalid-tooltip">{{ $tipInvalid }}</div>
        @endif

    </div>

