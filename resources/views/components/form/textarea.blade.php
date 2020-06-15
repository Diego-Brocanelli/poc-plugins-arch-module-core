
    <div class="form-group {{ $class }}">
        <label for="js-textarea-{{ $name }}">
            {{ $label }}
        </label>

        <textarea 
            class="form-control" 
            id="js-textarea-{{ $name }}" 
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            {{ $required === true ? 'required' : '' }}
            {{ $disabled === true ? 'disabled' : '' }}
        ></textarea>

        @if($help !== null)
            <small id="js-input-{{ $name }}-help" class="form-text text-muted">
                {{ $help }}
            </small>
        @endif

    </div>

