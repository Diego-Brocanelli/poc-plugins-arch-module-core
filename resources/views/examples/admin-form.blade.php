{{--
Este é um exemplo de template usando componentes padrões.
As diretivas @extendsTemplate e @includeTemplate permitem
a substituição dinâmica das views através do Templates\Handler.
--}}

@extendsTemplate('core::layout.admin-page')

@section('page-area')

    <form class="needs-validation was-validated" novalidate>

        <div class="form-row">
            <x-core-form:input-text 
                class="col-md-6"
                label="Meu nome" 
                name="nome" 
                place="Preencha seu nome" 
                mask="dd/mm/yyyy HH:MM" 
                tip_valid="Corretíssimo"
                tip_invalid="Algo está errado!"
                required="true"
                />
            <x-core-form:select name="seletor" class="col-md-6"/>
        </div>

        <div class="form-row">
            <x-core-form:input-email name="email" class="col-md-6"/>
            <x-core-form:input-password name="senha" class="col-md-6"/>
        </div>

        <x-core-form:input-text name="endereço" placeholder="1234 Main St"
            help="Texto de exemplo para instruir o usuário sobre algo importante"/>

        <x-core-form:input-text name="endereço 2" placeholder="Apartment, studio, or floor" />

        <div class="form-row">
            <x-core-form:input-text name="cidade" class="col-md-6" placeholder="Apartment, studio, or floor" />
            <x-core-form:select name="estado" class="col-md-4"/>
            <x-core-form:input-text name="cep" class="col-md-2" />
        </div>

        <x-core-form:textarea name="texto" />

        <div class="form-row">
            <x-core-form:input-file name="upload" class="col-md-3" buttonLabel="Escolher"/>
            <x-core-form:input-file name="upload2" class="col-md-3"/>
        </div>

        <x-core-form:input-text name="desativado" disabled="true" placeholder="Input Desativado" />

        <div class="form-row">
            <div class="form-group col-md-3">
                <div class="form-check pl-0">

                    <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Opção</label>
                    </div>

                </div>
            </div>

            <div class="form-group col-md-3">

                <div class="form-check form-check-inline pl-0">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline1" name="customRadioInline1" value="option1" class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline1">Um (Padrão)</label>
                    </div>
                </div>

                <div class="form-check form-check-inline pl-0">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline2" name="customRadioInline1" value="option2" class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline2">Dois</label>
                    </div>
                </div>

                <div class="form-check form-check-inline pl-0">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline3" name="customRadioInline1" value="option3" class="custom-control-input" disabled>
                        <label class="custom-control-label" for="customRadioInline3">Três</label>
                    </div>
                </div>

            </div>

            <div class="form-group col-md-3">

                <div class="custom-control custom-switch custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="customSwitch1">
                    <label class="custom-control-label" for="customSwitch1">Opção 1</label>
                </div>

                <div class="custom-control custom-switch custom-control-inline">
                    <input type="checkbox" class="custom-control-input" disabled id="customSwitch2">
                    <label class="custom-control-label" for="customSwitch2">Opção 2</label>
                </div>

            </div>

            <x-core-form:input-range name="cep" class="col-md-3" />
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
        
    </form>
    
@endsection
