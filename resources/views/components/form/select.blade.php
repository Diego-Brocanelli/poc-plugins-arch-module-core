

    <div class="form-group {{ $class }}">
        <label for="js-select-{{ $name }}">
            {{ $label }}
        </label>

        <select 
            class="form-control" 
            id="js-select-{{ $name }}" 
            name="{{ $name }}"
            {{ $required === true ? 'required' : '' }}
            {{ $disabled === true ? 'disabled' : '' }}>
            <option selected>Choose...</option>
            <option>...</option>
        </select>

        @if($help !== null)
            <small id="js-input-{{ $name }}-help" class="form-text text-muted">
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


